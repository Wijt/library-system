<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hoşgeldiniz!</title>
    <link rel="stylesheet" href="../css/anasayfa.css">
    <link rel="shortcut icon" href="../img/favicon.ico">
    <script src="../js/jquery.js"></script>
    <script src="../js/jquery.backgroundMove.js"></script>
</head>
<?php
    require 'database.php';
    $db = new Database();
    $_DURUM['mesaj'] = "";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(!empty($_POST['ad']) and !empty($_POST['soyad']) and !empty($_POST['dogumtarihi']) and !empty($_POST['kuladi']) and !empty($_POST['eposta']) and !empty($_POST['sifre']))
        {
            $ad = htmlspecialchars($_POST['ad']);
            $soyad = htmlspecialchars($_POST['soyad']);
            $dogumtarihi = htmlspecialchars($_POST['dogumtarihi']);
            $kuladi = htmlspecialchars($_POST['kuladi']);
            $eposta = htmlspecialchars($_POST['eposta']);
            $sifre = htmlspecialchars($_POST['sifre']);
            $result = $db->result('id','*','kullanicilar',array('kuladi' => $kuladi),'ad',false);
            if (!count($result)>0) { 
                $insert = $db->insert(
                        'kullanicilar',
                        array(
                            'kuladi' => $kuladi,
                            'sifre' => hash('sha512', $sifre, FALSE),
                            'eposta' => $eposta,
                            'ad' => $ad,
                            'soyad' => $soyad,
                            'dogumgunu' => $dogumtarihi,
                            'yetki' => 'kullanici'
                        )
                    );
                if ($insert) {
                    $_DURUM['mesaj']="Başarıyla kaydoldunuz. Girişe yönlendiriliyorsunuz.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('basari').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                    header("Refresh:2; url=../index.php");
                }else{
                    $_DURUM['mesaj']="Kaydolunamadı. Tekrar deneyiniz.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                    header("Refresh:2; url=kayitsayfasi.php");
                }
            }
            else{
                $_DURUM['mesaj']="Kullanıcı mevcut. Tekrar deneyiniz.";
                echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                header("Refresh:2; url=kayitsayfasi.php");
            }
        }
        else{
              $_DURUM['mesaj']="Lütfen boş alan bırakmayınız.";
                echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                header("Refresh:2; url=kayitsayfasi.php");
        }
    }
?>
<body class="arkaplan">
    <div class="ayarlar"></div>
    <div class="icerik">
    <script type='text/javascript'>
        $(function(){Sayfayukle();});
    </script>
        <table class="ayarlar-tablo">
            <tr>
                <th>
                    <input type="checkbox" name="arkaplan-hareketi">
                </th>
                <th>ARKAPLAN HAREKETİ</th>
            </tr>
            <tr>
                <th>
                    <input type="checkbox" name="arkaplan-bluru">
                </th>
                <th>ARKAPLAN BLURU</th>
            </tr>
            <tr>
                <th>
                    <input type="checkbox" name="arkaplan-degisimi">
                </th>
                <th>ARKAPLAN DEĞİŞİMİ</th>
            </tr>
        </table>
    </div>
    <center>
        <div class="conteynir">
            <h2 class="girisbaslik yazi3d">
                <span style="font-size: 35px;color:#0b1019;">K</span>ÜTÜPHANE OTOMASYONUNA HOŞGELDİNİZ</h2>
                <div class="orta-kayit"> 
                    <div class="geriok" onclick="sayfadancik('../index.php');">&#8249;</div> 
                    <div class="kayit-baslik">KAYIT</div> 
                    <hr color="#1a1e24" style="box-shadow: 0px 0px 10px #1a1e24; margin-bottom:20px;"> 
                    <div class="uyari" id="uyari-kutusu" style="opacity: 0,height: 30px"> <?= $_DURUM['mesaj']; ?> </div> 
                    <form method="post"> 
                        <table class="kayit-tablo" border="0"> 
                        <tr> 
                            <th class="sol">Ad :</th> 
                            <th class="sag"> 
                                <input type="text" name="ad" required> 
                            </th> 
                        </tr> 
                        <tr> 
                            <th class="sol">Soyad :</th> 
                            <th class="sag"> 
                                <input type="text" name="soyad" required> 
                            </th> 
                        </tr> 
                        <tr> 
                            <th class="sol">Doğum Tarihi :
                            </th> 
                            <th class="sag"> 
                                <input type="date" name="dogumtarihi" required> 
                            </th> 
                        </tr> 
                        <tr> 
                            <th class="sol">E-posta :</th> 
                            <th class="sag"> 
                                <input type="email" name="eposta" required>
                            </th> 
                        </tr> 
                        <tr> 
                            <th class="sol">Kullanıcı Adı :</th> 
                            <th class="sag"> 
                                <input type="text" name="kuladi" required> 
                            </th> 
                        </tr> 
                        <tr> 
                            <th class="sol">Şifre :</th> 
                            <th class="sag"> 
                                <input type="password" name="sifre" required> 
                            </th> 
                        </tr> 
                    </table> 
                    <button class="buton butonlar" style="width: 140px" id="hesapolustur" formmethod="post" formaction="<?php echo $_SERVER['PHP_SELF']; ?>" type="submit">Hesap Oluştur!</button>
                    </form> 
                </div>
        </div>
    </center>
    <script type="text/javascript">
        function Sayfayukle() {
            $('.conteynir').animate({ 'opacity': 1 }, 400).css('margin-top', '13%');
        }
    </script>
    <script type="text/javascript">
        function sayfadancik($sayfa)
        {
            $('.conteynir').animate({'opacity': 0}, 400, function(){
                document.location.href = "../index.php";
            });
        }
    </script>

    <script type="text/javascript">
    $(".ayarlar").click(function() {
        ayarlar();
    });
    $(".icerik").hover(function() {}, function() {
        ayarlar();
    });

    function ayarlar() {
        $(".icerik").slideToggle();
    }
    /////////////////////////////////////////
    $(function() {
        var data = localStorage.getItem("arkaplan-degisimi");
        if (data !== null) {
            $("input[name='arkaplan-degisimi']").attr("checked", "checked");
            var sayi = Math.floor((Math.random() * 5) + 1);
            $('.arkaplan').css('background', 'url("img/arkaplanlar/' + sayi + '.png")');
            $('.arkaplan').css('background-repeat', 'no-repeat');
            $('.arkaplan').css('background-size', 'cover');
        }
    });

    $("input[name=arkaplan-degisimi").click(function() {
        if ($(this).is(":checked")) {
            localStorage.setItem("arkaplan-degisimi", $(this).val());
        } else {
            localStorage.removeItem("arkaplan-degisimi");
        }
    });
    ////////////////////////////////////////
    $(function() {
        var data = localStorage.getItem("arkaplan-bluru");
        if (data == "true") {
            $("input[name='arkaplan-bluru']").attr("checked", "checked");
        } else {
            $("input[name='arkaplan-bluru']").removeAttr('checked');
            $("body").addClass('blursuz');
        }
    });

    $("input[name=arkaplan-bluru").click(function() {
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
    $(function() {
        var data = localStorage.getItem("arkaplan-hareketi");
        if (data !== null) {
            $("input[name='arkaplan-hareketi']").attr("checked", "checked");
            $(".arkaplan").backgroundMove({ movementStrength: '60' });
        }
    });

    $("input[name=arkaplan-hareketi").click(function() {
        if ($(this).is(":checked")) {
            localStorage.setItem("arkaplan-hareketi", $(this).val());
        } else {
            localStorage.removeItem("arkaplan-hareketi");
        }
    });
    </script>
</body>

</html>