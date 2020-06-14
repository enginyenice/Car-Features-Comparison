<!doctype html>
<html lang="tr">
<title>Anasayfa</title>
<?php include("./assets/head.php") ?>
<?php include("./assets/nav.php") ?>

<?php


if (isset($_GET['bilgi'])) {

    switch ($_GET['bilgi']) {
        case 'kayit':
            $message = "Marka başarıyla oluşturuldu.";
            $status = "success";
            break;
        case 'duzenleme':
            $message = "Marka başarıyla güncellendi.";
            $status = "success";
            break;
        case 'sil':
            $message = "Marka başarıyla silindi.";
            $status = "success";
            break;
        case 'markaYok':
            $message = "Duzenlemek istediginiz marka sistemde kayıtlı değil.";
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
    $markaSor = $db->prepare("SELECT * FROM  marka WHERE marka LIKE '%" . $text . "%'");
    $markaSor->execute();
} else {
    $markaSor = $db->prepare("SELECT * FROM  marka");
    $markaSor->execute();
}


?>


<body class="">



    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h3>Marka Listesi</h3>
                    <div class="ekle text-right mt-2">
                        <a href="marka-ekle.php" class="btn btn-sm btn-primary">Marka Ekle</a>
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
                                <option value="marka" selected>Marka</option>
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
                            <th width=100>Düzenle</th>
                            <th width=100>Sil</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($markaCek = $markaSor->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td><?= $markaCek['id'] ?></td>
                                <td><?= $markaCek['marka'] ?></td>
                                <td><a href="marka-duzenle.php?id=<?= $markaCek['id'] ?>" class="btn btn-success">Düzenle</a></td>
                                <td><button class="btn btn-danger" onclick="silBtn(<?= $markaCek['id'] ?>,'<?= $markaCek['marka'] ?>')">Sil</button></td>
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
                    title: "Marka sil",
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
                        window.location = `controller/Marka.php?sil=${id}`
                    }
                })
        }
    </script>

</body>

</html>