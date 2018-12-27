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
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/question/0">Question</a></li>
                        <li class="breadcrumb-item active">Add Question</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Update</h4>
                                <form class="m-t-40 form-material" method="post" action="<?php echo base_url(); ?>adm/question/proses_update_question/<?php echo $select_question->id_question; ?>" enctype="multipart/form-data">
                                    <h3 class="card-title">Question</h3>
                                    <hr>
                                    <br>
                                    <br>
                                    <br>
                                    <!-- Question -->
                                    <div class="question">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group m-b-40">
                                                    <input type="text" class="form-control" id="input1" name="question" value="<?php echo $select_question->question;?>" placeholder="Question">
                                                    <span class="bar"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row"> 
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5>File Input Question Image <span class="text-danger">*</span></h5> 
                                                    <div class="controls"> 
                                                        <input type="file" name="question_image" class="form-control"> 
                                                    </div> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="question_option">
                                        <?php
                                            foreach ($select_question_option_get->result() as $row_option) {
                                                # code...
                                        ?>
                                            <div id="delete_question_option<?php echo $row_option->id_question_option;?>">
                                                <div class="row">
                                                    <div class="col-md-6" style="margin-left: 100px;">
                                                        <p class="pull-right text-danger"><a onclick="close_question_option(<?php echo $row_option->id_question_option;?>)"><i class="ti-trash"></i> Delete</a></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12" style="margin-left: 100px;">
                                                        <div class="form-group m-b-40">
                                                            <div class="col-md-6">
                                                                <div class="demo-radio-button">
                                                                    <input name="question_key" type="radio" id="radio_<?php echo $row_option->id_question_option;?>" class="with-gap" value="1"
                                                                    <?php if($row_option->question_key == 1) echo "checked"; ?>
                                                                    />
                                                                    &nbsp;&nbsp;&nbsp;
                                                                    <label for="radio_<?php echo $row_option->id_question_option;?>">
                                                                        <small>* Select if want to set <code>Question Key</code></small>
                                                                    </label>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <!-- <div id="question_key_description_<?php //echo $row_option->id_question_option;?>"></div> -->
                                                                    <h5>Question Option <span class="text-danger">*</span></h5>
                                                                    <div class="controls">
                                                                        <input type="text" name="question_option_<?php echo $row_option->id_question_option;?>" class="form-control" required data-validation-required-message="This field is required" value="<?php echo $row_option->question_option;?>">
                                                                    </div>
                                                                    
                                                                </div>
                                                                <span class="bar"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </div>
                                        <br><br>
                                            <div class="col-md-12" style="margin-left: 100px;">
                                                <div class="form-group m-b-40">
                                                    <div class="col-md-6">
                                                        <div id="input_key_description">
                                                            <h5>Question Key Description<span class="text-danger">*</span></h5>
                                                            <div class="controls">
                                                                <textarea name="question_key_description" id="textarea" class="form-control" required><?php echo $row_option->question_key_description;?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <p style="margin-left: 100px;" class="text-primary">
                                        <a onclick="add_question_option()"><i class="ti-plus"></i> Add Option</a>
                                        </p>
                                        <br><br>
                                        <input type="text" id="count_id_question_option_added" name="count_id_question_option_added" value="">
                                        <input type="text" id="count_id_question_option_removed" name="count_id_question_option_removed" value="">
                                    </div>
                                    <!-- End Question -->
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

    </script>

    <script type="text/javascript">

    var counter_question_option = <?php echo $select_question_option_max->max_option; ?> + 1;
    function add_question_option()
    {
        var id = "count_id_question_option_added";
        var count_id_question_option = document.getElementById(id);

        var data_question = [];
        data_question = JSON.parse("[" + count_id_question_option.value + "]");
        data_question.push(counter_question_option);
        count_id_question_option.value = data_question.toString();
        $(".question_option").append('<div id="delete_question_option'+counter_question_option+'">'+
                                        '<div class="row">'+
                                            '<div class="col-md-6" style="margin-left: 100px;">'+
                                                '<p class="pull-right text-danger"><a onclick="close_question_option_2('+counter_question_option+')"><i class="ti-trash"></i> Delete</a></p>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row">'+
                                            '<div class="col-md-12" style="margin-left: 100px;">'+
                                                '<div class="form-group m-b-40">'+
                                                    '<div class="col-md-6">' +
                                                        '<div class="demo-radio-button">'+
                                                            '<input name="question_key_'+counter_question_option+'" type="radio" id="radio_'+counter_question_option+'" class="with-gap" value="1" />'+
                                                            '&nbsp;&nbsp;&nbsp;'+
                                                            '<label for="radio_'+counter_question_option+'">'+
                                                                '<small>* Select if want to set <code>Question Key</code></small>' +
                                                            '</label>' +
                                                        '</div>'+
                                                        '<div class="col-md-6">' +
                                                            '<h5>Question Option <span class="text-danger">*</span></h5>'+
                                                            '<div class="controls">'+
                                                                '<input type="text" name="question_option_' + counter_question_option +'" class="form-control" required data-validation-required-message="This field is required">'+
                                                            '</div>'+
                                                            
                                                        '</div>'+
                                                        '<span class="bar"></span>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>' +
                                    '</div>');
        counter_question_option++;
    }

    function question_key(question_option) {

        var form_question_key_description = "form_question_key_description";
        if (document.getElementById(form_question_key_description)) {
            document.getElementById(form_question_key_description).remove();
        }

        var newFields = document.getElementById('input_key_description').cloneNode(true);
        newFields.id = 'form_question_key_description';
        newFields.style.display = 'block';
        var newField = newFields.childNodes;
        var insertHere = document.getElementById('question_key_description_'+ question_option);
        insertHere.parentNode.insertBefore(newFields,insertHere);
    }
    function close_question(no)
    {
      $('#delete_question'+no).remove();
    }
    function close_question_option(question_option)
    {
        $('#delete_question_option'+question_option).remove();

        var id = "count_id_question_option_added";
        var count_id_question_option_added = document.getElementById(id);
        var data_question = [];
        data_question = JSON.parse("[" + count_id_question_option_added.value + "]");

        const index = data_question.indexOf(question_option);
          data_question.splice(index, 1);

        count_id_question_option_added.value = data_question.toString();



        var id = "count_id_question_option_removed";
        var count_id_question_option_removed = document.getElementById(id);

        var data_question2 = [];
        data_question = JSON.parse("[" + count_id_question_option_removed.value + "]");
        data_question.push(question_option);
        count_id_question_option_removed.value = data_question.toString();
    }

    function close_question_option_2(question_option)
    {
        $('#delete_question_option'+question_option).remove();

        var id = "count_id_question_option_added";
        var count_id_question_option_added = document.getElementById(id);
        var data_question = [];
        data_question = JSON.parse("[" + count_id_question_option_added.value + "]");

        const index = data_question.indexOf(question_option);
          data_question.splice(index, 1);

        count_id_question_option_added.value = data_question.toString();
    }

    </script>

    
</body>

</html>
