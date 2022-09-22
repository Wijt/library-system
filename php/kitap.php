<?php session_start(); if(!isset($_SESSION["kul-adi"])){header("Refresh:2; url=../index.php");
        die("Giriş yapılmadı.");}?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Hoşgeldiniz!</title>
        <link rel="stylesheet" href="../css/anasayfa.css">
        <link rel="shortcut icon" href="../img/favicon.ico">
        <script src="../js/jquery.js"></script>
        <script src="../js/jquery.backgroundMove.js"></script>
        <script type="text/javascript">
            $(document).on('keyup', '#ara', function() {
                var kelime=$(this).val();
                $.post("ara.php",{"kelime":kelime},function(al){
                    $(".kelimeler").html(al);
                });
                
            });
            $(document).on('click', '#ara-buton', function() {
                var kelime = $("#ara").val();
                $.post("kitapgoster.php",{"kitap_adi":kelime},function(al){ 
                    $(".anasayfa-icerik").animate({ 'opacity': 0 }, 400, function (){
                    $(".anasayfa-icerik").html(al);}).animate({ 'opacity': 1 }, 400);
                });
            });


            $(document).on('click', '.cikis-buton', function() {
                if (confirm('Gerçekten çıkış yapmak istiyor musunuz?')) {
                    $.post("cikis.php",null,function(){document.location.href = "../index.php";});
                }
            });

            function arayadon() {
                $(".anasayfa-icerik").animate({ 'opacity': 0 }, 400, function (){
                    $(".anasayfa-icerik").html("<div class=\"kelimeler\"></div><table style=\"margin-top: 100px;\"><tr><td><div class=\"arakutusu buton\"><img src=\"../img/araicon.png\" style=\"margin-top: 5px;margin-left: 5px;\" height=\"25px\" width=\"25px\"><input id=\"ara\" class=\"arainput\" type=\"search\" name=\"aranicak\" placeholder=\"Kitap ara...\" autocomplete=\"off\"></div></td></tr><tr><td><center><div id=\"ara-buton\" class=\"butonlar buton\" style=\"width: 100px;height: 30px;\">Ara</div></center></td></tr></table>");}).animate({ 'opacity': 1 }, 400);
            }

            function soldakiler(kitapismi) {
                /*$.post("kitapgoster.php",{"kitap_adi":kitapismi},function(al){ 
                    $(".anasayfa-icerik").html(al);
                });*/
                window.location.url="?kitap_adi="+kitapismi;
            }

            function tamamla($icineyazilacak){
                $('#ara').val($icineyazilacak);
            }

            function kitabial() {
                var kitapismi = $.trim($(".kitap-baslik").html());
                console.log(kitapismi);
                $.post("kitapal.php",{"alinankitap":kitapismi},function(){ 
                    $.post("kitapgoster.php",{"kitap_adi":kitapismi},function(al){ 
                        $(".anasayfa-icerik").animate({ 'opacity': 0 }, 400, function (){
                            $(".anasayfa-icerik").html(al);}).animate({ 'opacity': 1 }, 400);
                });
                });
            }
            function kitabibirak() {
                var kitapismi = $.trim($(".kitap-baslik").html());
                console.log(kitapismi);
                $.post("iadeet.php",{"birakilankitap":kitapismi},function(){ 
                    $.post("kitapgoster.php",{"kitap_adi":kitapismi},function(al){ 
                        $(".anasayfa-icerik").animate({ 'opacity': 0 }, 400, function (){
                        $(".anasayfa-icerik").html(al);}).animate({ 'opacity': 1 }, 400);
                });
                });
            }
            $(function(){$('.anasayfa-orta').animate({ 'opacity': 1 }, 400);});
            $(function(){$('.anasayfa-conteynir').animate({ 'opacity': 1 }, 400);});
        </script>
    </head>
    <body class="arkaplan">      
        <center>
        <div class="anasayfa-conteynir" style="opacity: 0;">
            <div class="anasayfa-sol">
                <marquee behavior="alternate" scrolldelay="50" truespeed="" height="100%" width="100%" direction="down" onmouseover="this.stop();" onmouseout="this.start();">
                    <div onclick="soldakiler('Savaş ve Barış')" class="haftaninkitaplari" style="background-image: url(../img/kitaplar/Savas_ve_Baris.jpg);"></div>
                    <div onclick="soldakiler('Sergüzeşt')" class="haftaninkitaplari" style="background-image: url(../img/kitaplar/serguzest.jpg);"></div>
                    <div onclick="soldakiler('Kutadgu bilig')" class="haftaninkitaplari" style="background-image: url(../img/kitaplar/kutadgubilig.jpg);"></div>
                    <div onclick="soldakiler('Babalar ve oğullar')" class="haftaninkitaplari" style="background-image: url(../img/kitaplar/Babalar_ve_ogullar.jpg);"></div>
                    <div onclick="soldakiler('Doctor Who: Dehşet Ağı')" class="haftaninkitaplari" style="background-image: url(../img/kitaplar/dehsetagi_yorumcadisi.png);"></div>
                </marquee>
            </div>
            <div class="baslikortalayici">
            <h2 class="girisbaslik yazi3d">
            <span style="font-size: 35px;color:#0b1019;">K</span>ÜTÜPHANE OTOMASYONUNA HOŞGELDİNİZ</h2>
            <div class="anasayfa-orta" style="opacity: 0;">
                <div class="cikis-buton"></div>
                <div class="anasayfa-icerik">
                    <?php 
                        require 'Database.php';
                        $db=new Database();
                        $aranacak=htmlspecialchars(trim($_GET["kitap_adi"]));//kelimeyi alıyoruz.
                        $result = $db->satir('*','kitaplar',"kitap_adi = \"".$aranacak."\"");
                        if ($result) {
                            foreach ($result as $row) {
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
                                        </div><div class=\"anasayfa-butonlar-sagalt\">".butonver()."
                                            <div class=\"solbuton buton\">Düzenle</div>
                                        </div>";
                                        break;
                            }
                        }
                        else{
                            echo "Bizde böyle bi kitap yok.";
                        }
                        
                        function butonver(){
                            global $result,$_SESSION;
                            if($result["depoda"])
                            {
                                return "<div class=\"sagbuton buton\" onclick=\"kitabial();\">Al</div>";
                            }
                            else
                            {
                                if (strtolower($result["odunc_alan"])==strtolower($_SESSION["kul-adi"])) {
                                   return "<div class=\"sagbuton buton\" onclick=\"kitabibirak();\">İade et</div>";
                                }
                            }
                        }
                    ?>
                </div>
            </div>
        </div>
        </center>
    </body>
</html>