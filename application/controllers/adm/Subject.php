<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Subject extends CI_Controller {

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
		$data['select_subject']= $this->Data_model->select_subject();
		$this->load->view('adm/tables-subject', $data);
	}
	public function add_subject()
	{
		$this->load->view('adm/add-subject');
	}
	public function proses_add_subject()
	{
		date_default_timezone_set('Asia/jakarta');
		$data = array(
                  'subject_name' =>$this->input->post('subject_name'),
                  'subject_description' =>$this->input->post('subject_description')
            );
		if($this->Data_model->insert_subject($data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully added.</div>');
			redirect('adm/subject');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
			redirect('adm/subject');
		}
	}


	public function update_subject($id_subject)
	{
		$select_subject = $this->Data_model->select_subject_get($id_subject);
		$data['select_subject']= $select_subject->row();
		$data['id_subject'] = $id_subject;
		$this->load->view('adm/update-subject',$data);
	}

	public function proses_update_subject($id_subject)
	{
		date_default_timezone_set('Asia/jakarta');
		$data = array(
                  'subject_name' =>$this->input->post('subject_name'),
                  'subject_description' =>$this->input->post('subject_description')
            );
		if($this->Data_model->update_subject($id_subject, $data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully updated.</div>');
			redirect('adm/subject');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to update.</div>');
			redirect('adm/subject');
		}
	}
	public function delete_subject($id_subject)
	{
		if($this->Data_model->delete_subject($id_subject))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/subject');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/subject');
		}
	}




	public function detail()
	{
		$data['select_subject_detail']= $this->Data_model->select_subject_detail();
		$this->load->view('adm/tables-subject-detail', $data);
	}

	public function add_subject_detail()
	{
		$data['select_subject']= $this->Data_model->select_subject();
		$this->load->view('adm/add-subject-detail', $data);
	}

	public function proses_add_subject_detail()
	{
		date_default_timezone_set('Asia/jakarta');
		$data = array(
				  'id_subject' => $this->input->post('id_subject'),
                  'subject_detail_name' => $this->input->post('subject_detail_name'),
                  'subject_detail_description' =>$this->input->post('subject_detail_description')
            );
		if($this->Data_model->insert_subject_detail($data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully added.</div>');
			redirect('adm/subject/detail');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
			redirect('adm/subject/detail');
		}
	}

	public function update_subject_detail($id_subject_detail)
	{
		$select_subject_detail = $this->Data_model->select_subject_detail_get($id_subject_detail);
		$data['select_subject_detail']= $select_subject_detail->row();
		$data['id_subject_detail'] = $id_subject_detail;
		$data['select_subject']= $this->Data_model->select_subject();
		$this->load->view('adm/update-subject-detail',$data);
	}

	public function proses_update_subject_detail($id_subject_detail)
	{
		date_default_timezone_set('Asia/jakarta');
		$data = array(
				  'id_subject' => $this->input->post('id_subject'),
                  'subject_detail_name' => $this->input->post('subject_detail_name'),
                  'subject_detail_description' =>$this->input->post('subject_detail_description')
            );
		if($this->Data_model->update_subject_detail($id_subject_detail, $data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully updated.</div>');
			redirect('adm/subject/detail');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to update.</div>');
			redirect('adm/subject/detail');
		}
	}

	public function delete_subject_detail($id_subject_detail)
	{
		if($this->Data_model->delete_subject_detail($id_subject_detail))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/subject/detail');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/subject/detail');
		}
	}

}
