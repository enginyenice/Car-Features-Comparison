<?php
ob_start();
session_start();
include("DB.php");

if (isset($_POST['modelEkle'])) {
    $model = $_POST['model'];
    $marka_id = $_POST['marka_id'];


    $modelOlustur = $db->prepare("INSERT INTO model SET marka_id=:marka_id, model=:model");
    $insert = $modelOlustur->execute(array(
        "model"     => $model,
        "marka_id"  => $marka_id
    ));

    if ($insert) {
        header("Location: ../model-listesi.php?bilgi=kayit");
    } else {
        header("Location: ../model-ekle.php?bilgi=bilinmeyen");
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
            header("Location: ../model-listesi.php?bilgi=duzenleme");
        } else {
            header("Location: ../model-duzenle.php?id=" . $id . "&bilgi=bilinmeyen");
        }
    } else {

        header("Location: ../model-duzenle.php?id=" . $id . "&bilgi=aynimodel");
    }
}

if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $sil = $db->prepare("DELETE FROM model WHERE id=:id");
    $sil->execute(array(
        "id" =>  $id
    ));
    if ($sil) {
        header("Location: ../model-listesi.php?bilgi=sil");
    } else {
        header("Location: ../model-listesi.php?bilgi=bilinmeyen");
    }
}
