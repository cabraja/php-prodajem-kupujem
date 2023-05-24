<?php
include ("views/fixed/adminNav.php");

$cats = getCategoriesAdmin();

?>
<div class="container my-4">

    <div class="alert alert-info alert-animation" id="categoryAlert" role="alert" style="display: none">
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Naziv</th>
            <th scope="col">Broj oglasa u kategoriji</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody id="catsTable">
        <?php
        foreach ($cats as $c):
            ?>
            <tr>
                <th scope="row"><?=$c->id?></th>
                <td><?=$c->category_name?></td>
                <td><?=$c->adCount?></td>
                <td><a href="index.php?page=editCategory&id=<?=$c->id?>" class="btn btn-info text-white">Izmeni</a></td>
                <td><button type="button" data-id="<?=$c->id?>" class="btn btn-danger btnDeleteCat">Obriši</button></td>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
</div>

<script src="assets/js/admin.js"></script>