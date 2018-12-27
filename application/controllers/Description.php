<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Description extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('Data_model');
	}

	public function index($id_exam)
	{
		$data['select_exam'] = $this->Data_model->select_exam_get($id_exam)->row();
		$data['select_modul'] = $this->Data_model->select_modul_get($id_exam);
		$data['select_testimoni'] = $this->Data_model->select_testimoni_get_by_exam($id_exam);
		$data['id_exam'] = $id_exam;
		$this->load->view('header2');
		$this->load->view('description', $data);
		$this->load->view('footer');
	}
}