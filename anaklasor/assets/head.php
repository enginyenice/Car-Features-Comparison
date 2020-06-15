<?php
include("./controller/DB.php");
$pizza  = $_SERVER['SCRIPT_NAME'];
$dilimler = explode("/", $pizza);
$dosya = $dilimler[2];
$parcala = explode(".", $dosya);
$dosya = $parcala[0];
$dosya = strtolower($dosya);
$sessionDurumu = (!empty($_SESSION['eposta'])) ? 1 : 0;
switch ($dosya) {
    case 'kayit-ol':
    case 'sifremi-unuttum':
    case 'giris':
        if ($sessionDurumu == 1)
            iceriYonlendir();
        break;
    case 'index':
    case '':
    case 'hesabim':
    case 'arac-listesi':
    case 'arac-duzenle':
    case 'arac-ekle':
    case 'marka-listesi':
    case 'marka-ekle':
    case 'marka-duzenle':
    case 'model-listesi':
    case 'model-ekle':
    case 'model-duzenle':
    case 'karsilastir.php':
        if ($sessionDurumu == 0)
            girisYonlendir();
}

function girisYonlendir()
{
    header("Location: ./giris.php");
}
function iceriYonlendir()
{
    header("Location: ./index.php");
}

?>

<head>
    <!-- HEAD START -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../eklentiler/boostrap/css/bootstrap.min.css">

    <!-- HEAD END -->
</head>