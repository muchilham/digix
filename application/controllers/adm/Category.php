<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category extends CI_Controller {

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
		$data['select_category']= $this->Data_model->select_category();
		$this->load->view('adm/tables-category', $data);
	}
	public function add_category()
	{
		$this->load->view('adm/add-category');
	}
	public function proses_add_category()
	{
		$data = array(
                  'category_name' =>$this->input->post('category_name'),
                  'category_description' =>$this->input->post('category_description'),
                  'category_status' => '1'
            );

		if($this->Data_model->insert_category($data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully added.</div>');
			redirect('adm/category');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
			redirect('adm/category');
		}
	}
	public function proses_update_category($id_category)
	{

		$data = array(
                  'category_name' =>$this->input->post('category_name'),
                  'category_description' =>$this->input->post('category_description')
            );

		if($this->Data_model->update_category($id_category,$data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully changed.</div>');
			redirect('adm/category');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to change.</div>');
			redirect('adm/category');
		}
	}
	public function update_category($id_category)
	{
		$select_category = $this->Data_model->select_category_get($id_category);
		$data['select_category']= $select_category->row();
		$data['id_category'] = $id_category;
		$this->load->view('adm/update-category',$data);
	}
	public function delete_category($id_category)
	{

		$data = array(
                  'category_status' =>0
            );

		if($this->Data_model->delete_category($id_category,$data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/category');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/category');
		}
	}
}