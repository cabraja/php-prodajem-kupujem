<?php
session_start();
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include ('../../config/connection.php');
    include ('../functions.php');

    try{
        $ads = getFollowedAds($_SESSION['user']->id);

        $response = ['ads' => $ads];
        echo json_encode($response);
        http_response_code(200);

    }catch (PDOException $exception){
        echo $exception;
        http_response_code(500);
    }
}else{
    http_response_code(404);
}
?>