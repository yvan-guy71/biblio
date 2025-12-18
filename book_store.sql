-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 18 déc. 2025 à 16:13
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
-- Base de données : `book_store`
--

-- --------------------------------------------------------

--
-- Structure de la table `lecteurs`
--

CREATE TABLE `lecteurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `lecteurs`
--

INSERT INTO `lecteurs` (`id`, `nom`, `prenom`, `email`, `password`, `is_admin`) VALUES
(2, 'Gnimpale', 'Yvan-Guy', 'armellesage66@gmail.com', '$2y$10$rPW7eG6p4/kGeiadtikbjOYlY6lzHGku6wrPYgOibu7yoHOpiCSfe', 1);

-- --------------------------------------------------------

--
-- Structure de la table `liste_lecture`
--

CREATE TABLE `liste_lecture` (
  `id_livre` int(11) NOT NULL,
  `id_lecteur` int(11) NOT NULL,
  `date_emprunt` date NOT NULL,
  `date_retour` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `livres`
--

CREATE TABLE `livres` (
  `id` int(10) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `maison_edition` varchar(100) NOT NULL,
  `nombre_exemplaire` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `livres`
--

INSERT INTO `livres` (`id`, `auteur`, `titre`, `description`, `maison_edition`, `nombre_exemplaire`, `image`) VALUES
(2, 'Arthur YOUMOU', 'Tu ne mérites pas d\'être parent', 'En voilà un autre qui va te retourner le cerveau. Ce qui me plait le plus dans ce livre c’est la cruauté dans les mots de l’auteur. Son livre, soit tu l’aimes, soit tu le détestes. \r\n\r\n\r\nSon livre est une succession de petites anecdotes percutantes et fac', 'Amosse Studio', 250, 'cover1.avif'),
(3, 'Chinua Achebe', 'Le monde s\'effondre', 'Tout s\'effondre, auparavant intitulé Le monde s\'effondre dans la première traduction française, est un roman de l\'écrivain nigérian Chinua Achebe. Publié en 1958, le roman raconte la vie précoloniale dans le sud-est du Nigeria et l\'arrivée des Britannique', 'Change life', 500, 'cover2.webp'),
(4, 'Obi Okonkwo', 'Le Malaise', 'Le Malaise est un roman de 1960 de l\'auteur nigérian Chinua Achebe. C\'est l\'histoire d\'un homme Igbo, Obi Okonkwo, qui quitte son village pour une éducation en Grande-Bretagne puis un emploi dans la', 'Minimun Reading', 132, 'cover3.jpeg'),
(5, 'Guy Menga', 'La Marmite de Koka Mbala', '\"La Marmite de Koka Mbala\" est une pièce de théâtre emblématique de Guy Menga qui aborde des thèmes de la jeunesse, de la justice et des traditions rigides dans la société congolaise.', 'Acolab Studio', 200, 'cover.jpg'),
(6, 'Guy Menga', 'La Palabre stérile', 'La Palabre stérile est un roman de l\'écrivain congolais Guy Menga. Paru en 1968 aux éditions Clé, l\'oeuvre reçoit le Grand Prix littéraire d\'Afrique noire en 1969.', 'Studio House', 203, 'cover4.jpeg');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `lecteurs`
--
ALTER TABLE `lecteurs`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `liste_lecture`
--
ALTER TABLE `liste_lecture`
  ADD PRIMARY KEY (`id_livre`);

--
-- Index pour la table `livres`
--
ALTER TABLE `livres`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `lecteurs`
--
ALTER TABLE `lecteurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `livres`
--
ALTER TABLE `livres`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
