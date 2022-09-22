<?php
require 'Database.php';
$db=new Database();
$sonuc=$db->calistir("SELECT * FROM kitaplar ORDER BY rand() LIMIT 5");
echo "<marquee  behavior=\"alternate\" scrolldelay=\"50\" truespeed height=\"100%\" width=\"100%\" direction=\"down\" onmouseover=\"this.stop();\" onmouseout=\"this.start();\">";
foreach ($sonuc as $row) {
	echo "<div onclick=\"soldakiler(\'".$row["kitap_adi"]."\')\" class=\"haftaninkitaplari\" style=\"background-image: url(../img/kitaplar/".$row["resim"].");\"></div>";
}
echo "</marquee>";
?>