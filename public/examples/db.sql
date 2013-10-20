-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Dim 20 Octobre 2013 à 23:39
-- Version du serveur: 5.1.44
-- Version de PHP: 5.3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Base de données: `sgap`
--

-- --------------------------------------------------------

--
-- Structure de la table `accompagnement`
--

DROP TABLE IF EXISTS `accompagnement`;
CREATE TABLE IF NOT EXISTS `accompagnement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matiere_id` int(11) NOT NULL,
  `cycle_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `accompagnement`
--


-- --------------------------------------------------------

--
-- Structure de la table `commentaire`
--

DROP TABLE IF EXISTS `commentaire`;
CREATE TABLE IF NOT EXISTS `commentaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accompagnement_id` int(11) NOT NULL,
  `eleve_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `commentaire`
--


-- --------------------------------------------------------

--
-- Structure de la table `commentaireGeneral`
--

DROP TABLE IF EXISTS `commentaireGeneral`;
CREATE TABLE IF NOT EXISTS `commentaireGeneral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accompagnement_id` int(11) NOT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `commentaireGeneral`
--


-- --------------------------------------------------------

--
-- Structure de la table `cycles`
--

DROP TABLE IF EXISTS `cycles`;
CREATE TABLE IF NOT EXISTS `cycles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `debut` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `dates` text COLLATE utf8_unicode_ci,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `debut` (`debut`),
  UNIQUE KEY `debut_2` (`debut`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=96 ;

--
-- Contenu de la table `cycles`
--

INSERT INTO `cycles` VALUES(2, '02/03/2013', 'a:8:{i:0;s:10:"02/03/2013";i:1;s:10:"05/03/2014";i:2;s:10:"18/05/2013";i:3;s:10:"24/09/2014";i:4;s:10:"01/01/2013";i:5;s:10:"23/12/2013";i:6;s:10:"06/02/2013";i:7;s:10:"30/11/2013";}', 1);
INSERT INTO `cycles` VALUES(3, '01/08/2013', 'a:8:{i:0;s:10:"01/08/2013";i:1;s:10:"12/08/2013";i:2;s:10:"17/12/2012";i:3;s:10:"15/10/2014";i:4;s:10:"07/02/2014";i:5;s:10:"31/01/2014";i:6;s:10:"30/01/2013";i:7;s:10:"13/03/2014";}', 1);
INSERT INTO `cycles` VALUES(4, '20/04/2013', 'a:8:{i:0;s:10:"20/04/2013";i:1;s:10:"18/04/2013";i:2;s:10:"25/05/2013";i:3;s:10:"05/06/2013";i:4;s:10:"14/04/2014";i:5;s:10:"22/04/2014";i:6;s:10:"22/12/2013";i:7;s:10:"24/10/2013";}', 1);
INSERT INTO `cycles` VALUES(5, '01/03/2014', 'a:8:{i:0;s:10:"01/03/2014";i:1;s:10:"10/11/2013";i:2;s:10:"13/11/2012";i:3;s:10:"31/03/2014";i:4;s:10:"21/05/2013";i:5;s:10:"23/02/2014";i:6;s:10:"09/12/2013";i:7;s:10:"26/05/2013";}', 1);
INSERT INTO `cycles` VALUES(6, '22/12/2012', 'a:8:{i:0;s:10:"22/12/2012";i:1;s:10:"26/10/2012";i:2;s:10:"28/12/2013";i:3;s:10:"16/05/2014";i:4;s:10:"12/03/2014";i:5;s:10:"26/09/2014";i:6;s:10:"18/07/2014";i:7;s:10:"06/01/2013";}', 1);
INSERT INTO `cycles` VALUES(7, '10/06/2013', 'a:8:{i:0;s:10:"10/06/2013";i:1;s:10:"12/07/2013";i:2;s:10:"08/01/2014";i:3;s:10:"11/10/2013";i:4;s:10:"06/05/2014";i:5;s:10:"26/09/2013";i:6;s:10:"13/10/2013";i:7;s:10:"13/12/2012";}', 1);
INSERT INTO `cycles` VALUES(8, '21/07/2013', 'a:8:{i:0;s:10:"21/07/2013";i:1;s:10:"08/07/2014";i:2;s:10:"18/02/2014";i:3;s:10:"05/06/2013";i:4;s:10:"07/10/2013";i:5;s:10:"06/09/2014";i:6;s:10:"06/12/2013";i:7;s:10:"06/12/2013";}', 1);
INSERT INTO `cycles` VALUES(9, '11/09/2014', 'a:8:{i:0;s:10:"11/09/2014";i:1;s:10:"01/04/2014";i:2;s:10:"24/02/2013";i:3;s:10:"10/03/2014";i:4;s:10:"08/01/2014";i:5;s:10:"29/07/2014";i:6;s:10:"19/12/2013";i:7;s:10:"10/04/2014";}', 1);
INSERT INTO `cycles` VALUES(10, '21/05/2013', 'a:8:{i:0;s:10:"21/05/2013";i:1;s:10:"28/09/2014";i:2;s:10:"26/11/2012";i:3;s:10:"26/08/2013";i:4;s:10:"06/04/2014";i:5;s:10:"13/05/2014";i:6;s:10:"03/04/2014";i:7;s:10:"09/10/2014";}', 1);
INSERT INTO `cycles` VALUES(11, '18/02/2013', 'a:8:{i:0;s:10:"18/02/2013";i:1;s:10:"28/07/2014";i:2;s:10:"11/09/2013";i:3;s:10:"31/05/2013";i:4;s:10:"08/01/2013";i:5;s:10:"07/07/2013";i:6;s:10:"27/10/2013";i:7;s:10:"11/12/2012";}', 1);
INSERT INTO `cycles` VALUES(12, '16/01/2014', 'a:8:{i:0;s:10:"16/01/2014";i:1;s:10:"24/10/2012";i:2;s:10:"26/11/2012";i:3;s:10:"10/07/2014";i:4;s:10:"19/07/2013";i:5;s:10:"30/05/2014";i:6;s:10:"19/08/2013";i:7;s:10:"24/01/2014";}', 1);
INSERT INTO `cycles` VALUES(13, '05/11/2013', 'a:8:{i:0;s:10:"05/11/2013";i:1;s:10:"05/06/2013";i:2;s:10:"14/06/2014";i:3;s:10:"03/08/2014";i:4;s:10:"10/04/2013";i:5;s:10:"23/07/2013";i:6;s:10:"06/03/2014";i:7;s:10:"27/11/2013";}', 1);
INSERT INTO `cycles` VALUES(14, '28/06/2014', 'a:8:{i:0;s:10:"28/06/2014";i:1;s:10:"11/06/2013";i:2;s:10:"22/04/2014";i:3;s:10:"23/01/2014";i:4;s:10:"12/10/2013";i:5;s:10:"15/03/2013";i:6;s:10:"30/03/2014";i:7;s:10:"02/12/2012";}', 1);
INSERT INTO `cycles` VALUES(15, '26/07/2013', 'a:8:{i:0;s:10:"26/07/2013";i:1;s:10:"27/07/2013";i:2;s:10:"18/12/2013";i:3;s:10:"03/08/2013";i:4;s:10:"08/07/2014";i:5;s:10:"12/05/2014";i:6;s:10:"15/10/2014";i:7;s:10:"27/04/2013";}', 1);
INSERT INTO `cycles` VALUES(16, '22/09/2013', 'a:8:{i:0;s:10:"22/09/2013";i:1;s:10:"15/01/2013";i:2;s:10:"17/11/2013";i:3;s:10:"18/05/2014";i:4;s:10:"28/02/2013";i:5;s:10:"10/07/2014";i:6;s:10:"30/06/2013";i:7;s:10:"16/08/2014";}', 1);
INSERT INTO `cycles` VALUES(17, '15/09/2014', 'a:8:{i:0;s:10:"15/09/2014";i:1;s:10:"20/06/2013";i:2;s:10:"21/01/2014";i:3;s:10:"05/04/2014";i:4;s:10:"11/04/2013";i:5;s:10:"08/10/2013";i:6;s:10:"31/10/2012";i:7;s:10:"13/06/2013";}', 1);
INSERT INTO `cycles` VALUES(18, '20/11/2013', 'a:8:{i:0;s:10:"20/11/2013";i:1;s:10:"15/11/2012";i:2;s:10:"24/02/2014";i:3;s:10:"23/08/2014";i:4;s:10:"01/09/2014";i:5;s:10:"01/07/2013";i:6;s:10:"25/06/2013";i:7;s:10:"11/08/2013";}', 1);
INSERT INTO `cycles` VALUES(19, '03/04/2014', 'a:8:{i:0;s:10:"03/04/2014";i:1;s:10:"25/11/2012";i:2;s:10:"04/02/2014";i:3;s:10:"21/09/2014";i:4;s:10:"13/04/2013";i:5;s:10:"07/11/2012";i:6;s:10:"11/05/2014";i:7;s:10:"26/12/2013";}', 1);
INSERT INTO `cycles` VALUES(20, '07/01/2014', 'a:8:{i:0;s:10:"07/01/2014";i:1;s:10:"01/08/2013";i:2;s:10:"18/05/2013";i:3;s:10:"28/10/2012";i:4;s:10:"01/03/2013";i:5;s:10:"05/11/2013";i:6;s:10:"18/01/2014";i:7;s:10:"02/02/2013";}', 1);
INSERT INTO `cycles` VALUES(21, '05/05/2014', 'a:8:{i:0;s:10:"05/05/2014";i:1;s:10:"15/02/2013";i:2;s:10:"05/06/2014";i:3;s:10:"13/03/2013";i:4;s:10:"24/07/2014";i:5;s:10:"09/04/2013";i:6;s:10:"13/10/2014";i:7;s:10:"26/04/2014";}', 1);
INSERT INTO `cycles` VALUES(22, '02/01/2013', 'a:8:{i:0;s:10:"02/01/2013";i:1;s:10:"19/12/2012";i:2;s:10:"24/02/2013";i:3;s:10:"02/07/2013";i:4;s:10:"26/09/2014";i:5;s:10:"29/09/2013";i:6;s:10:"06/11/2012";i:7;s:10:"20/10/2013";}', 1);
INSERT INTO `cycles` VALUES(23, '22/07/2014', 'a:8:{i:0;s:10:"22/07/2014";i:1;s:10:"13/02/2013";i:2;s:10:"12/08/2014";i:3;s:10:"27/02/2013";i:4;s:10:"13/06/2013";i:5;s:10:"15/06/2013";i:6;s:10:"26/01/2014";i:7;s:10:"16/12/2013";}', 1);
INSERT INTO `cycles` VALUES(24, '08/06/2014', 'a:8:{i:0;s:10:"08/06/2014";i:1;s:10:"04/11/2013";i:2;s:10:"22/10/2012";i:3;s:10:"08/03/2013";i:4;s:10:"13/10/2013";i:5;s:10:"24/06/2014";i:6;s:10:"24/09/2014";i:7;s:10:"23/03/2013";}', 1);
INSERT INTO `cycles` VALUES(25, '20/12/2013', 'a:8:{i:0;s:10:"20/12/2013";i:1;s:10:"07/08/2013";i:2;s:10:"09/11/2013";i:3;s:10:"07/01/2014";i:4;s:10:"07/08/2014";i:5;s:10:"28/07/2014";i:6;s:10:"01/09/2013";i:7;s:10:"11/05/2014";}', 1);
INSERT INTO `cycles` VALUES(26, '19/08/2013', 'a:8:{i:0;s:10:"19/08/2013";i:1;s:10:"07/04/2013";i:2;s:10:"14/04/2014";i:3;s:10:"13/10/2013";i:4;s:10:"03/01/2014";i:5;s:10:"17/01/2014";i:6;s:10:"19/02/2014";i:7;s:10:"05/11/2012";}', 1);
INSERT INTO `cycles` VALUES(27, '04/09/2013', 'a:8:{i:0;s:10:"04/09/2013";i:1;s:10:"26/11/2012";i:2;s:10:"24/05/2013";i:3;s:10:"23/03/2014";i:4;s:10:"09/06/2013";i:5;s:10:"06/02/2014";i:6;s:10:"04/07/2014";i:7;s:10:"16/04/2013";}', 1);
INSERT INTO `cycles` VALUES(28, '04/12/2013', 'a:8:{i:0;s:10:"04/12/2013";i:1;s:10:"15/10/2013";i:2;s:10:"24/08/2013";i:3;s:10:"16/04/2014";i:4;s:10:"15/07/2014";i:5;s:10:"01/04/2013";i:6;s:10:"21/12/2012";i:7;s:10:"17/03/2014";}', 1);
INSERT INTO `cycles` VALUES(29, '26/03/2014', 'a:8:{i:0;s:10:"26/03/2014";i:1;s:10:"05/06/2014";i:2;s:10:"12/12/2013";i:3;s:10:"30/07/2013";i:4;s:10:"20/02/2013";i:5;s:10:"05/10/2014";i:6;s:10:"09/04/2013";i:7;s:10:"30/11/2013";}', 1);
INSERT INTO `cycles` VALUES(30, '31/08/2014', 'a:8:{i:0;s:10:"31/08/2014";i:1;s:10:"19/09/2013";i:2;s:10:"09/11/2013";i:3;s:10:"28/08/2014";i:4;s:10:"27/02/2014";i:5;s:10:"10/01/2013";i:6;s:10:"09/10/2014";i:7;s:10:"08/06/2014";}', 1);
INSERT INTO `cycles` VALUES(31, '09/10/2013', 'a:8:{i:0;s:10:"09/10/2013";i:1;s:10:"30/03/2014";i:2;s:10:"20/09/2014";i:3;s:10:"10/11/2013";i:4;s:10:"19/01/2014";i:5;s:10:"05/04/2013";i:6;s:10:"25/09/2013";i:7;s:10:"17/02/2013";}', 1);
INSERT INTO `cycles` VALUES(32, '04/03/2013', 'a:8:{i:0;s:10:"04/03/2013";i:1;s:10:"11/04/2014";i:2;s:10:"15/02/2014";i:3;s:10:"18/12/2012";i:4;s:10:"25/09/2013";i:5;s:10:"29/01/2013";i:6;s:10:"02/05/2014";i:7;s:10:"14/12/2013";}', 1);
INSERT INTO `cycles` VALUES(33, '13/07/2014', 'a:8:{i:0;s:10:"13/07/2014";i:1;s:10:"20/08/2014";i:2;s:10:"21/05/2013";i:3;s:10:"10/03/2013";i:4;s:10:"06/11/2012";i:5;s:10:"25/03/2013";i:6;s:10:"17/10/2012";i:7;s:10:"06/01/2014";}', 1);
INSERT INTO `cycles` VALUES(34, '22/05/2014', 'a:8:{i:0;s:10:"22/05/2014";i:1;s:10:"16/09/2013";i:2;s:10:"27/01/2013";i:3;s:10:"31/03/2014";i:4;s:10:"08/06/2013";i:5;s:10:"26/02/2013";i:6;s:10:"03/03/2013";i:7;s:10:"01/11/2013";}', 1);
INSERT INTO `cycles` VALUES(35, '20/07/2014', 'a:8:{i:0;s:10:"20/07/2014";i:1;s:10:"20/11/2013";i:2;s:10:"29/04/2013";i:3;s:10:"28/09/2014";i:4;s:10:"04/07/2013";i:5;s:10:"21/12/2012";i:6;s:10:"18/09/2013";i:7;s:10:"20/02/2014";}', 1);
INSERT INTO `cycles` VALUES(36, '18/01/2014', 'a:8:{i:0;s:10:"18/01/2014";i:1;s:10:"17/10/2013";i:2;s:10:"10/04/2014";i:3;s:10:"11/09/2013";i:4;s:10:"30/04/2013";i:5;s:10:"30/06/2013";i:6;s:10:"25/08/2014";i:7;s:10:"17/01/2013";}', 1);
INSERT INTO `cycles` VALUES(37, '16/08/2013', 'a:8:{i:0;s:10:"16/08/2013";i:1;s:10:"20/01/2013";i:2;s:10:"10/05/2013";i:3;s:10:"30/01/2013";i:4;s:10:"03/09/2014";i:5;s:10:"28/09/2013";i:6;s:10:"25/06/2014";i:7;s:10:"20/01/2013";}', 1);
INSERT INTO `cycles` VALUES(38, '31/12/2013', 'a:8:{i:0;s:10:"31/12/2013";i:1;s:10:"23/12/2013";i:2;s:10:"12/01/2014";i:3;s:10:"19/11/2013";i:4;s:10:"26/07/2014";i:5;s:10:"28/07/2014";i:6;s:10:"30/11/2013";i:7;s:10:"11/02/2014";}', 1);
INSERT INTO `cycles` VALUES(39, '06/05/2013', 'a:8:{i:0;s:10:"06/05/2013";i:1;s:10:"18/09/2014";i:2;s:10:"30/08/2014";i:3;s:10:"03/11/2013";i:4;s:10:"15/12/2013";i:5;s:10:"02/06/2013";i:6;s:10:"11/07/2014";i:7;s:10:"13/07/2014";}', 1);
INSERT INTO `cycles` VALUES(40, '07/07/2013', 'a:8:{i:0;s:10:"07/07/2013";i:1;s:10:"15/07/2014";i:2;s:10:"19/12/2013";i:3;s:10:"04/10/2013";i:4;s:10:"11/07/2013";i:5;s:10:"23/08/2014";i:6;s:10:"15/05/2014";i:7;s:10:"04/02/2013";}', 1);
INSERT INTO `cycles` VALUES(41, '21/09/2014', 'a:8:{i:0;s:10:"21/09/2014";i:1;s:10:"25/05/2014";i:2;s:10:"17/12/2013";i:3;s:10:"21/04/2014";i:4;s:10:"06/02/2013";i:5;s:10:"22/08/2014";i:6;s:10:"28/09/2014";i:7;s:10:"08/12/2013";}', 1);
INSERT INTO `cycles` VALUES(42, '03/04/2013', 'a:8:{i:0;s:10:"03/04/2013";i:1;s:10:"20/04/2014";i:2;s:10:"27/07/2013";i:3;s:10:"28/12/2013";i:4;s:10:"14/04/2013";i:5;s:10:"24/06/2014";i:6;s:10:"17/07/2013";i:7;s:10:"02/10/2014";}', 1);
INSERT INTO `cycles` VALUES(43, '13/03/2014', 'a:8:{i:0;s:10:"13/03/2014";i:1;s:10:"12/08/2013";i:2;s:10:"30/03/2013";i:3;s:10:"13/12/2013";i:4;s:10:"02/03/2014";i:5;s:10:"17/04/2014";i:6;s:10:"21/07/2013";i:7;s:10:"09/02/2013";}', 1);
INSERT INTO `cycles` VALUES(44, '10/10/2013', 'a:8:{i:0;s:10:"10/10/2013";i:1;s:10:"09/12/2012";i:2;s:10:"03/01/2013";i:3;s:10:"16/08/2014";i:4;s:10:"20/05/2014";i:5;s:10:"08/02/2014";i:6;s:10:"14/05/2013";i:7;s:10:"27/09/2013";}', 1);
INSERT INTO `cycles` VALUES(45, '28/12/2013', 'a:8:{i:0;s:10:"28/12/2013";i:1;s:10:"31/01/2014";i:2;s:10:"14/10/2014";i:3;s:10:"05/11/2013";i:4;s:10:"25/01/2014";i:5;s:10:"22/03/2014";i:6;s:10:"17/06/2013";i:7;s:10:"07/10/2014";}', 1);
INSERT INTO `cycles` VALUES(46, '30/10/2012', 'a:8:{i:0;s:10:"30/10/2012";i:1;s:10:"16/03/2013";i:2;s:10:"03/12/2013";i:3;s:10:"24/05/2013";i:4;s:10:"30/10/2013";i:5;s:10:"06/05/2013";i:6;s:10:"01/09/2014";i:7;s:10:"26/06/2014";}', 1);
INSERT INTO `cycles` VALUES(47, '13/01/2014', 'a:8:{i:0;s:10:"13/01/2014";i:1;s:10:"27/09/2014";i:2;s:10:"11/02/2013";i:3;s:10:"04/12/2013";i:4;s:10:"02/04/2013";i:5;s:10:"08/03/2014";i:6;s:10:"19/08/2013";i:7;s:10:"07/01/2014";}', 1);
INSERT INTO `cycles` VALUES(48, '08/04/2013', 'a:8:{i:0;s:10:"08/04/2013";i:1;s:10:"09/05/2013";i:2;s:10:"19/02/2014";i:3;s:10:"10/09/2013";i:4;s:10:"17/08/2014";i:5;s:10:"14/09/2014";i:6;s:10:"03/05/2013";i:7;s:10:"12/11/2012";}', 1);
INSERT INTO `cycles` VALUES(49, '24/09/2014', 'a:8:{i:0;s:10:"24/09/2014";i:1;s:10:"25/08/2014";i:2;s:10:"27/06/2014";i:3;s:10:"01/05/2014";i:4;s:10:"16/02/2014";i:5;s:10:"27/08/2014";i:6;s:10:"13/10/2013";i:7;s:10:"25/05/2014";}', 1);
INSERT INTO `cycles` VALUES(50, '22/02/2013', 'a:8:{i:0;s:10:"22/02/2013";i:1;s:10:"11/07/2013";i:2;s:10:"23/09/2013";i:3;s:10:"07/07/2014";i:4;s:10:"29/05/2014";i:5;s:10:"14/06/2014";i:6;s:10:"15/01/2014";i:7;s:10:"28/05/2013";}', 1);
INSERT INTO `cycles` VALUES(51, '15/01/2013', 'a:8:{i:0;s:10:"15/01/2013";i:1;s:10:"03/10/2013";i:2;s:10:"18/01/2013";i:3;s:10:"04/11/2013";i:4;s:10:"07/08/2013";i:5;s:10:"31/07/2014";i:6;s:10:"21/03/2013";i:7;s:10:"26/08/2014";}', 1);
INSERT INTO `cycles` VALUES(52, '23/11/2012', 'a:8:{i:0;s:10:"23/11/2012";i:1;s:10:"06/02/2014";i:2;s:10:"16/02/2014";i:3;s:10:"23/07/2014";i:4;s:10:"17/03/2014";i:5;s:10:"10/09/2014";i:6;s:10:"06/06/2013";i:7;s:10:"12/06/2014";}', 1);
INSERT INTO `cycles` VALUES(53, '29/08/2014', 'a:8:{i:0;s:10:"29/08/2014";i:1;s:10:"19/02/2014";i:2;s:10:"15/09/2014";i:3;s:10:"26/03/2013";i:4;s:10:"14/12/2012";i:5;s:10:"18/05/2014";i:6;s:10:"05/05/2014";i:7;s:10:"18/01/2014";}', 1);
INSERT INTO `cycles` VALUES(54, '11/08/2014', 'a:8:{i:0;s:10:"11/08/2014";i:1;s:10:"02/11/2012";i:2;s:10:"19/04/2013";i:3;s:10:"09/06/2013";i:4;s:10:"20/04/2014";i:5;s:10:"13/11/2013";i:6;s:10:"04/11/2013";i:7;s:10:"31/12/2013";}', 1);
INSERT INTO `cycles` VALUES(55, '05/06/2014', 'a:8:{i:0;s:10:"05/06/2014";i:1;s:10:"05/02/2014";i:2;s:10:"26/09/2014";i:3;s:10:"07/11/2012";i:4;s:10:"02/06/2013";i:5;s:10:"12/12/2012";i:6;s:10:"20/03/2014";i:7;s:10:"02/01/2013";}', 1);
INSERT INTO `cycles` VALUES(56, '08/11/2012', 'a:8:{i:0;s:10:"08/11/2012";i:1;s:10:"05/12/2012";i:2;s:10:"15/11/2013";i:3;s:10:"27/06/2013";i:4;s:10:"09/06/2014";i:5;s:10:"03/07/2013";i:6;s:10:"10/02/2014";i:7;s:10:"04/07/2014";}', 1);
INSERT INTO `cycles` VALUES(57, '06/07/2013', 'a:8:{i:0;s:10:"06/07/2013";i:1;s:10:"28/08/2013";i:2;s:10:"28/12/2012";i:3;s:10:"19/12/2013";i:4;s:10:"18/04/2013";i:5;s:10:"10/02/2013";i:6;s:10:"15/09/2013";i:7;s:10:"03/05/2014";}', 1);
INSERT INTO `cycles` VALUES(58, '25/10/2012', 'a:8:{i:0;s:10:"25/10/2012";i:1;s:10:"28/07/2014";i:2;s:10:"27/05/2013";i:3;s:10:"23/08/2013";i:4;s:10:"25/06/2014";i:5;s:10:"03/09/2014";i:6;s:10:"18/04/2013";i:7;s:10:"28/11/2012";}', 1);
INSERT INTO `cycles` VALUES(59, '23/06/2013', 'a:8:{i:0;s:10:"23/06/2013";i:1;s:10:"17/05/2014";i:2;s:10:"02/09/2014";i:3;s:10:"23/09/2013";i:4;s:10:"05/09/2013";i:5;s:10:"01/06/2014";i:6;s:10:"22/05/2014";i:7;s:10:"26/10/2013";}', 1);
INSERT INTO `cycles` VALUES(60, '17/03/2013', 'a:8:{i:0;s:10:"17/03/2013";i:1;s:10:"27/09/2014";i:2;s:10:"12/04/2014";i:3;s:10:"11/08/2013";i:4;s:10:"06/03/2013";i:5;s:10:"24/03/2014";i:6;s:10:"12/10/2013";i:7;s:10:"27/12/2012";}', 1);
INSERT INTO `cycles` VALUES(61, '08/12/2012', 'a:8:{i:0;s:10:"08/12/2012";i:1;s:10:"20/08/2013";i:2;s:10:"18/01/2013";i:3;s:10:"22/08/2013";i:4;s:10:"08/05/2013";i:5;s:10:"04/12/2013";i:6;s:10:"05/09/2013";i:7;s:10:"22/12/2013";}', 1);
INSERT INTO `cycles` VALUES(62, '11/12/2012', 'a:8:{i:0;s:10:"11/12/2012";i:1;s:10:"12/12/2012";i:2;s:10:"15/04/2014";i:3;s:10:"04/02/2014";i:4;s:10:"17/01/2013";i:5;s:10:"08/10/2013";i:6;s:10:"27/02/2013";i:7;s:10:"13/07/2013";}', 1);
INSERT INTO `cycles` VALUES(63, '01/10/2014', 'a:8:{i:0;s:10:"01/10/2014";i:1;s:10:"23/10/2012";i:2;s:10:"17/08/2014";i:3;s:10:"23/03/2014";i:4;s:10:"25/07/2014";i:5;s:10:"27/07/2014";i:6;s:10:"12/12/2012";i:7;s:10:"16/10/2014";}', 1);
INSERT INTO `cycles` VALUES(64, '25/09/2013', 'a:8:{i:0;s:10:"25/09/2013";i:1;s:10:"19/12/2013";i:2;s:10:"19/11/2012";i:3;s:10:"04/09/2013";i:4;s:10:"30/09/2014";i:5;s:10:"24/05/2014";i:6;s:10:"16/11/2013";i:7;s:10:"14/07/2014";}', 1);
INSERT INTO `cycles` VALUES(65, '26/08/2013', 'a:8:{i:0;s:10:"26/08/2013";i:1;s:10:"22/03/2013";i:2;s:10:"27/10/2013";i:3;s:10:"19/06/2013";i:4;s:10:"04/09/2014";i:5;s:10:"15/09/2014";i:6;s:10:"08/08/2014";i:7;s:10:"12/10/2014";}', 1);
INSERT INTO `cycles` VALUES(66, '12/02/2014', 'a:8:{i:0;s:10:"12/02/2014";i:1;s:10:"26/08/2013";i:2;s:10:"14/11/2012";i:3;s:10:"31/08/2013";i:4;s:10:"27/08/2013";i:5;s:10:"30/12/2013";i:6;s:10:"26/09/2013";i:7;s:10:"15/06/2013";}', 1);
INSERT INTO `cycles` VALUES(67, '28/04/2014', 'a:8:{i:0;s:10:"28/04/2014";i:1;s:10:"13/12/2013";i:2;s:10:"06/03/2013";i:3;s:10:"28/10/2012";i:4;s:10:"09/05/2014";i:5;s:10:"09/10/2014";i:6;s:10:"03/11/2012";i:7;s:10:"13/01/2014";}', 1);
INSERT INTO `cycles` VALUES(68, '13/10/2014', 'a:8:{i:0;s:10:"13/10/2014";i:1;s:10:"26/06/2013";i:2;s:10:"27/05/2013";i:3;s:10:"20/08/2013";i:4;s:10:"10/06/2013";i:5;s:10:"05/04/2014";i:6;s:10:"19/09/2013";i:7;s:10:"18/05/2014";}', 1);
INSERT INTO `cycles` VALUES(69, '20/05/2014', 'a:8:{i:0;s:10:"20/05/2014";i:1;s:10:"16/07/2014";i:2;s:10:"03/05/2013";i:3;s:10:"17/04/2013";i:4;s:10:"17/06/2013";i:5;s:10:"06/09/2013";i:6;s:10:"13/06/2014";i:7;s:10:"07/07/2014";}', 1);
INSERT INTO `cycles` VALUES(70, '09/04/2013', 'a:8:{i:0;s:10:"09/04/2013";i:1;s:10:"12/10/2013";i:2;s:10:"19/08/2013";i:3;s:10:"20/10/2012";i:4;s:10:"29/08/2014";i:5;s:10:"14/11/2013";i:6;s:10:"06/07/2013";i:7;s:10:"26/03/2014";}', 1);
INSERT INTO `cycles` VALUES(71, '01/02/2014', 'a:8:{i:0;s:10:"01/02/2014";i:1;s:10:"19/12/2012";i:2;s:10:"10/07/2013";i:3;s:10:"27/03/2013";i:4;s:10:"15/04/2014";i:5;s:10:"02/04/2013";i:6;s:10:"12/11/2012";i:7;s:10:"06/06/2013";}', 1);
INSERT INTO `cycles` VALUES(72, '18/09/2014', 'a:8:{i:0;s:10:"18/09/2014";i:1;s:10:"19/01/2014";i:2;s:10:"05/12/2013";i:3;s:10:"12/05/2013";i:4;s:10:"04/11/2012";i:5;s:10:"29/12/2012";i:6;s:10:"21/06/2014";i:7;s:10:"18/09/2013";}', 1);
INSERT INTO `cycles` VALUES(73, '07/08/2014', 'a:8:{i:0;s:10:"07/08/2014";i:1;s:10:"25/10/2012";i:2;s:10:"15/08/2013";i:3;s:10:"07/05/2013";i:4;s:10:"18/12/2013";i:5;s:10:"28/09/2013";i:6;s:10:"14/08/2013";i:7;s:10:"12/06/2014";}', 1);
INSERT INTO `cycles` VALUES(74, '31/01/2013', 'a:8:{i:0;s:10:"31/01/2013";i:1;s:10:"09/02/2014";i:2;s:10:"26/08/2014";i:3;s:10:"12/05/2013";i:4;s:10:"30/06/2014";i:5;s:10:"19/01/2013";i:6;s:10:"09/08/2014";i:7;s:10:"26/02/2014";}', 1);
INSERT INTO `cycles` VALUES(75, '03/01/2013', 'a:8:{i:0;s:10:"03/01/2013";i:1;s:10:"18/06/2013";i:2;s:10:"18/05/2013";i:3;s:10:"21/11/2013";i:4;s:10:"03/10/2014";i:5;s:10:"04/07/2014";i:6;s:10:"05/07/2013";i:7;s:10:"11/07/2014";}', 1);
INSERT INTO `cycles` VALUES(76, '22/10/2012', 'a:8:{i:0;s:10:"22/10/2012";i:1;s:10:"01/05/2013";i:2;s:10:"27/04/2013";i:3;s:10:"27/01/2013";i:4;s:10:"15/04/2014";i:5;s:10:"23/09/2013";i:6;s:10:"24/06/2014";i:7;s:10:"26/04/2013";}', 1);
INSERT INTO `cycles` VALUES(77, '03/07/2014', 'a:8:{i:0;s:10:"03/07/2014";i:1;s:10:"31/01/2013";i:2;s:10:"09/02/2013";i:3;s:10:"15/05/2014";i:4;s:10:"08/05/2014";i:5;s:10:"07/10/2013";i:6;s:10:"15/03/2014";i:7;s:10:"25/12/2013";}', 1);
INSERT INTO `cycles` VALUES(78, '20/10/2013', 'a:8:{i:0;s:10:"20/10/2013";i:1;s:10:"15/02/2014";i:2;s:10:"22/03/2013";i:3;s:10:"14/02/2013";i:4;s:10:"30/09/2013";i:5;s:10:"14/06/2013";i:6;s:10:"10/11/2013";i:7;s:10:"12/09/2014";}', 1);
INSERT INTO `cycles` VALUES(79, '24/11/2012', 'a:8:{i:0;s:10:"24/11/2012";i:1;s:10:"25/03/2013";i:2;s:10:"30/05/2013";i:3;s:10:"10/06/2013";i:4;s:10:"25/08/2013";i:5;s:10:"14/05/2014";i:6;s:10:"09/02/2013";i:7;s:10:"15/08/2013";}', 1);
INSERT INTO `cycles` VALUES(80, '29/09/2013', 'a:8:{i:0;s:10:"29/09/2013";i:1;s:10:"14/02/2014";i:2;s:10:"17/01/2013";i:3;s:10:"22/09/2013";i:4;s:10:"01/02/2014";i:5;s:10:"15/08/2013";i:6;s:10:"29/08/2013";i:7;s:10:"24/10/2012";}', 1);
INSERT INTO `cycles` VALUES(81, '30/12/2013', 'a:8:{i:0;s:10:"30/12/2013";i:1;s:10:"06/01/2013";i:2;s:10:"10/02/2014";i:3;s:10:"11/01/2013";i:4;s:10:"12/10/2013";i:5;s:10:"02/01/2013";i:6;s:10:"17/02/2013";i:7;s:10:"02/07/2014";}', 1);
INSERT INTO `cycles` VALUES(82, '24/01/2013', 'a:8:{i:0;s:10:"24/01/2013";i:1;s:10:"10/08/2014";i:2;s:10:"25/10/2013";i:3;s:10:"22/12/2012";i:4;s:10:"19/04/2013";i:5;s:10:"20/02/2014";i:6;s:10:"22/04/2013";i:7;s:10:"14/09/2013";}', 1);
INSERT INTO `cycles` VALUES(83, '01/01/2013', 'a:8:{i:0;s:10:"01/01/2013";i:1;s:10:"22/09/2014";i:2;s:10:"22/02/2014";i:3;s:10:"07/01/2013";i:4;s:10:"02/09/2013";i:5;s:10:"05/12/2012";i:6;s:10:"09/06/2013";i:7;s:10:"11/04/2014";}', 1);
INSERT INTO `cycles` VALUES(84, '09/07/2014', 'a:8:{i:0;s:10:"09/07/2014";i:1;s:10:"26/06/2013";i:2;s:10:"22/09/2013";i:3;s:10:"17/06/2013";i:4;s:10:"22/06/2013";i:5;s:10:"15/04/2014";i:6;s:10:"04/12/2012";i:7;s:10:"08/09/2013";}', 1);
INSERT INTO `cycles` VALUES(85, '08/02/2014', 'a:8:{i:0;s:10:"08/02/2014";i:1;s:10:"03/04/2014";i:2;s:10:"26/11/2013";i:3;s:10:"13/07/2014";i:4;s:10:"29/10/2013";i:5;s:10:"27/07/2014";i:6;s:10:"06/01/2014";i:7;s:10:"15/08/2014";}', 1);
INSERT INTO `cycles` VALUES(86, '17/11/2013', 'a:8:{i:0;s:10:"17/11/2013";i:1;s:10:"01/07/2013";i:2;s:10:"14/12/2013";i:3;s:10:"02/03/2013";i:4;s:10:"12/02/2013";i:5;s:10:"05/05/2013";i:6;s:10:"23/11/2012";i:7;s:10:"24/01/2014";}', 1);
INSERT INTO `cycles` VALUES(87, '22/01/2013', 'a:8:{i:0;s:10:"22/01/2013";i:1;s:10:"01/04/2013";i:2;s:10:"30/01/2014";i:3;s:10:"27/11/2013";i:4;s:10:"23/03/2013";i:5;s:10:"19/05/2014";i:6;s:10:"20/01/2014";i:7;s:10:"11/05/2014";}', 1);
INSERT INTO `cycles` VALUES(88, '11/10/2013', 'a:8:{i:0;s:10:"11/10/2013";i:1;s:10:"17/03/2013";i:2;s:10:"15/06/2014";i:3;s:10:"02/09/2014";i:4;s:10:"16/12/2012";i:5;s:10:"01/06/2014";i:6;s:10:"20/04/2014";i:7;s:10:"16/10/2014";}', 1);
INSERT INTO `cycles` VALUES(89, '12/01/2013', 'a:8:{i:0;s:10:"12/01/2013";i:1;s:10:"17/12/2013";i:2;s:10:"03/07/2013";i:3;s:10:"25/02/2013";i:4;s:10:"15/07/2013";i:5;s:10:"04/03/2014";i:6;s:10:"19/12/2012";i:7;s:10:"09/06/2013";}', 1);
INSERT INTO `cycles` VALUES(90, '29/06/2014', 'a:8:{i:0;s:10:"29/06/2014";i:1;s:10:"15/07/2013";i:2;s:10:"02/04/2013";i:3;s:10:"28/06/2013";i:4;s:10:"03/02/2014";i:5;s:10:"18/03/2014";i:6;s:10:"01/05/2013";i:7;s:10:"20/11/2012";}', 1);
INSERT INTO `cycles` VALUES(91, '19/10/2012', 'a:8:{i:0;s:10:"19/10/2012";i:1;s:10:"13/09/2014";i:2;s:10:"14/03/2013";i:3;s:10:"19/11/2012";i:4;s:10:"28/02/2014";i:5;s:10:"18/01/2014";i:6;s:10:"25/08/2014";i:7;s:10:"02/11/2012";}', 1);
INSERT INTO `cycles` VALUES(92, '14/07/2014', 'a:8:{i:0;s:10:"14/07/2014";i:1;s:10:"19/11/2012";i:2;s:10:"30/10/2013";i:3;s:10:"16/12/2012";i:4;s:10:"27/10/2013";i:5;s:10:"05/10/2013";i:6;s:10:"30/07/2013";i:7;s:10:"23/03/2013";}', 1);
INSERT INTO `cycles` VALUES(93, '13/08/2013', 'a:8:{i:0;s:10:"13/08/2013";i:1;s:10:"20/01/2014";i:2;s:10:"04/02/2014";i:3;s:10:"09/01/2014";i:4;s:10:"17/08/2014";i:5;s:10:"04/11/2012";i:6;s:10:"07/03/2013";i:7;s:10:"02/01/2013";}', 1);
INSERT INTO `cycles` VALUES(94, '18/12/2013', 'a:8:{i:0;s:10:"18/12/2013";i:1;s:10:"12/09/2014";i:2;s:10:"23/03/2014";i:3;s:10:"21/08/2013";i:4;s:10:"27/10/2013";i:5;s:10:"28/04/2014";i:6;s:10:"28/02/2013";i:7;s:10:"17/12/2013";}', 1);
INSERT INTO `cycles` VALUES(95, '15/07/2013', 'a:8:{i:0;s:10:"15/07/2013";i:1;s:10:"19/04/2014";i:2;s:10:"26/05/2014";i:3;s:10:"09/02/2014";i:4;s:10:"24/08/2013";i:5;s:10:"07/01/2013";i:6;s:10:"08/01/2013";i:7;s:10:"20/09/2013";}', 1);

-- --------------------------------------------------------

--
-- Structure de la table `inscriptions`
--

DROP TABLE IF EXISTS `inscriptions`;
CREATE TABLE IF NOT EXISTS `inscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eleve_id` int(11) NOT NULL,
  `accompagnement_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `inscriptions`
