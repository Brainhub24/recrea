-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 05 déc. 2022 à 04:15
-- Version du serveur :  5.7.34
-- Version de PHP : 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `scool`
--

-- --------------------------------------------------------

--
-- Structure de la table `ask_messages`
--

CREATE TABLE `ask_messages` (
  `id` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_messenger` int(11) NOT NULL,
  `message` varchar(2500) NOT NULL,
  `time_posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `ask_messages`
--

INSERT INTO `ask_messages` (`id`, `id_subject`, `id_messenger`, `message`, `time_posted`) VALUES
(3, 1, 1, 'Bonjour, qu\'elle est la réaction de la photosynthèse???<br />\r\n', '2022-03-28 21:39:22'),
(4, 1, 1, 'hello its me', '2022-04-10 01:32:18'),
(7, 1, 2, 'oui c\'est cela yeehaw!', '2022-04-10 01:42:01'),
(8, 1, 1, 'ok', '2022-04-10 01:42:16'),
(9, 2, 1, 'hello', '2022-04-13 13:47:41'),
(10, 1, 1, 'hello worlddddddd', '2022-06-06 11:51:39'),
(11, 1, 1, 'hellooooewdmeaiwf', '2022-06-06 11:51:47'),
(14, 3, 1, 'hegge', '2022-06-06 22:31:19'),
(15, 18, 1, 'algebre', '2022-06-06 22:31:35'),
(16, 3, 1, 'blablaffd', '2022-06-09 14:02:40'),
(17, 16, 1, 'ww2w2', '2022-11-24 23:44:38'),
(18, 16, 1, 'ww2w2', '2022-11-24 23:46:54');

-- --------------------------------------------------------

--
-- Structure de la table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nat_id` varchar(100) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `region` varchar(40) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `courses`
--

INSERT INTO `courses` (`id`, `name`, `nat_id`, `subject`, `description`, `region`, `creation_date`) VALUES
(1, 'Évolution et diversité du vivant', '101-NYA-05', 'Biology', 'Le cours Évolution et diversité du vivant est un cours où les élèves découvrent le monde du vivant du côté des plantes et des végétaux.', 'Quebec, CA', '2022-03-28 20:52:57'),
(2, 'Chimie des solutions', '202-NYB-05', 'Chemistry', 'Le cours de chimie des solutions explique la relation entre différents éléments chimiques dans des solutions. Concentration, pH, mole/Litre.., tous des termes très courants en chimie des solutions. ', 'Quebec, CA', '2022-03-30 20:41:00');

-- --------------------------------------------------------

--
-- Structure de la table `messages_answers`
--

CREATE TABLE `messages_answers` (
  `id` int(11) NOT NULL,
  `id_message` int(11) NOT NULL,
  `id_messenger` int(11) NOT NULL,
  `answer` varchar(2300) NOT NULL,
  `time_posted` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `messages_answers`
--

INSERT INTO `messages_answers` (`id`, `id_message`, `id_messenger`, `answer`, `time_posted`) VALUES
(1, 3, 1, 'C\'est une réaction qui libère de l\'oxygène.', '2022-03-30 21:01:27'),
(2, 3, 1, 'we', '2022-03-30 23:20:23'),
(7, 3, 1, 'electro-picknick', '2022-06-12 20:38:01');

-- --------------------------------------------------------

--
-- Structure de la table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `creation_date`) VALUES
(1, 'Biology', '2022-04-10 01:52:32'),
(2, 'Chemistry', '2022-04-10 01:52:32'),
(3, 'Mathematics', '2022-04-10 10:38:05'),
(4, 'Science', '2022-04-10 10:38:05'),
(5, 'Grammar', '2022-04-10 10:38:55'),
(6, 'Vocabulary', '2022-04-10 10:38:55'),
(7, 'Physics', '2022-04-10 10:40:11'),
(8, 'Organic Chemistry', '2022-04-10 10:40:11'),
(9, 'Astronomy', '2022-04-10 10:40:11'),
(10, 'Spanish', '2022-04-10 10:42:46'),
(11, 'French', '2022-04-10 10:42:46'),
(12, 'Japanese', '2022-04-10 10:42:46'),
(13, 'Latin', '2022-04-10 10:42:46'),
(14, 'German', '2022-04-10 10:42:46'),
(16, 'Algebra Beginner', '2022-04-10 10:44:41'),
(17, 'Algebra', '2022-04-10 10:44:41'),
(18, 'Algebra Intermediate', '2022-04-10 10:44:41'),
(19, 'Geometry', '2022-04-10 10:44:41'),
(20, 'Trigonometry', '2022-04-10 10:44:41'),
(22, 'Calculus', '2022-04-10 10:44:41'),
(23, 'Statistics', '2022-04-10 10:45:39'),
(24, 'Programming', '2022-04-10 10:45:39');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(40) NOT NULL,
  `hpassword` varchar(90) NOT NULL,
  `creation_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `hpassword`, `creation_date`) VALUES
(1, 'marctest@gmail.com', 'marc', '$2y$10$GzCjCRhXtQ82VHv6fn9cZupoy/k0ThqeL5rGGGggkq/ak5glZN8e6', '2022-03-28 13:35:25'),
(2, 'tester2@yahoo.com', 'yeahhman', 'yeethawn', '2022-04-10 01:40:00');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `ask_messages`
--
ALTER TABLE `ask_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_messenger` (`id_messenger`),
  ADD KEY `id_subject` (`id_subject`);

--
-- Index pour la table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `messages_answers`
--
ALTER TABLE `messages_answers`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `ask_messages`
--
ALTER TABLE `ask_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT pour la table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `messages_answers`
--
ALTER TABLE `messages_answers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `ask_messages`
--
ALTER TABLE `ask_messages`
  ADD CONSTRAINT `id_messenger` FOREIGN KEY (`id_messenger`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `id_subject` FOREIGN KEY (`id_subject`) REFERENCES `subjects` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
