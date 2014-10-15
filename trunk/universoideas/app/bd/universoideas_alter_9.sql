-- -----------------------------------------------------
-- Table `estudiantes`.`custom_texts`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `estudiantes`.`custom_texts` (
  `id` INT NOT NULL ,
  `section` VARCHAR(45) NOT NULL ,
  `body` VARCHAR(5500) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;

ALTER TABLE `estudiantes`.`custom_texts` 
ADD UNIQUE INDEX `section_UNIQUE` (`section` ASC) ;

ALTER TABLE `estudiantes`.`custom_texts` CHANGE COLUMN `id` `id` INT(11) NOT NULL AUTO_INCREMENT  ;

ALTER TABLE `estudiantes`.`events` CHANGE COLUMN `description` `description` VARCHAR(3000) NOT NULL  , ADD COLUMN `category` VARCHAR(100) NOT NULL  AFTER `name` , ADD COLUMN `event_end_date` DATE NULL  AFTER `event_date` ;

ALTER TABLE `estudiantes`.`cursos` CHANGE COLUMN `description` `description` VARCHAR(3000) NOT NULL  , ADD COLUMN `category` VARCHAR(100) NOT NULL  AFTER `name` , ADD COLUMN `end_date` DATE NULL  AFTER `date` ;
