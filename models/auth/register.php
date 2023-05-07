<?php
    header("Content-type: application/json");
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        include ('../../config/connection.php');
        include ('../functions.php');

        try{
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];

            $regexUsername = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/";
            $regexEmail = "/^[a-z0-9\.\-]+@[a-z0-9\.\-]+$/i";
            $regexPhone = "/^[0][6][0-9]{6,10}$/";
            $regexPassword = "/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,20}$/";

            $errorsArray = array();

            // REGEX TESTS ON SERVER SIDE
            if(!preg_match($regexUsername,$username)){
                array_push($errorArray,"Username nije ispravan.");
            }
            if(!preg_match($regexEmail,$email)){
                array_push($errorArray,"Email nije ispravan.");
            }
            if(!preg_match($regexPhone,$phone)){
                array_push($errorArray,"Broj telefona nije ispravan.");
            }
            if(!preg_match($regexPassword,$password)){
                array_push($errorArray,"Lozinka nije ispravna.");
            }

            if(count($errorsArray) == 0){

                if($checkUser = checkUsernameAndEmail($username, $email)){
                    $response = ['response' => 'Korisnik sa istim mejlom ili korisnickim imenom vec postoji.'];
                    http_response_code(200);
                    echo  json_encode($response);
                    return;
                }

                $encryptedPassword = md5($password);

                //ROLE_ID za korisnika je 2
                $user = registerUser($username,$email,$phone,$encryptedPassword,2);

                if($user){
                    $response = ['response' => 'Uspesna registracija.'];
                    http_response_code(201);
                    echo  json_encode($response);
                }else{
                    $response = ['response' => 'Doslo je do greske. Pokusajte kasnije.'];
                    http_response_code(500);
                    echo  json_encode($response);
                }
            }


        }catch (PDOException $exception){
            echo $exception;
        }
    }else{
        http_response_code(404);
    }
?>