<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Register extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
		$this->load->model('Data_model');
	}

	public function index()
	{		
		$this->load->view('header2');
		$this->load->view('register');
		$this->load->view('footer');
	}
}
