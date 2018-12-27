<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Index extends CI_Controller {

	private $limit = 4;
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper(array('url','form'));
		$this->load->model('Data_model');
	}

	public function index()
	{
		$data['select_new_exam']= $this->Data_model->select_new_exam($limit);
		$data['select_popular_exam']= $this->Data_model->select_popular_exam($limit);
        $this->load->view('header');
		$this->load->view('index',$data);
        $this->load->view('footer');
	}
	
	public function Login()
	{
		$account_name = $this->input->post('id_email');
		$account_password = $this->input->post('user_password1');
		$temp_account = $this->Data_model->Login($account_name,$account_password);

		
		if ($temp_account->num_rows() == 1)
			{
				foreach($temp_account->result() as $key)
				{
					$array_items = array(
						'id_user' => $key->id_user,
						'user_password' => $key->user_password,
						'user_email' => $key->user_email,
						'user_photo' => $key->user_photo,
						'logged_in' => true
						);
					$this->session->set_userdata($array_items);
				}
				redirect('');
			}
		else
			{
				$this->session->set_flashdata('notif', '<div class="waves-effect waves-light btn-large signup-button-nav red darken-1">Login Failed!</div>');
				redirect('');
			}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('');
	}

	public function register()
	{
		date_default_timezone_set('Asia/jakarta');
		$this->load->library('upload');
        $nmfile = $_FILES['user_photo']['name'];
        $config['upload_path'] = './assets/img/account/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4MB
        $config['max_width']  = ''; 
        $config['max_height']  = '';
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);

        if ($this->upload->do_upload('user_photo'))
        {
			$gbr = $this->upload->data();
			$data = array(
				'id_user' => $this->input->post('id_user'),
				'user_fullname' => $this->input->post('first_name')." ".$this->input->post('last_name'),
				'user_password' =>$this->input->post('user_password2'),
				'user_role' =>"1",
				'user_email' =>$this->input->post('user_email'),
				'user_photo' =>$gbr['file_name'],
				'user_activationcode' =>$this->generateRandomString(12)
			);
			if($this->Data_model->insert_account($data))
			{
				$config = Array(
					'protocol' => 'mail',
					'smtp_host' => 'mail.digix.id',
					'smtp_port' => 465,
					'smtp_user' => 'support@digix.id', //isi dengan gmailmu!
					'smtp_pass' => 'jLFINNnhyF', //isi dengan password gmailmu!
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);

				$this->load->library('email', $config);
				$this->email->from('support@digix.id','DigiX');
				$this->email->set_newline("\r\n");
				$this->email->to($this->input->post('user_email')); //email tujuan. Isikan dengan emailmu!
				$this->email->subject('Activation DigiX');
				$this->email->message($this->load->view('digix', $data, true));
				if($this->email->send()) {
					$this->session->set_flashdata('notif', '<div class="waves-effect waves-light btn-large signup-button-nav teal lighten-2">Register success. Check your email!</div>');
					redirect('');
				 }
			}
			else
			{
				$this->session->set_flashdata('notif', '<div class="waves-effect waves-light btn-large signup-button-nav red darken-1">Register Failed!</div>');
				redirect('');
			}
		}
		else
		{
			$data = array(
				'id_user' => $this->input->post('id_user'),
				'user_fullname'=> $this->input->post('first_name'). " " .$this->input->post('last_name'),
				'user_password' =>$this->input->post('user_password2'),
				'user_role' =>"1",
				'user_email' =>$this->input->post('user_email'),
				'user_activationcode' =>$this->generateRandomString(12)
			);
			if($this->Data_model->insert_account($data))
			{
				$config = Array(
					'protocol' => 'mail',
					'smtp_host' => 'mail.digix.id',
					'smtp_port' => 465,
					'smtp_user' => 'support@digix.id', //isi dengan gmailmu!
					'smtp_pass' => 'jLFINNnhyF', //isi dengan password gmailmu!
					'mailtype' => 'html',
					'charset' => 'iso-8859-1',
					'wordwrap' => TRUE
				);

				$this->load->library('email', $config);
				$this->email->from('support@digix.id','DigiX');
				$this->email->set_newline("\r\n");
				$this->email->to($this->input->post('user_email')); //email tujuan. Isikan dengan emailmu!
				$this->email->subject('Activation DigiX');
				$this->email->message($this->load->view('digix', $data, true));
				if($this->email->send()) {
					$this->session->set_flashdata('notif', '<div class="waves-effect waves-light btn-large signup-button-nav teal lighten-2">Register success. Check your email!</div>');
					redirect('');
				 }
			}
			else
			{
				$this->session->set_flashdata('notif', '<div class="waves-effect waves-light btn-large signup-button-nav red darken-1">Register Failed!</div>');
				redirect('');
			}
		}
	}

	public function activation($id_user, $user_activationcode)
    {
        $data = array(
            'user_status' => 1);

        if($this->Data_model->update_account($id_user,$user_activationcode,$data))
        {
	        $this->session->set_flashdata('notif', '<div class="waves-effect waves-light btn-large signup-button-nav teal lighten-2">Your activation has success!</div>');
			redirect('../');
        }
        else
        {
        	$this->session->set_flashdata('notif', '<div class="waves-effect waves-light btn-large signup-button-nav red darken-1">Activation Failed!</div>');
			redirect('../');
        }

    }

	public function generateRandomString($length = 10) 
	{
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
	
}