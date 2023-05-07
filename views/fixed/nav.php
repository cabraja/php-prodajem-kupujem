<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand fw-bold" href="#"><span class="text-primary">Proda</span><span class="text-success">jem</span> <span class="text-warning">Kupu</span><span class="text-danger">jem</span></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <?php
                $links = getLinks();

                foreach ($links as $link):
                ?>
                <li class="nav-item">
                    <a class="nav-link
                    <?php
                        if(isset($_GET['page']) && $_GET['page'] == $link->route) echo 'active';
                    ?>
                     " aria-current="page" href="index.php?page=<?=$link->route?>"><?=$link->name?></a>
                </li>
                <?php
                    endforeach;
                ?>

                <?php
                if(!isset($_SESSION['user'])):
                ?>
                    <li class="nav-item ms-2">
                        <a class="nav-link btn btn-primary px-3 text-white" aria-current="page" href="index.php?page=login">Login</a>
                    </li>
                <?php
                endif;
                ?>

                <?php
                if(isset($_SESSION['user'])):
                    ?>
                    <li class="nav-item ">
                        <a class="nav-link
                        <?php
                            if(isset($_GET['page']) && $_GET['page'] == "profile") echo 'active';
                        ?>
                        " aria-current="page" href="index.php?page=profile">Vaš Profil</a>
                    </li>

                    <li class="nav-item ms-2">
                        <a class="nav-link btn btn-warning px-3 text-white" aria-current="page" href="models/auth/logout.php">Logout</a>
                    </li>
                <?php
                endif;
                ?>
            </ul>
            <span class="navbar-text">
            <div class="d-flex flex-row align-items-center justify-content-center icons-nav">
                <i class="fa-solid fa-earth-europe"></i>
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin"></i>
            </div>
      </span>
        </div>
    </div>
</nav>