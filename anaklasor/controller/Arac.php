<?php
ob_start();
session_start();
include("DB.php");

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
if (isset($_POST['AracEkle'])) {
    $marka_id = $_POST['marka_id'];
    $model_id = $_POST['model_id'];
    $yil = $_POST['yil'];
    $agirlik = $_POST['agirlik'];
    $tekerSayisi = $_POST['tekerSayisi'];
    $motorHacmi = $_POST['motorHacmi'];
    $maxHiz = $_POST['maxHiz'];
    $vites = $_POST['vites'];
    $renk = $_POST['renk'];
    $yakitTuru = $_POST['yakitTuru'];
    $resim = $_FILES['resim'];
    $boyut = $resim['size'];
    if ($boyut > (1024 * 1024 * 10)) {
        header("Location: /araba-karsilastirma/anaklasor/arac-listesi.php?bilgi=resimBuyuk");
    }

    $tip = $resim['type'];
    $isim = $resim['name'];
    $uzanti = explode('.', $isim);
    $uzanti = $uzanti[count($uzanti) - 1];
    if ($tip != 'image/jpeg' || $uzanti != 'jpg') {
        header("Location: /araba-karsilastirma/anaklasor/arac-listesi.php?bilgi=JPG");
    }
    $dosya = $resim['tmp_name'];
    $yeniAd = RandomTextUret(5) . $resim['name'];
    $yeniYol = "../images/" . $yeniAd;
    $yol = $yeniYol;
    copy($dosya, $yeniYol);
    $aracOlustur = $db->prepare("INSERT INTO arac SET 
    marka_id=:marka_id,
    model_id=:model_id,
    yil=:yil,
    agirlik=:agirlik,
    motorHacmi=:motorHacmi,
    tekerSayisi=:tekerSayisi,
    maxHiz=:maxHiz,
    vites=:vites,
    renk=:renk,
    yakitTuru=:yakitTuru,
    resim=:resim
    ");
    $insert = $aracOlustur->execute(array(
        "marka_id"      => $marka_id,
        "model_id"      => $model_id,
        "yil"           => $yil,
        "agirlik"       => $agirlik,
        "motorHacmi"    => $motorHacmi,
        "tekerSayisi"   => $tekerSayisi,
        "maxHiz"        => $maxHiz,
        "vites"         => $vites,
        "renk"          => $renk,
        "yakitTuru"     => $yakitTuru,
        "resim"         => "anaklasor/".$yol

    ));
   

    if ($insert) {
        header("Location: /araba-karsilastirma/anaklasor/arac-listesi.php?bilgi=kayit");
    } else {
        header("Location: /araba-karsilastirma/anaklasor/arac-ekle.php?bilgi=bilinmeyen");
    }
}

if (isset($_POST['modelDuzenle'])) {
    $id = $_POST['modelDuzenle'];
    $model = $_POST['model'];
    $marka_id = $_POST['marka_id'];
    $modelSor = $db->prepare("SELECT count(*) AS Adet FROM model WHERE id=:id");
    $modelCek = $modelSor->execute(array(
        "id"    => $id
    ));
    $modelCek = $modelSor->fetch(PDO::FETCH_ASSOC);
    $modelVarMi = ($modelCek['Adet'] > 0) ? true : false;
    if ($modelVarMi == true) {
        $modelDuzenle = $db->prepare("UPDATE model SET
       model=:model, marka_id=:marka_id
       WHERE id=:id");
        $modelDuzenle->execute(array(
            "model"    => $model,
            "marka_id"  => $marka_id,
            "id"    => $id
        ));
        if ($modelDuzenle) {
            header("Location: /araba-karsilastirma/anaklasor/arac-listesi.php?bilgi=duzenleme");
        } else {
            header("Location: /araba-karsilastirma/anaklasor/arac-duzenle.php?id=" . $id . "&bilgi=bilinmeyen");
        }
    } else {

        header("Location: /araba-karsilastirma/anaklasor/arac-duzenle.php?id=" . $id . "&bilgi=aynimodel");
    }
}

if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $sil = $db->prepare("DELETE FROM arac WHERE id=:id");
    $sil->execute(array(
        "id" =>  $id
    ));
    if ($sil) {
        header("Location: /araba-karsilastirma/anaklasor/arac-listesi.php?bilgi=sil");
    } else {
        header("Location: /araba-karsilastirma/anaklasor/arac-listesi.php?bilgi=bilinmeyen");
    }
}

if (isset($_POST['modelGetirPost'])) {
    $marka_id = $_POST['id'];
    $ModelSor = $db->prepare("SELECT * FROM model WHERE marka_id=:marka_id");
    $ModelSor->execute(array(
        "marka_id"    => $marka_id
    ));
    $ModelCek = $ModelSor->fetchAll();
    $data = json_encode($ModelCek);
    echo $data;
}
