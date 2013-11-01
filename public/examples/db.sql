-- phpMyAdmin SQL Dump
-- version 3.2.5
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Ven 01 Novembre 2013 à 17:33
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
  `salle` varchar(16) NOT NULL,
  `enseignant_id` int(11) NOT NULL,
  `actif` tinyint(1) NOT NULL DEFAULT '1',
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `accompagnement`
--

INSERT INTO `accompagnement` VALUES(34, 1, 96, ' 1			', 3, 1, '');
INSERT INTO `accompagnement` VALUES(32, 2, 97, ' 2			', 3, 1, '');
INSERT INTO `accompagnement` VALUES(37, 3, 98, ' 4			', 5, 1, '');

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
  UNIQUE KEY `debut` (`debut`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=100 ;

--
-- Contenu de la table `cycles`
--

INSERT INTO `cycles` VALUES(96, '02/03/2013', 'a:4:{i:0;s:10:"02/03/2013";i:1;s:10:"03/09/2013";i:2;s:10:"07/03/2014";i:3;s:10:"08/09/2014";}', 1);
INSERT INTO `cycles` VALUES(97, '03/03/2013', 'a:3:{i:0;s:10:"03/03/2013";i:1;s:10:"04/03/2013";i:2;s:10:"05/03/2013";}', 1);
INSERT INTO `cycles` VALUES(98, '10/04/2013', 'a:3:{i:0;s:10:"10/04/2013";i:1;s:10:"17/04/2013";i:2;s:10:"24/04/2013";}', 1);
INSERT INTO `cycles` VALUES(99, '11/04/2013', 'a:3:{i:0;s:10:"11/04/2013";i:1;s:10:"18/04/2013";i:2;s:10:"25/04/2013";}', 1);

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
  PRIMARY KEY (`id`),
  KEY `eleve_id` (`eleve_id`),
  KEY `accompagnement_id` (`accompagnement_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `inscriptions`
--

INSERT INTO `inscriptions` VALUES(15, 4, 34, '');
INSERT INTO `inscriptions` VALUES(14, 1, 34, '');

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
-- Structure de la table `presences`
--

DROP TABLE IF EXISTS `presences`;
CREATE TABLE IF NOT EXISTS `presences` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `eleve_id` int(11) NOT NULL,
  `seance_id` int(11) NOT NULL,
  `absent` tinyint(1) NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `seance_id` (`seance_id`),
  KEY `eleve_id` (`eleve_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `presences`
--


-- --------------------------------------------------------

--
-- Structure de la table `seances`
--

DROP TABLE IF EXISTS `seances`;
CREATE TABLE IF NOT EXISTS `seances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `accompagnement_id` int(11) NOT NULL,
  `enseignant_id` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `validee` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `enseignant_id` (`enseignant_id`),
  KEY `accompagnement_id` (`accompagnement_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=35 ;

--
-- Contenu de la table `seances`
--

INSERT INTO `seances` VALUES(21, 32, 3, '2013-03-05 00:00:00', 0);
INSERT INTO `seances` VALUES(20, 32, 3, '2013-03-04 00:00:00', 0);
INSERT INTO `seances` VALUES(19, 32, 3, '2013-03-03 00:00:00', 0);
INSERT INTO `seances` VALUES(18, 31, 2, '2014-09-08 00:00:00', 0);
INSERT INTO `seances` VALUES(17, 31, 2, '2014-03-07 00:00:00', 0);
INSERT INTO `seances` VALUES(16, 31, 2, '2013-09-03 00:00:00', 0);
INSERT INTO `seances` VALUES(15, 31, 2, '2013-03-02 00:00:00', 0);
INSERT INTO `seances` VALUES(34, 37, 5, '2013-04-24 00:00:00', 0);
INSERT INTO `seances` VALUES(33, 37, 5, '2013-04-17 00:00:00', 0);
INSERT INTO `seances` VALUES(32, 37, 5, '2013-04-10 00:00:00', 0);
INSERT INTO `seances` VALUES(25, 34, 3, '2013-03-02 00:00:00', 1);
INSERT INTO `seances` VALUES(26, 34, 3, '2013-09-03 00:00:00', 0);
INSERT INTO `seances` VALUES(27, 34, 3, '2014-03-07 00:00:00', 0);
INSERT INTO `seances` VALUES(28, 34, 3, '2014-09-08 00:00:00', 0);

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
