<?php
session_start();
header("Content-type: application/json");
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include ('../../config/connection.php');
    include ('../functions.php');

    try{
        $email = $_POST['email'];
        $password = $_POST['password'];

        $regexEmail = "/^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i";
        $regexPassword = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/";

        $errorsArray = array();

        // REGEX TESTS ON SERVER SIDE
        if(!preg_match($regexEmail,$email)){
            array_push($errorArray,"Email nije ispravan.");
        }
        if(!preg_match($regexPassword,$password)){
            array_push($errorArray,"Lozinka nije ispravna.");
        }

        if(count($errorsArray) == 0){

            $checkUser = checkIfUserExists($email);

            if(!$checkUser){
                $response = ['response' => 'Korisnik sa ovom email adresom ne postoji.', 'redirect' => 0];
                echo json_encode($response);
                http_response_code(200);
            }else{
                $logAttempt = loginAttempt($email, md5($password));
                if($logAttempt){
                    $_SESSION['user'] = $logAttempt;
                    $response = ['response' => 'Uspesno logovanje', 'redirect' => 1];
                    logLogin($logAttempt->username,$logAttempt->email);
                    echo json_encode($response);
                }else{
                    $response = ['response' => 'Pogresna lozinka.', 'redirect' => 0];
                    echo json_encode($response);
                }
            }
        }


    }catch (PDOException $exception){
        echo $exception;
    }
}else{
    http_response_code(404);
}
?>