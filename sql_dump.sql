-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 22 Eyl 2022, 15:51:26
-- Sunucu sürümü: 10.2.43-MariaDB-cll-lve
-- PHP Sürümü: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kitaplar`
--

CREATE TABLE `kitaplar` (
  `id` int(11) NOT NULL,
  `resim` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `kitap_adi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `yazar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sayfa_sayisi` int(11) NOT NULL,
  `depoda` tinyint(1) DEFAULT 1,
  `odunc_alan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `YayinEvi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ekleyen` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `kitaplar`
--

INSERT INTO `kitaplar` (`id`, `resim`, `kitap_adi`, `yazar`, `sayfa_sayisi`, `depoda`, `odunc_alan`, `YayinEvi`, `ekleyen`) VALUES
(1, 'dünyanınmerkezineyolculuk_yorumcadısı.png', 'Dünyanın Merkezine Yolculuk', 'Jules Verne', 144, 0, 'Furkann', 'Say Yayınları', 'Wijt'),
(2, 'dehsetagi_yorumcadisi.png', 'Doctor Who: Dehşet Ağı', 'Mike Tucker', 192, 0, 'dncstudyo', 'Say Yayınları', 'Wijt'),
(3, 'serguzest.jpg', 'Sergüzeşt', 'Samipaşazade Sezai', 120, 0, 'Wijt', 'Morpa Kültür Yayınları', 'Wijt'),
(4, 'sehirmektuplari.jpg', 'Şehir Mektupları', 'Ahmet Rasim', 200, 1, NULL, 'Morpa Kültür Yayınları', 'Wijt'),
(5, 'kutadgubilig.jpg', 'Kutadgu Bilig', 'Yusuf Has Hacip', 250, 0, 'dncstudyo', 'Morpa Kültür Yayınları', 'Wijt'),
(6, 'Bize_gore.jpg', 'Bize göre', 'Ahmet Haşim', 134, 1, NULL, 'Say Yayınları', 'Wijt'),
(7, 'Babalar_ve_ogullar.jpg', 'Babalar Ve Oğullar', 'Ivan Turgenyev', 146, 1, NULL, 'Can Yayınları', 'Wijt'),
(8, 'Savas_ve_Baris.jpg', 'Savaş ve Barış', 'Lev Tolstoy', 544, 0, 'Wijt', 'Anonim Yayınları', 'Wijt'),
(9, 'Deli_Bey.jpg', 'Deli Bey', 'Gülten Dayıoğlu', 64, 1, NULL, 'Altın Kitaplar', 'Wijt'),
(10, 'Sultani_oldurmek.jpg', 'Sultanı öldürmek', 'Ahmet Ümit', 528, 1, NULL, 'Everest Yayınları', 'Wijt'),
(11, 'Ferrarisini_Satan_Bilge.jpg', 'Ferrari\'sini Satan Bilge', 'Robin Sharma', 232, 1, NULL, 'Pegasus', 'Wijt');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanicilar`
--

CREATE TABLE `kullanicilar` (
  `id` int(11) NOT NULL,
  `kuladi` varchar(255) NOT NULL,
  `sifre` varchar(255) NOT NULL,
  `eposta` varchar(255) NOT NULL,
  `ad` varchar(255) NOT NULL,
  `soyad` varchar(255) NOT NULL,
  `dogumgunu` varchar(255) NOT NULL,
  `yetki` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `kullanicilar`
--

INSERT INTO `kullanicilar` (`id`, `kuladi`, `sifre`, `eposta`, `ad`, `soyad`, `dogumgunu`, `yetki`) VALUES
(1, 'Wijt', 'f82e257733eaa1b86e0318eb28cc3b466e5ed750c76ea6d9799c636c72547f12264bf6bb12f36df4ba6720bbc21b89a939786e0edba719f9679748f6b17ca31c', '8fkaya@gmail.com', 'Furkan', 'Kaya', '2000-10-17', 'yonetici'),
(2, 'Disconnected.1', '4df7814178c00c4ca0215c01040af15d69fd5cfd984c81f684fe45c1e560d1c6582ca7266370036641cc0e530bd08cad5f94405cc03293a8020c8422852fc6d6', 'demiribrahim.506@gmail.com', 'İbrahim', 'Demir', '1995-01-01', 'kullanici'),
(3, 'Jamwit12', 'c3238f259668b72d4c84591d98581398ac35ca4e83161be56b9a7b54f9b7578a2e6d689a606d1952c70bc1200d9314eb244aa1beda661f2a28fc7ed22af78135', 'hushdilcss@gmail.com', 'Jamshid', 'Karimov', '2000-02-01', 'kullanici'),
(4, 'Ensaribuksel', '2270a6c0ad41e8abed1d913a64d1dd02c26663012fbc458ee42574ee4c8ac74bf61886e696f820e60ffec50de898c4ae41e432c87c224c75fa70982f2c956f41', 'ensari.11fenb@gmail.com', 'Ensari ', 'Buksel', '1987-11-01', 'kullanici'),
(5, 'alifirat', 'f4633247572846324af5c5605eb688ee18dcc5efaa7125dd5547b0fb2063117f0569aa15e65c7eb463f8c60a2f0bf71f5800a2dc2ecaa56705793c44d37d9b87', 'alifiratoztekin21@gmail.com', 'Ali Fırat', 'Öztekin', '2000-05-05', 'kullanici'),
(6, 'ozgur', '41c70b2eaded58dbb82449096de5005170b1c4d6258dfb4f7c562af483207f24d1575daaad29ec00a902ce7beea86d32886536c80e0a3ccb59f5e1aba2443c41', 'ozgurbeybey1@gmail.com', 'alo', 'sa', '275760-04-05', 'kullanici'),
(7, 'dncstudyo', '0443cec087b8e2f670c089216973fb1ff11a6986cba0d264533f2af6b44a50433b63a890d3708b81f2f93de27f7ae68a22cc6c9409f39e08bd202e86ba1b6cf0', 'dncgogo@gmail.com', 'gökhan', 'dinç', '1985-03-16', 'kullanici'),
(8, 'Furkann', '6abd399b2290a412583aeca3ad3854301815c7aa7691c2897eba31eb20ae3248a9a34c21d34b821f6ec4db9072fe543ed0d89a5410cd8635a3650dddfa56be6e', 'asfkjadslkf@gmail.com', 'Furkan', 'Kaya', '1998-11-17', 'kullanici'),
(9, 'kutuphane', '263fec58861449aacc1c328a4aff64aff4c62df4a2d50b3f207fa89b6e242c9aa778e7a8baeffef85b6ca6d2e7dc16ff0a760d59c13c238f6bcdc32f8ce9cc62', 'asdas@gmail.com', 'Furkan', 'Kaya', '2000-10-15', 'kullanici');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `kitaplar`
--
ALTER TABLE `kitaplar`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanicilar`
--
ALTER TABLE `kullanicilar`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `kitaplar`
--
ALTER TABLE `kitaplar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Tablo için AUTO_INCREMENT değeri `kullanicilar`
--
ALTER TABLE `kullanicilar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
