<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Answer extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in')!=true)
		{
			redirect('adm');
		}
		$this->load->helper(array('url','form'));
		$this->load->model('adm/Data_model');
	}

	public function index()
	{
		
	}
	public function choice_one()
	{
		$data['select_answer_pg']= $this->Data_model->select_answer_pg();
		$this->load->view('adm/tables-answer-pg',$data);
	}
	public function essay()
	{
		$data['select_answer_essay']= $this->Data_model->select_answer_essay();
		$this->load->view('adm/tables-answer-essay',$data);
	}
	public function check_answer($id_answer)
	{
		$data['select_answer_detail'] = $this->Data_model->select_answer_detail($id_answer);
		$data['id_answer'] = $id_answer;
		$this->load->view('adm/answer_check_essay', $data);
	}

	public function proses_check_answer($id_answer)
	{
		$id_answer_detail = $this->input->post('id_answer_detail');
		$answer_correct = $this->input->post('answer_correct');
		$correct = $this->input->post('correct');

		for($key_answer=0;$key_answer<count($id_answer_detail);$key_answer++) 
		{

					$data = array(
		                    'answer_correct' => $answer_correct[$key_answer],
		                    'answer_status' => $correct[$key_answer]
		                );
				
				 $this->Data_model->update_answer_detail($id_answer_detail[$key_answer],$id_answer,$data);
			
		}

		$answer = $this->Data_model->select_answer_score($id_answer)->row();
		$data_score = array(
				'answer_score' => $answer->score
			);
		$this->Data_model->update_answer($id_answer,$data_score);
		redirect('adm/answer/essay');
	}
}