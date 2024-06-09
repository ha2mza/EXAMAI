ALTER USER 'root'@'localhost' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;

-- Create the database
CREATE DATABASE IF NOT EXISTS examai;
USE examai;



SET time_zone = "+00:00";

CREATE TABLE `enseignant` (
                              `ID_ENSEIGNANT` int(11) NOT NULL AUTO_INCREMENT,
                              `NOM_ENSEIGNANT` varchar(75) DEFAULT NULL,
                              `PRENOM_ENSEIGNANT` varchar(75) DEFAULT NULL,
                              `MOT_DE_PASSE` varchar(40) DEFAULT NULL,
                              `EMAIL` varchar(30) DEFAULT NULL,
                              PRIMARY KEY (`ID_ENSEIGNANT`)
);

CREATE TABLE `candidat` (
                            `ID_CANDIDAT` int(11) NOT NULL AUTO_INCREMENT,
                            `NOM` varchar(75) DEFAULT NULL,
                            `PRENOM` varchar(75) DEFAULT NULL,
                            `MOT_DE_PASSE` varchar(40) DEFAULT NULL,
                            `EMAIL` varchar(30) DEFAULT NULL,
                            PRIMARY KEY (`ID_CANDIDAT`)
);

CREATE TABLE `question_type` (
                                 `ID_QUESTION_TYPE` int(11) NOT NULL AUTO_INCREMENT,
                                 `NOM` varchar(75) DEFAULT NULL,
                                 `CODE` varchar(50) DEFAULT NULL,
                                 PRIMARY KEY (`ID_QUESTION_TYPE`)
);

CREATE TABLE `classe` (
                          `ID_CLASSE` int(11) NOT NULL AUTO_INCREMENT,
                          `NOM_CLASSE` varchar(50) DEFAULT NULL,
                          `ANNEE` int(11) DEFAULT NULL,
                          `CODE` varchar(50) DEFAULT NULL,
                          `ID_ENSEIGNANT` int(11) DEFAULT NULL,
                          PRIMARY KEY (`ID_CLASSE`),
                          FOREIGN KEY (`ID_ENSEIGNANT`) REFERENCES `enseignant` (`ID_ENSEIGNANT`)
);

CREATE TABLE `cour` (
                        `ID_COUR` int(11) NOT NULL AUTO_INCREMENT,
                        `ID_ENSEIGNANT` int(11) NOT NULL,
                        `NOM_COUR` varchar(50) DEFAULT NULL,
                        PRIMARY KEY (`ID_COUR`),
                        FOREIGN KEY (`ID_ENSEIGNANT`) REFERENCES `enseignant` (`ID_ENSEIGNANT`)
);

CREATE TABLE `examen` (
                          `ID_EXAMEN` int(11) NOT NULL AUTO_INCREMENT,
                          `ID_ENSEIGNANT` int(11) NOT NULL,
                          `ID_CLASSE` int(11) NOT NULL,
                          `ID_COUR` int(11) DEFAULT NULL,
                          `TYPE` varchar(100) DEFAULT NULL,
                          `NATURE` varchar(100) DEFAULT NULL,
                          `DUREE` int(11) DEFAULT NULL,
                          `NB_DE_VERSION` int(11) DEFAULT NULL,
                          `STATUT` varchar(255) DEFAULT NULL,
                          `DATE_STRICTE` tinyint(1) DEFAULT NULL,
                          `QUESTIONS` text DEFAULT NULL,
                          `COMMENCE_A` datetime DEFAULT NULL,
                          `ORDRE_QUESTION` tinyint(1) DEFAULT NULL,
                          `ORDRE_CHOIX` tinyint(1) DEFAULT NULL,
                          `CREERA` timestamp NULL DEFAULT current_timestamp(),
                          PRIMARY KEY (`ID_EXAMEN`),
                          FOREIGN KEY (`ID_ENSEIGNANT`) REFERENCES `enseignant` (`ID_ENSEIGNANT`),
                          FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`),
                          FOREIGN KEY (`ID_COUR`) REFERENCES `cour` (`ID_COUR`)
);

CREATE TABLE `question` (
                            `ID_QUESTION` int(11) NOT NULL AUTO_INCREMENT,
                            `ID_COUR` int(11) NOT NULL,
                            `ID_QUESTION_TYPE` int(11) NOT NULL,
                            `TITRE` text DEFAULT NULL,
                            `CHOIX` text DEFAULT NULL,
                            `POSITION` int(11) DEFAULT NULL,
                            PRIMARY KEY (`ID_QUESTION`),
                            FOREIGN KEY (`ID_COUR`) REFERENCES `cour` (`ID_COUR`),
                            FOREIGN KEY (`ID_QUESTION_TYPE`) REFERENCES `question_type` (`ID_QUESTION_TYPE`)
);

CREATE TABLE `candidat_classe` (
                                   `id` int(11) NOT NULL AUTO_INCREMENT,
                                   `ID_CANDIDAT` int(11) NOT NULL,
                                   `ID_CLASSE` int(11) NOT NULL,
                                   PRIMARY KEY (`id`),
                                   FOREIGN KEY (`ID_CANDIDAT`) REFERENCES `candidat` (`ID_CANDIDAT`),
                                   FOREIGN KEY (`ID_CLASSE`) REFERENCES `classe` (`ID_CLASSE`)
);

CREATE TABLE `candidat_passage` (
                                    `id` int(11) NOT NULL AUTO_INCREMENT,
                                    `ID_CANDIDAT` int(11) NOT NULL,
                                    `ID_EXAMEN` int(11) NOT NULL,
                                    `CODE` varchar(50) DEFAULT NULL,
                                    `ENVOYE_A` datetime DEFAULT NULL,
                                    `NOTE` float DEFAULT NULL,
                                    `COMMENCE_A` datetime DEFAULT NULL,
                                    `TERMINE_A` datetime DEFAULT NULL,
                                    `LIEN` varchar(128) DEFAULT NULL,
                                    PRIMARY KEY (`id`),
                                    FOREIGN KEY (`ID_CANDIDAT`) REFERENCES `candidat` (`ID_CANDIDAT`),
                                    FOREIGN KEY (`ID_EXAMEN`) REFERENCES `examen` (`ID_EXAMEN`)
);

CREATE TABLE `candidat_repondre` (
                                     `id` int(11) NOT NULL AUTO_INCREMENT,
                                     `ID_CANDIDAT` int(11) NOT NULL,
                                     `ID_QUESTION` int(11) NOT NULL,
                                     `ID_EXAMEN` int(11) NOT NULL,
                                     `REPONDRE` text DEFAULT NULL,
                                     PRIMARY KEY (`id`),
                                     FOREIGN KEY (`ID_CANDIDAT`) REFERENCES `candidat` (`ID_CANDIDAT`),
                                     FOREIGN KEY (`ID_QUESTION`) REFERENCES `question` (`ID_QUESTION`),
                                     FOREIGN KEY (`ID_EXAMEN`) REFERENCES `examen` (`ID_EXAMEN`)
);





