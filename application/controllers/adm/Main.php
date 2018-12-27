<?php header('Access-Control-Allow-Origin: *'); ?>
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Main extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->model('adm/Data_model');
	}

	public function index()
	{
		$this->load->view('adm/login');
	}
	public function Login()
	{
		$account_name = $this->input->post('username');
		$account_password = $this->input->post('password');
		$temp_account = $this->Data_model->Login($account_name,$account_password);

		
		if ($temp_account->num_rows() == 1)
			{
				foreach($temp_account->result() as $key)
				{
					$array_items = array(
						'id_user' => $key->id_user,
						'user_password' => $key->user_password,
						'user_photo' => $key->user_photo,
						'logged_in' => true
						);
					$this->session->set_userdata($array_items);
				}
					echo json_encode(array('msg'=>"Success.", 'url'=>"adm/dashboard/", 'status'=>true));
			}
		else
			{
				echo json_encode(array('msg' => "Main Gagal"));
			}
	}
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('/adm');
	}

}