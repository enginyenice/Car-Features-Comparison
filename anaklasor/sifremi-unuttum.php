<!doctype html>
<html lang="tr">
    
<?php include("./assets/head.php");
if(isset($_GET['bilgi'])){

switch($_GET['bilgi'])
{
    case 'epostaYok':
        $message = "Böyle bir eposta adresi sistemde kayıtlı değildir.";
        $status = "danger";
        
    break;

    case 'bilinmiyor':
        $message = "Bilinmedik bir hata oluştu. Lütfen daha sonra tekrar deneyiniz...";
        $status = "danger";
        
    break;
    case 'mail':
        $message = "Mail sunucularında hata var... Lütfen daha sonra tekrar deneyiniz...";
        $status = "danger";
        
    break;
}

} ?>


<body class="bg-light mt-4">

    <div class="container-fluid">
        <h2 class="title text-center mt-3 pb-2 pt-5">Araba Karşılaştır</h2>
        <div class="login mx-auto p-3 col col-xl-6 col-lg-7 col-md-8 col-10 col-sm-12 border border-secondary rounded">

        <form action="./controller/Account.php" method="POST">
                <h3 class="title text-center">Şifremi Unuttum</h3>
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
                    <input class="form-control" name="eposta" type="text">
                </div>

                <div class="text-right buttons">
                <input type="hidden" name="sifremiUnuttum">
                    <button class="btn btn-sm btn-primary">Şifremi Sıfırla</button>
                    <a href="./giris.php" class="btn btn-sm btn-danger">Geri</a>
                </div>

            </form>
        </div>


    </div>


    <?php include("./assets/script.php");?>
</body>

</html>