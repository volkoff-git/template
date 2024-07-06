CREATE TABLE `users` (`id` INT NOT NULL AUTO_INCREMENT , `login` VARCHAR(128) NOT NULL , `role` VARCHAR(64) NOT NULL , `name` VARCHAR(128) NULL , `enabled` TINYINT NOT NULL , `password` VARCHAR(255) NOT NULL , `token` VARCHAR(64) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `users` (`id`, `login`, `role`, `name`, `enabled`, `password`, `token`
) VALUES (
          1, 'odmen', 'admin', 'Администратор', '1',
          '$2y$10$McQ031FtjO2bPFV2eCuk1.KXPQMhOyEwx.Vklqqm7tLyKDutfSaCO',
          NULL);

INSERT INTO `users` (`id`, `login`, `role`, `name`, `enabled`, `password`, `token`
) VALUES (
             2, 'crm', 'user', 'Cистема', '0', 'unavailable', NULL);



CREATE TABLE `log_users` (`id` INT NOT NULL AUTO_INCREMENT , `id_user` INT NOT NULL , `alias` VARCHAR(32) NOT NULL , `text` TEXT NOT NULL , `created_at` DATETIME NOT NULL , `data` JSON NULL , PRIMARY KEY (`id`), INDEX (`id_user`)) ENGINE = InnoDB;

CREATE TABLE `leads` (`id` INT NOT NULL AUTO_INCREMENT , `id_user` INT NOT NULL , `phone` VARCHAR(10) NOT NULL , `name` VARCHAR(128) NULL , `name_last` VARCHAR(32) NULL , `name_middle` VARCHAR(32) NULL , `stage` VARCHAR(16) NOT NULL , `source` INT NOT NULL , `priority` INT NOT NULL , `show_at` DATETIME NULL , `created_at` DATETIME NOT NULL , `closed_at` DATETIME NULL , `lash_hist_id` INT NULL , `guarantor_for` INT NULL , `referral_for` INT NULL , PRIMARY KEY (`id`), INDEX (`id_user`), INDEX (`phone`), INDEX (`stage`)) ENGINE = InnoDB;
ALTER TABLE `leads` CHANGE `created_at` `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP;
ALTER TABLE `leads` CHANGE `id_user` `id_user` INT(11) NULL;