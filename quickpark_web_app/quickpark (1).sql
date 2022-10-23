-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 26 Sty 2022, 11:29
-- Wersja serwera: 10.4.21-MariaDB
-- Wersja PHP: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `quickpark`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `places`
--

CREATE TABLE `places` (
  `idmiejsca` int(11) UNSIGNED NOT NULL,
  `status` tinyint(1) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `places`
--

INSERT INTO `places` (`idmiejsca`, `status`) VALUES
(0, 1),
(1, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tickets`
--

CREATE TABLE `tickets` (
  `idticket` int(10) UNSIGNED NOT NULL,
  `idmiejsca` int(10) UNSIGNED NOT NULL,
  `rejestracja` text COLLATE utf8_polish_ci NOT NULL,
  `czas_start` timestamp NOT NULL DEFAULT current_timestamp(),
  `czas_stop` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci COMMENT='Tabela zawierająca wszystkie AKTUALNE bilety.';

--
-- Zrzut danych tabeli `tickets`
--

INSERT INTO `tickets` (`idticket`, `idmiejsca`, `rejestracja`, `czas_start`, `czas_stop`) VALUES
(1, 1, 'SMY3R33', '2021-10-25 08:49:08', '2021-10-25 11:47:46'),
(2, 2, 'SMI5YE7', '2021-10-25 08:50:03', '2021-10-25 12:49:31'),
(3, 44, 'SMY5HM8', '2021-10-25 08:52:02', '2021-10-25 13:51:39'),
(10, 2, 'SMY3R33', '2021-10-31 16:21:28', '2021-10-31 19:21:28'),
(11, 2, 'SMY3R33', '2021-10-31 16:33:11', '2021-10-31 21:33:11'),
(12, 9, 'SMY4CP4', '2021-10-31 16:37:17', '2021-10-31 18:37:17'),
(13, 2, 'SMY3R33', '2021-10-31 19:33:56', '2021-10-31 21:33:56'),
(14, 2, 'SMY3R33', '2021-11-01 20:50:32', '2021-11-01 22:50:32'),
(15, 7, 'SMIGK73', '2021-11-02 08:24:33', '2021-11-02 11:24:33'),
(16, 3, 'SMY3R33', '2021-11-07 20:12:27', '2021-11-07 23:12:27'),
(17, 4, 'SMY3R33', '2021-11-08 07:15:58', '2021-11-08 09:15:58'),
(18, 2, 'SMY3R33', '2021-11-29 14:57:18', '2021-11-29 16:57:18'),
(19, 2, 'SMY3R33', '2021-12-03 18:25:57', '2021-12-03 21:25:57'),
(20, 2, 'SMY3R33', '2021-12-06 08:53:23', '2021-12-06 10:53:23'),
(21, 5, 'ABC1234', '2021-12-08 10:08:53', '2021-12-08 13:08:53'),
(22, 2, 'SMY3R33', '2021-12-08 10:14:20', '2021-12-08 12:14:20'),
(23, 2, 'DD23523', '2021-12-14 16:04:51', '2021-12-14 19:04:51');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `userid` int(11) UNSIGNED NOT NULL,
  `login` text COLLATE utf8_polish_ci NOT NULL,
  `password` text COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`userid`, `login`, `password`) VALUES
(1, 'admin', '$2y$10$zogmo0oO9I2cktF5rbVKYejSh541iWyxKTjg0P2ES1NMeakL7IVdO');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idticket`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userid`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idticket` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `userid` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
