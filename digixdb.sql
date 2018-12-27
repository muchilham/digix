/*
SQLyog Ultimate v10.42 
MySQL - 5.5.5-10.1.30-MariaDB : Database - digixdbv2
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
/* Procedure structure for procedure `sp__examquestiondetail_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__examquestiondetail_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__examquestiondetail_delete`(
	id_exam_question_detail int(5)
    )
BEGIN
	delete from `exam_question_detail` where id_exam_question_detail = id_exam_question_detail;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__examquestiondetail_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__examquestiondetail_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__examquestiondetail_insert`(
	id_exam_question int(5),
	id_question int(5)
    )
BEGIN
	insert into `exam_question_detail` (id_exam_question,id_question) values (id_exam_question,id_question);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__examquestiondetail_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__examquestiondetail_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__examquestiondetail_update`(
	id_exam_question_detail int(5),
	id_exam_question int(5),
	id_question int(5)
    )
BEGIN
	IF id_exam_question_detail = 0 THEN
		CALL sp__examquestiondetail_insert(id_exam_question,id_question);
	ELSE 
		UPDATE `exam_question_detail`
		SET id_question = id_question
		WHERE id_exam_question_detail = id_exam_question_detail and id_exam_question = id_exam_question;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__examquestion_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__examquestion_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__examquestion_delete`(
	id_exam_question int(5)
    )
BEGIN
	delete from `exam_question` where id_exam_question = id_exam_question;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__examquestion_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__examquestion_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__examquestion_insert`(
	id_module int(5),
	id_subject_detail int(5),
	total_question int(3),
	is_random tinyint(1),
	is_tryout TINYINT(1),
	exam_question_type TINYINT(1)
    )
BEGIN
	insert into `exam_question` (id_module,id_subject_detail,total_question,is_random,is_tryout, exam_question_type) values (id_module,id_subject_detail,total_question,is_random,is_tryout, exam_question_type);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__examquestion_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__examquestion_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__examquestion_update`(
	id_exam_question int,
	id_module INT(5),
	id_subject_detail INT(5),
	total_question INT(3),
	is_random TINYINT(1)
    )
BEGIN
	if is_random = 0 then
		delete from `exam_question_detail` where id_exam_question = id_exam_question;
	end if;
	
	update `exam_question`
	set 	
		id_subject_detail = id_subject_detail,
		total_question = total_question,
		is_random = is_random
	where `id_exam_question` = id_exam_question and `id_module` = id_module;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__examreview_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__examreview_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__examreview_insert`(
	id_exam varchar(20),
	review_name varchar(100),
	review TEXT,
	review_photo VARCHAR(200)
	)
BEGIN
	INSERT INTO exam_review (id_exam, review_name,review,review_photo) VALUES (id_exam, review_name,review,review_photo);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__exam_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__exam_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__exam_delete`(
	id_exam varchar(20)
    )
BEGIN
	update exam
	set
		exam_status = 0
	where id_exam = id_exam;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__exam_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__exam_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__exam_insert`(
	id_exam varchar(20),
	exam_name varchar(100),
	exam_description text,
	exam_image text,
	exam_image2 text
    )
BEGIN
	insert into exam (id_exam,exam_name,exam_description,exam_image,exam_image2) values (id_exam,exam_name,exam_description,exam_image,exam_image2);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__exam_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__exam_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__exam_update`(
	id_exam VARCHAR(20),
	exam_name VARCHAR(100),
	exam_description TEXT,
	exam_image TEXT,
	exam_image2 TEXT
    )
BEGIN
	update exam
	set
		exam_name = exam_name,
		exam_description = exam_description,
		exam_image = exam_image,
		exam_image2 = exam_image2
	where id_exam = id_exam;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__module_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__module_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__module_delete`(
	id_module int
    )
BEGIN
	update module 
	set 
		module_status = 0
	where id_module = id_module;
	
	UPDATE module 
	SET 
		module_status = 0
	where id_parent_module = id_module;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__module_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__module_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__module_insert`(
	id_exam varchar(200),
	module_name varchar(50),
	module_description text,
	module_image text,
	id_parent_module int,
	OUT id_module INT
    )
BEGIN
	insert into module (id_exam,module_name,module_description,module_image,id_parent_module) values (id_exam,module_name,module_description,module_image,id_parent_module);
	
	SET id_module := LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__module_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__module_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__module_update`(
	id_module int,
	id_exam VARCHAR(200),
	module_name VARCHAR(50),
	module_description TEXT,
	module_image TEXT,
	id_parent_module INT
    )
BEGIN
	IF id_module = 0 THEN
		CALL sp__module_insert(id_exam,module_name,module_description,module_image,id_parent_module);
	ELSE 
		UPDATE module
		SET
			module_name = module_name,
			module_description = module_description,
			module_image = module_image,
			id_parent_module = id_parent_module
		WHERE id_module = id_module AND id_exam = id_exam;
	END IF;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__questiongroup_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__questiongroup_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__questiongroup_delete`(
	IN id_question_group int(5)
    )
BEGIN
	delete from `question_group` where `id_question_group` = id_question_group;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__questiongroup_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__questiongroup_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__questiongroup_insert`(
	question_group TEXT,
	question_group_image TEXT,
	question_group_description text,
	out id_question_group int
    )
BEGIN
	INSERT INTO question_group (question_group, question_group_image,question_group_description) VALUES (question_group, question_group_image,question_group_description);
	
	set id_question_group := last_insert_id();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__questiongroup_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__questiongroup_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__questiongroup_update`(
	id_question_group int,
	question_group TEXT,
	question_group_image TEXT,
	question_group_description TEXT
    )
BEGIN
	update question_group
	set
		question_group = question_group,
		question_group_image = question_group_image,
		question_group_description = question_group_description
	where id_question_group = id_question_group;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__questionoption_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__questionoption_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__questionoption_delete`(
	id_question_option int(5)
    )
BEGIN
	delete from `question_option` where `id_question_option` = id_question_option;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__questionoption_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__questionoption_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__questionoption_insert`(
	id_question int,
	question_option varchar(2),
	question_value text,
	question_value_image text,
	question_key int,
	question_key_description text
    )
BEGIN
	insert into `question_option`
	(
		id_question,
		question_option,
		question_value,
		question_value_image,
		question_key,
		question_key_description
	)
	values 
	(
		id_question,
		question_option,
		question_value,
		question_value_image,
		question_key,
		question_key_description
	);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__questionoption_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__questionoption_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__questionoption_update`(
	id_question_option int,
	id_question INT,
	question_option VARCHAR(2),
	question_value TEXT,
	question_value_image TEXT,
	question_key TINYINT,
	question_key_description TEXT
    )
BEGIN
	if id_question_option = 0 then
		call sp__questionoption_insert(id_question,question_option,question_value,question_value_image,question_key,question_key_description);
	else 
		update question_option
		set
			question_option = question_option,
			question_value = question_value,
			question_value_image = question_value_image,
			question_key = question_key,
			question_key_description = question_key_description
		where id_question_option = id_question_option and id_question = id_question;
	end if;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__question_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__question_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__question_insert`(
	question text,
	question_image text,
	question_type INT,
	id_question_group int,
	id_subject_detail INT,
	out id_question int
    )
BEGIN
	insert into question (question, question_image,question_type,id_question_group, id_subject_detail) values (question, question_image,question_type,id_question_group, id_subject_detail);
	
	SET id_question := LAST_INSERT_ID();
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__question_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__question_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__question_update`(
	id_question int,
	question TEXT,
	question_status int,
	question_image TEXT,
	id_question_group INT
    )
BEGIN
	update question
	set
		question = question,
		question_status = question_status,
		question_image = question_image,
		id_question_group = id_question_group
	where id_question = id_question;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__subjectdetail_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__subjectdetail_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__subjectdetail_delete`(
	id_subject_detail int(5)
    )
BEGIN
	delete from subject_detail where id_subject_detail = id_subject_detail;
	
	/*update subject_detail
	set `subject_detail_status` = 0
	WHERE id_subject_detail = id_subject_detail;*/
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__subjectdetail_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__subjectdetail_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__subjectdetail_insert`(
	id_subject int,
	subject_detail_name varchar(100),
	subject_detail_description text
    )
BEGIN
	insert into subject_detail (id_subject,subject_detail_name,subject_detail_description) values (id_subject,subject_detail_name,subject_detail_description);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__subjectdetail_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__subjectdetail_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__subjectdetail_update`(
	id_subject_detail int,
	id_subject int,
	subject_detail_name varchar(100),
	subject_detail_description text
    )
