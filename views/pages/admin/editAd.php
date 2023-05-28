<?php
include ("views/fixed/adminNav.php");

$id = 0;

if(isset($_GET['id'])){
    $id = $_GET['id'];
}


if($ad = getAd($id)):
    ?>
    <div class="container my-5">
        <div class="row d-flex flex-row align-items-center justify-content-center">
            <div class="col-12 col-md-7">

                <div class="alert alert-info alert-animation mt-2 mb-4" id="alertAd" role="alert" style="display:none;">

                </div>

                <h2 class="fw-bold">Izmeni Oglas</h2>
                <hr />

                <form class="mt-4">
                    <div class="mb-3">
                        <label for="ad_name" class="form-label">Naziv oglasa</label>
                        <input type="text" class="form-control" id="ad_name" name="ad_name" value="<?=$ad->ad_name?>">
                        <div class="form-text text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="price" class="form-label">Cena</label>
                        <input type="number" class="form-control" id="price" name="price" value="<?=$ad->price?>">
                        <div class="form-text text-danger"></div>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Opis oglasa</label>
                        <textarea class="form-control" id="description" name="description"><?=$ad->description?></textarea>
                        <div class="form-text text-danger"></div>
                    </div>

                    <?php
                    $cats = getAllCategories();
                    ?>
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategorija</label>
                        <select class="form-select" name="category" id="category">
                            <option selected value="0">Izaberite</option>
                            <?php
                            foreach ($cats as $cat):
                                ?>
                                <option
                                <?=$cat->id == $ad->catID ? "selected": "" ?>
                                value="<?=$cat->id?>"><?=$cat->category_name?></option>
                            <?php
                            endforeach;
                            ?>
                        </select>
                        <div class="form-text text-danger"></div>
                    </div>

                    <input type="hidden" name="id" id="id" value="<?=$id?>"/>
                    <button type="button" id="editAdBtn" class="btn btn-primary">Potvrdi izmenu</button>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/js/adminEdit.js"></script>
<?php
else:
    ?>
    <div class="container my-4">
        <div class="alert alert-warning" role="alert">
            Ova kategorija ne postoji.
        </div>
    </div>
<?php
endif;
?>

