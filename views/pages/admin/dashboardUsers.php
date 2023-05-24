<?php
    include ("views/fixed/adminNav.php");

    $users = getUsers();
?>
<div class="container my-4">

    <div class="alert alert-info alert-animation" id="usersAlert" role="alert" style="display: none">
    </div>

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Korisničko Ime</th>
            <th scope="col">Email</th>
            <th scope="col">Telefon</th>
            <th scope="col">Uloga</th>
            <th scope="col">Datum reg.</th>
            <th scope="col"></th>
        </tr>
        </thead>
        <tbody id="usersTable">
        <?php
        foreach ($users as $u):
        ?>
            <tr>
                <th scope="row"><?=$u->id?></th>
                <td><?=$u->username?></td>
                <td><?=$u->email?></td>
                <td><?=$u->phone?></td>
                <td><?=$u->role?></td>
                <td><?=date('j.n.Y',strtotime($u->created_at))?></td>
                <td><button type="button" data-id="<?=$u->id?>" class="btn btn-danger btnDeleteUser">Obriši</button></td>
            </tr>
        <?php
            endforeach;
        ?>
        </tbody>
    </table>
</div>

<script src="assets/js/admin.js"></script>