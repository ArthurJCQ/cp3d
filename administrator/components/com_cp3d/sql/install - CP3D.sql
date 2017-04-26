--
-- Base de données :  `cp3d`
--

-- ================== Domaine ANNUAIRE ====================

-- --------------------------------------------------------
--
-- Structure de la table `cp3d_cp3d_pays`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_pays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pays` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_pays`
--

INSERT INTO `cp3d_cp3d_pays` (`id`, `pays`, `published`) VALUES
(1, '-', 1),
(2, 'France', 1),
(3, 'Allemagne', 1),
(4, 'Belgique', 1),
(5, 'Espagne', 1),
(6, 'Italie', 1),
(7, 'Royaume-Uni', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cp3d_cp3d_entreprise`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_entreprise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `raisonSociale` varchar(50) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `numSIRET` varchar(20) NOT NULL,
  `rib` varchar(50) NOT NULL,
  `activite` text,
  `commmentaire` text,
  `logo` varchar(50),
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_entreprise`
--

INSERT INTO `cp3d_cp3d_entreprise` (`id`, `raisonSociale`, `numSIRET`, `rib`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`, `alias`, `activite`, `commmentaire`, `logo`) VALUES
(1, '-', '-', '-', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '', NULL, NULL, NULL),
(2, 'Societe1', 'siret1', '64654654', 1, '0000-00-00 00:00:00', 0, '2016-11-17 16:22:14', 590, 0, 'societe1', 'Lorem ipsum dolor sit amet<', NULL, 'images/cp3d/logos/Logo.png'),
(3, 'Societe2', 'siret2', '3546546546854', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '', NULL, NULL, NULL),
(4, 'Societe3', 'siret3', '5445', 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `cp3d_cp3d_utilisateur`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_utilisateur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `adr_rue` varchar(50) NOT NULL,
  `adr_ville` varchar(50) NOT NULL,
  `adr_CP` varchar(5) NOT NULL,
  `idPays` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dateNaissance` date NOT NULL,
  `idEntreprise` int(11),
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idPays`) REFERENCES `cp3d_cp3d_pays` (`id`),
  FOREIGN KEY (`idEntreprise`) REFERENCES `cp3d_cp3d_entreprise` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_utilisateur`
--

INSERT INTO `cp3d_cp3d_utilisateur` (`id`, `nom`, `prenom`, `alias`, `adr_rue`, `adr_ville`, `adr_CP`, `idPays`, `email`, `dateNaissance`, `idEntreprise`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, 'RAMIREZ', 'Miguel Angel', 'ramirez', '12 Ter Rue des Blagis', 'Bourg La Reine', '92340', 1, 'miguel.rmz.rdz@outlook.com', '1997-01-08', 1, 1, '0000-00-00 00:00:00', 0, '2016-11-17 16:19:03', 590, 0),
(2, 'GONCALVES', 'Florent', '', '123 Champs Elysées', 'Paris', '75001', 1, 'florent.goncalves@gmail.com', '1997-10-19', 1, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0),
(3, 'Pacella', 'Floriann', 'pacella', '', '', '', 1, 'fpacella@gmail.com', '1997-11-15', 1, 1, '2016-11-15 15:46:38', 590, '2016-11-17 13:38:12', 590, 0),
(4, 'Ghorzi-Derrar', 'Mehdi', 'ghorzi-derrar', '', '', '', 1, 'cestmoimehdi@gmail.com', '1996-11-22', 1, 1, '2016-11-15 16:28:39', 590, '2016-11-15 16:28:41', 590, 0);

-- --------------------------------------------------------



-- ================== Domaine CATALOGUE ===================

-- --------------------------------------------------------

--
-- Structure de la table `cp3d_cp3d_etatModele`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_etatModele` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etatModele` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_etatModele`
--

INSERT INTO `cp3d_cp3d_etatModele` (`id`, `etatModele`, `published`) VALUES
(1, '-', 0),
(2, 'En attente', 1),
(3, 'Validé modérateur', 1),
(4, 'Refusé modérateur', 1),
(5, 'Validé directeur artistique', 1),
(6, 'Refusé directeur artistique', 1);

-- --------------------------------------------------------
--
-- Structure de la table `cp3d_cp3d_materiau`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_materiau` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `materiau` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_materiau`
--

INSERT INTO `cp3d_cp3d_materiau` (`id`, `materiau`, `published`) VALUES
(1, '-', 0),
(2, 'ABS', 1),
(3, 'PLA', 1),
(4, 'Polyamide', 1),
(5, 'Polypropylène', 1),
(6, 'Alumide', 1);

-- --------------------------------------------------------
--
-- Structure de la table `cp3d_cp3d_theme`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_theme` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `theme` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_theme`
--

INSERT INTO `cp3d_cp3d_theme` (`id`, `theme`, `published`) VALUES
(1, '-', 0),
(2, 'Art', 1),
(3, 'Bijou', 1),
(4, 'Mode', 1),
(5, 'Maison', 1),
(6, 'Gadget', 1),
(7, 'Jeu', 1);

-- --------------------------------------------------------
--
-- Structure de la table `cp3d_cp3d_modele`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_modele` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `dossierImage` varchar(50) NOT NULL,
  `modele3D` varchar(50) NOT NULL,
  `idEtatModele` int(11) NOT NULL,
  `idTheme` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idEtatModele`) REFERENCES `cp3d_cp3d_etatModele` (`id`),
  FOREIGN KEY (`idTheme`) REFERENCES `cp3d_cp3d_theme` (`id`),
  FOREIGN KEY (`idUtilisateur`) REFERENCES `cp3d_cp3d_utilisateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_modele`
--

INSERT INTO `cp3d_cp3d_modele` (`id`, `nom`, `description`, `dossierImage`, `modele3D`, `idEtatModele`, `idTheme`, `idUtilisateur`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`, `alias`) VALUES
(1, 'Le Cube', 'C''est LE Cube.', 'dossierimage', 'modele', 1, 1, 2, 1, '2016-11-15 00:00:00', 456, '2016-11-29 00:00:00', 456, 0, ''),
(2, 'Le Cylindre', 'C''est LE Cylindre.', 'dossierimage', 'modele', 3, 5, 2, 1, '2016-11-17 00:00:00', 456, '2016-11-25 00:00:00', 456, 19, '');

-- --------------------------------------------------------
--
-- Structure de la table `cp3d_cp3d_typeImpression`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_typeImpression` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `prixUniteHT` decimal(10,2) NOT NULL,
  `retribDesignerHT` decimal(10,2) NOT NULL,
  `idModele` int(11) NOT NULL,
  `idMateriau` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idModele`) REFERENCES `cp3d_cp3d_modele` (`id`),
  FOREIGN KEY (`idMateriau`) REFERENCES `cp3d_cp3d_materiau` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_typeImpression`
--

INSERT INTO `cp3d_cp3d_typeImpression` (`id`, `prixUniteHT`, `retribDesignerHT`, `idModele`, `idMateriau`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`, `alias`) VALUES
(1, '25.00', '10.00', 1, 2, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, ''),
(2, '68.00', '12.00', 1, 4, 1, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, ''),
(3, '68.00', '45.00', 2, 6, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, ''),
(4, '126.00', '98.00', 2, 2, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `cp3d_cp3d_imprimeurTypeImpression`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_imprimeurTypeImpression` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idTypeImpression` int(11) NOT NULL,
  `idEntreprise` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idTypeImpression`) REFERENCES `cp3d_cp3d_typeImpression` (`id`),
  FOREIGN KEY (`idEntreprise`) REFERENCES `cp3d_cp3d_entreprise` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------



-- ================== Domaine COMMANDE ====================

-- --------------------------------------------------------
--
-- Structure de la table `cp3d_cp3d_etatCommande`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_etatCommande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat` varchar(50) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_etatCommande`
--

INSERT INTO `cp3d_cp3d_etatCommande` (`id`, `etat`, `published`) VALUES
(1, '-', 0),
(2, 'En préparation', 1),
(3, 'Validée Client', 1),
(4, 'Paiement en attente', 1),
(5, 'Validée Imprimeur', 1),
(6, 'Produite', 1),
(7, 'Expédiée', 1),
(8, 'Réception refusée', 1),
(9, 'Réception acceptée', 1);

-- --------------------------------------------------------

--
-- Structure de la table `cp3d_cp3d_commande`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_commande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `numCommande` varchar(50),
  `dateCommande` date NOT NULL,
  `prixTotalHT` decimal(10,2) NOT NULL,
  `prixTotalTTC` decimal(10,2) NOT NULL,
  `tva` int(11) NOT NULL,
  `idEtatCommande` int(11) NOT NULL,
  `idUtilisateur` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idEtatCommande`) REFERENCES `cp3d_cp3d_etatCommande` (`id`),
  FOREIGN KEY (`idUtilisateur`) REFERENCES `cp3d_cp3d_utilisateur` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_commande`
--

INSERT INTO `cp3d_cp3d_commande` (`id`, `alias`, `dateCommande`, `prixTotalHT`, `prixTotalTTC`, `tva`, `idEtatCommande`, `idUtilisateur`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, '', '2003-01-22', '13.00', '17.20', 20, 2, 1, 1, '2003-01-22 00:00:00', 0, '2016-11-17 16:37:35', 917, 0),
(2, 'CDE2016-11-21_1', '2016-11-02', '100.20', '120.20', 18, 2, 1, 1, '2016-11-08 00:00:00', 0, '2016-11-10 00:00:00', 0, 0),
(3, 'CDE2016-11-21_2', '2016-11-13', '42.00', '65.00', 18, 2, 1, 1, '2016-11-23 00:00:00', 0, '2016-11-25 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `cp3d_cp3d_ligneCommande`
--

CREATE TABLE IF NOT EXISTS `cp3d_cp3d_ligneCommande` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `quantite` int(11) NOT NULL,
  `dateProduction` date NOT NULL,
  `note` int(11),
  `commentaire` text NOT NULL,
  `dateAvis` date NOT NULL,
  `idTypeImpression` int(11) NOT NULL,
  `idCommande` int(11) NOT NULL,
  `idEntreprise` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `hits` int(11) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  FOREIGN KEY (`idTypeImpression`) REFERENCES `cp3d_cp3d_typeImpression` (`id`),
  FOREIGN KEY (`idCommande`) REFERENCES `cp3d_cp3d_commande` (`id`),
  FOREIGN KEY (`idEntreprise`) REFERENCES `cp3d_cp3d_entreprise` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `cp3d_cp3d_ligneCommande`
--

INSERT INTO `cp3d_cp3d_ligneCommande` (`id`, `alias`, `quantite`, `dateProduction`, `note`, `commentaire`, `dateAvis`, `idTypeImpression`, `idCommande`, `idEntreprise`, `published`, `created`, `created_by`, `modified`, `modified_by`, `hits`) VALUES
(1, '', 2, '0000-00-00', NULL, 'Bien', '0000-00-00', 1, 1, 1, 1, '2003-01-22 00:00:00', 0, '2003-01-22 00:00:00', 0, 0),
(2, '', 2, '0000-00-00', NULL, 'Pas Bien', '0000-00-00', 2, 1, 1, 1, '2003-01-22 00:00:00', 0, '2003-01-22 00:00:00', 0, 0),
(3, '', 2, '0000-00-00', NULL, 'Pas mal', '0000-00-00', 3, 1, 2, 1, '2003-01-22 00:00:00', 0, '2003-01-22 00:00:00', 0, 0);
