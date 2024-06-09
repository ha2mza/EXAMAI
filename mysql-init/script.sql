ALTER USER 'root'@'localhost' IDENTIFIED BY 'password';
FLUSH PRIVILEGES;

-- Create the database
CREATE DATABASE IF NOT EXISTS examai;
USE examai;

CREATE TABLE `classes` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `name` varchar(255) DEFAULT NULL,
                           `year` int DEFAULT NULL,
                           `action_user` int DEFAULT NULL,
                           `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                           `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                           `deleted_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `class_condidats` (
                                   `id` int NOT NULL AUTO_INCREMENT,
                                   `condidat_id` int DEFAULT NULL,
                                   `class_id` int DEFAULT NULL,
                                   PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `condidats` (
                             `id` int NOT NULL AUTO_INCREMENT,
                             `first_name` varchar(255) DEFAULT NULL,
                             `last_name` varchar(255) DEFAULT NULL,
                             `email` varchar(255) DEFAULT NULL,
                             `action_user` int DEFAULT NULL,
                             `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                             `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                             `deleted_at` timestamp NULL DEFAULT NULL,
                             PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `condidat_answers` (
                                    `id` int NOT NULL AUTO_INCREMENT,
                                    `exam_id` int DEFAULT NULL,
                                    `version_id` int DEFAULT NULL,
                                    `question_id` int DEFAULT NULL,
                                    `reponse` longtext,
                                    `correct` tinyint(1) DEFAULT '0',
                                    `condidat_id` int DEFAULT NULL,
                                    PRIMARY KEY (`id`)
);

CREATE TABLE `exams` (
                         `id` int NOT NULL AUTO_INCREMENT,
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
                         `status` varchar(120) DEFAULT NULL,
                         PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `exam_versions` (
                                 `id` int NOT NULL AUTO_INCREMENT,
                                 `exam_id` int DEFAULT NULL,
                                 `question` longtext,
                                 PRIMARY KEY (`id`)
);

CREATE TABLE `exam_version_condidats` (
                                          `id` int NOT NULL AUTO_INCREMENT,
                                          `version_id` int DEFAULT NULL,
                                          `condidat_id` int DEFAULT NULL,
                                          `code` varchar(250) DEFAULT NULL,
                                          `sent_at` timestamp NULL DEFAULT NULL,
                                          `note` double DEFAULT NULL,
                                          `started_at` timestamp NULL DEFAULT NULL,
                                          `ended_at` timestamp NULL DEFAULT NULL,
                                          PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `modules` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `name` varchar(250) DEFAULT NULL,
                           `action_user` int DEFAULT NULL,
                           `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
                           `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                           `deleted_at` timestamp NULL DEFAULT NULL,
                           PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `module_qcms` (
                               `id` int NOT NULL AUTO_INCREMENT,
                               `module_id` int DEFAULT NULL,
                               `title` text,
                               `choice` longtext,
                               `action_user` int DEFAULT NULL,
                               `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                               `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                               `deleted_at` timestamp NULL DEFAULT NULL,
                               `qcm_type_id` int DEFAULT NULL,
                               PRIMARY KEY (`id`)
);

CREATE TABLE `qcm_type` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `name` varchar(250) DEFAULT NULL,
                            `code` varchar(250) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `teachers` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `first_name` varchar(255) DEFAULT NULL,
                            `last_name` varchar(255) DEFAULT NULL,
                            `email` varchar(255) DEFAULT NULL,
                            `password` varchar(255) DEFAULT NULL,
                            `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
                            `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            `deleted_at` timestamp NULL DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
