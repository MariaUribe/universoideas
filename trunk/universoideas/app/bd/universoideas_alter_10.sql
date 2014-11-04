-- -----------------------------------------------------
-- Table `estudiantes`.`custom_texts`
-- -----------------------------------------------------
ALTER TABLE `estudiantes`.`custom_texts` CHANGE COLUMN `body` `body` VARCHAR(16000) NOT NULL  , ADD COLUMN `description` VARCHAR(5000) NULL  AFTER `body` ;
