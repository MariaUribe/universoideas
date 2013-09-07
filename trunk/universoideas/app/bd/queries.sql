CREATE  TABLE IF NOT EXISTS `estudiantes`.`enterprises` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `enterprise` VARCHAR(65) NOT NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `description` VARCHAR(150) NOT NULL ,
  `duration` VARCHAR(50) NOT NULL ,
  `enabled` TINYINT(1) NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;
