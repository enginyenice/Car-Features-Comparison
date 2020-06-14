<!doctype html>
<html lang="tr">

<?php include("./assets/head.php");
$message = "";
$status = "";
if (isset($_GET['bilgi'])) {

    switch ($_GET['bilgi']) {
        case 'gecerliSifre':
            $message = "Geçerli şifre doğru değil.";
            $status = "danger";
            break;
        case 'kisa':
            $message = "Bütün alanlar en az 3 karakter olmalidir";
            $status = "warning";
            break;
        case 'sifreOK':
            $message = "Şifre bilgileri güncelleştirildi.";
            $status = "success";
            break;
        case 'hesapOK':
            $message = "Hesap bilgileri güncelleştirildi.";
            $status = "success";
            break;
        case 'bilinmeyen':
            $message = "Daha sonra tekrar deneyiniz.";
            $status = "danger";
            break;
    }
}
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

    ?>


    <div class="container">
        <?php if (isset($_GET['bilgi'])) { ?>

            <div class="alert alert-<?= $status ?> alert-dismissible fade show" role="alert">
                <strong><?= $message ?></strong>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>


        <?php } ?>
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



        <?php
        include("./assets/footer.php");
        include("./assets/script.php")
        ?>

</body>

</html>