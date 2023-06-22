-- Adminer 4.8.1 MySQL 11.0.2-MariaDB-1:11.0.2+maria~ubu2204 dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
                               `pseudo` varchar(255) NOT NULL,
                               `nom` varchar(255) NOT NULL,
                               `prenom` varchar(255) NOT NULL,
                               `mail` varchar(255) NOT NULL,
                               `mdp` varchar(255) NOT NULL,
                               `admin` tinyint(1) NOT NULL DEFAULT 0,
                               `id` varchar(255) NOT NULL,
                               PRIMARY KEY (`id`),
                               UNIQUE KEY `tilisateur_pseudo_key` (`mail`),
                               UNIQUE KEY `utilisateur_id_key` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `utilisateur` (`pseudo`, `nom`, `prenom`, `mail`, `mdp`, `admin`, `id`) VALUES
    ('',	'',	'',	'clementoudin3@gmail.com',	'$2y$12$I59yT.F5TicBWzc8nnUAEekhdr7lnmCRDUG/fI1na5XjeU0kTIcta',	0,	'6cf23b9d5d0e2660e6c75c9f4a933508108f5b4928f4f60abf40efe0861f9ec3');


DROP TABLE IF EXISTS `categorie`;
CREATE TABLE `categorie` (
                             `id` bigint(20) NOT NULL AUTO_INCREMENT,
                             `libelle` text DEFAULT NULL,
                             `description` text DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `categorie` (`id`, `libelle`, `description`) VALUES
    (1,	'Jeux-Vidéo',	'La catégorie goat');

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
                           `id` bigint(20) NOT NULL AUTO_INCREMENT,
                           `titre` text DEFAULT NULL,
                           `resume` text DEFAULT NULL,
                           `contenu` text DEFAULT NULL,
                           `date_de_publication` datetime DEFAULT NULL,
                           `date_de_creation` datetime DEFAULT NULL,
                           `image` text DEFAULT NULL,
                           `cat_id` bigint(20) DEFAULT NULL,
                           `auteur` varchar(255) NOT NULL,
                           PRIMARY KEY (`id`),
                           KEY `article_auteur_fkey` (`auteur`),
                           KEY `article_cat_id_fkey` (`cat_id`),
                           CONSTRAINT `article_auteur_fkey` FOREIGN KEY (`auteur`) REFERENCES `utilisateur` (`id`),
                           CONSTRAINT `article_cat_id_fkey` FOREIGN KEY (`cat_id`) REFERENCES `categorie` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

INSERT INTO `article` (`id`, `titre`, `resume`, `contenu`, `date_de_publication`, `date_de_creation`, `image`, `cat_id`, `auteur`) VALUES
                                                                                                                                       (1,	'vrg',	'zvre',	'azra',	NULL,	NULL,	NULL,	1,	'6cf23b9d5d0e2660e6c75c9f4a933508108f5b4928f4f60abf40efe0861f9ec3'),
                                                                                                                                       (2,	'salut les gens',	'cest la vie',	'grfthrdf',	NULL,	NULL,	NULL,	NULL,	'6cf23b9d5d0e2660e6c75c9f4a933508108f5b4928f4f60abf40efe0861f9ec3'),
                                                                                                                                       (3,	'Quel est le meilleur jeux de l annee',	'Spoiler  c est pas FarmingSimulator',	'La bataille entre Hogward Legacy et Tear of the kingdom fait rage',	NULL,	NULL,	NULL,	NULL,	'6cf23b9d5d0e2660e6c75c9f4a933508108f5b4928f4f60abf40efe0861f9ec3'),
                                                                                                                                       (4,	'fortnite battlepass',	'900 v-bucks',	'ne pas acheter ce truc',	NULL,	NULL,	NULL,	1,	'6cf23b9d5d0e2660e6c75c9f4a933508108f5b4928f4f60abf40efe0861f9ec3');

-- 2023-06-20 14:58:00