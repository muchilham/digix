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
                                <h4 class="card-title">Form Add</h4>
                                <form class="m-t-40 form-material" method="post" action="<?php echo base_url(); ?>adm/question/proses_add_question/<?php echo $question_type; ?>" enctype="multipart/form-data">
                                    <h3 class="card-title">Question</h3>
                                    <hr>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-check m-b-40">
                                              <input type="checkbox" id="checkbox_question_group">
                                              <small>* Checklist <code>Question Group</code> if want to create question group</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" >
                                        <div class="col-md-3">
                                            
                                        </div>
                                        <!-- Question Group -->
                                        <div class="col-md-6" id="question_group"></div>
                                        <!-- End Question Group -->
                                    </div>
                                    <br><br>
                                    <!-- Question -->
                                    <div class="question"></div>
                                    <!-- End Question -->
                                    <p class="count_question"></p>
                                    <p class="text-primary"><a onclick="add_question()"><i class="ti-plus"></i> Add Question</a></p>
                                    <br>


                                    <div class="text-xs-right pull-right">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                        <button type="reset" class="btn btn-inverse">Cancel</button>
                                    </div>
                                </form>

                                <div id="input_key_description" style="display: none">
                                    <h5>Question Key Description<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="question_key_description[]" id="textarea" class="form-control" required></textarea>
                                    </div>
                                </div>

                                <div class="input_group" id="input_group" style="display: none;">
                                    <div class="form-group">
                                        <h5>Question Group <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="text" name="question_group" class="form-control" required data-validation-required-message="This field is required"> </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>Question Group Description<span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <textarea name="question_group_description" id="textarea" class="form-control" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <h5>File Input Question Group Image <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input type="file" name="question_group_image" class="form-control">
                                        </div>
                                    </div>
                                </div>
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

    var checkbox = document.getElementById('checkbox_question_group');
    checkbox.addEventListener('click', function () {
        if (document.getElementById('form_group')) {
            document.getElementById('form_group').remove();
        } else {
            var newFields = document.getElementById('input_group').cloneNode(true);
            newFields.id = 'form_group';
            newFields.style.display = 'block';
            var newField = newFields.childNodes;
            var insertHere = document.getElementById('question_group');
            insertHere.parentNode.insertBefore(newFields,insertHere);
        }
    });

    
    var counter_question = 0;
    function add_question()
    {
      $(".question").append('<div id="delete_question'+counter_question+'">'+
                                '<div class="row">'+
                                    '<div class="col-md-6">'+
                                        '<p class="pull-right text-danger"><a onclick="close_question('+counter_question+')"><i class="ti-trash"></i> Delete</a></p>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group m-b-40">'+
                                            '<input type="text" class="form-control" id="input1" name="question[]" placeholder="Question">'+
                                            '<span class="bar"></span>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">' +
                                    '<div class="col-md-6">'+
                                        '<div class="form-group">'+
                                            '<h5>File Input Question Image <span class="text-danger">*</span></h5>' +
                                            '<div class="controls">' +
                                                '<input type="file" name="question_image[]" class="form-control">' +
                                            '</div>' +
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="question_option'+counter_question+'"></div>'+
                                '<p style="margin-left: 100px;" class="text-primary">'+
                                    '<a onclick="add_question_option('+counter_question+')"><i class="ti-plus"></i> Add Option</a>'+
                                '</p>'+
                                '<br><br>'+
                                '<input type="hidden" id="count_id_question_option_'+counter_question+'" name="count_id_question_option[]" value="">'+
                            '</div>'
                        );

        var count_question = counter_question++;
        $('.count_question').html('<input type="hidden" name="count_question" class="form-control" value="'+count_question+'">');
        // counter_modul++;
        add_question_option(count_question);
        add_question_option(count_question);
        add_question_option(count_question);
        add_question_option(count_question);
    }

    var counter_question_option = 0;
    function add_question_option(question)
    {
        var id = "count_id_question_option_" + question;
        var count_id_question_option = document.getElementById(id);

        var data_question = [];
        data_question = JSON.parse("[" + count_id_question_option.value + "]");
        data_question.push(counter_question_option);
        count_id_question_option.value = data_question.toString();
        $(".question_option"+question).append('<div id="delete_question_option'+counter_question_option+'">'+
                                                '<div class="row">'+
                                                    '<div class="col-md-6" style="margin-left: 100px;">'+
                                                        '<p class="pull-right text-danger"><a onclick="close_question_option('+question+','+counter_question_option+')"><i class="ti-trash"></i> Delete</a></p>'+
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="row">'+
                                                    '<div class="col-md-12" style="margin-left: 100px;">'+
                                                        '<div class="form-group m-b-40">'+
                                                            '<div class="col-md-6">' +
                                                                '<div class="demo-radio-button">'+
                                                                    '<input name="question_key_' + question +'" type="radio" id="radio_'+counter_question_option+'" class="with-gap" value="'+counter_question_option+'" onchange="question_key('+question+','+counter_question_option+')" />'+
                                                                    '&nbsp;&nbsp;&nbsp;'+
                                                                    '<label for="radio_'+counter_question_option+'">'+
                                                                        '<small>* Select if want to set <code>Question Key</code></small>' +
                                                                    '</label>' +
                                                                '</div>'+
                                                                '<div class="col-md-6">' +
                                                                    '<div id="question_key_description_' + counter_question_option +'"></div>' +
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

    function question_key(question,question_option) {

        var form_question_key_description = "form_question_key_description_" + question;
        if (document.getElementById(form_question_key_description)) {
            document.getElementById(form_question_key_description).remove();
        }

        var newFields = document.getElementById('input_key_description').cloneNode(true);
        newFields.id = 'form_question_key_description_' + question;
        newFields.style.display = 'block';
        var newField = newFields.childNodes;
        var insertHere = document.getElementById('question_key_description_'+ question_option);
        insertHere.parentNode.insertBefore(newFields,insertHere);
    }
    function close_question(no)
    {
      $('#delete_question'+no).remove();
    }
    function close_question_option(question, question_option)
    {
        $('#delete_question_option'+question_option).remove();

        var id = "count_id_question_option_" + question;
        var count_id_question_option = document.getElementById(id);
        var data_question = [];
        data_question = JSON.parse("[" + count_id_question_option.value + "]");

        const index = data_question.indexOf(question_option);
          data_question.splice(index, 1);

        count_id_question_option.value = data_question.toString();
    }

    </script>

    
</body>

</html>
