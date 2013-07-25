SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

DROP SCHEMA IF EXISTS `estudiantes` ;
CREATE SCHEMA IF NOT EXISTS `estudiantes` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `estudiantes` ;

-- -----------------------------------------------------
-- Table `estudiantes`.`roles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`roles` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`roles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `role_type` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estudiantes`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`users` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `username` VARCHAR(20) NOT NULL ,
  `password` VARCHAR(45) NOT NULL ,
  `name` VARCHAR(45) NOT NULL ,
  `lastname` VARCHAR(45) NOT NULL ,
  `mail` VARCHAR(45) NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  `roles_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_users_roles1`
    FOREIGN KEY (`roles_id` )
    REFERENCES `estudiantes`.`roles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `username_UNIQUE` ON `estudiantes`.`users` (`username` ASC) ;

CREATE INDEX `fk_users_roles1_idx` ON `estudiantes`.`users` (`roles_id` ASC) ;


-- -----------------------------------------------------
-- Table `estudiantes`.`articles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`articles` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`articles` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(45) NOT NULL ,
  `summary` VARCHAR(256) NOT NULL ,
  `body` VARCHAR(1024) NOT NULL ,
  `channel` VARCHAR(45) NOT NULL ,
  `enabled` TINYINT(1) NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estudiantes`.`users_articles`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`users_articles` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`users_articles` (
  `user_id` VARCHAR(20) NOT NULL ,
  `article_id` INT NOT NULL ,
  PRIMARY KEY (`user_id`, `article_id`) ,
  CONSTRAINT `fk_USUARIO_has_ARTICULO_USUARIO1`
    FOREIGN KEY (`user_id` )
    REFERENCES `estudiantes`.`users` (`username` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_USUARIO_has_ARTICULO_ARTICULO1`
    FOREIGN KEY (`article_id` )
    REFERENCES `estudiantes`.`articles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_USUARIO_has_ARTICULO_ARTICULO1_idx` ON `estudiantes`.`users_articles` (`article_id` ASC) ;

CREATE INDEX `fk_USUARIO_has_ARTICULO_USUARIO1_idx` ON `estudiantes`.`users_articles` (`user_id` ASC) ;


-- -----------------------------------------------------
-- Table `estudiantes`.`related_images`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`related_images` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`related_images` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `uri` VARCHAR(100) NOT NULL ,
  `name` VARCHAR(45) NULL ,
  `title` VARCHAR(45) NULL ,
  `uri_thumb` VARCHAR(100) NULL ,
  `width` INT NOT NULL ,
  `height` INT NOT NULL ,
  `width_thumb` INT NULL ,
  `height_thumb` INT NULL ,
  `article_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_related_medias_articles1`
    FOREIGN KEY (`article_id` )
    REFERENCES `estudiantes`.`articles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_related_medias_articles1_idx` ON `estudiantes`.`related_images` (`article_id` ASC) ;


-- -----------------------------------------------------
-- Table `estudiantes`.`forums`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`forums` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`forums` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `title` VARCHAR(100) NOT NULL ,
  `field` VARCHAR(100) NOT NULL ,
  `aproved` TINYINT(1) NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_forums_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `estudiantes`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_forums_users1_idx` ON `estudiantes`.`forums` (`user_id` ASC) ;


-- -----------------------------------------------------
-- Table `estudiantes`.`comments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`comments` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`comments` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(400) NOT NULL ,
  `forum_id` INT NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_comments_forums1`
    FOREIGN KEY (`forum_id` )
    REFERENCES `estudiantes`.`forums` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_comments_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `estudiantes`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_comments_forums1_idx` ON `estudiantes`.`comments` (`forum_id` ASC) ;

CREATE INDEX `fk_comments_users1_idx` ON `estudiantes`.`comments` (`user_id` ASC) ;


-- -----------------------------------------------------
-- Table `estudiantes`.`related_videos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`related_videos` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`related_videos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(45) NOT NULL ,
  `source` VARCHAR(500) NOT NULL ,
  `article_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_related_videos_articles1`
    FOREIGN KEY (`article_id` )
    REFERENCES `estudiantes`.`articles` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_related_videos_articles1_idx` ON `estudiantes`.`related_videos` (`article_id` ASC) ;


-- -----------------------------------------------------
-- Table `estudiantes`.`cursos`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`cursos` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`cursos` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(65) NOT NULL ,
  `description` VARCHAR(300) NOT NULL ,
  `date` DATE NOT NULL ,
  `enabled` TINYINT(1) NOT NULL ,
  `image` VARCHAR(100) NULL ,
  `image_thumb` VARCHAR(100) NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estudiantes`.`events`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`events` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`events` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(65) NOT NULL ,
  `place` VARCHAR(65) NOT NULL ,
  `event_date` DATE NOT NULL ,
  `init_time` VARCHAR(8) NOT NULL ,
  `end_time` VARCHAR(8) NOT NULL ,
  `image` VARCHAR(100) NULL ,
  `image_thumb` VARCHAR(100) NULL ,
  `enabled` TINYINT(1) NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `estudiantes`.`enterprises`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`enterprises` ;

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


-- -----------------------------------------------------
-- Table `estudiantes`.`postulations`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `estudiantes`.`postulations` ;

CREATE  TABLE IF NOT EXISTS `estudiantes`.`postulations` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `description` VARCHAR(100) NOT NULL ,
  `duration` VARCHAR(50) NOT NULL ,
  `enabled` TINYINT(1) NOT NULL ,
  `created` DATE NOT NULL ,
  `modified` DATE NOT NULL ,
  `user_id` INT NOT NULL ,
  PRIMARY KEY (`id`) ,
  CONSTRAINT `fk_postulations_users1`
    FOREIGN KEY (`user_id` )
    REFERENCES `estudiantes`.`users` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `fk_postulations_users1_idx` ON `estudiantes`.`postulations` (`user_id` ASC) ;

USE `estudiantes` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
