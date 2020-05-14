-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le :  jeu. 14 mai 2020 à 14:35
-- Version du serveur :  5.7.26
-- Version de PHP :  7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données :  `p_matos`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_category`
--

CREATE TABLE `t_category` (
  `idCategory` int(11) NOT NULL,
  `catName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_category`
--

INSERT INTO `t_category` (`idCategory`, `catName`) VALUES
(1, 'Cordes'),
(2, 'Amarrages'),
(3, 'Assureurs'),
(4, 'Poulies'),
(5, 'Casques'),
(6, 'Baudrier');

-- --------------------------------------------------------

--
-- Structure de la table `t_matos`
--

CREATE TABLE `t_matos` (
  `idMatos` int(11) NOT NULL,
  `matModal` varchar(50) DEFAULT NULL,
  `matPrice` int(11) NOT NULL,
  `matSerialNumber` varchar(50) NOT NULL,
  `matSerialPerso` varchar(50) NOT NULL,
  `matFabricationDate` date NOT NULL,
  `matBoughtDate` date DEFAULT NULL,
  `matUseDate` date NOT NULL,
  `matEndLifeDate` date NOT NULL,
  `matRebus` tinyint(1) NOT NULL,
  `matEPI` tinyint(1) NOT NULL,
  `matLost` tinyint(1) NOT NULL,
  `matMore` varchar(500) NOT NULL,
  `matNumber` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `idCategory` int(11) NOT NULL,
  `matCatName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_matos`
--

INSERT INTO `t_matos` (`idMatos`, `matModal`, `matPrice`, `matSerialNumber`, `matSerialPerso`, `matFabricationDate`, `matBoughtDate`, `matUseDate`, `matEndLifeDate`, `matRebus`, `matEPI`, `matLost`, `matMore`, `matNumber`, `idUser`, `idCategory`, `matCatName`) VALUES
(1, 'beau baudrier', 12, '1234', '1234Perso', '2020-05-13', '2020-05-14', '2020-05-15', '2020-05-16', 1, 0, 0, 'description', 2, 3, 1, 'Baudrier'),
(18, 'MODELEOUI1', 5, '123456', 'xx-perso2', '2020-05-20', '2020-05-21', '2020-05-27', '2020-05-22', 1, 0, 0, 'YES', 1, 3, 1, 'perso1'),
(19, 'test', 1, '123', '123', '2020-05-21', '2020-05-20', '2020-05-29', '2020-05-06', 0, 1, 0, '', 1, 3, 1, 'Amarrages'),
(20, '1234', 1, '1234', '1234', '2020-05-13', '2020-05-21', '2020-05-21', '2020-06-05', 0, 0, 0, '', 1, 3, 1, 'Assureurs'),
(21, 'qwf', 1, '122ew', 'asffasf', '2020-05-21', '2020-05-22', '2020-05-29', '2020-05-22', 0, 0, 0, '', 1, 3, 1, 'test'),
(22, 'qwf', 0, '122ew', 'asffasf', '2020-05-21', '2020-05-22', '2020-05-29', '2020-05-22', 0, 0, 0, '', 1, 3, 1, 'test'),
(23, 'qwf', 0, '122ew', 'asffasf', '2020-05-21', '2020-05-22', '2020-05-29', '2020-05-22', 0, 0, 0, '', 1, 3, 1, 'test'),
(24, 'qwf', 0, '122ew', 'asffasf', '2020-05-21', '2020-05-22', '2020-05-29', '2020-05-22', 0, 0, 0, '', 1, 3, 1, 'test'),
(25, 'qwf', 0, '122ew', 'asffasf', '2020-05-21', '2020-05-22', '2020-05-29', '2020-05-22', 0, 0, 0, '', 1, 3, 1, 'test'),
(26, 'qwf', 0, '122ew', 'asffasf', '2020-05-21', '2020-05-22', '2020-05-29', '2020-05-22', 0, 0, 0, '', 1, 3, 1, 'test'),
(27, 'qwf', 0, '122ew', 'asffasf', '2020-05-21', '2020-05-22', '2020-05-29', '2020-05-22', 0, 0, 0, '', 1, 3, 1, 'test'),
(28, 'qwqw', 1, '1234', '12wqerfs', '2020-05-29', '2020-05-21', '2020-05-22', '2020-05-22', 0, 0, 0, '', 1, 3, 1, 'Assureurs'),
(29, 'TEST', 1, '1234', '1234', '2020-05-15', '2020-05-15', '2020-05-15', '2020-05-22', 0, 0, 0, '', 1, 3, 1, 'Amarrages'),
(30, 'ccyvy', 1, 'saf', 'asF', '2020-05-22', '2020-05-16', '2020-05-21', '2020-05-07', 1, 0, 1, 'SALUT', 1, 3, 1, 'Casques'),
(31, 'ccyvy', 1, 'saf', 'asF', '2020-05-22', '2020-05-16', '2020-05-21', '2020-05-07', 1, 0, 1, 'SALUT', 1, 3, 1, 'Casques'),
(32, 'beau baudrier', 12, '1234', '1234Perso', '2020-05-13', '2020-05-14', '2020-05-15', '2020-05-16', 1, 0, 0, 'description', 2, 3, 1, 'Baudrier'),
(33, 'test', 1, '123', '123', '2020-05-21', '2020-05-20', '2020-05-29', '2020-05-06', 0, 1, 0, '', 1, 3, 1, 'Amarrages'),
(34, '1234', 1, '1234', '1234', '2020-05-13', '2020-05-21', '2020-05-21', '2020-06-05', 0, 0, 0, '', 1, 3, 1, 'Assureurs');

-- --------------------------------------------------------

--
-- Structure de la table `t_persocategory`
--

CREATE TABLE `t_persocategory` (
  `idPerCat` int(11) NOT NULL,
  `catName` varchar(50) NOT NULL,
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_persocategory`
--

