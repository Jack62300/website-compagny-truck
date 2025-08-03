-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3307
-- Généré le : dim. 21 jan. 2024 à 14:25
-- Version du serveur : 10.10.2-MariaDB
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `twvparkv2`
--

-- --------------------------------------------------------

--
-- Structure de la table `consigne`
--

DROP TABLE IF EXISTS `consigne`;
CREATE TABLE IF NOT EXISTS `consigne` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `status` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL COMMENT '(DC2Type:json)' CHECK (json_valid(`status`)),
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `consigne`
--

INSERT INTO `consigne` (`id`, `name`, `status`, `title`, `content`, `created_at`) VALUES
(1, 'Benoit Delobel', '[\"PRIORITAIRE\",\"URGENT\"]', 'Test des consignes en base de données', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ultricies ut sapien sed pharetra. Proin nec enim at turpis rutrum pulvinar id laoreet lectus. Donec congue sollicitudin ipsum, et blandit urna accumsan sollicitudin. Nunc ullamcorper elit nec ligula efficitur luctus consequat sit amet purus. Sed hendrerit, ipsum vitae placerat lobortis, velit metus vulputate erat, nec feugiat purus sapien eget mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque mollis metus ut ipsum vehicula elementum. Vivamus sagittis eleifend felis, mattis consequat diam.\r\n\r\nDuis placerat est quam, ut posuere enim congue sit amet. Suspendisse pulvinar felis eu lorem pellentesque, et aliquam massa lobortis. Aliquam nec eros ipsum. Nunc vitae congue risus, nec consectetur lacus. Quisque vestibulum tortor nec lectus rhoncus, eget dapibus orci volutpat. Phasellus eu elit ac sem porttitor lacinia sed eu dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Integer pellentesque id ante in tincidunt. Praesent euismod justo nec elementum placerat.', '2024-01-21 14:45:44');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
