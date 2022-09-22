<?php session_start();
ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Hoşgeldiniz!</title>
	<link rel="stylesheet" href="css/anasayfa.css">
	<link rel="shortcut icon" href="img/favicon.ico">
	<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
	<script src="js/jquery.js"></script>
	<script src="js/jquery.backgroundMove.js"></script>
</head>
<?php
    require 'php/database.php';
    $db = new Database();
    $_DURUM['mesaj'] = "";
    if($_SESSION["kul-yetki"]){
    	header("Refresh:0; url=php/anasayfa.php");
    }
    if($_SERVER['REQUEST_METHOD']=='POST')
    {
        if(!empty($_POST['kuladi']) and !empty($_POST['sifre']))
        {
            $kuladi = $_POST['kuladi'];
            $sifre = $_POST['sifre'];
            $result = $db->row('*','kullanicilar',array('kuladi' => $kuladi));

            if ($result) 
            {
            	$kriptolusifre=hash('sha512', $sifre, FALSE);
                if (strtolower($kuladi) === strtolower($result['kuladi']) and $kriptolusifre === $result['sifre']) 
                {
                	$_SESSION["kul-adi"]=$result['kuladi'];
                	$_SESSION["kul-sifre"]=$sifre;
                	$_SESSION["kul-yetki"]=$result['yetki'];
                    $_DURUM['mesaj']="Giriş başarılı. Aktarılıyorsunuz...";
                	echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('basari').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                    header("Refresh:2; url=php/anasayfa.php");
                }
                else
                {
                    $_DURUM['mesaj']="Şifre yanlış. Tekrar deneyiniz.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                }
            }
            else
            {
	
                $_DURUM['mesaj']="Kullanıcı bulunamadı. <a href='php/kayitsayfasi.php' style='color:wheat;'>Bir hesap oluştur?</a>";
                echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                //header("Refresh:2; url=php/kayitsayfasi.php");
            }
        }
        else{
            $_DURUM['mesaj']="Herhangi bir hesap bilgisi girilmedi.";
                echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
        }
    }
    ob_flush();
?>
<body class="arkaplan">
	<div class="ayarlar"></div>
	<div class="icerik">
		<table class="ayarlar-tablo">
			<tr>
				<th><input type="checkbox" name="arkaplan-hareketi"></th>
				<th>ARKAPLAN HAREKETİ</th>
			</tr>
			<tr>
				<th><input type="checkbox" name="arkaplan-bluru"></th>
				<th>ARKAPLAN BLURU</th>
			</tr>
			<tr>
				<th><input type="checkbox" name="arkaplan-degisimi"></th>
				<th>ARKAPLAN DEĞİŞİMİ</th>
			</tr>
		</table>
	</div>
	<center>			
		<div class="conteynir">
			<h2 class="girisbaslik yazi3d"><span style="font-size: 35px;color:#0b1019;">K</span>ÜTÜPHANE OTOMASYONUNA HOŞGELDİNİZ</h2>
			<div class="orta">
				<div class="uyari" id="uyari-kutusu" style="opacity: 0,height: 30px"> <?= $_DURUM['mesaj']; ?> </div> 
				<form method="post">
					<table border="0" width="100%">
						<tr>
							<th class="satir">
								<span class="yazilar">KULLANICI ADI :</span>
							</th>
							<th>
								<input class="input" type="text" name="kuladi">
							</th>
						</tr>
						<tr>
							<th class="satir">
								<span class="yazilar">ŞİFRE :</span>
							</th>
							<th>
								<input class="input" type="password" name="sifre">
							</th>
						</tr>
					</table>
					<div class="butonlar">
						<div style="float: left; width: 100px;" class="buton" id="kayitol" onclick="sayfadancik('php/kayitsayfasi.php');">Kayıt Ol!</div>
						<button style="float: right; width: 80px;" class="buton" id="giris" method="post" type="submit">Giriş Yap</button>
					</div>
				</form>
			</div>
		</div>
	</center>

        <script type="text/javascript">
       		$(".conteynir").animate({'opacity': 1}, 400).css('margin-top', '15%');
       	</script>
		
		<script type="text/javascript">
			function sayfadancik($sayfa)
			{
				$('.conteynir').animate({'opacity': 0}, 400, function(){
         			document.location.href = $sayfa;
       			});
       		}
        </script>




		<script type="text/javascript">
			$(".ayarlar").click(function() {
				ayarlar();
			});
			$(".icerik").hover(function() {
			}, function() {
				ayarlar();
			});
			function ayarlar() {
				$(".icerik").slideToggle();
			}

			/////////////////////////////////////////			

			$(function () {
    			var data = localStorage.getItem("arkaplan-degisimi");
    			if (data !== null) {
        		$("input[name='arkaplan-degisimi']").attr("checked", "checked");
        		var sayi= Math.floor((Math.random() * 5) + 1);
				$('.arkaplan').css('background', 'url("img/arkaplanlar/' +sayi+ '.png")');
				$('.arkaplan').css('background-repeat', 'no-repeat');
				$('.arkaplan').css('background-size', 'cover');
        		}
        	});
			
			$("input[name=arkaplan-degisimi").click(function () {
				if ($(this).is(":checked")) {
					localStorage.setItem("arkaplan-degisimi", $(this).val());
				} else {
					localStorage.removeItem("arkaplan-degisimi");
				}
			});
			////////////////////////////////////////

			$(function () {
    			var data = localStorage.getItem("arkaplan-bluru");
    			if (data == "true") {
        			$("input[name='arkaplan-bluru']").attr("checked", "checked");
        		}
        		else{
        			$("input[name='arkaplan-bluru']").removeAttr('checked');
					$("body").addClass('blursuz');
        		}
        	});
			
			$("input[name=arkaplan-bluru").click(function () {
				if ($(this).is(":checked")) {
					localStorage.setItem("arkaplan-bluru", "true");
					$("body").toggleClass('arkaplan');
					$("body").removeClass('blursuz');
					$("body").addClass('arkaplan');
				} else {
					localStorage.setItem("arkaplan-bluru", "false");
					$("body").addClass('blursuz');
				}
			});
			/////////////////////////////////////////

			$(function () {
    			var data = localStorage.getItem("arkaplan-hareketi");
    			if (data !== null) {
        		$("input[name='arkaplan-hareketi']").attr("checked", "checked");
        			$(".arkaplan").backgroundMove({movementStrength:'60'});
        		}
        	});
			
			$("input[name=arkaplan-hareketi").click(function () {
				if ($(this).is(":checked")) {
					localStorage.setItem("arkaplan-hareketi", $(this).val());
				} else {
					localStorage.removeItem("arkaplan-hareketi");
				}
			});
		</script>
</body>
</html>