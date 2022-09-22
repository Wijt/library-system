<?php  
session_start();
require ('database.php');
$db=new Database();
$kitap=htmlspecialchars($_POST["birakilankitap"]);
$sonuc=$db->calistir("UPDATE kitaplar SET odunc_alan=null, depoda=1 WHERE kitap_adi=\"".$kitap."\"");
?>