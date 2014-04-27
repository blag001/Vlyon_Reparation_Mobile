-- phpMyAdmin SQL Dump
-- version 4.0.9
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 17 Avril 2014 à 02:20
-- Version du serveur: 5.5.34
-- Version de PHP: 5.4.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `sio_reparation`
--

-- --------------------------------------------------------

--
-- Structure de la table `boninterv`
--

CREATE TABLE IF NOT EXISTS `boninterv` (
  `BI_Num` int(11) NOT NULL AUTO_INCREMENT,
  `BI_Velo` int(11) NOT NULL,
  `BI_DatDebut` date DEFAULT NULL,
  `BI_DatFin` date DEFAULT NULL,
  `BI_CpteRendu` varchar(100) DEFAULT NULL,
  `BI_Reparable` tinyint(1) DEFAULT NULL,
  `BI_Demande` int(11) DEFAULT NULL,
  `BI_Technicien` int(11) NOT NULL,
  `BI_SurPlace` tinyint(1) DEFAULT NULL,
  `BI_Duree` decimal(5,0) DEFAULT NULL,
  PRIMARY KEY (`BI_Num`),
  KEY `CONCERNER_FK` (`BI_Velo`),
  KEY `EXECUTER_FK2` (`BI_Demande`),
  KEY `realiser_FK` (`BI_Technicien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `demandeinter`
--

CREATE TABLE IF NOT EXISTS `demandeinter` (
  `DemI_Num` int(11) NOT NULL AUTO_INCREMENT,
  `DemI_Velo` int(11) NOT NULL,
  `DemI_Date` date DEFAULT NULL,
  `DemI_Technicien` int(11) NOT NULL,
  `DemI_Motif` varchar(50) DEFAULT NULL,
  `DemI_Traite` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`DemI_Num`),
  KEY `CORRESPONDRE_FK` (`DemI_Velo`),
  KEY `rediger_FK` (`DemI_Technicien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE IF NOT EXISTS `etat` (
  `Eta_Code` int(11) NOT NULL AUTO_INCREMENT,
  `Eta_Libelle` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`Eta_Code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

CREATE TABLE IF NOT EXISTS `produit` (
  `Pdt_Code` char(6) NOT NULL,
  `Pdt_Libelle` varchar(30) DEFAULT NULL,
  `Pdt_Poids` decimal(10,0) DEFAULT NULL,
  `Pdt_PxCMUP` decimal(6,2) DEFAULT NULL,
  `Pdt_QteStk` decimal(10,0) DEFAULT NULL,
  `Pdt_NbVols` decimal(5,0) DEFAULT NULL,
  `Pdt_NbCasses` decimal(5,0) DEFAULT NULL,
  PRIMARY KEY (`Pdt_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `station`
--

CREATE TABLE IF NOT EXISTS `station` (
  `Sta_Code` char(5) NOT NULL,
  `Sta_Nom` varchar(30) DEFAULT NULL,
  `Sta_Rue` varchar(50) DEFAULT NULL,
  `Sta_NbAttaches` decimal(2,0) DEFAULT NULL,
  `Sta_NbVelos` decimal(2,0) DEFAULT NULL,
  `Sta_NbAttacDispo` decimal(2,0) DEFAULT NULL,
  `Sta_NbTotLoc` decimal(10,0) DEFAULT NULL,
  `Sta_NbVols` decimal(5,0) DEFAULT NULL,
  `Sta_NbDegrad` decimal(5,0) DEFAULT NULL,
  PRIMARY KEY (`Sta_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `technicien`
--

CREATE TABLE IF NOT EXISTS `technicien` (
  `Tec_Matricule` int(11) NOT NULL AUTO_INCREMENT,
  `Tec_Nom` varchar(35) DEFAULT NULL,
  `Tec_Prenom` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`Tec_Matricule`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `Use_Num` int(11) NOT NULL AUTO_INCREMENT,
  `Use_Nom` varchar(50) NOT NULL,
  `Use_Hash` char(128) NOT NULL,
  `Use_RespAchat` tinyint(1) DEFAULT NULL,
  `Use_Technicien` int(11) DEFAULT NULL,
  PRIMARY KEY (`Use_Num`),
  KEY `HASH_FK` (`Use_Hash`),
  KEY `FK_USER_TECHNICIEN` (`Use_Technicien`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

-- --------------------------------------------------------

--
-- Structure de la table `velo`
--

CREATE TABLE IF NOT EXISTS `velo` (
  `Vel_Num` int(11) NOT NULL AUTO_INCREMENT,
  `Vel_Station` char(5) DEFAULT NULL,
  `Vel_Etat` int(11) NOT NULL,
  `Vel_Type` char(6) NOT NULL,
  `Vel_Accessoire` varchar(20) DEFAULT NULL,
  `Vel_Casse` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`Vel_Num`),
  KEY `POSITIONNER_FK` (`Vel_Station`),
  KEY `AVOIR_FK` (`Vel_Etat`),
  KEY `appartenir_FK` (`Vel_Type`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `boninterv`
--
ALTER TABLE `boninterv`
  ADD CONSTRAINT `FK_BONINTERV_DEMANDEINTER` FOREIGN KEY (`BI_Demande`) REFERENCES `demandeinter` (`DemI_Num`),
  ADD CONSTRAINT `FK_BONINTERV_TECHNICIEN` FOREIGN KEY (`BI_Technicien`) REFERENCES `technicien` (`Tec_Matricule`),
  ADD CONSTRAINT `FK_BONINTERV_VELO` FOREIGN KEY (`BI_Velo`) REFERENCES `velo` (`Vel_Num`);

--
-- Contraintes pour la table `demandeinter`
--
ALTER TABLE `demandeinter`
  ADD CONSTRAINT `FK_DEMANDEINTER_TECHNICIEN` FOREIGN KEY (`DemI_Technicien`) REFERENCES `technicien` (`Tec_Matricule`),
  ADD CONSTRAINT `FK_DEMANDEINTER_VELO` FOREIGN KEY (`DemI_Velo`) REFERENCES `velo` (`Vel_Num`);

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `FK_USER_TECHNICIEN` FOREIGN KEY (`Use_Technicien`) REFERENCES `technicien` (`Tec_Matricule`);

--
-- Contraintes pour la table `velo`
--
ALTER TABLE `velo`
  ADD CONSTRAINT `FK_VELO_PRODUIT` FOREIGN KEY (`Vel_Type`) REFERENCES `produit` (`Pdt_Code`),
  ADD CONSTRAINT `FK_VELO_ETAT` FOREIGN KEY (`Vel_Etat`) REFERENCES `etat` (`Eta_Code`),
  ADD CONSTRAINT `FK_VELO_STATION` FOREIGN KEY (`Vel_Station`) REFERENCES `station` (`Sta_Code`);
