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
    <title>Question | Digix</title>

    <link href="<?php echo base_url(); ?>assets/adm/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adm/plugins/summernote/dist/summernote.css" rel="stylesheet" />
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
                    <h3 class="text-themecolor">Question</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/exam">exam</a></li>
                        <li class="breadcrumb-item active">add question</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Add</h4>
                                <form class="m-t-40 form-material" method="post" action="<?php echo base_url(); ?>adm/question/proses_create_question_essay/<?php echo $type_question; ?>/<?php echo $id_modul;?>" enctype="multipart/form-data">
                                    <h3 class="card-title">Question</h3>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-40">
                                                <input type="text" class="form-control" id="input1" name="question_title" placeholder="Title Question">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-40">
                                                <textarea name="question_description" id="textarea" class="form-control summernote" placeholder="Description Exam"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-40">
                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"> 
                                                        <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-default btn-file"> 
                                                        <span class="fileinput-new">Select file</span> 
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="question_image"> 
                                                    </span> 
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-40">
                                                <label for="basic_checkbox">Number of Shows</label><br>
                                                <input class="form-control" type="number" value="0" id="example-number-input" name="number_shows">
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>

                                    <!-- Modul -->
                                    <div class="question"></div>
                                    <p class="text-primary"><a onclick="add_question()"><i class="ti-plus"></i> Add Question</a></p>
                                    <br>


                                    <div class="text-xs-right pull-right">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                        <button type="reset" class="btn btn-inverse">Cancel</button>
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
    <script src="<?php echo base_url(); ?>assets/adm/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/sidebarmenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/custom.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/jasny-bootstrap.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/plugins/summernote/dist/summernote.min.js"></script>
    <script>
    jQuery(document).ready(function() {

        $('.summernote').summernote({

            height: 200, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });

        $('.summernote-modul').summernote({
            height: 80, // set editor height
            minHeight: null, // set minimum height of editor
            maxHeight: null, // set maximum height of editor
            focus: false // set focus to editable area after initializing summernote
        });

        $('.inline-editor').summernote({
            airMode: true
        });

    });

    // window.edit = function() {
    //         $(".click2edit").summernote()
    //     },
    //     window.save = function() {
    //         $(".click2edit").summernote('destroy');
    //     }
    </script>

    <script type="text/javascript">

    var counter_question = 0;
    function add_question()
    {
      $(".question").append('<div id="delete_question'+counter_question+'">'+
                            '<div class="row">'+
                                '<div class="col-md-6">'+
                                    '<p class="pull-right text-danger"><a onclick="close_question('+counter_question+')"><i class="ti-close"></i> Delete</a></p>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-md-6">'+
                                    '<div class="form-group m-b-40">'+
                                        '<input type="text" class="form-control" id="input1" name="question[]" placeholder="Question">'+
                                        '<span class="bar"></span>'+
                                        // '<label for="input1">Modul</label>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>');

       counter_question++;
        // $('.count_question').html('<input type="hidden" name="count_question" class="form-control" value="'+count_question+'">');
        // counter_modul++;
    }

    // var counter_question_option = 0;
    // function add_question_option(question)
    // {
    //   $(".question_option"+question).append('<div id="delete_question_option'+counter_question_option+'">'+
    //                                             '<div class="row">'+
    //                                                 '<div class="col-md-6" style="margin-left: 100px;">'+
    //                                                     '<p class="pull-right text-danger"><a onclick="close_question_option('+counter_question_option+')"><i class="ti-close"></i> Delete</a></p>'+
    //                                                 '</div>'+
    //                                             '</div>'+
    //                                             '<div class="row">'+
    //                                                 '<div class="col-md-6" style="margin-left: 100px;">'+
    //                                                     '<div class="form-group m-b-40">'+
    //                                                         '<div class="demo-radio-button">'+
    //                                                             '<input name="question_key_'+question+'[]" type="radio" id="radio_'+counter_question_option+'" class="with-gap" value="1" />'+
    //                                                             '&nbsp;&nbsp;&nbsp;<label for="radio_'+counter_question_option+'"><input type="text" class="form-control" id="input1" name="question_option_'+question+'[]" placeholder="option"></label>'+
    //                                                         '</div>'+
    //                                                         '<span class="bar"></span>'+
    //                                                     '</div>'+
    //                                                 '</div>'+
    //                                             '</div>'+
    //                                         '</div>');
    // counter_question_option++;
    // }


    function close_question(no)
    {
      $('#delete_question'+no).remove();
    }
    function close_question_option(no)
    {
      $('#delete_question_option'+no).remove();
    }

    </script>

    
</body>

</html>
