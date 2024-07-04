CREATE TABLE `db`.`users` (`id` INT NOT NULL AUTO_INCREMENT , `login` VARCHAR(128) NOT NULL , `role` VARCHAR(64) NOT NULL , `name` VARCHAR(128) NULL , `enabled` TINYINT NOT NULL , `password` VARCHAR(255) NOT NULL , `token` VARCHAR(64) NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB;

INSERT INTO `users` (`id`, `login`, `role`, `name`, `enabled`, `password`, `token`
) VALUES (
          1, 'odmen', 'admin', 'Администратор', '1',
          '$2y$10$McQ031FtjO2bPFV2eCuk1.KXPQMhOyEwx.Vklqqm7tLyKDutfSaCO',
          NULL);

INSERT INTO `users` (`id`, `login`, `role`, `name`, `enabled`, `password`, `token`
) VALUES (
             2, 'crm', 'user', 'Администратор', '0', 'unavailable', NULL);



CREATE TABLE `db`.`log_users` (`id` INT NOT NULL AUTO_INCREMENT , `id_user` INT NOT NULL , `alias` VARCHAR(32) NOT NULL , `text` TEXT NOT NULL , `created_at` DATETIME NOT NULL , `data` JSON NULL , PRIMARY KEY (`id`), INDEX (`id_user`)) ENGINE = InnoDB;