<?php include("./assets/session.php"); ?>
<!doctype html>
<html lang="tr">

<?php include("./assets/head.php");
?>
<title>Hesabım</title>
<?php include("./assets/nav.php") ?>

<body class="">

    <?php
    $kullaniciSor = $db->prepare("SELECT * FROM kullanici WHERE id=:id");
    $kullaniciCek = $kullaniciSor->execute(array(
        "id" => $_SESSION['id']
    ));
    $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
    include("./assets/alert.php");
    ?>
    <div class="container-fluid">
        <div class="row justify-content-md-center">
            <div class="col col-lg-6 col-md-6 col-12  col-sm-12 col-xs-12">
                <div class="card  mt-2 mb-2">
                    <div class="card-header">
                        Şifre Değiştir
                    </div>
                    <div class="card-body">
                        <form action="./controller/Account.php" method="POST">
                            <div class="form-group email">
                                <label>Geçerli Şifre:</label>
                                <input class="form-control" name="gecerliSifre" type="password">
                            </div>
                            <div class="form-group email">
                                <label>Yeni Şifre:</label>
                                <input class="form-control" name="sifre" type="password">
                            </div>
                            <div class="form-group email">
                                <label>Yeni Şifre Tekrar:</label>
                                <input class="form-control" name="sifreTekrar" type="password">
                            </div>
                            <div class="text-right buttons">
                                <input type="hidden" name="sifreGuncelle">
                                <button class="btn btn-sm btn-primary">Güncelle</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col col-lg-6 col-md-6 col-12 col-sm-12 col-xs-12">
                <div class="card mt-2 mb-2">
                    <div class="card-header">
                        Hesap Bilgilerini Düzenle
                    </div>
                    <div class="card-body">
                        <form action="./controller/Account.php" method="POST">
                            <div class="form-group email">
                                <label>Ad Soyad:</label>
                                <input class="form-control" name="adSoyad" value="<?= $kullaniciCek['adSoyad']; ?>" type="text">
                            </div>
                            <div class="form-group email">
                                <label>Eposta:</label>
                                <input class="form-control" name="eposta" value="<?= $kullaniciCek['eposta']; ?>" type="email">
                            </div>
                            <div class="form-group email">
                                <label>Geçerli Şifre:</label>
                                <input class="form-control" name="sifre" value="" type="password">
                            </div>
                            <div class="text-right buttons">
                                <input type="hidden" name="hesapGuncelle">
                                <button class="btn btn-sm btn-primary">Güncelle</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <?php
    include("./assets/footer.php");
    include("./assets/script.php")
    ?>

</body>

</html>