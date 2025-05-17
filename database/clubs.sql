-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 18 mai 2025 à 01:34
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `clubs`
--

-- --------------------------------------------------------

--
-- Structure de la table `activites`
--

CREATE TABLE `activites` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `idclub` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `activites`
--

INSERT INTO `activites` (`id`, `titre`, `description`, `idclub`) VALUES
(1, 'Atelier de Développement Web', 'Un atelier pratique sur le développement web pour les membres intéressés par la programmation et la création de sites.', 1),
(12, 'Workshop : Programmation Python', 'Initiation aux bases de Python pour les débutants avec projets pratiques.', 1),
(13, 'Hackathon Inter-Universitaire', '48h de challenge tech en équipe pour créer des solutions innovantes.', 1),
(14, 'Formation en Hacking Éthique', 'Découverte des techniques de sécurité informatique et d’analyse de vulnérabilités.', 2),
(15, 'Capture The Flag', 'Jeu de piratage simulé pour tester les compétences en cybersécurité.', 2),
(16, 'Coding Dojo JavaScript', 'Session live pour résoudre des exercices JS de manière collaborative.', 5),
(17, 'Sprint Open Source', 'Participation à des projets open source encadrée par des mentors.', 5),
(18, 'Journée Reboisement', 'Plantation d’arbres dans un parc urbain avec sensibilisation au changement climatique.', 6),
(19, 'Atelier DIY : Produits Ménagers Écolos', 'Apprendre à fabriquer ses propres produits respectueux de l’environnement.', 6),
(20, 'Atelier Zéro Déchet', 'Techniques et conseils pour réduire les déchets dans la vie quotidienne.', 7),
(21, 'Marche Verte Étudiante', 'Mobilisation pour promouvoir l’écoresponsabilité sur le campus.', 7),
(22, 'Startup Weekend', '48h pour créer une startup de l’idée au prototype avec jury final.', 8),
(23, 'Mentoring Café', 'Rencontres informelles avec des entrepreneurs pour discuter idées & pitchs.', 8),
(24, 'Expo Artistique Étudiante', 'Exposition de peintures, photographies et œuvres numériques d’étudiants.', 9),
(25, 'Open Mic Night', 'Scène ouverte pour chanteurs, musiciens et poètes.', 9),
(26, 'Séance de Yoga en Plein Air', 'Cours de yoga gratuit pour étudiants, animé par un coach certifié.', 10),
(27, 'Conférence sur la Santé Mentale', 'Talk avec un psychologue sur le stress, la pression et le bien-être.', 10),
(28, 'Arduino Battle', 'Défis techniques entre équipes autour de cartes Arduino.', 11),
(29, 'Drone Day', 'Démonstrations de drones conçus et programmés par les membres.', 11),
(30, 'Campagne de Don de Sang', 'Organisation d’un don collectif en partenariat avec le centre de transfusion.', 12),
(31, 'Distribution de Repas Chauds', 'Action solidaire envers les sans-abri de la ville.', 12);

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `id_admin` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `idclub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `full_name`, `email`, `mdp`, `idclub`) VALUES
(1, 'Jean Martin', 'jean.martin@example.com', 'motdepassehashed', 2);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

CREATE TABLE `evenement` (
  `id_evenement` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `date_evenement` datetime NOT NULL,
  `idclub` int(11) NOT NULL,
  `photo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`id_evenement`, `titre`, `description`, `date_evenement`, `idclub`, `photo`) VALUES
(1, 'Conférence sur la Programmation Web', 'Une conférence passionnante sur les dernières tendances en programmation web, idéale pour les développeurs débutants et expérimentés.', '2025-05-10 10:00:00', 2, 'img\\image11.png'),
(14, 'Atelier IA', 'Découverte de l\'intelligence artificielle avec démonstrations.', '2025-05-15 14:00:00', 1, 'img\\photo55.png'),
(15, 'Journée Sportive', 'Tournois interclubs et activités sportives en plein air.', '2025-06-01 09:00:00', 10, 'photo3.png'),
(16, 'Conférence CyberSécurité', 'Intervention d\'experts en sécurité informatique.', '2025-05-22 17:30:00', 2, 'photo4.png'),
(17, 'Expo Projets Étudiants', 'Exposition des projets réalisés par les membres des clubs.', '2025-06-05 10:00:00', 5, 'https://source.unsplash.com/600x400/?students,projects,showcase');

-- --------------------------------------------------------

--
-- Structure de la table `info_clubs`
--

