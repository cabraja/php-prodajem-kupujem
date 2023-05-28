<?php
include ("views/fixed/adminNav.php");

//PRISTUPANJE FAJLOVIMA
$file = fopen("data/pageVisits.txt","r");
$fileData = file("data/pageVisits.txt");

$fileLogin = fopen("data/logins.txt","r");
$fileLoginData = file("data/logins.txt");


$arrPages = array();
$arrCount =array();

// BROJ PRISTUPA STRANICAMA
foreach ($fileData as $data){
    $visit = explode("|", $data);
    $time = intval($visit[1]);
    $time_now = time();

    if(($time_now -$time) < 86400){
        $page = $visit[0];
        $ip = $visit[2];
        $role = $visit[3];

        $newPage = true;
        foreach ($arrPages as $key => $value){
            if($value == $page){
                $arrCount[$key]++;
                $newPage = false;
                break;
            }
        }

        if($newPage){
            array_push($arrPages, $page);
            array_push($arrCount, 1);
        }
    }
}

$arrPagesPercent = array();
$arrCountPercent =array();

//PROCENAT PRISTUPA
foreach ($fileData as $data){
    $visit = explode("|", $data);
    $page = $visit[0];

    $newPage = true;
    foreach ($arrPagesPercent as $key => $value){
        if($value == $page){
            $arrCountPercent[$key]++;
            $newPage = false;
            break;
        }
    }

    if($newPage){
        array_push($arrPagesPercent, $page);
        array_push($arrCountPercent, 1);
    }
}

$logCount = 0;

//BROJ LOGOVANJA
foreach ($fileLoginData as $data){
    $login = explode("|", $data);
    $time = intval($login[2]);
    $time_now = time();

    if(($time_now -$time) < 86400){
        $logCount++;
    }
}




?>

<div class="container mt-4 mb-5">
    <h2 class="fw-bold">Pristup stranicama (zadnja 24 sata)</h2>
    <hr />

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Stranica</th>
            <th scope="col">Broj Pristupa</th>
        </tr>
        </thead>
        <tbody>

        <?php
        foreach ($arrPages as $key => $value):
        ?>

        <tr>
            <td><?=$value?></td>
            <td><?=$arrCount[$key]?></td>
        </tr>

        <?php
        endforeach;
        ?>
        </tbody>
    </table>

    <br />

    <h2 class="fw-bold">Pristup stranicama (%)</h2>
    <hr />

    <table class="table table-striped">
        <thead>
        <tr>
            <th scope="col">Stranica</th>
            <th scope="col">Procenat pristupa</th>
        </tr>
        </thead>
        <tbody>

        <?php
        $totalVisits = array_sum($arrCountPercent);
        foreach ($arrPagesPercent as $key => $value):
            ?>

            <tr>
                <td><?=$value?></td>
                <td><?=round(($arrCountPercent[$key]*100)/$totalVisits)?>%</td>
            </tr>

        <?php
        endforeach;
        ?>
        </tbody>
    </table>

    <br />

    <h2 class="fw-bold">Broj logovanja (zadnja 24 sata)</h2>
    <hr />
    <p class="fs-4"><?=$logCount?> logovanja</p>
</div>

