-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  lun. 18 juin 2018 à 01:00
-- Version du serveur :  5.6.38
-- Version de PHP :  7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `gitdrummer`
--

-- --------------------------------------------------------

--
-- Structure de la table `commits`
--

CREATE TABLE `commits` (
  `id` int(11) NOT NULL,
  `master` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `json` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `drums`
--

CREATE TABLE `drums` (
  `id` int(11) NOT NULL,
  `author` int(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` datetime NOT NULL,
  `forks` int(11) NOT NULL DEFAULT '0',
  `stars` int(11) NOT NULL DEFAULT '0',
  `json` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `drums`
--

INSERT INTO `drums` (`id`, `author`, `name`, `date`, `forks`, `stars`, `json`) VALUES
(30, 24, 'Swingy maracas', '2018-06-18 00:57:56', 0, 0, '[{\"name\":\"kick\",\"x\":0.003472222222222222,\"y\":0.7336747759282971,\"length\":1,\"isPlayed\":true},{\"name\":\"kick\",\"x\":0.49930555555555556,\"y\":0.7528809218950064,\"length\":1,\"isPlayed\":true},{\"name\":\"snare\",\"x\":0.5013888888888889,\"y\":0.3585147247119078,\"length\":1,\"isPlayed\":true},{\"name\":\"clave\",\"x\":0.25069444444444444,\"y\":0.322663252240717,\"length\":1,\"isPlayed\":true},{\"name\":\"clave\",\"x\":0.7506944444444444,\"y\":0.3111395646606914,\"length\":1,\"isPlayed\":false},{\"name\":\"hihat\",\"x\":0.002777777777777778,\"y\":0.2023047375160051,\"length\":1,\"isPlayed\":true},{\"name\":\"hihat\",\"x\":0.2520833333333333,\"y\":0.1997439180537772,\"length\":1,\"isPlayed\":true},{\"name\":\"hihat\",\"x\":0.5006944444444444,\"y\":0.18437900128040974,\"length\":1,\"isPlayed\":true},{\"name\":\"hihat\",\"x\":0.7506944444444444,\"y\":0.1792573623559539,\"length\":1,\"isPlayed\":false},{\"name\":\"hihat\",\"x\":0.8833333333333333,\"y\":0.176696542893726,\"length\":1,\"isPlayed\":false}]'),
(33, 24, 'African kicks', '2018-06-18 00:59:36', 0, 0, '[{\"name\":\"cowbell\",\"x\":0.002777777777777778,\"y\":0.20614596670934698,\"length\":1,\"isPlayed\":true},{\"name\":\"maracas\",\"x\":0.0020833333333333333,\"y\":0.5160051216389244,\"length\":1,\"isPlayed\":true},{\"name\":\"maracas\",\"x\":0.2513888888888889,\"y\":0.5211267605633803,\"length\":1,\"isPlayed\":true},{\"name\":\"maracas\",\"x\":0.5041666666666667,\"y\":0.528809218950064,\"length\":1,\"isPlayed\":false},{\"name\":\"maracas\",\"x\":0.7513888888888889,\"y\":0.5172855313700384,\"length\":1,\"isPlayed\":false},{\"name\":\"maracas\",\"x\":0.13194444444444445,\"y\":0.5160051216389244,\"length\":1,\"isPlayed\":true},{\"name\":\"maracas\",\"x\":0.3784722222222222,\"y\":0.5211267605633803,\"length\":1,\"isPlayed\":true},{\"name\":\"maracas\",\"x\":0.6277777777777778,\"y\":0.5236875800256082,\"length\":1,\"isPlayed\":false},{\"name\":\"maracas\",\"x\":0.8840277777777777,\"y\":0.5249679897567221,\"length\":1,\"isPlayed\":false},{\"name\":\"conga\",\"x\":0.25,\"y\":0.36107554417413573,\"length\":1,\"isPlayed\":true},{\"name\":\"conga\",\"x\":0.7520833333333333,\"y\":0.3866837387964149,\"length\":1,\"isPlayed\":false},{\"name\":\"conga\",\"x\":0.8840277777777777,\"y\":0.3892445582586428,\"length\":1,\"isPlayed\":false},{\"name\":\"stick\",\"x\":0.2513888888888889,\"y\":0.8373879641485276,\"length\":1,\"isPlayed\":true},{\"name\":\"stick\",\"x\":0.5,\"y\":0.8361075544174136,\"length\":1,\"isPlayed\":false}]');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `pseudo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `pseudo`) VALUES
(24, 'gabriel.stik@gmail.com', '$2y$10$q3rnUuquKSV/U5U9q6myduYolg/rZNQNrihsVZiZpq4BILoksV3a.', 'Gabriel');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commits`
--
ALTER TABLE `commits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `drums`
--
ALTER TABLE `drums`
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
-- AUTO_INCREMENT pour la table `commits`
--
ALTER TABLE `commits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `drums`
--
ALTER TABLE `drums`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
