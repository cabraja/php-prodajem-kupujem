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
            case 'author':
                include ('views/pages/author.php');break;
            case 'ad':
                include ('views/pages/singleAd.php');break;
            case 'dashboardHome':
                if(isset($_SESSION['user']) && $_SESSION['user']->role=='Admin') include('views/pages/admin/dashboardHome.php');
                else include ('views/pages/login.php');break;
            case 'dashboardUsers':
                if(isset($_SESSION['user']) && $_SESSION['user']->role=='Admin') include('views/pages/admin/dashboardUsers.php');
                else include ('views/pages/login.php');break;
            case 'dashboardAds':
                if(isset($_SESSION['user']) && $_SESSION['user']->role=='Admin') include('views/pages/admin/dashboardAds.php');
                else include ('views/pages/login.php');break;
            case 'dashboardCategories':
                if(isset($_SESSION['user']) && $_SESSION['user']->role=='Admin') include('views/pages/admin/dashboardCategories.php');
                else include ('views/pages/login.php');break;
            case 'editCategory':
                if(isset($_SESSION['user']) && $_SESSION['user']->role=='Admin') include('views/pages/admin/editCategory.php');
                else include ('views/pages/login.php');break;
            case 'editAd':
                if(isset($_SESSION['user']) && $_SESSION['user']->role=='Admin') include('views/pages/admin/editAd.php');
                else include ('views/pages/login.php');break;
            default: include ('views/pages/home.php');
        }
    }else{
        include ('views/pages/home.php');
        $page = "home";
    }

    include ('views/fixed/footer.php');

    logPageVisit($page);
?>