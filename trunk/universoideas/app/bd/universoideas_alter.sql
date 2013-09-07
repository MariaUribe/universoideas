SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

ALTER TABLE `estudiantes`.`users` ADD COLUMN `twitter` VARCHAR(16) NULL DEFAULT NULL  AFTER `modified` , ADD COLUMN `securityAnswer` VARCHAR(100) NOT NULL  AFTER `twitter` , ADD COLUMN `question_id` INT(11) NOT NULL  AFTER `securityAnswer` , 
  ADD CONSTRAINT `fk_users_questions1`
  FOREIGN KEY (`question_id` )
  REFERENCES `estudiantes`.`questions` (`id` )
  ON DELETE NO ACTION
  ON UPDATE NO ACTION
, ADD UNIQUE INDEX `mail_UNIQUE` (`mail` ASC) 
, ADD INDEX `fk_users_questions1_idx` (`question_id` ASC) ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`emprendedores` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(100) NOT NULL ,
  `description` VARCHAR(1500) NOT NULL ,
  `status` VARCHAR(2) NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  `user_id` INT(11) NOT NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_emprendedores_users1_idx` (`user_id` ASC) ,
  CONSTRAINT `fk_emprendedores_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `estudiantes`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`questions` (
  `id` INT(11) NOT NULL AUTO_INCREMENT ,
  `question` VARCHAR(200) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
