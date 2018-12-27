<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}

	// Select Query
	function login($account_name,$account_password)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('id_user', $account_name);
		$this->db->where('user_password', $account_password);
		$this->db->where('user_role', '0');

		return $this->db->get();
	}
	function select_account_admin()
	{
		$this->db->select('*');
		$this->db->where('user_role', '0');
		$this->db->from('user');

		return $this->db->get();
	}
	function select_account_user()
	{
		$this->db->select('*');
		$this->db->where('user_role', '1');
		$this->db->from('user');

		return $this->db->get();
	}
	function select_account_get($nama_account)
	{
		$this->db->from('user');
		$this->db->where('id_user', $nama_account);

		return $this->db->get();
	}
	function select_category()
	{
		$this->db->select('*');
		$this->db->where('category_status', '1');
		$this->db->from('category');

		return $this->db->get();
	}
	function select_category_get($id_category)
	{
		$this->db->from('category');
		$this->db->where('id_category', $id_category);

		return $this->db->get();
	}

	function select_exam_category_get($id_exam)
	{
		$this->db->select('*');
		$this->db->from('exam_category');
		$this->db->where('id_exam', $id_exam);

		return $this->db->get();
	}
	function select_exam_status()
	{
		$this->db->select('*');
		$this->db->where('exam_status', '1');
		$this->db->from('exam');

		return $this->db->get();
	}
	function select_exam()
	{
		$this->db->select('*');
		$this->db->from('exam');

		return $this->db->get();
	}
	function select_exam_get($id_exam)
	{
		$this->db->select('*');
		$this->db->where('id_exam', $id_exam);
		$this->db->from('exam');

		return $this->db->get();
	}
	function select_modul_get($id_exam)
	{
		$this->db->from('module');
		$this->db->where('id_exam', $id_exam);
		$this->db->where('module_status', 1);
		$this->db->where('id_parent_module', NULL);

		return $this->db->get();
	}
	function select_submodul_get($id_exam, $id_modul)
	{
		$this->db->from('module');
		$this->db->where('id_exam', $id_exam);
		$this->db->where('module_status', 1);
		$this->db->where('id_parent_module', $id_modul);

		return $this->db->get();
	}
	
	
	function select_question_detail2_get($id_question)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->from('question_detail');


		return $this->db->get();
	}

	function select_answer_detail($id_answer)
	{
		$this->db->select('*');
		$this->db->where('id_answer', $id_answer);
		$this->db->from('answer_detail');


		return $this->db->get();
	}
	function select_answer_essay()
	{
		$query = ("SELECT question.`id_question`,answer.`id_answer`, question.`question_type`,answer.`id_user`,answer.`answer_score`,answer.`answer_created` FROM question  JOIN answer ON answer.`id_module` = question.`id_module` WHERE question.`question_type` = 1");

		return $this->db->query($query);
	}
	function select_answer_pg()
	{
		$query = ("SELECT question.`id_question`,answer.`id_answer`, question.`question_type`,answer.`id_user`,answer.`answer_score`,answer.`answer_created` FROM question  JOIN answer ON answer.`id_module` = question.`id_module` WHERE question.`question_type` = 0");

		return $this->db->query($query);
	}
	function select_answer_score($id_answer)
	{
		$this->db->select(" 
							a.id_answer,
							MAX(salah) as salah,
							MAX(benar) as benar,
							ROUND(((MAX(benar)* 10) / (MAX(benar)+MAX(salah))),2) AS score");
        $this->db->from("(SELECT
						a.`id_answer`,
						CASE WHEN b.answer_status = 0 THEN COUNT(answer_status) ELSE 0 END AS salah,
						CASE WHEN b.answer_status = 1 THEN COUNT(answer_status) ELSE 0 END AS benar
						FROM answer AS a INNER JOIN
						answer_detail AS b ON a.id_answer = b.id_answer
						WHERE a.id_answer = '$id_answer'
						GROUP BY a.id_answer, b.answer_status) as a");
        $this->db->group_by("a.id_answer");
        return $this->db->get();
	}

	function insert_account($data)
	{
		return $this->db->insert('user',$data);
	}
	function insert_category($data)
	{
		return $this->db->insert('category',$data);
	}

	function insert_exam_category($data)
	{
		return $this->db->insert('exam_category',$data);
	}
	function select_booking_master()
	{

        $this->db->select("a.*, (case when b.count is null then 0 else b.count end) as count");
        $this->db->from("( select 
                                    A.* 
                                 from
                                 `booking_master` AS A 
                                ) as a");
        $this->db->join("(  select
                                    a.id_booking,
                                    count(b.id_booking) as count
                                  from
                                  `booking_master` AS A INNER JOIN 
                                  `booking_details` AS B 
                                  ON A.`id_booking` = B.id_booking
                                  GROUP by b.id_booking
                                ) as b",'a.id_booking = b.id_booking','left');
        return $this->db->get();
	}

	public function update_account_admin($account_name,$data)
	{
		$this->db->where('id_user',$account_name);
		return $this->db->update('user', $data);
	}
	public function update_category($id_category,$data)
	{
		$this->db->where('id_category',$id_category);
		return $this->db->update('category', $data);
	}

	public function update_answer($id_answer,$data)
	{
		$this->db->where('id_answer',$id_answer);
		return $this->db->update('answer', $data);
	}
	public function update_answer_detail($id_answer_detail,$id_answer,$data)
	{
		$this->db->where('id_answer_detail',$id_answer_detail);
		$this->db->where('id_answer',$id_answer);
		return $this->db->update('answer_detail', $data);
	}

	public function delete_account($account_name)
	{
		$this->db->where('id_user',$account_name);
		return $this->db->delete('user');
	}
	public function delete_category($id_category,$data)
	{
		$this->db->where('id_category',$id_category);
		return $this->db->update('category', $data);
	}
	public function delete_category2($id_exam)
	{
		$this->db->where('id_exam',$id_exam);
		return $this->db->delete('exam_category');
	}



	# Exam
	public function insert_exam($data)
	{
		# code...
		$query = $this->db->query("CALL sp__exam_insert(?,?,?,?,?)", $data);
        return $query;
	}
	public function update_exam($id_exam, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__exam_update(?,?,?,?,?)", $data);
        // return $query;

        $this->db->where('id_exam',$id_exam);
		return $this->db->update('exam', $data);
	}
	public function delete_exam($id_exam, $data)
	{
		// $query = $this->db->query("CALL sp__exam_delete(?)", $data);
  		// return $query;
  		
  		$this->db->where('id_exam',$id_exam);
		return $this->db->update('exam', $data);
	}




	# Exam Question
	public function select_exam_question($id_module)
	{
		$this->db->select("
					a.id_exam_question,
					a.id_module,
					b.module_name,
					a.id_subject_detail,
					c.subject_detail_name,
					a.total_question,
					a.is_random,
					a.is_tryout,
					a.exam_question_type,
					a.exam_question_created
			");
		$this->db->from("exam_question a");
		$this->db->join("module b", "a.id_module = b.`id_module`", "INNER");
		$this->db->join("subject_detail c", "a.id_subject_detail = c.id_subject_detail", "INNER");
		$this->db->where("a.id_module", $id_module);

		return $this->db->get();
	}

	public function select_exam_question_get($id_exam_question)
	{
		$this->db->select("
					a.id_exam_question,
					a.id_module,
					b.module_name,
					a.id_subject_detail,
					c.subject_detail_name,
					a.total_question,
					a.is_random,
					a.is_tryout,
					a.exam_question_created
			");
		$this->db->from("exam_question a");
		$this->db->join("module b", "a.id_module = b.`id_module`", "INNER");
		$this->db->join("subject_detail c", "a.id_subject_detail = c.id_subject_detail", "INNER");
		$this->db->where("a.id_exam_question", $id_exam_question);

		return $this->db->get();
	}

	public function select_exam_question_type($id_module)
	{
		$this->db->select("MIN(a.exam_question_type) exam_question_type");
		$this->db->from("exam_question a");
		$this->db->join("module b", "a.id_module = b.`id_module`", "INNER");
		$this->db->join("subject_detail c", "a.id_subject_detail = c.id_subject_detail", "INNER");
		$this->db->where("a.id_module", $id_module);
		$this->db->group_by("a.id_module");

		return $this->db->get();
	}

	public function insert_exam_question($data)
	{
		# code...
		$query = $this->db->query("CALL sp__examquestion_insert(?,?,?,?,?,?)", $data);
        return $query;
	}
	public function update_exam_question($id_module, $id_exam_question, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__examquestion_update(?,?,?,?,?)", $data);
  		// return $query;
  		

	  	// 	if ($is_random == 0)
	  	// 	{
	  	// 		$this->db->where('id_exam_question',$id_exam_question);
				// return $this->db->delete('exam_question_detail');
	  	// 	}
	  	// 	else
	  	// 	{
	        $this->db->where('id_module',$id_module);
  			$this->db->where('id_exam_question',$id_exam_question);
			return $this->db->update('exam_question', $data);
  		// }
	}
	public function delete_exam_question($id_exam_question)
	{
		# code...
		// $query = $this->db->query("CALL sp__examquestion_delete(?)", $data);
		// return $query;

        $this->db->where('id_exam_question',$id_exam_question);
		return $this->db->delete('exam_question');
	}




	# Exam Question Detail
	public function insert_exam_question_detail($data)
	{
		# code...
		$query = $this->db->query("CALL sp__examquestiondetail_insert(?,?)", $data);
        return $query;
	}
	public function update_exam_question_detail($id_exam_question_detail, $id_exam_question, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__examquestiondetail_update(?,?,?)", $data);
		// return $query;


        $this->db->where('id_exam_question_detail',$id_exam_question_detail);
        $this->db->where('id_exam_question',$id_exam_question);
		return $this->db->update('exam_question_detail', $data);
	}
	public function delete_exam_question_detail($id_exam_question_detail)
	{
		# code...
		// $query = $this->db->query("CALL sp__examquestiondetail_delete(?)", $data);
  		// return $query;

        $this->db->where('id_exam_question_detail',$id_exam_question_detail);
		return $this->db->delete('exam_question_detail');
	}

	# Exam Review
	public function select_exam_review_by_id($id_exam_review)
	{
		$this->db->select('*');
		$this->db->from('exam_review as a');
		$this->db->join('exam as b', 'a.id_exam = b.id_exam', 'inner');
		$this->db->where('a.id_exam_review', $id_exam_review);

		return $this->db->get();
	}
	public function select_exam_review_by_id_exam($id_exam)
	{
		$this->db->select('*');
		$this->db->from('exam_review as a');
		$this->db->join('exam as b', 'a.id_exam = b.id_exam', 'inner');
		$this->db->where('a.id_exam', $id_exam);

		return $this->db->get();
	}
	public function insert_exam_review($data)
	{
		# code...
		$query = $this->db->query("CALL sp__examreview_insert(?,?,?,?)", $data);
        return $query;
	}
	public function update_exam_review($id_exam_review, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__examquestiondetail_update(?,?,?)", $data);
		// return $query;


        $this->db->where('id_exam_review',$id_exam_review);
		return $this->db->update('exam_review', $data);
	}
	public function delete_exam_review($id_exam_review)
	{
		# code...
		// $query = $this->db->query("CALL sp__examquestiondetail_delete(?)", $data);
  		// return $query;

        $this->db->where('id_exam_review',$id_exam_review);
		return $this->db->delete('exam_review');
	}




	# Subject
	public function select_subject()
	{
		$this->db->select('*');
		$this->db->where('subject_status', '1');
		$this->db->from('subject');

		return $this->db->get();
	}
	public function select_subject_get($id_subject)
	{
		$this->db->select('*');
		$this->db->where('subject_status', '1');
		$this->db->where('id_subject', $id_subject);
		$this->db->from('subject');

		return $this->db->get();
	}
	public function insert_subject($data)
	{
		# code...
		$query = $this->db->query("CALL sp__subject_insert(?,?)", $data);
        return $query;
	}
	public function update_subject($id_subject, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__subject_update(?,?,?)", $data);
  		// return $query;

        $this->db->where('id_subject',$id_subject);
		return $this->db->update('subject', $data);
	}
	public function delete_subject($id_subject)
	{
		# code...
		$this->db->where('id_subject',$id_subject);
		return $this->db->delete('subject');
	}




	# Subject Detail
	public function select_subject_detail()
	{
		# code...
		$this->db->select('a.id_subject, a.subject_name, b.id_subject_detail, b.subject_detail_name, b.subject_detail_description, b.subject_detail_created');
		$this->db->from('subject as a');
		$this->db->join('subject_detail as b', 'a.id_subject = b.id_subject', 'inner');
		$this->db->where('a.subject_status', '1');
		$this->db->where('b.subject_detail_status', '1');

		return $this->db->get();
	}

	public function select_subject_detail_get($id_subject_detail)
	{
		# code...
		$this->db->select('a.id_subject, a.subject_name, b.id_subject_detail, b.subject_detail_name, b.subject_detail_description, b.subject_detail_created');
		$this->db->from('subject as a');
		$this->db->join('subject_detail as b', 'a.id_subject = b.id_subject', 'inner');
		$this->db->where('a.subject_status', '1');
		$this->db->where('b.subject_detail_status', '1');
		$this->db->where('b.id_subject_detail', $id_subject_detail);

		return $this->db->get();
	}

	public function insert_subject_detail($data)
	{
		# code...
		$query = $this->db->query("CALL sp__subjectdetail_insert(?,?,?)", $data);
        return $query;
	}
	public function update_subject_detail($id_subject_detail, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__subjectdetail_update(?,?,?,?)", $data);
  		// return $query;    
  		
        $this->db->where('id_subject_detail',$id_subject_detail);
		return $this->db->update('subject_detail', $data);
	}
	public function delete_subject_detail($id_subject_detail)
	{
		# code...
		$this->db->where('id_subject_detail',$id_subject_detail);
		return $this->db->delete('subject_detail');
	}


	# Subject Detail Question
	public function select_subject_detail_question()
	{
		# code...
		$this->db->select(" a.id_subject_detail,
							b.subject_name,
							a.subject_detail_name,
							COALESCE(c.question_active,0) question_active,
							COALESCE(d.question_inactive,0) question_inactive");
        $this->db->from(" subject b");
        $this->db->join("subject_detail a ", "b.id_subject = a.id_subject", "inner");
        $this->db->join("(	SELECT
								id_subject_detail,
								COUNT(id_question) question_active
							FROM question WHERE question_status = 1
							GROUP BY id_subject_detail
						) c", "a.id_subject_detail = c.id_subject_detail","left");
        $this->db->join("(	SELECT
								id_subject_detail,
								COUNT(id_question) question_inactive
							FROM question WHERE question_status = 0
							GROUP BY id_subject_detail
						) d", "a.id_subject_detail = d.id_subject_detail","left");

		return $this->db->get();
	}

	public function delete_subject_detail_question($id_subject_detail, $data)
	{
		# code...
		$this->db->where('id_subject_detail',$id_subject_detail);
		return $this->db->update('question',  $data);
	}
	

	# Question
	public function select_question()
	{
		$this->db->select('*');
		$this->db->where('question_status', '1');
		$this->db->from('question');

		return $this->db->get();
	}

	public function select_question_group_by_type()
	{
		# code...
		$this->db->select("b.question_type, COUNT(id_question) question_total");
		$this->db->from("question a");
		$this->db->join("( 
							SELECT 0 AS question_type 
							UNION
							SELECT 1 AS question_type
						) as b", "a.question_type = b.question_type", "RIGHT OUTER");
		$this->db->group_by("b.question_type");

		return $this->db->get();
	}

	public function select_question_get($id_question)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->from('question');

		return $this->db->get();
	}

	public function select_question_get_by_type($question_type)
	{
		$this->db->select('*');
		$this->db->where('question_type', $question_type);
		$this->db->from('question');

		return $this->db->get();
	}
	
	public function insert_question($data)
	{
		# code...
		$query = $this->db->query("CALL sp__question_insert(?,?,?,?,?, @id_question)", $data);
		return  $this->db->query('select @id_question as id_question;')->row()->id_question;
	}
	public function update_question($id_question, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__question_update(?,?,?,?)", $data);
        // return $query;

        $this->db->where('id_question',$id_question);
		return $this->db->update('question', $data);
	}

	public function update_question_by_id_question_group($id_question_group, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__question_update(?,?,?,?)", $data);
        // return $query;

        $this->db->where('id_question_group',$id_question_group);
		return $this->db->update('question', $data);
	}

	public function update_question_by_id_subject_detail($id_subject_detail, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__question_update(?,?,?,?)", $data);
        // return $query;

        $this->db->where('id_subject_detail',$id_subject_detail);
		return $this->db->update('question', $data);
	}

	public function delete_question($id_question)
	{
		# code...
		$this->db->where('id_question',$id_question);
		return $this->db->delete('question');
	}



	# Question Option
	public function select_question_option_get($id_question)
	{
		$this->db->select("
						b.id_question_option,
						a.id_question,
						a.question,
						b.question_option,
						b.question_value,
						b.question_value_image,
						b.question_key,
						b.question_key_description");
		$this->db->from("question a");
		$this->db->join("question_option b", 'a.id_question = b.id_question', "inner");
		$this->db->where('a.id_question',$id_question);
		return $this->db->get();
	}

	public function select_question_option_max($id_question)
	{
		$this->db->select("
						a.id_question,
						max(b.id_question_option) max_option");
		$this->db->from("question a");
		$this->db->join("question_option b", 'a.id_question = b.id_question', "inner");
		$this->db->where('a.id_question',$id_question);
		$this->db->group_by('a.id_question');
		return $this->db->get();
	}


	public function insert_question_option($data)
	{
		# code...
		$query = $this->db->query("CALL sp__questionoption_insert(?,?,?,?,?,?)", $data);
        return $query;
	}
	public function update_question_option($id_question_option, $id_question, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__questionoption_update(?,?,?,?,?,?,?)", $data);
  		// return $query;
  		
  		if ($id_question_option == 0)
  		{
  			$query = $this->db->query("CALL sp__questionoption_insert(?,?,?,?,?,?)", $data);
        	return $query;
  		}
  		else
  		{
  			$this->db->where('id_question_option',$id_question_option);
	        $this->db->where('id_question',$id_question);
			return $this->db->update('question_option', $data);
  		}
	}
	public function delete_question_option($id_question_option)
	{
		# code...
		// $query = $this->db->query("CALL sp__questionoption_delete(?)", $data);
        // return $query;
		
		$this->db->where('id_question_option', $id_question_option);
		return $this->db->delete('question_option');
	}



	# Question Group
	public function select_question_group()
	{
		$this->db->select('*');
		$this->db->where('question_group_status', 1);
		$this->db->from('question_group');

		return $this->db->get();
	}
	public function select_question_group_get($id_question_group)
	{
		$this->db->select('*');
		$this->db->from('question_group');
		$this->db->where('question_group_status', '1');
		$this->db->where('id_question_group', $id_question_group);

		return $this->db->get();
	}
	public function insert_question_group($data)
	{
		# code...
		$query = $this->db->query("CALL sp__questiongroup_insert(?,?,?, @id_question_group)", $data);
		return $this->db->query('select @id_question_group as id_question_group;')->row()->id_question_group;
	}
	public function update_question_group($id_question_group, $data)
	{
		# code...
		// $query = $this->db->query("CALL sp__questiongroup_update(?,?,?,?)", $data);
 	 	// return $query;

		$this->db->where('id_question_group',$id_question_group);
		return $this->db->update('question_group', $data);	
	}
	public function delete_question_group($id_question_group)
	{

        $this->db->where('id_question_group', $id_question_group);
		return $this->db->delete('question_group');
	}




	# Module
	public function insert_module($data)
	{
		# code...
		$query = $this->db->query("CALL sp__module_insert(?,?,?,?,?, @id_module)", $data);
		return  $this->db->query('select @id_module as id_module;')->row()->id_module;

        return $query;
	}
	public function update_module($id_module,$id_exam, $data)
	{
		if ($id_module == 0) {
			$query = $this->db->query("CALL sp__module_insert(?,?,?,?,?)", $data);
        	return $query;
		}
		else {
			$this->db->where('id_module',$id_module);
	        $this->db->where('id_exam',$id_exam);
			return $this->db->update('module', $data);
		}
	}
	public function delete_module($id_module, $data)
	{
		$this->db->where('id_module',$id_module);
		$module = $this->db->update('module', $data);


		$this->db->where('id_parent_module',$id_module);
		$submodule = $this->db->update('module', $data);

		return $module && $submodule;
	}


	# Others

	public function select_question_get_by_subject_detail($id_subject_detail)
	{
		# code...
		$this->db->select('
							a.`id_question`,
							a.`question`,
							a.`question_image`,
							a.`question_type`,
							a.`question_created`,
							a.`id_subject_detail`
						');
		$this->db->from('question a');
		$this->db->join('subject_detail b', 'a.`id_subject_detail` = b.id_subject_detail', 'LEFT OUTER');
		if($id_subject_detail == NULL)
			$this->db->where('a.id_subject_detail IS NULL', NULL);
		else if ($id_subject_detail > 0)
			$this->db->where('a.id_subject_detail', $id_subject_detail);

		$this->db->where('question_status', '1');

		return $this->db->get();
	}

	public function select_question_get_by_subject_detail_2($id_subject_detail)
	{
		# code...
		$this->db->select('
							a.`id_question`,
							a.`question`,
							a.`question_image`,
							a.`question_type`,
							a.`question_created`,
							a.`id_subject_detail`
						');
		$this->db->from('question a');
		$this->db->join('subject_detail b', 'a.`id_subject_detail` = b.id_subject_detail', 'LEFT OUTER');
		$where = "(a.id_subject_detail IS NULL OR a.id_subject_detail =".$id_subject_detail.")";
		$this->db->where($where);
		$this->db->where('question_status', '1');

		return $this->db->get();
	}

	public function select_question_get_by_question_group($id_question_group)
	{
		# code...
		$this->db->select('
							a.`id_question`,
							a.`question`,
							a.`question_image`,
							a.`question_type`,
							a.`question_created`,
							a.`id_question_group`
						');
		$this->db->from('question a');
		$this->db->join('question_group b', 'a.`id_question_group` = b.id_question_group', 'LEFT OUTER');
		if($id_question_group == NULL)
			$this->db->where('a.id_question_group IS NULL', NULL);
		else if ($id_question_group > 0)
			$this->db->where('a.id_question_group', $id_question_group);

		$this->db->where('question_status', 1);

		return $this->db->get();
	}

	public function select_question_get_by_question_group_2($id_question_group)
	{
		# code...
		$this->db->select('
							a.`id_question`,
							a.`question`,
							a.`question_image`,
							a.`question_type`,
							a.`question_created`,
							a.`id_question_group`
						');
		$this->db->from('question a');
		$this->db->join('question_group b', 'a.`id_question_group` = b.id_question_group', 'LEFT OUTER');
		$where = "(a.id_question_group IS NULL OR a.id_question_group =".$id_question_group.")";
		$this->db->where($where);
		$this->db->where('question_status', 1);

		return $this->db->get();
	}
}
