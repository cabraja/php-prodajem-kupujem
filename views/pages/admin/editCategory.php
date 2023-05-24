<?php
include ("views/fixed/adminNav.php");

$id = 0;

if(isset($_GET['id'])){
    $id = $_GET['id'];
}


if($cat = getCategory($id)):
?>
    <div class="container my-5">
        <div class="row d-flex flex-row align-items-center justify-content-center">
            <div class="col-12 col-md-7">
                <h2 class="fw-bold">Izmeni kategoriju</h2>
                <hr />
                <form class="mt-4">
                    <div class="mb-3">
                        <label for="category_name" class="form-label">Ime kategorije</label>
                        <input type="text" class="form-control" id="category_name" name="category_name" value="<?=$cat->category_name?>">
                        <div class="form-text text-danger"></div>
                    </div>
                    <button type="button" id="editCatBtn" class="btn btn-primary">Potvrdi izmenu</button>
                </form>
            </div>
        </div>
    </div>
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