CREATE TABLE `info_clubs` (
  `idclub` int(11) NOT NULL,
  `nomclub` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `vision` text DEFAULT NULL,
  `logo_url` varchar(500) DEFAULT NULL,
  `objectif` text DEFAULT NULL,
  `website` varchar(255) DEFAULT NULL,
  `activites` text DEFAULT NULL,
  `facebook` varchar(255) DEFAULT NULL,
  `instagram` varchar(255) DEFAULT NULL,
  `linkedin` varchar(255) DEFAULT NULL,
  `x_url` varchar(255) DEFAULT NULL,
  `topics` varchar(255) DEFAULT 'Innovation et technologie',
  `responsable_id` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `info_clubs`
--

INSERT INTO `info_clubs` (`idclub`, `nomclub`, `description`, `vision`, `logo_url`, `objectif`, `website`, `activites`, `facebook`, `instagram`, `linkedin`, `x_url`, `topics`, `responsable_id`) VALUES
(1, 'Tech Club2', 'A club for tech enthusiasts.', 'Our goal to innovate and inspire through technology.', 'img/image11.png', 'Organize workshops, hackathons, and tech talks.', 'https://techclub.university.edu', 'Coding events, robotics competitions, seminars', 'https://facebook.com/techclub', 'https://instagram.com/techclub', 'https://linkedin.com/company/techclub', 'https://x.com/techclub', 'Innovation et technologie', '1'),
(2, 'DigiSec', 'DigiSec est un club spécialisé en cybersécurité, protection des données, et culture numérique. Il vise à former et inspirer les étudiants à maîtriser ces enjeux modernes.', 'Créer une communauté d\'experts et d\'étudiants passionnés qui collaborent pour promouvoir un cyberespace sûr, éthique et innovant.', 'photo4.png', 'Organiser des ateliers pratiques, conférences, compétitions et accompagnement technique dans les domaines de la sécurité numérique.', 'https://www.DigiSec.com', 'Coding events, robotics competitions, seminars', 'https://facebook.com/DigiSec', 'https://instagram.com/DigiSec', 'https://linkedin.com/company/DigiSec', 'https://x.com/DigiSec', 'Innovation et technologie', '2'),
(5, 'DevHub', 'Un espace pour les développeurs de tous niveaux.', 'Favoriser l\'apprentissage collaboratif.', 'https://yourdomain.com/logos/devhub.png', 'Coding dojo, open source', 'https://devhub.org', 'Challenges mensuels', 'https://facebook.com/devhub', 'https://instagram.com/devhub', 'https://linkedin.com/company/devhub', 'https://x.com/devhub', 'Technologie', '3'),
(6, 'EcoFuture', 'Agir pour un avenir plus vert.', 'Sensibiliser et impliquer les étudiants.', 'https://yourdomain.com/logos/ecofuture.png', 'Nettoyages, conférences, éco-conception', 'https://ecofuture.org', 'Journées de reboisement, tri sélectif', 'https://facebook.com/ecofuture', 'https://instagram.com/ecofuture', 'https://linkedin.com/company/ecofuture', 'https://x.com/ecofuture', 'Environnement', '4'),
(7, 'GreenWave', 'Club d’initiatives écologiques.', 'Promouvoir le développement durable.', 'https://yourdomain.com/logos/greenwave.png', 'Compost, ateliers zéro déchet', 'https://greenwave.org', 'Débats, projets écoresponsables', 'https://facebook.com/greenwave', 'https://instagram.com/greenwave', 'https://linkedin.com/company/greenwave', 'https://x.com/greenwave', 'Environnement', '5'),
(8, 'StartUp Minds', 'Encourager les futurs entrepreneurs.', 'Créer, innover, entreprendre.', 'https://yourdomain.com/logos/startupminds.png', 'Pitch, mentorat, hackathon business', 'https://startupminds.com', 'Startup weekend, incubateurs', 'https://facebook.com/startupminds', 'https://instagram.com/startupminds', 'https://linkedin.com/company/startupminds', 'https://x.com/startupminds', 'Entrepreneuriat', '6'),
(9, 'ArtFusion', 'L’art sous toutes ses formes.', 'Exprimer sa créativité et la partager.', 'https://yourdomain.com/logos/artfusion.png', 'Expositions, théâtre, musique', 'https://artfusion.org', 'Concours, galeries étudiantes', 'https://facebook.com/artfusion', 'https://instagram.com/artfusion', 'https://linkedin.com/company/artfusion', 'https://x.com/artfusion', 'Arts', '7'),
(10, 'Wellness Club', 'Bien-être physique et mental.', 'Promouvoir une vie saine.', 'https://yourdomain.com/logos/wellness.png', 'Yoga, nutrition, santé mentale', 'https://wellnessclub.org', 'Journées bien-être, talks santé', 'https://facebook.com/wellnessclub', 'https://instagram.com/wellnessclub', 'https://linkedin.com/company/wellnessclub', 'https://x.com/wellnessclub', 'Santé', '8'),
(11, 'RoboTech', 'Explorer la robotique et l’automatisation.', 'Construire des machines intelligentes.', 'https://yourdomain.com/logos/robotech.png', 'Arduino, drones, concours', 'https://robotech.org', 'Robot days, battle bots', 'https://facebook.com/robotech', 'https://instagram.com/robotech', 'https://linkedin.com/company/robotech', 'https://x.com/robotech', 'Robotique', '9'),
(12, 'Solidarity Force', 'Agir pour la justice sociale.', 'Soutenir les plus démunis.', 'https://yourdomain.com/logos/solidarity.png', 'Dons, bénévolat, aides sociales', 'https://solidarityforce.org', 'Collectes, actions sociales', 'https://facebook.com/solidarityforce', 'https://instagram.com/solidarityforce', 'https://linkedin.com/company/solidarityforce', 'https://x.com/solidarityforce', 'Humanitaire', '10');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT NULL,
  `idclub` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `members`
--

INSERT INTO `members` (`id`, `name`, `role`, `idclub`) VALUES
(4, 'Yassine Idnasser', 'Secretaire\r\n', 2);

-- --------------------------------------------------------

--
-- Structure de la table `responsable`
--

CREATE TABLE `responsable` (
  `id_responsable` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `idclub` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `responsable`
--

INSERT INTO `responsable` (`id_responsable`, `full_name`, `email`, `mdp`, `idclub`) VALUES
(1, 'Youssef El Amrani', 'youssef.amrani@fsbm.ma', '482c811da5d5b4bc6d497ffa98491e38', 1),
(2, 'Salma Bennani', 'salma.bennani@fsbm.ma', '482c811da5d5b4bc6d497ffa98491e38', 2),
(3, 'Omar Chakiri', 'omar.chakiri@fsbm.ma', '482c811da5d5b4bc6d497ffa98491e38', 5),
(4, 'Lina Ait Taleb', 'lina.aittaleb@fsbm.ma', '482c811da5d5b4bc6d497ffa98491e38', 6),
(5, 'Karim Oulhaj', 'karim.oulhaj@fsbm.ma', '482c811da5d5b4bc6d497ffa98491e38', 7),
(6, 'Nadia Idrissi', 'nadia.idrissi@fsbm.ma', '482c811da5d5b4bc6d497ffa98491e38', 8),
(7, 'Amine Zahidi', 'amine.zahidi@fsbm.ma', '482c811da5d5b4bc6d497ffa98491e38', 9),
(8, 'Rania El Khalfi', 'rania.khalfi@fsbm.ma', '482c811da5d5b4bc6d497ffa98491e38', 10),
(9, 'Mohamed Tahiri', 'mohamed.tahiri@fsbm.ma', '482c811da5d5b4bc6d497ffa98491e38', 11),
(10, 'Imane El Youssfiaaaaaa', 'imane.youssfi@fsbm.ma', '482c811da5d5b4bc6d497ffa98491e38', 12);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `id_user` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`id_user`, `full_name`, `email`, `mdp`) VALUES
(1, 'Alice Dupont', 'alice.dupont@example.com', 'motdepassehashed'),
(2, 'John Doe', 'johndoe@example.com', 'password123'),
(3, 'Alice Smith', 'alicesmith@example.com', 'securepassword456'),
(4, 'Bob Johnson', 'bobjohnson@example.com', 'mypassword789');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`idclub`);

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id_admin`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idclub` (`idclub`);

