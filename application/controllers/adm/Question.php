<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Question extends CI_Controller {

	public function __construct(){
		parent::__construct();
		if($this->session->userdata('logged_in')!=true)
		{
			redirect('adm');
		}
		$this->load->helper(array('url','form'));
		$this->load->model('adm/Data_model');
	}

	public function index(){
		$data['select_question_group_by_type']= $this->Data_model->select_question_group_by_type();
		$this->load->view('adm/tables-question', $data);
	}

	public function detail_question($question_type)
	{
		$data["select_question_get_by_type"] = $this->Data_model->select_question_get_by_type($question_type);
		$data['question_type'] = $question_type;
		if($question_type == '0'){
			$this->load->view('adm/tables-question-pg', $data);
		}
		else
		{
			$this->load->view('adm/tables-question-essay', $data);
		}
	}
	public function add_question($question_type){
		$data['question_type'] = $question_type;

		if($question_type == '0'){
			$this->load->view('adm/add-question-pg', $data);
		}
		else
		{
			$this->load->view('adm/add-question-essay', $data);
		}
	}

	public function proses_add_question($question_type)
	{
		# code...
		$this->load->library('upload');
		$question_group = $this->input->post('question_group');
		$question_group_description = $this->input->post('question_group_description');
		$last_id_question_group = NULL;
	    
	    if(!empty($question_group))
	    {
	    	$this->upload->initialize($this->set_upload_options_question_group());

	        if ($this->upload->do_upload('question_group_image'))
	        {
		        $gbr = $this->upload->data();
				$data = array(
		                  'question_group' => $question_group,
		                  'question_group_image' => $gbr['file_name'],
		                  'question_group_description' =>$question_group_description
		            );

				$last_id_question_group = $this->Data_model->insert_question_group($data);

			}
			else
			{
				$data = array(
		                  'question_group' => $question_group,
		                  'question_group_image' => NULL,
		                  'question_group_description' =>$question_group_description
		            );

				$last_id_question_group = $this->Data_model->insert_question_group($data);
			}
	    }
        
		$question = $this->input->post('question');
    	$question_key_description = $this->input->post('question_key_description');
    	$option_abjad = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
    	$count_id_question_option = $this->input->post('count_id_question_option');

		$files = $_FILES;	
		for ($i=0; $i < sizeof($question); $i++) 
		{ 

			$_FILES['question_image']['name']= $files['question_image']['name'][$i];
	        $_FILES['question_image']['type']= $files['question_image']['type'][$i];
	        $_FILES['question_image']['tmp_name']= $files['question_image']['tmp_name'][$i];
	        $_FILES['question_image']['error']= $files['question_image']['error'][$i];
	        $_FILES['question_image']['size']= $files['question_image']['size'][$i];    

		    $this->upload->initialize($this->set_upload_options_question());

	        if ($this->upload->do_upload('question_image')) 
	        {
	        	$gbr = $this->upload->data();
	        	$data_question = array(
	                  'question' => $question[$i],
	                  'question_image' => $gbr['file_name'],
	                  'question_type' => $question_type,
	                  'id_question_group' => $last_id_question_group,
	                  'id_subject_detail' => NULL
	            );

	        	$last_id_question = $this->Data_model->insert_question($data_question);

				$question_value = explode(",", $count_id_question_option[$i]);

				for ($k=0; $k < count($question_value);$k++) { 
					$question_option_value = $this->input->post("question_option_". $question_value[$k]);
					$question_option_key = $this->input->post('question_key_'.$i);

	        		$data_question_option = array(
	                  'id_question' => $last_id_question,
	                  'question_option' => $option_abjad[$k],
	                  'question_value' => $question_option_value,
	                  'question_value_image' => NULL,
	                  'question_key' => $question_option_key == $question_value[$k] ? 1 : 0,
	                  'question_key_description' => $question_key_description[$i]
	            	);

	            	if ($this->Data_model->insert_question_option($data_question_option)) {
	            		echo "Horeee berhasil";
	            	}
	            	else {
	            		echo "Yah gagal";
	            	}
	            }
	        }
	        else
	        {
	        	$data_question = array(
	                  'question' => $question[$i],
	                  'question_image' => NULL,
	                  'question_type' => $question_type,
	                  'id_question_group' => $last_id_question_group,
	                  'id_subject_detail' => NULL
	            );

	        	$last_id_question = $this->Data_model->insert_question($data_question);

				$question_value = explode(",", $count_id_question_option[$i]);

				for ($k=0; $k < count($question_value);$k++) { 
					$question_option_value = $this->input->post("question_option_". $question_value[$k]);
					$question_option_key = $this->input->post('question_key_'.$i);

	        		$data_question_option = array(
	                  'id_question' => $last_id_question,
	                  'question_option' => $option_abjad[$k],
	                  'question_value' => $question_option_value,
	                  'question_value_image' => NULL,
	                  'question_key' => $question_option_key == $question_value[$k] ? 1 : 0,
	                  'question_key_description' => $question_key_description[$i]
	            	);

	            	if ($this->Data_model->insert_question_option($data_question_option)) {
	            		echo "Horeee berhasil ";
	            	}
	            	else {
	            		echo "Yah gagal ";
	            	}
	            }
	        }
		}
		redirect('adm/question/detail_question/0');
	}
	public function update_question($id_question, $question_type)
	{
		$data['id_question'] = $id_question;
		$data['question_type'] = $question_type;
		$data['select_question'] = $this->Data_model->select_question_get($id_question)->row();
		$data['select_question_option_max'] = $this->Data_model->select_question_option_max($id_question)->row();

		if($question_type == 0)
		{
			$data['select_question_option_get'] = $this->Data_model->select_question_option_get($id_question);
			$this->load->view('adm/update-question-pg',$data);
		}
		else
		{
			$data['select_question'] = $this->Data_model->select_question_get($id_question);
			$this->load->view('adm/update-question-essay',$data);
		}
	}

	public function proses_update_question($id_question, $question_type)
	{
		# code...
		$this->load->library('upload');
		$question = $this->input->post("question");

		$count_id_question_option_added = $this->input->post("count_id_question_option_added");
		$count_id_question_option_removed = $this->input->post("count_id_question_option_removed");
		$question_key_description = $this->input->post("question_key_description");
		$question_key = $this->input->post("question_key");

		if (empty($_FILES['question_image']['name'])) 
		{
			$data = array(
	                  'question' => $question
	            );
			$question = $this->Data_model->update_question($id_question, $data);
		}
		else 
		{
			$question_image = $_FILES['question_image']['name'];
	        $config['upload_path'] = './assets/adm/images/question'; //Folder untuk menyimpan hasil upload
	        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
	        $config['max_size'] = '40000'; //maksimum besar file 4M
	        $config['max_width']  = ''; 
	        $config['max_height']  = '';
	        $config['file_name'] = $question_image; //nama yang terupload nantinya
	        $this->upload->initialize($config);

	        if ($this->upload->do_upload('question_image'))
	        {
		        $gbr = $this->upload->data();
				$data = array(
		                  'question' => $question,
		                  'question_image' => $gbr['file_name']
	            		);

				$update_question = $this->Data_model->update_question($id_question_group, $data);
			}
		}


		$count_id_question_option_added =explode(',', $count_id_question_option_added);
		$count_id_question_option_removed =explode(',', $count_id_question_option_removed);

		for ($i=0; $i < count($count_id_question_option_added); $i++) { 
			# code...
			
		}

		for ($i=0; $i < count($count_id_question_option_removed); $i++) { 
			# code...
		}
	}

    
    public function delete_question($id_question)
	{
		if($this->Data_model->delete_question($id_question))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/question');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/question');
		}
	}


	# Subject Detail Question
	public function subject_detail_question()
	{
		$data['select_subject_detail_question']= $this->Data_model->select_subject_detail_question();
		$this->load->view('adm/tables-subject-detail-question', $data);
	}
	// public function add_subject_detail_question($id_subject_detail)
	// {
	// 	$data['select_question_get_by_subject_detail']= $this->Data_model->select_question_get_by_subject_detail(NULL);
	// 	$data['id_subject_detail'] = $id_subject_detail;
	// 	$this->load->view('adm/add-subject-detail-question',$data);
	// }
	// public function proses_add_subject_detail_question()
	// {
	// 	$id_subject_detail = $this->input->post('id_subject_detail');
	// 	$id_question = $this->input->post('id_question');
	// 	$data_id_question = explode(",", $id_question);
	// 	for ($i=0; $i < count($data_id_question); $i++) { 
	// 		$data_question = array(
	// 			"id_subject_detail" => $id_subject_detail
	// 		);

	// 		$update_question = $this->Data_model->update_question($data_id_question[$i], $data_question);
	// 	}

	// 	if ($update_question) {
	// 		$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully added.</div>');
	// 		redirect('adm/question/subject_detail_question');
 //    	}
 //    	else {
 //    		$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
	// 		redirect('adm/question/subject_detail_question');
 //    	}
	// }
	public function update_subject_detail_question($id_subject_detail)
	{
		$data['id_subject_detail'] = $id_subject_detail;
		$select_question_get_by_subject_detail_checked = $this->Data_model->select_question_get_by_subject_detail($id_subject_detail)->result();
		$data['select_question_get_by_subject_detail']= $this->Data_model->select_question_get_by_subject_detail_2($id_subject_detail);
		$datas = array();
		$i=0;
		foreach ($select_question_get_by_subject_detail_checked as $key) {
			$datas[$i] = (int)$key->id_question;
			$i++;
		}

		$data['select_question_get_by_subject_detail_checked'] = json_encode($datas);
		$this->load->view('adm/update-subject-detail-question',$data);
	}
	public function proses_update_subject_detail_question()
	{
		$id_subject_detail = $this->input->post('id_subject_detail');
		$id_question1 = $this->input->post('id_question1');
		$id_question2 = $this->input->post('id_question2');
		$data_id_question1 = explode(",", $id_question1);
		$data_id_question2 = explode(",", $id_question2);

		for ($i=0; $i < count($data_id_question1); $i++) { 
			$data_question1 = array(
				"id_subject_detail" => NULL
			);

			$update_question1 = $this->Data_model->update_question($data_id_question1[$i], $data_question1);
		}

		for ($j=0; $j < count($data_id_question2); $j++) { 
			$data_question2 = array(
				"id_subject_detail" => $id_subject_detail
			);

			$update_question2 = $this->Data_model->update_question($data_id_question2[$j], $data_question2);
		}

		if($update_question1 && $update_question2)
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully updated.</div>');
			redirect('adm/question/subject_detail_question');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/question/subject_detail_question');
		}
	}
	public function delete_subject_detail_question($id_subject_detail)
	{
		$data = array('id_subject_detail' => NULL);
		if($this->Data_model->delete_subject_detail_question($id_subject_detail,$data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/question/subject_detail_question');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/question/subject_detail_question');
		}
	}


	# Question Group
	public function group()
	{
		$data['select_question_group']= $this->Data_model->select_question_group();
		$this->load->view('adm/tables-question-group', $data);
	}

	public function add_question_group()
	{
		$data['select_question_get_by_question_group']= $this->Data_model->select_question_get_by_question_group(NULL);
		$this->load->view('adm/add-question-group', $data);
	}

	public function proses_add_question_group()
	{
		$this->load->library('upload');
		$question_group = $this->input->post('question_group');
		$question_group_description = $this->input->post('question_group_description');
		$id_question = $this->input->post('id_question');

        $question_group_image = $_FILES['question_group_image']['name'];
        $config['upload_path'] = './assets/adm/images/question_group'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M
        $config['max_width']  = ''; 
        $config['max_height']  = '';
        $config['file_name'] = $question_group_image; //nama yang terupload nantinya
        $this->upload->initialize($config);

        if ($this->upload->do_upload('question_group_image'))
        {
	        $gbr = $this->upload->data();
			$data = array(
	                  'question_group' => $question_group,
	                  'question_group_image' => $gbr['file_name'],
	                  'question_group_description' =>$question_group_description
	            );

			$last_id_question_group = $this->Data_model->insert_question_group($data);

			$data_id_question = explode(",", $id_question);
			for ($i=0; $i < count($data_id_question); $i++) { 
				$data_question = array(
					"id_question_group" => $last_id_question_group
				);

				$update_question = $this->Data_model->update_question($data_id_question[$i], $data_question);
			}

			if ($update_question) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully added.</div>');
				redirect('adm/question/group');
        	}
        	else {
        		$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
				redirect('adm/question/group');
        	}
		}
		else
		{
			$data = array(
	                  'question_group' => $question_group,
	                  'question_group_image' => NULL,
	                  'question_group_description' =>$question_group_description
	            );

			$last_id_question_group = $this->Data_model->insert_question_group($data);

			$data_id_question = explode(",", $id_question);
			for ($i=0; $i < count($data_id_question); $i++) { 
				$data_question = array(
					"id_question_group" => $last_id_question_group
				);

				$update_question = $this->Data_model->update_question($data_id_question[$i], $data_question);
			}

			if ($update_question) {
				$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully added.</div>');
				redirect('adm/question/group');
        	}
        	else {
        		$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
				redirect('adm/question/group');
        	}
		}
	}

	public function update_question_group($id_question_group)
	{

		$data['id_question_group'] = $id_question_group;
		$select_question_get_by_question_group_checked = $this->Data_model->select_question_get_by_question_group($id_question_group)->result();
		$data['select_question_get_by_question_group']= $this->Data_model->select_question_get_by_question_group_2($id_question_group);
		$data["select_question_group"] = $this->Data_model->select_question_group_get($id_question_group)->row();

		$datas = array();
		$i=0;
		foreach ($select_question_get_by_question_group_checked as $key) {
			$datas[$i] = (int)$key->id_question;
			$i++;
		}

		$data['select_question_get_by_question_group_checked'] = json_encode($datas);
		$this->load->view('adm/update-question-group', $data);
	}

	public function proses_update_question_group($id_question_group)
	{
		$this->load->library('upload');
		$question_group = $this->input->post('question_group');
		$question_group_description = $this->input->post('question_group_description');
		$id_question1 = $this->input->post('id_question1');
		$id_question2 = $this->input->post('id_question2');
		$data_id_question1 = explode(",", $id_question1);
		$data_id_question2 = explode(",", $id_question2);


		if (empty($_FILES['question_group_image']['name'])) {
			$data = array(
	                  'question_group' => $question_group,
	                  'question_group_description' =>$question_group_description
	            );
			$update_question_group = $this->Data_model->update_question_group($id_question_group, $data);
		}
		else {

			$question_group_image = $_FILES['question_group_image']['name'];
	        $config['upload_path'] = './assets/adm/images/question_group'; //Folder untuk menyimpan hasil upload
	        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
	        $config['max_size'] = '40000'; //maksimum besar file 4M
	        $config['max_width']  = ''; 
	        $config['max_height']  = '';
	        $config['file_name'] = $question_group_image; //nama yang terupload nantinya
	        $this->upload->initialize($config);

	        if ($this->upload->do_upload('question_group_image'))
	        {
		        $gbr = $this->upload->data();
				$data = array(
		                  'question_group' => $question_group,
		                  'question_group_image' => $gbr['file_name'],
		                  'question_group_description' =>$question_group_description
	            		);

				$update_question_group = $this->Data_model->update_question_group($id_question_group, $data);
			}
		}

		for ($i=0; $i < count($data_id_question1); $i++) { 
			$data_question1 = array(
				"id_question_group" => NULL
			);

			$update_question1 = $this->Data_model->update_question($data_id_question1[$i], $data_question1);
		}

		for ($j=0; $j < count($data_id_question2); $j++) { 
			$data_question2 = array(
				"id_question_group" => $id_question_group
			);

			$update_question2 = $this->Data_model->update_question($data_id_question2[$j], $data_question2);
		}


		if($update_question_group && $update_question1 && $update_question2)
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully updated.</div>');
			redirect('adm/question/group');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to update.</div>');
			redirect('adm/question/group');
		}
	}

	public function delete_question_group($id_question_group)
	{
		if($this->Data_model->delete_question_group($id_question_group))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/question/group');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/question/group');
		}
	}


	# Others
	public function select_question_get_by_id_subject_detail()
	{
		echo json_encode(array('data' => $this->Data_model->select_question_get_by_subject_detail(NULL)->result()));
	}

	private function set_upload_options_question()
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = './assets/adm/images/question'; //Folder untuk menyimpan hasil upload
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
	    $config['max_size'] = '40000'; //maksimum besar file 4M
	    $config['max_width']  = ''; 
	    $config['max_height']  = '';

	    return $config;
	}

	private function set_upload_options_question_group()
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = './assets/adm/images/question_group'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M
        $config['max_width']  = ''; 
        $config['max_height']  = '';

	    return $config;
	}
}