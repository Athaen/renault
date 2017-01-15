-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Sam 14 Janvier 2017 à 03:19
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `renault`
--

-- --------------------------------------------------------

--
-- Structure de la table `autorisation`
--

CREATE TABLE IF NOT EXISTS `autorisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=4 ;

--
-- Contenu de la table `autorisation`
--

INSERT INTO `autorisation` (`id`, `libelle`, `valide`) VALUES
(1, 'admin', 1),
(2, 'acces', 1),
(3, 'aucune', 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE IF NOT EXISTS `categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=12 ;

--
-- Contenu de la table `categorie`
--

INSERT INTO `categorie` (`id`, `libelle`, `valide`) VALUES
(1, 'atelier', 1),
(2, 'carrosserie', 1),
(3, 'comptabilité', 1),
(4, 'mpr', 1),
(5, 'renault minute', 1),
(6, 'vn', 1),
(7, 'vn vendeurs', 1),
(8, 'vo', 1),
(9, 'vo vendeurs', 1),
(10, 'dir + c services', 1),
(11, 'salariés sortis', 1);

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

CREATE TABLE IF NOT EXISTS `salarie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idCategorie` int(11) NOT NULL,
  `nom` varchar(40) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(40) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=41 ;

--
-- Contenu de la table `salarie`
--

INSERT INTO `salarie` (`id`, `idCategorie`, `nom`, `prenom`, `mdp`, `valide`) VALUES
(1, 1, 'bassot', 'michael', 'basmic', 1),
(2, 1, 'deves', 'thierry', 'devthi', 1),
(3, 1, 'géraudie', 'guy', 'gerguy', 1),
(4, 1, 'gallerne', 'jean-luc', 'galjea', 1),
(5, 1, 'laporte', 'daniel', 'lapdan', 1),
(6, 1, 'mas', 'henri', 'mashen', 1),
(7, 1, 'mournetas', 'marie-pierre', 'moumar', 1),
(8, 1, 'rochais', 'david', 'rocdav', 1),
(9, 2, 'damion', 'david', 'damdav', 1),
(10, 2, 'goncalves pirès', 'joao', 'gonjoa', 1),
(11, 2, 'huchet', 'david', 'hucdav', 1),
(12, 2, 'magalhaes', 'tony', 'magton', 1),
(13, 2, 'mendes costa', 'mario', 'menmar', 1),
(14, 2, 'salle', 'françois', 'salfra', 1),
(15, 3, 'bordas', 'patricia', 'borpat', 1),
(16, 3, 'champeval', 'françoise', 'chafra', 1),
(17, 3, 'ribet', 'sylvie', 'ribsyl', 1),
(18, 4, 'longeot', 'bastien', 'lonbas', 1),
(19, 4, 'nadal', 'pascal', 'nadpas', 1),
(20, 4, 'sournat', 'christian', 'souchr', 1),
(21, 4, 'zérourou', 'yoan', 'zeryo', 1),
(22, 5, 'fleuret', 'klemens', 'flekle', 1),
(23, 5, 'lundy', 'mickael', 'lunmic', 1),
(24, 5, 'siriex', 'sébastien', 'sirseb', 1),
(25, 6, 'cheze', 'agnès', 'cheagn', 1),
(26, 6, 'foretnegre', 'laetitia', 'forlae', 1),
(27, 6, 'soulier', 'thierry', 'southi', 1),
(28, 6, 'tavé', 'isabelle', 'tavisa', 1),
(29, 6, 'valade', 'olivier', 'valoli', 1),
(30, 7, 'dessus bayle', 'boris', 'desbor', 1),
(31, 7, 'guindre', 'frederic', 'guifre', 1),
(32, 7, 'mouly', 'pierre', 'moupie', 1),
(33, 7, 'pereira', 'eric', 'pereri', 1),
(34, 7, 'pouyade', 'david', 'poudav', 1),
(35, 8, 'arvis', 'aurélie', 'arvaur', 1),
(36, 8, 'bezanger', 'sylvie', 'bezsyl', 1),
(37, 8, 'rigal', 'christian', 'rigchr', 1),
(38, 8, 'veyssiere', 'gilles', '', 1),
(39, 9, 'guilmard', 'fabien', 'guifab', 1),
(40, 10, 'vigneau', 'florent', 'vigflo', 1);

-- --------------------------------------------------------

--
-- Structure de la table `salarie_autorisation`
--

CREATE TABLE IF NOT EXISTS `salarie_autorisation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idSalarie` int(11) NOT NULL,
  `idAutorisation` int(11) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=10 ;

--
-- Contenu de la table `salarie_autorisation`
--

INSERT INTO `salarie_autorisation` (`id`, `idSalarie`, `idAutorisation`, `valide`) VALUES
(1, 40, 1, 1),
(2, 40, 2, 1),
(3, 28, 2, 1),
(4, 16, 2, 1),
(5, 15, 2, 1),
(6, 4, 2, 1),
(7, 37, 2, 1),
(8, 11, 2, 1),
(9, 2, 2, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
