<?php
//    NAV
    function getLinks(){
        global $conn;

        $query = "SELECT * FROM links";
        return $conn->query($query)->fetchAll();

    }

//    LOGS
    function logPageVisit($page){
        $ip = $_SERVER['REMOTE_ADDR'];
        $date = time();
        $user = "Unauthorized user";

        if(isset($_SESSION['user'])){
            $user = $_SESSION['user']->role;
        }

        $data = $page."|".$date."|".$ip."|".$user."\n";

        $file = fopen(LOG_VISITS, "a");
        $write = fwrite($file, $data);
        if($write){
            fclose($file);
        }
    }

    function logLogin($username, $email){
        $date = date("d. m. Y. h:i:s");

        $data = $username." | ".$email." | ".$date."\n";

        $file = fopen(LOG_LOGINS, "a");
        $write = fwrite($file, $data);
        if($write){
            fclose($file);
        }
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
    function getAds($page,$id_category,$sort){
        global $conn;
        $offset = $page*6;

        $query = "SELECT a.id,ad_name,price,image_name,category_name,created_at FROM ads a INNER JOIN categories c ON a.id_category=c.id";

        if($id_category > 0){
            $query .= " WHERE a.id_category = ".$id_category;
        }

        switch ($sort){
            case 1: $query .= " ORDER BY created_at DESC"; break;
            case 2: $query .= " ORDER BY created_at ASC"; break;
            case 3: $query .= " ORDER BY price ASC"; break;
            case 4: $query .= " ORDER BY price DESC"; break;
        }

        $query .= " LIMIT 6 OFFSET ".$offset;

        return $conn->query($query)->fetchAll();
    }
    function getAdCount($id_category){
        global $conn;

        $query = "SELECT COUNT(*) as count FROM ads";

        if($id_category > 0){
            $query .= " WHERE id_category = ".$id_category;
        }
        return $conn->query($query)->fetch();
    }

    function searchAds($keyword){
        global $conn;

        $query = "SELECT * FROM ads WHERE ad_name LIKE '%".$keyword."%' LIMIT 5";
        return $conn->query($query)->fetchAll();
    }

//    SINGLE AD PAGE

    function getAd($id){
        global $conn;

        $query = "SELECT a.id,ad_name,price,image_name,description,a.created_at,c.category_name,u.username,u.email,u.phone,u.created_at FROM ads a INNER JOIN categories c ON a.id_category = c.id INNER JOIN users u ON a.id_user = u.id WHERE a.id = :id";

        $prepare = $conn->prepare($query);
        $prepare->bindParam(":id",$id);
        $prepare->execute();
        return $prepare->fetch();
    }

    function followAd($id_ad,$id_user,$isFollowed){
        global $conn;

        $query = "";
        if($isFollowed == "true"){
            $query = "INSERT INTO adfollowers(id_ad,id_user) VALUES(?,?)";
        }else{
            $query = "DELETE FROM adfollowers WHERE id_ad=? AND id_user=?";
        }

        $prepare = $conn->prepare($query);
        return $prepare->execute([$id_ad, $id_user]);
    }

    function checkIfAdIsFollowed($id_ad,$id_user){
        global $conn;

        $query = "SELECT COUNT(*) as count FROM adfollowers WHERE id_ad=? AND id_user=?";
        $prepare = $conn->prepare($query);
        $prepare->execute([$id_ad, $id_user]);
        return $prepare->fetch();
    }

    function getFollowedAds($id_user){
        global $conn;

        $query = "SELECT a.id,ad_name,af.date,category_name FROM ads a INNER JOIN adfollowers af On a.id=af.id_ad INNER JOIN categories c ON a.id_category = c.id WHERE af.id_user=?";
        $prepare = $conn->prepare($query);
        $prepare->execute([$id_user]);
        return $prepare->fetchAll();
    }

//    ADMIN PANEL

    function getUsers(){
        global $conn;

        $query = "SELECT u.id,username,email,phone,created_at, r.role FROM users u INNER JOIN roles r ON u.id_role=r.id";
        return $conn->query($query)->fetchAll();

    }

    function deleteUser($id){
        global $conn;

        $query = "DELETE FROM users WHERE id=?";
        $prepare = $conn->prepare($query);
        return $prepare->execute([$id]);
    }

    function getAdsAdmin(){
        global $conn;

        $query = "SELECT a.id,ad_name,price,image_name,description,(a.created_at) as date,c.category_name,u.username,u.email,u.phone,u.created_at FROM ads a INNER JOIN categories c ON a.id_category = c.id INNER JOIN users u ON a.id_user = u.id";
        return $conn->query($query)->fetchAll();
    }
    function deleteAd($id){
        global $conn;

        $query = "DELETE FROM ads WHERE id=?";
        $prepare = $conn->prepare($query);
        return $prepare->execute([$id]);
    }

    function getCategoriesAdmin(){
        global $conn;

        $query = "SELECT c.id,c.category_name,COUNT(a.id_category) as adCount FROM categories c LEFT JOIN  ads a ON c.id = a.id_category GROUP BY c.category_name";
        return $conn->query($query)->fetchAll();
    }

    function checkCategoryCount($id){
        global $conn;

        $query = "SELECT c.id,COUNT(a.id_category) as adCount FROM categories c LEFT JOIN  ads a ON c.id = a.id_category GROUP BY c.category_name HAVING c.id=?";
        $prepare = $conn->prepare($query);
        $prepare->execute([$id]);
        return $prepare->fetch();
    }
    function deleteCategory($id){
        global $conn;

        $query = "DELETE FROM categories WHERE id=?";
        $prepare = $conn->prepare($query);
        return $prepare->execute([$id]);
    }

    function getCategory($id){
        global $conn;

        $query = "SELECT * FROM categories WHERE id=?";
        $prepare = $conn->prepare($query);
        $prepare->execute([$id]);
        return $prepare->fetch();
    }


?>