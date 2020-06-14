<!doctype html>
<html lang="tr">
<title>Giriş Yap</title>
<?php include("./assets/head.php");

$messageTitle = "";
$message = "";
$status = "";
if(isset($_GET['bilgi'])){

switch($_GET['bilgi'])
{
    case 'bilgi':
        $message = "E-Posta veya şifre hatalı";
        $status = "danger";
    break;
    case 'aktivasyon':
        $message = "Hesabınızı aktifleştirmek için lütfen eposta adresinizi kontrol ediniz..";
        $status = "warning";
    break;
    case 'yeniSifre':
        $message = "Yeni şifreniz mailinize gönderilmiştir.";
        $status = "success";
    break;
    case 'aktive':
        $message = "Hesabınız aktifleştirildi.";
        $status = "success";
    break;
    case 'hataliKod':
        $message = "Hesabınız aktifleştirilemedi. Yönetici ile iletişime geçiniz...";
        $status = "error";
    break;
}

} ?>

<body class="bg-light mt-4">

    <div class="container-fluid">
        <h2 class="title text-center mt-3 pb-2 pt-5">Araba Karşılaştır</h2>
        <div class="login mx-auto p-3 col col-xl-6 col-lg-7 col-md-8 col-10 col-sm-12 border border-secondary rounded">

            <form action="./controller/Account.php" method="POST">
                <h3 class="title text-center">Giriş Yap</h3>
                <?php 
                if(isset($_GET['bilgi'])){ ?>
                
                <div class="alert alert-<?=$status?> alert-dismissible fade show" role="alert">
                    <strong><?=$message?></strong> 
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                
                
                <?php } ?>

                <div class="form-group email">
                    <label>Eposta:</label>
                    <input class="form-control" name="eposta" required type="email">
                </div>
                <div class="form-group password">
                    <label>Şifre:</label>
                    <input class="form-control" name="sifre" required type="password">
                    <div class="text-right">
                        <a href="./sifremi-unuttum.php">Şifremi unuttum</a>
                    </div>
                </div>

                <div class="text-right buttons">
                    <input type="hidden" name="girisYap">
                    <button class="btn btn-sm btn-primary">Giriş Yap</button>
                    <a href="./kayit-ol.php" class="btn btn-sm btn-danger">Kayıt Ol</a>
                </div>

            </form>
        </div>


    </div>



<?php include("./assets/script.php");?>
</body>

</html>