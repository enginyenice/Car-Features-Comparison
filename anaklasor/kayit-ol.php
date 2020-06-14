<!doctype html>
<html lang="tr">
<title>Kayıt Ol</title>
<?php include("./assets/head.php");

$messageTitle = "";
$message = "";
$status = "";
if(isset($_GET['bilgi'])){

switch($_GET['bilgi'])
{
    case 'kisa':
        $message = "Bütün alanlar en az 3 karakter olmalidir";
        $status = "warning";
    break;
    case 'sifre':
        $message = "Parola ve parola tekrar aynı değil";
        $status = "warning";
    break;
    case 'eposta':
        $message = "E-Posta Kayıtlı";
        $status = "danger";
    break;
    case 'aktivasyon':
        $message = "Hesap Oluşturuldu. Hesabınızı aktifleştirmek için lütfen eposta adresinizi kontrol ediniz..";
        $status = "success";
    break;
    case 'mail':
        $message = "Hesap Oluşturuldu. Mail Sunucularında oluştu. Lütfen bekleyiniz...";
        $status = "danger";
        
    break;
    case 'bilinmiyor':
        $message = "Bilinmeyen bir hata oluştu...";
        $status = "danger";
        
    break;
}

}


?>

<body class="bg-light mt-4">

    <div class="container-fluid">
        <h2 class="title text-center mt-3 pb-2 pt-5">Araba Karşılaştır</h2>
        <div class="login mx-auto p-3 col col-xl-6 col-lg-7 col-md-8 col-10 col-sm-12 border border-secondary rounded">

            <form action="./controller/Account.php" method="POST">
                <h3 class="title text-center">Kayıt Ol</h3>

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