<?php
session_start();
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include ('../../config/connection.php');
    include ('../functions.php');

    try{
        $id = $_POST['id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $desc = $_POST['desc'];
        $category = $_POST['category'];

        $edit = editAd($id,$name,$price,$desc,$category);

        if($edit){
            $response = ["response" => "Uspesna izmena."];
            http_response_code(200);
            echo json_encode($response);
        }else{
            $response = ["response" => "Greska na serveru. Pokusajte kasnije."];
            http_response_code(500);
            echo json_encode($response);
        }

    }catch (PDOException $ex){
        http_response_code(500);
        echo $ex;
    }
}

?>