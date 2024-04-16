-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : mar. 16 avr. 2024 à 21:34
-- Version du serveur : 8.0.36-0ubuntu0.22.04.1
-- Version de PHP : 8.1.2-1ubuntu2.14
DROP DATABASE IF EXISTS `lukyssbook`;
CREATE DATABASE `lukyssbook`;
USE `lukyssbook`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `LukyssBook`
--

-- --------------------------------------------------------

--
-- Structure de la table `Ajouter`
--

CREATE TABLE `Ajouter` (
  `usr_id` int NOT NULL,
  `usr_id_1` int NOT NULL,
  `ajouter_date` date DEFAULT NULL,
  `ajouter_state` int NOT NULL DEFAULT '0',
  `ajouter_state_date` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Ajouter`
--

INSERT INTO `Ajouter` (`usr_id`, `usr_id_1`, `ajouter_date`, `ajouter_state`, `ajouter_state_date`) VALUES
(8, 9, '2023-09-18', 0, NULL),
(8, 10, '2023-08-08', 1, '2023-09-06 10:11:26'),
(8, 12, '2023-09-21', 1, '2023-09-21 11:46:57'),
(10, 9, '2023-08-08', 1, '2023-08-08 17:02:51'),
(11, 8, '2023-09-21', 1, '2023-09-21 11:46:32'),
(13, 8, '2023-09-21', 1, '2023-09-21 15:17:33'),
(14, 8, '2023-09-21', 1, '2023-09-21 15:25:14'),
(14, 12, '2023-09-21', 0, NULL),
(15, 8, '2023-09-21', 1, '2023-09-21 15:46:22'),
(16, 8, '2023-09-21', 0, NULL),
(16, 12, '2023-09-21', 0, NULL),
(16, 15, '2023-09-21', 0, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `Apropos`
--

CREATE TABLE `Apropos` (
  `apropos_id` int NOT NULL,
  `apropos_contenu` text,
  `apropos_type` varchar(50) DEFAULT NULL,
  `usr_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Apropos`
--

INSERT INTO `Apropos` (`apropos_id`, `apropos_contenu`, `apropos_type`, `usr_id`) VALUES
(24, '{\"relation\":\"celibataire\"}', 'relation', 8),
(25, '{\"date_debut\":\"2023\",\"date_fin\":\"maintenant\",\"intitule\":\"red\",\"ville\":\"rsvd\",\"etablissement\":\"sd\"}', 'etude', 8),
(26, '{\"date_debut\":\"2023\",\"date_fin\":\"maintenant\",\"intitule\":\"Test\",\"ville\":\"Reims\",\"etablissement\":\"GRETA\"}', 'travail', 8);

-- --------------------------------------------------------

--
-- Structure de la table `Commentaire`
--

CREATE TABLE `Commentaire` (
  `commentaire_id` int NOT NULL,
  `commentaire_contenu` text,
  `commentaire_date` text,
  `commentaire_visibility` int NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Commentaire`
--

INSERT INTO `Commentaire` (`commentaire_id`, `commentaire_contenu`, `commentaire_date`, `commentaire_visibility`, `post_id`) VALUES
(6, 'contenu supprimé', '2023-08-18 03:43:10', 4, 8),
(11, 'contenu supprimé', '2023-08-23 11:55:26', 4, 8),
(12, 'contenu supprimé', '2023-08-23 12:02:36', 4, 8),
(13, 'contenu supprimé', '2023-08-23 02:10:22', 4, 8),
(14, 'contenu supprimé', '2023-08-23 02:10:50', 4, 8),
(15, 'contenu supprimé', '2023-08-23 02:11:46', 4, 8),
(16, 'contenu supprimé', '2023-08-23 02:12:25', 4, 8),
(17, 'contenu supprimé', '2023-08-23 02:13:08', 4, 8),
(18, 'contenu supprimé', '2023-08-23 02:14:57', 4, 8),
(19, 'Test edition commentaire numéro  9', '2023-08-23 02:30:26', 3, 8),
(20, 'test commentaire', '2023-08-23 02:35:31', 3, 8),
(21, 'contenu supprimé', '2023-08-23 02:39:18', 4, 8),
(22, 'contenu supprimé', '2023-08-23 02:39:40', 4, 8),
(23, 'contenu supprimé', '2023-08-23 02:39:43', 4, 8),
(24, 'test', '2023-08-23 02:41:27', 3, 8),
(25, 'yolo', '2023-08-23 02:43:19', 3, 8),
(26, 'yola', '2023-08-23 02:43:26', 3, 8),
(27, 'Alors c\'est qui le patron?', '2023-08-23 02:45:45', 3, 8),
(28, 'test val', '2023-08-23 02:47:06', 3, 8),
(29, 'test', '2023-08-23 02:48:21', 3, 8),
(30, 'test', '2023-08-23 02:49:32', 3, 8),
(31, 'testoss', '2023-08-23 02:53:25', 3, 8),
(32, 'testoss', '2023-08-23 02:53:50', 3, 8),
(33, '1', '2023-08-24 09:14:45', 3, 8),
(34, '2', '2023-08-24 09:14:49', 3, 8),
(35, '3', '2023-08-24 09:14:52', 3, 8),
(36, '4', '2023-08-24 09:14:55', 3, 8),
(37, '5', '2023-08-24 09:14:58', 3, 8),
(38, '6', '2023-08-24 09:15:01', 3, 8),
(39, '7', '2023-08-24 09:15:04', 3, 8),
(40, '8', '2023-08-24 09:15:07', 3, 8),
(41, '9', '2023-08-24 09:15:11', 3, 8),
(42, '10', '2023-08-24 09:15:15', 3, 8),
(43, '11', '2023-08-24 09:15:18', 3, 8),
(44, '12', '2023-08-24 09:15:21', 3, 8),
(45, '13', '2023-08-24 09:15:24', 3, 8),
(46, '14', '2023-08-24 09:15:27', 3, 8),
(47, '15', '2023-08-24 09:15:30', 3, 8),
(48, '16', '2023-08-24 09:15:33', 3, 8),
(49, '17', '2023-08-24 09:15:36', 3, 8),
(50, '18', '2023-08-24 09:15:39', 3, 8),
(51, '19', '2023-08-24 09:15:42', 3, 8),
(52, '20', '2023-08-24 09:15:46', 3, 8),
(53, 'Je sais compter jusque 20 !', '2023-08-24 09:15:56', 3, 8),
(54, 'Test nouveau controller commenter/index', '2023-08-25 10:47:02', 3, 8),
(55, 'test new controlleur again 1', '2023-08-25 11:00:59', 3, 8),
(62, 'contenu supprimé', '2023-08-25 11:09:28', 4, 8),
(63, 'test nouveau controleur 3', '2023-08-25 11:12:56', 3, 8),
(64, 'Test\ntest\ntest', '2023-08-25 11:22:50', 3, 8),
(65, 'TEst\ntest', '2023-08-25 11:26:18', 3, 8),
(66, 'test', '2023-08-25 11:49:33', 3, 8),
(67, 'test', '2023-08-25 11:49:33', 3, 8),
(68, 'test', '2023-08-25 11:49:33', 3, 8),
(69, 'test', '2023-08-25 11:49:33', 3, 8),
(70, 'test', '2023-08-25 11:49:33', 3, 8),
(71, 'test', '2023-08-25 11:49:33', 3, 8),
(72, 'test', '2023-08-25 11:49:33', 3, 8),
(73, 'test', '2023-08-25 11:50:08', 3, 8),
(74, 'test bug multiple envois', '2023-08-25 11:50:49', 3, 8),
(75, 'test bug multiple envois', '2023-08-25 11:50:49', 3, 8),
(76, 'test bug multiple envois', '2023-08-25 11:50:49', 3, 8),
(77, 'test bug multiple envois', '2023-08-25 11:50:49', 3, 8),
(78, 'test bug multiple envois', '2023-08-25 11:50:49', 3, 8),
(79, 'u,nybgfv', '2023-08-25 12:02:03', 3, 8),
(80, 'Test Response to respsonse 1', '2023-08-28 10:07:05', 3, 8),
(81, 'test response to response 2', '2023-08-28 11:32:30', 3, 8),
(82, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(83, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(84, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(85, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(86, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(87, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(88, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(89, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(90, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(91, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(92, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(93, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(94, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(95, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(96, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(97, 'test response to response 3', '2023-08-28 11:36:54', 3, 8),
(98, 'test response to response 4', '2023-08-28 11:41:44', 3, 8),
(99, 'ah mince', '2023-09-07 11:54:28', 3, 9),
(100, 'contenu supprimé', '2023-09-15 09:54:05', 4, 12),
(101, 'Réponse', '2023-09-15 10:04:09', 3, 12),
(102, 'contenu supprimé', '2023-09-15 10:17:45', 4, 12),
(103, 'contenu supprimé', '2023-09-15 10:28:21', 4, 12),
(104, 'test', '2023-09-16 13:01:58', 3, 13),
(105, 'Toujours même mdr', '2023-09-21 11:52:19', 3, 16),
(106, 'non t\'es pas le first mdr', '2023-09-21 15:49:34', 3, 19),
(107, 'Le tout n\'est pas d\'être le premier mais le meilleurs', '2023-09-21 16:14:30', 3, 19),
(108, 'térone ;)', '2023-09-21 16:14:56', 3, 8);

-- --------------------------------------------------------

--
-- Structure de la table `commenter`
--

CREATE TABLE `commenter` (
  `usr_id` int NOT NULL,
  `commentaire_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commenter`
--

INSERT INTO `commenter` (`usr_id`, `commentaire_id`) VALUES
(8, 6),
(8, 11),
(8, 12),
(8, 13),
(8, 14),
(8, 15),
(8, 16),
(8, 17),
(8, 18),
(8, 19),
(8, 20),
(8, 21),
(8, 22),
(8, 23),
(8, 24),
(8, 25),
(8, 26),
(8, 27),
(8, 28),
(8, 29),
(8, 30),
(8, 31),
(8, 32),
(8, 33),
(8, 34),
(8, 35),
(8, 36),
(8, 37),
(8, 38),
(8, 39),
(8, 40),
(8, 41),
(8, 42),
(8, 43),
(8, 44),
(8, 45),
(8, 46),
(8, 47),
(8, 48),
(8, 49),
(8, 50),
(8, 51),
(8, 52),
(8, 53),
(8, 54),
(8, 55),
(8, 62),
(8, 63),
(8, 64),
(8, 65),
(8, 66),
(8, 67),
(8, 68),
(8, 69),
(8, 70),
(8, 71),
(8, 72),
(8, 73),
(8, 74),
(8, 75),
(8, 76),
(8, 77),
(8, 78),
(8, 79),
(8, 80),
(8, 81),
(8, 82),
(8, 83),
(8, 84),
(8, 85),
(8, 86),
(8, 87),
(8, 88),
(8, 89),
(8, 90),
(8, 91),
(8, 92),
(8, 93),
(8, 94),
(8, 95),
(8, 96),
(8, 97),
(8, 98),
(8, 99),
(8, 100),
(8, 101),
(8, 102),
(8, 103),
(8, 104),
(8, 105),
(8, 106),
(16, 107),
(16, 108);

-- --------------------------------------------------------

--
-- Structure de la table `commenter_commentaire`
--

CREATE TABLE `commenter_commentaire` (
  `commentaire_id` int NOT NULL,
  `commentaire_id_response` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `commenter_commentaire`
--

INSERT INTO `commenter_commentaire` (`commentaire_id`, `commentaire_id_response`) VALUES
(19, 62),
(19, 63),
(19, 66),
(19, 67),
(19, 68),
(19, 69),
(19, 70),
(19, 71),
(19, 72),
(19, 73),
(19, 74),
(19, 75),
(19, 76),
(19, 77),
(19, 78),
(19, 79),
(62, 80),
(19, 81),
(19, 82),
(19, 83),
(19, 84),
(19, 85),
(19, 86),
(19, 87),
(19, 88),
(19, 89),
(19, 90),
(19, 91),
(19, 92),
(19, 93),
(19, 94),
(19, 95),
(19, 96),
(19, 97),
(19, 98),
(100, 101),
(100, 102),
(100, 103),
(106, 107),
(32, 108);

-- --------------------------------------------------------

--
-- Structure de la table `Conversation`
--

CREATE TABLE `Conversation` (
  `conversation_id` int NOT NULL,
  `conversation_name` varchar(50) DEFAULT NULL,
  `conversation_image_conversation` varchar(100) DEFAULT NULL,
  `conversation_date_creation` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Conversation`
--

INSERT INTO `Conversation` (`conversation_id`, `conversation_name`, `conversation_image_conversation`, `conversation_date_creation`) VALUES
(3, '', NULL, '2023-09-05 10:15:03'),
(4, '', NULL, '2023-09-05 11:23:28'),
(5, '', NULL, '2023-09-08 14:42:29'),
(6, '', NULL, '2023-09-15 14:50:11'),
(7, '', NULL, '2023-09-15 14:50:13'),
(8, '', NULL, '2023-09-21 11:48:43'),
(9, '', NULL, '2023-09-21 15:46:43'),
(10, '', NULL, '2023-09-21 16:16:26');

-- --------------------------------------------------------

--
-- Structure de la table `Evenement_commentaire`
--

CREATE TABLE `Evenement_commentaire` (
  `evenement_c_id` int NOT NULL,
  `evenement_c_type` varchar(50) DEFAULT NULL,
  `evenement_c_date` datetime DEFAULT NULL,
  `usr_id` int NOT NULL,
  `commentaire_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Evenement_commentaire`
--

INSERT INTO `Evenement_commentaire` (`evenement_c_id`, `evenement_c_type`, `evenement_c_date`, `usr_id`, `commentaire_id`) VALUES
(33, 'like', '2023-08-23 10:19:35', 8, 6),
(35, 'delete', '2023-08-23 11:55:30', 8, 11),
(36, 'delete', '2023-08-23 12:02:40', 8, 12),
(37, 'delete', '2023-08-23 14:06:07', 8, 6),
(38, 'delete', '2023-08-23 14:10:25', 8, 13),
(39, 'delete', '2023-08-23 14:10:53', 8, 14),
(40, 'delete', '2023-08-23 14:11:48', 8, 15),
(41, 'delete', '2023-08-23 14:12:28', 8, 16),
(42, 'delete', '2023-08-23 14:13:10', 8, 17),
(43, 'delete', '2023-08-23 14:14:59', 8, 18),
(47, 'delete', '2023-08-23 14:52:37', 8, 21),
(48, 'like', '2023-08-23 14:52:41', 8, 22),
(49, 'delete', '2023-08-23 14:52:42', 8, 22),
(51, 'like', '2023-08-24 11:45:03', 8, 19),
(52, 'delete', '2023-08-24 11:55:49', 8, 23),
(59, 'commentaire_response', '2023-08-25 11:09:29', 8, 19),
(60, 'commentaire_response', '2023-08-25 11:12:56', 8, 19),
(61, 'commentaire_response', '2023-08-25 11:49:33', 8, 19),
(62, 'commentaire_response', '2023-08-25 11:49:33', 8, 19),
(63, 'commentaire_response', '2023-08-25 11:49:33', 8, 19),
(64, 'commentaire_response', '2023-08-25 11:49:33', 8, 19),
(65, 'commentaire_response', '2023-08-25 11:49:33', 8, 19),
(66, 'commentaire_response', '2023-08-25 11:49:33', 8, 19),
(67, 'commentaire_response', '2023-08-25 11:49:33', 8, 19),
(68, 'commentaire_response', '2023-08-25 11:50:08', 8, 19),
(69, 'commentaire_response', '2023-08-25 11:50:49', 8, 19),
(70, 'commentaire_response', '2023-08-25 11:50:49', 8, 19),
(71, 'commentaire_response', '2023-08-25 11:50:49', 8, 19),
(72, 'commentaire_response', '2023-08-25 11:50:49', 8, 19),
(73, 'commentaire_response', '2023-08-25 11:50:49', 8, 19),
(74, 'commentaire_response', '2023-08-25 12:02:03', 8, 19),
(77, 'like', '2023-08-25 15:30:49', 8, 62),
(78, 'commentaire_response', '2023-08-28 10:07:05', 8, 62),
(79, 'commentaire_response', '2023-08-28 11:32:30', 8, 19),
(80, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(81, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(82, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(83, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(84, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(85, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(86, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(87, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(88, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(89, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(90, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(91, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(92, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(93, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(94, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(95, 'commentaire_response', '2023-08-28 11:36:54', 8, 19),
(96, 'commentaire_response', '2023-08-28 11:41:44', 8, 19),
(98, 'delete', '2023-09-05 11:36:53', 8, 62),
(99, 'like', '2023-09-07 11:54:45', 8, 99),
(100, 'commentaire_response', '2023-09-15 10:04:09', 8, 100),
(101, 'commentaire_response', '2023-09-15 10:17:45', 8, 100),
(102, 'delete', '2023-09-15 10:26:00', 8, 102),
(103, 'commentaire_response', '2023-09-15 10:28:21', 8, 100),
(104, 'delete', '2023-09-15 10:28:39', 8, 103),
(105, 'delete', '2023-09-15 10:32:46', 8, 100),
(106, 'like', '2023-09-21 16:13:31', 16, 106),
(107, 'commentaire_response', '2023-09-21 16:14:30', 16, 106),
(108, 'like', '2023-09-21 16:14:40', 16, 27),
(109, 'commentaire_response', '2023-09-21 16:14:56', 16, 32);

-- --------------------------------------------------------

--
-- Structure de la table `Evenement_Post`
--

CREATE TABLE `Evenement_Post` (
  `evenement_p_id` int NOT NULL,
  `evenement_p_type` varchar(50) DEFAULT NULL,
  `evenement_p_date` datetime DEFAULT NULL,
  `usr_id` int NOT NULL,
  `post_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Evenement_Post`
--

INSERT INTO `Evenement_Post` (`evenement_p_id`, `evenement_p_type`, `evenement_p_date`, `usr_id`, `post_id`) VALUES
(50, 'like', '2023-08-17 14:20:34', 9, 6),
(51, 'like', '2023-08-17 14:20:35', 9, 7),
(53, 'like', '2023-08-17 14:30:05', 9, 9),
(71, 'like', '2023-08-17 15:01:33', 8, 6),
(79, 'commentaire', '2023-08-18 03:43:10', 8, 8),
(80, 'commentaire', '2023-08-18 03:47:38', 8, 8),
(86, 'like', '2023-08-23 10:16:35', 8, 7),
(87, 'commentaire', '2023-08-23 11:09:57', 8, 8),
(88, 'commentaire', '2023-08-23 11:10:04', 8, 8),
(89, 'commentaire', '2023-08-23 11:10:10', 8, 8),
(90, 'commentaire', '2023-08-23 11:55:26', 8, 8),
(91, 'commentaire', '2023-08-23 12:02:36', 8, 8),
(92, 'commentaire', '2023-08-23 02:10:22', 8, 8),
(93, 'commentaire', '2023-08-23 02:10:50', 8, 8),
(94, 'commentaire', '2023-08-23 02:11:46', 8, 8),
(95, 'commentaire', '2023-08-23 02:12:25', 8, 8),
(96, 'commentaire', '2023-08-23 02:13:08', 8, 8),
(97, 'commentaire', '2023-08-23 02:14:57', 8, 8),
(98, 'commentaire', '2023-08-23 02:30:26', 8, 8),
(99, 'commentaire', '2023-08-23 02:35:31', 8, 8),
(100, 'commentaire', '2023-08-23 02:39:18', 8, 8),
(101, 'commentaire', '2023-08-23 02:39:40', 8, 8),
(102, 'commentaire', '2023-08-23 02:39:43', 8, 8),
(103, 'commentaire', '2023-08-23 02:41:27', 8, 8),
(104, 'commentaire', '2023-08-23 02:43:19', 8, 8),
(105, 'commentaire', '2023-08-23 02:43:26', 8, 8),
(106, 'commentaire', '2023-08-23 02:45:45', 8, 8),
(107, 'commentaire', '2023-08-23 02:47:06', 8, 8),
(108, 'commentaire', '2023-08-23 02:48:21', 8, 8),
(109, 'commentaire', '2023-08-23 02:49:32', 8, 8),
(110, 'commentaire', '2023-08-23 02:53:25', 8, 8),
(111, 'commentaire', '2023-08-23 02:53:50', 8, 8),
(112, 'commentaire', '2023-08-24 09:14:45', 8, 8),
(113, 'commentaire', '2023-08-24 09:14:49', 8, 8),
(114, 'commentaire', '2023-08-24 09:14:52', 8, 8),
(115, 'commentaire', '2023-08-24 09:14:55', 8, 8),
(116, 'commentaire', '2023-08-24 09:14:58', 8, 8),
(117, 'commentaire', '2023-08-24 09:15:01', 8, 8),
(118, 'commentaire', '2023-08-24 09:15:04', 8, 8),
(119, 'commentaire', '2023-08-24 09:15:07', 8, 8),
(120, 'commentaire', '2023-08-24 09:15:11', 8, 8),
(121, 'commentaire', '2023-08-24 09:15:15', 8, 8),
(122, 'commentaire', '2023-08-24 09:15:18', 8, 8),
(123, 'commentaire', '2023-08-24 09:15:21', 8, 8),
(124, 'commentaire', '2023-08-24 09:15:24', 8, 8),
(125, 'commentaire', '2023-08-24 09:15:27', 8, 8),
(126, 'commentaire', '2023-08-24 09:15:30', 8, 8),
(127, 'commentaire', '2023-08-24 09:15:33', 8, 8),
(128, 'commentaire', '2023-08-24 09:15:36', 8, 8),
(129, 'commentaire', '2023-08-24 09:15:39', 8, 8),
(130, 'commentaire', '2023-08-24 09:15:42', 8, 8),
(131, 'commentaire', '2023-08-24 09:15:46', 8, 8),
(132, 'commentaire', '2023-08-24 09:15:56', 8, 8),
(133, 'commentaire', '2023-08-25 10:47:02', 8, 8),
(134, 'commentaire', '2023-08-25 11:00:59', 8, 8),
(135, 'commentaire', '2023-08-25 11:03:36', 8, 8),
(136, 'commentaire', '2023-08-25 11:05:41', 8, 8),
(137, 'commentaire', '2023-08-25 11:05:41', 8, 8),
(138, 'commentaire', '2023-08-25 11:05:41', 8, 8),
(139, 'commentaire', '2023-08-25 11:05:41', 8, 8),
(140, 'commentaire', '2023-08-25 11:05:41', 8, 8),
(141, 'commentaire', '2023-08-25 11:09:29', 8, 8),
(142, 'commentaire', '2023-08-25 11:12:56', 8, 8),
(143, 'commentaire', '2023-08-25 11:22:51', 8, 8),
(144, 'commentaire', '2023-08-25 11:26:18', 8, 8),
(145, 'commentaire', '2023-08-25 11:49:33', 8, 8),
(146, 'commentaire', '2023-08-25 11:49:33', 8, 8),
(147, 'commentaire', '2023-08-25 11:49:33', 8, 8),
(148, 'commentaire', '2023-08-25 11:49:33', 8, 8),
(149, 'commentaire', '2023-08-25 11:49:33', 8, 8),
(150, 'commentaire', '2023-08-25 11:49:33', 8, 8),
(151, 'commentaire', '2023-08-25 11:49:33', 8, 8),
(152, 'commentaire', '2023-08-25 11:50:08', 8, 8),
(153, 'commentaire', '2023-08-25 11:50:49', 8, 8),
(154, 'commentaire', '2023-08-25 11:50:49', 8, 8),
(155, 'commentaire', '2023-08-25 11:50:49', 8, 8),
(156, 'commentaire', '2023-08-25 11:50:49', 8, 8),
(157, 'commentaire', '2023-08-25 11:50:49', 8, 8),
(158, 'commentaire', '2023-08-25 12:02:03', 8, 8),
(159, 'commentaire', '2023-08-28 10:07:05', 8, 8),
(160, 'commentaire', '2023-08-28 11:32:30', 8, 8),
(161, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(162, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(163, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(164, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(165, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(166, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(167, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(168, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(169, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(170, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(171, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(172, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(173, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(174, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(175, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(176, 'commentaire', '2023-08-28 11:36:54', 8, 8),
(177, 'commentaire', '2023-08-28 11:41:44', 8, 8),
(185, 'commentaire', '2023-09-07 11:54:28', 8, 9),
(187, 'like', '2023-09-07 11:54:51', 8, 9),
(190, 'like', '2023-09-07 12:09:48', 8, 8),
(193, 'like', '2023-09-15 09:45:07', 8, 12),
(194, 'commentaire', '2023-09-15 09:54:05', 8, 12),
(195, 'commentaire', '2023-09-15 10:04:09', 8, 12),
(196, 'commentaire', '2023-09-15 10:17:45', 8, 12),
(197, 'commentaire', '2023-09-15 10:28:21', 8, 12),
(198, 'commentaire', '2023-09-16 13:01:58', 8, 13),
(199, 'delete', '2023-09-16 13:02:43', 8, 13),
(200, 'delete', '2023-09-16 13:03:03', 8, 12),
(201, 'delete', '2023-09-16 13:10:21', 8, 14),
(204, 'like', '2023-09-21 11:49:32', 8, 16),
(205, 'commentaire', '2023-09-21 11:52:19', 8, 16),
(206, 'like', '2023-09-21 15:33:34', 8, 15),
(208, 'like', '2023-09-21 15:45:03', 15, 19),
(209, 'like', '2023-09-21 15:46:31', 8, 19),
(210, 'commentaire', '2023-09-21 15:49:34', 8, 19),
(211, 'commentaire', '2023-09-21 16:14:30', 16, 19),
(212, 'commentaire', '2023-09-21 16:14:56', 16, 8);

-- --------------------------------------------------------

--
-- Structure de la table `Message`
--

CREATE TABLE `Message` (
  `message_id` int NOT NULL,
  `message_contenu` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci,
  `message_date_emission` datetime DEFAULT NULL,
  `conversation_id` int NOT NULL,
  `usr_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Message`
--

INSERT INTO `Message` (`message_id`, `message_contenu`, `message_date_emission`, `conversation_id`, `usr_id`) VALUES
(1, 'Bonjour Coer', '2023-09-05 10:15:03', 3, 8),
(2, 'Comment vas-tu?', '2023-09-05 10:15:40', 3, 8),
(3, 'Moi je bosse dur sur la fonctionnalité de messagerie', '2023-09-05 10:19:33', 3, 8),
(4, 'HOla ma boi', '2023-09-05 11:23:29', 4, 8),
(5, 'sdvw', '2023-09-05 11:24:20', 3, 8),
(6, 'yolo', '2023-09-05 11:29:21', 4, 8),
(7, 'Yo ma boy', '2023-09-06 10:01:53', 3, 8),
(8, 'test', '2023-09-06 10:12:00', 4, 10),
(9, 'test quoi blyat?', '2023-09-07 09:24:28', 4, 8),
(10, 'test efuqdkbj', '2023-09-07 09:31:25', 3, 8),
(11, 'Test mother fucker', '2023-09-07 09:58:01', 3, 8),
(12, 'Ma boy', '2023-09-07 12:06:35', 4, 10),
(13, 'On mange blyat?', '2023-09-07 12:06:58', 4, 10),
(14, 'yo', '2023-09-07 14:51:57', 3, 8),
(15, 'test', '2023-09-07 15:28:13', 4, 8),
(16, '123', '2023-09-07 15:29:12', 4, 8),
(17, '456', '2023-09-07 15:33:04', 4, 8),
(18, '789', '2023-09-07 15:46:33', 4, 8),
(19, '101112', '2023-09-07 15:46:51', 4, 8),
(20, 'yeah', '2023-09-07 15:47:04', 4, 8),
(21, 'im da best', '2023-09-07 15:49:45', 4, 8),
(22, 'clear', '2023-09-07 15:50:48', 4, 8),
(23, 'clear', '2023-09-07 15:50:53', 4, 8),
(24, 'clear', '2023-09-07 15:52:22', 4, 8),
(25, '1', '2023-09-07 15:54:08', 4, 10),
(26, '2', '2023-09-07 15:54:10', 4, 10),
(27, '3', '2023-09-07 15:54:12', 4, 10),
(28, '4', '2023-09-07 15:54:14', 4, 10),
(29, '5', '2023-09-07 15:54:16', 4, 10),
(30, 'Bonjour Monsieur', '2023-09-07 16:07:13', 3, 9),
(31, 'Qui êtes vous?\n', '2023-09-07 16:42:09', 3, 9),
(32, '1', '2023-09-07 16:42:12', 3, 9),
(33, '2', '2023-09-07 16:42:13', 3, 9),
(34, '3', '2023-09-07 16:42:15', 3, 9),
(35, '4', '2023-09-07 16:42:17', 3, 9),
(36, '5', '2023-09-07 16:42:19', 3, 9),
(37, 'oy ma geule', '2023-09-07 16:46:16', 4, 10),
(38, 'Monsieur Lukyss?', '2023-09-07 16:46:47', 3, 9),
(39, 'Je test again ma boi', '2023-09-07 16:48:03', 4, 10),
(40, 'Je déconne m8 comment tu vas?', '2023-09-07 16:48:30', 3, 9),
(41, 'ça va ma couille', '2023-09-08 08:55:52', 3, 8),
(42, 'bleue\n', '2023-09-08 08:56:00', 3, 8),
(43, 'Bonjour Testator', '2023-09-08 14:42:29', 5, 9),
(44, '1', '2023-09-08 14:48:06', 3, 9),
(45, '2', '2023-09-08 14:48:11', 3, 9),
(46, '3', '2023-09-08 14:48:13', 3, 9),
(47, '1', '2023-09-08 14:48:26', 4, 10),
(48, '2', '2023-09-08 14:48:28', 4, 10),
(49, '3', '2023-09-08 14:48:30', 4, 10),
(50, '4', '2023-09-08 14:48:32', 4, 10),
(51, 'test', '2023-09-15 14:54:22', 3, 8),
(52, 'Message Pour Lukyss de la part de Coer', '2023-09-15 16:35:17', 3, 9),
(53, 'Message pour Lukyss de la part de Testator', '2023-09-15 16:35:54', 4, 10),
(54, 'grfxc', '2023-09-17 11:48:27', 4, 8),
(55, 'message', '2023-09-17 16:45:31', 3, 8),
(56, 'Coucouille', '2023-09-21 11:48:43', 8, 8),
(57, 'si', '2023-09-21 15:13:56', 8, 8),
(58, 'HELLO', '2023-09-21 15:46:43', 9, 8),
(59, 'uwu', '2023-09-21 15:47:16', 9, 15),
(60, 'Bonjour \nca fonctionne bien cesystème', '2023-09-21 16:16:26', 10, 16);

-- --------------------------------------------------------

--
-- Structure de la table `Notifications`
--

CREATE TABLE `Notifications` (
  `notification_id` int NOT NULL,
  `notification_date` datetime DEFAULT NULL,
  `notification_is_read` tinyint(1) DEFAULT NULL,
  `usr_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifier_commentaire`
--

CREATE TABLE `notifier_commentaire` (
  `commentaire_id` int NOT NULL,
  `notification_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifier_evenement_commentaire`
--

CREATE TABLE `notifier_evenement_commentaire` (
  `notification_id` int NOT NULL,
  `evenement_c_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifier_evenement_post`
--

CREATE TABLE `notifier_evenement_post` (
  `notification_id` int NOT NULL,
  `evenement_p_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifier_message`
--

CREATE TABLE `notifier_message` (
  `notification_id` int NOT NULL,
  `message_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `notifier_post`
--

CREATE TABLE `notifier_post` (
  `post_id` int NOT NULL,
  `notification_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Parametres`
--

CREATE TABLE `Parametres` (
  `param_id` int NOT NULL,
  `param_default_post_visibility` int NOT NULL,
  `param_default_info_visibility` int NOT NULL,
  `param_default_amis_visibility` int NOT NULL,
  `param_default_photo_visibility` int NOT NULL,
  `param_default_commentaire_visibility` int NOT NULL,
  `param_default_theme` varchar(50) DEFAULT NULL,
  `param_nom_visibility` int NOT NULL,
  `param_prenom_visibility` int NOT NULL,
  `param_ville_visibility` int NOT NULL,
  `usr_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Parametres`
--

INSERT INTO `Parametres` (`param_id`, `param_default_post_visibility`, `param_default_info_visibility`, `param_default_amis_visibility`, `param_default_photo_visibility`, `param_default_commentaire_visibility`, `param_default_theme`, `param_nom_visibility`, `param_prenom_visibility`, `param_ville_visibility`, `usr_id`) VALUES
(1, 3, 3, 3, 3, 3, 'default', 3, 3, 3, 8),
(2, 3, 3, 3, 3, 3, 'default', 3, 3, 3, 9),
(3, 3, 3, 3, 3, 3, 'default', 3, 3, 3, 10),
(4, 3, 3, 3, 3, 3, 'default', 3, 3, 3, 11),
(5, 3, 3, 3, 3, 3, 'default', 3, 3, 3, 12),
(6, 3, 3, 3, 3, 3, 'default', 3, 3, 3, 13),
(7, 3, 3, 3, 3, 3, 'default', 3, 3, 3, 14),
(8, 3, 3, 3, 3, 3, 'default', 3, 3, 3, 15),
(9, 3, 3, 3, 3, 3, 'default', 3, 3, 3, 16);

-- --------------------------------------------------------

--
-- Structure de la table `participer_conversation`
--

CREATE TABLE `participer_conversation` (
  `usr_id` int NOT NULL,
  `conversation_id` int NOT NULL,
  `pc_date_derniere_visite` varchar(50) DEFAULT NULL,
  `pc_actif` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `participer_conversation`
--

INSERT INTO `participer_conversation` (`usr_id`, `conversation_id`, `pc_date_derniere_visite`, `pc_actif`) VALUES
(8, 3, '2023-09-21 16:19:59', 1),
(8, 4, '2023-09-21 16:19:59', 1),
(8, 6, '2023-09-15 14:50:11', 1),
(8, 7, '2023-09-15 14:50:13', 1),
(8, 8, '2023-09-21 16:19:57', 1),
(8, 9, '2023-09-21 16:19:55', 1),
(8, 10, '2023-09-21 16:17:13', 1),
(9, 3, '2023-09-15 16:35:17', 1),
(9, 5, '2023-09-21 15:08:08', 1),
(10, 4, '2023-09-15 16:35:54', 1),
(10, 5, '', 1),
(11, 8, '2023-09-21 11:58:07', 1),
(15, 9, '2023-09-21 15:47:16', 1),
(16, 10, '2023-09-21 16:16:26', 1);

-- --------------------------------------------------------

--
-- Structure de la table `Photo`
--

CREATE TABLE `Photo` (
  `photo_id` int NOT NULL,
  `photo_chemin` varchar(100) DEFAULT NULL,
  `photo_date_upload` varchar(50) DEFAULT NULL,
  `usr_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `Post`
--

CREATE TABLE `Post` (
  `post_id` int NOT NULL,
  `post_titre` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `post_contenu` text,
  `post_date` varchar(100) DEFAULT NULL,
  `post_visibility` int NOT NULL,
  `usr_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Post`
--

INSERT INTO `Post` (`post_id`, `post_titre`, `post_contenu`, `post_date`, `post_visibility`, `usr_id`) VALUES
(3, NULL, 'Alors me revoilà assez vite après un drop database', '2023-07-26 11:28:28', 3, 8),
(4, NULL, 'Test de visibilité de la publication', '2023-07-26 11:35:38', 1, 8),
(5, NULL, 'Juste pour mes amis', '2023-07-26 12:04:27', 2, 8),
(6, NULL, 'test paramètres', '2023-07-27 11:36:07', 2, 8),
(7, NULL, 're test paramètres tout le monde', '2023-07-27 11:36:29', 3, 8),
(8, NULL, 'Test commentaires number et tout le tralala', '2023-07-27 13:50:02', 3, 8),
(9, NULL, 'J\'étais absent mardi dernier', '2023-07-27 14:06:06', 3, 9),
(12, NULL, 'contenu supprimé', '2023-09-14 14:30:33', 4, 8),
(13, NULL, 'contenu supprimé', '2023-09-16 13:01:50', 4, 8),
(14, NULL, 'contenu supprimé', '2023-09-16 13:10:07', 4, 8),
(15, NULL, 'du pas usé', '2023-09-21 10:44:19', 2, 11),
(16, NULL, 'Claire est bavarde ajd ', '2023-09-21 11:39:29', 1, 12),
(17, NULL, 'Risotto au Speu\r\n', '2023-09-21 15:16:48', 3, 13),
(18, NULL, 'Coucou', '2023-09-21 15:24:20', 3, 14),
(19, NULL, 'LOL FIRST', '2023-09-21 15:44:56', 3, 15);

-- --------------------------------------------------------

--
-- Structure de la table `Suivre`
--

CREATE TABLE `Suivre` (
  `usr_id` int NOT NULL,
  `usr_id_1` int NOT NULL,
  `suivre_date` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Suivre`
--

INSERT INTO `Suivre` (`usr_id`, `usr_id_1`, `suivre_date`) VALUES
(8, 9, '2023-09-18'),
(8, 10, '2023-09-16'),
(8, 11, '2023-09-21'),
(12, 8, '2023-09-21'),
(14, 8, '2023-09-21'),
(14, 12, '2023-09-21'),
(16, 8, '2023-09-21'),
(16, 12, '2023-09-21'),
(16, 15, '2023-09-21');

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateurs`
--

CREATE TABLE `Utilisateurs` (
  `usr_id` int NOT NULL,
  `usr_pseudo` varchar(50) DEFAULT NULL,
  `usr_nom` varchar(50) DEFAULT NULL,
  `usr_tel` varchar(50) DEFAULT NULL,
  `usr_prenom` varchar(50) DEFAULT NULL,
  `usr_mail` varchar(50) DEFAULT NULL,
  `usr_adresse` varchar(50) DEFAULT NULL,
  `usr_cp` varchar(50) DEFAULT NULL,
  `usr_ville` varchar(50) DEFAULT NULL,
  `usr_date_creation` date DEFAULT NULL,
  `usr_mdp` varchar(50) DEFAULT NULL,
  `usr_recup_mdp` varchar(50) DEFAULT NULL,
  `usr_rang` varchar(50) DEFAULT NULL,
  `usr_image_profil` varchar(200) DEFAULT NULL,
  `usr_image_border` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `Utilisateurs`
--

INSERT INTO `Utilisateurs` (`usr_id`, `usr_pseudo`, `usr_nom`, `usr_tel`, `usr_prenom`, `usr_mail`, `usr_adresse`, `usr_cp`, `usr_ville`, `usr_date_creation`, `usr_mdp`, `usr_recup_mdp`, `usr_rang`, `usr_image_profil`, `usr_image_border`) VALUES
(8, 'Lukyss', '', '', 'Quentin', 'quentin.wow@free.fr', '', '', '', '2023-07-26', '827ccb0eea8a706c4c34a16891f84e7b', 'pB7w0yKwXfD9U5oBwfC0XLmrZruMuZ89fa4I', '10', '8/9GmTqI-b_400x4004.jpg', 'default_border.webp'),
(9, 'Coer', 'Capillon', NULL, 'Loren', 'test@test.fr', '', '', NULL, '2023-07-27', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '5', 'default.jpeg', 'default_border.webp'),
(10, 'Testator', '', NULL, '', 'test1@test.fr', '', '', NULL, '2023-08-08', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '5', 'default.jpeg', 'default_border.webp'),
(11, 'Misekyu', 'Prf', NULL, 'Florian', 'fparaffe@gmail.com', 'quelque part en france', '51100', 'REIMS', '2023-09-21', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '5', '11/dbbaa16fcc847add99a70643d3853485.jpg', 'default_border.webp'),
(12, 'Delmon51', 'Edwards', NULL, 'Delmon', 'delmonedwards@gmail.com', '24 rue du Danube', '51100', 'default', '2023-09-21', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '5', 'default.jpeg', 'default_border.webp'),
(13, 'BluSlyme', 'Buschmann', NULL, 'Quentin', 'aaaaa@gmail.com', '69 rue du caca', '65322', 'Aucune commune trouvée', '2023-09-21', 'fb377083e62f3bde1716905353335a78', NULL, '5', 'default.jpeg', 'default_border.webp'),
(14, 'luffy150610', 'delanchy', NULL, 'guillaume', 'guigui15.delanchy@gmail.com', '10 ruede mabite', '51100', 'REIMS', '2023-09-21', '60a9559c2c1ddfec73fb7a31506cbece', NULL, '5', 'default.jpeg', 'default_border.webp'),
(15, 'kezouze', 'Constantin', NULL, 'Vincent', 'vincent-c51@hotmail.com', '1 rue des Spaghettis', '51000', 'CHALONS EN CHAMPAGNE', '2023-09-21', '6d5e575aa02c229ebe386e51b1d0f297', NULL, '5', '15/oar2.jpg', 'default_border.webp'),
(16, 'LePatre', 'LEP', NULL, 'Arthur', 'arthur.lepagnol@gmail.com', '8grande rue', '51380', 'VAUDEMANGE', '2023-09-21', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '5', 'default.jpeg', 'default_border.webp');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Ajouter`
--
ALTER TABLE `Ajouter`
  ADD PRIMARY KEY (`usr_id`,`usr_id_1`),
  ADD KEY `usr_id_1` (`usr_id_1`);

--
-- Index pour la table `Apropos`
--
ALTER TABLE `Apropos`
  ADD PRIMARY KEY (`apropos_id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Index pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD PRIMARY KEY (`commentaire_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD PRIMARY KEY (`usr_id`,`commentaire_id`),
  ADD KEY `commentaire_id` (`commentaire_id`);

--
-- Index pour la table `commenter_commentaire`
--
ALTER TABLE `commenter_commentaire`
  ADD PRIMARY KEY (`commentaire_id`,`commentaire_id_response`),
  ADD KEY `commentaire_id_reponse` (`commentaire_id_response`);

--
-- Index pour la table `Conversation`
--
ALTER TABLE `Conversation`
  ADD PRIMARY KEY (`conversation_id`);

--
-- Index pour la table `Evenement_commentaire`
--
ALTER TABLE `Evenement_commentaire`
  ADD PRIMARY KEY (`evenement_c_id`),
  ADD KEY `usr_id` (`usr_id`),
  ADD KEY `commentaire_id` (`commentaire_id`);

--
-- Index pour la table `Evenement_Post`
--
ALTER TABLE `Evenement_Post`
  ADD PRIMARY KEY (`evenement_p_id`),
  ADD KEY `usr_id` (`usr_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Index pour la table `Message`
--
ALTER TABLE `Message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `conversation_id` (`conversation_id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Index pour la table `Notifications`
--
ALTER TABLE `Notifications`
  ADD PRIMARY KEY (`notification_id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Index pour la table `notifier_commentaire`
--
ALTER TABLE `notifier_commentaire`
  ADD PRIMARY KEY (`commentaire_id`,`notification_id`),
  ADD KEY `notification_id` (`notification_id`);

--
-- Index pour la table `notifier_evenement_commentaire`
--
ALTER TABLE `notifier_evenement_commentaire`
  ADD PRIMARY KEY (`notification_id`,`evenement_c_id`),
  ADD KEY `evenement_c_id` (`evenement_c_id`);

--
-- Index pour la table `notifier_evenement_post`
--
ALTER TABLE `notifier_evenement_post`
  ADD PRIMARY KEY (`notification_id`,`evenement_p_id`),
  ADD KEY `evenement_p_id` (`evenement_p_id`);

--
-- Index pour la table `notifier_message`
--
ALTER TABLE `notifier_message`
  ADD PRIMARY KEY (`notification_id`,`message_id`),
  ADD KEY `message_id` (`message_id`);

--
-- Index pour la table `notifier_post`
--
ALTER TABLE `notifier_post`
  ADD PRIMARY KEY (`post_id`,`notification_id`),
  ADD KEY `notification_id` (`notification_id`);

--
-- Index pour la table `Parametres`
--
ALTER TABLE `Parametres`
  ADD PRIMARY KEY (`param_id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Index pour la table `participer_conversation`
--
ALTER TABLE `participer_conversation`
  ADD PRIMARY KEY (`usr_id`,`conversation_id`),
  ADD KEY `conversation_id` (`conversation_id`);

--
-- Index pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD PRIMARY KEY (`photo_id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Index pour la table `Post`
--
ALTER TABLE `Post`
  ADD PRIMARY KEY (`post_id`),
  ADD KEY `usr_id` (`usr_id`);

--
-- Index pour la table `Suivre`
--
ALTER TABLE `Suivre`
  ADD PRIMARY KEY (`usr_id`,`usr_id_1`),
  ADD KEY `usr_id_1` (`usr_id_1`);

--
-- Index pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  ADD PRIMARY KEY (`usr_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Apropos`
--
ALTER TABLE `Apropos`
  MODIFY `apropos_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  MODIFY `commentaire_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT pour la table `Conversation`
--
ALTER TABLE `Conversation`
  MODIFY `conversation_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `Evenement_commentaire`
--
ALTER TABLE `Evenement_commentaire`
  MODIFY `evenement_c_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT pour la table `Evenement_Post`
--
ALTER TABLE `Evenement_Post`
  MODIFY `evenement_p_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT pour la table `Message`
--
ALTER TABLE `Message`
  MODIFY `message_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `Notifications`
--
ALTER TABLE `Notifications`
  MODIFY `notification_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Parametres`
--
ALTER TABLE `Parametres`
  MODIFY `param_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Photo`
--
ALTER TABLE `Photo`
  MODIFY `photo_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `Post`
--
ALTER TABLE `Post`
  MODIFY `post_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `Utilisateurs`
--
ALTER TABLE `Utilisateurs`
  MODIFY `usr_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Ajouter`
--
ALTER TABLE `Ajouter`
  ADD CONSTRAINT `Ajouter_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`),
  ADD CONSTRAINT `Ajouter_ibfk_2` FOREIGN KEY (`usr_id_1`) REFERENCES `Utilisateurs` (`usr_id`);

--
-- Contraintes pour la table `Apropos`
--
ALTER TABLE `Apropos`
  ADD CONSTRAINT `Apropos_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`);

--
-- Contraintes pour la table `Commentaire`
--
ALTER TABLE `Commentaire`
  ADD CONSTRAINT `Commentaire_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post` (`post_id`);

--
-- Contraintes pour la table `commenter`
--
ALTER TABLE `commenter`
  ADD CONSTRAINT `commenter_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`),
  ADD CONSTRAINT `commenter_ibfk_2` FOREIGN KEY (`commentaire_id`) REFERENCES `Commentaire` (`commentaire_id`);

--
-- Contraintes pour la table `commenter_commentaire`
--
ALTER TABLE `commenter_commentaire`
  ADD CONSTRAINT `commenter_commentaire_ibfk_1` FOREIGN KEY (`commentaire_id`) REFERENCES `Commentaire` (`commentaire_id`),
  ADD CONSTRAINT `commenter_commentaire_ibfk_2` FOREIGN KEY (`commentaire_id_response`) REFERENCES `Commentaire` (`commentaire_id`);

--
-- Contraintes pour la table `Evenement_commentaire`
--
ALTER TABLE `Evenement_commentaire`
  ADD CONSTRAINT `Evenement_commentaire_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`),
  ADD CONSTRAINT `Evenement_commentaire_ibfk_2` FOREIGN KEY (`commentaire_id`) REFERENCES `Commentaire` (`commentaire_id`);

--
-- Contraintes pour la table `Evenement_Post`
--
ALTER TABLE `Evenement_Post`
  ADD CONSTRAINT `Evenement_Post_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`),
  ADD CONSTRAINT `Evenement_Post_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `Post` (`post_id`);

--
-- Contraintes pour la table `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`conversation_id`) REFERENCES `Conversation` (`conversation_id`),
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`);

--
-- Contraintes pour la table `Notifications`
--
ALTER TABLE `Notifications`
  ADD CONSTRAINT `Notifications_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`);

--
-- Contraintes pour la table `notifier_commentaire`
--
ALTER TABLE `notifier_commentaire`
  ADD CONSTRAINT `notifier_commentaire_ibfk_1` FOREIGN KEY (`commentaire_id`) REFERENCES `Commentaire` (`commentaire_id`),
  ADD CONSTRAINT `notifier_commentaire_ibfk_2` FOREIGN KEY (`notification_id`) REFERENCES `Notifications` (`notification_id`);

--
-- Contraintes pour la table `notifier_evenement_commentaire`
--
ALTER TABLE `notifier_evenement_commentaire`
  ADD CONSTRAINT `notifier_evenement_commentaire_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `Notifications` (`notification_id`),
  ADD CONSTRAINT `notifier_evenement_commentaire_ibfk_2` FOREIGN KEY (`evenement_c_id`) REFERENCES `Evenement_commentaire` (`evenement_c_id`);

--
-- Contraintes pour la table `notifier_evenement_post`
--
ALTER TABLE `notifier_evenement_post`
  ADD CONSTRAINT `notifier_evenement_post_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `Notifications` (`notification_id`),
  ADD CONSTRAINT `notifier_evenement_post_ibfk_2` FOREIGN KEY (`evenement_p_id`) REFERENCES `Evenement_Post` (`evenement_p_id`);

--
-- Contraintes pour la table `notifier_message`
--
ALTER TABLE `notifier_message`
  ADD CONSTRAINT `notifier_message_ibfk_1` FOREIGN KEY (`notification_id`) REFERENCES `Notifications` (`notification_id`),
  ADD CONSTRAINT `notifier_message_ibfk_2` FOREIGN KEY (`message_id`) REFERENCES `Message` (`message_id`);

--
-- Contraintes pour la table `notifier_post`
--
ALTER TABLE `notifier_post`
  ADD CONSTRAINT `notifier_post_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `Post` (`post_id`),
  ADD CONSTRAINT `notifier_post_ibfk_2` FOREIGN KEY (`notification_id`) REFERENCES `Notifications` (`notification_id`);

--
-- Contraintes pour la table `Parametres`
--
ALTER TABLE `Parametres`
  ADD CONSTRAINT `Parametres_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`);

--
-- Contraintes pour la table `participer_conversation`
--
ALTER TABLE `participer_conversation`
  ADD CONSTRAINT `participer_conversation_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`),
  ADD CONSTRAINT `participer_conversation_ibfk_2` FOREIGN KEY (`conversation_id`) REFERENCES `Conversation` (`conversation_id`);

--
-- Contraintes pour la table `Photo`
--
ALTER TABLE `Photo`
  ADD CONSTRAINT `Photo_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`);

--
-- Contraintes pour la table `Post`
--
ALTER TABLE `Post`
  ADD CONSTRAINT `Post_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`);

--
-- Contraintes pour la table `Suivre`
--
ALTER TABLE `Suivre`
  ADD CONSTRAINT `Suivre_ibfk_1` FOREIGN KEY (`usr_id`) REFERENCES `Utilisateurs` (`usr_id`),
  ADD CONSTRAINT `Suivre_ibfk_2` FOREIGN KEY (`usr_id_1`) REFERENCES `Utilisateurs` (`usr_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
