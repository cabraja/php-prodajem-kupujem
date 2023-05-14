<?php
    $id = 0;

    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
?>

<div class="container my-5">
    <?php
    if($id === 0 || !($ad = getAd($id))):
    ?>
        <div class="alert alert-danger" role="alert">
            Ovaj oglas nije pronadjen. <a href="index.php?page=ads">Nazad na sve oglase.</a>
        </div>
    <?php
    else:
    ?>
    <div class="row">
        <div class="col-12 col-lg-6 mb-4" id="ad-column-info">
            <h2 class="fw-bold mb-0"><?=$ad->ad_name?></h2>
            <small class="text-secondary fs-6">Oglas postavljen: <?=date('j.n.Y',strtotime($ad->created_at))?></small>
            <hr class="mt-2"/>
            <div class="price-div">
                <h4 class="mb-0 fw-bold fs-1"><?=$ad->price?></h4>
                <p class="mb-1 ms-2 text-secondary fs-5">RSD</p>
            </div>
            <h6 class="mt-3 text-secondary">Kategorija: <?=$ad->category_name?></h6>

            <p class="mt-3"><?=$ad->description?></p>

            <div class="accordion" id="accordionExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            Podaci o vlasniku oglasa
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <ul class="mb-0">
                                <li><i class="fa-solid fa-user"></i> Korisničko ime: <?=$ad->username?></li>
                                <li><i class="fa-solid fa-envelope"></i> Email: <?=$ad->email?></li>
                                <li><i class="fa-solid fa-phone"></i> Telefon: <?=$ad->phone?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>

            <?php
            if(isset($_SESSION['user'])):
            ?>
                <?php
                if(checkIfAdIsFollowed($ad->id,$_SESSION['user']->id)->count):
                    ?>
                    <button type="button" data-id="<?=$ad->id?>" id="followBtn" class="btn btn-outline-danger border-0 mt-4"><i id="followIcon" class="fa-solid fa-heart"></i> <span id="followBtnText">Pratite ovaj oglas</span></button>
                <?php
                else:
                    ?>
                    <button type="button" data-id="<?=$ad->id?>" id="followBtn" class="btn btn-outline-danger border-0 mt-4"><i id="followIcon" class="fa-regular fa-heart"></i> <span id="followBtnText">Zapratite ovaj oglas</span></button>
                <?php
                endif;
                ?>
            <?php
            else:
            ?>
                <h6 class="mt-4"><span class="badge bg-info">Savet</span> Ulogujte se da bi ste pratili ovaj oglas</h6>
            <?php
            endif;
            ?>
        </div>

        <div class="col-12 col-lg-6">
            <img class="border shadow-sm" src="assets/images/uploaded/large/<?=$ad->image_name?>" width="100%"/>
        </div>
    </div>

    <?php
    endif;
    ?>

    <script src="assets/js/singleAd.js"></script>
</div>