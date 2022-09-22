<?php
session_start();
require 'database.php';
$db=new Database();
$aranacak=htmlspecialchars($_POST["kitap_adi"]);//kelimeyi alıyoruz.
$result = $db->satir('*','kitaplar',"kitap_adi = \"".$aranacak."\"");
if ($result) {
echo "<div class='kitaplar'>
		<div class=\"geriok\" style=\"position: absolute;top:auto;left:auto;top: 60px;left: 245px;\" onclick=\"arayadon();\">&#8249;</div> 
    <div class='kitap-resim' style=\"background-image: url('../img/kitaplar/".$result["resim"]."');\"></div>
                <div class='aciklama-kismi'>
                    <div class='kitap-baslik'>
                        ".ucwords($result["kitap_adi"])."
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
                        <div class='bilgilersag'>".($result["depoda"]==true?'Kütüphanede var':'<font color="#DD1A20" style="font-weight:bolder;">Ödünç alınmış</font>')."</div>
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
            </div></div><div class=\"anasayfa-butonlar-sagalt\">".butonver()."
            </div>";
            $_SESSION["bakilankitap"]=$result["kitap_adi"];
}else{
	echo "Bizde böyle bi kitap yok.";
}

function butonver(){
    global $result,$_SESSION;
    $kod="";
    if($result["depoda"])
    {
        $kod.="<div class=\"sagbuton buton\" onclick=\"kitabial();\">Al</div>";
    }
    else
    {
        if (strtolower($result["odunc_alan"])==strtolower($_SESSION["kul-adi"])) {
           $kod.="<div class=\"sagbuton buton\" onclick=\"kitabibirak();\">İade et</div>";
        }
    }
    if ($_SESSION["kul-yetki"]=="yonetici") {
        $kod.="<div class=\"solbuton buton\" onclick=\"kitabiduzenle();\">Düzenle</div>";
    }
    return $kod;
}
?>
