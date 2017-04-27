-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 27 Avril 2017 à 15:07
-- Version du serveur :  10.1.9-MariaDB
-- Version de PHP :  5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `cp3d`
--

-- --------------------------------------------------------

--
-- Structure de la vue `cp3d_vue_modeles`
--

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `cp3d_vue_modeles`  AS  select `m`.`id` AS `id`,`m`.`nom` AS `nom`,`t`.`theme` AS `theme`,`u`.`nom` AS `designer`,`m`.`description` AS `description` from ((`cp3d_cp3d_modele` `m` join `cp3d_cp3d_utilisateur` `u` on((`u`.`id` = `m`.`idUtilisateur`))) join `cp3d_cp3d_theme` `t` on((`t`.`id` = `m`.`idTheme`))) where (`m`.`idEtatModele` = 3) order by `m`.`id` ;

--
-- VIEW  `cp3d_vue_modeles`
-- Données :  Aucune
--


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
