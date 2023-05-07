<div class="container my-5">

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

    <h2 class="fw-bold mt-5">Oglasi Koje Pratite</h2>
    <hr />
</div>

<script src="assets/js/adds.js"></script>