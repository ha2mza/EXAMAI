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

CREATE VIEW `candidat_repd` AS
SELECT `candidat_repondre`.`id` AS `id`,
       `candidat_repondre`.`ID_CANDIDAT` AS `ID_CANDIDAT`,
       `candidat_repondre`.`ID_QUESTION` AS `ID_QUESTION`,
       `candidat_repondre`.`ID_EXAMEN` AS `ID_EXAMEN`,
       `candidat_repondre`.`REPONDRE` AS `REPONDRE`,
       `opt`.`reponse` AS `reponse`
FROM (`candidat_repondre`
         JOIN JSON_TABLE(`candidat_repondre`.`REPONDRE`, '$[*]' COLUMNS (`reponse` int(11) PATH '$' DEFAULT '' ON EMPTY DEFAULT 'N' ON ERROR)) `opt`);

CREATE VIEW `options` AS
SELECT `question`.`ID_QUESTION` AS `ID_QUESTION`,
       `option`.`rowid` AS `rowid`,
       `option`.`titre` AS `titre`,
       `option`.`correct` AS `correct`
FROM (`question`
         JOIN JSON_TABLE(`question`.`CHOIX`, '$[*]' COLUMNS (`rowid` int(11) PATH '$.index', `titre` varchar(100) PATH '$.titre' DEFAULT '' ON EMPTY DEFAULT 'N' ON ERROR, `correct` tinyint(1) PATH '$.correct')) `option`);

CREATE VIEW `reponse` AS
SELECT `candidat_repondre`.`id` AS `id`,
       `candidat_repondre`.`ID_CANDIDAT` AS `ID_CANDIDAT`,
       `candidat_repondre`.`ID_QUESTION` AS `ID_QUESTION`,
       `candidat_repondre`.`ID_EXAMEN` AS `ID_EXAMEN`,
       `candidat_repondre`.`REPONDRE` AS `REPONDRE`,
       `option_correct`.`rep` AS `rep`,
       `option_correct`.`rep`= `candidat_repondre`.`REPONDRE` AS `correct`
FROM (`candidat_repondre`
         JOIN (SELECT `options`.`ID_QUESTION` AS `ID_QUESTION`,
                      CONCAT('[', COALESCE(GROUP_CONCAT(CONCAT('"', `options`.`rowid` ,'"') ORDER BY `options`.`rowid` DESC SEPARATOR ','), ''), ']') AS `rep`
               FROM `options`
               WHERE `options`.`correct` = 1
               GROUP BY `options`.`ID_QUESTION`
               ORDER BY `options`.`rowid`) `option_correct`)
WHERE `option_correct`.`ID_QUESTION` = `candidat_repondre`.`ID_QUESTION`;
