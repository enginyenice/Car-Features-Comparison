<?php 
date_default_timezone_set('Europe/Istanbul');
$servername = "localhost";
$database = "araba-karsilastir";
$username = "root";
$password = "123456789";


try {
    $db = new PDO("mysql:host=".$servername.";dbname=".$database.";charset=utf8", $username, $password);
   //echo "Bağlandın";
}
catch (Exception $hata){
    //echo $hata->getMessage();
}
?>