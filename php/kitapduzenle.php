<?php
session_start();
require 'database.php';
$db=new Database();
$aranacak=htmlspecialchars($_POST["kitap_adi"]);//kelimeyi alıyoruz.
$result = $db->satir('*','kitaplar',"kitap_adi = \"".$aranacak."\"");
if ($result) {
echo "
<div class='kitaplar'>
        <div class=\"geriok\" style=\"position: absolute;top:auto;left:auto;top: 60px;left: 245px;\" onclick=\"arayadon();\">&#8249;</div> 
        <form action='' method='post'>
    <div class='kitap-resim' style=\"background-image: url('../img/kitaplar/".$result["resim"]."');\"><input type='text' name='d_resim' value='www.google.com/assest/logo.png'></div>
                <div class='aciklama-kismi'>
                    <div class='kitap-baslik'>
                        <input type='text' name='d_ad' value='".ucwords($result["kitap_adi"])."' required>
                    </div>
                    <div class='satir-kitap'>
                        <div class='bilgilersol'>Yazar:</div>
                        <div class='bilgilersag'><input type='text' name='d_yazar' value='".$result["yazar"]."' required></div>
                    </div>
                    <div class='satir-kitap'>
                        <div class='bilgilersol'>Yayınevi:</div>
                        <div class='bilgilersag'><input type='text' name='d_yayinevi' value='".$result["YayinEvi"]."'></div>
                    </div>
                    <div class='satir-kitap'>
                        <div class='bilgilersol'>Sayfa sayısı:</div>
                        <div class='bilgilersag'><input type='number' name='d_sayfasayisi' value='".$result["sayfa_sayisi"]."'></div>
                    </div>
                    <div class='satir-kitap'>
                        <div class='bilgilersol'>Depoda mı?</div>                        
                        <div class='bilgilersag'>
                            <input type='checkbox' id='depodami' name='d_depodami' ".($result["depoda"]==1?'checked':'').">
                        </div>
                    </div>
                    <div class='satir-kitap' id='satir_alan'>
                        <div class='bilgilersol'>Kitabı alan:</div>
                        <div class='bilgilersag'><input id='alan' name='d_alan' type='text' value='".$result["odunc_alan"]."'></div>
                    </div>
                    <div class='satir-kitap'>
                        <div class='bilgilersol'>Kitap numarası:</div>
                        <div class='bilgilersag'><input type='number' name='d_id' value='".$result["id"]."' disabled></div>
                    </div>    
                </div></form>
            </div>
                <div class='solbuton buton' onclick='kaydet();'>Kaydet</div>
                <div class='solbuton buton' onclick='soldakiler(\"".$result["kitap_adi"]."\");'>İptal</div></div>";
}
?>
