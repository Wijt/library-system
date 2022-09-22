<?php 
session_start();
require('database.php');
$db=new Database();
$kitap=htmlspecialchars($_POST["alinankitap"]);
$kullaniciadi=htmlspecialchars($_SESSION["kul-adi"]);
$sonuc=$db->calistir("UPDATE kitaplar SET odunc_alan=\"".$kullaniciadi."\",depoda=0 WHERE kitap_adi=\"".$kitap."\"");
echo ".";
?>