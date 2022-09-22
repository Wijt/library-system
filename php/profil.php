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
                if(kelime.length>1){
                $.post("kitapgoster.php",{"kitap_adi":kelime},function(al){ 
                    $(".anasayfa-icerik").animate({ 'opacity': 0 }, 400, function (){
                    $(".anasayfa-icerik").html(al);}).animate({ 'opacity': 1 }, 400);
                });}
            });

            function BakilaniSil(){
            	$.post("bakilanisil.php",{},function(al){});
            }

            $(document).on('click', '.cikis-buton', function() {
                if (confirm('Gerçekten çıkış yapmak istiyor musunuz?')) {
                    $.post("cikis.php",null,function(){document.location.href = "../index.php";});
                }
            });

            function arayadon() {
                $(".anasayfa-icerik").animate({ 'opacity': 0 }, 400, function (){
                    $(".anasayfa-icerik").html("<div class=\"kelimeler\"></div><table style=\"margin-top: 100px;\"><tr><td><div class=\"arakutusu buton\"><img src=\"../img/araicon.png\" style=\"margin-top: 5px;margin-left: 5px;\" height=\"25px\" width=\"25px\"><input id=\"ara\" class=\"arainput\" type=\"search\" name=\"aranicak\" placeholder=\"Kitap ara...\" autocomplete=\"off\"></div></td></tr><tr><td><center><div id=\"ara-buton\" class=\"butonlar buton\" style=\"width: 100px;height: 30px;\">Ara</div></center></td></tr></table>");}).animate({ 'opacity': 1 }, 400);
            	BakilaniSil();
            }

            function soldakiler(kitapismi) {
                $.post("kitapgoster.php",{"kitap_adi":kitapismi},function(al){ 
                     $.post("kitapgoster.php",{"kitap_adi":kitapismi},function(al){ 
                        $(".anasayfa-icerik").animate({ 'opacity': 0 }, 400, function (){
                            $(".anasayfa-icerik").html(al);}).animate({ 'opacity': 1 }, 400);
                }); 
                });
            }

            function tamamla(icineyazilacak){
                soldakiler(icineyazilacak);
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
            function kitabiduzenle() {
                var kitapismi = $.trim($(".kitap-baslik").html());
                $.post("kitapduzenle.php",{"kitap_adi":kitapismi},function(al){ 
                        $(".anasayfa-icerik").animate({ 'opacity': 0 }, 400, function (){
                        $(".anasayfa-icerik").html(al);

                        if($("#depodami").is(':checked')) {
		      				$('#alan').prop('disabled', true);
		      				$('#satir_alan').slideUp(400);
		    			}
		    			else{
		    				$('#alan').prop('disabled', false);
		    				$('#satir_alan').slideDown(400);
		    			}

		    		}).animate({ 'opacity': 1 }, 400);
                });
            }
            $(function(){$('.anasayfa-orta').animate({ 'opacity': 1 }, 400);});
            $(function(){$('.anasayfa-conteynir').animate({ 'opacity': 1 }, 400);});

			$(document).on('change', '#depodami', function() {
    			if(this.checked) {
      				$('#alan').prop('disabled', true);
    				$('#satir_alan').slideUp(400);
    			}
    			else{
    				$('#alan').prop('disabled', false);
    				$('#satir_alan').slideDown(400);
    			}
			});
			function kaydet() {
			    var ad,yazar,yayinevi,sayfasayisi,depodami,oduncalan,id;
			    ad=$("input[name='d_ad']").val();
			    yazar=$("input[name='d_yazar']").val();
			    yayinevi=$("input[name='d_yayinevi']").val();
			    sayfasayisi=$("input[name='d_sayfasayisi']").val();
			    if($("input[name='d_depodami']").is(':checked')){
			    	depodami=true;
			    }else{depodami=false;}
			    oduncalan=$("input[name='d_alan']").val();
			    id=$("input[name='d_id']").val();
			    $.post('kitapduzenlekaydet.php',{'d_id':id,'d_ad':ad,'d_yazar':yazar,'d_yayinevi':yayinevi,'d_sayfasayisi':sayfasayisi,'d_depodami':depodami,'d_alan':oduncalan},function(al){});
			    soldakiler(ad);
			}
        </script>
    </head>
    <body class="arkaplan">      
        <center>
        <div class="anasayfa-conteynir" style="opacity: 0;">
            <div class="anasayfa-sol">
            	<span class="sol-baslik">HAFTANIN KİTAPLARI</span>
                <marquee style="margin-top:20px;" behavior="alternate" scrolldelay="50" truespeed="" height="95%" width="100%" direction="down" onmouseover="this.stop();" onmouseout="this.start();">
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
                	<?php if(isset($_SESSION["bakilankitap"])): ?>
                		<script type="text/javascript">
							$(function(){soldakiler("<?php echo $_SESSION["bakilankitap"];?>")});
						</script>
                	<?php else: ?>
                    	<div class="kelimeler">
                    	</div>
                    	<table style="margin-top: 100px;">
                        	<tr>
                            	<td>
                                	<div class="arakutusu buton">
                                    <img src="../img/araicon.png" style="margin-top:5px;margin-left: 5px;" height="25px" 	width="25px">
                                    <input id="ara" class="arainput" type="search" name="aranicak" placeholder="Kitap 	ara..." autocomplete="off">
                                	</div>
                            	</td>
                        	</tr>
                        	<tr>
                            	<td>
                                	<center>
                                    <div id="ara-buton" class="butonlar buton" style="width: 100px;height: 30px;">Ara</div>
                                	</center>
                            	</td>
                        	</tr>
	                    </table>
                	<?php endif;?>
                </div>
            </div></div>
        </div>
        </center>
    </body>
</html>