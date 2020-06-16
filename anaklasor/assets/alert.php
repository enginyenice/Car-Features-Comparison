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