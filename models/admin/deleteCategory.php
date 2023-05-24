<?php
session_start();
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include ('../../config/connection.php');
    include ('../functions.php');

    try{
        $id = $_POST['id'];

        $adCount = checkCategoryCount($id);

        if(intval($adCount->adCount) == 0){

            $deleteCat = deleteCategory($id);

            if($deleteCat){
                $response = ["response" => "Uspesno brisanje.", "cats" => getCategoriesAdmin()];
                http_response_code(200);
                echo json_encode($response);
            }else{
                $response = ["response" => "Doslo je do greske na serveru. Pokusajte kasnije."];
                http_response_code(500);
                echo json_encode($response);
            }
        }else{
            $response = ["response" => "Ne smete brisati kategoriju koja ima oglase."];
            http_response_code(200);
            echo json_encode($response);
        }





    }catch (PDOException $ex){
        http_response_code(500);
        echo $ex;
    }
}

?>