--


-- --------------------------------------------------------

--
-- Structure de la table `matieres`
--

DROP TABLE IF EXISTS `matieres`;
CREATE TABLE IF NOT EXISTS `matieres` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `type` tinyint(2) NOT NULL,
  `niveau` varchar(16) NOT NULL,
  `places` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nom` (`nom`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `matieres`
--

INSERT INTO `matieres` VALUES(1, 'Français', 1, 'yellow', 14, 1);
INSERT INTO `matieres` VALUES(2, 'Histoire-Geo', 2, 'red', 14, 1);
INSERT INTO `matieres` VALUES(3, 'Math', 1, 'violet', 14, 1);
INSERT INTO `matieres` VALUES(4, 'Anglais', 2, 'blue', 13, 1);
INSERT INTO `matieres` VALUES(5, 'Ballon', 1, 'indigo', 20, 1);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(64) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `mail` varchar(64) DEFAULT NULL,
  `mail_parent` varchar(64) DEFAULT NULL,
  `profil` int(11) NOT NULL,
  `classe` varchar(8) DEFAULT NULL,
  `groupe` varchar(8) DEFAULT NULL,
  `login` varchar(32) NOT NULL,
  `passwd` varchar(32) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `lastlogin` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=89 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` VALUES(1, 'foo', 'foo', '', '', 1, '', '', 'foo', 'foo', 0, NULL);
