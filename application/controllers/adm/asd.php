public function proses_create_question_pg($type_question, $id_modul)
	{
		$max = $this->Data_model->select_question();
		foreach($max->result() as $key)
		{
			$id_max = $key->id_question;
		}

		$nourut = (int) substr($id_max, 4, 6);
		$nourut++;

		$kode_question = "QUES" .sprintf('%06s', $nourut);
		$id_exam = $this->input->post('id_exam');
		
		
		if($this->input->post('tryout') != 1 )
		{
		    $is_tryout = '0';
		}
		else
		{
		    $is_tryout = $this->input->post('tryout');
		}

		$this->load->library('upload');
        $nmfile = $_FILES['question_image']['name'];
        $config['upload_path'] = './assets/adm/images/question/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M
        $config['max_width']  = ''; 
        $config['max_height']  = '';
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);

        if ($this->upload->do_upload('question_image'))
        {
	        $gbr = $this->upload->data();
			$data = array(
	                  'id_question' =>$kode_question,
	                  'id_module' =>$id_modul,
	                  'question_title' =>$this->input->post('question_title'),
	                  'question_description' =>$this->input->post('question_description'),
	                  'question_image' => $gbr['file_name'],
	                  'question_type' => $type_question,
	                  'is_tryout' => $is_tryout,
	                  'question_number_shows' => $this->input->post('number_shows'),
	                  'question_status' => 1
	            );
			$insert_question = $this->Data_model->insert_question($data);
		}
		else
		{
			$data = array(
	                  'id_question' =>$kode_question,
	                  'id_module' =>$id_modul,
	                  'question_title' =>$this->input->post('question_title'),
	                  'question_description' =>$this->input->post('question_description'),
	                  'question_type' => $type_question,
	                  'is_tryout' => $is_tryout,
	                  'question_number_shows' => $this->input->post('number_shows'),
	                  'question_status' => 1
	            );
			$insert_question = $this->Data_model->insert_question($data);
		}

		$count_question = $this->input->post('count_question');
		$question = $this->input->post('question');
		$option_abjad = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
		
		$no=1;
		for($key_question=0;$key_question<=$count_question;$key_question++) 
		{
			$question_key = $this->input->post('question_key_'.$key_question);
			$question_value= $this->input->post('question_option_'.$key_question);

				for($key_question_detail=0;$key_question_detail < count($question_value);$key_question_detail++)  {
					$data = array(
	                    'id_question' => $kode_question,
	                    'question' => $question[$key_question],
	                    'question_option' => $option_abjad[$key_question_detail],
	                    'question_value' => $question_value[$key_question_detail],
	                    'question_number' => $no,
	                    'question_key' => $question_key[$key_question_detail]

	                );
				$insert_question_detail = $this->Data_model->insert_question_detail($data);
			}
		$no++;
		}


		if($insert_question OR $insert_question_detail)
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully added.</div>');
			redirect('adm/exam/detail_exam/'.$id_exam);
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to add.</div>');
			redirect('adm/exam/detail_exam/'.$id_exam);
		}
	}
	public function proses_create_question_essay($type_question, $id_modul)
	{
		$max = $this->Data_model->select_question();
		foreach($max->result() as $key)
		{
			$id_max = $key->id_question;
		}

		$nourut = (int) substr($id_max, 4, 6);
		$nourut++;

		$kode_question = "QUES" .sprintf('%06s', $nourut);

		$this->load->library('upload');
        $nmfile = $_FILES['question_image']['name'];
        $config['upload_path'] = './assets/adm/images/question/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M
        $config['max_width']  = ''; 
        $config['max_height']  = '';
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);

        if ($this->upload->do_upload('question_image'))
        {
	        $gbr = $this->upload->data();
			$data = array(
	                  'id_question' =>$kode_question,
	                  'id_module' =>$id_modul,
	                  'question_title' =>$this->input->post('question_title'),
	                  'question_description' =>$this->input->post('question_description'),
	                  'question_image' => $gbr['file_name'],
	                  'question_type' => $type_question,
	                  'question_number_shows' => $this->input->post('number_shows')
	            );
			$insert_question = $this->Data_model->insert_question($data);
		}
		else
		{
			$data = array(
	                  'id_question' =>$kode_question,
	                  'id_module' =>$id_modul,
	                  'question_title' =>$this->input->post('question_title'),
	                  'question_description' =>$this->input->post('question_description'),
	                  'question_type' => $type_question,
	                  'question_number_shows' => $this->input->post('number_shows')
	            );
			$insert_question = $this->Data_model->insert_question($data);
		}

		$question = $this->input->post('question');

		for($key_question=0;$key_question< count($question);$key_question++) 
		{
			if($question[$key_question] != NULL)
			{
				$data = array(
	                    'id_question'   => $kode_question,
	                    'question' => $question[$key_question]
	                );
				$insert_question_detail = $this->Data_model->insert_question_detail($data);
			}
		}


		if($insert_question OR $insert_question_detail)
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

	public function proses_update_question_pg($id_question,$id_module)
	{
		$kode_question = $id_question;
		$id_exam = $this->input->post('id_exam');
		
		if($this->input->post('tryout') != 1 )
		{
		    $is_tryout = '0';
		}
		else
		{
		    $is_tryout = $this->input->post('tryout');
		}

		$this->load->library('upload');
        $nmfile = $_FILES['question_image']['name'];
        $config['upload_path'] = './assets/adm/images/question/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M
        $config['max_width']  = ''; 
        $config['max_height']  = '';
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);

        if ($this->upload->do_upload('question_image'))
        {
	        $gbr = $this->upload->data();
			$data = array(
	                  'question_title' =>$this->input->post('question_title'),
	                  'question_description' =>$this->input->post('question_description'),
	                  'question_image' => $gbr['file_name'],
	                  'is_tryout' => $is_tryout,
	                  'question_number_shows' => $this->input->post('number_shows')
	            );
			$update_question = $this->Data_model->update_question($id_question,$data);
		}
		else
		{
			$data = array(
	                  'question_title' =>$this->input->post('question_title'),
	                  'question_description' =>$this->input->post('question_description'),
	                  'is_tryout' => $is_tryout,
	                  'question_number_shows' => $this->input->post('number_shows')
	            );
			$update_question = $this->Data_model->update_question($id_question,$data);;
		}

		$this->Data_model->delete_question_detail($id_question);

		$count_question = $this->input->post('count_question');
		$question = $this->input->post('question');
		$option_abjad = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
		
		$no=1;
		for($key_question=0;$key_question<=$count_question;$key_question++) 
		{

			$question_key = $this->input->post('question_key_'.$key_question);
			$question_value= $this->input->post('question_option_'.$key_question);

				for($key_question_detail=0;$key_question_detail < count($question_value);$key_question_detail++)  {
					$data = array(
	                    'id_question' => $kode_question,
	                    'question' => $question[$key_question],
	                    'question_option' => $option_abjad[$key_question_detail],
	                    'question_value' => $question_value[$key_question_detail],
	                    'question_number' => $no,
	                    'question_key' => $question_key[$key_question_detail]

	                );
				$insert_question_detail = $this->Data_model->insert_question_detail($data);
			}
			$no++;
		}


		if($update_question OR $insert_question_detail)
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> Data successfully changed.</div>');
			redirect('adm/exam/detail_exam/'.$id_exam);
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to change.</div>');
			redirect('adm/exam/detail_exam/'.$id_exam);
		}

	}
	public function proses_update_question_essay($id_question,$id_module)
	{
		$kode_question = $id_question;

		$this->load->library('upload');
        $nmfile = $_FILES['question_image']['name'];
        $config['upload_path'] = './assets/adm/images/question/'; //Folder untuk menyimpan hasil upload
        $config['allowed_types'] = 'gif|jpg|png|jpeg|bmp|mp4|3gp|mp3'; //type yang dapat diakses bisa anda sesuaikan
        $config['max_size'] = '40000'; //maksimum besar file 4M
        $config['max_width']  = ''; 
        $config['max_height']  = '';
        $config['file_name'] = $nmfile; //nama yang terupload nantinya
        $this->upload->initialize($config);

        if ($this->upload->do_upload('question_image'))
        {
	        $gbr = $this->upload->data();
			$data = array(
	                  'question_title' =>$this->input->post('question_title'),
	                  'question_description' =>$this->input->post('question_description'),
	                  'question_image' => $gbr['file_name'],
	                  'question_number_shows' => $this->input->post('number_shows')
	            );
			$update_question = $this->Data_model->update_question($id_question,$data);
		}
		else
		{
			$data = array(
	                  'question_title' =>$this->input->post('question_title'),
	                  'question_description' =>$this->input->post('question_description'),
	                  'question_number_shows' => $this->input->post('number_shows')
	            );
			$update_question = $this->Data_model->update_question($id_question,$data);;
		}

		$this->Data_model->delete_question_detail($id_question);
		$question = $this->input->post('question');

		for($key_question=0;$key_question < count($question);$key_question++) 
		{
			if($question[$key_question] != NULL)
			{
				$data = array(
	                    'id_question'   => $kode_question,
	                    'question' => $question[$key_question]
	                );
				$insert_question_detail = $this->Data_model->insert_question_detail($data);
			}
		}


		if($update_question OR $insert_question_detail)
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
	public function delete_question($id_question,$id_exam)
	{

		$data = array(
                  'question_status' =>0
            );

		if($this->Data_model->delete_question($id_question,$data))
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-success" role="alert"><strong>Success!</strong> data successfully deleted.</div>');
			redirect('adm/exam/detail_exam/'.$id_exam);
		}
		else
		{
			$this->session->set_flashdata('notif', '<div class="alert alert-danger" role="alert"><strong>Failed!</strong> Data failed to delete.</div>');
			redirect('adm/exam/detail_exam/'.$id_exam);
		}
	}