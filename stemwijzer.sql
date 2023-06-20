-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 20 jun 2023 om 15:33
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stemwijzer`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `parties`
--

CREATE TABLE `parties` (
  `partyId` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `partyquestions`
--

CREATE TABLE `partyquestions` (
  `partyQuestionId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `partyId` int(11) NOT NULL,
  `agrees` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `questions`
--

CREATE TABLE `questions` (
  `questionId` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `userquestions`
--

CREATE TABLE `userquestions` (
  `userQuestionId` int(11) NOT NULL,
  `userId` int(11) NOT NULL,
  `questionId` int(11) NOT NULL,
  `agrees` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE `users` (
  `userId` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `parties`
--
ALTER TABLE `parties`
  ADD PRIMARY KEY (`partyId`);

--
-- Indexen voor tabel `partyquestions`
--
ALTER TABLE `partyquestions`
  ADD PRIMARY KEY (`partyQuestionId`),
  ADD KEY `fk_questions_has_parties_parties1_idx` (`partyId`),
  ADD KEY `fk_questions_has_parties_questions1_idx` (`questionId`);

--
-- Indexen voor tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`questionId`);

--
-- Indexen voor tabel `userquestions`
--
ALTER TABLE `userquestions`
  ADD PRIMARY KEY (`userQuestionId`),
  ADD KEY `fk_users_has_questions_questions1_idx` (`questionId`),
  ADD KEY `fk_users_has_questions_users_idx` (`userId`);

--
-- Indexen voor tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`userId`);

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `partyquestions`
--
ALTER TABLE `partyquestions`
  ADD CONSTRAINT `fk_questions_has_parties_parties1` FOREIGN KEY (`partyId`) REFERENCES `parties` (`partyId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_questions_has_parties_questions1` FOREIGN KEY (`questionId`) REFERENCES `questions` (`questionId`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Beperkingen voor tabel `userquestions`
--
ALTER TABLE `userquestions`
  ADD CONSTRAINT `fk_users_has_questions_questions1` FOREIGN KEY (`questionId`) REFERENCES `questions` (`questionId`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_questions_users` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
