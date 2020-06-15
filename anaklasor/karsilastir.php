<!doctype html>
<html lang="tr">
<title>Anasayfa</title>
<?php include("./assets/head.php") ?>
<?php include("./assets/nav.php") ?>
<?php

$karsilastirmaData = $_COOKIE['karsilastirma'];

//var_dump($karsilastirmaData);
$dilimler = explode("[", $karsilastirmaData);
$datalar = explode("]", $dilimler[1]);


$data = explode(",", $datalar[0]);
//var_dump($data);
$araclar = array();
for ($i = 0; $i < count($data); $i++) {
    array_push($araclar, $data[$i]);
}

if (count($araclar) <= 1) {
    header("Location: /araba-karsilastirma/anaklasor/arac-listesi.php?bilgi=secimYok");
}

?>

<body class="">



    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Karşılaştır
            </div>
            <div class="card-body">
            <?php
            for ($i = 0; $i < count($araclar); $i++) {
                $AracSor = $db->prepare('SELECT arac.id AS "AracID", marka.id AS "MarkaID", marka.marka,model.id AS "modelID", model.model FROM arac INNER JOIN model ON model.id = arac.model_id INNER JOIN marka ON marka.id = arac.marka_id WHERE arac.id=:id');
                $AracSor->execute(array(
                    "id"    => $araclar[$i]
                ));
                $AracCek = $AracSor->fetch(PDO::FETCH_ASSOC);
            ?>
            

                    <div class="col col-md-5 float-left ml-2 alert alert-warning alert-dismissible fade show" role="alert">
                        <strong><?=$AracCek['marka']." ".$AracCek['model']?></strong>
                        <button type="button" onclick="karsilastirSil(1)" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">Seçimi Kaldır &times;</span>
                        </button>
                    </div>




            <?php } ?>
        </div>
        </div>
    </div>


    <?php
    include("./assets/footer.php");
    include("./assets/script.php")
    ?>

    <script>
        function karsilastirSil(id) {
            alert("ok Kaldırıldı");
        }
    </script>
</body>

</html>