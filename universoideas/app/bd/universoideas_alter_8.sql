ALTER TABLE `jrivas_estudiantes`.`related_images` DROP FOREIGN KEY `fk_related_medias_articles1` ;
ALTER TABLE `jrivas_estudiantes`.`related_images` 
  ADD CONSTRAINT `fk_related_medias_articles1`
  FOREIGN KEY (`article_id` )
  REFERENCES `estudiantes`.`articles` (`id` )
  ON DELETE CASCADE
  ON UPDATE NO ACTION;
