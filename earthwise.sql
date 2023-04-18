-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : lun. 17 avr. 2023 à 16:33
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `earthwise`
--

-- --------------------------------------------------------

--
-- Structure de la table `comments`
--

CREATE TABLE `comments` (
  `Id` int(11) NOT NULL,
  `User_id` int(11) DEFAULT NULL,
  `Project_id` int(11) DEFAULT NULL,
  `Comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `comments`
--

INSERT INTO `comments` (`Id`, `User_id`, `Project_id`, `Comment`) VALUES
(2, 2, 6, 'fdfdf'),
(3, 2, 6, 'fdfdf'),
(4, 2, 6, 'helllllo\r\n'),
(5, 2, 6, 'dsdsdsd'),
(6, 2, 6, 'Last Comment');

-- --------------------------------------------------------

--
-- Structure de la table `projects`
--

CREATE TABLE `projects` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `address` varchar(42) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `target` bigint(20) DEFAULT NULL,
  `deadline` int(11) DEFAULT NULL,
  `amount_collected` bigint(20) DEFAULT NULL,
  `image` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `address`, `title`, `description`, `target`, `deadline`, `amount_collected`, `image`) VALUES
(5, NULL, '0x35b1F893F9c45d1f78eF323f63565D7a38f8D45A', 'The Online Learning Platform', 'We are a team of education professionals who are passionate about making online learning more accessible and effective. We have created an online learning platform that allows students from around the world to access quality courses taught by experts in their fields. We need funds to develop new courses and improve our platform.', 80, 45, NULL, 'https://images.pexels.com/photos/355948/pexels-photo-355948.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(6, NULL, '0x2D2a2B0f8A8e11Ea88D74380A9A930c8D689d942', 'The Public Digital Library', 'We want to create a public digital library that is accessible to everyone, everywhere in the world. Our library will contain thousands of free e-books in all languages and genres. We need funds to purchase copyrights, create a user-friendly platform, and promote our library to the public.', 120, 60, NULL, 'https://images.pexels.com/photos/8721342/pexels-photo-8721342.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(7, NULL, '0x27F56A7f5C09d658d7cE9e63172f7b02D17aA1C1', 'The Online Role-Playing Game', 'We are online role-playing game enthusiasts who have created a new game that promises to be epic. Our game takes place in a fantasy world filled with magical creatures and legendary heroes. We need funds to develop new characters, scenarios, and features to make our game the best in its class.', 90, 30, NULL, 'https://images.pexels.com/photos/5699397/pexels-photo-5699397.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(8, NULL, '0x58e2277c020Fc5dd5C5b5E5e5B7b5fFb59D2B266', 'The Alternative Music Festival', 'We are organizing an alternative music festival that showcases independent and emerging artists. We want to provide a stage for talented musicians who do not have a large media exposure. We need funds to rent a venue, pay for the artists\' travel expenses, and ensure good sound and quality lighting to create an unforgettable atmosphere.', 70, 45, NULL, 'https://images.pexels.com/photos/4823687/pexels-photo-4823687.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(9, NULL, '0x43726d20C352f4C845315F4B4Dd2DbC53B20Fe9D', 'The Freelance Matchmaking Platform', 'We are a freelance matchmaking platform that allows clients to easily find independent workers to complete their projects. We want to improve our matching algorithm to ensure better correspondence between clients and freelancers, and for that we need funds to hire developers and data scientists.', 100, 60, NULL, 'https://images.pexels.com/photos/1255149/pexels-photo-1255149.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(10, NULL, '0x8C902b9a77f9dd1a4cC4297204d290A4d73b15A1', 'The Open Source Educational Robot', 'We have created an open source educational robot to help children learn the basics of programming and electronics in a fun and interactive way. Our robot is easy to use and assemble, and it allows children to develop their creativity and logic. We need funds to purchase electronic components and to produce robotics kits on a large scale, to make our robot accessible to as many people as possible.', 60, 30, NULL, 'https://images.pexels.com/photos/8386434/pexels-photo-8386434.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1'),
(34, 7, '0x336e14bc1156cf5a9DE3B21f27504210B645f98b', 'Projet 1', 'Descriptif Projet 1', 10, 90, NULL, 'https://imgs.search.brave.com/7P8-Od6kYLZ4pzrdWBhLoWPkySqXuB_N12B5169v78I/rs:fit:1200:900:1/g:ce/aHR0cHM6Ly9saWxk/ZXZpbG1hbWEuY29t/L3dwLWNvbnRlbnQv/dXBsb2Fkcy8yMDE5/LzA1L2hlbGxvLXdv/cmxkLnBuZw'),
(35, 8, '0x336e14bc1156cf5a9DE3B21f27504210B645f98b', 'Premier Test sur Ethereum Goerli', 'Premier Test sur Ethereum Goerli Premier Test sur Ethereum Goerli Premier Test sur Ethereum Goerli', 10, 90, NULL, 'https://imgs.search.brave.com/JiMM_SPtdAjGIyAotSGuIB_cEf3hSjDhS8YEz4Dd4K0/rs:fit:844:225:1/g:ce/aHR0cHM6Ly90c2Uy/Lm1tLmJpbmcubmV0/L3RoP2lkPU9JUC5T/YVJqcHVSaVN1eXhC/cE44V3g0czRBSGFF/SyZwaWQ9QXBp');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `address` varchar(42) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `login` varchar(40) NOT NULL,
  `pass` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `address`, `name`, `date`, `login`, `pass`) VALUES
(1, '0x336e14bc1156cf5a9DE3B21f27504210B645f98b', 'PierreAnders', '2023-04-07 07:42:06', 'pierre.untas@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(2, '0x336e14bc1156cf5a9DE3B21f27504210B645f98b', 'John', '2023-04-12 13:28:45', 'john@john.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(3, '0x336e14bc1156cf5a9DE3B21f27504210B645f98b', 'Test', '2023-04-14 08:02:11', 'test@test.com', '$2y$10$7aJ5VOvZAEgHJ1gy/Xkuh.VSFIr18O49x'),
(4, '0x336e14bc1156cf5a9DE3B21f27504210B645f98b', 'Test2', '2023-04-14 08:40:08', 'test2@test2.com', '$2y$10$Wk.aP4jGsKIhYZw1ZKitp.vYJHlk7Fusc'),
(5, '0x336e14bc1156cf5a9DE3B21f27504210B645f98b', 'test3', '2023-04-14 08:43:05', 'test3@test3.com', '$2y$10$ETrPtPHGOgqri6OhRqaOwOnDXsU.R1.t6'),
(6, '0x336e14bc1156cf5a9DE3B21f27504210B645f98b', 'hello', '2023-04-14 08:48:56', 'hello@hello.com', '$2y$10$JRkDAftK5J13OS99NcWH7u8xnD84wSg0J'),
(7, '0x336e14bc1156cf5a9DE3B21f27504210B645f98b', 'test 01', '2023-04-14 11:22:44', 'test01@test01.com', '5f4dcc3b5aa765d61d8327deb882cf99'),
(8, '0x336e14bc1156cf5a9DE3B21f27504210B645f98b', 'pierre', '2023-04-14 13:40:46', 'pierre@pierre.com', '5f4dcc3b5aa765d61d8327deb882cf99');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `User_id` (`User_id`),
  ADD KEY `comments_ibfk_2` (`Project_id`);

--
-- Index pour la table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `comments`
--
ALTER TABLE `comments`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`User_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`Project_id`) REFERENCES `projects` (`id`);

--
-- Contraintes pour la table `projects`
--
ALTER TABLE `projects`
  ADD CONSTRAINT `projects_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
