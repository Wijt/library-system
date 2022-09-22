<?php
session_start();
if ($_SESSION["kul-yetki"]=="yonetici") {
	require 'database.php';
	$db=new Database();
	$d_id=htmlspecialchars(trim($_POST["d_id"]));
	$d_ad=htmlspecialchars(trim($_POST["d_ad"]));
	$d_yazar=htmlspecialchars(trim($_POST["d_yazar"]));
	$d_yayinevi=htmlspecialchars(trim($_POST["d_yayinevi"]));
	$d_sayfasayisi=htmlspecialchars(trim($_POST["d_sayfasayisi"]));
	$d_depodami=htmlspecialchars(trim($_POST["d_depodami"]));
	$d_alan=htmlspecialchars(trim($_POST["d_alan"]));
	if($d_depodami!="false") {
		$sonuc=$db->guncelle("UPDATE kitaplar SET kitap_adi=\"".$d_ad."\", yazar=\"".$d_yazar."\", sayfa_sayisi=\"".$d_sayfasayisi."\", depoda = \"1\", odunc_alan=null, YayinEvi=\"".$d_yayinevi."\" WHERE id=\"".$d_id."\"");
	}else{
		$sonuc=$db->guncelle("UPDATE kitaplar SET kitap_adi=\"".$d_ad."\", yazar=\"".$d_yazar."\", sayfa_sayisi=\"".$d_sayfasayisi."\", depoda = \"0\", odunc_alan=\"".$d_alan."\",YayinEvi=\"".$d_yayinevi."\" WHERE id=\"".$d_id."\"");
	}
}
?>