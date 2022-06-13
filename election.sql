-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 04, 2021 at 10:54 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `election`
--

-- --------------------------------------------------------

--
-- Table structure for table `electeur`
--

CREATE TABLE IF NOT EXISTS `electeur` (
  `idElecteur` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Nom` varchar(20) NOT NULL,
  `pseudo` varchar(20) NOT NULL,
  `motPasse` varchar(20) NOT NULL,
  `age` int(11) NOT NULL,
  `dateInscription` date NOT NULL,
  `idPartiElu` int(11) DEFAULT NULL,
  `idGouvernorat` int(11) NOT NULL,
  `dateDerniereElection` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idElecteur`),
  KEY `idGouvernorat` (`idGouvernorat`),
  KEY `idPartiElu` (`idPartiElu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=402 ;

--
-- Dumping data for table `electeur`
--

INSERT INTO `electeur` (`idElecteur`, `Nom`, `pseudo`, `motPasse`, `age`, `dateInscription`, `idPartiElu`, `idGouvernorat`, `dateDerniereElection`) VALUES
(1, 'Asma', 'Asma', 'Asma', 24, '2021-06-04', NULL, 13, '2021-06-03 22:00:00'),
(2, 'aa', 'aaa', '1lnig2020', 20, '2021-06-04', NULL, 1, NULL),
(3, 'aa', 'Assma', '1lnig2020', 18, '2021-06-04', NULL, 1, NULL),
(339, 'ahmed', 'ahmed', 'aaaa', 18, '2021-06-01', 3, 7, '2021-06-03 22:00:00'),
(400, 'ahmed', 'ahmed', 'aaaa', 18, '2021-06-01', 3, 7, '2021-06-03 22:00:00'),
(401, 'isra', 'isra', 'aaaa', 20, '2021-06-04', NULL, 24, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gouvernorat`
--

CREATE TABLE IF NOT EXISTS `gouvernorat` (
  `idGouvernorat` int(10) NOT NULL,
  `nomGouvernorat` varchar(50) NOT NULL,
  `nombreSieges` int(10) NOT NULL,
  PRIMARY KEY (`idGouvernorat`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gouvernorat`
--

INSERT INTO `gouvernorat` (`idGouvernorat`, `nomGouvernorat`, `nombreSieges`) VALUES
(1, 'Tunis', 15),
(2, 'Ariana', 12),
(3, 'Manouba', 10),
(4, 'Ben Arous', 9),
(5, 'Nabeul', 7),
(6, 'Sousse', 13),
(7, 'Monastir', 8),
(8, 'Mahdia', 8),
(9, 'Sfax', 14),
(10, 'Gabes', 10),
(11, 'Mednine', 9),
(12, 'Tataouine', 7),
(13, 'Gafsa', 7),
(14, 'Tozeur', 8),
(15, 'Kebili', 8),
(16, 'Kairouan', 6),
(17, 'Tela', 10),
(18, 'Siliana', 9),
(19, 'Kef', 7),
(20, 'Jendouba', 7),
(21, 'Beja', 8),
(22, 'Kasserine', 8),
(23, 'Bizerte', 6),
(24, 'Zaghouan', 10);

-- --------------------------------------------------------

--
-- Table structure for table `partipolitique`
--

CREATE TABLE IF NOT EXISTS `partipolitique` (
  `idParti` int(10) NOT NULL,
  `nomParti` varchar(20) NOT NULL,
  PRIMARY KEY (`idParti`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `partipolitique`
--

INSERT INTO `partipolitique` (`idParti`, `nomParti`) VALUES
(1, 'Annahdha'),
(2, 'Etaillar'),
(3, 'PDL'),
(4, 'Front Populaire'),
(5, 'Ajjomhouri'),
(6, 'PDM'),
(7, 'Afek Tunis');

-- --------------------------------------------------------

--
-- Table structure for table `voix`
--

CREATE TABLE IF NOT EXISTS `voix` (
  `idVoix` int(10) NOT NULL,
  `idGouvernorat` int(10) NOT NULL,
  `idParti` int(10) NOT NULL,
  `nombreVoix` int(10) NOT NULL,
  PRIMARY KEY (`idVoix`),
  KEY `idGouvernorat` (`idGouvernorat`),
  KEY `idParti` (`idParti`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `voix`
--

INSERT INTO `voix` (`idVoix`, `idGouvernorat`, `idParti`, `nombreVoix`) VALUES
(0, 7, 3, 1),
(171, 1, 1, 4350),
(172, 1, 2, 4495),
(173, 1, 3, 4891),
(174, 1, 4, 2352),
(175, 1, 5, 2228),
(176, 1, 6, 5288),
(177, 1, 7, 538),
(178, 2, 1, 1097),
(179, 2, 2, 2642),
(180, 2, 3, 7495),
(181, 2, 4, 5292),
(182, 2, 5, 4424),
(183, 2, 6, 8714),
(184, 2, 7, 7291),
(185, 3, 1, 8520),
(186, 3, 2, 1068),
(187, 3, 3, 5972),
(188, 3, 4, 6965),
(189, 3, 5, 1727),
(190, 3, 6, 6160),
(191, 3, 7, 9040),
(192, 4, 1, 749),
(193, 4, 2, 4960),
(194, 4, 3, 6700),
(195, 4, 4, 2481),
(196, 4, 5, 1328),
(197, 4, 6, 5336),
(198, 4, 7, 1770),
(199, 5, 1, 3430),
(200, 5, 2, 6920),
(201, 5, 3, 7709),
(202, 5, 4, 9734),
(203, 5, 5, 5563),
(204, 5, 6, 8314),
(205, 5, 7, 6163),
(206, 6, 1, 7234),
(207, 6, 2, 1551),
(208, 6, 3, 8349),
(209, 6, 4, 8023),
(210, 6, 5, 4447),
(211, 6, 6, 9870),
(212, 6, 7, 1995),
(213, 7, 1, 9004),
(214, 7, 2, 9945),
(215, 7, 3, 5045),
(216, 7, 4, 6320),
(217, 7, 5, 2158),
(218, 7, 6, 1544),
(219, 7, 7, 1598),
(220, 8, 1, 644),
(221, 8, 2, 6960),
(222, 8, 3, 2391),
(223, 8, 4, 9386),
(224, 8, 5, 3053),
(225, 8, 6, 7088),
(226, 8, 7, 4089),
(227, 9, 1, 7226),
(228, 9, 2, 6156),
(229, 9, 3, 2636),
(230, 9, 4, 6355),
(231, 9, 5, 1400),
(232, 9, 6, 7477),
(233, 9, 7, 8016),
(234, 10, 1, 7215),
(235, 10, 2, 1315),
(236, 10, 3, 6298),
(237, 10, 4, 4667),
(238, 10, 5, 9909),
(239, 10, 6, 9898),
(240, 10, 7, 1161),
(241, 11, 1, 9233),
(242, 11, 2, 4089),
(243, 11, 3, 4124),
(244, 11, 4, 7656),
(245, 11, 5, 7649),
(246, 11, 6, 3833),
(247, 11, 7, 7886),
(248, 12, 1, 9012),
(249, 12, 2, 2447),
(250, 12, 3, 1235),
(251, 12, 4, 3836),
(252, 12, 5, 829),
(253, 12, 6, 2618),
(254, 12, 7, 8061),
(255, 13, 1, 7155),
(256, 13, 2, 3467),
(257, 13, 3, 6604),
(258, 13, 4, 2977),
(259, 13, 5, 2357),
(260, 13, 6, 3978),
(261, 13, 7, 7781),
(262, 14, 1, 2269),
(263, 14, 2, 4210),
(264, 14, 3, 4894),
(265, 14, 4, 5972),
(266, 14, 5, 7867),
(267, 14, 6, 1483),
(268, 14, 7, 1363),
(269, 15, 1, 9284),
(270, 15, 2, 9261),
(271, 15, 3, 6574),
(272, 15, 4, 6093),
(273, 15, 5, 2990),
(274, 15, 6, 8688),
(275, 15, 7, 9762),
(276, 16, 1, 8877),
(277, 16, 2, 8317),
(278, 16, 3, 4673),
(279, 16, 4, 8933),
(280, 16, 5, 4183),
(281, 16, 6, 930),
(282, 16, 7, 7335),
(283, 17, 1, 2758),
(284, 17, 2, 5102),
(285, 17, 3, 9969),
(286, 17, 4, 5243),
(287, 17, 5, 4156),
(288, 17, 6, 9015),
(289, 17, 7, 7397),
(290, 18, 1, 1132),
(291, 18, 2, 9501),
(292, 18, 3, 1750),
(293, 18, 4, 9104),
(294, 18, 5, 604),
(295, 18, 6, 6017),
(296, 18, 7, 8748),
(297, 19, 1, 9625),
(298, 19, 2, 3004),
(299, 19, 3, 8477),
(300, 19, 4, 9734),
(301, 19, 5, 8621),
(302, 19, 6, 5131),
(303, 19, 7, 3820),
(304, 20, 1, 8809),
(305, 20, 2, 1898),
(306, 20, 3, 1192),
(307, 20, 4, 2295),
(308, 20, 5, 5835),
(309, 20, 6, 6125),
(310, 20, 7, 3078),
(311, 21, 1, 7757),
(312, 21, 2, 4203),
(313, 21, 3, 9203),
(314, 21, 4, 9085),
(315, 21, 5, 3866),
(316, 21, 6, 1790),
(317, 21, 7, 1295),
(318, 22, 1, 4947),
(319, 22, 2, 2693),
(320, 22, 3, 8739),
(321, 22, 4, 4772),
(322, 22, 5, 2259),
(323, 22, 6, 5319),
(324, 22, 7, 3410),
(325, 23, 1, 7441),
(326, 23, 2, 2217),
(327, 23, 3, 4239),
(328, 23, 4, 6334),
(329, 23, 5, 7778),
(330, 23, 6, 1974),
(331, 23, 7, 3645),
(332, 24, 1, 6001),
(333, 24, 2, 2304),
(334, 24, 3, 1313),
(335, 24, 4, 7602),
(336, 24, 5, 7739),
(337, 24, 6, 5286),
(338, 24, 7, 2082);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `electeur`
--
ALTER TABLE `electeur`
  ADD CONSTRAINT `FK_idG` FOREIGN KEY (`idGouvernorat`) REFERENCES `gouvernorat` (`idGouvernorat`),
  ADD CONSTRAINT `fk_parti` FOREIGN KEY (`idPartiElu`) REFERENCES `partipolitique` (`idParti`);

--
-- Constraints for table `voix`
--
ALTER TABLE `voix`
  ADD CONSTRAINT `AZERTY` FOREIGN KEY (`idGouvernorat`) REFERENCES `gouvernorat` (`idGouvernorat`),
  ADD CONSTRAINT `FK_idP` FOREIGN KEY (`idParti`) REFERENCES `partipolitique` (`idParti`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
