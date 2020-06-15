<!doctype html>
<html lang="tr">
<title>Model Duzenle</title>
<?php
include("./assets/head.php");
include("./assets/nav.php");
if (isset($_GET['id'])) {

    $modelVarMiSor = $db->prepare("SELECT count(*) Adet FROM model WHERE id=:id");
    $modelVarMiCek = $modelVarMiSor->execute(array(
        "id" => $_GET['id']
    ));
    $modelVarMiCek = $modelVarMiSor->fetch(PDO::FETCH_ASSOC);
    if ($modelVarMiCek['Adet'] > 0) {
        $modelSor = $db->prepare("SELECT * FROM model WHERE id=:id");
        $modelCek = $modelSor->execute(array(
            "id" => $_GET['id']
        ));
        $modelCek = $modelSor->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location: /araba-karsilastirma/anaklasor/model-listesi.php?bilgi=modelYok");
    }
} else {
    header("Location: /araba-karsilastirma/anaklasor/model-listesi.php");
}






?>

<body class="">

<?php include("./assets/alert.php"); ?>

    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Model Duzenle
            </div>
            <div class="card-body">
                <form action="./controller/Model.php" class="mt-2" method="POST">
                    <div class="form-group">
                        <label>Marka:</label>
                        <div class="form-group">
                            <?php
                            $markaSor = $db->prepare("SELECT * FROM  marka");
                            $markaSor->execute();
                            ?>
                            <select id="inputState" name="marka_id" class="form-control">

                                <?php while ($markaCek = $markaSor->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?= $markaCek['id'] ?>" <?= ($modelCek['marka_id'] == $markaCek['id'])? "selected": ""  ?> ><?= $markaCek['marka'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Model:</label>
                        <input class="form-control" name="model" value="<?=$modelCek['model']?>" required type="text">
                    </div>

                    <div class="text-right buttons">
                        <input type="hidden" name="modelDuzenle" value="<?=$modelCek['id']?>">
                        <button class="btn btn-sm btn-primary">Duzenle</button>
                        <a href="model-listesi.php" class="btn btn-sm btn-danger">Geri</a>
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