<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in')!=true)
		{
			redirect('');
		}
		$this->load->helper(array('url','form'));
		$this->load->library('user_agent');
		$this->load->model('Data_model');
	}

	/**
	 * [index description]
	 * @param  [type] $id_question [description]
	 * @return [type]              [description]
	 */
	// public function index($id_question)
	// {
	// 	$data['select_question']= $this->Data_model->select_question2($id_question)->row();
	// 	$this->load->view('header');
	// 	$this->load->view('question',$data);
	// 	$this->load->view('footer');
	// }

	public function index($id_module)
	{
		if($this->Data_model->select_module_exam_question($id_module)->num_rows() == 0)
		{
			redirect($_SERVER['HTTP_REFERER']);
		}
		else
		{
			$data['select_module']= $this->Data_model->select_module_exam_question($id_module)->row();
			$this->load->view('header');
			$this->load->view('question',$data);
			$this->load->view('footer');
		}
	}
	
	public function answer()
	{
		$max = $this->Data_model->select_answer();
		foreach($max->result() as $key)
		{
			$id_max = $key->id_answer;
		}

		$nourut = (int) substr($id_max, 4, 6);
		$nourut++;

		$kode_answer = "ANSW" .sprintf('%06s', $nourut);

		$data = explode("|", $this->input->post("id_module"));
		
		$data2 = array(
			'id_answer' => $kode_answer,
			'id_user' => $this->session->id_user,
			'id_module' => $data[0]
		 );

		if($this->Data_model->insert_answer($data2))
		{
			for ($i = 1; $i <= $data[1]; $i++) { 
				$data3 = explode("|", $this->input->post("pilihan-ganda".$i) !== NULL ? $this->input->post("pilihan-ganda".$i) : "0|0|0");
				$data4 = array(
					'id_answer' => $kode_answer, 
					'id_question' => $this->input->post("id_question_".$i), 
					'answer_number' => $this->input->post("id_question_".$i), 
					'answer_option' => $data3[0], 
					'answer_value' => $data3[1], 
					'answer_status' => $data3[2]
				);

				if($this->Data_model->insert_answer_detail($data4))
				{

				}
				else
				{
					echo json_encode(array("message" => "Message: Error Insert Answer Detail has occured!"));
				}


			}

			$answer = $this->Data_model->select_answer_score($kode_answer)->row();
			$data5 = array(
				'answer_score' => $answer->score
			);

			if($this->Data_model->update_answer_score($kode_answer,$data5))
			{

			}
			else
			{

				echo json_encode(array("message" => "Message: Error Insert Answer has occured!"));
			}


			echo "Your Score: ".$answer->score;
		}
		else
		{
			echo json_encode(array("message" => "Message: Error Insert Answer has occured!"));
		}
	}

	public function answer2()
	{
		$max = $this->Data_model->select_answer();
		foreach($max->result() as $key)
		{
			$id_max = $key->id_answer;
		}

		$nourut = (int) substr($id_max, 4, 6);
		$nourut++;

		$kode_answer = "ANSW" .sprintf('%06s', $nourut);

		$data = explode("|", $this->input->post("id_module_essay"));
		
		$data2 = array(
			'id_answer' => $kode_answer,
			'id_user' => $this->session->id_user,
			'id_module' => $data[0]
		 );

		if($this->Data_model->insert_answer($data2))
		{
			for ($i = 1; $i <= $data[1]; $i++) { 
				$data3 = $this->input->post("pilihan-essay-".$i) !== NULL ? $this->input->post("pilihan-essay-".$i) : "0";
				$data4 = array(
					'id_answer' => $kode_answer, 
					'question' => $this->input->post("question-essay-".$i), 
					'answer_number' => $this->input->post("question-essay-number-".$i), 
					'answer_option' => 0, 
					'answer_value' => $data3, 
					'answer_status' => 0
				);

				if($this->Data_model->insert_answer_detail($data4))
				{

				}
				else
				{
					echo json_encode(array("message" => "Message: Error Insert Answer Detail has occured!"));
				}


			}

			$answer = $this->Data_model->select_answer_score($kode_answer)->row();
			$data5 = array(
				'answer_score' => $answer->score
			);

			if($this->Data_model->update_answer_score($kode_answer,$data5))
			{

			}
			else
			{

				echo json_encode(array("message" => "Message: Error Insert Answer has occured!"));
			}


			echo "Your Score: ".$answer->score;
		}
		else
		{
			echo json_encode(array("message" => "Message: Error Insert Answer has occured!"));
		}
	}
}