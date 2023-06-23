-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 23 jun 2023 om 14:30
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

--
-- Gegevens worden geëxporteerd voor tabel `parties`
--

INSERT INTO `parties` (`partyId`, `name`, `description`) VALUES
(1, 'VVD', 'n.v.t.'),
(2, 'D66', 'n.v.t.'),
(3, 'SP', 'n.v.t.');

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

--
-- Gegevens worden geëxporteerd voor tabel `partyquestions`
--

INSERT INTO `partyquestions` (`partyQuestionId`, `questionId`, `partyId`, `agrees`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 0),
(3, 1, 3, 0),
(4, 2, 1, 1),
(5, 2, 2, 0),
(6, 2, 3, 0),
(7, 3, 1, 0),
(8, 3, 2, 1),
(9, 3, 3, 1),
(10, 4, 1, 0),
(11, 4, 2, 1),
(12, 4, 3, 1),
(13, 5, 1, 0),
(14, 5, 2, 1),
(15, 5, 3, 1),
(16, 6, 1, 1),
(17, 6, 2, 1),
(18, 6, 3, 0),
(19, 7, 1, 1),
(20, 7, 2, 0),
(21, 7, 3, 1),
(22, 8, 1, 1),
(23, 8, 2, 0),
(24, 8, 3, 1),
(25, 9, 1, 1),
(26, 9, 2, 0),
(27, 9, 3, 0),
(28, 10, 1, 0),
(29, 10, 2, 0),
(30, 10, 3, 1);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `questions`
--