BEGIN
	if id_subject_detail = 0 then 
		call sp__subjectdetail_insert(id_subject,subject_detail_name,subject_detail_description);
	else
		update subject_detail
		set
			id_subject = id_subject,
			subject_detail_name = subject_detail_name,
			subject_detail_description = subject_detail_description
		where id_subject_detail = id_subject_detail;
	end if;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__subject_delete` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__subject_delete` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__subject_delete`(
	id_subject int(5)
    )
BEGIN
	delete from subject where id_subject = id_subject;
	
	/*update SUBJECT
	set `subject_status` = 0
	WHERE id_subject = id_subject;*/
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__subject_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__subject_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__subject_insert`(
		subject_name varchar(100), 
		subject_description text
	)
BEGIN
	INSERT INTO SUBJECT(subject_name,subject_description) VALUES (subject_name, subject_description);
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__subject_update` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__subject_update` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__subject_update`(
	id_subject int,
	subject_name varchar(100),
	subject_description text
    )
BEGIN
	update subject
	set 
		subject_name = subject_name,
		subject_description = subject_description
	where id_subject = id_subject;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `sp__testimoni_insert` */

/*!50003 DROP PROCEDURE IF EXISTS  `sp__testimoni_insert` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `sp__testimoni_insert`(
	id_exam varchar(20),
	id_user	varchar(20),
	testimoni text
    )
BEGIN
	insert into testimoni (id_exam,id_user,testimoni) values (id_exam,id_user,testimoni);
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
