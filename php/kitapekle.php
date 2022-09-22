<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Kitap Ekle!</title>
    <link rel="stylesheet" href="../css/anasayfa.css">
    <link rel="shortcut icon" href="../img/favicon.ico">
    <script src="../js/jquery.js"></script>
</head>
<?php
    if(!isset($_SESSION["kul-adi"]))
    {
        header("Refresh:2; url=../index.php");
        die("Giriş yapılmadı.");
    }else{
        if($_SESSION["kul-yetki"]!="yonetici"){
            header("Refresh:2; url=../index.php");
            die("Buraya sadece yöneticiler erişebilir.");
        }
    }
    require 'database.php';
    $db = new Database();
    $_DURUM['mesaj'] = "";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        if(!empty($_POST['kitap-adi']) and !empty($_POST['yazar']) and !empty($_POST['sayfa-sayisi']) and !empty($_POST['resim-linki']))
        {
            $kitap_adi = trim($_POST['kitap-adi']);
            $yazar = trim($_POST['yazar']);
            $sayfa_sayisi = trim($_POST['sayfa-sayisi']);
            $resim_linki = trim($_POST['resim-linki']);
            dosya_indir($resim_linki,replace_tr(str_replace(" ", "_", $kitap_adi)));
            $yayinevi=trim($_POST['yayinevi']);
            $insert = $db->insert(
                        'kitaplar',
                        array(
                            'kitap_adi' => $kitap_adi,
                            'yazar' => $yazar,
                            'sayfa_sayisi' => $sayfa_sayisi,
                            'YayinEvi'=> $yayinevi,
                            'resim' => replace_tr(str_replace(" ", "_", $kitap_adi))
                            )
                    );
            echo str_replace(" ", "_", $kitap_adi);
                if ($insert) {
                    $_DURUM['mesaj']="Kitap başarıyla eklendi.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('basari').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                    header("Refresh:2");
                }else{
                    $_DURUM['mesaj']="Eklenemedi. Tekrar deneyiniz.";
                    echo "<script type='text/javascript'>$(function(){ $('#uyari-kutusu').addClass('hata').animate({opacity:'1',height:'30px'}, 1000)});</script>";
                    header("Refresh:2");
                }
         }   
    }

    function replace_tr($text) {
        $text = trim($text);
        $search = array('Ç','ç','Ğ','ğ','ı','İ','Ö','ö','Ş','ş','Ü','ü',' ','\'','!',':',';',',','.');
        $replace = array('c','c','g','g','i','i','o','o','s','s','u','u','-','','','','','','');
        $new_text = str_replace($search,$replace,$text);
        return $new_text;
    }  

    function dosya_indir($link,$name=null)
    {
    
        $link_info = pathinfo($link);  //Yol bilgilerini değişkene atıyoruz.
        $uzanti = strtolower($link_info['extension']); //Dosyanın uzantısını değişkene atıyoruz.
        echo $name.'.'.$uzanti;
        $file = ($name) ? $name.'.'.$uzanti : $link_info['basename'];
        $yolcuk = "../img/kitaplar/".$file; // Dosya buradan çektigimiz dosyanin kaydedilecegi yeri seciyoruz
        $curl = curl_init($link);
        $fopen = fopen($yolcuk,'w');
        curl_setopt($curl, CURLOPT_HEADER,0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($curl, CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_0);
        curl_setopt($curl, CURLOPT_FILE, $fopen);
        curl_exec($curl);
        curl_close($curl);
        fclose($fopen);
    }   
?>
<body class="arkaplan">
    <div class="ayarlar"></div>
    <div class="icerik">
    <script type='text/javascript'>
        $(function(){Sayfayukle();});
    </script>
    </div>
    <center>
        <div class="conteynir">
                <div class="orta-kayit"> 
                    <div class="geriok" onclick="sayfadancik('anasayfa.php');">&#8249;</div> 
                    <div class="kayit-baslik">Kitap Ekle</div> 
                    <hr color="#1a1e24" style="box-shadow: 0px 0px 10px #1a1e24; margin-bottom:20px;"> 
                    <div class="uyari" id="uyari-kutusu" style="opacity: 0,height: 30px"> <?= $_DURUM['mesaj']; ?> </div> 
                    <form method="post">
                    	<table class="kayit-tablosu">
                    		<tr>
                    			<td>Kitap adı:</td>
                    			<td><input type="text" name="kitap-adi"></td>
                    		</tr>
                    		<tr>
                    			<td>Yazar:</td>
                    			<td><input type="text" name="yazar"></td>
                    		</tr>
                    		<tr>
                    			<td>Sayfa sayısı:</td>
                    			<td><input type="number" name="sayfa-sayisi"></td>
                    		</tr>
                            <tr>
                                <td>Yayınevi:</td>
                                <td><input type="text" name="yayinevi"></td>
                            </tr>
                    		<tr>
                    			<td>Kitap resmi:</td>
                    			<td><input type="text" name="resim-linki"></td>
                    		</tr>
                    	</table>
                    <button class="buton butonlar" style="width: 140px" id="hesapolustur" formmethod="post" formaction="<?php echo $_SERVER['PHP_SELF']; ?>" type="submit">Ekle</button>
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
                document.location.href = $sayfa;
            });
        }
    </script>
</body>

</html>