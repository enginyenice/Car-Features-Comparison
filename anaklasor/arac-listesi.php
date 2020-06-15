<?php include("./assets/session.php"); ?>
<!doctype html>
<html lang="tr">
<title>Araç Listesi</title>
<?php include("./assets/head.php") ?>
<?php include("./assets/nav.php") ?>

<?php

$karsilastirmaLenght = $_COOKIE['karsilastirma'];

    //var_dump($karsilastirmaData);
    $dilimlerLenght = explode("[", $karsilastirmaLenght);
    $datalarLenght = explode("]", $dilimlerLenght[1]);


    $dataLenght = explode(",", $datalarLenght[0]);



function varMi($id)
{
    $karsilastirmaData = $_COOKIE['karsilastirma'];

    //var_dump($karsilastirmaData);
    $dilimler = explode("[", $karsilastirmaData);
    $datalar = explode("]", $dilimler[1]);


    $data = explode(",", $datalar[0]);
    //var_dump($data);
    for ($i = 0; $i < count($data); $i++) {
        if($data[$i] == $id)
            return 1;
    }
    return 0;
}

if (isset($_GET['text']) && !empty($_GET['text'])) {
    $text = $_GET['text'];
    $tur = $_GET['tur'];
    if ($tur == "yil") {
        $AracSor = $db->prepare('SELECT arac.id AS "AracID", arac.resim, arac.yil, arac.agirlik, arac.motorHacmi, arac.tekerSayisi, arac.maxHiz, arac.vites, arac.renk, arac.yakitTuru, marka.id AS "MarkaID", marka.marka,model.id AS "modelID", model.model  FROM arac INNER JOIN model ON model.id = arac.model_id INNER JOIN marka ON marka.id = arac.marka_id WHERE yil=:yil');
        $AracSor->execute(array(
            "yil"   => $text
        ));
    }
    if ($tur == "marka") {
        $AracSor = $db->prepare('SELECT arac.id AS "AracID", arac.resim, arac.yil, arac.agirlik, arac.motorHacmi, arac.tekerSayisi, arac.maxHiz, arac.vites, arac.renk, arac.yakitTuru, marka.id AS "MarkaID", marka.marka,model.id AS "modelID", model.model  FROM arac INNER JOIN model ON model.id = arac.model_id INNER JOIN marka ON marka.id = arac.marka_id WHERE marka LIKE "%' . $text . '%"');
        $AracSor->execute();
    }
    if ($tur == "model") {
        $AracSor = $db->prepare('SELECT arac.id AS "AracID", arac.resim, arac.yil, arac.agirlik, arac.motorHacmi, arac.tekerSayisi, arac.maxHiz, arac.vites, arac.renk, arac.yakitTuru, marka.id AS "MarkaID", marka.marka,model.id AS "modelID", model.model  FROM arac INNER JOIN model ON model.id = arac.model_id INNER JOIN marka ON marka.id = arac.marka_id WHERE model.model LIKE "%' . $text . '%"');
        $AracSor->execute();
    }
} else {
    $AracSor = $db->prepare('SELECT arac.id AS "AracID", arac.resim, arac.yil, arac.agirlik, arac.motorHacmi, arac.tekerSayisi, arac.maxHiz, arac.vites, arac.renk, arac.yakitTuru, marka.id AS "MarkaID", marka.marka,model.id AS "modelID", model.model  FROM arac INNER JOIN model ON model.id = arac.model_id INNER JOIN marka ON marka.id = arac.marka_id');
    $AracSor->execute();
}


?>


<body class="">


