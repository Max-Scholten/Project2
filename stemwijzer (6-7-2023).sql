-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 06 jul 2023 om 08:58
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
(150, 16, 10, 0),
(341, 18, 1, 0),
(342, 18, 2, 0),
(343, 18, 3, 1),
(344, 18, 4, 1),
(345, 18, 5, 1),
(346, 18, 6, 1),
(347, 18, 7, 0),
(348, 18, 8, 0),
(349, 18, 9, 0),
(350, 18, 10, 0),
(351, 18, 1, 0),
(352, 18, 2, 0),
(353, 18, 3, 1),
(354, 18, 4, 1),
(355, 18, 5, 1),
(356, 18, 6, 1),
(357, 18, 7, 0),
(358, 18, 8, 0),
(359, 18, 9, 1),
(360, 18, 10, 0),
(361, 18, 1, 0),
(362, 18, 2, 0),
(363, 18, 3, 1),
(364, 18, 4, 1),
(365, 18, 5, 1),
(366, 18, 6, 1),
(367, 18, 7, 1),
(368, 18, 8, 0),
(369, 18, 9, 1),
(370, 18, 10, 0),
(371, 18, 1, 0),
(372, 18, 2, 0),
(373, 18, 3, 1),
(374, 18, 4, 0),
(375, 18, 5, 0),
(376, 18, 6, 1),
(377, 18, 7, 1),
(378, 18, 8, 0),
(379, 18, 9, 1),
(380, 18, 10, 0),
(381, 18, 1, 1),
(382, 18, 2, 0),
(383, 18, 3, 1),
(384, 18, 4, 0),
(385, 18, 5, 0),
(386, 18, 6, 1),
(387, 18, 7, 1),
(388, 18, 8, 0),
(389, 18, 9, 1),
(390, 18, 10, 0),
(723, 33, 1, 1),
(724, 33, 2, 1),
(725, 33, 3, 0),
(726, 33, 4, 0),
(727, 33, 5, 0),
(728, 33, 6, 1),
(729, 33, 7, 1),
(730, 33, 8, 1),
(731, 33, 9, 1),
(732, 33, 10, 0),
(843, 36, 1, 0),
(844, 36, 2, 0),
(845, 36, 3, 0),
(846, 36, 4, 1),
(847, 36, 5, 1),
(848, 36, 6, 1),
(849, 36, 7, 1),
(850, 36, 8, 0),
(851, 36, 9, 0),
(852, 36, 10, 0),
(883, 29, 1, 1),
(884, 29, 2, 1),
(885, 29, 3, 0),
(886, 29, 4, 0),
(887, 29, 5, 0),
(888, 29, 6, 1),
(889, 29, 7, 1),
(890, 29, 8, 1),
(891, 29, 9, 1),
(892, 29, 10, 0);

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
(14, 'maxdebruute', 'e97b0fdc637f750f280d4c43b5871e65'),
(16, 'maxdebruute', '2e4e510cb4eeef147b4e1c419d669fc8'),
(18, 'nummer1', '7c6a180b36896a0a8c02787eeafb0e4c'),
(29, 'Nafomi', 'e97b0fdc637f750f280d4c43b5871e65'),
(33, 'testuser1', 'c4d354440cb41ee38e162bc1f431e99b'),
(36, 'testuser5', 'e3d704f3542b44a621ebed70dc0efe13');

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
  MODIFY `userQuestionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=893;

--
-- AUTO_INCREMENT voor een tabel `users`
--
ALTER TABLE `users`
  MODIFY `userId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

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
