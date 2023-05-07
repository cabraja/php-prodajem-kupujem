<?php
session_start();
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user'])){
    include ('../../config/connection.php');
    include ('../functions.php');

    try{
        global $conn;
        $conn->beginTransaction();

        $name = $_POST['name'];
        $id_cat = $_POST['id_cat'];
        $price = $_POST['price'];
        $image = $_FILES['imageObj'];
        $description = $_POST['description'];

        $errors = array();

//        VELIKA SLIKA
        $imageName = time()."_".$image['name'];
        $imagePath = "../../assets/images/uploaded/large/".$imageName;
        $imageTmp = $image['tmp_name'];
        move_uploaded_file($imageTmp,$imagePath);

//        MALA SLIKA
        $dimensions = getimagesize($imagePath);
        $width = $dimensions[0];
        $height = $dimensions[1];

        $newWidth = 300;
        $newHeight = $height*$newWidth / $width;
        $allowedFormats = ['image/png','image/jpg','image/jpeg'];

        if(in_array($image['type'], $allowedFormats)){
            if($image['type'] == 'image/png'){
                $uploadedPhoto = imagecreatefrompng($imagePath);
                $canvas = imagecreatetruecolor($newWidth,$newHeight);

                imagecopyresampled($canvas,$uploadedPhoto,0,0,0,0,$newWidth,$newHeight,$width,$height);

                imagepng($canvas,"../../assets/images/uploaded/small/".$imageName);
            }else{
                $uploadedPhoto = imagecreatefromjpeg($imagePath);
                $canvas = imagecreatetruecolor($newWidth,$newHeight);

                imagecopyresampled($canvas,$uploadedPhoto,0,0,0,0,$newWidth,$newHeight,$width,$height);

                imagejpeg($canvas,"../../assets/images/uploaded/small/".$imageName);
            }
        }
        else{
            array_push($errors, "Dozvoljeni su samo PNG,JPG i JPEG.");
        }

        $insertAd = insertAd($name, $price,$imageName,$description,$id_cat, $_SESSION['user']->id);


        $conn->commit();

    }catch (PDOException $exception){
        $conn->rollBack();
        echo $exception;
    }
}else{
    http_response_code(404);
}
?>