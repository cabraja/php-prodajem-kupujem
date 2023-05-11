<?php
    $ads = getAds(0,0,1);
    $categories = getAllCategories();
    $adCount = getAdCount(0);
?>

<div class="container my-5">
    <div class="row">
        <div class="col-12 col-md-3 px-3 mb-4">
            <div class="row bg-white border rounded px-4 py-3">
                <div class="col-12 mb-3">
                    <h3 class="fw-bold fs-3 mb-0">Filteri</h3>
                    <hr class="mt-2" />
                    <label for="ddlCategory" class="form-label">Kategorija</label>
                    <select class="form-select" id="ddlCategory">
                        <option value="0">Izaberite kategoriju</option>
                        <?php
                        foreach ($categories as $c):
                        ?>
                        <option value="<?=$c->id?>"><?=$c->category_name?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                </div>
               <div class="col-12">
                   <button type="button" id="filterBtn" class="btn btn-warning">Filtriraj</button>
               </div>
            </div>
        </div>

        <div class="col-12 col-md-9">
            <div class="row justify-content-between">
                <div class="col-12 col-md-6 mb-2 d-flex flex-row align-items-center" id="search-wrapper">
                    <input type="email" class="form-control" id="tbSearch" placeholder="Pretražite ovde...">
                    <button class="btn btn-primary px-4" id="btnSearch"><i class="fa-solid fa-magnifying-glass"></i></button>

                    <div id="search-results">
                        <ul id="search-results-list">

                        </ul>
                    </div>
                </div>

                <div class="col-12 col-md-3 mb-2">
                    <select class="form-select" id="ddlSort">
                        <option selected value="1">Prvo noviji</option>
                        <option  value="2">Prvo stariji</option>
                        <option  value="3">Prvo jeftiniji</option>
                        <option  value="4">Prvo skuplji</option>
                    </select>
                </div>
            </div>
            <div class="row" id="ads-content">
                <?php
                if(count($ads) > 0):
                ?>
                    <?php
                    foreach ($ads as $ad):
                        ?>
                        <div class="col-12 col-lg-4 col-md-6 mt-3">
                            <div class="card shadow" style="100%">
                                <img src="assets/images/uploaded/small/<?=$ad->image_name?>" class="card-img-top" alt="<?=$ad->ad_name?>">
                                <div class="card-body">
                                    <p class="card-text mb-0 text-secondary">Kategorija: <?=$ad->category_name?></p>
                                    <h5 class="card-title mb-0"><?=$ad->ad_name?></h5>
                                    <p class="mb-0 mt-1 text-primary fw-bold"><?=$ad->price?> RSD</p>
                                    <small class="text-secondary">Oglas postavljen: <?=date('j.n.Y',strtotime($ad->created_at))?></small>
                                    <a href="index.php?page=ad&id=<?=$ad->id?>" class="btn btn-outline-primary mt-2">Pogledaj Oglas</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>

                <?php
                endif;
                ?>

                <?php
                if(count($ads) == 0):
                ?>
                    <div class="col-12 col-md-6">
                        <div class="alert alert-danger" role="alert">
                            Trenutno nema oglasa.
                        </div>
                    </div>

                <?php
                endif;
                ?>
            </div>

            <nav aria-label="Page navigation example" class="d-flex flex-row align-items-center justify-content-center mt-3" >
                <ul class="pagination" id="ads-pagination">

                    <?php
                    for ($i = 0;$i < ceil($adCount->count/6);$i++):
                    ?>
                    <li style="cursor: pointer" class="page-item ads-page-link-wrap
                        <?php
                        if($i == 0) echo 'active';
                        ?>
                    "><a class="page-link ads-page-link" data-page="<?=$i?>"><?=$i+1?></a></li>
                    <?php
                    endfor;
                    ?>
                </ul>
            </nav>
        </div>
    </div>
</div>

<script src="assets/js/adds.js"></script>