-- phpMyAdmin SQL Dump
-- version 4.2.12deb2+deb8u2
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Ven 16 Juin 2017 à 14:28
-- Version du serveur :  5.5.54-0+deb8u1
-- Version de PHP :  5.6.30-0+deb8u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `cartes`
--

-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE IF NOT EXISTS `carte` (
`id_carte` int(11) NOT NULL,
  `nom_carte` varchar(150) NOT NULL,
  `description_carte` text,
  `version_carte` varchar(45) NOT NULL,
  `creation_carte` varchar(45) NOT NULL,
  `miseenligne_carte` datetime NOT NULL,
  `etat_carte` int(11) NOT NULL,
  `commentaires_carte` text,
  `hit_carte` int(11) NOT NULL,
  `prestation_carte` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `carte_has_format`
--

CREATE TABLE IF NOT EXISTS `carte_has_format` (
`id_format` int(11) NOT NULL,
  `id_carte` int(11) NOT NULL,
  `type_format` int(11) NOT NULL,
  `extension_format` varchar(45) NOT NULL,
  `poids_carte` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=321 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `carte_has_tags`
--

CREATE TABLE IF NOT EXISTS `carte_has_tags` (
  `id_carte` int(11) NOT NULL,
  `id_tags` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `carte_has_thematique`
--

CREATE TABLE IF NOT EXISTS `carte_has_thematique` (
  `id_carte` int(11) NOT NULL,
  `id_thematique` int(11) NOT NULL,
  `id_sousthematique` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `carto_session`
--

CREATE TABLE IF NOT EXISTS `carto_session` (
`id_session` int(11) NOT NULL,
  `login_session` varchar(45) NOT NULL,
  `motdepasse_session` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `ip_autorisee`
--

CREATE TABLE IF NOT EXISTS `ip_autorisee` (
`id_ip_autorisee` int(11) NOT NULL,
  `ip_ip_autorisee` varchar(45) NOT NULL,
  `description_ip_autorisee` varchar(45) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `sous_thematique`
--

CREATE TABLE IF NOT EXISTS `sous_thematique` (
`id_soustheme` int(11) NOT NULL,
  `nom_soustheme` varchar(100) NOT NULL,
  `thematique_id_theme` int(11) NOT NULL,
  `ordre_soustheme` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id_tags` int(11) NOT NULL,
  `nom_tag` varchar(75) NOT NULL,
  `hits_tag` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=220 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `thematique`
--

CREATE TABLE IF NOT EXISTS `thematique` (
`id_theme` int(11) NOT NULL,
  `nom_theme` varchar(100) NOT NULL,
  `ordre_theme` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `visiteur`
--

CREATE TABLE IF NOT EXISTS `visiteur` (
`id_visiteur` int(11) NOT NULL,
  `ip_visiteur` varchar(45) NOT NULL,
  `date_visiteur` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2079 DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `carte`
--
ALTER TABLE `carte`
 ADD PRIMARY KEY (`id_carte`);

--
-- Index pour la table `carte_has_format`
--
ALTER TABLE `carte_has_format`
 ADD PRIMARY KEY (`id_format`), ADD KEY `fk_carte_has_format_format1_idx` (`type_format`), ADD KEY `fk_carte_has_format_carte1_idx` (`id_carte`);

--
-- Index pour la table `carte_has_tags`
--
ALTER TABLE `carte_has_tags`
 ADD KEY `fk_carte_has_tags_tags1_idx` (`id_tags`), ADD KEY `fk_carte_has_tags_carte1_idx` (`id_carte`);

--
-- Index pour la table `carte_has_thematique`
--
ALTER TABLE `carte_has_thematique`
 ADD PRIMARY KEY (`id_carte`);

--
-- Index pour la table `carto_session`
--
ALTER TABLE `carto_session`
 ADD PRIMARY KEY (`id_session`);

--
-- Index pour la table `ip_autorisee`
--
ALTER TABLE `ip_autorisee`
 ADD PRIMARY KEY (`id_ip_autorisee`);

--
-- Index pour la table `sous_thematique`
--
ALTER TABLE `sous_thematique`
 ADD PRIMARY KEY (`id_soustheme`,`thematique_id_theme`), ADD KEY `fk_sous_thematique_thematique1_idx` (`thematique_id_theme`);

--
-- Index pour la table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id_tags`);

--
-- Index pour la table `thematique`
--
ALTER TABLE `thematique`
 ADD PRIMARY KEY (`id_theme`);

--
-- Index pour la table `visiteur`
--
ALTER TABLE `visiteur`
 ADD PRIMARY KEY (`id_visiteur`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `carte`
--
ALTER TABLE `carte`
MODIFY `id_carte` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT pour la table `carte_has_format`
--
ALTER TABLE `carte_has_format`
MODIFY `id_format` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=321;
--
-- AUTO_INCREMENT pour la table `carto_session`
--
ALTER TABLE `carto_session`
MODIFY `id_session` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `ip_autorisee`
--
ALTER TABLE `ip_autorisee`
MODIFY `id_ip_autorisee` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=51;
--
-- AUTO_INCREMENT pour la table `sous_thematique`
--
ALTER TABLE `sous_thematique`
MODIFY `id_soustheme` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
--
-- AUTO_INCREMENT pour la table `tags`
--
ALTER TABLE `tags`
MODIFY `id_tags` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=220;
--
-- AUTO_INCREMENT pour la table `thematique`
--
ALTER TABLE `thematique`
MODIFY `id_theme` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT pour la table `visiteur`
--
ALTER TABLE `visiteur`
MODIFY `id_visiteur` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2079;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `carte_has_format`
--
ALTER TABLE `carte_has_format`
ADD CONSTRAINT `fk_carte_has_format_carte1` FOREIGN KEY (`id_carte`) REFERENCES `carte` (`id_carte`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Contraintes pour la table `carte_has_tags`
--
ALTER TABLE `carte_has_tags`
ADD CONSTRAINT `fk_carte_has_tags_carte1` FOREIGN KEY (`id_carte`) REFERENCES `carte` (`id_carte`) ON DELETE NO ACTION ON UPDATE NO ACTION,
ADD CONSTRAINT `fk_carte_has_tags_tags1` FOREIGN KEY (`id_tags`) REFERENCES `tags` (`id_tags`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
