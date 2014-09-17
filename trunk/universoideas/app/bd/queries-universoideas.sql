select * 
from estudiantes.related_images
where article_id = 1;

select * 
from estudiantes.related_videos;
-- where article_id = 1;

select * 
from estudiantes.questions;

select *
from estudiantes.articles
where enabled = 1
and highlight = 0
order by modified desc
limit 15;

select a.id, a.title, a.summary, a.enabled, a.created, a.modified, i.id as image_id, i.uri, i.uri_thumb, i.article_id
from estudiantes.articles a, estudiantes.related_images i
where a.id = i.article_id
and a.enabled = 1
order by a.modified desc
limit 5;

-- 1, 65, 35, 28, 24


select art.id, art.title, art.summary, art.enabled, art.created, art.modified, img.id as image_id, img.uri, img.uri_thumb, img.title, img.article_id, vid.id as video_id, vid.name as video_name, vid.source, vid.article_id as video_article_id
from estudiantes.articles art
left join estudiantes.related_images img on art.id = img.article_id
left join estudiantes.related_videos vid on art.id = vid.article_id
where art.enabled = 1
order by art.modified desc, art.id asc
limit 5;


select * 
from estudiantes.articles
where enabled = 0
order by id asc;
-- limit 5;

select * 
from estudiantes.forums
order by id asc;

select * 
from estudiantes.cursos
order by id asc;

select *
from estudiantes.events
where enabled = 1
order by event_date desc;

select *
from estudiantes.users;

select *
from estudiantes.emprendedores;

select *
from estudiantes.roles;

select *
from estudiantes.forums;


SELECT `Forum`.`id`, `Forum`.`title`, `Forum`.`enabled`, `Forum`.`user_id`, `Forum`.`created`, `Forum`.`modified`, `User`.`id`, `User`.`username`, `User`.`password`, `User`.`name`, `User`.`lastname`, `User`.`mail`, `User`.`created`, `User`.`modified`, `User`.`role_id` FROM `estudiantes`.`forums` AS `Forum` LEFT JOIN `estudiantes`.`users` AS `User` ON (`Forum`.`user_id` = `User`.`id`) WHERE `Forum`.`user_id` = 5 ORDER BY `Forum`.`modified` desc;


SELECT art.id, art.channel, art.title, art.summary, art.enabled, art.created, art.modified, 
	   img.id as image_id, img.uri, img.uri_thumb, img.title, img.article_id as img_article_id, 
	   vid.id as video_id, vid.name as video_name, vid.source, vid.article_id as vid_article_id 
FROM estudiantes.articles art 
	LEFT JOIN estudiantes.related_images img on art.id = img.article_id 
	LEFT JOIN estudiantes.related_videos vid on art.id = vid.article_id 
WHERE art.enabled = 1 
	AND art.highlight = 1 
	AND art.channel = 'encuentrame'
ORDER BY art.modified desc, art.id asc 
LIMIT 5;

-- TODOS LOS FOROS HABILITADOS
SELECT forum.id, forum.title, forum.content, forum.enabled, forum.user_id, forum.created, forum.modified,
	   usr.id as userid, usr.username, usr.name, usr.lastname, usr.mail, usr.role_id, COUNT(comments.id)
-- (SELECT COUNT(comments.id) FROM estudiantes.comments comments WHERE comments.forum_id = forum.id) as count
FROM estudiantes.forums forum
LEFT JOIN estudiantes.users usr on forum.user_id = usr.id
LEFT JOIN estudiantes.comments comments on forum.id = comments.forum_id
WHERE forum.enabled = 1
ORDER BY forum.modified desc
LIMIT 100;



SELECT COUNT(Comments.id) as count, forum.id, forum.title, forum.content, forum.enabled, forum.user_id, forum.created, forum.modified,
	   usr.id as userid, usr.username, usr.name, usr.lastname, usr.mail, usr.role_id
FROM estudiantes.forums forum
LEFT JOIN estudiantes.users usr on forum.user_id = usr.id
LEFT JOIN estudiantes.comments Comments on forum.id = Comments.forum_id 
WHERE forum.enabled = 1
GROUP BY forum.id
ORDER BY forum.modified desc
LIMIT 100;



SELECT Comments.id, MAX(Comments.modified), forum.id, forum.title, forum.content, forum.enabled, forum.user_id, forum.created, forum.modified,
	   usr.id as userid, usr.username, usr.name, usr.lastname, usr.mail, usr.role_id
FROM estudiantes.forums forum
LEFT JOIN estudiantes.users usr on forum.user_id = usr.id
LEFT JOIN estudiantes.comments Comments on forum.id = Comments.forum_id
WHERE forum.enabled = 1
GROUP BY forum.id
ORDER BY forum.modified desc
LIMIT 100;


ALTER DATABASE estudiantes CHARACTER SET utf8 COLLATE ISO-8859-1;



select * 
from estudiantes.questions;


select *
from estudiantes.comments Comments
where Comments.forum_id = 7
order by Comments.modified desc;

SELECT COUNT(comments.id) as cant_comments
FROM estudiantes.comments comments
WHERE comments.forum_id = 7;

-- FORO POR ID
SELECT forum.id, forum.title, forum.content, forum.enabled, forum.user_id, forum.created, forum.modified,
	   usr.id as userid, usr.username, usr.name, usr.lastname, usr.mail, usr.role_id
FROM estudiantes.forums forum
LEFT JOIN estudiantes.users usr on forum.user_id = usr.id
WHERE forum.id = 7;


