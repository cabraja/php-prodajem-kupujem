<?php
session_start();
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_SESSION['user'])){
    include ('../../config/connection.php');
    include ('../functions.php');

    try{
        global $conn;
        $conn->beginTransaction();

        $isFollowed = $_POST['isFollowed'];
        $adId = $_POST['adId'];
        $userId = $_SESSION['user']->id;

        $follow = followAd($adId,$userId,$isFollowed);

        if($follow){
            $response = ['Response' => 'Success'];
            echo json_encode($response);
            http_response_code(200);
        }else{
            http_response_code(500);
        }

        $conn->commit();

    }catch (PDOException $exception){
        $conn->rollBack();
        echo $exception;
        http_response_code(500);
    }
}else{
    http_response_code(404);
}
?>