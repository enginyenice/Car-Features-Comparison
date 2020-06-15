<!doctype html>
<html lang="tr">
<title>Marka Ekle</title>
<?php
include("./assets/head.php");
include("./assets/nav.php");

if (isset($_GET['id'])) {

    $markaVarMiSor = $db->prepare("SELECT count(*) Adet FROM marka WHERE id=:id");
    $markaVarMiCek = $markaVarMiSor->execute(array(
        "id" => $_GET['id']
    ));
    $markaVarMiCek = $markaVarMiSor->fetch(PDO::FETCH_ASSOC);
    if ($markaVarMiCek['Adet'] > 0) {
        $markaSor = $db->prepare("SELECT * FROM marka WHERE id=:id");
        $markaCek = $markaSor->execute(array(
            "id" => $_GET['id']
        ));
        $markaCek = $markaSor->fetch(PDO::FETCH_ASSOC);
    } else {
        header("Location: /araba-karsilastirma/anaklasor/marka-listesi.php?bilgi=markaYok");
    }
} else {
    header("Location: /araba-karsilastirma/anaklasor/marka-listesi.php");
}

?>

<body class="">


<?php include("./assets/alert.php"); ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Marka Duzenle
            </div>
            <div class="card-body">
                <form action="./controller/Marka.php" class="mt-2" method="POST">

                    <div class="form-group">
                        <label>Marka:</label>
                        <input class="form-control" name="marka" value="<?=$markaCek['marka']?>" required type="text">
                    </div>

                    <div class="text-right buttons">
                        <input type="hidden" name="markaDuzenle" value="<?=$markaCek['id']?>">
                        <button class="btn btn-sm btn-primary">Düzenle</button>
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