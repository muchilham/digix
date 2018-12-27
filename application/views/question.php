
<div id="tabs">
      <div class="header-soal">
        <h2><?php echo $select_module->module_name;?></h2>
        <p>
          <?php 
            echo $select_module->module_description; 
            $count = $this->Data_model->select_total_question_exam($select_module->id_module)->row()->total_question;
          ?>
        </p>
      </div>
      <div class="banner-soal">
        <h2><?php echo $select_module->module_name; ?></h2>
      </div>
      <!-- <div class="navigasi-soal">
        <div class="center-soal">
          <button style="padding-top: 0" class="btn arrow_btn cyan darken-2 open-captcha" data-page="2" onclick="incrementValue(1,<?php //echo ceil($count/10); ?>)">NEXT  <i class="fa fa-angle-double-right"></i></button>
          <input type="number" id="number" value="1" style="background-color: white; color: rgba(0,0,0,0.42); border: none;" name="page" min="1" max="<?php //echo ceil($count/10); ?>">
          <span class="extra_page_info"> (Halaman 1 dari <?php //echo ceil($count/10); ?>) </span>
        </div>
      </div> -->

    <main>
      <form class="opsi-pilihan-ganda" id="pg-form" method="POST" action="">
        <input type="hidden" name="id_module" value="<?php echo $select_module->id_module."|".$count;?>">
        <?php
          $select_exam_question = $this->Data_model->select_exam_question($select_module->id_module);
          $start =  0;
          $total_question = 0;
          $no = 1;  
          foreach ($select_exam_question->result() as $key) 
          {
            # code...
            $total_question = $total_question + $key->total_question;
            $no = $no;
            $y = 0;
            for ($i=$start; $i < ceil($total_question/10); $i++) 
            {
        ?>
              <h3><?php //echo $i; ?></h3>
              <section>
                <div class="soal-pilihan-ganda" id="tabs-<?php echo $i;?>">
                  <?php
                    $question = $this->Data_model->select_question_by_id_subject_detail($key->id_subject_detail,$key->exam_question_type,10,$y == 0 ? 0 : ceil($y * 10));
                    foreach ($question->result() as $row_question)
                    { 
                  ?>
                      <div class="input_wrapper">
                        <div class="unit">
                        <?php 
                          if($row_question->id_question_group != NULL)
                          {
                              $question_group = $this->Data_model->select_question_group_get_by($row_question->id_question_group)->row();
                        ?>

                          <small><?php echo $question_group->question_group_description;?></small>

                        </div>
                        <br><br><br>
                          <p>
                            <h4><?php echo $question_group->question_group;?></h4>
                          </p>

                        <?php  
                          }
                        ?>
                      </div>
                      <div class="input_wrapper">
                        <div class="unit"><?php echo $no; ?>
                          <input type="hidden" name="id_question_<?php echo $no; ?>" value="<?php echo $row_question->id_question; ?>" style="border:none; width: 20px;">
                        </div>
                          <p><?php echo $row_question->question; ?></p>
                      <?php 
                          $select_question_option = $this->Data_model->select_question_option_get($row_question->id_question);
                           foreach ($select_question_option->result() as $row_question_option)
                          { 
                      ?>    
                            <p>
                              <!-- <label> -->
                                <input type="radio" name="pilihan-ganda-<?php echo $no;?>" 
                                value="<?php echo $row_question_option->question_option."|".$row_question_option->question_value."|".$row_question_option->question_key;?>" id="<?php echo $row_question_option->question_option."|".$row_question_option->question_value."|".$row_question_option->question_key."|".$row_question->id_question;?>">
                                <span><?php echo strtoupper($row_question_option->question_option).". ". $row_question_option->question_value; ?></span>
                              <!-- </label> -->
                            </p>
                      <?php 
                          } 

                          if ($select_module->is_tryout != 1)
                          {  
                      ?>
                            <a href="#answer-number-<?php echo $row_question->id_question; ?>" class="waves-effect waves-light btn btn modal-trigger show_answer">
                              <i class="material-icons right">question_answer</i>Lihat Jawaban
                            </a>
                      <?php 
                          } 
                        $question_key = $this->Data_model->select_question_option_get_key($row_question->id_question)->row();
                      ?>
                          <div id="answer-number-<?php echo $row_question->id_question; ?>" class="modal">
                            <div class="modal-content">
                              <h4>JAWABAN</h4>
                              <hr>

                              <h6>
                                <?php 
                                   echo $no.". ".$row_question->question; 
                                ?>
                              </h6>
                              <h6 style="margin-left:19px;">Jawaban:
                                <span style="font-style: italic; font-weight: 800;">
                                  <?php 
                                     echo $question_key->question_option.". ".$question_key->question_value; 
                                  ?>
                                </span>
                              </h6>
                              <h6 style="margin-left:19px;">Penjelasan:</h6>
                              <p style="margin-left:19px;" class="card-panel grey lighten-4">
                                  <span style="font-style: italic; font-weight: 800;">
                                    <?php 
                                      echo $question_key->question_key_description; 
                                    ?>
                                  </span>
                              </p>
                            </div>
                          </div>
                      </div>
                  <?php $no++;
                    } 
                  ?>
                </div>
              </section>
        <?php 
              $y++;
            }
            $start = ceil($total_question/10);
          }
        ?>
          
      </form>
    </main>
    <!-- <div class="navigasi-soal">
      <div class="center-soal">
        <button style="padding-top: 0" class="btn arrow_btn cyan darken-2 open-captcha" data-page="2" onclick="incrementValue(1,<?php //echo ceil($count/10); ?>)">NEXT  <i class="fa fa-angle-double-right"></i></button>
          <input type="number" id="number2" value="1" style="background-color: white; color: rgba(0,0,0,0.42); border: none;" name="page" min="1" max="<?php //echo ceil($count/10); ?>">
          <span class="extra_page_info"> (Halaman 1 dari <?php echo ceil($count/10); ?>) </span>
      </div>
    </div>
  </div> -->

  <div id="modal-finish" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Your Score:</h4>
      <p id="score"></p>
    </div>
    <div class="modal-footer">
      <a href="<?php echo base_url();?>" class="modal-action modal-close waves-effect waves-green btn-flat">Finish</a>
    </div>
  </div>

  <div id="modal-essay-finish" class="modal modal-fixed-footer">
    <div class="modal-content">
      <h4>Great!</h4>
      <p>Wait, Admin will check your Answer!</p>
    </div>
    <div class="modal-footer">
      <a href="<?php echo base_url();?>" class="modal-action modal-close waves-effect waves-green btn-flat">Finish</a>
    </div>
  </div>
