<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Exam extends CI_Controller {

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
		$data['select_exam']= $this->Data_model->select_exam_status();
		$this->load->view('adm/tables-exam', $data);
		// $this->load->view('adm/tables-exam');
	}
	public function add_exam()
	{
		$data['select_category']= $this->Data_model->select_category();
		$this->load->view('adm/add-exam', $data);
	}
	public function detail_exam($id_exam)
	{
		$data['select_exam'] = $this->Data_model->select_exam_get($id_exam)->row();
		$data['select_modul'] = $this->Data_model->select_modul_get($id_exam);
		$data['select_category']= $this->Data_model->select_category();
		$data['select_exam_category']= $this->Data_model->select_exam_category_get($id_exam);
		$data['id_exam'] = $id_exam;
		$this->load->view('adm/detail-exam', $data);
	}


	public function proses_add_exam()
	{
		$max = $this->Data_model->select_exam();
		foreach($max->result() as $key)
		{
			$id_max = $key->id_exam;
		}

		$nourut = (int) substr($id_max, 4, 6);
		$nourut++;

		$kode_exam = "EXAM" .sprintf('%06s', $nourut);

		$this->load->library('upload');
		$exam_name = $this->input->post('exam_name');
		$exam_description = $this->input->post('exam_description');
		$last_id_exam = NULL;
	    
	    if(!empty($exam_name))
	    {
	    	$this->upload->initialize($this->set_upload_options_exam());

	        if ($this->upload->do_upload('exam_image'))
	        {
		        $gbr = $this->upload->data();

		        $exam_image = $gbr['file_name'];

		        $this->upload->initialize($this->set_upload_options_exam());

		        if ($this->upload->do_upload('exam_image2')) {
		        	$gbr = $this->upload->data();
		        	$exam_image2 = $gbr['file_name'];

		        	$data = array(
							'id_exam' => $kode_exam,
							'exam_name' => $exam_name,
							'exam_description' => $exam_description,
							'exam_image' => $exam_image,
							'exam_image2' => $exam_image2
		            );

					$insert_exam = $this->Data_model->insert_exam($data);
		        }
		        else
		        {
		        	$data = array(
							'id_exam' => $kode_exam,
							'exam_name' => $exam_name,
							'exam_description' => $exam_description,
							'exam_image' => $exam_image,
							'exam_image2' => NULL
		            );

					$insert_exam = $this->Data_model->insert_exam($data);
		        }
				

			}
			else
			{
				$data = array(
							'id_exam' => $kode_exam,
							'exam_name' => $exam_name,
							'exam_description' => $exam_description,
							'exam_image' => NULL,
							'exam_image2' => NULL
		            );

				$insert_exam = $this->Data_model->insert_exam($data);
			}
	    }
        
		$module_name = $this->input->post('module_name');
		$module_description = $this->input->post('module_description');
    	$count_id_submodule = $this->input->post('count_id_submodule');

		$files = $_FILES;	
		for ($i=0; $i < sizeof($module_name); $i++) 
		{ 

			$_FILES['module_image']['name']= $files['module_image']['name'][$i];
	        $_FILES['module_image']['type']= $files['module_image']['type'][$i];
	        $_FILES['module_image']['tmp_name']= $files['module_image']['tmp_name'][$i];
	        $_FILES['module_image']['error']= $files['module_image']['error'][$i];
	        $_FILES['module_image']['size']= $files['module_image']['size'][$i];    

		    $this->upload->initialize($this->set_upload_options_module());

	        if ($this->upload->do_upload('module_image')) 
	        {
	        	$gbr = $this->upload->data();
	        	$data_module = array(
	                  'id_exam' => $kode_exam,
	                  'module_name' => $module_name[$i],
	                  'module_description' => $module_description[$i],
	                  'module_image' => $gbr['file_name'],
	                  'id_parent_module' => NULL
	            );

	        	$last_id_module = $this->Data_model->insert_module($data_module);

				$submodule_value = explode(",", $count_id_submodule[$i]);

				for ($k=0; $k < count($submodule_value);$k++) { 
					$submodule_name = $this->input->post("submodule_name_". $submodule_value[$k]);
					$submodule_description = $this->input->post('submodule_description_'.$submodule_value[$k]);

	        		$data_submodule = array(
	        			'id_exam' => $kode_exam,
	                  	'module_name' => $submodule_name,
	                  	'module_description' => $submodule_description,
	                  	'module_image' => NULL,
	                  	'id_parent_module' => $last_id_module
	            	);

	            	if ($this->Data_model->insert_module($data_submodule) > 0) {
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
	                  'id_exam' => $kode_exam,
	                  'module_name' => $module_name,
	                  'module_description' => $module_description,
	                  'module_image' => NULL,
	                  'id_parent_module' => NULL
	            );

	        	$last_id_module = $this->Data_model->insert_module($data_module);

				$submodule_value = explode(",", $count_id_submodule[$i]);

				for ($k=0; $k < count($submodule_value);$k++) { 
					$submodule_name = $this->input->post("submodule_name_". $submodule_value[$k]);
					$submodule_description = $this->input->post('submodule_description_'.$submodule_value[$k]);

	        		$data_submodule = array(
	        			'id_exam' => $kode_exam,
	                  	'module_name' => $submodule_name,
	                  	'module_description' => $submodule_description,
	                  	'module_image' => NULL,
	                  	'id_parent_module' => $last_id_module
	            	);

	            	if ($this->Data_model->insert_module($data_submodule) > 0) {
	            		echo "Horeee berhasil";
	            	}
	            	else {
	            		echo "Yah gagal";
	            	}
	            }
	        }
		}

		$category = $this->input->post('category');

		for($key_category=0;$key_category < count($category);$key_category++) {
			$data = array(
                    'id_exam'   => $kode_exam,
                    'id_category' => $category[$key_category]
                );
			$insert_category = $this->Data_model->insert_exam_category($data);
		}

		if($insert_category OR $insert_exam)
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully added.</div>');
			redirect('adm/exam');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
			redirect('adm/exam');
		}
	}
	
	public function delete_exam($id_exam)
	{
		$data = array('exam_status' => 0);
		if($this->Data_model->delete_exam($id_exam, $data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/exam');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/exam');
		}
	}
	public function update_exam($id_exam)
	{
		$data['select_exam'] = $this->Data_model->select_exam_get($id_exam)->row();
		$data['select_modul'] = $this->Data_model->select_modul_get($id_exam);
		$data['select_category']= $this->Data_model->select_category();
		$data['select_exam_category']= $this->Data_model->select_exam_category_get($id_exam);
		$data['id_exam'] = $id_exam;
		$this->load->view('adm/update-exam',$data);
	}
	public function proses_update_exam($id_exam)
	{
		

		$data = array();

		$config['upload_path'] = './assets/adm/images/exam/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M

        $this->load->library('upload', $config);

	    $data['exam_name'] = $this->input->post('exam_name');
	    $data['exam_description'] = $this->input->post('exam_description');
	    $data['exam_status'] = 1;

	    if ($this->upload->do_upload('exam_image')) {
		    $fileData = $this->upload->data();
		    $data['exam_image'] = $fileData['file_name'];
  		} 
  		if ($this->upload->do_upload('exam_image2')) {
		    $fileData2 = $this->upload->data();
		    $data['exam_image2'] = $fileData2['file_name'];
  		}

  		$insert_exam = $this->Data_model->update_exam($id_exam,$data);

		$this->Data_model->delete_category2($id_exam);
		
		$dataInfo = array();
        $this->load->library('upload');

        $files = $_FILES;
        $cpt = count($_FILES['modul_image']['name']);
        for($i=0; $i<$cpt; $i++)
        {
            $_FILES['modul_image']['name']= $files['modul_image']['name'][$i];
            $_FILES['modul_image']['type']= $files['modul_image']['type'][$i];
            $_FILES['modul_image']['tmp_name']= $files['modul_image']['tmp_name'][$i];
            $_FILES['modul_image']['error']= $files['modul_image']['error'][$i];
            $_FILES['modul_image']['size']= $files['modul_image']['size'][$i];

            $config = array();
            $config['upload_path']          = './assets/adm/images/modul/';
            $config['max_size']                 = 0;
            $config['max_width']              = 0;
            $config['max_height']             = 0;
            $config['encrypt_name'] 		= TRUE;
            $config['allowed_types'] = 'gif|jpg|png|jpeg';
            $config['overwrite']     = FALSE;
            $config['file_name']			= $_FILES['modul_image']['name'];

            $this->upload->initialize($config);

            if ( ! $this->upload->do_upload('modul_image'))
            {
               array_push($dataInfo,NULL);
            }
            else
            {
                array_push($dataInfo,$this->upload->data('file_name'));
            }
        }

		$count_modul = $this->input->post('count_modul');
		$modul = $this->input->post('modul');
		$modul_description = $this->input->post('modul_description');
		$modul_id = $this->input->post('id_modul');

		for($key_modul=0;$key_modul<=$count_modul;$key_modul++) 
		{
			if(!empty($modul_id[$key_modul]))
			{
				if(isset($modul[$key_modul]))
				{
					if($dataInfo[$key_modul] == NULL)
					{
						$data = array(
			                    'id_exam'   => $id_exam,
			                    'module_name' => $modul[$key_modul],
			                    'module_description' => $modul_description[$key_modul]
			                    );
					}
					else
					{
						$data = array(
		                    'id_exam'   => $id_exam,
		                    'module_name' => $modul[$key_modul],
		                    'module_description' => $modul_description[$key_modul],
		                    'module_image' => $dataInfo[$key_modul]
		                );
					}
					$update_modul = $this->Data_model->update_modul($modul_id[$key_modul],$data);
				}
				else
				{
					$this->Data_model->delete_modul($modul_id[$key_modul]);
					$this->Data_model->delete_modul2($modul_id[$key_modul]);
				}
			}
			elseif(!empty($modul[$key_modul]))
			{
				$data = array(
	                    'id_exam'   => $id_exam,
	                    'module_name' => $modul[$key_modul],
	                    'module_description' => $modul_description[$key_modul],
	                    'module_image' => $dataInfo[$key_modul]
	                );
				$update_modul = $this->Data_model->insert_modul($data);
			}
			

			$submodul_id = $this->input->post('id_submodul_'.$key_modul);
			$submodul = $this->input->post('submodul_'.$key_modul);
			$submodul_description = $this->input->post('submodul_description_'.$key_modul);

				for($key_submodul=0;$key_submodul < count($submodul_id);$key_submodul++)  {

					if($submodul_id[$key_submodul] != NULL)
					{
						if(isset($submodul[$key_submodul]))
						{
							$data = array(
			                    'id_exam'   => $id_exam,
			                    'module_name' => $submodul[$key_submodul],
			                    'module_description' => $submodul_description[$key_submodul],
			                    'id_parent_module' => $update_modul
			                );
			            	$update_submodul = $this->Data_model->update_modul($submodul_id[$key_submodul],$data);
			            }
			            else
			            {
			            	$update_submodul = $this->Data_model->delete_modul($submodul_id[$key_submodul]);
			            }
		        	}
		        	else
		        	{
		        		$data = array(
		                    'id_exam'   => $id_exam,
		                    'module_name' => $submodul[$key_submodul],
		                    'module_description' => $submodul_description[$key_submodul],
		                    'id_parent_module' => $update_modul
		                );
		            	$update_submodul = $this->Data_model->insert_modul($data);
		        	}
			}
		}

		$category = $this->input->post('category');

		for($key_category=0;$key_category < count($category);$key_category++) {
			$data = array(
                    'id_exam'   => $id_exam,
                    'id_category' => $category[$key_category]
                );
			$insert_category = $this->Data_model->insert_exam_category($data);
		}

		if($insert_category OR $insert_exam OR $insert_modul OR $insert_submodul)
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully changed.</div>');
			redirect('adm/exam');
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to change.</div>');
			redirect('adm/exam');
		}
	}

	public function delete_module($id_module)
	{
		$data = array('id_module' => $id_module);
		if($this->Data_model->delete_module($data))
		{	
			echo json_encode(array('msg'=>"Success.", 'status'=>"true"));
		}
		else
		{
			echo json_encode(array('msg'=>"failed.", 'status'=>"false"));
		}
	}


	public function question($id_module)
	{
		$data["select_exam_question"] = $this->Data_model->select_exam_question($id_module);
		$data["id_module"] = $id_module;
		$exam_question_type = 0;

		if(count($this->input->post("exam_question_type")) > 0)
		{
			$exam_question_type = $this->input->post("exam_question_type");
		}
		else
		{
			$exam_question_type = $this->Data_model->select_exam_question_type($id_module)->row();
			$exam_question_type = $exam_question_type->exam_question_type;
		}
		$data["exam_question_type"] = $exam_question_type;

		$this->load->view('adm/tables-exam-question', $data);		
	}

	public function add_exam_question($id_module,$exam_question_type)
	{
		$data['select_subject_detail']= $this->Data_model->select_subject_detail();
		$data["id_module"] = $id_module;
		$data["exam_question_type"] = $exam_question_type;
		$this->load->view('adm/add-exam-question', $data);
	}
	public function proses_add_exam_question($id_module,$exam_question_type)
	{
		# code...
		$id_subject_detail = $this->input->post("id_subject_detail");
		$total_question = $this->input->post("total_question");
		$is_tryout = $this->input->post("is_tryout");


		$data = array(
			'id_module' => $id_module,
			'id_subject_detail' => $id_subject_detail,
			'total_question' => $total_question,
			'is_random' => 1,
			'is_tryout' => $is_tryout == null ? 0 : 1,
			'exam_question_type' => $exam_question_type
		);
		if($this->Data_model->insert_exam_question($data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully changed.</div>');
			redirect('adm/exam/question/'.$id_module);
		}
	}

	public function update_exam_question($id_module, $id_exam_question)
	{
		# code...
		$data["select_subject_detail"] = $this->Data_model->select_subject_detail();
		$select_exam_question = $this->Data_model->select_exam_question_get($id_exam_question);
		$data['select_exam_question']= $select_exam_question->row();
		$data["id_module"] = $id_module;
		$data["id_exam_question"] = $id_exam_question;

		$this->load->view('adm/update-exam-question', $data);	
	}

	public function proses_update_exam_question($id_module, $id_exam_question)
	{
		# code...
		$id_subject_detail = $this->input->post("id_subject_detail");
		$total_question = $this->input->post("total_question");
		$is_tryout = $this->input->post("is_tryout");


		$data = array(
			'id_subject_detail' => $id_subject_detail,
			'total_question' => $total_question,
			'is_random' => 1,
			'is_tryout' => $is_tryout
		);
		if($this->Data_model->update_exam_question($id_module, $id_exam_question, $data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully changed.</div>');
			redirect('adm/exam/question/'.$id_module);
		}
	}
	public function delete_exam_question($id_exam_question)
	{
		if($this->Data_model->delete_exam_question($id_exam_question))
		{
			echo json_encode(array('msg'=>"Success.", 'status'=>"true"));
		}
		else
		{
			echo json_encode(array('msg'=>"failed.", 'status'=>"false"));
		}
	}

	public function exam_review($id_exam)
	{
		$data["select_exam_review_by_id_exam"] = $this->Data_model->select_exam_review_by_id_exam($id_exam);
		$data["id_exam"] = $id_exam;
		$this->load->view('adm/tables-exam-review', $data);		
	}


	public function add_exam_review($id_exam)
	{
		$data["id_exam"] = $id_exam;
		$this->load->view('adm/add-exam-review', $data);
	}

	public function proses_add_exam_review($id_exam)
	{
		$this->load->library('upload');
		$review_name = $this->input->post('review_name');
		$review = $this->input->post('review');

        $review_photo = $_FILES['review_photo']['name'];
        $config['upload_path'] = './assets/adm/images/review/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M
        $config['max_width']  = ''; 
        $config['max_height']  = '';
        $config['file_name'] = $review_photo; //nama yang terupload nantinya
        $this->upload->initialize($config);

        if ($this->upload->do_upload('review_photo'))
        {
	        $gbr = $this->upload->data();
			$data = array(
					  'id_exam' => $id_exam,
	                  'review_name' => $review_name,
	                  'review' =>$review,
	                  'review_photo' => $gbr['file_name']
            		);

			$add_exam_review = $this->Data_model->insert_exam_review($data);
		}
		else
		{
			$data = array(
					  'id_exam' => $id_exam,
	                  'review_name' => $review_name,
	                  'review' =>$review,
	                  'review_photo' => NULL
            		);

			$add_exam_review = $this->Data_model->insert_exam_review($data);
		}


		if ($add_exam_review) {
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully added.</div>');
			redirect('adm/exam/exam_review/'.$id_exam);
    	}
    	else {
    		$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
			redirect('adm/exam/exam_review/'.$id_exam);
    	}
	}

	public function update_exam_review($id_exam, $id_exam_review)
	{

		$data['id_exam_review'] = $id_exam_review;
		$data['id_exam'] = $id_exam;
		$data['select_exam_review_by_id']= $this->Data_model->select_exam_review_by_id($id_exam_review)->row();
		$this->load->view('adm/update-exam-review', $data);
	}

	public function proses_update_exam_review($id_exam,$id_exam_review)
	{
		$this->load->library('upload');
		$review_name = $this->input->post('review_name');
		$review = $this->input->post('review');


		if (empty($_FILES['review_photo']['name'])) {
			$data = array(
	                  'review_name' => $review_name,
	                  'review' =>$review
	            );
			$update_exam_review = $this->Data_model->update_exam_review($id_exam_review, $data);
		}
		else {

			$review_photo = $_FILES['review_photo']['name'];
	        $config['upload_path'] = './assets/adm/images/review/'; //Folder untuk menyimpan hasil upload
	        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
	        $config['max_size'] = '40000'; //maksimum besar file 4M
	        $config['max_width']  = ''; 
	        $config['max_height']  = '';
	        $config['file_name'] = $review_photo; //nama yang terupload nantinya
	        $this->upload->initialize($config);

	        if ($this->upload->do_upload('review_photo'))
	        {
		        $gbr = $this->upload->data();
				$data = array(
		                  'review_name' => $review_name,
		                  'review' =>$review,
		                  'review_photo' => $gbr['file_name']
	            		);

				$update_exam_review = $this->Data_model->update_exam_review($id_exam_review, $data);
			}
		}


		if($update_exam_review)
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully updated.</div>');
			redirect('adm/exam/exam_review/'.$id_exam);
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to update.</div>');
			redirect('adm/exam/exam_review/'.$id_exam);
		}
	}

	public function delete_exam_review($id_exam, $id_exam_review)
	{
		if($this->Data_model->delete_exam_review($id_exam_review))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/exam/exam_review/'.$id_exam);
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/exam/exam_review/'.$id_exam);
		}
	}

	private function set_upload_options_exam()
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = './assets/adm/images/exam'; //Folder untuk menyimpan hasil upload
	    $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
	    $config['max_size'] = '40000'; //maksimum besar file 4M
	    $config['max_width']  = ''; 
	    $config['max_height']  = '';

	    return $config;
	}

	private function set_upload_options_module()
	{   
	    //upload an image options
	    $config = array();
	    $config['upload_path'] = './assets/adm/images/module'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M
        $config['max_width']  = ''; 
        $config['max_height']  = '';

	    return $config;
	}
}