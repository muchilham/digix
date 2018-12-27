<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Data_model extends CI_Model 
{
	function __construct()
	{
		parent::__construct();
	}

	/**
	 * Get Account By Account Name And Account Password For Login
	 * @param  [type] $account_name     [description]
	 * @param  [type] $account_password [description]
	 * @return [type]                   [description]
	 */
	function login($account_name,$account_password)
	{
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where("(id_user = '$account_name' OR user_email = '$account_name')");
		$this->db->where('user_password', $account_password);
		$this->db->where('user_role', '1');
		$this->db->where('user_status', '1');

		return $this->db->get();
	}

	/**
	 * Insert Account For Register
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function insert_account($data)
	{
		return $this->db->insert('user',$data);
	}

	/**
	 * Update Account For Activation User
	 * @param  [type] $id_user             [description]
	 * @param  [type] $user_activationcode [description]
	 * @param  [type] $data                [description]
	 * @return [type]                      [description]
	 */
	function update_account($id_user,$user_activationcode,$data)
	{
		$this->db->where('id_user',$id_user);
		$this->db->where('user_activationcode',$user_activationcode);
		return $this->db->update('user', $data);
	}

	/**
	 * Get Category Where Category Status Active(1)
	 * @return [type] [description]
	 */
	function select_category()
	{
		$this->db->select('*');
		$this->db->where('category_status', '1');
		$this->db->from('category');

		return $this->db->get();
	}

	

	/**
	 * Get All Exam WITH Pagination
	 * @param  [type] $start    [description]
	 * @param  [type] $nextPage [description]
	 * @return [type]           [description]
	 */
	function select_exam($start, $nextPage)
    {
        $this->db->select(" 
							a.*,
							b.`exam_name`,
							b.`exam_description`,
							b.`exam_image`,
							b.`exam_created`,
							b.`exam_modified`,
							b.`exam_status`");
        $this->db->from("(
							SELECT
								a.`id_exam`,
								GROUP_CONCAT(c.`category_name`) AS category
							FROM exam AS a INNER JOIN
							`exam_category` AS b ON a.`id_exam` = b.`id_exam` INNER JOIN
							category AS c ON b.`id_category` = c.`id_category`
							GROUP BY b.`id_exam`
						) as a");
        $this->db->join("(
							SELECT
							`id_exam`,
							`exam_name`,
							`exam_description`,
							`exam_image`,
							`exam_created`,
							`exam_modified`,
							`exam_status`
						FROM exam) as b", "a.id_exam = b.id_exam", "inner");
        $this->db->where("b.exam_status", 1);
        $this->db->limit($start, $nextPage);
        return $this->db->get();
	}

	/**
	 * Get Exam By Value Search With Pagination
	 * @param  [type] $parameter [description]
	 * @param  [type] $start     [description]
	 * @param  [type] $nextPage  [description]
	 * @return [type]            [description]
	 */
	function select_exam2($parameter,$start, $nextPage)
    {
        $this->db->select(" 
							a.*,
							b.`exam_name`,
							b.`exam_description`,
							b.`exam_image`,
							b.`exam_created`,
							b.`exam_modified`,
							b.`exam_status`");
        $this->db->from("(
							SELECT
								a.`id_exam`,
								GROUP_CONCAT(c.`category_name`) AS category
							FROM exam AS a INNER JOIN
							`exam_category` AS b ON a.`id_exam` = b.`id_exam` INNER JOIN
							category AS c ON b.`id_category` = c.`id_category`
							GROUP BY b.`id_exam`
						) as a");
        $this->db->join("(
							SELECT
							`id_exam`,
							`exam_name`,
							`exam_description`,
							`exam_image`,
							`exam_created`,
							`exam_modified`,
							`exam_status`
						FROM exam) as b", "a.id_exam = b.id_exam", "inner");
        $this->db->where("b.exam_status", 1);
		$this->db->where("(exam_name LIKE '%$parameter%' OR exam_description LIKE '%$parameter%')");
        $this->db->limit($start, $nextPage);
        return $this->db->get();
	}

	/**
	 * Get Exam By Id Exam
	 * @param  [type] $id_exam [description]
	 * @return [type]          [description]
	 */
	function select_exam_get($id_exam)
	{
		$this->db->select('*');
		$this->db->where('id_exam', $id_exam);
		$this->db->from('exam');

		return $this->db->get();
	}

	/**
	 * Get Hirarchy Module By Id Exam AND Id Parent Module = NULL
	 * @param  [type] $id_exam [description]
	 * @return [type]          [description]
	 */
	function select_modul_get($id_exam)
	{
		$this->db->from('module');
		$this->db->where('id_exam', $id_exam);
		$this->db->where('module_status', 1);
		$this->db->where('id_parent_module', NULL);

		return $this->db->get();
	}

	/**
	 * Get Hirarchy Module By Id Exam AND Id Module != NULL
	 * @param  [type] $id_exam  [description]
	 * @param  [type] $id_modul [description]
	 * @return [type]           [description]
	 */
	function select_submodul_get($id_exam, $id_modul)
	{
		$this->db->from('module');
		$this->db->where('id_exam', $id_exam);
		$this->db->where('module_status', 1);
		$this->db->where('id_parent_module', $id_modul);

		return $this->db->get();
	}

	/**
	 * Get ALl Question
	 * @return [type] [description]
	 */
	function select_question()
	{
		$this->db->select('*');
		$this->db->from('question');

		return $this->db->get();
	}

	/**
	 * Get Question By Id Question
	 * @param  [type] $id_question [description]
	 * @return [type]              [description]
	 */
	function select_question2($id_question)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->where('question_status', '1');
		$this->db->from('question');

		return $this->db->get();
	}

	/**
	 * Get Question By Id Module
	 * @param  [type] $id_module [description]
	 * @return [type]            [description]
	 */
	function select_question_get($id_module)
	{
		$this->db->select('*');
		$this->db->where('id_module', $id_module);
		$this->db->where('question_status', '1');
		$this->db->from('question');

		return $this->db->get();
	}

	/**
	 * Get Question By Id Question and Id Module
	 * @param  [type] $id_question [description]
	 * @param  [type] $id_module   [description]
	 * @return [type]              [description]
	 */
	function select_question_get2($id_question,$id_module)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->where('id_module', $id_module);
		$this->db->where('question_status', '1');
		$this->db->from('question');

		return $this->db->get();
	}

	/**
	 * Get Question Detail By Id Question and LIMIT 1
	 * @param  [type] $id_question [description]
	 * @return [type]              [description]
	 */
	function select_question_detail_get($id_question)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->limit(1);
		$this->db->from('question_detail');

		return $this->db->get();
	}

	/**
	 * Get Question Detail By Id Question
	 * @param  [type] $id_question [description]
	 * @return [type]              [description]
	 */
	function select_question_detail2_get($id_question)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->from('question_detail');

		return $this->db->get();
	}
	/**
	 * Get Question Detail By Question
	 * @param  [type] $question [description]
	 * @return [type]           [description]
	 */
	function select_question_option_get($id_question)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->from('question_option');

		return $this->db->get();
	}

	/**
	 * Get Question Key By Id Question, Question Number
	 * @param  [type] $question [description]
	 * @return [type]           [description]
	 */
	function select_question_option_get_key($id_question)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->where('question_key', 1);
		$this->db->from('question_option');

		return $this->db->get();
	}


	/**
	 * Get Exam With Limit and Order By Exam Created DESC (New Exam)
	 * @param  [type] $limit [description]
	 * @return [type]        [description]
	 */
	function select_new_exam($limit){
		$this->db->select('*');
		$this->db->from('exam');
		$this->db->where('exam_status', 1);
		$this->db->order_by("exam_created", "desc");
		$this->db->limit($limit, 0);

		return $this->db->get();
	}

	/**
	 * Get Exam With Limit And Order By Total Count DESC (Popular Exam)
	 * @param  [type] $limit [description]
	 * @return [type]        [description]
	 */
	function select_popular_exam($limit)
    {
    	$this->db->distinct();
        $this->db->select(" MIN(d.`id_exam`) AS id_exam,
							MIN(d.`exam_name`) AS exam_name,
							MIN(d.`exam_description`) AS exam_description,
							MIN(d.`exam_image`) AS exam_image");
        $this->db->from("answer AS a");
        $this->db->join("question AS b", "a.`id_module` = b.`id_module`", "inner");
        $this->db->join("module AS c", "b.id_module = c.id_module", "inner");
        $this->db->join("exam AS d", "c.id_exam = d.id_exam", "inner");
        $this->db->where("d.exam_status", 1);
        $this->db->group_by("a.id_module");
        $this->db->order_by("COUNT(a.`id_answer`)", "DESC");
        $this->db->limit($limit);
        return $this->db->get();
	}

	/**
	 * Get All Answer
	 * @return [type] [description]
	 */
	function select_answer()
	{
		$this->db->select('*');
		$this->db->from('answer');

		return $this->db->get();
	}

	/**
	 * Get Answer By Id Answer
	 * @param  [type] $id_answer [description]
	 * @return [type]            [description]
	 */
	function select_answer2($id_answer)
	{
		$this->db->select('*');
		$this->db->from('answer');
		$this->db->where('id_answer',$id_answer);

		return $this->db->get();
	}

	/**
	 * Get Answer Detail By Id Answer
	 * @param  [type] $id_answer [description]
	 * @return [type]            [description]
	 */
	function select_answer_detail($id_answer)
	{
		$this->db->select('*');
		$this->db->from('answer_detail');
		$this->db->where('id_answer',$id_answer);

		return $this->db->get();
	}

	/**
	 * Get Answer Detail By Id Answer With Group By Id Answer
	 * @param  [type] $id_answer [description]
	 * @return [type]            [description]
	 */
	function select_answer_detail2($id_answer)
	{
		$this->db->select('*');
		$this->db->from('answer_detail');
		$this->db->where('id_answer',$id_answer);
		$this->db->group_by('id_answer');

		return $this->db->get();
	}

	/**
	 * Get Score Exam By Id Answer
	 * @param  [type] $id_answer [description]
	 * @return [type]            [description]
	 */
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

	/**
	 * Insert Answer
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function insert_answer($data)
	{	
		return $this->db->insert('answer',$data);
	}

	/**
	 * Insert Answer Detail
	 * @param  [type] $data [description]
	 * @return [type]       [description]
	 */
	function insert_answer_detail($data)
	{	
		return $this->db->insert('answer_detail',$data);
	}

	/**
	 * Update Answer Score
	 * @param  [type] $id_answer [description]
	 * @return [type]            [description]
	 */
	function update_answer_score($id_answer,$data)
	{	
		$this->db->where('id_answer',$id_answer);
		return $this->db->update('answer', $data);
	}

	

	/**
	 * Get Id Question, Question, Question Number and Total By Id Module
	 * @param  [type] $id_module [description]
	 * @return [type]            [description]
	 */
	function select_module_detail_option_get($id_module)
	{
		$this->db->select('b.id_question,b.question,b.question_number, COUNT(b.question) AS total');
		$this->db->from('question AS a');
		$this->db->join('question_detail AS b', 'a.id_question = b.id_question', 'inner');
		$this->db->where('a.id_module', $id_module);
		$this->db->where('a.question_status', 1);
		$this->db->where("a.question_type", $question_type);
		$this->db->group_by('b.id_question'); 
		$this->db->group_by('b.question');
		$this->db->group_by('b.question_number');
		$this->db->order_by('RAND()','asc');
		$this->db->limit(40);

		return $this->db->get();
	}

	/**
	 * Get Question Detail By Id id_module And GROUP BY Id Question, Question, Question Number With Pagination
	 * @param  [type] $id_module [description]
	 * @param  [type] $start       [description]
	 * @param  [type] $nextPage    [description]
	 * @return [type]              [description]
	 */
	function select_module_detail_option_get2($id_module,$question_type,$start,$nextPage)
	{
		$this->db->select('b.id_question,b.question,b.question_number, COUNT(b.question) AS total');
		$this->db->from('question as a');
		$this->db->join('question_detail as b', 'a.`id_question` = b.`id_question`', 'inner');
		$this->db->where('a.`id_module`', $id_module);
		$this->db->where('a.`question_status`', 1);
		$this->db->where("a.question_type", $question_type);
		$this->db->group_by('b.`id_question`'); 
		$this->db->group_by('b.`question`');
		$this->db->group_by('b.`question_number`');
		$this->db->order_by('RAND()','asc');
        $this->db->limit($start, $nextPage);

		return $this->db->get();
	}

	public function select_testimoni()
	{
		# code...
		$this->db->select("id_exam, review_name, review,review_photo");
		$this->db->from("exam_review a");
		$this->db->limit(3);

		return $this->db->get();
	}

	public function select_testimoni_get_by_exam($id_exam)
	{
		# code...
		$this->db->select("id_exam, review_name, review,review_photo");
		$this->db->from("exam_review a");
		$this->db->where("id_exam", $id_exam);

		return $this->db->get();
	}

	public function select_testimoni_get_by_user($id_user)
	{
		$this->db->select('a.id_answer,
							a.answer_score,
							a.answer_created,
							b.id_module,
							b.`module_name`,
							b.`module_description`,
							c.`id_exam`,
							c.`exam_name`,
							c.`exam_image`');
		$this->db->from('answer a');
		$this->db->join('module b', 'a.id_module = b.`id_module`', 'inner');
		$this->db->join('exam c', 'b.`id_exam` = c.`id_exam`', 'inner');
		$this->db->where('a.id_user', $id_user);
		$this->db->order_by('a.answer_created','desc');

		return $this->db->get();
	}

	public function select_testimoni_count($id_user, $id_exam)
	{
		$this->db->select('a.`id_exam`');
		$this->db->from('testimoni a');
		$this->db->where('a.id_user', $id_user);
		$this->db->where('a.id_exam', $id_exam);
		$this->db->order_by('a.testimoni_created','desc');

		return $this->db->get();
	}

	// public function select_testimoni_get_by_exam($id_exam)
	// {
	// 	$this->db->select('a.id_user,a.user_fullname,a.user_photo,b.testimoni');
	// 	$this->db->from('user as a');
	// 	$this->db->join('testimoni as b', 'a.id_user = b.id_user', 'inner');
	// 	$this->db->where('b.id_exam', $id_exam);
	// 	$this->db->order_by('b.testimoni_created','asc');

	// 	return $this->db->get();
	// }
	public function insert_testimoni($data)
	{
		# code...
		$query = $this->db->query("CALL sp__testimoni_insert(?,?,?)", $data);
        return $query;
	}


	public function select_total_question_exam($id_module)
	{
		# code...
		$this->db->select("id_module, SUM(total_question) total_question");
		$this->db->from("exam_question");
		$this->db->where("id_module", $id_module);
		$this->db->group_by("id_module");

		return $this->db->get();
	}

	public function select_question_by_id_subject_detail($id_subject_detail,$question_type,$start,$nextPage)
	{
		# code...
		$this->db->select("a.`id_question`, a.question, a.`question_image`, a.id_question_group");
		$this->db->from("question a");
		$this->db->where("id_subject_detail", $id_subject_detail);
		$this->db->where("question_type", $question_type);
		$this->db->order_by('RAND()','asc');
        $this->db->limit($start, $nextPage);

		return $this->db->get();
	}

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

	/**
	 * Get Question By Id Module
	 * @param  [type] $id_module [description]
	 * @return [type]              [description]
	 */
	function select_module_exam_question($id_module)
	{
		$this->db->distinct();
		$this->db->select("*");
		$this->db->from("exam_question as a");
		$this->db->join("module as b", "a.`id_module` = b.`id_module`", "inner");
		$this->db->where("b.id_module", $id_module);

		return $this->db->get();
	}

	public function select_question_group_get_by($id_question_group)
	{
		$this->db->where("id_question_group", $id_question_group);
		$this->db->from("question_group");

		return $this->db->get();
	}


}
