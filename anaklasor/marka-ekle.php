<!doctype html>
<html lang="tr">
<title>Marka Ekle</title>
<?php
include("./assets/head.php");
include("./assets/nav.php");


if (isset($_GET['bilgi'])) {

    switch ($_GET['bilgi']) {
        case 'ayniMarka':
            $message = "Bu marka adı zaten kayıtlı";
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
                Marka Ekle
            </div>
            <div class="card-body">
                <form action="./controller/Marka.php" class="mt-2" method="POST">
                    <?php
                    if (isset($_GET['bilgi'])) { ?>

                        <div class="alert alert-<?= $status ?> alert-dismissible fade show" role="alert">
                            <strong><?= $message ?></strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>


                    <?php } ?>

                    <div class="form-group">
                        <label>Marka:</label>
                        <input class="form-control" name="marka" required type="text">
                    </div>

                    <div class="text-right buttons">
                        <input type="hidden" name="markaEkle">
                        <button class="btn btn-sm btn-primary">Ekle</button>
                        <a href="marka-listesi.php" class="btn btn-sm btn-danger">Geri</a>
                    </div>

                </form>
            </div>
        </div>
    </div>


    <?php
    include("./assets/footer.php");
    include("./assets/script.php")
    ?>

</body>

</html>