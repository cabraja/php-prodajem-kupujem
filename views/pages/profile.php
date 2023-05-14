<div class="container my-5">

    <div class="alert alert-info alert-animation mb-4" role="alert" id="adAlert" style="display: none">

    </div>

    <h2 class="fw-bold">Dodajte Oglas</h2>
    <hr />

    <form>
        <div class="row">
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="name" class="form-label">Naziv Oglasa</label>
                    <input type="text" class="form-control" id="name" name="name">
                    <div class="form-text text-danger"></div>
                </div>
            </div>

            <?php
                $cats = getAllCategories();
            ?>
            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="category" class="form-label">Kategorija</label>
                    <select class="form-select" name="category" id="category">
                        <option selected value="0">Izaberite</option>
                        <?php
                        foreach ($cats as $cat):
                        ?>
                        <option value="<?=$cat->id?>"><?=$cat->category_name?></option>
                        <?php
                        endforeach;
                        ?>
                    </select>
                    <div class="form-text text-danger"></div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="price" class="form-label">Cena (u RSD)</label>
                    <input type="number" class="form-control" id="price" name="price">
                    <div class="form-text text-danger"></div>
                </div>
            </div>

            <div class="col-12 col-md-6">
                <div class="mb-3">
                    <label for="image" class="form-label">Fotografija</label>
                    <input class="form-control" type="file" id="image" name="image">
                    <div class="form-text text-danger"></div>
                </div>
            </div>

            <div class="col-12">
                <div class="mb-3">
                    <label for="description" class="form-label">Opis oglasa</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                    <div class="form-text text-danger"></div>
                </div>
            </div>

        </div>
        <button type="button" id="insertBtn" class="btn btn-primary px-5">Potvrdi</button>
    </form>

<!--    OGLASI KOJE KORISNIK PRATI-->
    <h2 class="fw-bold mt-5">Oglasi Koje Pratite</h2>
    <hr />

    <div class="row" id="followedAds">

        <?php
        $ads = getFollowedAds($_SESSION['user']->id);

        foreach ($ads as $ad):
        ?>
            <div class="col-12 my-2 border rounded py-2 px-4">
                <div class="w-100 d-flex flex-row align-items-center justify-content-between">
                    <div class="pe-3">
                        <h6 class="mb-0"><span class="text-secondary">Naziv:</span> <?=$ad->ad_name?> | <span class="text-secondary">Kategorija:</span> <?=$ad->category_name?> | <span class="text-secondary">Oglas zapraćen:</span> <?=date('j.n.Y',strtotime($ad->date))?></h6>
                    </div>

                    <button data-id="<?=$ad->id?>" type="button" class="btn btn-outline-danger unfollowBtn"><i class="fa-solid fa-xmark"></i></button>
                </div>
            </div>
        <?php
        endforeach;
        ?>

        <?php
        if(count($ads) == 0):
        ?>
            <div class="col-12">
                <div class="alert alert-danger" role="alert">
                    Ne pratite ni jedan oglas.
                </div>
            </div>
        <?php
        endif;
        ?>
    </div>
</div>

<script src="assets/js/adds.js"></script>