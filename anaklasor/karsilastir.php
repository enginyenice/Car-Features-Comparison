<?php
ob_start();
?>
<!doctype html>
<html lang="tr">
<title>Anasayfa</title>
<?php include("./assets/head.php") ?>
<?php include("./assets/nav.php") ?>
<?php

$karsilastirmaData = $_COOKIE['karsilastirma'];
$dilimler = explode("[", $karsilastirmaData);
$datalar = explode("]", $dilimler[1]);


$data = explode(",", $datalar[0]);

$araclar = array();
for ($i = 0; $i < count($data); $i++) {
    array_push($araclar, $data[$i]);
}

for ($i = 0; $i < count($araclar); $i++) {

    $AracSor = $db->prepare('SELECT arac.id AS "AracID", arac.*, marka.id AS "MarkaID", marka.marka,model.id AS "modelID", model.model FROM arac INNER JOIN model ON model.id = arac.model_id INNER JOIN marka ON marka.id = arac.marka_id WHERE arac.id=:id');
    $AracSor->execute(array(
        "id"    => $araclar[$i]
    ));
    $araclarData[$i] = $AracSor->fetch(PDO::FETCH_ASSOC);
}
if (count($araclarData) < 2  || $araclarData == NULL) {
    var_dump($araclarData[0]);
    header("Location: arac-listesi.php?bilgi=secimYok");
    //header("Location: https://www.google.com");
}

?>

<body class="">


<?php include("./assets/alert.php"); ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Karşılaştırılan Araçlar
            </div>
            <div class="card-body">
                <div class="container">
                <?php
                for ($i = 0; $i < count($araclar); $i++) {
                    $AracSor = $db->prepare('SELECT arac.id AS "AracID", marka.id AS "MarkaID", marka.marka,model.id AS "modelID", model.model FROM arac INNER JOIN model ON model.id = arac.model_id INNER JOIN marka ON marka.id = arac.marka_id WHERE arac.id=:id');
                    $AracSor->execute(array(
                        "id"    => $araclar[$i]
                    ));
                    $AracCek = $AracSor->fetch(PDO::FETCH_ASSOC);
                ?>


                    <div class="col col-md-12 col-lg-5  col-sm-12 col-12 col-xs-12 float-left ml-3 mr-4 alert alert-success alert-dismissible fade show" role="alert">
                        <strong><?= $AracCek['marka'] . " " . $AracCek['model'] ?></strong>
                        <button type="button" onclick="karsilastirSil(1)" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>




                <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid mt-2">
        <div class="card">
            <div class="card-header">
                Karşılaştırma
            </div>
            <div class="card-body table-responsive">
                <table class="table table-bordered" style="text-align: center;">

                    <tr class="header-fixed">
                        <th>Resim</th>
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><img class="rounded" src="<?=$araclarData[$i]['resim']?>" width="300" height="200"></td>
                        <?php } ?>
                    
                    </tr>
                    <tr class="sticky-top">
                        <th width=200>Marka</th>
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><?=$araclarData[$i]['marka']?></td>
                        <?php } ?>
                    </tr>

                    <tr>
                        <th>Model</th>
                        
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><?=$araclarData[$i]['model']?></td>
                        <?php } ?>
                    </tr>


                    <tr>
                        <th>Üretim Yılı</th>
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><?=$araclarData[$i]['yil']?></td>
                        <?php } ?>
                    </tr>


                    <tr>
                        <th>Ağırlık (Ton)</th>
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><?=$araclarData[$i]['agirlik']?></td>
                        <?php } ?>
                    </tr>

                    <tr>
                        <th>Motor Hacmi (HP)</th>
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><?=$araclarData[$i]['motorHacmi']?></td>
                        <?php } ?>
                    </tr>

                    <tr>
                        <th>Teker Sayısı</th>
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><?=$araclarData[$i]['tekerSayisi']?></td>
                        <?php } ?>
                    </tr>


                    <tr>
                        <th>Max Hız</th>
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><?=$araclarData[$i]['maxHiz']?></td>
                        <?php } ?>
                    </tr>


                    <tr>
                        <th>Vites</th>
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><?=$araclarData[$i]['vites']?></td>
                        <?php } ?>
                    </tr>


                    <tr>
                        <th>Renk</th>
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><?=$araclarData[$i]['renk']?></td>
                        <?php } ?>
                    </tr>


                    <tr>
                        <th>Yakıt Türü</th>
                        <?php
                        for ($i=0; $i < count($araclarData); $i++) { ?>
                            <td><?=$araclarData[$i]['yakitTuru']?></td>
                        <?php } ?>
                    </tr>



                </table>
            </div>
        </div>
    </div>


    <?php
    include("./assets/footer.php");
    include("./assets/script.php")
    ?>

    <script>
        function karsilastirSil(id) {
            console.log($.cookie("karsilastirma"));

            var myData = [];
            //data = localStorage.getItem("karsilastirma");
            data = $.cookie("karsilastirma");
            // alert($.cookie("karsilastirma"));

            //console.log(data)

            if (data != null || data != undefined) {
                data = JSON.parse(data);
                data.forEach(element => {
                    //console.log(element)
                    myData.push(element)
                });
            }

            let index;
            for (let i = 0; i < myData.length; i++) {
                if (myData[i] == id)
                    index = i;
            }
            myData.splice(index, 1);
            $.cookie("karsilastirma", JSON.stringify(myData));
            window.location.reload()
        }
    </script>
</body>

</html>