CREATE TABLE `questions` (
  `questionId` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `questions`
--

INSERT INTO `questions` (`questionId`, `text`) VALUES
(1, 'De provincie moet velden met zonnepanelen op landbouwgrond verbieden.'),
(2, 'De provincie hoeft geen haast te maken met maatregelen die stikstofuitstoot verminderen.'),
(3, 'Maastricht Aachen Airport moet gesloten worden.'),
(4, 'In Limburg moet de bus gratis zijn voor mensen met een laag inkomen.'),
(5, 'De provincie mag niet toestaan dat natuur verloren gaat door bouwprojecten.'),
(6, 'Limburg moet vooral bedrijven aantrekken die zorgen voor veel werkgelegenheid.'),
(7, 'Er mogen geen windparken bij komen in Limburg.'),
(8, 'Er moeten in Limburg veel minder regels komen voor het bouwen van woningen.'),
(9, 'Overal waar het kan, moet de maximumsnelheid op provinciale wegen omhoog naar 100 km/u.'),
(10, 'De provincie moet meebetalen aan schoolzwemmen in alle gemeenten in Limburg.');

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

--
-- Gegevens worden geëxporteerd voor tabel `userquestions`
--

INSERT INTO `userquestions` (`userQuestionId`, `userId`, `questionId`, `agrees`) VALUES
(1, 9, 1, 1),
(2, 9, 2, 0),
(3, 9, 3, 1),
(4, 9, 4, 0),
(5, 9, 5, 1),
(6, 9, 6, 1),
(7, 9, 7, 0),
(8, 9, 8, 0),
(9, 9, 9, 0),
(10, 9, 10, 1),
(11, 9, 1, 1),
(12, 9, 2, 0),
(13, 9, 3, 1),
(14, 9, 4, 1),
(15, 9, 5, 0),
(16, 9, 6, 0),
(17, 9, 7, 0),
(18, 9, 8, 1),
(19, 9, 9, 1),
(20, 9, 10, 1),
(21, 9, 1, 1),
(22, 9, 2, 0),
(23, 9, 3, 1),
(24, 9, 4, 1),
(25, 9, 5, 1),
(26, 9, 6, 0),
(27, 9, 7, 0),
(28, 9, 8, 0),
(29, 9, 9, 1),
(30, 9, 10, 1),
(31, 9, 1, 1),
(32, 9, 2, 1),
(33, 9, 3, 1),
(34, 9, 4, 1),
(35, 9, 5, 1),
(36, 9, 6, 1),
(37, 9, 7, 1),
(38, 9, 8, 1),
(39, 9, 9, 1),
(40, 9, 10, 1),
(41, 14, 1, 1),
(42, 14, 2, 0),
(43, 14, 3, 1),
(44, 14, 4, 1),
(45, 14, 5, 0),
(46, 14, 6, 0),
(47, 14, 7, 0),
(48, 14, 8, 0),
(49, 14, 9, 1),
(50, 14, 10, 1),
(51, 9, 1, 1),
(52, 9, 2, 1),
(53, 9, 3, 1),
(54, 9, 4, 0),
(55, 9, 5, 1),
(56, 9, 6, 1),
(57, 9, 7, 1),
(58, 9, 8, 0),
(59, 9, 9, 0),
(60, 9, 10, 0),
(61, 9, 1, 1),
(62, 9, 2, 1),
(63, 9, 3, 1),
(64, 9, 4, 1),
(65, 9, 5, 1),
(66, 9, 6, 1),
(67, 9, 7, 1),
(68, 9, 8, 1),
(69, 9, 9, 1),
(70, 9, 10, 1),
(71, 9, 1, 1),
(72, 9, 2, 0),
(73, 9, 3, 1),
(74, 9, 4, 0),
(75, 9, 5, 1),
(76, 9, 6, 0),
(77, 9, 7, 1),
(78, 9, 8, 0),
(79, 9, 9, 1),
(80, 9, 10, 0),
(81, 9, 1, 0),
(82, 9, 2, 1),
(83, 9, 3, 0),
(84, 9, 4, 1),
(85, 9, 5, 0),
(86, 9, 6, 0),
(87, 9, 7, 0),
(88, 9, 8, 1),
(89, 9, 9, 0),
(90, 9, 10, 0),
(91, 9, 1, 1),
(92, 9, 2, 0),
(93, 9, 3, 1),
(94, 9, 4, 1),
(95, 9, 5, 0),
(96, 9, 6, 0),
(97, 9, 7, 0),
(98, 9, 8, 1),
(99, 9, 9, 1),
(100, 9, 10, 1),
(101, 15, 1, 1),
(102, 15, 2, 0),
(103, 15, 3, 0),
(104, 15, 4, 0),
(105, 15, 5, 0),
(106, 15, 6, 0),
(107, 15, 7, 1),
(108, 15, 8, 1),
(109, 15, 9, 1),
(110, 15, 10, 1),
(111, 9, 1, 0),
(112, 9, 2, 0),
(113, 9, 3, 1),
(114, 9, 4, 1),
(115, 9, 5, 1),
(116, 9, 6, 1),
(117, 9, 7, 0),
(118, 9, 8, 0),
(119, 9, 9, 0),
(120, 9, 10, 0),
(121, 16, 1, 1),
(122, 16, 2, 0),
(123, 16, 3, 0),
(124, 16, 4, 0),
(125, 16, 5, 0),
(126, 16, 6, 0),
(127, 16, 7, 0),
(128, 16, 8, 0),
(129, 16, 9, 0),
(130, 16, 10, 0),
(131, 16, 1, 1),
(132, 16, 2, 1),
(133, 16, 3, 1),
(134, 16, 4, 1),
(135, 16, 5, 1),
(136, 16, 6, 1),
(137, 16, 7, 0),
(138, 16, 8, 0),
(139, 16, 9, 0),
(140, 16, 10, 0),
(141, 16, 1, 1),
(142, 16, 2, 1),
(143, 16, 3, 1),
(144, 16, 4, 1),
(145, 16, 5, 1),
(146, 16, 6, 1),
(147, 16, 7, 0),
(148, 16, 8, 0),
(149, 16, 9, 0),
(150, 16, 10, 0);

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
-- Gegevens worden geëxporteerd voor tabel `users`
--

INSERT INTO `users` (`userId`, `username`, `password`) VALUES
(1, 'testuser', 'testpassword'),
(9, 'Nafomi', 'e97b0fdc637f750f280d4c43b5871e65'),
(13, 'testuser1', 'c67203025154c5d08755a8be6c81e1f1'),
(14, 'maxdebruute', 'e97b0fdc637f750f280d4c43b5871e65'),
(15, 'testuser1', 'b7e055c6165da55c3e12c49ae5207455'),
(16, 'maxdebruute', '2e4e510cb4eeef147b4e1c419d669fc8');

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
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `userId_UNIQUE` (`userId`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `parties`
--
ALTER TABLE `parties`
  MODIFY `partyId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT voor een tabel `partyquestions`
--
ALTER TABLE `partyquestions`
  MODIFY `partyQuestionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT voor een tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `questionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT voor een tabel `userquestions`
--
ALTER TABLE `userquestions`
  MODIFY `userQuestionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
