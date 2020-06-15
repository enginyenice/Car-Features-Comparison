<!doctype html>
<html lang="tr">
<title>Anasayfa</title>
<?php include("./assets/head.php") ?>
<?php include("./assets/nav.php") ?>

<?php


if (isset($_GET['bilgi'])) {

    switch ($_GET['bilgi']) {
        case 'kayit':
            $message = "Model başarıyla oluşturuldu.";
            $status = "success";
            break;
        case 'duzenleme':
            $message = "Model başarıyla güncellendi.";
            $status = "success";
            break;
        case 'sil':
            $message = "Model başarıyla silindi.";
            $status = "success";
            break;
        case 'ModelYok':
            $message = "Duzenlemek istediginiz Model sistemde kayıtlı değil.";
            $status = "warning";
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
    if ($tur == "marka") {
        $ModelSor = $db->prepare("SELECT model.id,model.model,model.marka_id, marka.marka FROM model    INNER JOIN marka ON marka.id = model.marka_id WHERE marka LIKE '%" . $text . "%'");
        $ModelSor->execute();
    }
    if ($tur == "model") {
        $ModelSor = $db->prepare("SELECT model.id,model.model,model.marka_id, marka.marka FROM model    INNER JOIN marka ON marka.id = model.marka_id WHERE model LIKE '%" . $text . "%'");
        $ModelSor->execute();
    }
} else {
    $ModelSor = $db->prepare("SELECT model.id,model.model,model.marka_id, marka.marka FROM model    INNER JOIN marka ON marka.id = model.marka_id");
    $ModelSor->execute();
}


?>


<body class="">



    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>Model Listesi</h3>
                    <div class="ekle text-right mt-2">
                        <a href="Model-ekle.php" class="btn btn-sm btn-primary">Model Ekle</a>
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
                            <select id="inputState" name="tur" class="form-control">
                                <option value="model" selected>Model</option>
                                <option value="marka">Marka</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <button class="btn btn-primary">Arama Yap</button>
                        </div>
                    </div>
                </form>
                <?php
                if (isset($_GET['text'])) {
                    echo "Aranan: " . $text;
                }
                ?>

                <div class="table-responsive mt-3">
                </div>
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Marka</th>
                            <th>Model</th>
                            <th width=100>Düzenle</th>
                            <th width=100>Sil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($ModelCek = $ModelSor->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?= $ModelCek['id'] ?></td>
                                <td><?= $ModelCek['marka'] ?></td>
                                <td><?= $ModelCek['model'] ?></td>
                                <td><a href="Model-duzenle.php?id=<?= $ModelCek['id'] ?>" class="btn btn-success">Düzenle</a></td>
                                <td><button class="btn btn-danger" onclick="silBtn(<?= $ModelCek['id'] ?>,'<?= $ModelCek['Model'] ?>')">Sil</button></td>
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
                    title: "Model sil",
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
                        window.location = `controller/Model.php?sil=${id}`
                    }
                })
        }
    </script>

</body>

</html>