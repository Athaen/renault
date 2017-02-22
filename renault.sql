-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 09 Février 2017 à 14:08
-- Version du serveur :  5.7.14
-- Version de PHP :  5.6.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `renault`
--

-- --------------------------------------------------------

--
-- Structure de la table `arretht`
--

CREATE TABLE `arretht` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `heure` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `autorisation`
--

CREATE TABLE `autorisation` (
  `id` int(11) NOT NULL,
  `libelle` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `autorisation`
--

INSERT INTO `autorisation` (`id`, `libelle`, `valide`) VALUES
(1, 'droits d\'administration', 1),
(2, 'accès à l\'application', 1);

-- --------------------------------------------------------

--
-- Structure de la table `heure`
--

CREATE TABLE `heure` (
  `id` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `idTypeHeure` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `hrHt` varchar(2) CHARACTER SET utf8 NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `heure`
--

INSERT INTO `heure` (`id`, `idSalarie`, `idTypeHeure`, `datetime`, `hrHt`, `valide`) VALUES
(1, 1, 3, '2017-09-01 05:21:00', 'ht', 1),
(2, 1, 4, '2017-09-02 04:00:00', 'ht', 1),
(3, 1, 2, '2017-09-06 00:00:00', 'ht', 1),
(4, 1, 8, '2017-09-07 03:00:00', 'ht', 1),
(5, 1, 10, '2017-09-09 00:00:00', 'ht', 1),
(6, 1, 6, '2017-09-04 04:00:00', 'ht', 1),
(7, 1, 7, '2017-09-05 05:54:00', 'ht', 1),
(8, 1, 1, '2017-09-12 02:05:00', 'ht', 1),
(9, 1, 5, '2017-09-03 00:00:00', 'ht', 1),
(10, 1, 9, '2017-09-08 00:00:00', 'ht', 1);

-- --------------------------------------------------------

--
-- Structure de la table `heuresupp`
--

CREATE TABLE `heuresupp` (
  `id` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `heure` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `report`
--

CREATE TABLE `report` (
  `id` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `heure` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `salarie`
--

CREATE TABLE `salarie` (
  `id` int(11) NOT NULL,
  `idService` int(11) NOT NULL,
  `nom` varchar(40) COLLATE utf8_bin NOT NULL,
  `prenom` varchar(40) COLLATE utf8_bin NOT NULL,
  `mdp` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `salarie`
--

INSERT INTO `salarie` (`id`, `idService`, `nom`, `prenom`, `mdp`, `valide`) VALUES
(1, 1, 'Bassot', 'Michael', 'basmic', 1),
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

CREATE TABLE `salarie_autorisation` (
  `id` int(11) NOT NULL,
  `idSalarie` int(11) NOT NULL,
  `idAutorisation` int(11) NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

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

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id` int(11) NOT NULL,
  `libelle` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `service`
--

INSERT INTO `service` (`id`, `libelle`, `valide`) VALUES
(1, 'Atelier', 1),
(2, 'Carrosserie', 1),
(3, 'Comptabilité', 1),
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
-- Structure de la table `typeheure`
--

CREATE TABLE `typeheure` (
  `id` int(11) NOT NULL,
  `libelle` varchar(40) COLLATE utf8_bin NOT NULL,
  `valide` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `typeheure`
--

INSERT INTO `typeheure` (`id`, `libelle`, `valide`) VALUES
(1, 'Travail', 1),
(2, 'Paternité', 1),
(3, 'Maternité', 1),
(4, 'CP', 1),
(5, 'Férié', 1),
(6, 'Formation', 1),
(7, 'Récupération', 1),
(8, 'RTT', 1),
(9, 'Solidarité', 1),
(10, 'Maladie', 1);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `arretht`
--
ALTER TABLE `arretht`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `autorisation`
--
ALTER TABLE `autorisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `heure`
--
ALTER TABLE `heure`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `heuresupp`
--
ALTER TABLE `heuresupp`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `report`
--
ALTER TABLE `report`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `salarie`
--
ALTER TABLE `salarie`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Index pour la table `salarie_autorisation`
--
ALTER TABLE `salarie_autorisation`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `typeheure`
--
ALTER TABLE `typeheure`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `arretht`
--
ALTER TABLE `arretht`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `autorisation`
--
ALTER TABLE `autorisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `heure`
--
ALTER TABLE `heure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT pour la table `heuresupp`
--
ALTER TABLE `heuresupp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `report`
--
ALTER TABLE `report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT pour la table `salarie`
--
ALTER TABLE `salarie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT pour la table `salarie_autorisation`
--
ALTER TABLE `salarie_autorisation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT pour la table `typeheure`
--
ALTER TABLE `typeheure`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
