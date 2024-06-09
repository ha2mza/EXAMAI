ALTER USER 'root'@'localhost' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;

-- Create the database
CREATE DATABASE IF NOT EXISTS examai;
USE examai;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;


CREATE TABLE `classes` (
                           `id` int NOT NULL,
                           `name` varchar(255) DEFAULT NULL,
                           `year` int DEFAULT NULL,
                           `action_user` int DEFAULT NULL,
                           `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                           `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                           `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `class_condidats` (
                                   `id` int NOT NULL,
                                   `condidat_id` int DEFAULT NULL,
                                   `class_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `condidats` (
                             `id` int NOT NULL,
                             `first_name` varchar(255) DEFAULT NULL,
                             `last_name` varchar(255) DEFAULT NULL,
                             `email` varchar(255) DEFAULT NULL,
                             `action_user` int DEFAULT NULL,
                             `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                             `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                             `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `condidat_answers` (
                                    `id` int NOT NULL,
                                    `exam_id` int DEFAULT NULL,
                                    `version_id` int DEFAULT NULL,
                                    `question_id` int DEFAULT NULL,
                                    `reponse` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
                                    `correct` tinyint(1) DEFAULT '0',
                                    `condidat_id` int DEFAULT NULL
) ;

CREATE TABLE `exams` (
                         `id` int NOT NULL,
                         `type` varchar(120) DEFAULT NULL,
                         `nature` varchar(255) DEFAULT NULL,
                         `module_id` int DEFAULT NULL,
                         `duree` int DEFAULT '60',
                         `passed_at` datetime DEFAULT NULL,
                         `action_user` int DEFAULT NULL,
                         `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                         `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                         `deleted_at` timestamp NULL DEFAULT NULL,
                         `class_id` int DEFAULT NULL,
                         `number_version` int DEFAULT '1',
                         `change_qcm_order` tinyint(1) DEFAULT NULL,
                         `change_condidats_order` tinyint(1) DEFAULT NULL,
                         `strict_date` tinyint(1) DEFAULT '1',
                         `status` varchar(120) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `exam_versions` (
                                 `id` int NOT NULL,
                                 `exam_id` int DEFAULT NULL,
                                 `question` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin
) ;

CREATE TABLE `exam_version_condidats` (
                                          `id` int NOT NULL,
                                          `version_id` int DEFAULT NULL,
                                          `condidat_id` int DEFAULT NULL,
                                          `code` varchar(250) DEFAULT NULL,
                                          `sent_at` timestamp NULL DEFAULT NULL,
                                          `note` double DEFAULT NULL,
                                          `started_at` timestamp NULL DEFAULT NULL,
                                          `ended_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `modules` (
                           `id` int NOT NULL,
                           `name` varchar(250) DEFAULT NULL,
                           `action_user` int DEFAULT NULL,
                           `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                           `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                           `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

CREATE TABLE `module_qcms` (
                               `id` int NOT NULL,
                               `module_id` int DEFAULT NULL,
                               `title` text,
                               `choice` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin,
                               `action_user` int DEFAULT NULL,
                               `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                               `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                               `deleted_at` timestamp NULL DEFAULT NULL,
                               `qcm_type_id` int DEFAULT NULL
) ;

CREATE TABLE `qcm_type` (
                            `id` int NOT NULL,
                            `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
                            `code` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `teachers` (
                            `id` int NOT NULL,
                            `first_name` varchar(255) DEFAULT NULL,
                            `last_name` varchar(255) DEFAULT NULL,
                            `email` varchar(255) DEFAULT NULL,
                            `password` varchar(255) DEFAULT NULL,
                            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;


ALTER TABLE `classes`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `class_condidats`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `condidats`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `condidat_answers`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `exams`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `exam_versions`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `exam_version_condidats`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `modules`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `module_qcms`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `qcm_type`
    ADD PRIMARY KEY (`id`);

ALTER TABLE `teachers`
    ADD PRIMARY KEY (`id`);


ALTER TABLE `classes`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `class_condidats`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `condidats`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `condidat_answers`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `exams`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `exam_versions`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `exam_version_condidats`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `modules`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `module_qcms`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `qcm_type`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

ALTER TABLE `teachers`
    MODIFY `id` int NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