INSERT INTO `t_persocategory` (`idPerCat`, `catName`, `idUser`) VALUES
(1, 'perso1', 3),
(52, 'tesx2', 3),
(53, '333', 3),
(54, 'test', 3),
(55, 'w', 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_user`
--

CREATE TABLE `t_user` (
  `idUser` int(11) NOT NULL,
  `UseMail` varchar(50) NOT NULL,
  `UseOrganisation` varchar(50) NOT NULL,
  `UseAdmin` tinyint(1) NOT NULL,
  `UsePassword` varchar(65) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `t_user`
--

INSERT INTO `t_user` (`idUser`, `UseMail`, `UseOrganisation`, `UseAdmin`, `UsePassword`) VALUES
(3, 'guillaumeTest@test.ch', 'jesuisunnouveau test', 1, '$2y$10$Aa3HqgbOU95ASPGH/js4sOmiPnCJ//QanI4chG7V2RPNHS9GklQaC'),
(12, 'EtmlTest1@test.ch', 'Etml23456', 0, '$2y$10$GSpoyGpQFREAuzBVDvu/4./PvAuo.1rDa8FyKcuS0BA2X53KDkaV2'),
(13, 'EtmlTest1@test.test2.ch', 'ETML', 0, '$2y$10$FjsR8ONo3tzByHz4UPQNUez.sjhaiKooVgUIHlNFNiFZPefBQRI.y'),
(14, 'laurent@swisscaving.guide', 'swisscaving', 0, '$2y$10$n69d7xbVofW/NbN6K3/e5eTUncqHZp2dFNJBhEJNWOZNYzsScvSyW');

-- --------------------------------------------------------

--
-- Structure de la table `t_verification`
--

CREATE TABLE `t_verification` (
  `idVerification` int(11) NOT NULL,
  `VerDate` date NOT NULL,
  `VerComment` varchar(100) NOT NULL,
  `verValidate` tinyint(1) NOT NULL,
  `idMatos` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `t_category`
--
ALTER TABLE `t_category`
  ADD PRIMARY KEY (`idCategory`);

--
-- Index pour la table `t_matos`
--
ALTER TABLE `t_matos`
  ADD PRIMARY KEY (`idMatos`),
  ADD KEY `t_matos_t_user_FK` (`idUser`),
  ADD KEY `t_matos_t_category0_FK` (`idCategory`);

--
-- Index pour la table `t_persocategory`
--
ALTER TABLE `t_persocategory`
  ADD PRIMARY KEY (`idPerCat`),
  ADD KEY `t_persoCategory_t_user_FK` (`idUser`);

--
-- Index pour la table `t_user`
--
ALTER TABLE `t_user`
  ADD PRIMARY KEY (`idUser`);

--
-- Index pour la table `t_verification`
--
ALTER TABLE `t_verification`
  ADD PRIMARY KEY (`idVerification`),
  ADD KEY `t_verification_t_matos_FK` (`idMatos`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `t_category`
--
ALTER TABLE `t_category`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `t_matos`
--
ALTER TABLE `t_matos`
  MODIFY `idMatos` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT pour la table `t_persocategory`
--
ALTER TABLE `t_persocategory`
  MODIFY `idPerCat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT pour la table `t_user`
--
ALTER TABLE `t_user`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pour la table `t_verification`
--
ALTER TABLE `t_verification`
  MODIFY `idVerification` int(11) NOT NULL AUTO_INCREMENT;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `t_matos`
--
ALTER TABLE `t_matos`
  ADD CONSTRAINT `t_matos_t_category0_FK` FOREIGN KEY (`idCategory`) REFERENCES `t_category` (`idCategory`),
  ADD CONSTRAINT `t_matos_t_user_FK` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`idUser`);

--
-- Contraintes pour la table `t_persocategory`
--
ALTER TABLE `t_persocategory`
  ADD CONSTRAINT `t_persoCategory_t_user_FK` FOREIGN KEY (`idUser`) REFERENCES `t_user` (`idUser`);

--
-- Contraintes pour la table `t_verification`
--
ALTER TABLE `t_verification`
  ADD CONSTRAINT `t_verification_t_matos_FK` FOREIGN KEY (`idMatos`) REFERENCES `t_matos` (`idMatos`);
