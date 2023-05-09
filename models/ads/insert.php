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

        if($width > $height){
            $newWidth = 400;
            $newHeight = $height*$newWidth / $width;
        }else{
            $newHeight = 300;
            $newWidth = $width*$newHeight / $height;
        }


        $allowedFormats = ['image/png','image/jpg','image/jpeg'];

        if(in_array($image['type'], $allowedFormats)){
            if($image['type'] == 'image/png'){
                $uploadedPhoto = imagecreatefrompng($imagePath);
                $canvas = imagecreatetruecolor(400,300);

                if($width > $height){
                    $dstx = 0;
                    $dsty = (300-$newHeight)/2;
                }else{
                    $dstx = (400-$newWidth)/2;
                    $dsty = 0;
                }

                imagecopyresampled($canvas,$uploadedPhoto,$dstx,$dsty,0,$newWidth,$newHeight,$width,$height);

                imagepng($canvas,"../../assets/images/uploaded/small/".$imageName);
            }else{
                $uploadedPhoto = imagecreatefromjpeg($imagePath);
                $canvas = imagecreatetruecolor(400,300);

                if($width > $height){
                    $dstx = 0;
                    $dsty = (300-$newHeight)/2;
                }else{
                    $dstx = (400-$newWidth)/2;
                    $dsty = 0;
                }

                imagecopyresampled($canvas,$uploadedPhoto,$dstx,$dsty,0,0,$newWidth,$newHeight,$width,$height);

                imagejpeg($canvas,"../../assets/images/uploaded/small/".$imageName);
            }
        }
        else{
            array_push($errors, "Dozvoljeni su samo PNG,JPG i JPEG.");
        }

        $insertAd = insertAd($name, $price,$imageName,$description,$id_cat, $_SESSION['user']->id);

        if($insertAd){
            $response = ['response' => 'Oglas je uspesno objavljen.'];
            echo json_encode($response);
            http_response_code(201);
        }


        $conn->commit();

    }catch (PDOException $exception){
        $conn->rollBack();
        echo $exception;
    }
}else{
    http_response_code(404);
}
?>