<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in')!=true)
		{
			redirect('adm');
		}
		$this->load->library('session');
		$this->load->model('adm/Data_model');
	}

	public function index()
	{
		$this->load->view('adm/dashboard');
	}
}