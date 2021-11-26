SET FOREIGN_KEY_CHECKS = 0;

CREATE DATABASE IF NOT EXISTS `testapp_tests`;

USE `testapp_tests`;

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` ( `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`open_banking_user_id` VARCHAR(255) NOT NULL ,
`created_at` DATETIME NOT NULL ,
`status` ENUM('ACTIVE','INACTIVE') NULL DEFAULT 'ACTIVE' ,
PRIMARY KEY (`id`)) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci;

DROP TABLE IF EXISTS `user_account_balances`;

CREATE TABLE `user_account_balances` (
`id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_id` int(10) UNSIGNED NOT NULL,
`cash_balance` decimal(16,2) DEFAULT NULL,
`previous_cash_balance` decimal(16,2) DEFAULT NULL,
`status` enum('ACTIVE','INACTIVE') NULL DEFAULT 'ACTIVE',
`created_at` datetime NOT NULL,
`updated_at` datetime DEFAULT current_timestamp(),
PRIMARY KEY (`id`),
KEY `user_id` (`user_id`),
CONSTRAINT `user_account_balances_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `user_account_balance_thresholds`;

CREATE TABLE `user_account_balance_thresholds` ( `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT ,
`user_id` INT(10) UNSIGNED NOT NULL ,
`threshold_balance` DECIMAL(16,2) NULL,
`created_at` DATETIME NOT NULL ,
`updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `user_id` (`user_id`),
CONSTRAINT `user_account_balance_thresholds_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci


DROP TABLE IF EXISTS `user_transaction_histories`;

CREATE TABLE `user_transaction_histories` (
`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
`user_account_balance_id` INT(10) UNSIGNED NOT NULL,
`cash_balance` DECIMAL(16,2) NULL ,
`previous_cash_balance` DECIMAL(16,2) NULL ,
`type` ENUM('CREDIT','DEBIT') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'CREDIT' ,
`status` ENUM('ACTIVE','INACTIVE') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT 'ACTIVE' ,
`created_at` DATETIME NOT NULL ,
`updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
PRIMARY KEY (`id`),
KEY `user_account_balance_id` (`user_account_balance_id`),
CONSTRAINT `user_transaction_histories_ibfk_1` FOREIGN KEY (`user_account_balance_id`) REFERENCES `user_account_balances` (`id`) ON DELETE CASCADE
) ENGINE = InnoDB CHARSET=utf8mb4 COLLATE utf8mb4_general_ci
