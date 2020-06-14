<!doctype html>
<html lang="tr">
<title>Model Ekle</title>
<?php
include("./assets/head.php");
include("./assets/nav.php");


if (isset($_GET['bilgi'])) {

    switch ($_GET['bilgi']) {
        case 'ayniModel':
            $message = "Bu Model adı zaten kayıtlı";
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
                Model Ekle
            </div>
            <div class="card-body">
                <form action="./controller/Model.php" class="mt-2" method="POST">
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
                        <div class="form-group">
                            <?php
                            $markaSor = $db->prepare("SELECT * FROM  marka");
                            $markaSor->execute();
                            ?>
                            <select id="inputState" name="marka_id" class="form-control">
                               
                            <?php while ($markaCek = $markaSor->fetch(PDO::FETCH_ASSOC)) { ?> ?>
                             <option value="<?=$markaCek['id']?>" ><?=$markaCek['marka']?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Model:</label>
                        <input class="form-control" name="model" required type="text">
                    </div>

                    <div class="text-right buttons">
                        <input type="hidden" name="modelEkle">
                        <button class="btn btn-sm btn-primary">Ekle</button>
                        <a href="Model-listesi.php" class="btn btn-sm btn-danger">Geri</a>
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