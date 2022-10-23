-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Lis 2021, 18:24
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
(15, 7, 'SMIGK73', '2021-11-02 08:24:33', '2021-11-02 11:24:33');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`idticket`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `tickets`
--
ALTER TABLE `tickets`
  MODIFY `idticket` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
