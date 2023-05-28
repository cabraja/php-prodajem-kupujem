<footer class="container-fluid bg-dark py-5">
    <div class="row d-flex align-items-center justify-content-center">
        <div class="col-12 col-md-8 ">
            <div class="d-flex flex-row align-items-center justify-content-center">
                <?php
                $links = getLinks();

                foreach ($links as $link):
                    ?>
                    <a class="nav-link text-white mb-0 mx-4
                        <?php
                    if(isset($_GET['page']) && $_GET['page'] == $link->route) echo 'active';
                    ?>
                         " aria-current="page" href="index.php?page=<?=$link->route?>"><?=$link->name?></a>
                <?php
                endforeach;
                ?>
            </div>
            <h6 class="text-white text-center mt-3 fs-5 mb-0">Mihajlo Cabraja 52/20</h6>
        </div>
    </div>
</footer>
</body>
</html>