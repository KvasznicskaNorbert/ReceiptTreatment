-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Feb 21. 12:54
-- Kiszolgáló verziója: 10.4.25-MariaDB
-- PHP verzió: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `szamla`
--
CREATE DATABASE IF NOT EXISTS `szamla` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `szamla`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `szamlaadatok`
--

CREATE TABLE IF NOT EXISTS `szamlaadatok` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(128) NOT NULL,
  `nyugta` varchar(12) NOT NULL,
  `szamla` varchar(12) NOT NULL,
  `vevoneve` varchar(128) DEFAULT NULL,
  `bevosszeg` int(64) NOT NULL,
  `kifizdatum` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `email` varchar(64) NOT NULL,
  `username` varchar(64) NOT NULL,
  `pass` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Megkötések a kiírt táblákhoz
--

--
-- Megkötések a táblához `szamlaadatok`
--
ALTER TABLE `szamlaadatok`
  ADD CONSTRAINT `szamlaadatok_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
