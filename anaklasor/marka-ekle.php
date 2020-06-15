<!doctype html>
<html lang="tr">
<title>Marka Ekle</title>
<?php
include("./assets/head.php");
include("./assets/nav.php");

?>

<body class="">


    <?php include("./assets/alert.php"); ?>
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                Marka Ekle
            </div>
            <div class="card-body">
                <form action="./controller/Marka.php" class="mt-2" method="POST">
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