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
		$this->db->where('id_parent_module', NULL);

		return $this->db->get();
	}
	function select_submodul_get($id_exam, $id_modul)
	{
		$this->db->from('module');
		$this->db->where('id_exam', $id_exam);
		$this->db->where('id_parent_module', $id_modul);

		return $this->db->get();
	}
	function select_question()
	{
		$this->db->select('*');
		$this->db->from('question');

		return $this->db->get();
	}
	function select_question_get($id_module)
	{
		$this->db->select('*');
		$this->db->where('id_module', $id_module);
		$this->db->where('question_status', '1');
		$this->db->from('question');

		return $this->db->get();
	}

	function select_question_get2($id_question,$id_module)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->where('id_module', $id_module);
		$this->db->from('question');

		return $this->db->get();
	}
	
	function select_question_detail_get($id_question)
	{
		$query = ("SELECT id_question_detail, question, question_number FROM question_detail WHERE id_question = '$id_question' GROUP BY question,id_question,question_number ORDER BY id_question_detail asc");

		return $this->db->query($query);


		return $this->db->get();
	}
	function select_question_detail2_get($id_question)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->from('question_detail');


		return $this->db->get();
	}
	function select_question_option_get($id_question,$question,$number_question)
	{
		$this->db->select('*');
		$this->db->where('id_question', $id_question);
		$this->db->where('question', $question);
		$this->db->where('question_number', $number_question);
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
	function insert_exam($data)
	{
		return $this->db->insert('exam',$data);
	}
	function insert_modul($data)
	{
		$this->db->insert('module',$data);
		$insert_id = $this->db->insert_id();
   		return  $insert_id;
	}
	function insert_submodul($data)
	{
		return $this->db->insert('module',$data);
	}
	function insert_exam_category($data)
	{
		return $this->db->insert('exam_category',$data);
	}
	function insert_question($data)
	{
		return $this->db->insert('question',$data);
	}
	function insert_question_detail($data)
	{
		return $this->db->insert('question_detail',$data);
	}
	function select_booking_master()
	{
//		$query = "SELECT
//					DISTINCT
//					a.`id_booking`,
//					a.`id_room`,
//					a.`booking_start`,
//					a.`booking_end`,
//					a.`booking_createdate`,
//					a.`account_name`,
//					COUNT(b.`id_details`) as count
//					FROM
//					`booking_master` AS a INNER JOIN
//					`booking_details` AS b ON a.`id_booking` = b.`id_booking`";
//
//		return $this->db->query($query);

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
	public function update_exam($id_exam,$data)
	{
		$this->db->where('id_exam',$id_exam);
		return $this->db->update('exam', $data);
	}
	public function update_question($id_question,$data)
	{
		$this->db->where('id_question',$id_question);
		return $this->db->update('question', $data);
	}
	public function update_modul($id_module,$data)
	{
		$this->db->where('id_module',$id_module);
		$this->db->update('module', $data);
		return $id_module;
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
	public function delete_exam($id_exam,$data)
	{
		$this->db->where('id_exam',$id_exam);
		return $this->db->update('exam', $data);
	}
	public function delete_question($id_question,$data)
	{
		$this->db->where('id_question',$id_question);
		return $this->db->update('question', $data);
	}
	public function delete_modul($id_module)
	{
		$this->db->where('id_module',$id_module);
		return $this->db->delete('module');
	}
	public function delete_modul2($id_module)
	{
		$this->db->where('id_parent_module',$id_module);
		return $this->db->delete('module');
	}
	public function delete_question_detail($id_question)
	{
		$this->db->where('id_question',$id_question);
		return $this->db->delete('question_detail');
	}

}
