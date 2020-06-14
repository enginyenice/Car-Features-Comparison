<?php

ob_start();
session_start();
include("./controller/DB.php");

//echo $_SERVER['SCRIPT_NAME'];
// 1. örnek
$pizza  = $_SERVER['SCRIPT_NAME'];
$dilimler = explode("/", $pizza);
$dosya = $dilimler[3];
$parcala = explode(".", $dosya);
$dosya = $parcala[0];

$sessionDurumu = (!empty($_SESSION['eposta'])) ? 1 : 0;
//echo $sessionDurumu;
switch ($dosya) {
    case 'kayit-ol': case 'sifremi-unuttum': case 'giris':
        if($sessionDurumu == 1)
            iceriYonlendir();
    break;
    case 'index': case '': case 'hesabim':
        if($sessionDurumu == 0)
            girisYonlendir();
}


function girisYonlendir()
{
    header("Location: /araba-karsilastirma/anaklasor/giris.php");
}
function iceriYonlendir(){
    header("Location: /araba-karsilastirma/anaklasor/index.php");
}

?>

<head>
    <!-- HEAD START -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../eklentiler/boostrap/css/bootstrap.min.css">

    <!-- HEAD END -->
</head>