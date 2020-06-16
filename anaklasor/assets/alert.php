<?php

if (isset($_GET['bilgi'])) {

    switch ($_GET['bilgi']) {
        case 'ayniArac':
            $message = "Bu Arac adı zaten kayıtlı";
            $status = "warning";
            break;
        case 'resimBuyuk':
            $message = "Resim boyutu 10MB büyük olamaz";
            $status = "warning";
            break;
        case 'JPG':
            $message = "Resim uzantısı JPG olmalıdır.";
            $status = "warning";
            break;
        case 'bilinmeyen':
            $message = "Daha sonra tekrar deneyiniz.";
            $status = "danger";
            break;
        case 'kayit':
            $message = "Veri başarıyla oluşturuldu.";
            $status = "success";
            break;
        case 'secimYok':
            $message = "Karşılaştırma için araç seçimi yapılmadı. Lütfen altaki listeden araç seçiniz";
            $status = "warning";
            break;
        case 'duzenleme':
            $message = "Veri başarıyla güncellendi.";
            $status = "success";
            break;
        case 'sil':
            $message = "Veri başarıyla silindi.";
            $status = "success";
            break;
        case 'AracYok':
            $message = "Duzenlemek istediginiz veri sistemde kayıtlı değil.";
            $status = "warning";
            break;

        case 'resimDuzenle':
            $message = "Resim başarıyla güncellendi.";
            $status = "success";
            break;

        case 'ayniMarka':
            $message = "Bu marka adı zaten kayıtlı";
            $status = "warning";
            break;
        case 'ayniMarka':
            $message = "Bu marka adı zaten kayıtlı";
            $status = "warning";
            break;
        case 'markaYok':
            $message = "Duzenlemek istediginiz marka sistemde kayıtlı değil.";
            $status = "warning";
            break;
        case 'ayniModel':
            $message = "Bu Model adı zaten kayıtlı";
            $status = "warning";
            break;
        case 'ayniModel':
            $message = "Bu Model adı zaten kayıtlı";
            $status = "warning";
            break;
        case 'gecerliSifre':
            $message = "Geçerli şifre doğru değil!!";
            $status = "danger";
            break;
        case 'hesapOK':
            $message = "Hesap Bilgileri başarıyla güncellendi";
            $status = "success";
            break;
        case 'sifreUyusmuyor':
            $message = "Girilen yeni şifreler birbirine uyuşmuyor";
            $status = "danger";
            break;
        case 'sifreOK':
            $message = "Şifre başarıyla güncellendi";
            $status = "success";
            break;
        case 'modelBos':
            $message = "Model seçilmedi. İşlem Başarısız";
            $status = "danger";
            break;
        case 'markaBos':
            $message = "Marka seçilmedi. İşlem Başarısız";
            $status = "danger";
            break;
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
        case 'kisa':
            $message = "Bütün alanlar en az 4 karakter olmalidir";
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


<div class="container-fluid">
    <?php if (isset($_GET['bilgi'])) { ?>

        <div class="alert alert-<?= $status ?> alert-dismissible fade show" role="alert">
            <strong><?= $message ?></strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>


    <?php } ?>

</div>