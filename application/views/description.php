
    <header>
      <div class="row title">
        <div class="col m8">
          <h1><?php echo $select_exam->exam_name; ?></h1>
          <?php echo $select_exam->exam_description; ?>
        </div>
        <div class="col m4">
          <img width="100%" alt="<?php echo $select_exam->exam_name; ?>" class="activator" src="<?php echo base_url(); ?>assets/adm/images/exam/<?php echo $select_exam->exam_image; ?>">
        </div>
      </div>
      <div id="sub-menu" class="row center">
        <ul>
          <li><a href=#deskripsi>Deskripsi</a></li>
          <li><a href=#modul>Materi</a></li>
          <li><a href=#rating>Testimoni</a></li>
          <li><a href=#mentoring>Mentoring</a></li>
        </ul>
      </div>
      <div class="cat-image">
      </div>
    </header>
    <main>
      <div id="deskripsi">
        <h3>Deskripsi</h3>
        <?php echo $select_exam->exam_description; ?>
      </div>
      <div id="modul">
		
		  <?php 
  		  $no_modul = 1;
  		  foreach ($select_modul->result() as $row_modul) 
        { 
      ?>
    			<div class="row deskripsi-modul">
    			  <div class="col m6">
      				<h4><?php echo $no_modul; ?>. <?php echo $row_modul->module_name; ?></h4>
              <p><?php echo $row_modul->module_description; ?></p>
    			  </div>
    			  <div class="col m6">
    				  <img alt="Exam" src="<?php echo base_url(); ?>assets/adm/images/exam/<?php echo $select_exam->exam_image; ?>">
    			  </div>
    			</div>
  			<div class="row pilihan-exam">
  			  <ul>
			  <?php
  			  $no_submodul = 1;
  			  $select_submodul= $this->Data_model->select_submodul_get($select_exam->id_exam,$row_modul->id_module);
  				foreach ($select_submodul->result() as $row_submodul) 
          { 
            if($this->session->userdata('logged_in')!=true)
            {
         ?>
             <li>
                <a class="row modal-trigger" href="#login-modal">
                  <span>
                    <div class="nomor-exam"><?php echo $no_modul; ?>.<?php echo $no_submodul; ?></div>
                  </span>
                  <span class="deskripsi-exam"><?php echo $row_submodul->module_name;?></span>
                </a>
              </li>
          <?php   
            }
            else
            {
          ?>
              <li>
                <a class="row modal-trigger" href="#submodul-modal-<?php echo $row_submodul->id_module;?>">
                  <span>
                    <div class="nomor-exam"><?php echo $no_modul; ?>.<?php echo $no_submodul; ?></div>
                  </span>
                  <span class="deskripsi-exam"><?php echo $row_submodul->module_name;?></span>
                </a>
              </li>
              <div id="submodul-modal-<?php echo $row_submodul->id_module; ?>" class="modal">
                <div class="modal-content">
                  <h4>Apa kamu sudah siap?</h4>
                  <div class="row">
                      <div class="input-field col s12">
                        <a class="waves-effect waves-light btn blue darken-3" href="<?php echo base_url();?>question/index/<?php echo $row_submodul->id_module; ?>">
                          Ya
                            <i class="material-icons right">send</i>
                        </a>
                        <button class="waves-effect waves-light btn">Tidak</button>
                      </div>
                  </div>
                </div>
              </div>
          <?php
            }
          ?>
  			  <?php $no_submodul++; }?>
  			  </ul>
  			</div>
      <?php $no_modul++; } ?>
      </div>
      <div id="rating">
        <div class="testimoni">
          <div class="row">
            <h3>Testimoni</h3>
            <?php 
            if($select_testimoni->row() > 0) {
              foreach ($select_testimoni->result() as $row_testimoni) { ?>
              <div class="row">
                <div class="col s2">
                  <img alt="<?php echo $row_testimoni->review_name; ?>" src="<?php echo base_url(); ?>assets/adm/images/review/<?php echo $row_testimoni->review_photo; ?>" class="circle responsive-img">
                </div>
                <div class="col m10">
                  <h4>"<?php echo $row_testimoni->review; ?>"</h4>
                  <h4>--<?php echo $row_testimoni->review_name; ?></h4>
                </div>
              </div>
            <?php } 
            } 
            else {
            ?>
              <div class="row">
                <div class="col m12">
                  <center><h3>-</h3></center>
                </div>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </main>

    <div class="rekomendasi">
      <div class="row center">
          <h5>Anda Mungkin Tertarik untuk Mencoba : </h5>
      </div>
      <div class="row">
          <div class="container">
              <div class="col s6 m3">
                  <div class="card small">
                      <div class="card-image waves-effect waves-block waves-light">
                          <img alt="SBMPTN" class="card-image" src="<?php echo base_url(); ?>assets/img/compressed-cole-keister-291568.jpg">
                      </div>
                      <div class="card-content">
                  <span class="card-title activator grey-text text-darken-4">
                      SBMPTN
                  </span>
                  <div class="card-desc">
                    <p>Seleksi masuk untuk perguruan tinggi negeri</p>
                  </div>
                      </div>
                  </div>
              </div>

              <div class="col s6 m3">
                  <div class="card small">
                      <div class="card-image waves-effect waves-block waves-light">
                          <img alt="CPNS" class="activator" src="<?php echo base_url(); ?>assets/img/compressed-alvin-mahmudov-181255.jpg">
                      </div>
                      <div class="card-content">
                        <span class="card-title activator grey-text text-darken-4">CPNS</span>
                        <div class="card-desc">
                          <p>Seleksi calon pegawai negeri sipil</p>
                        </div>
                      </div>
                  </div>
              </div>

              <div class="col s6 m3">
                  <div class="card small">
                      <div class="card-image waves-effect waves-block waves-light">
                          <img alt="TOEFL" class="activator" src="<?php echo base_url(); ?>assets/img/compressed-romain-vignes-53940.jpg">
                      </div>
                      <div class="card-content">
                  <span class="card-title activator grey-text text-darken-4">TOEFL</span>
                    <div class="card-desc">
                      <p>Uji kecakapan Bahasa Inggris</p>
                    </div>

                      </div>
                  </div>
              </div>

              <div class="col s6 m3">
                  <div class="card small">
                      <div class="card-image waves-effect waves-block waves-light">
                          <img alt="" class="activator" src="<?php echo base_url(); ?>assets/img/compressed-ramiro-mendes-371663.jpg">
                      </div>
                      <div class="card-content">
                  <span class="card-title activator grey-text text-darken-4">STAN</span>
                    <div class="card-desc">
                      <p>Seleksi masuk sekolah kedinasan Sekolah Tinggi Akuntansi Negara</p>
                    </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
