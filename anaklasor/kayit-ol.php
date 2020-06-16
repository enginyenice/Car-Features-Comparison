<!doctype html>
<html lang="tr">
<title>Kayıt Ol</title>
<?php include("./assets/head.php"); ?>

<body class="bg-light mt-4">
<?php include("./assets/alert.php"); ?>
    <div class="container-fluid">
        <h2 class="title text-center mt-3 pb-2 pt-5">Araba Karşılaştır</h2>
        <div class="login mx-auto p-3 col col-xl-6 col-lg-7 col-md-8 col-10 col-sm-12 border border-secondary rounded">

            <form action="./controller/Account.php" method="POST">
                <h3 class="title text-center">Kayıt Ol</h3>
                <div class="form-group email">
                    <label>Ad Soyad:</label>
                    <input class="form-control" name="adSoyad" type="text">
                </div>
                <div class="form-group email">
                    <label>Eposta:</label>
                    <input class="form-control" name="eposta" type="email">
                </div>
                <div class="form-group password">
                    <label>Şifre:</label>
                    <input class="form-control" name="sifre" type="password">
                </div>
                <div class="form-group password">
                    <label>Şifre Tekrar:</label>
                    <input class="form-control" name="sifre2" type="password">
                </div>
                <div class="text-right buttons">

                    <button class="btn btn-sm btn-primary">Kayit Ol</button>
                    <input type="hidden" name="kayitOl">
                    <a href="./giris.php" class="btn btn-sm btn-danger">Geri</a>
                </div>

            </form>
        </div>


    </div>

    <?php include("./assets/script.php");?>
</body>

</html>