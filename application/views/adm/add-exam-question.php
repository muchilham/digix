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
    <title>Exam Question | Digix</title>

    <link href="<?php echo base_url(); ?>assets/adm/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adm/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adm/css/colors/blue.css" id="theme" rel="stylesheet">
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
                    <h3 class="text-themecolor">Exam Question</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>adm/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>adm/exam">Exam</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>adm/exam/question/<?php echo $id_module;?>">Exam Question</a></li>
                        <li class="breadcrumb-item active">Add Exam Question</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Add</h4>
                            
                                <form class="m-t-40" novalidate method="post" action="<?php echo base_url(); ?>adm/exam/proses_add_exam_question/<?php echo $id_module."/".$exam_question_type;?>">
                                    <div class="form-group">
                                        <h5>Subject<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <select class="form-control" name="id_subject_detail">
                                                <?php foreach ($select_subject_detail->result() as $row_subject_detail) { ?>
                                                    <option value="<?php echo $row_subject_detail->id_subject_detail; ?>">
                                                        <?php echo $row_subject_detail->subject_detail_name; ?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Total Question<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="number" min="1" name="total_question" class="form-control" required data-validation-required-message="This field is required"> </div>
                                            <small>* Number for set  <code>Total Question</code> want to display.</small>
                                    </div>
                                    <!-- <div class="form-group">
                                        <h5>Is Random?<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="checkbox" id="checkbox_question_group" name="is_random">
                                            <small>* Checklist <code>Is Random</code> if want set to random question.</small>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <h5>Is Tryout?<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="checkbox" id="checkbox_question_group" name="is_tryout" value="1">
                                            <small>* Checklist <code>Is Tryout</code> if want set to tryout exam.</small>
                                        </div>
                                            
                                    </div>
                                    <div class="text-xs-right">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                        <a href="<?php echo base_url();?>adm/exam/question/<?php echo $id_module;?>" class="btn btn-inverse">Cancel</a>
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
    <script>
    ! function(window, document, $) {
        "use strict";
        $("input,select,textarea").not("[type=submit]").jqBootstrapValidation(), $(".skin-square input").iCheck({
            checkboxClass: "icheckbox_square-green",
            radioClass: "iradio_square-green"
        }), $(".touchspin").TouchSpin(), $(".switchBootstrap").bootstrapSwitch();
    }(window, document, jQuery);
    </script>
    
</body>

</html>