<?php include("./assets/alert.php") ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>Araç Listesi</h3>
                    <div class="ekle text-right mt-2">
                        <a href="arac-ekle.php" class="btn btn-sm btn-primary">Arac Ekle</a>
                        <a id="karsilastirmaBtn" href="karsilastir.php" class="btn btn-sm btn-success">Karşılaştırma (<?php
                        if($dataLenght[0] > 0)
                        {
                            echo count($dataLenght);
                        } else {
                            echo 0;
                        }
                        
                        ?>)</a>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <form method="GET">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" name="text" class="form-control" placeholder="Arama girişi">
                        </div>
                        <div class="form-group col-md-4">
                            <?php if (isset($_GET['text'])) { ?>

                                <select id="inputState" name="tur" class="form-control">
                                    <option value="marka" <?= ($tur == "marka") ? "selected" : "" ?>>Marka</option>
                                    <option value="model" <?= ($tur == "model") ? "selected" : "" ?>>Model</option>
                                    <option value="yil" <?= ($tur == "yil") ? "selected" : "" ?>>Yıl</option>
                                </select>

                            <?php } else { ?>
                                <select id="inputState" name="tur" class="form-control">
                                    <option value="marka">Marka</option>
                                    <option value="model">Model</option>
                                    <option value="yil" selected>Yıl</option>
                                </select>

                            <?php } ?>

                        </div>
                        <div class="form-group col-md-2">
                            <button class="btn btn-primary">Arama Yap</button>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_GET['text']) && !empty($_GET['text'])) {
                    echo "Aranan: " . $text;
                }
                ?>

                <div class="table-responsive mt-3">
                </div>
                <table class="table text-center table-hover table-bordered">
                    <thead>
                        <tr>
                            <th width=50>Seç</th>
                            <th width=200>Resim</th>
                            <th>Yıl</th>
                            <th>Renk</th>
                            <th>Marka</th>
                            <th>Model</th>
                            <th width=100>Düzenle</th>
                            <th width=100>Sil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($AracCek = $AracSor->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><input style=" width: 20px; height: 20px;" id="Check<?= $AracCek['AracID'] ?>" type="checkbox" onchange="karsilastirmaEkle(<?= $AracCek['AracID'] ?>)" name="aracSecim" 
                                value="<?= $AracCek['AracID'] ?>" 
                                <?php 
                                $donut = varMi($AracCek['AracID']);
                                if($donut == 1)
                                {
                                    echo "checked";
                                }
                                ?>
                                >
                                <td><img class="rounded" width="200px" height="100" src="<?= $AracCek['resim'] ?>" alt="" srcset=""></td>
                                <td><?= $AracCek['yil'] ?></td>
                                <td><?= $AracCek['renk'] ?></td>
                                <td><?= $AracCek['marka'] ?></td>
                                <td><?= $AracCek['model'] ?></td>
                                <td><a href="arac-duzenle.php?id=<?= $AracCek['AracID'] ?>" class="btn btn-success">Düzenle</a></td>
                                <td><button class="btn btn-danger" onclick="silBtn(<?= $AracCek['AracID'] ?>,'<?= $AracCek['Arac'] ?>')">Sil</button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div>
    </div>


    <?php
    include("./assets/footer.php");
    include("./assets/script.php")
    ?>
    <script>
        function karsilastirmaEkle(id, checkID) {
            var input = document.getElementById("Check" + id);
            var btn = document.getElementById("karsilastirmaBtn");
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
            if (input.checked) {
                if (myData.length > 4) {
                    swal({
                        title: "Arac karşılaştırma",
                        text: `Seçilen araç sayısı maksimum 5 olabilir`,
                        icon: "warning"
                    });
                } else {
                    myData.push(id);
                }



            } else {
                let index;
                for (let i = 0; i < myData.length; i++) {
                    if (myData[i] == id)
                        index = i;
                }
                myData.splice(index, 1);
            }

            //localStorage.setItem("karsilastirma", JSON.stringify(myData));
            //alert(JSON.stringify(myData))
            // $.cookie("karsilastirma", JSON.stringify(myData));
            $.cookie("karsilastirma", JSON.stringify(myData));
            console.log($.cookie("karsilastirma"));
            btn.innerText = `Karşılaştırma (${myData.length})`;
        }


        function silBtn(id, title) {
            swal({
                    title: "Arac sil",
                    text: `${title}'yi silmek istiyor musunuz?`,
                    icon: "warning",
                    buttons: true,
                    buttons: {
                        cancel: "Hayır",
                        ok: "Evet"
                    },
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location = `controller/Arac.php?sil=${id}`
                    }
                })
        }
    </script>

</body>

</html>