--
-- Index pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD PRIMARY KEY (`id_evenement`),
  ADD KEY `idclub` (`idclub`);

--
-- Index pour la table `info_clubs`
--
ALTER TABLE `info_clubs`
  ADD PRIMARY KEY (`idclub`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `club_id` (`idclub`);

--
-- Index pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD PRIMARY KEY (`id_responsable`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idclub` (`idclub`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `activites`
--
ALTER TABLE `activites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `evenement`
--
ALTER TABLE `evenement`
  MODIFY `id_evenement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT pour la table `info_clubs`
--
ALTER TABLE `info_clubs`
  MODIFY `idclub` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `responsable`
--
ALTER TABLE `responsable`
  MODIFY `id_responsable` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `activites`
--
ALTER TABLE `activites`
  ADD CONSTRAINT `activites_ibfk_1` FOREIGN KEY (`idclub`) REFERENCES `info_clubs` (`idclub`) ON DELETE CASCADE;

--
-- Contraintes pour la table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`idclub`) REFERENCES `info_clubs` (`idclub`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `evenement_ibfk_1` FOREIGN KEY (`idclub`) REFERENCES `info_clubs` (`idclub`);

--
-- Contraintes pour la table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`idclub`) REFERENCES `info_clubs` (`idclub`) ON DELETE CASCADE;

--
-- Contraintes pour la table `responsable`
--
ALTER TABLE `responsable`
  ADD CONSTRAINT `responsable_ibfk_1` FOREIGN KEY (`idclub`) REFERENCES `info_clubs` (`idclub`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
