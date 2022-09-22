<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hoşgeldiniz!</title>
    <link rel="stylesheet" href="../css/anasayfa.css">
    <link rel="shortcut icon" href="../img/favicon.ico">
    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="../js/jquery.backgroundMove.js"></script>
</head>
<?php
    require_once ('Database.php');
    $db = new Database();
    $result = $db->result('id','*','kitaplar',null,'kitap_adi',false);
    print_r($result);
?>
<body class="arkaplan-anasayfa">
    <center>
        <h2 class="yazi3d" style="font-size: 33px;font-weight: bolder;"><span style="font-size: 35px;">K</span>ÜTÜPHANE OTOMASYONUNA HOŞGELDİNİZ</h2>
        <div class="anas-orta">
            <?php
                    $i=0;
                    while ($i<=10){
                    echo "<table class='kitaplar' width='540' border='5' cellpadding='10px'>
                            <tr>
                              <td width='193' rowspan='7'><img width='206' height='320' src='../img/kitaplar/".$result[$i]["resim"]."'></img></td>
                              <td colspan='2' align='center' style='font-size:23px;font-weight:bolder;'>".$result[$i]["kitap_adi"]."</td>
                            </tr>
                            <tr>
                              <td width='126'>Yazar:</td>
                              <td width='199'>".$result[$i]["yazar"]."</td>
                            </tr>
                            <tr>
                              <td>Çeviren:</td>
                              <td>".$result[$i]["ceviren"]."</td>
                            </tr>
                            <tr>
                              <td>Yayınevi:</td>
                              <td>".$result[$i]["YayinEvi"]."</td>
                            </tr>
                            <tr>
                              <td>Sayfa Sayısı:</td>
                              <td>".$result[$i]["sayfa_sayisi"]."</td>
                            </tr>
                            <tr>
                              <td>Depoda mı?</td>
                              <td>".($result[$i]["depoda"]==true?'Kütüphanede var':'Ödünç alınmış')."</td>
                            </tr>
                            <tr>
                              ".($result[$i]["depoda"]==false?'<td>Kitabı alan:</td>
                              <td>'.$result[$i]["odunc_alan"].'</td>':'')."
                            </tr>
                            <tr>
                              <td>Kitap numarası:</td>
                              <td>".$result[$i]["id"]."</td>
                            </tr>
                        </table>";
                        $i++;
                    }
                ?></div>
        <div class="anas-alt"></div>
    </center>
</body>
</html>