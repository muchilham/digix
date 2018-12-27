<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends CI_Controller {

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
	public function admin()
	{
		$data['select_account']= $this->Data_model->select_account_admin();
		$this->load->view('adm/tables-account-admin', $data);
	}
	public function user()
	{
		$data['select_account']= $this->Data_model->select_account_user();
		$this->load->view('adm/tables-account-user', $data);
	}
	public function add_account_admin()
	{
		$this->load->view('adm/add-account-admin');
	}
	public function proses_add_account()
	{
		date_default_timezone_set('Asia/jakarta');

		$this->load->library('upload');
        $nmfile = $_FILES['file']['name'];
        $config['upload_path'] = './assets/adm/images/account/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M
        $config['max_width']  = ''; 
        $config['max_height']  = '';
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);

        if ($this->upload->do_upload('file'))
        {
	        $gbr = $this->upload->data();
			$data = array(
	                  'id_user' =>$this->input->post('username'),
	                  'user_fullname' =>$this->input->post('fullname'),
	                  'user_password' =>$this->input->post('password'),
	                  'user_role' =>"0",
	                  'user_email' =>$this->input->post('email'),
	                  'user_photo' =>$gbr['file_name']
	            );
			if($this->Data_model->insert_account($data))
			{
				$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully added.</div>');
				redirect('adm/account/admin');
			}
			else
			{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
				redirect('adm/account/admin');
			}
		}
		else
		{
			$data = array(
	                  'id_user' =>$this->input->post('username'),
	                  'user_fullname' =>$this->input->post('fullname'),
	                  'user_password' =>$this->input->post('password'),
	                  'user_role' =>"0",
	                  'user_email' =>$this->input->post('email')
	            );
			if($this->Data_model->insert_account($data))
			{
				$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully added.</div>');
				redirect('adm/account/admin');
			}
			else
			{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
				redirect('adm/account/admin');
			}
		}

	}
	public function proses_update_account_admin($account_name)
	{
		date_default_timezone_set('Asia/jakarta');

		$this->load->library('upload');
        $nmfile = $_FILES['file']['name'];
        $config['upload_path'] = './assets/adm/images/account/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M
        $config['max_width']  = ''; 
        $config['max_height']  = '';
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);

        if ($this->upload->do_upload('file'))
        {
	        $gbr = $this->upload->data();
			$data = array(
	                  'id_user' =>$this->input->post('username'),
	                  'user_fullname' =>$this->input->post('fullname'),
	                  'user_password' =>$this->input->post('password'),
	                  'user_role' =>"0",
	                  'user_email' =>$this->input->post('email'),
	                  'user_photo' =>$gbr['file_name']
	            );

			$select_account_get = $this->Data_model->select_account_get($account_name);
			$row = $select_account_get->row();
			unlink("./assets/adm/images/account/$row->user_photo");

			if($this->Data_model->update_account_admin($account_name,$data))
			{
				$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully changed.</div>');
				redirect('adm/account/admin');
			}
			else
			{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to change.</div>');
				redirect('adm/account/admin');
			}
		}
		else
		{
			$data = array(
	                  'id_user' =>$this->input->post('username'),
	                  'user_fullname' =>$this->input->post('fullname'),
	                  'user_password' =>$this->input->post('password'),
	                  'user_role' =>"0",
	                  'user_email' =>$this->input->post('email')
	            );
			if($this->Data_model->update_account_admin($account_name,$data))
			{
				$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully changed.</div>');
				redirect('adm/account/admin');
			}
			else
			{
				$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to change.</div>');
				redirect('adm/account/admin');
			}
		}

	}
	public function delete_account($account_name)
	{
		$select_account_get = $this->Data_model->select_account_get($account_name);
		$row = $select_account_get->row();

		if($row->user_photo != "default.jpg")
		{
		unlink("./assets/adm/images/account/$row->user_photo");
		}

		if($this->Data_model->delete_account($account_name))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/account/user');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/account/user');
		}
	}

	public function delete_account_admin($account_name)
	{
		$select_account_get = $this->Data_model->select_account_get($account_name);
		$row = $select_account_get->row();

		if($row->user_photo != "default.jpg")
		{
			unlink("./assets/adm/images/account/$row->user_photo");
		}

		if($this->Data_model->delete_account($account_name))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/account/admin');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/account/admin');
		}
	}
	public function update_account_admin($nama_account)
	{
		$select_account_get = $this->Data_model->select_account_get($nama_account);
		$data['select_account_get']= $select_account_get->row();
		$data['id_user'] = $nama_account;
		$this->load->view('adm/update-account-admin',$data);
	}
}