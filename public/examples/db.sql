-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Lun 27 Janvier 2014 à 14:42
-- Version du serveur: 5.5.33
-- Version de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `sgap`
--

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

DROP TABLE IF EXISTS `inscriptions`;
CREATE TABLE IF NOT EXISTS `inscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eleve_id` int(11) NOT NULL,
  `accompagnement_id` int(11) NOT NULL,
  `commentaire` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `eleve_id_2` (`eleve_id`,`accompagnement_id`),
  KEY `eleve_id` (`eleve_id`),
  KEY `accompagnement_id` (`accompagnement_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- Contenu de la table `inscriptions`
--

INSERT INTO `inscriptions` (`id`, `eleve_id`, `accompagnement_id`, `commentaire`, `timestamp`) VALUES
(15, 4, 34, '', '0000-00-00 00:00:00'),
(14, 1, 34, '', '0000-00-00 00:00:00'),
(16, 4, 40, 'boo', '0000-00-00 00:00:00'),
(17, 4, 41, 'Bavarde trop avec ses camarades !', '0000-00-00 00:00:00'),
(18, 1, 42, 'Foo sait maintenant tenir un ballon', '0000-00-00 00:00:00'),
(19, 1, 41, 'Bavarde trop avec ses camarades !', '0000-00-00 00:00:00'),
(20, 1, 39, 'Bravo foo !', '0000-00-00 00:00:00'),
(21, 1, 40, '', '0000-00-00 00:00:00'),
(22, 89, 42, 'chante', '0000-00-00 00:00:00'),
(23, 89, 43, '', '0000-00-00 00:00:00'),
(25, 90, 43, 'jkjk', '0000-00-00 00:00:00'),
(45, 78, 39, '', '0000-00-00 00:00:00'),
(27, 1, 46, 'mais foo aime cela...', '0000-00-00 00:00:00'),
(28, 1, 44, '', '0000-00-00 00:00:00'),
(44, 78, 45, '', '0000-00-00 00:00:00'),
(29, 4, 42, '', '0000-00-00 00:00:00'),
(30, 61, 42, '', '0000-00-00 00:00:00'),
(31, 7, 46, '', '0000-00-00 00:00:00'),
(32, 16, 46, '', '0000-00-00 00:00:00'),
(33, 43, 46, '', '0000-00-00 00:00:00'),
(34, 45, 46, '', '0000-00-00 00:00:00'),
(35, 59, 46, '', '0000-00-00 00:00:00'),
(36, 78, 46, '', '0000-00-00 00:00:00'),
(37, 41, 42, '', '0000-00-00 00:00:00'),
(38, 42, 42, '', '0000-00-00 00:00:00'),
(39, 63, 42, '', '0000-00-00 00:00:00');
