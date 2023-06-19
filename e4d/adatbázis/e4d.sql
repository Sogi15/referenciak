-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20221120.420485a41b
-- https://www.phpmyadmin.net/
--
-- Gép: 127.0.0.1
-- Létrehozás ideje: 2023. Máj 11. 17:35
-- Kiszolgáló verziója: 10.4.24-MariaDB
-- PHP verzió: 8.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Adatbázis: `e4d`
--
CREATE DATABASE IF NOT EXISTS `e4d` DEFAULT CHARACTER SET utf8 COLLATE utf8_hungarian_ci;
USE `e4d`;

-- --------------------------------------------------------

--
-- Tábla szerkezet ehhez a táblához `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_hungarian_ci NOT NULL,
  `rank` int(11) NOT NULL COMMENT '0- admin | 1- felhasználó'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_hungarian_ci;

--
-- A tábla adatainak kiíratása `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password`, `rank`) VALUES
(1, 'teszt@elek.hu', 'Teszt', '$2y$10$fmAPW97iLIcYOo8qgi5b3ejukr0f52dUABHloWfTU20i/486xa2eK', 1),
(2, 'admin@admin', 'admin', '$2y$10$CmWyMt7GmKSTLOJBkOHWau4vrXbZ1YY20gAC3ANc5lST7pFUu1mjS', 0);

--
-- Indexek a kiírt táblákhoz
--

--
-- A tábla indexei `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- A kiírt táblák AUTO_INCREMENT értéke
--

--
-- AUTO_INCREMENT a táblához `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