SELECT Forum.id, Forum.title, Forum.content, Forum.enabled, Forum.user_id, Forum.created, Forum.modified,
                             User.id as userid, User.username, User.name, User.lastname, User.mail, User.role_id 
                      FROM estudiantes.forums Forum 
                      LEFT JOIN estudiantes.users User on Forum.user_id = User.id 
                      WHERE Forum.id = 7;


-- COMENTARIOS POR FORUM_ID
SELECT comments.id, comments.description, comments.forum_id, comments.user_id, comments.created, comments.modified,
	   usr.id as userid, usr.username, usr.name, usr.lastname, usr.mail, usr.role_id
FROM estudiantes.comments comments
LEFT JOIN estudiantes.users usr on comments.user_id = usr.id
WHERE comments.forum_id = 7
ORDER BY comments.modified desc;


SELECT (COUNT(`Comment`.`id`)) AS `Forum__count`, `Forum`.`id` 
FROM `estudiantes`.`forums` AS `Forum` 
LEFT JOIN `estudiantes`.`comments` AS `Comment` ON (`Comment`.`forum_id` = `Forum`.`id`) 
LEFT JOIN `estudiantes`.`users` AS `User` ON (`Forum`.`user_id` = `User`.`id`) 
WHERE `Forum`.`enabled` = '1' 
GROUP BY `Forum`.`id` 
ORDER BY `Forum`.`modified` desc 
LIMIT 100;


SELECT art.id, art.channel, art.title, art.summary, art.enabled, art.created, art.modified, 
                       img.id as image_id, img.uri, img.uri_thumb, img.title, img.article_id as img_article_id, 
                       vid.id as video_id, vid.name as video_name, vid.source, vid.article_id as vid_article_id 
                FROM estudiantes.articles art 
                LEFT JOIN estudiantes.related_images img on art.id = img.article_id 
                LEFT JOIN estudiantes.related_videos vid on art.id = vid.article_id 
                WHERE art.id = 74;

select *
from estudiantes.events;

select *
from estudiantes.cursos;

SELECT article.id, article.title, article.summary, article.enabled, article.created, article.modified 
FROM estudiantes.articles article 
WHERE (article.title LIKE '%diam rhoncus%'
	   OR article.summary LIKE '%diam rhoncus%')
AND article.enabled = 1
LIMIT 5;

SELECT event.id, event.name, event.description, event.enabled, event.created, event.modified 
FROM estudiantes.events event 
WHERE (event.name LIKE '%diam%'
	   OR event.description LIKE '%diam%')
AND event.enabled = 1
LIMIT 5;

SELECT curso.id, curso.name, curso.description, curso.enabled, curso.created, curso.modified 
FROM estudiantes.cursos curso 
WHERE (curso.name LIKE '%dolor%'
	   OR curso.description LIKE '%dolor%')
AND curso.enabled = 1
LIMIT 5;

SELECT forum.id, forum.title, forum.content, forum.enabled, forum.created, forum.modified, user.username 
FROM estudiantes.forums forum 
LEFT JOIN estudiantes.users user ON user.id = forum.user_id
WHERE (forum.title LIKE '%dolor%'
	   OR forum.content LIKE '%dolor%')
AND forum.enabled = 1
LIMIT 5;


select * from estudiantes.users;

SELECT user.id, user.username, user.name, user.lastname, user.mail, user.role_id
FROM estudiantes.users user
WHERE user.mail = 'mariale.uribe@gmail.com';

UPDATE `estudiantes`.`users` SET `mail` = 'mariale.uribe@gmail.com', `id` = 4, `password` = 'efe96bad621fca17332bd9dd1a4b304ef7ae0865', `modified` = '2013-08-19'
WHERE `estudiantes`.`users`.`id` = '4';

UPDATE `estudiantes`.`users` SET `mail` = 'mariale.uribe@gmail.com', `password` = '44a3ebd4efddb3902afdc1e63c06d63f89389537', `modified` = '2013-08-19' WHERE `estudiantes`.`users`.`id` = '4';


ALTER TABLE `estudiantes`.`events` CHANGE COLUMN `created` `created` DATETIME NOT NULL  , CHANGE COLUMN `modified` `modified` DATETIME NOT NULL  ;

ALTER TABLE `estudiantes`.`cursos` CHANGE COLUMN `created` `created` DATETIME NOT NULL  , CHANGE COLUMN `modified` `modified` DATETIME NOT NULL  ;

ALTER TABLE `estudiantes`.`users` CHANGE COLUMN `lastname` `lastname` VARCHAR(45) NULL DEFAULT NULL  , CHANGE COLUMN `gender` `gender` VARCHAR(1) NULL DEFAULT NULL  ;







ALTER TABLE `estudiantes`.`articles` CHANGE COLUMN `title` `title` VARCHAR(150) NOT NULL  ;

ALTER TABLE `estudiantes`.`cursos` CHANGE COLUMN `name` `name` VARCHAR(150) NOT NULL  ;

ALTER TABLE `estudiantes`.`events` CHANGE COLUMN `name` `name` VARCHAR(150) NOT NULL  ;

ALTER TABLE `estudiantes`.`enterprises` CHANGE COLUMN `enterprise` `enterprise` VARCHAR(150) NOT NULL  ;

ALTER TABLE `estudiantes`.`emprendedores` CHANGE COLUMN `title` `title` VARCHAR(150) NOT NULL  ;
