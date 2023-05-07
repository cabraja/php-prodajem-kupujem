<?php
    session_start();

    include ('views/fixed/head.php');
    include ('config/connection.php');
    include ('models/functions.php');

    include ('views/fixed/nav.php');

    if(isset($_GET['page'])){
        $page = $_GET['page'];

        switch ($page){
            case 'home': include ('views/pages/home.php'); break;
            case 'login':
                if(!isset($_SESSION['user'])) include ('views/pages/login.php');
                else include ('views/pages/home.php'); break;
            case 'register':
                if(!isset($_SESSION['user'])) include ('views/pages/register.php');
                else include ('views/pages/home.php'); break;
            case 'ads':
                include ('views/pages/ads.php');break;
            case 'profile':
                if(isset($_SESSION['user'])) include ('views/pages/profile.php');
                else include ('views/pages/login.php');break;
            default: include ('views/pages/home.php');
        }
    }else{
        include ('views/pages/home.php');
    }

    include ('views/fixed/footer.php');

    logPageVisit();
?>