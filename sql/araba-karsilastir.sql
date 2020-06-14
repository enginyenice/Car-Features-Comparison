-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost
-- Üretim Zamanı: 14 Haz 2020, 00:17:12
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
  `marka` varchar(254) NOT NULL,
  `model` varchar(254) NOT NULL,
  `yil` int(11) NOT NULL,
  `agirlik` float(10,2) NOT NULL,
  `motorHacmi` float(10,2) NOT NULL,
  `tekerSayisi` int(10) NOT NULL,
  `maxHiz` float(10,2) NOT NULL,
  `vites` int(10) NOT NULL,
  `renk` varchar(254) NOT NULL,
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

--
-- Tablo döküm verisi `kullanici`
--

INSERT INTO `kullanici` (`id`, `adSoyad`, `eposta`, `sifre`, `aktivasyonKodu`) VALUES
(2, 'Engin Yenice', 'enginyenice2626@gmail.com', 'karakafkef22', ''),
(9, 'Tolunay Esergün', 'tolunay50@gmail.com', 'ftgb7v9acJ', '');

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
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `arac`
--
ALTER TABLE `arac`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
