<br>
<br>
<br>
<br>
    <div class="row">
        <div class="container">
            <div id="notif"><?php echo $this->session->flashdata('notif'); ?></div>
            <table id="myTable" class="cards table">
                <thead>
                    <tr>
                        <th>Exam Image</th>
                        <th>ID Answer</th>
                        <th>Exam Name</th>
                        <th>Module Name</th>
                        <th>Answer Score</th>
                        <th>Answer Created</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no=1; foreach($select_testimoni_get_by_user->result() as $row_testimoni){ ?>
                    <tr class="card-panel">
                        <td><img src="<?php echo base_url(); ?>assets/adm/images/exam/<?php echo $row_testimoni->exam_image; ?>" alt="user" width="120" class="img-rounded"></td>
                        <td><b><?php echo $row_testimoni->id_answer; ?></b></td>
                        <td><b>Ujian: <?php echo $row_testimoni->exam_name; ?></b></td>
                        <td><b>Modul: <?php echo $row_testimoni->module_name; ?></b></td>
                        <td><b>Nilai: <?php echo $row_testimoni->answer_score; ?></b></td>
                        <td><b>Waktu: <?php echo $row_testimoni->answer_created; ?></b></td>
                        <td>
                        <?php 
                            $check = $this->Data_model->select_testimoni_count($this->session->id_user, $row_testimoni->id_exam)->num_rows() == NULL ? 0 :
                            $this->Data_model->select_testimoni_count($this->session->id_user, $row_testimoni->id_exam)->num_rows();

                                if ($check < 1) 
                                {
                        ?>
                                    <a class="modal-trigger" href="#review-modal-<?php echo $row_testimoni->id_exam;?>">
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="tooltip" title="Edit" aria-haspopup="true" aria-expanded="false"> <i class="ti-pencil"></i>Review
                                        </button>
                                    </a>
                        <?php   } ?>
                        </td>
                    </tr>

                    <div id="review-modal-<?php echo $row_testimoni->id_exam;?>" class="modal">
                        <div class="modal-content">
                            <h4>Review</h4>
                            <form id="review-modal" class="col s12" action="<?php echo base_url();?>testimoni/proses_add_testimoni/<?php echo $row_testimoni->id_exam;?> " method="POST">
                                <div class="row">
                                    <div class="input-field col s6">
                                        <input id="testimoni" name="testimoni" type="text">
                                        <label for="testimoni">Testimoni</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <button class="waves-effect waves-light btn blue darken-3" type="submit" name="action">Submit
                                            <i class="material-icons right">send</i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>