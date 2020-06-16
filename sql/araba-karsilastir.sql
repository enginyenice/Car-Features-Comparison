-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 16 Haz 2020, 11:30:25
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

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `marka`
--

CREATE TABLE `marka` (
  `id` int(11) NOT NULL,
  `marka` varchar(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

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
