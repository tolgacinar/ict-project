-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 23 Nis 2021, 10:38:07
-- Sunucu sürümü: 10.4.16-MariaDB
-- PHP Sürümü: 7.3.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `ict-project`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `car_brands`
--

CREATE TABLE `car_brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `car_brands`
--

INSERT INTO `car_brands` (`brand_id`, `brand_name`, `brand_status`) VALUES
(1, 'Renault', 1),
(2, 'Ford', 1),
(3, 'Opel', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `car_models`
--

CREATE TABLE `car_models` (
  `model_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_name` varchar(255) NOT NULL,
  `model_segment` varchar(1) NOT NULL,
  `model_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `car_models`
--

INSERT INTO `car_models` (`model_id`, `brand_id`, `model_name`, `model_segment`, `model_status`) VALUES
(1, 1, 'Clio', 'A', 1),
(2, 1, 'Capture', 'D', 1),
(3, 1, 'Symbol', 'S', 1),
(4, 2, 'Focus', 'A', 1),
(5, 2, 'Fiesta', 'D', 1),
(6, 2, 'Puma', 'S', 1),
(7, 3, 'Astra', 'A', 1),
(8, 3, 'Vectra', 'D', 1),
(9, 3, 'Corsa', 'S', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `customers`
--

CREATE TABLE `customers` (
  `customer_id` int(11) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `repair_areas`
--

CREATE TABLE `repair_areas` (
  `area_id` int(11) NOT NULL,
  `area_name` varchar(255) NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `area_capacity` int(5) NOT NULL,
  `area_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `repair_areas`
--

INSERT INTO `repair_areas` (`area_id`, `area_name`, `type_id`, `area_capacity`, `area_status`) VALUES
(1, 'Tamir Alanı 1', 1, 10, 1),
(2, 'Tamir Alanı 2', 1, 10, 1),
(3, 'Tamir Alanı 3', 1, 10, 1),
(4, 'Tamir Alanı 4', 2, 10, 1),
(5, 'Tamir Alanı 5', 2, 10, 1),
(6, 'Tamir Alanı 6', 2, 10, 1),
(7, 'Tamir Alanı 7', 3, 10, 1),
(8, 'Tamir Alanı 8', 3, 10, 1),
(9, 'Tamir Alanı 9', 3, 10, 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `repair_types`
--

CREATE TABLE `repair_types` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(255) NOT NULL,
  `type_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Tablo döküm verisi `repair_types`
--

INSERT INTO `repair_types` (`type_id`, `type_name`, `type_status`) VALUES
(1, 'Tamir Türü 1', 1),
(2, 'Tamir Türü 2', 1),
(3, 'Tamir Türü 3', 1);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `model_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `transaction_date` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `transaction_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Tablo için indeksler `car_models`
--
ALTER TABLE `car_models`
  ADD PRIMARY KEY (`model_id`),
  ADD KEY `brand_id` (`brand_id`);

--
-- Tablo için indeksler `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`);

--
-- Tablo için indeksler `repair_areas`
--
ALTER TABLE `repair_areas`
  ADD PRIMARY KEY (`area_id`),
  ADD KEY `type_id` (`type_id`);

--
-- Tablo için indeksler `repair_types`
--
ALTER TABLE `repair_types`
  ADD PRIMARY KEY (`type_id`);

--
-- Tablo için indeksler `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `customer_id` (`customer_id`,`brand_id`,`model_id`,`type_id`,`area_id`),
  ADD KEY `brand_id` (`brand_id`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `type_id` (`type_id`),
  ADD KEY `area_id` (`area_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `car_models`
--
ALTER TABLE `car_models`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Tablo için AUTO_INCREMENT değeri `repair_areas`
--
ALTER TABLE `repair_areas`
  MODIFY `area_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Tablo için AUTO_INCREMENT değeri `repair_types`
--
ALTER TABLE `repair_types`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Tablo için AUTO_INCREMENT değeri `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `car_models`
--
ALTER TABLE `car_models`
  ADD CONSTRAINT `car_models_ibfk_1` FOREIGN KEY (`brand_id`) REFERENCES `car_brands` (`brand_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `repair_areas`
--
ALTER TABLE `repair_areas`
  ADD CONSTRAINT `repair_areas_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `repair_types` (`type_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Tablo kısıtlamaları `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`customer_id`),
  ADD CONSTRAINT `transactions_ibfk_2` FOREIGN KEY (`brand_id`) REFERENCES `car_brands` (`brand_id`),
  ADD CONSTRAINT `transactions_ibfk_3` FOREIGN KEY (`model_id`) REFERENCES `car_models` (`model_id`),
  ADD CONSTRAINT `transactions_ibfk_4` FOREIGN KEY (`type_id`) REFERENCES `repair_types` (`type_id`),
  ADD CONSTRAINT `transactions_ibfk_5` FOREIGN KEY (`area_id`) REFERENCES `repair_areas` (`area_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
