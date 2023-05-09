<?php
session_start();
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    include ('../../config/connection.php');
    include ('../functions.php');

    try{
        $page = $_GET['page'];
        $catId = $_GET['categoryId'];
        $sort = $_GET['sort'];
        $ads = getAds($page,$catId, $sort);
        $adCount = getAdCount($catId);

        $response = ['ads' => $ads, 'count' => $adCount];
        echo json_encode($response);
        http_response_code(200);

    }catch (PDOException $exception){
        echo $exception;
    }
}else{
    http_response_code(404);
}
?>