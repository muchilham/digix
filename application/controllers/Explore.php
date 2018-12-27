<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Explore extends CI_Controller {

	private $perPage = 8;
	public function __construct()
	{
		parent::__construct();
		$this->load->helper(array('url','form'));
        $this->load->library('session');
		$this->load->model('Data_model');
	}

	/** [index description] */
	public function index()
	{
		$data['select_category']= $this->Data_model->select_category();
		if(empty($this->input->get("param")))
		{
			if(!empty($this->input->get("page")))
	        {
				$start =  ceil($this->input->get("page") * $this->perPage) - 1;
				$data["select_exam"] = $this->Data_model->select_exam($this->perPage,$start);
				
	            $result = $this->load->view('exam', $data);
				echo json_encode($result);
			}
			else
	        {
				$data["select_exam"] = $this->Data_model->select_exam($this->perPage,0);
				$this->load->view('header2');
				$this->load->view('explore', $data);
				$this->load->view('footer');
			}
		}
		else
		{
			if(!empty($this->input->get("page")))
	        {
				$start =  ceil($this->input->get("page") * $this->perPage) - 1;
				$data["select_exam"] = $this->Data_model->select_exam2($this->input->get("param"),$this->perPage,$start);
				
	            $result = $this->load->view('exam', $data);
				echo json_encode($result);
			}
			else
	        {
				$data["select_exam"] = $this->Data_model->select_exam2($this->input->get("param"),$this->perPage,0);
				$this->load->view('header2');
				$this->load->view('explore', $data);
				$this->load->view('footer');
			}
		}
	}


	
}