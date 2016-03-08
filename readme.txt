






				CREATE TABLE `dbible`.`u11111` ( `id` INT(16) NOT NULL AUTO_INCREMENT COMMENT 'уникальный номер' , `d` VARCHAR(56) NOT NULL DEFAULT '00.00.00' COMMENT 'дата записи' , `c` VARCHAR(300) NOT NULL DEFAULT '0' COMMENT 'прочитаные главы' , `n` VARCHAR(16) NOT NULL DEFAULT '0' COMMENT 'кол-во глав' , `s` VARCHAR(1000) NOT NULL DEFAULT 'oh its empty! Ok then.' COMMENT 'коментарий' , UNIQUE (`id`)) ENGINE = InnoDB;





				INSERT INTO `u11111` (`id`, `d`, `c`, `n`, `s`) VALUES (NULL, '06.03.16', 'Екл 1,2,3,4', '4', 'У,В RAM'), (NULL, '05.03.16', '29,30,31', '3', 'У,В')
				
				
				
				
				DELETE FROM `u11111` WHERE `u11111`.`id` = 3"