<?php
ob_start();
session_start();
include("DB.php");

if (isset($_POST['markaEkle'])) {
    $marka = $_POST['marka'];
    $markaSor = $db->prepare("SELECT count(*) AS Adet FROM marka WHERE marka=:marka");
    $markaCek = $markaSor->execute(array(
        "marka"    => $marka
    ));
    $markaCek = $markaSor->fetch(PDO::FETCH_ASSOC);
    $markaVarMi = ($markaCek['Adet'] > 0) ? true : false;
    //var_dump($marka,$markaVarMi,$markaCek['Adet']);
    //die();
    if ($markaVarMi == false) {

        $markaOlustur = $db->prepare("INSERT INTO marka SET marka=:marka");
        $insert = $markaOlustur->execute(array(
            "marka"     => $marka
        ));

        if ($insert) {
            header("Location: ../marka-listesi.php?bilgi=kayit");
        } else {
            header("Location: ../marka-ekle.php?bilgi=bilinmeyen");
        }
    } else {
        header("Location: ../marka-ekle.php?bilgi=ayniMarka");
    }
}

if (isset($_POST['markaDuzenle'])) {
    $id = $_POST['markaDuzenle'];
    $marka = $_POST['marka'];
    $markaSor = $db->prepare("SELECT count(*) AS Adet FROM marka WHERE marka=:marka");
    $markaCek = $markaSor->execute(array(
        "marka"    => $marka
    ));
    $markaCek = $markaSor->fetch(PDO::FETCH_ASSOC);
    $markaVarMi = ($markaCek['Adet'] > 0) ? true : false;
    if ($markaVarMi == false) {
        $markaDuzenle = $db->prepare("UPDATE marka SET
       marka=:marka
       WHERE id=:id");
        $markaDuzenle->execute(array(
            "marka"    => $marka,
            "id"    => $id
        ));
        if ($markaDuzenle) {
            header("Location: ../marka-listesi.php?bilgi=duzenleme");
        } else {
            header("Location: ../marka-duzenle.php?id=" . $id . "&bilgi=bilinmeyen");
        }
    } else {

        header("Location: ../marka-duzenle.php?id=" . $id . "&bilgi=ayniMarka");
    }
}

if (isset($_GET['sil'])) {
    $id = $_GET['sil'];
    $sil = $db->prepare("DELETE FROM marka WHERE id=:id");
    $sil->execute(array(
        "id" =>  $id
    ));
    if($sil)
    {
        header("Location: ../marka-listesi.php?bilgi=sil");
    } else {
        header("Location: ../marka-listesi.php?bilgi=bilinmeyen");
    }
}
