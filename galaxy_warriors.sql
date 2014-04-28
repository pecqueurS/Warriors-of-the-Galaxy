-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 28 Avril 2014 à 17:58
-- Version du serveur: 5.6.12-log
-- Version de PHP: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `galaxy_warriors`
--
CREATE DATABASE IF NOT EXISTS `galaxy_warriors` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `galaxy_warriors`;

-- --------------------------------------------------------

--
-- Structure de la table `batiments`
--

CREATE TABLE IF NOT EXISTS `batiments` (
  `bat_id` int(11) NOT NULL AUTO_INCREMENT,
  `bat_joueurs_id` int(11) NOT NULL,
  `bat_type_batiments_id` int(11) NOT NULL,
  `bat_niveau` int(11) DEFAULT '0',
  `bat_amelio_debut_TS` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`bat_id`),
  KEY `fk_batiments_joueurs1_idx` (`bat_joueurs_id`),
  KEY `fk_batiments_type_batiments1_idx` (`bat_type_batiments_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `bonus_batiment`
--

CREATE TABLE IF NOT EXISTS `bonus_batiment` (
  `bob_id` int(11) NOT NULL AUTO_INCREMENT,
  `bob_type_batiments_id` int(11) NOT NULL,
  `bob_type_bonus` varchar(45) DEFAULT NULL COMMENT 'bat : spaceport =>\nAttaque : 10\nDefense : 10\ntps : -2',
  `bob_bonus_percent` int(11) DEFAULT NULL,
  PRIMARY KEY (`bob_id`),
  KEY `fk_bonus_batiment_type_batiments1_idx` (`bob_type_batiments_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `bonus_batiment`
--

INSERT INTO `bonus_batiment` (`bob_id`, `bob_type_batiments_id`, `bob_type_bonus`, `bob_bonus_percent`) VALUES
(1, 2, 'ATT', 10),
(2, 2, 'DEF', 10),
(3, 2, 'CHARGE', 10),
(4, 2, 'VIT', 10),
(5, 2, 'VIE', 10),
(6, 2, 'TIME', 2),
(7, 2, 'COST', 2);

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE IF NOT EXISTS `carte` (
  `car_id` int(11) NOT NULL AUTO_INCREMENT,
  `car_joueur_id` int(11) DEFAULT NULL,
  `car_parties_id` int(11) NOT NULL,
  `car_pos_x` int(11) NOT NULL,
  `car_pos_y` int(11) NOT NULL,
  `car_type` enum('base','conquete') NOT NULL,
  PRIMARY KEY (`car_id`),
  KEY `fk_carte_joueurs1_idx` (`car_joueur_id`),
  KEY `fk_carte_parties1_idx` (`car_parties_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=117 ;

--
-- Contenu de la table `carte`
--

INSERT INTO `carte` (`car_id`, `car_joueur_id`, `car_parties_id`, `car_pos_x`, `car_pos_y`, `car_type`) VALUES
(16, 21, 33, 6, 1, 'base'),
(17, 22, 33, 7, 3, 'base'),
(18, 23, 33, 14, 5, 'base'),
(19, 21, 33, 6, 2, 'conquete'),
(20, 21, 33, 5, 2, 'conquete'),
(21, 21, 33, 7, 2, 'conquete'),
(22, 21, 33, 5, 1, 'conquete'),
(23, 21, 33, 7, 1, 'conquete'),
(24, 21, 33, 6, 3, 'conquete'),
(25, 22, 33, 7, 15, 'conquete'),
(26, 21, 33, 8, 1, 'conquete'),
(27, 21, 33, 8, 2, 'conquete'),
(28, 21, 33, 9, 1, 'conquete'),
(29, 21, 33, 9, 2, 'conquete'),
(30, 21, 33, 4, 1, 'conquete'),
(31, 21, 33, 4, 2, 'conquete'),
(32, 21, 33, 5, 3, 'conquete'),
(33, 21, 33, 8, 3, 'conquete'),
(34, 21, 33, 4, 3, 'conquete'),
(35, 21, 33, 9, 3, 'conquete'),
(36, 21, 33, 10, 1, 'conquete'),
(37, 21, 33, 10, 2, 'conquete'),
(38, 21, 33, 10, 3, 'conquete'),
(39, 21, 33, 4, 4, 'conquete'),
(40, 21, 33, 5, 4, 'conquete'),
(41, 21, 33, 6, 4, 'conquete'),
(42, 21, 33, 7, 4, 'conquete'),
(43, 21, 33, 8, 4, 'conquete'),
(44, 21, 33, 9, 4, 'conquete'),
(45, 21, 33, 10, 4, 'conquete'),
(46, 21, 33, 3, 1, 'conquete'),
(47, 21, 33, 3, 2, 'conquete'),
(48, 21, 33, 3, 3, 'conquete'),
(49, 21, 33, 3, 4, 'conquete'),
(50, 21, 33, 7, 5, 'conquete'),
(51, 21, 33, 6, 5, 'conquete'),
(52, 21, 33, 5, 5, 'conquete'),
(53, 21, 33, 4, 5, 'conquete'),
(54, 22, 30, 15, 9, 'base'),
(55, 21, 33, 3, 5, 'conquete'),
(56, 21, 33, 9, 5, 'conquete'),
(57, 21, 34, 15, 11, 'base'),
(58, 22, 34, 3, 12, 'base'),
(59, 21, 35, 5, 2, 'base'),
(60, 22, 35, 4, 10, 'base'),
(61, 21, 36, 8, 13, 'base'),
(62, 22, 36, 2, 7, 'base'),
(63, 21, 37, 9, 1, 'base'),
(64, 22, 37, 11, 9, 'base'),
(65, 21, 38, 9, 9, 'base'),
(66, 22, 38, 9, 11, 'base'),
(67, 21, 39, 3, 3, 'base'),
(68, 22, 39, 2, 5, 'base'),
(69, 22, 40, 14, 3, 'base'),
(70, 21, 1, 2, 4, 'base'),
(71, 22, 1, 1, 4, 'base'),
(72, 21, 2, 11, 13, 'base'),
(73, 22, 2, 9, 1, 'base'),
(74, 23, 2, 8, 5, 'base'),
(75, 21, 24, 2, 10, 'base'),
(76, 22, 24, 12, 2, 'base'),
(77, 23, 24, 4, 2, 'base'),
(78, 21, 25, 6, 8, 'base'),
(79, 22, 25, 2, 9, 'base'),
(80, 23, 25, 13, 5, 'base'),
(81, 21, 26, 1, 3, 'base'),
(82, 22, 26, 14, 1, 'base'),
(83, 23, 26, 6, 10, 'base'),
(84, 21, 26, 2, 3, 'conquete'),
(85, 21, 26, 2, 2, 'conquete'),
(86, 21, 26, 1, 4, 'conquete'),
(87, 21, 27, 5, 15, 'base'),
(88, 22, 27, 12, 12, 'base'),
(89, 23, 27, 10, 15, 'base'),
(90, 21, 28, 7, 15, 'base'),
(91, 22, 28, 9, 3, 'base'),
(92, 23, 28, 5, 14, 'base'),
(93, 22, 29, 9, 5, 'base'),
(94, 21, 32, 12, 15, 'base'),
(95, 22, 32, 7, 5, 'base'),
(96, 21, 32, 12, 14, 'conquete'),
(97, 21, 32, 10, 14, 'conquete'),
(98, 21, 31, 4, 13, 'base'),
(99, 22, 31, 4, 5, 'base'),
(100, 21, 41, 13, 8, 'base'),
(101, 22, 41, 14, 15, 'base'),
(102, 22, 42, 10, 15, 'base'),
(103, 23, 43, 2, 7, 'base'),
(104, 21, 45, 12, 14, 'base'),
(105, 21, 46, 15, 15, 'base'),
(106, 22, 46, 2, 15, 'base'),
(107, 21, 47, 3, 6, 'base'),
(108, 22, 47, 14, 2, 'base'),
(109, 21, 48, 3, 9, 'base'),
(110, 22, 48, 9, 13, 'base'),
(111, 21, 49, 6, 10, 'base'),
(112, 21, 50, 15, 4, 'base'),
(113, 21, 50, 14, 4, 'conquete'),
(114, 21, 50, 5, 5, 'conquete'),
(115, 21, 51, 2, 10, 'base'),
(116, 22, 51, 10, 15, 'base');

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `cha_id` int(11) NOT NULL AUTO_INCREMENT,
  `cha_joueurs_id` int(11) NOT NULL,
  `cha_time` timestamp NULL DEFAULT NULL,
  `cha_message` varchar(255) DEFAULT NULL,
  `cha_parties_id` int(11) NOT NULL,
  PRIMARY KEY (`cha_id`),
  KEY `fk_chat_joueurs1_idx` (`cha_joueurs_id`),
  KEY `fk_chat_parties1_idx` (`cha_parties_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=134 ;

--
-- Contenu de la table `chat`
--

INSERT INTO `chat` (`cha_id`, `cha_joueurs_id`, `cha_time`, `cha_message`, `cha_parties_id`) VALUES
(3, 21, '2014-04-02 08:26:36', 'test message 1', 24),
(4, 21, '2014-04-17 12:25:15', 'test message 2', 24),
(5, 21, '2014-04-02 21:22:12', 'azrraerdfqfd', 25),
(6, 21, '2014-04-02 21:22:20', 'sdfsqfqsdf', 25),
(7, 21, '2014-04-02 21:22:27', 'xcvwv gsdfgsdgs dfgs', 25),
(8, 21, '2014-04-02 21:22:46', 'sdfg s dfgsdfg sg   fsg fsgsdf gs ', 25),
(9, 21, '2014-04-02 21:30:24', 'sdfg s dfgsdfg sg   fsg fsgsdf gs ', 25),
(10, 21, '2014-04-02 21:33:45', 'sdfg s dfgsdfg sg   fsg fsgsdf gs ', 25),
(11, 21, '2014-04-02 21:38:45', 'sdfg s dfgsdfg sg   fsg fsgsdf gs ', 25),
(12, 21, '2014-04-02 21:41:17', 'sdfg s dfgsdfg sg   fsg fsgsdf gs ', 25),
(13, 21, '2014-04-02 21:41:23', 'sdfg s dfgsdfg sg   fsg fsgsdf gs ', 25),
(14, 21, '2014-04-02 21:54:30', 'sfgdf dsffg sdg sfdgs sfdg ', 26),
(15, 21, '2014-04-02 21:54:36', 'sdfg sdfg sdfg sdfg sdfg sdfg', 26),
(16, 21, '2014-04-02 21:54:43', 'sdf gsdfg sgt rtzert zert tezt', 26),
(17, 21, '2014-04-02 21:54:54', 'zert zert zert zre tze', 26),
(18, 21, '2014-04-02 21:56:27', 'gsdfgf rtz zt ezrt  m mlklkl mk ', 26),
(19, 21, '2014-04-03 13:42:40', 'qsdfqsdfq sqdfqsdf sdfqsd ', 28),
(20, 21, '2014-04-03 13:42:41', NULL, 28),
(21, 21, '2014-04-03 13:43:20', 'sqdfqsdf d qsf qsdf ', 28),
(22, 21, '2014-04-03 13:43:21', NULL, 28),
(23, 21, '2014-04-03 13:43:36', 'sdqsdfqsdf ', 28),
(24, 21, '2014-04-03 13:43:36', NULL, 28),
(25, 21, '2014-04-03 13:44:09', 'sdqsdfqsdf ', 28),
(26, 21, '2014-04-03 13:45:50', 'sdqsdfqsdf ', 28),
(27, 21, '2014-04-03 13:46:56', 'sdqsdfqsdf ', 28),
(28, 21, '2014-04-03 13:51:21', 'sdqsdfqsdf ', 28),
(29, 21, '2014-04-03 13:56:17', 'sdqsdfqsdf ', 28),
(30, 21, '2014-04-03 13:56:28', '', 28),
(31, 21, '2014-04-03 13:56:53', '', 28),
(32, 21, '2014-04-03 13:58:02', '', 28),
(33, 21, '2014-04-03 14:02:21', '', 28),
(34, 21, '2014-04-03 14:03:46', '', 28),
(35, 21, '2014-04-03 14:04:13', '', 28),
(36, 21, '2014-04-03 14:06:45', '', 28),
(37, 21, '2014-04-03 14:23:04', '', 28),
(38, 21, '2014-04-03 14:27:32', '', 28),
(39, 21, '2014-04-03 14:27:47', 'arzerdfsdf dqs qsd fqsdf qsdf', 28),
(40, 21, '2014-04-03 14:28:48', 'GROS TEST', 28),
(41, 21, '2014-04-03 14:28:51', 'GROS TEST', 28),
(42, 21, '2014-04-03 14:28:52', 'GROS TEST', 28),
(43, 21, '2014-04-03 14:28:53', 'GROS TEST', 28),
(44, 21, '2014-04-03 14:28:54', 'GROS TEST', 28),
(45, 21, '2014-04-03 14:28:55', 'GROS TEST', 28),
(46, 21, '2014-04-03 14:28:56', 'GROS TEST', 28),
(47, 21, '2014-04-03 14:29:00', 'GROS TEST', 28),
(48, 21, '2014-04-03 14:29:01', '', 28),
(49, 21, '2014-04-03 14:29:02', 'GROS TEST', 28),
(50, 21, '2014-04-03 14:29:15', 'GROS TEST', 28),
(51, 21, '2014-04-03 14:31:47', 'GROS TEST', 28),
(52, 21, '2014-04-03 14:34:16', 'GROS TEST5645645', 28),
(53, 21, '2014-04-03 14:35:14', 'GROS TEST5645645', 28),
(54, 21, '2014-04-03 14:36:11', 'GROS TEST5645645', 28),
(55, 21, '2014-04-03 14:37:07', 'fgsdfg sfgs dfg sdfg sdfg sdf', 28),
(56, 21, '2014-04-03 14:37:37', 'tttttttt tttttttttttttttttttttt ttttt', 28),
(57, 21, '2014-04-03 14:37:48', 'tttttttt tttttttttttttttttttttt ttttt', 28),
(58, 21, '2014-04-03 14:38:04', 'tttttttt tttttttttttttttttttttt ttttt', 28),
(59, 21, '2014-04-03 14:38:14', 'tttttttt tttttttttttttttttttttt ttttt', 28),
(60, 21, '2014-04-03 14:39:23', 'qsdfqqsdcsdc', 28),
(61, 21, '2014-04-03 14:40:20', 'sdfgsdfgsdfg', 28),
(62, 21, '2014-04-03 14:41:36', 'azerazec  zefazef azer er', 28),
(63, 21, '2014-04-03 14:53:40', 'trtrtrtrtrtrtrt', 28),
(64, 21, '2014-04-03 15:07:40', 'fdhgd gfh dfg hdf ghd', 28),
(65, 21, '2014-04-03 15:07:53', 'sdfgsdfg sdfg sfg sdf gsdf gsfdg', 28),
(66, 21, '2014-04-03 15:08:20', 'sqfqsdfqsdfqsd qdsf qsd fqs df\n', 28),
(67, 21, '2014-04-03 15:08:39', 'sdfqsdfqsd qsdf qsdf qsdfqsdf', 28),
(68, 21, '2014-04-03 15:16:58', 'tessdfg sf sdgf sdg ', 28),
(69, 21, '2014-04-03 15:17:06', 'sdfg sdfg sfdg sdf g', 28),
(70, 21, '2014-04-03 15:17:09', 'sdfg sdfg sfg sdfg sf', 28),
(71, 21, '2014-04-03 15:17:12', 'sdfg sdfg sfdg sfdg sdfg s', 28),
(72, 21, '2014-04-03 15:30:15', 'qsdfqsdf qsdf qsdf sd', 28),
(73, 21, '2014-04-03 15:31:08', 'hg dhg dfhg d hgdhg dh ', 28),
(74, 22, '2014-04-03 15:49:57', 'fghdfhgdfghdfghd hd hg dgh', 29),
(75, 22, '2014-04-03 16:00:22', 'sqdfqsdfq ds qds qfs', 30),
(76, 22, '2014-04-03 16:00:40', 'gsdgfsdfg sdf gsd gsd gsdf gsd', 30),
(77, 22, '2014-04-03 16:02:32', 'qdfsqs qfs ds qfds', 30),
(78, 21, '2014-04-04 13:28:38', 'salut', 32),
(79, 22, '2014-04-04 13:28:49', 'salut ca va', 32),
(80, 21, '2014-04-04 13:28:56', 'oui et toi', 32),
(81, 22, '2014-04-04 13:32:32', 'gfdsfgsdf gd gs', 32),
(82, 21, '2014-04-17 13:48:45', 'jhflkjhflkjhlkjh ', 33),
(83, 21, '2014-04-17 13:57:43', 'fsdgsdgsdfg', 33),
(84, 21, '2014-04-17 13:59:47', 'fsdgsdgsdfg', 33),
(85, 22, '2014-04-18 21:22:12', 'fjhgfjhg\njhgkhgkhjj', 34),
(86, 21, '2014-04-18 21:28:43', 'sdfgsd', 34),
(87, 21, '2014-04-18 21:35:07', 'azerazerazer', 34),
(88, 21, '2014-04-18 21:38:52', 'sfgsdfgsdfgs', 34),
(89, 21, '2014-04-18 21:41:12', 'fqsdfqsdfqsfsd', 34),
(90, 21, '2014-04-18 21:43:29', 'xchgfhdfghdgh', 34),
(91, 21, '2014-04-18 21:45:48', 'azerazerazer', 34),
(92, 21, '2014-04-18 21:47:27', 'sgddfgsdfg gs df sdf gsdfg ', 34),
(93, 21, '2014-04-18 21:48:36', 'sfsdfgsdfgsdfgsfdg', 34),
(94, 21, '2014-04-18 21:50:26', 'azerazreazer', 34),
(95, 21, '2014-04-18 21:52:27', 'qsdfqsdfqsdf', 34),
(96, 22, '2014-04-18 21:53:49', 'sdfgsdfgsdfgs', 34),
(97, 22, '2014-04-18 21:55:11', 'qfqsdfqs', 34),
(98, 21, '2014-04-18 21:56:52', 'sdfgsdfgsfg', 34),
(99, 21, '2014-04-18 21:57:00', 'sdfgsdfg', 34),
(100, 21, '2014-04-18 21:57:06', 'bvcxbcvb', 34),
(101, 21, '2014-04-18 22:05:58', 'aezraze', 34),
(102, 22, '2014-04-18 22:12:26', 'aazereara ', 34),
(103, 22, '2014-04-18 22:15:50', 'qsdfqsdfqsdfq', 34),
(104, 22, '2014-04-18 22:20:16', 'qsdfqsdfqsdfqsdf', 34),
(105, 22, '2014-04-18 22:21:36', 'ertzertzertzer zer ztre ztrtz', 34),
(106, 21, '2014-04-18 22:21:41', 'zertzertzert', 34),
(107, 21, '2014-04-18 22:21:47', 'fdsgsdfsfgsdfgsdfg', 34),
(108, 22, '2014-04-18 22:21:54', 'sdfgsdfgsfdsgf', 34),
(109, 21, '2014-04-18 22:28:02', 'xwvwxcvwxcv', 34),
(110, 22, '2014-04-18 22:28:13', 'vcxvwxcvwx', 34),
(111, 21, '2014-04-18 22:30:37', 'bxcvbxcvbxcvbxcvbx', 34),
(112, 21, '2014-04-18 22:32:57', 'qgsfgsdfgsdfgsf', 34),
(113, 21, '2014-04-18 22:33:04', 'bxcvbxcvbxcvb', 34),
(114, 21, '2014-04-18 22:40:56', 'mjklmjklmjkl', 34),
(115, 21, '2014-04-18 22:44:41', 'sdgsdfgsdf', 34),
(116, 22, '2014-04-18 23:15:51', 'dqsfqsdfqsd', 34),
(117, 21, '2014-04-18 23:23:18', 'fqsfdqdqsdqfsdfqsd', 34),
(118, 22, '2014-04-18 23:25:34', 'qsdfqsdfqsdf', 34),
(119, 22, '2014-04-19 12:17:36', 'fsdfqfdqsdf', 37),
(120, 23, '2014-04-19 14:02:17', 'gfdhgfdhgf', 2),
(121, 21, '2014-04-19 14:02:39', 'kjgkhjgkhjgk', 2),
(122, 23, '2014-04-20 09:27:31', 'dfghdfghdfgd', 24),
(123, 22, '2014-04-20 09:27:40', 'gfsdfgsfdgsdfs', 24),
(124, 21, '2014-04-20 09:27:48', 'mlkjhgfds', 24),
(125, 22, '2014-04-20 17:21:39', 'jghjgjghj', 27),
(126, 22, '2014-04-20 17:21:45', 'fghfghfghfgh', 27),
(127, 22, '2014-04-20 17:21:48', 'fghfghfghfg', 27),
(128, 22, '2014-04-20 17:21:51', 'dgfdfgdfgdfgdfgd', 27),
(129, 23, '2014-04-20 17:21:56', 'Enter messagesdfsddfsfsdfsfsfdsfsd', 27),
(130, 23, '2014-04-20 17:22:01', 'hfghfghfgfgh', 27),
(131, 21, '2014-04-25 16:12:22', 'hgjfhjfhgj', 46),
(132, 22, '2014-04-25 16:12:26', 'fghjfghjfghjfhjf', 46),
(133, 22, '2014-04-25 16:12:29', 'fhjfhjfhgjf', 46);

-- --------------------------------------------------------

--
-- Structure de la table `connectes`
--

CREATE TABLE IF NOT EXISTS `connectes` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `con_joueurs_id` int(11) NOT NULL,
  `con_last_update` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`con_id`),
  KEY `fk_connectes_joueurs1_idx` (`con_joueurs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `connectes`
--

INSERT INTO `connectes` (`con_id`, `con_joueurs_id`, `con_last_update`) VALUES
(7, 21, '2014-04-27 22:52:41'),
(8, 22, '2014-04-27 22:52:31');

-- --------------------------------------------------------

--
-- Structure de la table `creations_unites`
--

CREATE TABLE IF NOT EXISTS `creations_unites` (
  `cru_id` int(11) NOT NULL AUTO_INCREMENT,
  `cru_joueurs_id` int(11) NOT NULL,
  `cru_unites_id` int(11) NOT NULL,
  `cru_quantite` int(11) DEFAULT '1',
  `cru_deb_construct` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cru_nec_time` int(11) DEFAULT '0',
  PRIMARY KEY (`cru_id`),
  KEY `fk_creations_unites_joueurs1_idx` (`cru_joueurs_id`),
  KEY `fk_creations_unites_unites1_idx` (`cru_unites_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `debloque_act`
--

CREATE TABLE IF NOT EXISTS `debloque_act` (
  `dea_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'SP : Unite1 : Niv1;\nSP : Unite2 : Niv4;\nSP : Unite3 : Niv7;\nDC : Tourelle: Niv1;\nDC : Dome : Niv2;...',
  `dea_type_batiments_id` int(11) NOT NULL,
  `dea_action` varchar(45) DEFAULT NULL,
  `dea_icon` varchar(45) DEFAULT NULL,
  `dea_onglet` varchar(60) DEFAULT NULL,
  `dea_niv_debloque` int(11) DEFAULT NULL,
  PRIMARY KEY (`dea_id`),
  KEY `fk_sp_debloque_bat_type_batiments1_idx` (`dea_type_batiments_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Contenu de la table `debloque_act`
--

INSERT INTO `debloque_act` (`dea_id`, `dea_type_batiments_id`, `dea_action`, `dea_icon`, `dea_onglet`, `dea_niv_debloque`) VALUES
(1, 1, 'colonies', 'colon', 'Colon', 1),
(2, 1, 'in_progress', 'update', 'Progress', 1),
(3, 1, 'upgrade_building', 'upgrade', 'UpgradeQG', 1),
(4, 2, 'create_fighters', 'unit1', 'Fighter', 1),
(5, 2, 'create_bombers', 'unit2', 'Bomber', 4),
(6, 2, 'create_cruisers', 'unit3', 'Cruiser', 7),
(7, 2, 'upgrade_building', 'upgrade', 'UpgradeSP', 1),
(8, 3, 'ore', 'ore', 'Ore', 1),
(9, 3, 'organic', 'organic', 'Organic', 1),
(10, 3, 'energy', 'energy', 'Energy', 1),
(11, 3, 'upgrade_building', 'upgrade', 'UpgradeRes', 1),
(12, 6, 'upgrade_building', 'upgrade', 'UpgradeWH', 1);

-- --------------------------------------------------------

--
-- Structure de la table `deplacements`
--

CREATE TABLE IF NOT EXISTS `deplacements` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_deplacement` varchar(45) DEFAULT NULL COMMENT 'type de deplacement : attaque, soutien transport',
  PRIMARY KEY (`dep_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `deplacements`
--

INSERT INTO `deplacements` (`dep_id`, `dep_deplacement`) VALUES
(1, 'attaque'),
(2, 'soutien'),
(3, 'transport');

-- --------------------------------------------------------

--
-- Structure de la table `deplacements_unites`
--

CREATE TABLE IF NOT EXISTS `deplacements_unites` (
  `deu_id` int(11) NOT NULL AUTO_INCREMENT,
  `deu_teams_id` int(11) NOT NULL,
  `deu_deplacements_id` int(11) NOT NULL,
  `deu_parties_id` int(11) NOT NULL,
  `deu_def_x` int(11) NOT NULL,
  `deu_def_y` int(11) NOT NULL,
  `deu_deb_depl_ts` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deu_duree` int(11) NOT NULL,
  `deu_charge_max` varchar(45) NOT NULL DEFAULT '0',
  `deu_etat` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`deu_id`),
  KEY `fk_deplacements_unites_deplacements1_idx` (`deu_deplacements_id`),
  KEY `fk_deplacements_unites_teams1_idx` (`deu_teams_id`),
  KEY `fk_deplacements_unites_parties1_idx` (`deu_parties_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='table des attaques' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `desc_pages`
--

CREATE TABLE IF NOT EXISTS `desc_pages` (
  `dep_id` int(11) NOT NULL AUTO_INCREMENT,
  `dep_pages_id` int(11) NOT NULL,
  `dep_elem_a_trad_id` int(11) NOT NULL,
  PRIMARY KEY (`dep_id`),
  KEY `fk_desc_pages_pages1_idx` (`dep_pages_id`),
  KEY `fk_desc_pages_elem_a_trad1_idx` (`dep_elem_a_trad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `desc_pages`
--

INSERT INTO `desc_pages` (`dep_id`, `dep_pages_id`, `dep_elem_a_trad_id`) VALUES
(1, 1, 17),
(2, 1, 18),
(3, 1, 19),
(4, 2, 20),
(5, 3, 21),
(6, 4, 22),
(7, 5, 23),
(8, 6, 24);

-- --------------------------------------------------------

--
-- Structure de la table `dictionnaire`
--

CREATE TABLE IF NOT EXISTS `dictionnaire` (
  `dic_id` int(11) NOT NULL AUTO_INCREMENT,
  `dic_langues_id` int(11) NOT NULL,
  `dic_designation` varchar(64) DEFAULT NULL,
  `dic_traduction` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`dic_id`),
  KEY `fk_dictionnaire_langues1_idx` (`dic_langues_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=293 ;

--
-- Contenu de la table `dictionnaire`
--

INSERT INTO `dictionnaire` (`dic_id`, `dic_langues_id`, `dic_designation`, `dic_traduction`) VALUES
(1, 1, 'liens', 'Liens'),
(2, 2, 'liens', 'Links'),
(3, 1, 'title_login', 'Connexion'),
(4, 2, 'title_login', 'Login to your acount'),
(5, 1, 'server', 'Serveur'),
(6, 2, 'server', 'Server'),
(7, 1, 'user_name', 'Identifiant'),
(8, 2, 'user_name', 'User Name'),
(9, 1, 'pwd', 'Mot de Passe'),
(10, 2, 'pwd', 'Password'),
(11, 1, 'sign_in', 'Entrer'),
(12, 2, 'sign_in', 'Sign In'),
(13, 1, 'sign_up', 'S''inscrire'),
(14, 2, 'sign_up', 'Sign Up'),
(15, 1, 'forgot_pwd', 'Mot de Passe Oublié'),
(16, 2, 'forgot_pwd', 'Forgot your Password'),
(17, 1, 'back', 'Retour'),
(18, 2, 'back', 'Back'),
(19, 1, 'email', 'Email'),
(20, 2, 'email', 'Email'),
(21, 1, 'send_new_pwd', 'Nouveau Mot de Passe'),
(22, 2, 'send_new_pwd', 'Send me a New Password'),
(23, 1, 'new_game', 'Nouvelle Partie'),
(24, 2, 'new_game', 'New Game'),
(25, 1, 'logout', 'Deconnexion'),
(26, 2, 'logout', 'Logout'),
(27, 1, 'game_info', 'Informations de la Partie'),
(28, 2, 'game_info', 'Game Informations'),
(31, 1, 'name', 'Nom'),
(32, 2, 'name', 'Name'),
(33, 1, 'game_name', 'Nom de la Partie'),
(34, 2, 'game_name', 'Game Name'),
(35, 1, 'max_players', 'Nombre de joueurs Maxi'),
(36, 2, 'max_players', 'Max Players'),
(37, 1, 'end', 'Fin'),
(38, 2, 'end', 'End'),
(39, 1, 'time_lapse', 'Lapse de Temps'),
(40, 2, 'time_lapse', 'Time Lapse'),
(41, 1, 'create', 'Créer'),
(42, 2, 'create', 'Create'),
(43, 1, 'home', 'Accueil'),
(44, 2, 'home', 'Home'),
(45, 1, 'login', 'Connexion'),
(46, 2, 'login', 'Login'),
(47, 1, 'confirm', 'Confirmer'),
(48, 2, 'confirm', 'Confirm'),
(49, 1, 'secu_lvl', 'Niveau de Sécurité'),
(50, 2, 'secu_lvl', 'Security Level'),
(53, 1, 'change_avatar', 'Changer d''Avatar'),
(54, 2, 'change_avatar', 'Change Avatar'),
(55, 1, 'output_size', 'Taille de Sortie'),
(56, 2, 'output_size', 'Output Size'),
(57, 1, 'join_game', 'Rejoindre une Partie'),
(58, 2, 'join_game', 'Join Game'),
(59, 1, 'search', 'Rechercher'),
(60, 2, 'search', 'Search'),
(61, 1, 'title_pwd', 'Mdp'),
(62, 2, 'title_pwd', 'pwd'),
(63, 1, 'players', 'Joueurs'),
(64, 2, 'players', 'Players'),
(67, 1, 'creator', 'Créateur'),
(68, 2, 'creator', 'Creator'),
(69, 1, 'join', 'Rejoindre'),
(70, 2, 'join', 'Join'),
(71, 1, 'hello', 'Bonjour'),
(72, 2, 'hello', 'Hello'),
(73, 1, 'ranking', 'Classement'),
(74, 2, 'ranking', 'Ranking'),
(75, 1, 'current_games', 'En Cours'),
(76, 2, 'current_games', 'Current Games'),
(77, 1, 'history', 'Historique'),
(78, 2, 'history', 'History'),
(79, 1, 'title_pos', 'Pos'),
(80, 2, 'title_pos', 'Pos'),
(81, 1, 'player', 'Joueur'),
(82, 2, 'player', 'Player'),
(83, 1, 'experience', 'Expérience'),
(84, 2, 'experience', 'Experience'),
(85, 1, 'nb_players', 'Nb Joueurs'),
(86, 2, 'nb_players', 'Nb Players'),
(87, 1, 'status', 'Statut'),
(88, 2, 'status', 'Status'),
(89, 1, 'date', 'Date'),
(90, 2, 'date', 'Date'),
(91, 1, 'avatar', 'Avatar'),
(92, 2, 'avatar', 'Avatar'),
(93, 1, 'old_pwd', 'Ancien Mot de passe'),
(94, 2, 'old_pwd', 'Old Password'),
(95, 1, 'new_pwd', 'Nouveau Mot de passe'),
(96, 2, 'new_pwd', 'New Password'),
(97, 1, 'old_email', 'Ancien Email'),
(98, 2, 'old_email', 'Old Email'),
(99, 1, 'new_email', 'Nouvel Email'),
(100, 2, 'new_email', 'New Email'),
(101, 1, 'update', 'Mettre à Jour'),
(102, 2, 'update', 'Update'),
(103, 1, 'win', 'Gagné'),
(104, 2, 'win', 'Win'),
(105, 1, 'loose', 'Perdu'),
(106, 2, 'loose', 'Loose'),
(107, 1, 'game_load', 'Partie en Attente'),
(108, 2, 'game_load', 'Game on Load'),
(109, 1, 'opt_game', 'Options de la Partie'),
(110, 2, 'opt_game', 'Options Game'),
(111, 1, 'opt', 'Options'),
(112, 2, 'opt', 'Options'),
(113, 1, 'humans', 'Humains'),
(114, 2, 'humans', 'Humans'),
(115, 1, 'reptils', 'Reptiliens'),
(116, 2, 'reptils', 'Reptilians'),
(117, 1, 'arachnids', 'Arachnides'),
(118, 2, 'arachnids', 'Arachnids'),
(119, 1, 'ready', 'Prêt'),
(120, 2, 'ready', 'Ready'),
(121, 1, 'race', 'Race'),
(122, 2, 'race', 'Race'),
(123, 1, 'team', 'Equipe'),
(124, 2, 'team', 'Team'),
(125, 1, 'message', 'Message'),
(126, 2, 'message', 'Message'),
(127, 1, 'send', 'Envoi'),
(128, 2, 'send', 'Send'),
(129, 1, 'qg', 'Quartier Général'),
(130, 2, 'qg', 'Head Quarter'),
(131, 1, 'spaceport', 'Port Spacial'),
(132, 2, 'spaceport', 'SpacePort'),
(133, 1, 'resources', 'Ressources'),
(134, 2, 'resources', 'Resources'),
(135, 1, 'warehouse', 'Entrepot'),
(136, 2, 'warehouse', 'Warehouse'),
(137, 1, 'research_center', 'Centre de Recherche'),
(138, 2, 'research_center', 'Research Center'),
(139, 1, 'defense_center', 'Centre de Défense'),
(140, 2, 'defense_center', 'Defense Center'),
(141, 1, 'coords', 'Coordonnées'),
(142, 2, 'coords', 'Coordinates'),
(145, 1, 'planet', 'Planète'),
(146, 2, 'planet', 'Planet'),
(147, 1, 'type', 'Type'),
(148, 2, 'type', 'Type'),
(149, 1, 'units', 'Unités'),
(150, 2, 'units', 'Units'),
(151, 1, 'attack', 'Attaque'),
(152, 2, 'attack', 'Attack'),
(153, 1, 'support', 'Support'),
(154, 2, 'support', 'Support'),
(155, 1, 'transport', 'Transport'),
(156, 2, 'transport', 'Transport'),
(159, 1, 'fighters', 'Combattants'),
(160, 2, 'fighters', 'Fighters'),
(161, 1, 'bombers', 'Bombardiers'),
(162, 2, 'bombers', 'Bombers'),
(163, 1, 'cruisers', 'Croiseurs'),
(164, 2, 'cruisers', 'Cruisers'),
(165, 1, 'time', 'Temps'),
(166, 2, 'time', 'Time'),
(167, 1, 'capacity', 'Capacité'),
(168, 2, 'capacity', 'Capacity'),
(169, 1, 'launch', 'Lancer'),
(170, 2, 'launch', 'Launch'),
(171, 1, 'current_attacks', 'Attaques en Cours'),
(172, 2, 'current_attacks', 'Current Attacks'),
(173, 1, 'available_units', 'Unités Disponibles'),
(174, 2, 'available_units', 'Available Units'),
(175, 1, 'teams', 'Equipe'),
(176, 2, 'teams', 'Teams'),
(177, 1, 'orders', 'Ordres'),
(178, 2, 'orders', 'Orders'),
(179, 1, 'rapport_de', 'Rapport de'),
(180, 2, 'rapport_de', 'Report'),
(181, 1, 'remaining', 'Restant'),
(182, 2, 'remaining', 'Remaining'),
(183, 1, 'ore', 'Minerai'),
(184, 2, 'ore', 'Ore'),
(185, 1, 'organic', 'Organique'),
(186, 2, 'organic', 'Organic'),
(187, 1, 'energy', 'Energie'),
(188, 2, 'energy', 'Energy'),
(189, 1, 'hour', 'Heure'),
(190, 2, 'hour', 'Hour'),
(191, 1, 'enemy', 'Ennemi'),
(192, 2, 'enemy', 'Enemy'),
(193, 1, 'attacks', 'Attaques'),
(194, 2, 'attacks', 'Attacks'),
(195, 1, 'defenses', 'Défenses'),
(196, 2, 'defenses', 'Defenses'),
(197, 1, 'att_reports', 'Rapports d''Attaque'),
(198, 2, 'att_reports', 'Attack Reports'),
(199, 1, 'ally_player', 'Joueur Allié'),
(200, 2, 'ally_player', 'Allied Player'),
(201, 1, 'enemy_player', 'Joueur Ennemi'),
(202, 2, 'enemy_player', 'Enemy Player'),
(203, 1, 'alliance_reports', 'Rapports d''Alliance'),
(204, 2, 'alliance_reports', 'Alliance Reports'),
(205, 1, 'time_left', 'Temps Restant'),
(206, 2, 'time_left', 'Time Left'),
(207, 1, 'map', 'Carte'),
(208, 2, 'map', 'Map'),
(209, 1, 'reports', 'Rapports'),
(210, 2, 'reports', 'Reports'),
(211, 1, 'player_info', 'Informations du Joueur'),
(212, 2, 'player_info', 'Player Informations'),
(213, 1, 'upgrade_building', 'Améliorer Batiment'),
(214, 2, 'upgrade_building', 'Upgrade Building'),
(215, 1, 'next_level', 'Prochain Niveau'),
(216, 2, 'next_level', 'Next Level'),
(217, 1, 'nec_time', 'Temps Nécessaire'),
(218, 2, 'nec_time', 'Necessary Time'),
(219, 1, 'cost_construct', 'Coût de la Construction'),
(220, 2, 'cost_construct', 'Cost Construct'),
(221, 1, 'bonus', 'Bonus'),
(222, 2, 'bonus', 'Bonus'),
(223, 1, 'upgrade', 'Améliorer'),
(224, 2, 'upgrade', 'Upgrade'),
(225, 1, 'colonies', 'Colonies'),
(226, 2, 'colonies', 'Colonies'),
(227, 1, 'in_progress', 'En Cours'),
(228, 2, 'in_progress', 'In Progress'),
(229, 1, 'upgrade_building', 'Améliorer Batiment'),
(230, 2, 'upgrade_building', 'Upgrade Building'),
(231, 1, 'create_fighters', 'Créer des Combattants'),
(232, 2, 'create_fighters', 'Create Fighters'),
(233, 1, 'create_bombers', 'Créer des Bombardiers'),
(234, 2, 'create_bombers', 'Create Bombers'),
(235, 1, 'create_cruisers', 'Créer des Croiseurs'),
(236, 2, 'create_cruisers', 'Create Cruisers'),
(237, 1, 'exploitation', 'Exploitation'),
(238, 2, 'exploitation', 'Exploitation'),
(239, 1, 'cost', 'Coût'),
(240, 2, 'cost', 'Cost'),
(241, 1, 'defense', 'Défense'),
(242, 2, 'defense', 'Defense'),
(243, 1, 'charge', 'Charge'),
(244, 2, 'charge', 'Load'),
(245, 1, 'speed', 'Vitesse'),
(246, 2, 'speed', 'Speed'),
(247, 1, 'life', 'Vie'),
(248, 2, 'life', 'Life'),
(249, 1, 'owned', 'Possédés'),
(250, 2, 'owned', 'Owned'),
(251, 1, 'current_construct', 'Construction en Cours'),
(252, 2, 'current_construct', 'Current Construction'),
(253, 1, 'construct', 'Construction'),
(254, 2, 'construct', 'Construct'),
(255, 1, 'unlocked', 'Débloqué'),
(256, 2, 'unlocked', 'Unlocked'),
(257, 1, 'send_new_team', 'Envoyer nouvelle Equipe'),
(258, 2, 'send_new_team', 'Send New Team'),
(259, 1, 'waiting', 'En Attente'),
(260, 2, 'waiting', 'Waiting'),
(261, 1, 'colony', 'Colonie'),
(262, 2, 'colony', 'Colony'),
(263, 1, 'waiting_orders', 'Attend les Ordres'),
(264, 2, 'waiting_orders', 'Waiting Orders'),
(265, 1, 'tout_public', 'Tout Public'),
(266, 2, 'tout_public', 'Public'),
(267, 1, 'members', 'Membres'),
(268, 2, 'members', 'Members'),
(269, 1, 'other_pages', 'Autres Pages'),
(270, 2, 'other_pages', 'Other Pages'),
(271, 1, 'quand_abus', 'Quand a eu lieu l''abus'),
(272, 2, 'quand_abus', 'When was abuse'),
(273, 1, 'heure_abus', 'Heure de l''abus'),
(274, 2, 'heure_abus', 'Time abuse'),
(281, 1, 'description_abus', 'Description (la plus détaillée possible) de l''abus'),
(282, 2, 'description_abus', 'Description (as detailed as possible) abuse'),
(283, 1, 'quand_bug', 'Quand a eu lieu le Bug'),
(284, 2, 'quand_bug', 'When was bug'),
(285, 1, 'heure_bug', 'Heure du Bug'),
(286, 2, 'heure_bug', 'Time Bug'),
(287, 1, 'description_bug', 'Description (la plus détaillée possible) du Bug'),
(288, 2, 'description_bug', 'Description (as detailed as possible) Bug'),
(289, 1, 'won_match', 'Gagne la partie'),
(290, 2, 'won_match', 'Won the Match'),
(291, 1, 'quitGame', 'Quitter la Partie'),
(292, 2, 'quitGame', 'Quit Game');

-- --------------------------------------------------------

--
-- Structure de la table `elem_a_trad`
--

CREATE TABLE IF NOT EXISTS `elem_a_trad` (
  `eat_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`eat_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `elem_a_trad`
--

INSERT INTO `elem_a_trad` (`eat_id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9),
(10),
(11),
(12),
(13),
(14),
(15),
(16),
(17),
(18),
(19),
(20),
(21),
(22),
(23),
(24),
(25),
(26),
(27),
(28),
(29),
(30),
(31),
(32),
(33),
(34);

-- --------------------------------------------------------

--
-- Structure de la table `joueurs`
--

CREATE TABLE IF NOT EXISTS `joueurs` (
  `jou_id` int(11) NOT NULL AUTO_INCREMENT,
  `jou_login` varchar(255) NOT NULL,
  `jou_mdp` varchar(255) NOT NULL,
  `jou_email` varchar(90) DEFAULT NULL,
  `jou_xp` int(11) DEFAULT '0',
  `jou_parties_id` int(11) DEFAULT NULL,
  `jou_ready` tinyint(1) DEFAULT '0',
  `jou_team` int(11) DEFAULT NULL,
  `jou_langues_id` int(11) NOT NULL,
  `jou_avatar` varchar(255) DEFAULT NULL,
  `jou_activate` varchar(255) DEFAULT NULL,
  `jou_races_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`jou_id`),
  KEY `fk_joueurs_parties1_idx` (`jou_parties_id`),
  KEY `fk_joueurs_langues1_idx` (`jou_langues_id`),
  KEY `fk_joueurs_races1_idx` (`jou_races_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Contenu de la table `joueurs`
--

INSERT INTO `joueurs` (`jou_id`, `jou_login`, `jou_mdp`, `jou_email`, `jou_xp`, `jou_parties_id`, `jou_ready`, `jou_team`, `jou_langues_id`, `jou_avatar`, `jou_activate`, `jou_races_id`) VALUES
(21, 'Vladimir', 'llvhVdMnjPKxGGLscd9DRCY3CHbl5BcMLSBrRh6B', 'scarf666@msn.com', 2564800, NULL, 0, NULL, 1, 'steph.jpg', '1', 1),
(22, 'Joe256', 'h7ohVSCujPyocGLzqe9DDLR3CleV5BsvZSBgMq6B', 'stephane.pecqueur@gmail.com', 150, NULL, 0, NULL, 1, 'Joe256.jpg', '1', 1),
(23, 'francois', '5ychVY3wjP93OGLM5n9DtEL3C5pC5B1ZDSBmS76B', 'scarf666@msn.com', 0, NULL, 0, NULL, 1, 'test06.jpg', '1', 1),
(24, 'Clint555', 'WNqhV4CKjPvcvGLKee9Dn4A3CTXe5BxSnSBn986B', 'scarf666@msn.com', 0, NULL, 0, NULL, 1, 'avatarDefault.png', '4a7ebe3b8ebb1740cf030ca12ed580c2', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `langues`
--

CREATE TABLE IF NOT EXISTS `langues` (
  `lan_id` int(11) NOT NULL AUTO_INCREMENT,
  `lan_designation` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`lan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `langues`
--

INSERT INTO `langues` (`lan_id`, `lan_designation`) VALUES
(1, 'fr'),
(2, 'en');

-- --------------------------------------------------------

--
-- Structure de la table `messages_admin`
--

CREATE TABLE IF NOT EXISTS `messages_admin` (
  `mea_id` int(11) NOT NULL AUTO_INCREMENT,
  `mea_type_message` enum('abus','bug') DEFAULT 'bug',
  `mea_login` varchar(45) DEFAULT NULL,
  `mea_date_mess` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `mea_date_bug` timestamp NULL DEFAULT NULL,
  `mea_message` text,
  PRIMARY KEY (`mea_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `messages_admin`
--

INSERT INTO `messages_admin` (`mea_id`, `mea_type_message`, `mea_login`, `mea_date_mess`, `mea_date_bug`, `mea_message`) VALUES
(1, 'abus', 'test', '2014-04-17 13:21:27', '0000-00-00 00:00:00', 'azertyuiop'),
(2, 'abus', 'yhgdfg', '2014-04-17 13:29:25', '2014-04-30 01:08:00', 'azertyuiopmlkjhgfdsq'),
(3, 'abus', 'dgfhdgfh', '2014-04-17 14:00:42', '2014-04-11 09:31:00', 'azertyuioplkjhgfdsq'),
(4, 'abus', 'dfghdgf', '2014-04-17 14:21:20', '2014-04-11 09:31:00', 'azertyuioplkjhgfdsq'),
(5, 'abus', 'dfghdfgh', '2014-04-17 14:21:38', '2014-04-11 09:31:00', 'azertyuioplkjhgfdsq'),
(6, 'abus', 'dfghdfgh', '2014-04-17 14:29:00', '2014-04-03 12:26:00', 'mlkjhgfdsqnbvcxw'),
(7, 'abus', 'dgfhdgfh', '2014-04-17 14:30:35', '2014-04-03 12:26:00', 'mlkjhgfdsqnbvcxw'),
(8, 'bug', 'dfghdgfh', '2014-04-17 14:32:12', '2014-04-03 08:21:00', 'nbvccxwmlkjhgfdsq');

-- --------------------------------------------------------

--
-- Structure de la table `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `pag_id` int(11) NOT NULL AUTO_INCREMENT,
  `pag_name` varchar(45) DEFAULT NULL,
  `pag_template` varchar(45) DEFAULT NULL,
  `pag_elem_a_trad_id` int(11) NOT NULL,
  PRIMARY KEY (`pag_id`),
  KEY `fk_pages_elem_a_trad1_idx` (`pag_elem_a_trad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `pages`
--

INSERT INTO `pages` (`pag_id`, `pag_name`, `pag_template`, `pag_elem_a_trad_id`) VALUES
(1, 'accueil', 'styleAccueil', 1),
(2, 'confirmInscript', 'styleAccueil', 2),
(3, 'envoimail', 'styleAccueil', 3),
(4, 'forgot_pwd', 'styleAccueil', 4),
(5, 'recupPwd', 'styleAccueil', 5),
(6, 'createGame', 'styleProfil', 6),
(7, 'game', 'styleProfil', 7),
(8, 'inscription', 'styleProfil', 8),
(9, 'joinGame', 'styleProfil', 9),
(10, 'profil', 'styleProfil', 10),
(11, 'waitGame', 'styleProfil', 11),
(12, 'about', 'styleAccueil', 12),
(13, 'plan', 'styleAccueil', 13),
(14, 'informations', 'styleAccueil', 14),
(15, 'abus', 'styleAccueil', 15),
(16, 'bug', 'styleAccueil', 16),
(17, 'endOfGame', 'styleAccueil', 34);

-- --------------------------------------------------------

--
-- Structure de la table `parties`
--

CREATE TABLE IF NOT EXISTS `parties` (
  `par_id` int(11) NOT NULL AUTO_INCREMENT,
  `par_nom` varchar(100) DEFAULT NULL,
  `par_pwd` varchar(20) DEFAULT NULL,
  `par_nb_joueurs` int(11) DEFAULT NULL,
  `par_type_end` enum('TIME','AREAS') DEFAULT 'TIME',
  `par_H_debut` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `par_wait` tinyint(1) DEFAULT NULL,
  `par_creator` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`par_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Contenu de la table `parties`
--

INSERT INTO `parties` (`par_id`, `par_nom`, `par_pwd`, `par_nb_joueurs`, `par_type_end`, `par_H_debut`, `par_wait`, `par_creator`) VALUES
(1, 'azertyuiop', '', 16, 'TIME', '2014-04-19 12:53:30', NULL, 'steph'),
(2, 'poiuytrez', '', 16, 'TIME', '2014-04-19 14:03:38', NULL, 'steph'),
(24, 'dfgdfhd fhdh f', '', 16, 'TIME', '2014-04-20 09:28:03', NULL, 'steph'),
(25, 'mkmjklghjkghkghj', '', 16, 'TIME', '2014-04-20 12:51:33', NULL, 'steph'),
(26, 'gsfdgsdfgsdfg', '', 16, 'TIME', '2014-04-20 14:35:58', NULL, 'steph'),
(27, 'azeracrae', '', 16, 'TIME', '2014-04-20 17:22:10', NULL, 'steph'),
(28, 'hdfhgdhbcnbcvb', '', 16, 'TIME', '2014-04-20 21:18:06', NULL, 'steph'),
(29, 'dsfgsd fgsd fgsd fgsdf', '', 16, 'TIME', '2014-04-20 23:30:29', NULL, 'steph'),
(30, 'fdgsfdg sdfg sdfg sdfg sfdg sdf', '', 16, 'TIME', '2014-04-16 09:19:16', NULL, 'steph'),
(31, 'essai', '', 16, 'TIME', '2014-04-23 21:55:47', NULL, NULL),
(32, 'testmag', 'azerty', 16, 'TIME', '2014-04-23 14:29:51', NULL, 'Joe256'),
(33, 'newGame', '', 4, 'TIME', '2014-04-10 13:06:43', NULL, 'steph'),
(34, 'testcomplet', '', 4, 'TIME', '2014-04-18 23:37:15', NULL, 'steph'),
(35, 'abcdef', '', 16, 'TIME', '2014-04-18 23:47:47', NULL, 'steph'),
(36, 'sdgfdsgfdfd', '', 16, 'TIME', '2014-04-19 12:11:05', NULL, 'Joe256'),
(37, 'azertyuiop', '', 2, 'TIME', '2014-04-19 12:17:39', NULL, 'Joe256'),
(38, 'wqaxsz', '', 16, 'TIME', '2014-04-19 12:24:02', NULL, 'Joe256'),
(39, 'reza', '', 2, 'TIME', '2014-04-19 12:46:39', NULL, 'steph'),
(40, 'gsdfgsfds', '', 16, 'TIME', '2014-04-19 12:50:45', NULL, 'Joe256'),
(41, 'mklfjgmsklfg', '', 16, 'TIME', '2014-04-23 22:02:18', NULL, 'Vladimir'),
(42, 'mklmjklmjklmj', '', 16, 'TIME', '2014-04-24 23:14:27', NULL, 'Vladimir'),
(43, 'oyuioyuioyuioy', '', 16, 'TIME', '2014-04-24 23:18:13', NULL, 'Vladimir'),
(44, 'azertyuio', '', 16, 'TIME', NULL, 0, 'Joe256'),
(45, 'sfgdfgdf', '', 16, 'TIME', '2014-04-24 23:22:26', NULL, 'Vladimir'),
(46, 'fsqsfdgsdfgsfdg', '', 16, 'TIME', '2014-04-25 16:12:44', NULL, 'Joe256'),
(47, 'fghgfhfdgh', '', 16, 'TIME', '2014-04-25 16:18:47', NULL, 'Joe256'),
(48, 'jfgjfghjfghjfghjf', '', 16, 'TIME', '2014-04-26 14:40:19', NULL, 'Joe256'),
(49, 'azerty', '', 16, 'TIME', '2014-04-27 09:49:37', NULL, 'Vladimir'),
(50, 'azerty', '', 16, 'TIME', '2014-04-27 12:55:56', NULL, 'Vladimir'),
(51, 'qgdsgqfdgdsfg', '', 16, 'TIME', '2014-04-27 18:41:18', NULL, 'Vladimir');

-- --------------------------------------------------------

--
-- Structure de la table `qg_debloque_bat`
--

CREATE TABLE IF NOT EXISTS `qg_debloque_bat` (
  `qg_deb_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'QG1 : SP1, Res1, SC1, DC1, WH1;\nQG2 : SP3, Res4, SC2, DC2, WH3;... ',
  `qg_deb_Niv_Spaceport` int(11) DEFAULT NULL,
  `qg_deb_Niv_Ressources` int(11) DEFAULT NULL,
  `qg_deb_Niv_Search` int(11) DEFAULT NULL,
  `qg_deb_Niv_Defense` int(11) DEFAULT NULL,
  `qg_deb_Niv_Entrepot` int(11) DEFAULT NULL,
  PRIMARY KEY (`qg_deb_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `qg_debloque_bat`
--

INSERT INTO `qg_debloque_bat` (`qg_deb_id`, `qg_deb_Niv_Spaceport`, `qg_deb_Niv_Ressources`, `qg_deb_Niv_Search`, `qg_deb_Niv_Defense`, `qg_deb_Niv_Entrepot`) VALUES
(1, 1, 1, 1, 1, 1),
(2, 3, 4, 2, 2, 3),
(3, 5, 7, 2, 3, 6),
(4, 7, 10, 3, 3, 8),
(5, 9, 13, 3, 3, 10);

-- --------------------------------------------------------

--
-- Structure de la table `races`
--

CREATE TABLE IF NOT EXISTS `races` (
  `rac_id` int(11) NOT NULL AUTO_INCREMENT,
  `rac_designation` varchar(45) DEFAULT NULL,
  `rac_elem_a_trad_id` int(11) NOT NULL,
  PRIMARY KEY (`rac_id`),
  KEY `fk_races_elem_a_trad1_idx` (`rac_elem_a_trad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `races`
--

INSERT INTO `races` (`rac_id`, `rac_designation`, `rac_elem_a_trad_id`) VALUES
(1, 'humains', 25),
(2, 'reptiliens', 26),
(3, 'arachnides', 27);

-- --------------------------------------------------------

--
-- Structure de la table `rapports`
--

CREATE TABLE IF NOT EXISTS `rapports` (
  `rap_id` int(11) NOT NULL AUTO_INCREMENT,
  `rap_joueurs_id_att` int(11) NOT NULL,
  `rap_joueurs_id_def` int(11) NOT NULL,
  `rap_def_x` int(11) DEFAULT NULL,
  `rap_def_y` int(11) DEFAULT NULL,
  `rap_unit1_dep_att` int(11) DEFAULT NULL,
  `rap_unit2_dep_att` int(11) DEFAULT NULL,
  `rap_unit3_dep_att` int(11) DEFAULT NULL,
  `rap_unit1_dep_def` int(11) DEFAULT NULL,
  `rap_unit2_dep_def` int(11) DEFAULT NULL,
  `rap_unit3_dep_def` int(11) DEFAULT NULL,
  `rap_unit1_arr_att` int(11) DEFAULT NULL,
  `rap_unit2_arr_att` int(11) DEFAULT NULL,
  `rap_unit3_arr_att` int(11) DEFAULT NULL,
  `rap_unit1_arr_def` int(11) DEFAULT NULL,
  `rap_unit2_arr_def` int(11) DEFAULT NULL,
  `rap_unit3_arr_def` int(11) DEFAULT NULL,
  `rap_ressource1` int(11) DEFAULT NULL,
  `rap_ressource2` int(11) DEFAULT NULL,
  `rap_ressource3` int(11) DEFAULT NULL,
  `rap_gagnee` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`rap_id`),
  KEY `fk_rapports_joueurs1_idx` (`rap_joueurs_id_att`),
  KEY `fk_rapports_joueurs2_idx` (`rap_joueurs_id_def`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `ressources`
--

CREATE TABLE IF NOT EXISTS `ressources` (
  `res_id` int(11) NOT NULL AUTO_INCREMENT,
  `res_joueurs_id` int(11) NOT NULL,
  `res_types_ressources_id` int(11) NOT NULL,
  `res_quantite` int(11) DEFAULT NULL,
  `res_niveau` int(11) DEFAULT NULL,
  `res_derniere_maj` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `res_amelio_debut_TS` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`res_id`),
  KEY `fk_ressources_types_ressources1_idx` (`res_types_ressources_id`),
  KEY `fk_ressources_joueurs1_idx` (`res_joueurs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `resultats_parties`
--

CREATE TABLE IF NOT EXISTS `resultats_parties` (
  `rep_id` int(11) NOT NULL AUTO_INCREMENT,
  `rep_parties_id` int(11) NOT NULL,
  `rep_joueurs_id` int(11) NOT NULL,
  `rep_team` int(11) DEFAULT NULL,
  `rep_nb_colonies` int(11) DEFAULT NULL,
  `rep_xp` int(11) DEFAULT NULL,
  PRIMARY KEY (`rep_id`),
  KEY `fk_resultats_parties_parties1_idx` (`rep_parties_id`),
  KEY `fk_resultats_parties_joueurs1_idx` (`rep_joueurs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=53 ;

--
-- Contenu de la table `resultats_parties`
--

INSERT INTO `resultats_parties` (`rep_id`, `rep_parties_id`, `rep_joueurs_id`, `rep_team`, `rep_nb_colonies`, `rep_xp`) VALUES
(1, 34, 21, 1, 36, 21600),
(2, 34, 22, 1, 1, 50),
(3, 35, 21, 2, 36, 21600),
(4, 35, 22, 4, 1, 50),
(5, 36, 21, 3, 36, 21600),
(6, 36, 22, 5, 1, 50),
(7, 37, 21, 6, NULL, 0),
(8, 37, 22, 4, NULL, 0),
(9, 38, 21, 4, NULL, 0),
(10, 38, 22, 4, NULL, 0),
(11, 39, 21, 2, 0, 0),
(12, 40, 22, 1, 0, 0),
(13, 1, 21, 4, 0, 0),
(14, 1, 22, 1, 0, 0),
(15, 1, 22, 1, 0, 0),
(16, 2, 21, 1, 5, 0),
(17, 2, 22, 2, 10, 0),
(18, 2, 23, 3, 3, 0),
(19, 24, 21, 1, 0, 0),
(20, 24, 22, 1, 0, 0),
(21, 24, 23, 2, 0, 0),
(22, 25, 21, 2, 0, 0),
(23, 25, 22, 1, 0, 0),
(24, 25, 23, 1, 0, 0),
(25, 25, 23, 1, 0, 0),
(26, 26, 21, 1, 0, 0),
(27, 26, 22, 2, 0, 0),
(28, 26, 23, 1, 0, 0),
(29, 27, 21, 2, 0, 0),
(30, 27, 21, 2, 0, 0),
(31, 27, 22, 1, 0, 0),
(32, 27, 22, 1, 0, 0),
(33, 27, 23, 1, 0, 0),
(34, 27, 23, 1, 0, 0),
(35, 28, 21, 2, 0, 0),
(36, 28, 22, 1, 0, 0),
(37, 28, 23, 1, 0, 0),
(38, 32, 21, 1, 0, 0),
(39, 32, 22, 2, 0, 0),
(40, 31, 21, 1, 0, 0),
(41, 31, 22, 1, 0, 0),
(42, 41, 21, 2, 0, 0),
(43, 41, 22, 1, 0, 0),
(44, 45, 21, 1, 0, 0),
(45, 46, 21, 3, 0, 0),
(46, 46, 22, 4, 0, 0),
(47, 47, 21, 3, 0, 0),
(48, 47, 22, 1, 0, 0),
(49, 48, 22, 2, 0, 0),
(50, 50, 21, 1, 0, 0),
(51, 51, 21, 1, 0, 0),
(52, 51, 22, 2, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `tea_id` int(11) NOT NULL AUTO_INCREMENT,
  `tea_joueurs_id` int(11) NOT NULL,
  `tea_unit1` int(11) DEFAULT '0',
  `tea_unit2` int(11) DEFAULT '0',
  `tea_unit3` int(11) DEFAULT '0',
  `tea_pos_x` int(11) DEFAULT '1',
  `tea_pos_y` int(11) DEFAULT '1',
  `tea_num` int(11) DEFAULT '0',
  PRIMARY KEY (`tea_id`),
  KEY `fk_teams_joueurs1_idx` (`tea_joueurs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `total_units`
--

CREATE TABLE IF NOT EXISTS `total_units` (
  `tou_id` int(11) NOT NULL AUTO_INCREMENT,
  `tou_joueurs_id` int(11) NOT NULL,
  `tou_units1` int(11) DEFAULT '0',
  `tou_units2` int(11) DEFAULT '0',
  `tou_units3` int(11) DEFAULT '0',
  PRIMARY KEY (`tou_id`),
  KEY `fk_total_units_joueurs1_idx` (`tou_joueurs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `traductions`
--

CREATE TABLE IF NOT EXISTS `traductions` (
  `tra_id` int(11) NOT NULL AUTO_INCREMENT,
  `tra_elem_a_trad_id` int(11) NOT NULL,
  `tra_nom` varchar(255) DEFAULT NULL,
  `tra_langues_id` int(11) NOT NULL,
  PRIMARY KEY (`tra_id`),
  KEY `fk_traductions_langues1_idx` (`tra_langues_id`),
  KEY `fk_traductions_elem_a_trad1_idx` (`tra_elem_a_trad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Contenu de la table `traductions`
--

INSERT INTO `traductions` (`tra_id`, `tra_elem_a_trad_id`, `tra_nom`, `tra_langues_id`) VALUES
(1, 1, 'Accueil', 1),
(2, 1, 'Home', 2),
(3, 2, 'Confirmation Inscription', 1),
(4, 2, 'Registration confirmation', 2),
(5, 3, 'Mail de Confirmation', 1),
(6, 3, 'Mail Confirmation', 2),
(7, 4, 'Mot de passe oublié', 1),
(8, 4, 'Forgot Password', 2),
(9, 5, 'Récupérer Mot de Passe', 1),
(10, 5, 'Recover Password', 2),
(11, 6, 'Creation de partie', 1),
(12, 6, 'Create Game', 2),
(13, 7, 'Partie', 1),
(14, 7, 'Game', 2),
(15, 8, 'Inscription', 1),
(16, 8, 'Signup', 2),
(17, 9, 'Rejoindre une partie', 1),
(18, 9, 'Join Game', 2),
(19, 10, 'Profil', 1),
(20, 10, 'Profile', 2),
(21, 11, 'Attente de Joueurs', 1),
(22, 11, 'Waiting for Players', 2),
(23, 12, 'A Propos', 1),
(24, 12, 'About Us', 2),
(25, 13, 'Plan du site', 1),
(26, 13, 'Map Site', 2),
(27, 14, 'Informations Légales', 1),
(28, 14, 'Legal Informations', 2),
(29, 15, 'Signaler un Abus', 1),
(30, 15, 'Report Abuse', 2),
(31, 16, 'Signaler un Bug', 1),
(32, 16, 'Report Bug', 2),
(33, 17, 'Warriors of the Galaxy est un jeu en ligne et multijoueur sur le thème de l''espace et de la conquète spaciale. C''est un jeu sur navigateur, developpé en PHP et JavaScript. Il ne nécessite donc aucune installation.', 1),
(34, 17, 'Warriors of the Galaxy is a multiplayer online game and on the topic of space and the spatial conquest. It is a browser game, developed in PHP and JavaScript. It does not require any installation.', 2),
(35, 18, 'Le but est d''améliorer sa planète, conquérir des territoires et les defendre face à vos adversaires. Pour cela, vous devrez vous battre en equipe et mettre en place des stratégies d''attaque et de defense.', 1),
(36, 18, 'The aim is to improve the planet, conquer territories and defend your opponents face. To do this, you will fight as a team and implement strategies of attack and defense.', 2),
(37, 19, 'Rejoignez-nous et faites évoluer votre avatar au fur et à mesure des parties gagnées. En effet, chaque partie dure entre 1 et 2 heures, et vous permet de débloquer des surprises et gagner de l''expérience.', 1),
(38, 19, 'Join us and evolve your avatar to progressively games won. In fact, each game lasts between 1 and 2 hours, and allows you to unlock surprises and gain experience.', 2),
(39, 20, 'Votre compte est maintenant activé. Vous pouvez vous connecter à partir de la page d''accueil.', 1),
(40, 20, 'Your account is now activated. You can login from the home page.', 2),
(41, 21, 'Un message a été envoyé à votre adresse email. Merci de suivre le lien dans cet e-mail pour confirmer votre inscription.', 1),
(42, 21, 'A message has been sent to your adress mail. Thank you to follow the link in this email to confirm your registration.', 2),
(43, 22, 'Pour votre sécurité, nous sommes dans l''incapacité de vous restituer votre mot de passe. Un email avec un nouveau mot de passe vous sera envoyé à l''adresse se trouvant dans votre profil. Vous pourrez le modifier par la suite dans la section dédiée.', 1),
(44, 22, 'For your safety we are unable to restore your password. An email with a new password will be sent to the address in your profile. You can change it later in the dedicated section.', 2),
(45, 23, 'Un message a été envoyé dans votre boîte email avec un nouveau mot de passe. Vous pourrez le changer plus tard dans la section spécifique.', 1),
(46, 23, 'A message has sent to your Mailbox with a new Password. You would change this after in the Specific Section.', 2),
(47, 24, 'Controler un maximum de regions dans un temps imparti', 1),
(48, 24, 'Control a maximum of areas within a given time', 2),
(49, 25, 'Les humains sont des créatures curieuses et inventives. Parfait pour l''exploration.', 1),
(50, 25, 'Humans are curious and imaginative creatures. Perfect for exploration.', 2),
(51, 26, 'Les reptiliens sont de valeureux guerriers vivant le plus souvent cachés les rendant très furtifs.', 1),
(52, 26, 'The reptilians are brave warriors living mostly hidden making them very stealthy.', 2),
(53, 27, 'Les Arachnides sont des créatures très violentes et sans pitié. Leur force et leur nom.bre en font leur principal atout', 1),
(54, 27, 'Arachnids are very violent and ruthless creatures. Their strength and nom.bre as their main asset', 2),
(55, 28, 'Votre Quartier Général est le coeur de toute la planète. Cette structure est à l''origine de la création de tous les autres bâtiments. Plus son niveau augmentera plus vous aurez accès à des batiments sofistiqués.', 1),
(56, 28, 'Your headquarters is the core of the planet. This structure is responsible for the creation of all other buildings. Increase over its level the more you will have access to sofistiqués buildings.', 2),
(57, 29, 'L''aviation et l''espace ont un rôle primordial dans la gestion des batailles. Différents Vaisseaux comme le chasseur, le bombardier, ou encore le croiseur vous aideront dans votre quête.', 1),
(58, 29, 'Aviation and space have a key role in managing battles. Different vessels as hunting, bomber, or the cruiser will help you in your quest.', 2),
(59, 30, 'Comme dans tout grand empire, vous aurez besoin de collecter des ressources présentes sur votre planète pour vous développer. Celles-ci vous permettront de rechercher de nouvelles technlogies ou de contruire des batiments ou des unités. ', 1),
(60, 30, 'As in any great empire, you will need to collect resources on your planet you develop. These will help you find new or technlogies contruire of buildings or units.', 2),
(61, 33, 'Le stockage des ressources reste primordial pour le développement constant de votre Empire. Agrandir vos entrepôts permet ainsi de stocker plus de ressources, en bâtissant de vastes réservoirs sur, et au dessous de la surface.', 1),
(62, 33, 'Storage resources is essential for the continued development of your Empire. Expand your storage and can store more resources, building large reservoirs on and below the surface.', 2),
(63, 31, 'Le centre de recherche est indispensable à tout empire qui souhaite dominer la galaxie. L''étude des technologies vous permettra d''améliorer vos productions de ressources, vos unités mais aussi de réduire les coûts ainsi que le temps de construction.', 1),
(64, 31, 'The research center is essential to any empire that wants to dominate the galaxy. The study of technologies will improve your production resources, your units but also reduce costs and construction time.', 2),
(65, 32, 'La nécessité de se protéger est une priorité lors des confrontations majeures de la Galaxie. Vous pourrez contruire et améliorer des tourelles, des domes de protection, et enfin des sattelites pour prévenir les attaques de vos assaillants.', 1),
(66, 32, 'The need for protection is a priority during major confrontations of the Galaxy. You can contruire and improve turrets, domes protection, and finally sattelites to prevent attacks from your assailants.', 2),
(67, 34, 'Fin de partie', 1),
(68, 34, 'End Of Game', 2);

-- --------------------------------------------------------

--
-- Structure de la table `types_ressources`
--

CREATE TABLE IF NOT EXISTS `types_ressources` (
  `tyr_id` int(11) NOT NULL AUTO_INCREMENT,
  `tyr_type` varchar(45) DEFAULT NULL COMMENT 'type de ressources : minerai, organique ou energie',
  `tyr_productionH` int(11) DEFAULT NULL,
  `tyr_max_niv1` int(11) DEFAULT NULL,
  `tyr_cout_res1` int(11) DEFAULT NULL,
  `tyr_cout_res2` int(11) DEFAULT NULL,
  `tyr_cout_res3` int(11) DEFAULT NULL,
  `tyr_tps_nec` int(11) DEFAULT NULL,
  PRIMARY KEY (`tyr_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `types_ressources`
--

INSERT INTO `types_ressources` (`tyr_id`, `tyr_type`, `tyr_productionH`, `tyr_max_niv1`, `tyr_cout_res1`, `tyr_cout_res2`, `tyr_cout_res3`, `tyr_tps_nec`) VALUES
(1, 'ore', 2000, 2000, 1000, 500, 500, 3),
(2, 'organic', 2000, 2000, 500, 1000, 500, 3),
(3, 'energy', 2000, 2000, 500, 500, 1000, 3);

-- --------------------------------------------------------

--
-- Structure de la table `type_batiments`
--

CREATE TABLE IF NOT EXISTS `type_batiments` (
  `tyb_id` int(11) NOT NULL AUTO_INCREMENT,
  `tyb_type` varchar(45) DEFAULT NULL,
  `tyb_elem_a_trad_id` int(11) NOT NULL,
  `tyb_niv_max` int(11) DEFAULT NULL,
  `tyb_cout_ressource1` int(11) DEFAULT NULL,
  `tyb_cout_ressource2` int(11) DEFAULT NULL,
  `tyb_cout_ressource3` int(11) DEFAULT NULL,
  `tyb_temps_necessaire` int(11) DEFAULT '0',
  `tyb_icon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`tyb_id`),
  KEY `fk_type_batiments_elem_a_trad1_idx` (`tyb_elem_a_trad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `type_batiments`
--

INSERT INTO `type_batiments` (`tyb_id`, `tyb_type`, `tyb_elem_a_trad_id`, `tyb_niv_max`, `tyb_cout_ressource1`, `tyb_cout_ressource2`, `tyb_cout_ressource3`, `tyb_temps_necessaire`, `tyb_icon`) VALUES
(1, 'QG', 28, 5, 4000, 4000, 4000, 20, 'qg'),
(2, 'SP', 29, 9, 2000, 800, 1500, 10, 'units'),
(3, 'Res', 30, 15, 500, 500, 500, 6, 'resources'),
(4, 'RC', 31, 3, 15000, 5000, 20000, 15, 'research'),
(5, 'DC', 32, 3, 20000, 5000, 15000, 12, 'defense'),
(6, 'WH', 33, 10, 2000, 2000, 1000, 8, 'warehouse');

-- --------------------------------------------------------

--
-- Structure de la table `unites`
--

CREATE TABLE IF NOT EXISTS `unites` (
  `uni_id` int(11) NOT NULL AUTO_INCREMENT,
  `uni_type` varchar(45) DEFAULT NULL,
  `uni_cout_ressource1` int(11) DEFAULT NULL,
  `uni_cout_ressource2` int(11) DEFAULT NULL,
  `uni_cout_ressource3` int(11) DEFAULT NULL,
  `uni_temps_necessaire` float DEFAULT NULL,
  `uni_vitesse` int(11) DEFAULT NULL,
  `uni_capacite_charge` int(11) DEFAULT NULL,
  `uni_attaque` int(11) DEFAULT NULL,
  `uni_defense` int(11) DEFAULT NULL,
  `uni_life` int(11) DEFAULT NULL,
  `uni_portee` int(11) DEFAULT NULL COMMENT 'portée : unit1 = 1, unit2 = 2, unit3= 3 veut dire que unit3 attaque 2 fois avant que unit1 attaque',
  PRIMARY KEY (`uni_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `unites`
--

INSERT INTO `unites` (`uni_id`, `uni_type`, `uni_cout_ressource1`, `uni_cout_ressource2`, `uni_cout_ressource3`, `uni_temps_necessaire`, `uni_vitesse`, `uni_capacite_charge`, `uni_attaque`, `uni_defense`, `uni_life`, `uni_portee`) VALUES
(1, 'fighter', 1000, 500, 1000, 0.5, 100, 100, 100, 100, 100, 1),
(2, 'bomber', 10000, 5000, 10000, 1, 200, 500, 500, 500, 500, 2),
(3, 'cruiser', 100000, 50000, 100000, 1.5, 400, 2000, 2000, 2000, 2000, 3);

-- --------------------------------------------------------

--
-- Structure de la table `verif_connections`
--

CREATE TABLE IF NOT EXISTS `verif_connections` (
  `vec_id` int(11) NOT NULL AUTO_INCREMENT,
  `vec_joueurs_id` int(11) NOT NULL,
  `vec_connexion` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vec_ip_joueur` varchar(45) DEFAULT NULL,
  `vec_deconnect` timestamp NULL DEFAULT NULL,
  `vec_sess_id` varchar(255) DEFAULT '0',
  PRIMARY KEY (`vec_id`),
  KEY `fk_verif_connections_joueurs1_idx` (`vec_joueurs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=185 ;

--
-- Contenu de la table `verif_connections`
--

INSERT INTO `verif_connections` (`vec_id`, `vec_joueurs_id`, `vec_connexion`, `vec_ip_joueur`, `vec_deconnect`, `vec_sess_id`) VALUES
(77, 21, '2014-03-31 21:06:52', '127.0.0.1', '2014-03-31 21:08:19', '0'),
(78, 21, '2014-03-31 21:07:56', '127.0.0.1', '2014-03-31 21:08:19', '0'),
(79, 21, '2014-03-31 21:09:40', '127.0.0.1', '2014-03-31 21:15:52', '0'),
(80, 21, '2014-03-31 21:13:19', '127.0.0.1', '2014-03-31 21:15:52', '0'),
(81, 21, '2014-03-31 21:15:36', '127.0.0.1', '2014-03-31 21:15:52', '0'),
(82, 21, '2014-03-31 21:39:43', '127.0.0.1', '2014-03-31 21:40:06', '0'),
(83, 21, '2014-03-31 21:40:40', '127.0.0.1', '2014-03-31 21:50:38', '0'),
(84, 21, '2014-03-31 21:50:53', '127.0.0.1', '2014-03-31 23:01:16', '0'),
(85, 21, '2014-03-31 23:01:37', '127.0.0.1', '2014-03-31 23:04:36', '0'),
(86, 21, '2014-03-31 23:04:44', '127.0.0.1', '2014-04-01 00:24:23', '0'),
(87, 21, '2014-04-01 00:24:31', '127.0.0.1', '2014-04-02 09:02:00', '0'),
(88, 21, '2014-04-02 09:02:09', '127.0.0.1', '2014-04-02 17:49:43', '0'),
(89, 21, '2014-04-02 17:49:49', '127.0.0.1', '2014-04-02 17:51:10', '0'),
(90, 21, '2014-04-02 17:53:19', '127.0.0.1', '2014-04-02 17:53:22', '0'),
(91, 21, '2014-04-02 17:55:41', '127.0.0.1', '2014-04-02 20:52:14', '0'),
(92, 21, '2014-04-02 18:46:09', '127.0.0.1', '2014-04-02 20:52:14', '0'),
(93, 21, '2014-04-02 20:52:19', '127.0.0.1', '2014-04-02 21:49:00', '0'),
(94, 21, '2014-04-02 21:49:04', '127.0.0.1', '2014-04-03 12:27:33', '0'),
(95, 21, '2014-04-03 12:26:17', '127.0.0.1', '2014-04-03 12:27:33', '0'),
(96, 21, '2014-04-03 12:27:36', '127.0.0.1', '2014-04-03 22:59:35', '0'),
(97, 22, '2014-04-03 15:48:20', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(98, 22, '2014-04-03 15:51:56', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(99, 21, '2014-04-03 22:30:24', '127.0.0.1', '2014-04-03 22:59:35', '0'),
(100, 22, '2014-04-03 22:32:20', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(101, 21, '2014-04-03 22:59:39', '127.0.0.1', '2014-04-04 12:40:56', '0'),
(102, 22, '2014-04-04 12:28:44', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(103, 21, '2014-04-04 12:41:00', '127.0.0.1', '2014-04-04 12:42:21', '0'),
(104, 22, '2014-04-04 12:42:47', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(105, 21, '2014-04-04 12:43:31', '127.0.0.1', '2014-04-04 13:18:24', '0'),
(106, 21, '2014-04-04 13:18:28', '127.0.0.1', '2014-04-05 00:06:53', '0'),
(107, 22, '2014-04-05 00:05:51', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(108, 21, '2014-04-05 00:06:58', '127.0.0.1', '2014-04-05 00:12:57', '0'),
(109, 22, '2014-04-05 00:12:49', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(110, 21, '2014-04-05 00:13:01', '127.0.0.1', '2014-04-05 00:21:08', '0'),
(111, 23, '2014-04-05 00:19:17', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(112, 21, '2014-04-05 00:21:12', '127.0.0.1', '2014-04-05 00:38:12', '0'),
(113, 22, '2014-04-05 00:21:57', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(114, 21, '2014-04-05 00:38:16', '127.0.0.1', '2014-04-05 00:43:09', '0'),
(115, 21, '2014-04-05 00:43:13', '127.0.0.1', '2014-04-06 12:39:33', '0'),
(116, 21, '2014-04-06 12:39:38', '127.0.0.1', '2014-04-06 15:06:27', '0'),
(117, 21, '2014-04-06 15:06:31', '127.0.0.1', '2014-04-06 15:11:16', '0'),
(118, 21, '2014-04-06 15:11:20', '127.0.0.1', '2014-04-10 12:56:53', '0'),
(119, 21, '2014-04-08 12:35:01', '127.0.0.1', '2014-04-10 12:56:53', '0'),
(120, 21, '2014-04-08 12:36:29', '127.0.0.1', '2014-04-10 12:56:53', '0'),
(121, 21, '2014-04-08 18:17:04', '127.0.0.1', '2014-04-10 12:56:53', '0'),
(122, 22, '2014-04-09 20:56:43', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(123, 21, '2014-04-10 12:57:08', '127.0.0.1', '2014-04-17 17:26:26', '0'),
(124, 22, '2014-04-16 08:54:43', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(125, 22, '2014-04-17 15:19:57', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(126, 22, '2014-04-17 16:06:11', '127.0.0.1', '2014-04-18 09:59:43', '0'),
(127, 21, '2014-04-17 17:25:19', '127.0.0.1', '2014-04-17 17:26:26', '0'),
(128, 21, '2014-04-17 21:22:53', '127.0.0.1', '2014-04-18 14:32:35', '0'),
(129, 21, '2014-04-18 08:22:34', '127.0.0.1', '2014-04-18 14:32:35', '0'),
(130, 23, '2014-04-19 13:57:28', '127.0.0.1', '2014-04-19 17:44:01', '1ee6ukt738e39gjtv41449iip2'),
(131, 22, '2014-04-19 13:57:37', '127.0.0.1', '2014-04-19 17:44:30', '4ekltt7hhmkonn3if2lubp9bf3'),
(132, 21, '2014-04-19 13:57:40', '127.0.0.1', '2014-04-20 12:41:51', 'i79n5k0dbus22h3ars3a155f46'),
(133, 21, '2014-04-20 09:14:29', '127.0.0.1', '2014-04-20 12:41:51', 'n6cnq6eq0hclmshaaiujrr8l93'),
(134, 22, '2014-04-20 09:15:18', '127.0.0.1', '2014-04-20 09:19:23', 'krns445hm3e2n4s41g7huh0bu5'),
(135, 21, '2014-04-20 09:17:56', '127.0.0.1', '2014-04-20 12:41:51', '2j4bpfdufvp6i806sg8kd4s8m4'),
(136, 22, '2014-04-20 09:18:55', '127.0.0.1', '2014-04-20 09:19:23', '4eibhkd14md71obdp0r1cdcou3'),
(137, 23, '2014-04-20 09:22:50', '127.0.0.1', '2014-04-20 11:11:33', '4eibhkd14md71obdp0r1cdcou3'),
(138, 22, '2014-04-20 09:23:21', '127.0.0.1', '2014-04-20 11:28:55', 'ldrp13hj4t4l7g7qci1483inq7'),
(139, 22, '2014-04-20 12:41:53', '127.0.0.1', '2014-04-20 12:41:54', 'ldrp13hj4t4l7g7qci1483inq7'),
(140, 23, '2014-04-20 12:42:07', '127.0.0.1', '2014-04-20 12:42:09', '4eibhkd14md71obdp0r1cdcou3'),
(141, 21, '2014-04-20 12:42:26', '127.0.0.1', '2014-04-20 17:16:14', '2j4bpfdufvp6i806sg8kd4s8m4'),
(142, 23, '2014-04-20 12:49:59', '127.0.0.1', '2014-04-20 17:17:25', '4eibhkd14md71obdp0r1cdcou3'),
(143, 22, '2014-04-20 12:50:07', '127.0.0.1', '2014-04-20 17:16:14', 'ldrp13hj4t4l7g7qci1483inq7'),
(144, 21, '2014-04-20 17:17:27', '127.0.0.1', '2014-04-20 17:17:29', '2j4bpfdufvp6i806sg8kd4s8m4'),
(145, 22, '2014-04-20 17:17:32', '127.0.0.1', '2014-04-20 17:17:34', 'ldrp13hj4t4l7g7qci1483inq7'),
(146, 22, '2014-04-20 17:17:40', '127.0.0.1', '2014-04-20 21:15:06', 'ldrp13hj4t4l7g7qci1483inq7'),
(147, 21, '2014-04-20 17:17:52', '127.0.0.1', '2014-04-20 21:16:15', '2j4bpfdufvp6i806sg8kd4s8m4'),
(148, 23, '2014-04-20 17:17:58', '127.0.0.1', '2014-04-20 21:15:06', '4eibhkd14md71obdp0r1cdcou3'),
(149, 23, '2014-04-20 21:15:26', '127.0.0.1', '2014-04-20 21:15:58', '4eibhkd14md71obdp0r1cdcou3'),
(150, 22, '2014-04-20 21:15:56', '127.0.0.1', '2014-04-20 21:16:00', 'ldrp13hj4t4l7g7qci1483inq7'),
(151, 21, '2014-04-20 21:16:18', '127.0.0.1', '2014-04-20 22:07:40', '2j4bpfdufvp6i806sg8kd4s8m4'),
(152, 22, '2014-04-20 21:16:39', '127.0.0.1', '2014-04-20 22:22:08', 'ldrp13hj4t4l7g7qci1483inq7'),
(153, 23, '2014-04-20 21:16:55', '127.0.0.1', '2014-04-20 22:06:21', '4eibhkd14md71obdp0r1cdcou3'),
(154, 21, '2014-04-20 22:07:57', '127.0.0.1', '2014-04-20 22:07:59', '2j4bpfdufvp6i806sg8kd4s8m4'),
(155, 21, '2014-04-20 22:21:43', '127.0.0.1', '2014-04-20 22:24:57', '2j4bpfdufvp6i806sg8kd4s8m4'),
(156, 21, '2014-04-20 22:25:05', '127.0.0.1', '2014-04-20 22:31:41', '2j4bpfdufvp6i806sg8kd4s8m4'),
(157, 21, '2014-04-20 22:31:43', '127.0.0.1', '2014-04-20 22:35:11', '2j4bpfdufvp6i806sg8kd4s8m4'),
(158, 21, '2014-04-20 22:35:13', '127.0.0.1', '2014-04-20 23:00:36', '2j4bpfdufvp6i806sg8kd4s8m4'),
(159, 22, '2014-04-20 22:37:26', '127.0.0.1', '2014-04-21 17:32:39', '2rffgrh3p9o1u78t74hgc6m6b4'),
(160, 21, '2014-04-20 23:00:39', '127.0.0.1', '2014-04-21 00:46:30', '2j4bpfdufvp6i806sg8kd4s8m4'),
(161, 23, '2014-04-21 00:43:23', '127.0.0.1', '2014-04-21 00:44:13', '2ao1g5kq33k4qpd0ouiljufvd6'),
(162, 21, '2014-04-21 00:46:35', '127.0.0.1', '2014-04-21 00:47:05', '2j4bpfdufvp6i806sg8kd4s8m4'),
(163, 21, '2014-04-21 00:47:07', '127.0.0.1', '2014-04-21 16:21:02', '2j4bpfdufvp6i806sg8kd4s8m4'),
(164, 21, '2014-04-21 16:20:44', '127.0.0.1', '2014-04-21 16:21:02', '0h9s8lddfkm4q7vd6ag97tv3g0'),
(165, 21, '2014-04-21 17:25:36', '127.0.0.1', '2014-04-22 01:31:00', '0h9s8lddfkm4q7vd6ag97tv3g0'),
(166, 22, '2014-04-21 17:32:37', '127.0.0.1', '2014-04-21 17:32:39', '9vapd5ra26bdmt2q9l4dbho0e6'),
(167, 21, '2014-04-23 14:20:00', '127.0.0.1', '2014-04-23 16:43:34', '4qjpjr2fje5s11209h50qs4qr3'),
(168, 22, '2014-04-23 14:29:20', '127.0.0.1', '2014-04-23 18:04:49', '6251f529dt6lgjj8fggv1unm41'),
(169, 21, '2014-04-23 21:54:43', '127.0.0.1', '2014-04-25 16:10:10', 's4u0kn4c61t6djtnmubk085e22'),
(170, 22, '2014-04-23 21:55:16', '127.0.0.1', '2014-04-24 22:52:25', 'lqtghlkja0l5n4pdgk0hob00q2'),
(171, 21, '2014-04-24 22:52:15', '127.0.0.1', '2014-04-25 16:10:10', '20fo07buumh678vr00mqfm7n33'),
(172, 22, '2014-04-24 22:52:44', '127.0.0.1', '2014-04-24 23:09:13', '7b7iafiptgadh5uoe7p9u4onu3'),
(173, 22, '2014-04-24 23:09:25', '127.0.0.1', '2014-04-24 23:17:41', 'p31073iqq5ji9rld26fdld7lq4'),
(174, 23, '2014-04-24 23:17:58', '127.0.0.1', '2014-04-24 23:18:32', 'p31073iqq5ji9rld26fdld7lq4'),
(175, 21, '2014-04-25 08:55:19', '127.0.0.1', '2014-04-25 16:10:10', 'rb0hjh3l0m4hc6v0n92o7skca6'),
(176, 22, '2014-04-25 16:07:57', '127.0.0.1', '2014-04-25 16:34:51', 'um6tudcsmer02vern6futclst4'),
(177, 21, '2014-04-25 16:10:25', '127.0.0.1', '2014-04-26 14:38:30', 'rb0hjh3l0m4hc6v0n92o7skca6'),
(178, 21, '2014-04-26 14:04:04', '127.0.0.1', '2014-04-26 14:38:30', 'tnanlk0mihcp1n4oru8bjt3u67'),
(179, 22, '2014-04-26 14:38:12', '127.0.0.1', '2014-04-27 09:50:15', 'fi86es0gpa04jk0eui8njfult2'),
(180, 21, '2014-04-26 14:40:02', '127.0.0.1', '2014-04-26 15:14:06', 'ae6kkudhl2utk0tmi1gh3qlvp0'),
(181, 21, '2014-04-26 15:48:41', '127.0.0.1', '2014-04-27 09:49:52', '2v62e8c5o7gouq4sj2spcam3p7'),
(182, 21, '2014-04-27 09:49:28', '127.0.0.1', '2014-04-27 09:49:52', '52dkb46r9r8llt1f4umoa42ak1'),
(183, 21, '2014-04-27 09:49:57', '127.0.0.1', NULL, '52dkb46r9r8llt1f4umoa42ak1'),
(184, 22, '2014-04-27 18:41:01', '127.0.0.1', NULL, '6a0rqlrut36pme0r9dvudo4nq0');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `batiments`
--
ALTER TABLE `batiments`
  ADD CONSTRAINT `fk_batiments_joueurs1` FOREIGN KEY (`bat_joueurs_id`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_batiments_type_batiments1` FOREIGN KEY (`bat_type_batiments_id`) REFERENCES `type_batiments` (`tyb_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `bonus_batiment`
--
ALTER TABLE `bonus_batiment`
  ADD CONSTRAINT `fk_bonus_batiment_type_batiments1` FOREIGN KEY (`bob_type_batiments_id`) REFERENCES `type_batiments` (`tyb_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `carte`
--
ALTER TABLE `carte`
  ADD CONSTRAINT `fk_carte_joueurs1` FOREIGN KEY (`car_joueur_id`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carte_parties1` FOREIGN KEY (`car_parties_id`) REFERENCES `parties` (`par_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_chat_joueurs1` FOREIGN KEY (`cha_joueurs_id`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_chat_parties1` FOREIGN KEY (`cha_parties_id`) REFERENCES `parties` (`par_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `connectes`
--
ALTER TABLE `connectes`
  ADD CONSTRAINT `fk_connectes_joueurs1` FOREIGN KEY (`con_joueurs_id`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `creations_unites`
--
ALTER TABLE `creations_unites`
  ADD CONSTRAINT `fk_creations_unites_joueurs1` FOREIGN KEY (`cru_joueurs_id`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_creations_unites_unites1` FOREIGN KEY (`cru_unites_id`) REFERENCES `unites` (`uni_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `debloque_act`
--
ALTER TABLE `debloque_act`
  ADD CONSTRAINT `fk_sp_debloque_bat_type_batiments1` FOREIGN KEY (`dea_type_batiments_id`) REFERENCES `type_batiments` (`tyb_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `deplacements_unites`
--
ALTER TABLE `deplacements_unites`
  ADD CONSTRAINT `fk_deplacements_unites_deplacements1` FOREIGN KEY (`deu_deplacements_id`) REFERENCES `deplacements` (`dep_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_deplacements_unites_parties1` FOREIGN KEY (`deu_parties_id`) REFERENCES `parties` (`par_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_deplacements_unites_teams1` FOREIGN KEY (`deu_teams_id`) REFERENCES `teams` (`tea_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `desc_pages`
--
ALTER TABLE `desc_pages`
  ADD CONSTRAINT `fk_desc_pages_elem_a_trad1` FOREIGN KEY (`dep_elem_a_trad_id`) REFERENCES `elem_a_trad` (`eat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_desc_pages_pages1` FOREIGN KEY (`dep_pages_id`) REFERENCES `pages` (`pag_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `dictionnaire`
--
ALTER TABLE `dictionnaire`
  ADD CONSTRAINT `fk_dictionnaire_langues1` FOREIGN KEY (`dic_langues_id`) REFERENCES `langues` (`lan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `joueurs`
--
ALTER TABLE `joueurs`
  ADD CONSTRAINT `fk_joueurs_langues1` FOREIGN KEY (`jou_langues_id`) REFERENCES `langues` (`lan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_joueurs_parties1` FOREIGN KEY (`jou_parties_id`) REFERENCES `parties` (`par_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_joueurs_races1` FOREIGN KEY (`jou_races_id`) REFERENCES `races` (`rac_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `fk_pages_elem_a_trad1` FOREIGN KEY (`pag_elem_a_trad_id`) REFERENCES `elem_a_trad` (`eat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `races`
--
ALTER TABLE `races`
  ADD CONSTRAINT `fk_races_elem_a_trad1` FOREIGN KEY (`rac_elem_a_trad_id`) REFERENCES `elem_a_trad` (`eat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `rapports`
--
ALTER TABLE `rapports`
  ADD CONSTRAINT `fk_rapports_joueurs1` FOREIGN KEY (`rap_joueurs_id_att`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rapports_joueurs2` FOREIGN KEY (`rap_joueurs_id_def`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `ressources`
--
ALTER TABLE `ressources`
  ADD CONSTRAINT `fk_ressources_joueurs1` FOREIGN KEY (`res_joueurs_id`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ressources_types_ressources1` FOREIGN KEY (`res_types_ressources_id`) REFERENCES `types_ressources` (`tyr_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `resultats_parties`
--
ALTER TABLE `resultats_parties`
  ADD CONSTRAINT `fk_resultats_parties_joueurs1` FOREIGN KEY (`rep_joueurs_id`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_resultats_parties_parties1` FOREIGN KEY (`rep_parties_id`) REFERENCES `parties` (`par_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `teams`
--
ALTER TABLE `teams`
  ADD CONSTRAINT `fk_teams_joueurs1` FOREIGN KEY (`tea_joueurs_id`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `total_units`
--
ALTER TABLE `total_units`
  ADD CONSTRAINT `fk_total_units_joueurs1` FOREIGN KEY (`tou_joueurs_id`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `traductions`
--
ALTER TABLE `traductions`
  ADD CONSTRAINT `fk_traductions_elem_a_trad1` FOREIGN KEY (`tra_elem_a_trad_id`) REFERENCES `elem_a_trad` (`eat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_traductions_langues1` FOREIGN KEY (`tra_langues_id`) REFERENCES `langues` (`lan_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `type_batiments`
--
ALTER TABLE `type_batiments`
  ADD CONSTRAINT `fk_type_batiments_elem_a_trad1` FOREIGN KEY (`tyb_elem_a_trad_id`) REFERENCES `elem_a_trad` (`eat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `verif_connections`
--
ALTER TABLE `verif_connections`
  ADD CONSTRAINT `fk_verif_connections_joueurs1` FOREIGN KEY (`vec_joueurs_id`) REFERENCES `joueurs` (`jou_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
