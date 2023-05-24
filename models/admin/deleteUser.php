<?php
session_start();
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include ('../../config/connection.php');
    include ('../functions.php');

    try{
        $id = $_POST['id'];

        if($id == $_SESSION['user']->id){
            $response = ["response" => "Ne smete obrisati svoj nalog."];
            echo json_encode($response);
            return;
        }

        $deleteUser = deleteUser($id);

        if($deleteUser){
            $response = ["response" => "Uspesno brisanje.", "users" => getUsers()];
            http_response_code(200);
            echo json_encode($response);
        }else{
            $response = ["response" => "Doslo je do greske na serveru. Pokusajte kasnije."];
            http_response_code(500);
            echo json_encode($response);
        }



    }catch (PDOException $ex){
        http_response_code(500);
        echo $ex;
    }
}

?>