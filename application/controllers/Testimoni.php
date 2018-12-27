<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Testimoni extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		if($this->session->userdata('logged_in')!=true)
		{
			redirect('');
		}
		$this->load->helper(array('url','form'));
		$this->load->model('Data_model');
	}
	public function index()
	{
		$data['select_testimoni_get_by_user']= $this->Data_model->select_testimoni_get_by_user($this->session->id_user);
		
		$this->load->view('header');
		$this->load->view('testimoni', $data);
		$this->load->view('footer3');

	}
	public function add_testimoni($id_exam)
	{
		$data['id_exam'] = $id_exam;
		$this->load->view('header');
		$this->load->view('addtestimoni',$data);
		$this->load->view('footer3');
	}
	public function proses_add_testimoni($id_exam)
	{
		date_default_timezone_set('Asia/jakarta');
		$data = array(
                  'id_exam' =>$id_exam,
                  'id_user' => $this->session->id_user,
                  'testimoni' => $this->input->post('testimoni'),
            );
		if($this->Data_model->insert_testimoni($data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully added.</div>');
			redirect('adm/testimoni');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
			redirect('testimoni');
		}
	}
}
