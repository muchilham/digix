<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="../assets/images/favicon.png">
    <title>Question Group | Digix</title>

    <link href="<?php echo base_url(); ?>assets/adm/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adm/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adm/css/colors/blue.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.7/css/select.dataTables.min.css">
    <link href="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/css/dataTables.checkboxes.css" id="theme" rel="stylesheet">
</head>

<body class="fix-header card-no-border">
    <div class="preloader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" /> </svg>
    </div>
    
    <div id="main-wrapper">
       <?php include "header.php"; ?>
        <div class="page-wrapper">
           
            <div class="row page-titles">
                <div class="col-md-5 align-self-center">
                    <h3 class="text-themecolor">Question Group</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>adm/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>adm/question/group">Question Group</a></li>
                        <li class="breadcrumb-item active">Update Question Group</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Update</h4>
                            
                                <form class="m-t-40" novalidate action="<?php echo base_url(); ?>adm/question/proses_update_question_group/<?php echo $id_question_group; ?>" enctype="multipart/form-data" id="frm-example" method="POST">
                                    <div class="form-group">
                                        <h5>Question Group <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="question_group" class="form-control" required data-validation-required-message="This field is required" value="<?php echo $select_question_group->question_group; ?>"> </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Question Group Description<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="question_group_description" id="textarea" class="form-control" required><?php echo $select_question_group->question_group_description; ?></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>File Input Question Group Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="question_group_image" class="form-control"> </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="table-responsive m-t-40">
                                            <table id="myTable" class="table table-bordered table-striped">
                                              <thead>
                                                  <tr>
                                                      <th></th>
                                                      <th>#</th>
                                                      <th>Question</th>
                                                      <th>Question Image</th>
                                                      <th>Question Type</th>
                                                      <th>Question Created</th>
                                                      <th>Action</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                              <?php $no=1; foreach($select_question_get_by_question_group->result() as $row_question){ ?>
                                                  <tr>
                                                      <td>
                                                        <input type="checkbox" onchange="checked_question(this,<?php echo $row_question->id_question; ?>);"
                                                          <?php if($id_question_group == $row_question->id_question_group) 
                                                          { echo "checked"; } 
                                                          else echo ""; ?> 
                                                        >
                                                      <td><?php echo $no++; ?></td>
                                                      <td><?php echo $row_question->question; ?></td>
                                                      <td><img src="<?php echo base_url(); ?>assets/adm/images/question_group/<?php echo $row_question->question_image; ?>" alt="question" width="120" class="img-rounded"></td>
                                                      <td>
                                                        <?php 
                                                          if($row_question->question_type == "0"){ echo "Multiple Choice"; }
                                                          else { echo "Essay"; } 
                                                        ?>
                                                      </td>
                                                      <td><?php echo $row_question->question_created; ?></td>
                                                      <td>
                                                          <!-- <a href="<?php echo base_url(); ?>adm/question/update_question/<?php echo $row_question->id_question; ?>">
                                                              <button type="button" class="btn btn-warning btn-sm" aria-haspopup="true" aria-expanded="false">
                                                                  <i class="ti-pencil"></i>
                                                              </button>
                                                          </a>  -->
                                                          <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete<?php echo $row_question->id_question; ?>" aria-haspopup="true" aria-expanded="false">
                                                              <i class="ti-trash"></i>
                                                          </button>
                                                      </td>
                                                  </tr>

                                                  <div id="Delete<?php echo $row_question->id_question; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                      <div class="modal-dialog">
                                                          <div class="modal-content">
                                                              <div class="modal-header">
                                                                  <h5 class="modal-title" id="myModalLabel">Delete This Data !</h5>
                                                              </div>
                                                              <div class="modal-body">
                                                                  <p style="font-size: 16px">Are you sure want delete this ?</p>
                                                              </div>
                                                              <div class="modal-footer">
                                                                  <a href="<?php echo base_url(); ?>adm/question/delete_question/<?php echo $row_question->id_question; ?>"><button type="submit" class="btn btn-info">Yes</button></a>
                                                                  <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                              </div>
                                                          </div>
                                                      </div>
                                                  </div>
                                              <?php } ?>
                                              </tbody>
                                          </table>
                                        </div>
                                        <div>
                                          <input type="hidden" name="id_question1" value="<?php $replace = ['[', ']']; $torplace = ['', '']; echo str_replace($replace,$torplace,$select_question_get_by_question_group_checked);?>" id="id_question1">
                                          <input type="hidden" name="id_question2" value="" id="id_question2">
                                        </div>
                                    </div>
                                    <div class="text-xs-right pull-right">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                        <a href="<?php echo base_url();?>adm/question/group" class="btn btn-inverse">Cancel</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            
            <?php include "footer.php"; ?>            
        </div>
        
    </div>
   
    <script src="<?php echo base_url(); ?>assets/adm/plugins/jquery/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/sidebarmenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/validation.js"></script>
    <!-- This is data table -->
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"> </script> -->
    <script src="https://gyrocode.github.io/jquery-datatables-checkboxes/1.2.11/js/dataTables.checkboxes.min.js"></script>
    <!-- <script>
    ! function(window, document, $) {
        "use strict";
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(), $(".skin-square input").iCheck({
            checkboxClass: "icheckbox_square-green",
            radioClass: "iradio_square-green"
        }), $(".touchspin").TouchSpin(), $(".switchBootstrap").bootstrapSwitch();
    }(window, document, jQuery);
    </script> -->

    <script type="text/javascript">
      $(document).ready(function() {
        $('#myTable').DataTable();
      });
      
      var data_question = JSON.parse('<?php echo $select_question_get_by_question_group_checked; ?>');
      document.getElementById("id_question2").value = data_question.toString();

      function checked_question(checkbox,value) {
        // console.log(checkbox);
        var findId = data_question.indexOf(value);
        if (checkbox.checked) {
          if(findId == -1)
          {
            data_question.push(value);
          }
        } else {
            remove(data_question, value);
        }

        console.log(data_question);
        document.getElementById("id_question2").value = data_question.toString();
      }

      function remove(array, element) {
          const index = array.indexOf(element);
          array.splice(index, 1);
      }
    </script>
    
</body>

</html>