INSERT INTO `users` VALUES(2, 'bar', 'bar', '', '', 2, '', '', 'bar', 'bar', 0, NULL);
INSERT INTO `users` VALUES(3, 'boz', 'boz', NULL, NULL, 3, NULL, NULL, 'boz', 'boz', 0, NULL);
INSERT INTO `users` VALUES(4, 'admin', 'admin', NULL, NULL, 4, NULL, NULL, 'admin', 'admin', 0, NULL);
INSERT INTO `users` VALUES(5, 'Vivian', 'Fischer', 'Etiam.bibendum@pellentesqueeget.org', 'dolor.sit@ascelerisque.edu', 2, '1', '8', 'malesuada', '', 1, NULL);
INSERT INTO `users` VALUES(6, 'Blair', 'Dale', 'dui@eu.net', 'Etiam.laoreet@nisisem.ca', 2, '2', '3', 'fringilla', '', 1, NULL);
INSERT INTO `users` VALUES(7, 'Orson', 'Romero', 'dis@nonenimcommodo.edu', 'magna.a.neque@risus.org', 1, '4', '3', 'Sed', '', 1, NULL);
INSERT INTO `users` VALUES(8, 'Grant', 'Chandler', 'et@elitCurabitursed.ca', 'blandit.at@ipsumleo.co.uk', 3, '3', '4', 'ipsum', '', 1, NULL);
INSERT INTO `users` VALUES(9, 'Merrill', 'Hoover', 'ipsum.leo@ridiculus.co.uk', 'fringilla@tellusidnunc.edu', 2, '1', '6', 'augue', '', 1, NULL);
INSERT INTO `users` VALUES(10, 'Rhiannon', 'Holder', 'Sed@egestasnuncsed.co.uk', 'ut@Donec.ca', 2, '4', '5', 'quis', '', 1, NULL);
INSERT INTO `users` VALUES(11, 'Blythe', 'Chavez', 'ultricies.sem.magna@loremfringillaornare.co.uk', 'Maecenas.ornare@acmetusvitae.net', 4, '2', '8', 'torquent', '', 1, NULL);
INSERT INTO `users` VALUES(12, 'Ahmed', 'Sherman', 'risus.odio@nullaInteger.com', 'Aliquam.erat@vulputateeu.net', 2, '4', '4', 'facilisis', '', 1, NULL);
INSERT INTO `users` VALUES(13, 'Cally', 'Whitley', 'Cras.dolor@elitpellentesquea.com', 'Mauris@neque.co.uk', 2, '5', '3', 'magna.', '', 1, NULL);
INSERT INTO `users` VALUES(14, 'Quinn', 'Sweeney', 'Etiam.gravida@ipsum.edu', 'velit.Sed@nascetur.net', 4, '4', '4', 'mattis.', '', 1, NULL);
INSERT INTO `users` VALUES(15, 'Victoria', 'Little', 'orci.consectetuer@Namac.co.uk', 'metus.vitae@dapibusidblandit.edu', 4, '4', '6', 'mi', '', 1, NULL);
INSERT INTO `users` VALUES(16, 'Dante', 'Molina', 'parturient@dignissim.com', 'sit.amet@maurissit.ca', 2, '4', '3', 'purus', '', 1, NULL);
INSERT INTO `users` VALUES(17, 'Rhonda', 'Gilmore', 'amet.consectetuer.adipiscing@tellusid.ca', 'dui@Nulla.org', 4, '1', '3', 'vel', '', 1, NULL);
INSERT INTO `users` VALUES(18, 'Sheila', 'Lester', 'quam@arcuNuncmauris.ca', 'amet.consectetuer.adipiscing@egestasurna.org', 3, '3', '3', 'velit.', '', 1, NULL);
INSERT INTO `users` VALUES(19, 'Steven', 'Cherry', 'vestibulum@commodoauctorvelit.net', 'Quisque.libero.lacus@Aeneanmassa.com', 1, '5', '3', 'quis,', '', 1, NULL);
INSERT INTO `users` VALUES(20, 'Ashely', 'Dyer', 'Sed.nec@Curae.org', 'Quisque@sedorci.edu', 1, '2', '4', 'rhoncus.', '', 1, NULL);
INSERT INTO `users` VALUES(21, 'Nevada', 'Meyer', 'vulputate@blanditatnisi.co.uk', 'gravida@tellusNunclectus.edu', 1, '4', '4', 'feugiat', '', 1, NULL);
INSERT INTO `users` VALUES(22, 'Kuame', 'Benjamin', 'Vivamus.molestie@dolornonummyac.edu', 'quis.tristique@purussapien.co.uk', 4, '2', '3', 'porttitor', '', 1, NULL);
INSERT INTO `users` VALUES(23, 'Kelsey', 'Barton', 'enim@Sed.com', 'lacus@cursusnon.edu', 2, '3', '5', 'Maecenas', '', 1, NULL);
INSERT INTO `users` VALUES(24, 'Wyoming', 'Chaney', 'mollis@Maecenasiaculisaliquet.ca', 'Sed@molestieSed.net', 4, '4', '2', 'lobortis', '', 1, NULL);
INSERT INTO `users` VALUES(25, 'Jason', 'Davidson', 'facilisi.Sed.neque@euodio.com', 'Nunc.quis@Inscelerisque.edu', 4, '2', '8', 'lectus', '', 1, NULL);
INSERT INTO `users` VALUES(26, 'Zachary', 'English', 'dictum.placerat@luctus.net', 'sapien@cursuseteros.ca', 2, '2', '2', 'vitae', '', 1, NULL);
INSERT INTO `users` VALUES(27, 'Malik', 'Reilly', 'orci.adipiscing.non@utpharetrased.edu', 'risus.Morbi@eleifendnondapibus.com', 1, '3', '2', 'In', '', 1, NULL);
INSERT INTO `users` VALUES(28, 'Winter', 'Carey', 'et@eratnonummy.org', 'arcu@placerat.com', 2, '2', '2', 'euismod', '', 1, NULL);
INSERT INTO `users` VALUES(29, 'Amos', 'Ingram', 'malesuada.ut@seddolor.net', 'eu@ipsum.co.uk', 4, '3', '6', 'sagittis', '', 1, NULL);
INSERT INTO `users` VALUES(30, 'Katelyn', 'Mathis', 'risus@tinciduntpede.org', 'Curabitur@vitae.com', 2, '4', '7', 'eu', '', 1, NULL);
INSERT INTO `users` VALUES(31, 'Tatum', 'Berg', 'eu.nulla@Duismi.org', 'amet.dapibus.id@iaculislacus.org', 1, '3', '7', 'neque.', '', 1, NULL);
INSERT INTO `users` VALUES(32, 'Shoshana', 'Wallace', 'sit.amet.metus@adlitora.edu', 'orci.luctus@elit.co.uk', 4, '1', '3', 'ultrices', '', 1, NULL);
INSERT INTO `users` VALUES(33, 'September', 'Richmond', 'pharetra.Quisque@ultrices.com', 'Aliquam.erat.volutpat@sed.org', 3, '5', '8', 'ornare', '', 1, NULL);
INSERT INTO `users` VALUES(34, 'Lillith', 'Prince', 'porttitor.scelerisque@Donecnonjusto.edu', 'nulla.magna@nonhendrerit.ca', 3, '5', '8', 'ante.', '', 1, NULL);
INSERT INTO `users` VALUES(35, 'Hedley', 'Joyce', 'et.commodo.at@a.ca', 'mauris.rhoncus@accumsaninterdum.net', 3, '5', '4', 'auctor', '', 1, NULL);
INSERT INTO `users` VALUES(36, 'Vivien', 'Gomez', 'sodales.at.velit@quisurna.co.uk', 'sollicitudin.adipiscing@pedeac.co.uk', 2, '5', '5', 'nulla', '', 1, NULL);
INSERT INTO `users` VALUES(37, 'Jaquelyn', 'Rush', 'non@aliquetmetus.com', 'orci.luctus.et@Sed.net', 1, '5', '1', 'nibh', '', 1, NULL);
INSERT INTO `users` VALUES(38, 'Oleg', 'Poole', 'risus.Morbi.metus@veliteu.net', 'pharetra.Quisque.ac@congueturpisIn.net', 4, '2', '8', 'nec', '', 1, NULL);
INSERT INTO `users` VALUES(39, 'Yen', 'Goff', 'nec.tellus.Nunc@iaculislacus.edu', 'elit.Curabitur.sed@pretiumet.edu', 2, '4', '5', 'est', '', 1, NULL);
INSERT INTO `users` VALUES(40, 'Janna', 'Espinoza', 'ipsum.dolor@Class.ca', 'facilisis.vitae@molestie.net', 3, '2', '8', 'aptent', '', 1, NULL);
INSERT INTO `users` VALUES(41, 'Laurel', 'Lawson', 'cursus.et@cursuset.net', 'diam.Pellentesque@molestie.org', 4, '1', '5', 'diam', '', 1, NULL);
INSERT INTO `users` VALUES(42, 'Ali', 'Morris', 'nonummy@Integer.org', 'ipsum.ac@Maurisquisturpis.org', 1, '1', '5', 'lorem,', '', 1, NULL);
INSERT INTO `users` VALUES(43, 'Cedric', 'Rollins', 'quis@dolordapibusgravida.org', 'dictum.Phasellus.in@nonummyFuscefermentum.edu', 1, '4', '3', 'rutrum,', '', 1, NULL);
INSERT INTO `users` VALUES(44, 'Galena', 'Slater', 'mollis.Integer@ligulaDonecluctus.org', 'hendrerit.Donec.porttitor@netuset.ca', 3, '4', '1', 'nisl', '', 1, NULL);
INSERT INTO `users` VALUES(45, 'Desiree', 'Browning', 'ante.bibendum@lacus.org', 'a.mi@telluseu.net', 2, '4', '3', 'eu,', '', 1, NULL);
INSERT INTO `users` VALUES(46, 'Noelle', 'Anthony', 'elit@velquam.net', 'lectus@Donecatarcu.co.uk', 2, '4', '2', 'eget,', '', 1, NULL);
INSERT INTO `users` VALUES(47, 'Levi', 'Butler', 'vel.turpis.Aliquam@quistristique.ca', 'convallis@lobortis.org', 4, '3', '6', 'nisi', '', 1, NULL);
INSERT INTO `users` VALUES(48, 'Vivien', 'Pratt', 'massa.non.ante@liberoDonec.net', 'elit.pellentesque.a@vulputatenisi.co.uk', 1, '1', '2', 'consequat', '', 1, NULL);
INSERT INTO `users` VALUES(49, 'Bryar', 'Maxwell', 'a.aliquet@sollicitudincommodo.org', 'libero.Proin@aliquetnec.net', 4, '4', '6', 'elementum', '', 1, NULL);
INSERT INTO `users` VALUES(50, 'Lara', 'Slater', 'orci.luctus@Donec.com', 'magna.nec@dapibus.net', 1, '4', '8', 'ut', '', 1, NULL);
INSERT INTO `users` VALUES(51, 'Giselle', 'Ellison', 'ac@Curabitur.co.uk', 'sit@convallisconvallisdolor.co.uk', 2, '4', '7', 'Phasellus', '', 1, NULL);
INSERT INTO `users` VALUES(52, 'Jenna', 'Mcgee', 'scelerisque@scelerisqueloremipsum.edu', 'magna.et@Craslorem.net', 2, '2', '7', 'elit,', '', 1, NULL);
INSERT INTO `users` VALUES(53, 'Thane', 'Nielsen', 'et.euismod@vehiculaaliquet.edu', 'imperdiet.ornare@sociis.net', 4, '1', '7', 'enim.', '', 1, NULL);
INSERT INTO `users` VALUES(54, 'Bevis', 'Mcintyre', 'a.facilisis@quisarcu.co.uk', 'Cum@nec.ca', 2, '4', '7', 'mattis', '', 1, NULL);
INSERT INTO `users` VALUES(55, 'Guy', 'Powers', 'orci.lobortis.augue@nequetellusimperdiet.ca', 'at@atpedeCras.edu', 1, '4', '2', 'pellentesque', '', 1, NULL);
INSERT INTO `users` VALUES(56, 'Rhona', 'Pacheco', 'condimentum@pharetrased.org', 'vitae.orci.Phasellus@duilectus.org', 1, '2', '3', 'Cum', '', 1, NULL);
INSERT INTO `users` VALUES(57, 'Chava', 'Cook', 'cursus.luctus@pedenec.co.uk', 'Mauris@Maecenasmalesuada.net', 3, '1', '2', 'Donec', '', 1, NULL);
INSERT INTO `users` VALUES(58, 'Tanisha', 'Riddle', 'mauris@Donectemporest.net', 'volutpat.Nulla.facilisis@nec.co.uk', 2, '4', '6', 'dictum.', '', 1, NULL);
INSERT INTO `users` VALUES(59, 'Dustin', 'Clements', 'congue@sapienmolestie.org', 'Integer@gravidasitamet.org', 1, '4', '3', 'arcu', '', 1, NULL);
INSERT INTO `users` VALUES(60, 'Evangeline', 'Mcmahon', 'augue@ultricesmaurisipsum.com', 'sit.amet.consectetuer@elitpede.org', 1, '2', '6', 'Duis', '', 1, NULL);
INSERT INTO `users` VALUES(61, 'Galena', 'Delgado', 'Nulla.tempor.augue@Nuncsollicitudin.co.uk', 'amet@lacusEtiam.org', 1, '5', '7', 'sodales', '', 1, NULL);
INSERT INTO `users` VALUES(62, 'Wylie', 'Dyer', 'Nulla.eget.metus@etcommodoat.net', 'lorem.auctor.quis@risusquis.org', 3, '5', '3', 'semper', '', 1, NULL);
INSERT INTO `users` VALUES(63, 'Aristotle', 'Dale', 'Fusce.mi.lorem@inmolestietortor.com', 'purus@tellussem.org', 2, '1', '5', 'Vestibulum', '', 1, NULL);
INSERT INTO `users` VALUES(64, 'Aiko', 'Finch', 'orci.luctus@adipiscingfringilla.ca', 'lorem@nibhlacinia.co.uk', 2, '2', '6', 'Aliquam', '', 1, NULL);
INSERT INTO `users` VALUES(65, 'Cherokee', 'Holmes', 'nec.luctus.felis@sociisnatoque.org', 'iaculis.aliquet@conguea.net', 3, '3', '8', 'pede', '', 1, NULL);
INSERT INTO `users` VALUES(66, 'Lisandra', 'Roth', 'ac@eutellus.com', 'Duis@dolornonummyac.org', 1, '4', '2', 'dis', '', 1, NULL);
INSERT INTO `users` VALUES(67, 'Astra', 'Jacobs', 'consequat@nisiCumsociis.edu', 'a@et.org', 3, '5', '3', 'dolor', '', 1, NULL);
INSERT INTO `users` VALUES(68, 'Gloria', 'Mckee', 'Integer@DonecegestasDuis.edu', 'euismod.mauris.eu@aliquetProinvelit.org', 3, '3', '8', 'nisi.', '', 1, NULL);
INSERT INTO `users` VALUES(69, 'Yoshio', 'Johnston', 'lacus.Aliquam.rutrum@ipsumCurabitur.org', 'Praesent.eu@feugiattellus.co.uk', 1, '1', '8', 'pretium', '', 1, NULL);
INSERT INTO `users` VALUES(70, 'Ahmed', 'Thomas', 'ante.lectus.convallis@erat.org', 'nibh.lacinia@lobortisquispede.com', 2, '5', '6', 'non', '', 1, NULL);
INSERT INTO `users` VALUES(71, 'Jada', 'Gillespie', 'turpis@Nullamvitae.net', 'dictum.sapien@felisullamcorper.org', 3, '2', '1', 'molestie', '', 1, NULL);
INSERT INTO `users` VALUES(72, 'Rhona', 'Mendez', 'mauris.id.sapien@nonnisi.edu', 'amet@nisi.com', 1, '1', '2', 'amet', '', 1, NULL);
INSERT INTO `users` VALUES(73, 'Jessamine', 'Montoya', 'gravida@Fusce.org', 'Cum.sociis@sedconsequatauctor.org', 1, '5', '5', 'sit', '', 1, NULL);
INSERT INTO `users` VALUES(74, 'Larissa', 'Melendez', 'libero.Integer.in@purusgravida.net', 'sit@Vestibulumante.com', 2, '2', '6', 'Integer', '', 1, NULL);
INSERT INTO `users` VALUES(75, 'Zoe', 'Mcdonald', 'suscipit@nequeNullam.co.uk', 'elit.elit.fermentum@Morbisit.edu', 2, '3', '1', 'at,', '', 1, NULL);
INSERT INTO `users` VALUES(76, 'Zachary', 'Shaffer', 'Sed@Pellentesque.net', 'placerat@ipsumDonec.net', 3, '1', '7', 'aliquet', '', 1, NULL);
INSERT INTO `users` VALUES(77, 'Virginia', 'Waters', 'nibh.dolor@imperdietdictum.org', 'Morbi@ridiculus.net', 2, '5', '4', 'gravida', '', 1, NULL);
INSERT INTO `users` VALUES(78, 'Brian', 'Aguirre', 'neque@eudoloregestas.com', 'Phasellus@Phasellusliberomauris.org', 2, '4', '3', 'nascetur', '', 1, NULL);
INSERT INTO `users` VALUES(79, 'Petra', 'Sanford', 'interdum.Nunc@necleoMorbi.net', 'adipiscing.elit@feugiatSednec.org', 1, '1', '7', 'mauris', '', 1, NULL);
INSERT INTO `users` VALUES(80, 'Tanisha', 'Delgado', 'Sed.eu.eros@nonquam.edu', 'fermentum.fermentum.arcu@liberoProin.co.uk', 3, '4', '6', 'egestas.', '', 1, NULL);
INSERT INTO `users` VALUES(81, 'Catherine', 'Vinson', 'et.netus@nonummyultriciesornare.org', 'erat@posuereat.com', 1, '3', '5', 'turpis', '', 1, NULL);
INSERT INTO `users` VALUES(82, 'Cameron', 'Spears', 'malesuada.Integer@mieleifend.net', 'justo@etmagnaPraesent.co.uk', 3, '5', '6', 'id', '', 1, NULL);
INSERT INTO `users` VALUES(83, 'Steven', 'Banks', 'scelerisque@estmollisnon.org', 'iaculis.nec.eleifend@ultricesmaurisipsum.co.uk', 1, '5', '2', 'tortor,', '', 1, NULL);
INSERT INTO `users` VALUES(84, 'Sarah', 'Powers', 'quis.massa@enimnon.ca', 'et@in.org', 1, '5', '1', 'nunc', '', 1, NULL);
INSERT INTO `users` VALUES(85, 'Carol', 'Richard', 'dignissim.magna@fringilla.org', 'et.magnis.dis@nunc.net', 1, '5', '4', 'ut,', '', 1, NULL);
INSERT INTO `users` VALUES(86, 'Ross', 'Hensley', 'Phasellus.dolor@risusInmi.ca', 'ligula.Nullam.feugiat@egestasrhoncusProin.org', 3, '2', '3', 'sem', '', 1, NULL);
INSERT INTO `users` VALUES(87, 'Nolan', 'Barker', 'dis@sagittisplacerat.org', 'Quisque@congue.co.uk', 1, '2', '2', 'sollicitudin', '', 1, NULL);
INSERT INTO `users` VALUES(88, 'Piper', 'Carlson', 'ut.cursus.luctus@Fuscealiquet.com', 'velit.Aliquam@euneque.net', 4, '2', '7', 'diam.', '', 1, NULL);
