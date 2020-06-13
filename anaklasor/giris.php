<!doctype html>
<html lang="tr">

<?php include("./assets/head.php") ?>

<body class="bg-light mt-4">

    <div class="container-fluid">
        <h2 class="title text-center mt-3 pb-2 pt-5">Araba Karşılaştır</h2>
        <div class="login mx-auto p-3 col col-xl-6 col-lg-7 col-md-8 col-10 col-sm-12 border border-secondary rounded">

            <form>
                <h3 class="title text-center">Giriş Yap</h3>
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Hata Oluştu!</strong> Hata Mesajı
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="form-group email">
                    <label>Eposta:</label>
                    <input class="form-control" type="text">
                </div>
                <div class="form-group password">
                    <label>Şifre:</label>
                    <input class="form-control" type="password">
                    <div class="text-right">
                        <a href="./sifremi-unuttum.html">Şifremi unuttum</a>
                    </div>
                </div>

                <div class="text-right buttons">
                    <button class="btn btn-sm btn-primary">Giriş Yap</button>
                    <a href="./kayit-ol.php" class="btn btn-sm btn-danger">Kayıt Ol</a>
                </div>

            </form>
        </div>


    </div>



<?php include("./assets/script.php");?>
</body>

</html>