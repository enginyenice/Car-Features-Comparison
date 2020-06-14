<!doctype html>
<html lang="tr">
<title>Araç Listesi</title>
<?php include("./assets/head.php") ?>
<?php include("./assets/nav.php") ?>

<?php


if (isset($_GET['bilgi'])) {

    switch ($_GET['bilgi']) {
        case 'kayit':
            $message = "Arac başarıyla oluşturuldu.";
            $status = "success";
            break;
        case 'duzenleme':
            $message = "Arac başarıyla güncellendi.";
            $status = "success";
            break;
        case 'sil':
            $message = "Arac başarıyla silindi.";
            $status = "success";
            break;
        case 'AracYok':
            $message = "Duzenlemek istediginiz Arac sistemde kayıtlı değil.";
            $status = "warning";
            break;
        
        case 'resimDuzenle':
            $message = "Araç resmi başarıyla değiştirildi.";
            $status = "success";
            break;
        
        case 'bilinmeyen':
            $message = "Beklenmedik bir hata oluştu.";
            $status = "danger";
            break;
    }
}

if (isset($_GET['text']) && !empty($_GET['text'])) {
    $text = $_GET['text'];
    $tur = $_GET['tur'];
    if ($tur == "yil") {
        $AracSor = $db->prepare('SELECT arac.id AS "AracID", arac.resim, arac.yil, arac.agirlik, arac.motorHacmi, arac.tekerSayisi, arac.maxHiz, arac.vites, arac.renk, arac.yakitTuru, marka.id AS "MarkaID", marka.marka,model.id AS "modelID", model.model  FROM arac INNER JOIN model ON model.id = arac.model_id INNER JOIN marka ON marka.id = arac.marka_id WHERE yil=' . $yil . '');
        $AracSor->execute();
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



    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>Araç Listesi</h3>
                    <div class="ekle text-right mt-2">
                        <a href="Arac-ekle.php" class="btn btn-sm btn-primary">Arac Ekle</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="container">
                    <?php if (isset($_GET['bilgi'])) { ?>

                        <div class="alert alert-<?= $status ?> alert-dismissible fade show" role="alert">
                            <strong><?= $message ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                    <?php } ?>

                </div>

                <form method="GET">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" name="text" class="form-control" placeholder="Arama girişi">
                        </div>
                        <div class="form-group col-md-4">
                            <?php if (isset($_GET['text'])) { ?>

                                <select id="inputState" name="tur" class="form-control">
                                    <option value="marka" <?=($tur == "marka")? "selected": "" ?>>Marka</option>
                                    <option value="model" <?=($tur == "model")? "selected": "" ?>>Model</option>
                                    <option value="yil" <?=($tur == "yil")? "selected": "" ?> >Yıl</option>
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
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>Seç</th>
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
                                <td><input type="checkbox" name="aracSecim" value="<?= $AracCek['AracID'] ?>">
                                <td><img class="rounded" width="200px" src="<?= $AracCek['resim'] ?>" alt="" srcset=""></td>
                                <td><?= $AracCek['yil'] ?></td>
                                <td><?= $AracCek['renk'] ?></td>
                                <td><?= $AracCek['marka'] ?></td>
                                <td><?= $AracCek['model'] ?></td>
                                <td><a href="Arac-duzenle.php?id=<?= $AracCek['AracID'] ?>" class="btn btn-success">Düzenle</a></td>
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