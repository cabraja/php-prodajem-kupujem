<?php
include ("views/fixed/adminNav.php");

$ads = getAdsAdmin();
?>
<div class="container my-4">

    <div class="alert alert-info alert-animation" id="adsAlert" role="alert" style="display: none">
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Naziv</th>
            <th scope="col">Cena (RSD)</th>
            <th scope="col">Datum</th>
            <th scope="col">Kategorija</th>
            <th scope="col">Korisnik</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody id="adsTable">
        <?php
        foreach ($ads as $a):
            ?>
            <tr>
                <th scope="row"><?=$a->id?></th>
                <td><?=$a->ad_name?></td>
                <td><?=$a->price?></td>
                <td><?=date('j.n.Y',strtotime($a->date))?></td>
                <td><?=$a->category_name?></td>
                <td><?=$a->username?></td>
                <td><a href="index.php?page=editAd&id=<?=$a->id?>" class="btn btn-info text-white">Izmeni</a></td>
                <td><button type="button" data-id="<?=$a->id?>" class="btn btn-danger btnDeleteAd">Obriši</button></td>
            </tr>
        <?php
        endforeach;
        ?>
        </tbody>
    </table>
</div>

<script src="assets/js/admin.js"></script>