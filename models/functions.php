<?php
//    NAV
    function getLinks(){
        global $conn;

        $query = "SELECT * FROM links";
        return $conn->query($query)->fetchAll();

    }

//    LOGS
    function logPageVisit(){
        $page = $_SERVER['REQUEST_URI'];
    }

//    AUTHORIZATION
    function registerUser($username, $email, $phone, $password, $id_role){
        global $conn;

        $query = "INSERT INTO users(username,email,phone,password,id_role) VALUES(:username,:email,:phone,:password,:id_role)";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":username",$username);
        $prepare->bindParam(":email",$email);
        $prepare->bindParam(":phone",$phone);
        $prepare->bindParam(":password",$password);
        $prepare->bindParam(":id_role",$id_role);
        return $prepare->execute();
    }

    function checkUsernameAndEmail($username, $email){
        global $conn;

        $query = "SELECT * FROM `users` WHERE username=:username OR email=:email";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":username",$username);
        $prepare->bindParam(":email",$email);
        $prepare->execute();
        return $prepare->fetch();

    }

    function checkIfUserExists($email){
        global $conn;

        $query = "SELECT * FROM users WHERE email=:email";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":email",$email);
        $prepare->execute();
        return $prepare->fetch();
    }
    function loginAttempt($email,$password){
        global $conn;

        $query = "SELECT u.id,username,email,phone,created_at, r.role FROM users u INNER JOIN roles r ON u.id_role=r.id WHERE email=:email AND password=:password";
        $prepare = $conn->prepare($query);
        $prepare->bindParam(":email",$email);
        $prepare->bindParam(":password",$password);
        $prepare->execute();
        return $prepare->fetch();

    }

//    PROFILE AND ADS
    function getAllCategories(){
        global $conn;

        $query = "SELECT * FROM categories";
        return $conn->query($query)->fetchAll();

    }

    function insertAd($name, $price,$imageName,$description,$id_cat, $id_user){
        global $conn;

        $query = "INSERT INTO ads(ad_name,price,image_name,description,id_category,id_user) VALUES(?,?,?,?,?,?) ";

        $prepare = $conn->prepare($query);
        return $prepare->execute([$name, $price,$imageName,$description,$id_cat, $id_user]);



    }
?>