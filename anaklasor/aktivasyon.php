<?php
include("./assets/session.php");
include("./controller/DB.php");

if(isset($_GET['kod']) && isset($_GET['id']))
{
    $kod = $_GET['kod'];
    $id = $_GET['id'];
    //var_dump($kod,$id);
    $kontrolSor = $db->prepare("SELECT count(*) AS Adet FROM kullanici WHERE id=:id AND aktivasyonKodu=:aktivasyonKodu");
    $kontrolCek = $kontrolSor->execute(array(
        "id"                => $id,
        "aktivasyonKodu"    => $kod
    ));
    $kontrolCek = $kontrolSor->fetch(PDO::FETCH_ASSOC);
    if($kontrolCek['Adet'] > 0)
    {
    $aktive = $db->prepare("UPDATE kullanici SET
       aktivasyonKodu=:aktivasyonKodu
       WHERE id=:id");
        $aktive->execute(array(
            "aktivasyonKodu"    => "",
            "id"    => $id
        ));
        if($aktive)
        {
            header("Location: giris.php?bilgi=aktive");
        } else {
            header("Location: giris.php?bilgi=hataliKod");
        }
    }

} else {
    echo "404 NOT FOUND";
}
