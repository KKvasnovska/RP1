-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hostiteľ: 127.0.0.1
-- Čas generovania: Sun 19.Jún 2022, 22:20
-- Verzia serveru: 10.4.22-MariaDB
-- Verzia PHP: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Databáza: `letenky`
--

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `letenky`
--

CREATE TABLE `letenky` (
  `id` int(11) NOT NULL,
  `destinacia` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `odlet` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `prestup` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `batožina` tinytext COLLATE utf8_slovak_ci NOT NULL,
  `cena` float NOT NULL,
  `datum` date NOT NULL,
  `cas_odletu` time NOT NULL,
  `cas_priletu` time NOT NULL,
  `pocet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `letenky`
--

INSERT INTO `letenky` (`id`, `destinacia`, `odlet`, `prestup`, `batožina`, `cena`, `datum`, `cas_odletu`, `cas_priletu`, `pocet`) VALUES
(0, 'Londýn', 'Viedeň', 'priamy let', 'príručná do 10kg', 27, '2022-07-07', '07:30:00', '08:40:00', 8),
(1, 'Londýn', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 12, '2022-10-06', '08:45:00', '09:30:00', 10),
(2, 'Londýn', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 18, '2022-06-15', '08:45:00', '09:30:00', 7),
(3, 'Londýn', 'Bratislava', 'priamy let', 'podaná batožina do 32kg + príručná batožina do 8 kg', 32, '2022-07-04', '08:05:00', '09:40:00', 42),
(4, 'Londýn', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 11, '2022-07-02', '12:10:00', '13:00:00', 3),
(5, 'Londýn', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 19, '2022-07-23', '05:50:00', '06:45:00', 5),
(6, 'Londýn', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 27, '2022-08-29', '06:45:00', '07:30:00', 29),
(7, 'Londýn', 'Bratislava', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 23, '2022-11-23', '20:45:00', '22:30:00', 60),
(8, 'Londýn', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 34, '2022-11-11', '09:30:00', '10:45:00', 15),
(9, 'Londýn', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 26, '2022-10-23', '11:20:00', '12:10:00', 7),
(10, 'Londýn', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 13, '2022-07-17', '04:25:00', '05:15:00', 2),
(11, 'Rím', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 32, '2022-07-30', '14:25:00', '15:50:00', 12),
(12, 'Rím', 'Bratislava', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 37, '2022-09-06', '17:15:00', '18:35:00', 9),
(13, 'Rím', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 29, '2022-07-26', '06:05:00', '07:40:00', 14),
(14, 'Rím', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 18, '2022-07-01', '18:35:00', '19:10:00', 50),
(15, 'Rím', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + príručná batožina do 8 kg', 91, '2022-08-17', '04:00:00', '05:35:00', 31),
(16, 'Rím', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 42, '2022-06-28', '23:55:00', '01:30:00', 22),
(17, 'Rím', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 38, '2022-11-15', '09:00:00', '10:35:00', 17),
(18, 'Rím', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + príručná batožina do 8 kg', 75, '2022-08-23', '12:15:00', '13:50:00', 25),
(19, 'Rím', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 27, '2022-06-28', '12:15:00', '13:50:00', 1),
(20, 'Rím', 'Budapešť', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 36, '2022-08-01', '12:15:00', '13:50:00', 17),
(21, 'Rím', 'Budapešť', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 48, '2022-05-31', '08:10:00', '09:25:00', 8),
(22, 'Rím', 'Budapešť', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 48, '2022-07-21', '13:50:00', '14:35:00', 28),
(23, 'Rím', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 32, '2022-07-05', '13:50:00', '14:35:00', 31),
(24, 'Kanárske ostrovy', 'Viedeň', 'Madrid', 'podaná batožina do 32kg + príručná batožina do 8 kg', 137, '2022-07-19', '07:30:00', '11:45:00', 41),
(25, 'Kanárske ostrovy', 'Budapešť', 'Madrid', 'podaná batožina do 32kg + osobná taška do 3kg', 68, '2022-05-28', '07:30:00', '11:45:00', 12),
(26, 'Kanárske ostrovy', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + príručná batožina do 8 kg', 106, '2022-08-20', '09:25:00', '12:30:00', 34),
(27, 'Kanárske ostrovy', 'Budapešť', 'Madrid', 'podaná batožina do 32kg + príručná batožina do 8 kg', 98, '2022-06-22', '16:30:00', '20:45:00', 13),
(28, 'Kanárske ostrovy', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 79, '2022-08-28', '15:55:00', '20:40:00', 6),
(29, 'Kanárske ostrovy', 'Budapešť', 'Madrid', 'príručná batožina do 10 kg', 56, '2022-07-25', '23:00:00', '03:15:00', 4),
(30, 'Kanárske ostrovy', 'Viedeň', 'Madrid', 'podaná batožina do 32kg + osobná taška do 3kg', 88, '2022-08-07', '03:35:00', '07:50:00', 26),
(31, 'Kanárske ostrovy', 'Budapešť', 'Madrid', 'podaná batožina do 32kg + príručná batožina do 8 kg', 136, '2022-06-29', '17:40:00', '22:00:00', 39),
(32, 'Atény', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 56, '2022-06-28', '08:05:00', '10:05:00', 12),
(33, 'Atény', 'Budapešť', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 73, '2022-09-14', '08:05:00', '10:05:00', 16),
(34, 'Atény', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 38, '2022-08-29', '12:20:00', '14:20:00', 30),
(35, 'Atény', 'Budapešť', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 56, '2022-09-21', '03:30:00', '05:30:00', 41),
(36, 'Atény', 'Bratislava', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 87, '2022-06-04', '23:15:00', '01:15:00', 38),
(37, 'Edinburg', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 56, '2022-08-24', '06:30:00', '09:15:00', 2),
(38, 'Edinburg', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 51, '2022-07-02', '07:30:00', '10:15:00', 19),
(39, 'Edinburg', 'Viedeň', 'Amsterdam', 'podaná batožina do 32kg + príručná batožina do 8 kg', 58, '2022-06-29', '05:15:00', '10:30:00', 7),
(40, 'Edinburg', 'Budapešť', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 112, '2022-07-05', '16:25:00', '19:10:00', 26),
(41, 'Edinburg', 'Budapešť', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 69, '2022-06-30', '18:00:00', '20:50:00', 14),
(42, 'Edinburg', 'Budapešť', 'Amsterdam', 'podaná batožina do 32kg + príručná batožina do 8 kg', 89, '2022-07-07', '03:20:00', '08:00:00', 28),
(43, 'Paríž', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 36, '2022-07-12', '20:45:00', '21:50:00', 14),
(44, 'Paríž', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 59, '2022-07-22', '05:50:00', '06:55:00', 36),
(45, 'Paríž', 'Bratislava', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 112, '2022-07-22', '03:55:00', '05:00:00', 21),
(46, 'Paríž', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 64, '2022-09-09', '21:25:00', '22:30:00', 16),
(47, 'Paríž', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 83, '2022-08-17', '19:45:00', '21:00:00', 10),
(48, 'Paríž', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 99, '2022-12-02', '07:15:00', '08:40:00', 8),
(49, 'Paríž', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 16, '2022-06-26', '04:05:00', '05:25:00', 1),
(50, 'Paríž', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 54, '2022-11-20', '15:15:00', '16:35:00', 3),
(51, 'Paríž', 'Budapešť', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 78, '2022-06-19', '06:40:00', '08:00:00', 4),
(52, 'Paríž', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 73, '2022-06-26', '06:50:00', '08:00:00', 11),
(53, 'Split', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 11, '2022-07-09', '13:10:00', '14:20:00', 3),
(54, 'Split', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 22, '2022-08-10', '01:15:00', '02:25:00', 9),
(55, 'Split', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 18, '2022-06-30', '04:30:00', '05:40:00', 10),
(56, 'Split', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 36, '2022-11-13', '12:20:00', '13:30:00', 15),
(57, 'Split', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 28, '2022-07-23', '18:00:00', '19:10:00', 20),
(58, 'Split', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 15, '2022-06-30', '05:50:00', '07:00:00', 1),
(59, 'Split', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 41, '2022-07-22', '09:35:00', '10:45:00', 16),
(60, 'Split', 'Viedeň', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 53, '2022-07-06', '11:25:00', '12:35:00', 27),
(61, 'Split', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 19, '2022-07-31', '20:15:00', '21:25:00', 19),
(62, 'Sicília', 'Bratislava', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 26, '2022-07-01', '14:00:00', '16:05:00', 26),
(63, 'Sicília', 'Bratislava', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 34, '2022-07-08', '02:55:00', '05:00:00', 21),
(64, 'Sicília', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 14, '2022-07-15', '21:35:00', '23:40:00', 15),
(65, 'Sicília', 'Budapešť', 'priamy let', 'podaná batožina do 32kg + osobná taška do 3kg', 58, '2022-07-22', '08:10:00', '10:15:00', 32),
(66, 'Sicília', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 16, '2022-07-29', '11:40:00', '13:45:00', 2),
(67, 'Sicília', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 7, '2022-06-02', '19:20:00', '21:25:00', 18),
(68, 'Sicília', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 18, '2022-08-05', '03:40:00', '05:45:00', 10),
(69, 'Barcelona', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 112, '2022-08-15', '05:15:00', '07:40:00', 14),
(70, 'Barcelona', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 91, '2022-08-21', '08:50:00', '11:15:00', 13),
(71, 'Barcelona', 'Viedeň', 'priamy let', 'príručná batožina do 10 kg', 113, '2022-07-09', '10:30:00', '12:55:00', 22),
(72, 'Barcelona', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 54, '2022-06-28', '15:00:00', '17:25:00', 5),
(73, 'Barcelona', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 69, '2022-07-05', '21:05:00', '23:30:00', 12),
(74, 'Barcelona', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 87, '2022-07-12', '01:40:00', '03:55:00', 22),
(75, 'Barcelona', 'Budapešť', 'priamy let', 'príručná batožina do 10 kg', 59, '2022-07-19', '03:35:00', '06:00:00', 6),
(76, 'Mallorca', 'Bratislava', 'priamy let', 'príručná batožina do 10 kg', 13, '2022-06-25', '19:00:00', '20:05:00', 10);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `pouzivatelia`
--

CREATE TABLE `pouzivatelia` (
  `id_pouz` smallint(6) NOT NULL,
  `prihlasmeno` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `heslo` varchar(50) COLLATE utf8_slovak_ci NOT NULL DEFAULT '',
  `meno` varchar(20) COLLATE utf8_slovak_ci NOT NULL DEFAULT '',
  `priezvisko` varchar(30) COLLATE utf8_slovak_ci NOT NULL DEFAULT '',
  `email` varchar(40) COLLATE utf8_slovak_ci NOT NULL,
  `adresa` mediumtext COLLATE utf8_slovak_ci NOT NULL,
  `tel` varchar(16) COLLATE utf8_slovak_ci NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `pouzivatelia`
--

INSERT INTO `pouzivatelia` (`id_pouz`, `prihlasmeno`, `heslo`, `meno`, `priezvisko`, `email`, `adresa`, `tel`, `admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Administrátor', 'systému', 'admin@admin.com', 'admin', '0', 1),
(2, 'uwa', '78f0f32c08873cfdba57f17c855943c0', 'predmet', 'UWA', 'uwa@uwa.com', 'UWA 34, 811 01, Bratislava', '902654789', 0),
(3, 'teodor', 'd6baf924ef7b2c835f7d40ce5e83d104', 'Teodor', 'Jarmil', 'teojar12@uniba.sk', 'Corgáň 49,\r\n963 36,\r\nHurbanovo', '982333652', 0),
(4, 'damian', 'fe0b714aaecbd5c8961994c655d18a0d', 'Damián', 'Hurka', 'dami45hur@gmail.com', 'Grunt 15, \r\n823 65,\r\nVráble', '987259632', 0),
(5, 'riso', '48d0429f32fd76867c6ded7bb8f54739', 'Richard', 'Novák', 'risko125@uniba.sk', 'Ružová 21,\r\n259 83,\r\nFiľakovo', '949821369', 0),
(6, 'zofia', 'e37c5655d3bc9f0b902149ded9a03032', 'Žofia', 'Sadová', 'zofka@gmail.com', 'Kmeťková 8,\r\n562 96,\r\nBratislava', '904159951', 0),
(7, 'anicka', '0015cc32089af63f1dfaf4fceafdfd3f', 'Anička', 'Dušička', 'anicka@dusicka.sk', 'Bratislava, 811 01, Staré Mesto', '908023123', 0),
(8, 'emilia', 'aafcc615b67a5a2e360fdd7b390060ee', 'Emília', 'Buchtová', 'emilia123@gmail.com', 'Kmeťková 95, 223 15, Trnava', '914982336', 0),
(9, 'fedor', '500ada824f0088ea343b15bc3b1788be', 'Fedor', 'Malý', 'fedor953@centrum.sk', 'Druhá 259, 196 45, Prešov', '926 333 598', 0),
(10, 'jano', '3bf7cfdb8f0c3a58e67fd36eda7fd577', 'Jano', 'Slivka', 'jano.k.45@pobox.com', 'Fialová 17, 965 58, Banská Bystrica', '908089005', 0),
(11, 'gitka', '5f9b5eeff2f9f143fcc7d8a97c4e1091', 'Gita', 'Fusková', 'gitka@gmail.com', 'Druhá 25,\r\n568 41,\r\nNové Zámky', '914195311', 0),
(12, 'filip', '3a30e08c1a8b88386d984e7708fee71e', 'Filip', 'Slančík', 'dunco15@centrum.sk', 'Obdobná 89,\r\n983 66,\r\nHorná Kráľová', '987 036 912', 0),
(18, 'herold', 'db5569cb0ceea481c9c118d35dbc0a14', 'Herold', 'Hruška', 'hruska@gmail.com', 'sdbvjhbdfvbhfdbvzud', '956359222', 0),
(20, 'filomena', 'fd64896ef95d6f8310c0ae914d2d03ff', 'Filoména', 'Paštéková', 'filomenka123@centrum.sk', 'Hraničná 21,\r\n569 56,\r\nFiľakovo', '951423625', 0);

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `recenzie`
--

CREATE TABLE `recenzie` (
  `id` int(11) NOT NULL,
  `pouzivatel` text COLLATE utf8_slovak_ci NOT NULL,
  `hodnotenie` int(5) NOT NULL,
  `nadpis` text COLLATE utf8_slovak_ci NOT NULL,
  `recenzia` longtext COLLATE utf8_slovak_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `recenzie`
--

INSERT INTO `recenzie` (`id`, `pouzivatel`, `hodnotenie`, `nadpis`, `recenzia`) VALUES
(1, 'Tomáš', 1, 'Nebol som práve nadšený :/', 'Mal som rezervované letenky do Ríma na pekný víkend strávený s mojou priateľkou. V objednávke sme si zarezervovali aj autobus, ktorý nás mal zobrať z Bratislavy do Viedne na letisko. Keď sme prišli na miesto odkiaľ mal autobus odchádzať, čakalo tam už veľa ďalších ľudí. Ako prišiel autobus, všetci podávali batožiny vodičovi a nastúpili do autobusu. Počas toho, ako vodič nakladal batožinu do autobusu, zistil, že sa mu to tam všetko nezmestí, a ja s mojou priateľkou, keďže sme prišli poslední, sme si museli naše kufre zobrať dovnútra. Takže vždy keď tá milá pani, čo sa každého pýta, či niečo nepotrebuje prechádzala uličkou, tak sme si museli tie kufre položiť na seba, aby vedela prejsť a potom znova vrátiť do uličky. Bola to veľmi nepríjemná cesta a moja priateľka celý čas nadávala. Neskôr sme už s ničím nemali problémy, ale dosť nám to znepríjemnilo cestu. '),
(2, 'Jakub', 4, 'Všetko v poriadku.', 'Nemal som žiadny problém, všetko bolo tak ako som aj čakal. Určite keď pôjdem znova niekam, tak letenky objednávam odtiaľto. Nikde som ešte nenašiel lepšie ceny. '),
(3, 'Ofélia', 5, 'Perfektnééééé ;*', 'Všetko bolo úžasné, odkedy sme nastúpili do autobusu v Košiciach až kým sme tam znova nevystúpili. Perfektný výletík, nikdy nezabudneme. '),
(4, 'Fero', 3, 'Bol som spokojný', 'Mal som menší problém, pri návrate domov, lebo som si omylom zakúpil iba jednosmernú letenku, takže po týždni strávenom na Malorke som si išiel skontrolovať čas odletu domov, a zistil som , že som si kúpil inú letenku, ako som chcel a žiadny odlet domov sa nekoná. Z hotela som mal ráno odísť, a nevedel som na internete zohnať spiatočnú letenku, lebo všetky lety boli už vypredané. Tak som priamo kontaktoval túto firmu a oni mi boli schopný zohnať jednu letenku (síce s prestupom, kde som dlho čakal, ale stále som bol veľmi vďačný za ich snahu).'),
(5, 'Alžbeta', 4, 'Všetko ok', 'Nemám čo vytknúť.'),
(7, 'Gita', 3, 'Super výletík', 'Odporúčam:*');

-- --------------------------------------------------------

--
-- Štruktúra tabuľky pre tabuľku `rezervacie`
--

CREATE TABLE `rezervacie` (
  `id_rezervacie` int(11) NOT NULL,
  `id_pouz` smallint(6) NOT NULL,
  `id_letenky` smallint(6) NOT NULL,
  `pocet_ks` smallint(6) NOT NULL,
  `doprava` varchar(20) COLLATE utf8_slovak_ci NOT NULL,
  `poistenie` varchar(15) COLLATE utf8_slovak_ci NOT NULL,
  `batozina` text COLLATE utf8_slovak_ci NOT NULL,
  `trieda` varchar(15) COLLATE utf8_slovak_ci NOT NULL,
  `cena_spolu` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_slovak_ci;

--
-- Sťahujem dáta pre tabuľku `rezervacie`
--

INSERT INTO `rezervacie` (`id_rezervacie`, `id_pouz`, `id_letenky`, `pocet_ks`, `doprava`, `poistenie`, `batozina`, `trieda`, `cena_spolu`) VALUES
(3, 10, 25, 2, '', 'bez poistenia', '0', '1', 161.6),
(4, 9, 57, 2, '', 's poistením', '0', '0', 174.2),
(5, 10, 25, 4, '', 's poistením', '0', '3', 410.6),
(7, 8, 42, 1, '2', 's poistením', '0', '1', 156.1),
(8, 8, 67, 4, '1', 's poistením', '+ podaná(do 35kg)', '0', 106.2),
(9, 8, 45, 8, '', 's poistením', '+ podaná(do 35kg)', '2', 1132.6),
(11, 7, 45, 5, '', 's poistením', '0', '3', 706.2),
(13, 5, 2, 5, '', 's poistením', '0', '0', 124.2),
(17, 5, 45, 4, '', 'bez poistenia', '0', '0', 487),
(18, 6, 2, 2, '1', 's poistením', '+ príručná(do 15kg)', '0', 67.2),
(21, 4, 76, 1, '1', 's poistením', '+ podaná(do 25kg)', '0', 53.2),
(22, 2, 21, 1, '', 'bez poistenia', '+ podaná(do 25kg)', '1', 226.8),
(23, 2, 21, 4, '', 'bez poistenia', '0', '2', 244.8),
(25, 2, 21, 2, '0', 's poistením', '+ podaná(do 25kg)', '1', 151.8),
(27, 9, 51, 2, '1', 's poistením', '0', '1', 241.8),
(34, 11, 41, 1, '', 'bez poistenia', '0', '0', 105),
(35, 11, 21, 2, '', 'bez poistenia', '0', '0', 96),
(36, 11, 50, 1, '', 'bez poistenia', '0', '0', 84),
(39, 18, 63, 5, '14', 'bez poistenia', '+ príručná(do 15kg)', '1', 232),
(44, 18, 36, 1, '', 'bez poistenia', '+ podaná(do 35kg)', '0', 137),
(45, 18, 55, 1, '', 'bez poistenia', '+ príručná(do 15kg)', '0', 33),
(46, 18, 36, 2, '', 'bez poistenia', '+ podaná(do 35kg)', '0', 275),
(47, 18, 27, 2, '', 'bez poistenia', '0', '0', 196),
(48, 5, 52, 1, '13', 's poistením', '+ podaná(do 35kg)', '1', 140.5),
(50, 7, 21, 2, '3', 's poistením', '0', '0', 106.2),
(51, 6, 76, 1, '', 'bez poistenia', '0', '0', 13),
(52, 6, 70, 2, '8', 's poistením', '+ podaná(do 35kg)', '3', 288.8),
(53, 6, 33, 10, '3', 'bez poistenia', '0', '2', 899.5),
(54, 6, 47, 5, '', 's poistením', '0', '1', 477.5),
(55, 4, 27, 4, '', 'bez poistenia', '+ podaná(do 25kg)', '1', 461.2),
(56, 9, 0, 4, '', 's poistením', '+ podaná(do 25kg)', '0', 154.8);

--
-- Kľúče pre exportované tabuľky
--

--
-- Indexy pre tabuľku `letenky`
--
ALTER TABLE `letenky`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  ADD PRIMARY KEY (`id_pouz`),
  ADD UNIQUE KEY `username` (`prihlasmeno`);

--
-- Indexy pre tabuľku `recenzie`
--
ALTER TABLE `recenzie`
  ADD PRIMARY KEY (`id`);

--
-- Indexy pre tabuľku `rezervacie`
--
ALTER TABLE `rezervacie`
  ADD PRIMARY KEY (`id_rezervacie`);

--
-- AUTO_INCREMENT pre exportované tabuľky
--

--
-- AUTO_INCREMENT pre tabuľku `pouzivatelia`
--
ALTER TABLE `pouzivatelia`
  MODIFY `id_pouz` smallint(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pre tabuľku `recenzie`
--
ALTER TABLE `recenzie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pre tabuľku `rezervacie`
--
ALTER TABLE `rezervacie`
  MODIFY `id_rezervacie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
