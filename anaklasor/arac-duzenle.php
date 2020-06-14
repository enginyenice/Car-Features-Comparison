<!doctype html>
<html lang="tr">
<title>Arac Ekle</title>
<?php
include("./assets/head.php");
include("./assets/nav.php");


if (isset($_GET['id'])) {

    $aracVarMiSor = $db->prepare("SELECT count(*) Adet FROM arac WHERE id=:id");
    $aracVarMiCek = $aracVarMiSor->execute(array(
        "id" => $_GET['id']
    ));
    $aracVarMiCek = $aracVarMiSor->fetch(PDO::FETCH_ASSOC);
    if ($aracVarMiCek['Adet'] > 0) {
        $aracSor = $db->prepare("SELECT * FROM arac WHERE id=:id");
        $aracCek = $aracSor->execute(array(
            "id" => $_GET['id']
        ));
        $aracCek = $aracSor->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location: /araba-karsilastirma/anaklasor/arac-listesi.php?bilgi=aracYok");
    }
} else {
    header("Location: /araba-karsilastirma/anaklasor/arac-listesi.php");
}


if (isset($_GET['bilgi'])) {

    switch ($_GET['bilgi']) {
        case 'ayniArac':
            $message = "Bu Arac adı zaten kayıtlı";
            $status = "warning";
            break;
        case 'resimBuyuk':
            $message = "Resim boyutu 10MB büyük olamaz";
            $status = "warning";
            break;
        case 'JPG':
            $message = "Resim uzantısı JPG olmalıdır.";
            $status = "warning";
            break;
        case 'bilinmeyen':
            $message = "Daha sonra tekrar deneyiniz.";
            $status = "danger";
            break;
    }
}



?>

<body class="">



    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Arac Düzenle
            </div>
            <div class="card-body">
                <?php
                if (isset($_GET['bilgi'])) { ?>

                    <div class="alert alert-<?= $status ?> alert-dismissible fade show" role="alert">
                        <strong><?= $message ?></strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                <?php } ?>
                <form action="./controller/Arac.php" class="mt-2" method="POST" enctype="multipart/form-data">
                    <div class="row">
                    <div class="col col-md-5">
                        <img class="rounded" width="300px" src="<?=$aracCek['resim']?>" alt="">
                    </div>
                    <div class="col col-md-7 form-group">
                            <label>Yeni Resim:</label>
                            <div class="custom-file">
                                <input type="file" name="resim" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Resim Seç</label>
                            </div>
                        </div>
                    </div>
                    <div class="text-right">
                        <input type="hidden" name="resimDuzenle" value="<?=$aracCek['id']?>">
                        <button type="submit" class="btn btn-primary">Resim Yükle</button>
                    </div>
                </form>
                <hr>

                <form action="./controller/Arac.php" class="mt-2" method="POST">
                    <div class="row">
                        <div class="col col-md-6 form-group">
                            <label>Marka:</label>
                            <div class="form-group">
                                <?php
                                $markaSor = $db->prepare("SELECT * FROM  marka");
                                $markaSor->execute();
                                ?>
                                <select onchange="modelGetir(<?= $aracCek['model_id'] ?>)" id="marka" name="marka_id" class="form-control">

                                    <?php while ($markaCek = $markaSor->fetch(PDO::FETCH_ASSOC)) { ?> ?>
                                        <option value="<?= $markaCek['id'] ?>" <?= ($aracCek['marka_id'] == $markaCek['id']) ? "selected" : ""  ?>><?= $markaCek['marka'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col col-md-6 form-group">
                            <label>Arac:</label>
                            <select id="model" name="model_id" class="form-control">

                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-md-3 form-group">
                            <label>Yıl:</label>
                            <div class="form-group">
                                <input class="form-control" value="<?= $aracCek['yil']; ?>" type="number" name="yil" min=1990 max=2020 id="">
                            </div>
                        </div>
                        <div class="col col-md-3 form-group">
                            <label>Ağırlık (Ton):</label>
                            <div class="form-group">
                                <input class="form-control" type="number" value="<?= $aracCek['agirlik']; ?>" name="agirlik" step=0.1 min=0 max=100 id="">
                            </div>
                        </div>
                        <div class="col col-md-3 form-group">
                            <label>Motor Hacmi (HP):</label>
                            <div class="form-group">
                                <input class="form-control" type="number" value="<?= $aracCek['motorHacmi']; ?>" name="motorHacmi" min=0 max=100 id="">
                            </div>
                        </div>

                        <div class="col col-md-3 form-group">
                            <label>Teker Sayısı:</label>
                            <div class="form-group">
                                <input class="form-control" type="number" value="<?= $aracCek['tekerSayisi']; ?>" name="tekerSayisi" min=0 max=20 id="">
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col col-md-3 form-group">
                            <label>Max Hız:</label>
                            <div class="form-group">
                                <input class="form-control" type="number" value="<?= $aracCek['maxHiz']; ?>" name="maxHiz" min=0 max=500 id="">
                            </div>
                        </div>
                        <div class="col col-md-3 form-group">
                            <label>Vites:</label>
                            <div class="form-group">
                                <input class="form-control" type="number" value="<?= $aracCek['vites']; ?>" name="vites" min=0 max=10 id="">
                            </div>
                        </div>

                        <div class="col col-md-3 form-group">
                            <label>Renk:</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="renk" value="<?= $aracCek['renk']; ?>" placeholder="Beyaz">
                            </div>
                        </div>
                        <div class="col col-md-3 form-group">
                            <label>Yakıt Türü:</label>
                            <div class="form-group">
                                <input class="form-control" type="text" name="yakitTuru" value="<?= $aracCek['yakitTuru']; ?>" placeholder="Benzin">
                            </div>
                        </div>
                    </div>


                    <div class="text-right buttons">
                        <input type="hidden" name="aracDuzenle" value="<?=$aracCek['id']?>">
                        <button class="btn btn-sm btn-primary">Güncelle</button>
                        <a href="Arac-listesi.php" class="btn btn-sm btn-danger">Geri</a>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <?php
    include("./assets/footer.php");
    include("./assets/script.php")
    ?>

    <script>
        modelGetir(<?= $aracCek['model_id'] ?>);

        function modelGetir(id) {
            var x = document.getElementById("marka").value;
            $('#model').empty();
            PostData = {
                "id": x,
                "modelGetirPost": true
            }
            $.ajax({
                type: "POST",
                url: "./controller/Arac.php",
                data: PostData,
                success: function(data) {
                    var veri = JSON.parse(data);
                    veri.forEach(element => {
                        var option = document.createElement("option");
                        $('#model')
                            .append(`<option value="${element['id']}" ${(element['id'] == id)? "selected":""} >${element['model']}</option>`);

                    });
                }



            });
        }
    </script>

</body>

</html>