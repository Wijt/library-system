<?php
require 'Database.php';
$db=new Database();

$durum=htmlspecialchars($_POST["durum"]);
$suankikitap=htmlspecialchars($_POST["suankikitap"]);

switch ($durum) {
	case 'duzenle':
		$aranacak=$suankikitap;//kelimeyi alıyoruz.
		$result = $db->satir('*','kitaplar',"kitap_adi = \"".$aranacak."\"");
		foreach ($result as $row) {
			echo "<div class='kitaplar'>
        	<div class='kitap-resim' style=\"background-image: url('../img/kitaplar/".$result["resim"]."');\"></div>
                    <div class='aciklama-kismi'>
                        <div class='kitap-baslik'>
                            <input>".$result["kitap_adi"]."
                        </div>
                        <div class='satir-kitap'>
                            <div class='bilgilersol'>Yazar:</div>
                            <div class='bilgilersag'>".$result["yazar"]."</div>
                        </div>
                        <div class='satir-kitap'>
                            <div class='bilgilersol'>Yayınevi:</div>
                            <div class='bilgilersag'>".$result["YayinEvi"]."</div>
                        </div>
                        <div class='satir-kitap'>
                            <div class='bilgilersol'>Sayfa sayısı:</div>
                            <div class='bilgilersag'>".$result["sayfa_sayisi"]."</div>
                        </div>
                        <div class='satir-kitap'>
                            <div class='bilgilersol'>Depoda mı?</div>
                            <div class='bilgilersag'>".($result["depoda"]==true?'Kütüphanede var':'Ödünç alınmış')."</div>
                        </div>
                        ".($result["depoda"]==false?"<div class='satir-kitap'>
                            <div class='bilgilersol'>Kitabı alan:</div>
                            <div class='bilgilersag'>".$result["odunc_alan"]."</div>
                        </div>":'')."
                        <div class='satir-kitap'>
                            <div class='bilgilersol'>Kitap numarası:</div>
                            <div class='bilgilersag'>".$result["id"]."</div>
                        </div>    
                    </div>
                </div></div>";
            break;
		}
	break;
	default:
		# code...
		break;
}
















?>