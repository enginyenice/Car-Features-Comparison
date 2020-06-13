<?php
ob_start();
session_start();
require("../../eklentiler/phpmailler/class.phpmailer.php");
include("DB.php");
if (isset($_POST["girisYap"])) {
    $eposta = $_POST['eposta'];
    $sifre = $_POST['sifre'];

    $kullaniciSor = $db->prepare("SELECT count(*) AS Adet FROM kullanici WHERE eposta=:eposta AND sifre=:sifre");
    $kullaniciCek = $kullaniciSor->execute(array(
        "eposta"    => $eposta,
        "sifre"     => $sifre
    ));
    $kullaniciCek = $kullaniciSor->fetch(PDO::FETCH_ASSOC);
    $uyeVarMi = ($kullaniciCek['Adet'] > 0) ? true : false;

    $aktifMi = false;
    if ($uyeVarMi) {

        $kullaniciBilgiSor = $db->prepare("SELECT * FROM kullanici WHERE eposta=:eposta AND sifre=:sifre");
        $kullaniciBilgiCek = $kullaniciBilgiSor->execute(array(
            "eposta"        => $eposta,
            "sifre"         => $sifre
        ));
        $kullaniciBilgiCek = $kullaniciBilgiSor->fetch(PDO::FETCH_ASSOC);
        $aktifMi = (strlen($kullaniciBilgiCek['aktivasyonKodu']) == 0) ? true : false;

        if ($aktifMi) {
            $_SESSION['eposta'] = $kullaniciBilgiCek['eposta'];
            $_SESSION['id'] = $kullaniciBilgiCek['id'];
            header("Location: /araba-karsilastirma/anaklasor/index.php");
        } else {
            header("Location: /araba-karsilastirma/anaklasor/giris.php?bilgi=aktivasyon");
        }
    } else {
        header("Location: /araba-karsilastirma/anaklasor/giris.php?bilgi=bilgi");
    }
}
if (isset($_POST['kayitOl'])) {
    $adSoyad = $_POST['adSoyad'];
    $eposta = $_POST['eposta'];
    $sifre = $_POST['sifre'];
    $sifre2 = $_POST['sifre2'];


    $epostaSor = $db->prepare("SELECT count(*) AS Adet FROM kullanici WHERE eposta=:eposta");
    $epostaCek = $epostaSor->execute(array(
        "eposta"    => $eposta
    ));
    $epostaCek = $epostaSor->fetch(PDO::FETCH_ASSOC);
    $epostaVarMi = ($epostaCek['Adet'] > 0) ? true : false;

    if (strlen($adSoyad) < 3 || strlen($eposta) < 3 || strlen($sifre) < 3) {
        header("Location: /araba-karsilastirma/anaklasor/kayit-ol.php?bilgi=kisa");
    } else if ($sifre != $sifre2) {
        header("Location: /araba-karsilastirma/anaklasor/kayit-ol.php?bilgi=sifre");
    } else if ($epostaVarMi) {
        header("Location: /araba-karsilastirma/anaklasor/kayit-ol.php?bilgi=eposta");
    } else {

        //Kayıt Oluşturuldu..
        $aktivasyonKodu = RandomTextUret(10);
        $kullanicikayit = $db->prepare("INSERT INTO kullanici SET
						eposta=:eposta,
						sifre=:sifre,
						adSoyad=:adSoyad,
						aktivasyonKodu=:aktivasyonKodu
						");
        $insert = $kullanicikayit->execute(array(
            "eposta"     => $eposta,
            "sifre" => $sifre,
            "adSoyad" => $adSoyad,
            "aktivasyonKodu" => $aktivasyonKodu
        ));
        //Veritabanına Kayıt Et
        if ($insert) {
            $idSor = $db->prepare("SELECT id FROM kullanici WHERE eposta=:eposta");
            $idCek = $idSor->execute(array(
                "eposta" => $eposta
            ));
            $idCek = $idSor->fetch(PDO::FETCH_ASSOC);
            $id = $idCek['id'];
            $sonuc = MailGonder($aktivasyonKodu, $eposta, $id, 0);
            if ($sonuc) {
                header("Location: /araba-karsilastirma/anaklasor/kayit-ol.php?bilgi=aktivasyon");
            } else {
                header("Location: /araba-karsilastirma/anaklasor/kayit-ol.php?bilgi=mail");
            }
        } else {
            header("Location: /araba-karsilastirma/anaklasor/kayit-ol.php?bilgi=bilinmiyor");
        }
        //Giriş Yap

    }
}
if (isset($_POST['sifremiUnuttum'])) {

    //MailGonder();

    $eposta = $_POST['eposta'];
    //Sistemde eposta var mi


    $epostaSor = $db->prepare("SELECT count(*) AS Adet FROM kullanici WHERE eposta=:eposta");
    $epostaCek = $epostaSor->execute(array(
        "eposta"    => $eposta
    ));
    $epostaCek = $epostaSor->fetch(PDO::FETCH_ASSOC);
    $epostaVarMi = ($epostaCek['Adet'] > 0) ? true : false;
    if ($epostaVarMi) {

        $NewPassword = RandomTextUret(10);

        $yeniSifreOlustur = $db->prepare("UPDATE kullanici SET
       sifre=:sifre
       WHERE eposta=:eposta");
        $yeniSifreOlustur->execute(array(
            "sifre"    => $NewPassword,
            "eposta"    => $eposta
        ));

        if ($yeniSifreOlustur) {
            $sonuc =  MailGonder($NewPassword, $eposta, 0, 1);
            if ($sonuc) {
                header("Location: /araba-karsilastirma/anaklasor/giris.php?bilgi=yeniSifre");
            } else {
                header("Location: /araba-karsilastirma/anaklasor/sifremi-unuttum.php?bilgi=mail");
            }
        } else {
            header("Location: /araba-karsilastirma/anaklasor/sifremi-unuttum.php?bilgi=bilinmiyor");
        }
    } else {
        header("Location: /araba-karsilastirma/anaklasor/sifremi-unuttum.php?bilgi=epostaYok");
    }
}
function RandomTextUret($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function SessionKontrol()
{
}

function MailGonder($data, $eposta, $id, $gonderimTipi)
{
    $url = 'http://' . $_SERVER['SERVER_NAME'];

    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->Username = 'arabakarsilastir@gmail.com';
    $mail->Password = '30102004a';
    $mail->Subject = 'Araba Karşılaştır Uygulaması';
    $mail->SetFrom($mail->Username, 'Araba Karşılaştır');
    $mail->AddAddress($eposta, $eposta);
    $mail->CharSet = 'UTF-8';
    

    if ($gonderimTipi == 1) {
        $content = '<div style="background: #eee; padding: 10px; font-size: 14px">Merhaba, Yeni şifreniz: ' . $data . ' </br> <a href="' . $url . '">' . $url . '</div>';
    } else {
        $content = '<div style="background: #eee; padding: 10px; font-size: 14px">Merhaba,</br><a href="' . $url . '/araba-karsilastirma/anaklasor/aktivasyon.php?kod=' . $data . '&id=' . $id . '">Hesabımı Aktifleştir.</a></div>';
    }
    $mail->MsgHTML($content);
    var_dump($mail);
    if ($mail->Send()) {
         //e-posta başarılı ile gönderildi
         echo "send";
         die();
        return true;
    } else {
        // bir sorun var, sorunu ekrana bastıralım
        echo $mail->ErrorInfo;
        die();
        return false;
    }
}
