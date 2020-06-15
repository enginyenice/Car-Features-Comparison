-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 15 Haz 2020, 11:20:45
-- Sunucu sürümü: 8.0.17
-- PHP Sürümü: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `araba-karsilastir`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `arac`
--

CREATE TABLE `arac` (
  `id` int(11) NOT NULL,
  `marka_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `yil` int(11) NOT NULL,
  `agirlik` float(10,2) NOT NULL,
  `motorHacmi` int(10) NOT NULL,
  `tekerSayisi` int(10) NOT NULL,
  `maxHiz` float(10,2) NOT NULL,
  `vites` int(10) NOT NULL,
  `renk` varchar(254) NOT NULL,
  `yakitTuru` varchar(254) NOT NULL,
  `resim` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `arac`
--

INSERT INTO `arac` (`id`, `marka_id`, `model_id`, `yil`, `agirlik`, `motorHacmi`, `tekerSayisi`, `maxHiz`, `vites`, `renk`, `yakitTuru`, `resim`) VALUES
(17, 12, 16, 2000, 20.00, 20, 20, 20.00, 5, '20', '20', 'anaklasor/../images/2viqYilginc-araba.jpg'),
(18, 10, 10, 2020, 2.00, 100, 4, 250.00, 6, 'Siyah', 'Benzinli', 'anaklasor/../images/t0JU3bmw-x1-desktop.jpg');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `id` int(11) NOT NULL,
  `adSoyad` varchar(254) NOT NULL,
  `eposta` varchar(254) NOT NULL,
  `sifre` varchar(254) NOT NULL,
  `aktivasyonKodu` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `adSoyad`, `eposta`, `sifre`, `aktivasyonKodu`) VALUES
(2, 'Engin Yenice', 'enginyenice2626@gmail.com', 'karakafkef22', ''),
(9, 'Tolunay Esergün', 'tolunay50@gmail.com', 'ftgb7v9acJ', '');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `marka`
--

CREATE TABLE `marka` (
  `id` int(11) NOT NULL,
  `marka` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `marka`
--

INSERT INTO `marka` (`id`, `marka`) VALUES
(10, 'BMW'),
(11, 'Ferrari'),
(12, 'Audi');

--
-- Tetikleyiciler `marka`
--
DELIMITER $$
CREATE TRIGGER `bir_urun_silindi` BEFORE DELETE ON `marka` FOR EACH ROW BEGIN
  DELETE FROM model WHERE marka_id= OLD.id;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `marka_arac_silindi` BEFORE DELETE ON `marka` FOR EACH ROW DELETE FROM arac WHERE marka_id=OLD.id
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `marka_id` int(11) NOT NULL,
  `model` varchar(254) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `model`
--

INSERT INTO `model` (`id`, `marka_id`, `model`) VALUES
(10, 10, 'x1'),
(11, 11, '250 GTO'),
(12, 11, 'Enzo'),
(13, 11, 'F12 Berlinetta'),
(14, 12, 'A3'),
(15, 12, 'A4'),
(16, 12, 'A5'),
(17, 12, 'A6');

--
-- Tetikleyiciler `model`
--
DELIMITER $$
CREATE TRIGGER `model_arac_sil` BEFORE DELETE ON `model` FOR EACH ROW DELETE FROM arac WHERE model_id=OLD.id
$$
DELIMITER ;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `arac`
--
ALTER TABLE `arac`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `marka`
--
ALTER TABLE `marka`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `arac`
--
ALTER TABLE `arac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `marka`
--
ALTER TABLE `marka`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Tablo için AUTO_INCREMENT değeri `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
