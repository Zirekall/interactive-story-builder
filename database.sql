-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 10 Sie 2021, 02:45
-- Wersja serwera: 10.3.28-MariaDB-cll-lve
-- Wersja PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `mghxppxk_inzynier`
--
CREATE DATABASE IF NOT EXISTS `mghxppxk_inzynier` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `mghxppxk_inzynier`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `admins`
--

CREATE TABLE `admins` (
  `adminID` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `passw` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `czesci`
--

CREATE TABLE `czesci` (
  `globalID` varchar(20) NOT NULL,
  `localID` int(11) NOT NULL,
  `Lewo` text NOT NULL,
  `prawo` text NOT NULL,
  `label` varchar(255) NOT NULL,
  `ID_opowiesci` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `formularze`
--

CREATE TABLE `formularze` (
  `ID_formularza` varchar(20) NOT NULL,
  `adminID` int(11) NOT NULL,
  `nazwa_formularza` varchar(255) NOT NULL,
  `data_utworzenia` date NOT NULL,
  `listed` tinyint(1) NOT NULL,
  `id_opowiesci` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `form_wyniki`
--

CREATE TABLE `form_wyniki` (
  `ID_wyniku` varchar(30) NOT NULL,
  `punkty` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `ID_formularza` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odpowiedzi`
--

CREATE TABLE `odpowiedzi` (
  `ID_odpowiedzi` int(11) NOT NULL,
  `ID_wyniku` varchar(40) NOT NULL,
  `localID` int(11) NOT NULL,
  `odpowiedz` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `opowiesci`
--

CREATE TABLE `opowiesci` (
  `id_opowiesci` varchar(40) NOT NULL,
  `adminID` int(11) NOT NULL,
  `Nazwa` varchar(255) NOT NULL,
  `data_utworzenia` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania`
--

CREATE TABLE `pytania` (
  `ID_pytania` int(11) NOT NULL,
  `localID` int(11) NOT NULL,
  `ID_formularza` varchar(20) NOT NULL,
  `tresc` text NOT NULL,
  `etykieta` text NOT NULL,
  `Typ` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `sciezki`
--

CREATE TABLE `sciezki` (
  `ID` int(11) NOT NULL,
  `globalID` varchar(20) NOT NULL,
  `poprzedni` int(11) NOT NULL,
  `ID_opowiesci` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `story_wyniki`
--

CREATE TABLE `story_wyniki` (
  `ID` int(11) NOT NULL,
  `ID_wyniku` varchar(20) NOT NULL,
  `ID_opowiesci` varchar(20) NOT NULL,
  `GlobalID` varchar(20) NOT NULL,
  `LocalID` int(11) NOT NULL,
  `Timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`adminID`);

--
-- Indeksy dla tabeli `czesci`
--
ALTER TABLE `czesci`
  ADD PRIMARY KEY (`globalID`);

--
-- Indeksy dla tabeli `formularze`
--
ALTER TABLE `formularze`
  ADD PRIMARY KEY (`ID_formularza`);

--
-- Indeksy dla tabeli `form_wyniki`
--
ALTER TABLE `form_wyniki`
  ADD PRIMARY KEY (`ID_wyniku`);

--
-- Indeksy dla tabeli `odpowiedzi`
--
ALTER TABLE `odpowiedzi`
  ADD PRIMARY KEY (`ID_odpowiedzi`);

--
-- Indeksy dla tabeli `opowiesci`
--
ALTER TABLE `opowiesci`
  ADD UNIQUE KEY `id_opowiesci` (`id_opowiesci`);

--
-- Indeksy dla tabeli `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`ID_pytania`);

--
-- Indeksy dla tabeli `sciezki`
--
ALTER TABLE `sciezki`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `story_wyniki`
--
ALTER TABLE `story_wyniki`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `admins`
--
ALTER TABLE `admins`
  MODIFY `adminID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `odpowiedzi`
--
ALTER TABLE `odpowiedzi`
  MODIFY `ID_odpowiedzi` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `pytania`
--
ALTER TABLE `pytania`
  MODIFY `ID_pytania` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `sciezki`
--
ALTER TABLE `sciezki`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `story_wyniki`
--
ALTER TABLE `story_wyniki`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
