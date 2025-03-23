CREATE DATABASE IF NOT EXISTS `touchemagique` DEFAULT CHARACTER SET utf8 ;

USE `touchemagique`;

CREATE TABLE IF NOT EXISTS `connexion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_connexion` datetime NOT NULL,
  `token` varchar(255),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(50) NOT NULL,
  `prix` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `nom` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `creneaux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `duree` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure` time NOT NULL,
  `id_utilisateur` int(11),
  `valide` tinyint(1),
  `id_type` int(11),
  `etat` varchar(50) default 'En attente',
  PRIMARY KEY (`id`),
  KEY `id_utilisateur` (`id_utilisateur`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `creneaux_ibfk_1` FOREIGN KEY (`id_utilisateur`) REFERENCES `utilisateurs` (`id`),
  CONSTRAINT `creneaux_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `type` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `type` (`libelle`, `prix`) VALUES
('Radiofréquence (zone intime)', 50.00),
('Cryolipolyse', 70.00),
('Endosphère', 60.00),
('Cavitation', 50.00),
('Radiofréquence (corps)', 50.00),
('Lipolaser', 50.00),
('Lifting colombien', 50.00),
('Madérothérapie', 60.00);
