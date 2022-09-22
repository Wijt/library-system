<?php 
require 'database.php';
$db=new Database();
$aranacak=$_POST["kelime"];//kelimeyi alıyoruz.
$aranacak_guvenli=htmlspecialchars($aranacak);
if (strlen($aranacak)>=1) {
	$result = $db->sonuc('id','kitap_adi','kitaplar',"kitap_adi like '".$aranacak_guvenli."%' limit 3");
	foreach ($result as $row) {
		echo "<div class='kelime' onClick=\"tamamla('".$row["kitap_adi"]."')\">".$row["kitap_adi"]."</div>";
	}
}
?>