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
    <title>Exam | Digix</title>

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
                    <h3 class="text-themecolor">Exam</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/exam">Exam</a></li>
                        <li class="breadcrumb-item active">Add</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Add</h4>
                            
                                <form class="m-t-40 form-material" method="post" action="<?php echo base_url(); ?>adm/exam/proses_add_exam" enctype="multipart/form-data">
                                    <h3 class="card-title">Exam</h3>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>Name Exam <span class="text-danger">*</span></h5>
                                                <input type="text" class="form-control" id="input1" name="exam_name">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-40">
                                                <h5>Exam Description<span class="text-danger">*</span></h5>
                                                <textarea name="exam_description" id="textarea" class="form-control summernote" placeholder="Description Exam"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-40">
                                                <h5>File Input Exam Image <span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="exam_image" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <h5>File Input Exam Image 2<span class="text-danger">*</span></h5>
                                                <div class="controls">
                                                    <input type="file" name="exam_image2" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="card-title">Module & Submodule</h3>
                                    <hr>
                                    <br>

                                    <!-- Modul -->
                                    <div class="module"></div>
                                    <!-- End Modul -->
                                    <p class="count_question"></p>
                                    <p class="text-primary"><a onclick="add_module()"><i class="ti-plus"></i> Add Module</a></p>
                                    <br>

                                    <h3 class="card-title">Category</h3>
                                    <hr>
                                    <br>

                                    <div class="category"></div>
                                    
                                    <p class="text-primary"><a onclick="add_category()"><i class="ti-plus"></i> Add Category</a></p>
                                    <br>

                                    <div class="text-xs-right pull-right">
                                        <button type="submit" class="btn btn-info">Submit</button>
                                        <a href="<?php echo base_url();?>adm/exam" class="btn btn-inverse">Cancel</a>
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

    var counter_module = 0;
    function add_module()
    {
        $(".module").append('<div id="delete_module'+counter_module+'">'+
                                '<div class="row">'+
                                    '<div class="col-md-6">'+
                                        '<p class="pull-right text-danger"><a onclick="close_module('+counter_module+')"><i class="ti-trash"></i> Delete</a></p>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group">'+
                                            '<h5>Module Name<span class="text-danger">*</span></h5>'+
                                            '<input type="text" class="form-control" id="input1" name="module_name[]" >'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group">'+
                                            '<h5>Module Description<span class="text-danger">*</span></h5>'+
                                            '<div class="controls">'+
                                                '<textarea name="module_description[]" id="textarea" class="form-control" required></textarea>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">' +
                                    '<div class="col-md-6">'+
                                        '<div class="form-group">'+
                                            '<h5>File Input Module Image <span class="text-danger">*</span></h5>' +
                                            '<div class="controls">' +
                                                '<input type="file" name="module_image[]" class="form-control">' +
                                            '</div>' +
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="submodule'+counter_module+'"></div>'+
                                '<p style="margin-left: 100px;" class="text-primary">'+
                                    '<a onclick="add_submodule('+counter_module+')"><i class="ti-plus"></i> Add Submodule</a>'+
                                '</p>'+
                                '<br><br>'+
                                '<input type="hidden" id="count_id_submodule_'+counter_module+'" name="count_id_submodule[]" value="">'+
                            '</div>'
                        );

        var count_module = counter_module++;
        $('.count_module').html('<input type="hidden" name="count_module" class="form-control" value="'+count_module+'">');


        add_submodule(count_module);
    }

    var counter_submodule = 0;
    function add_submodule(module)
    {
        var id = "count_id_submodule_" + module;
        var count_id_submodule = document.getElementById(id);

        var data_module = [];
        data_module = JSON.parse("[" + count_id_submodule.value + "]");
        data_module.push(counter_submodule);
        count_id_submodule.value = data_module.toString();

        $(".submodule"+module).append('<div id="delete_submodule'+counter_submodule+'">'+
                                        '<div class="row">'+
                                            '<div class="col-md-6" style="margin-left: 100px;">'+
                                                '<p class="pull-right text-danger"><a onclick="close_submodule('+module+','+counter_submodule+')")"><i class="ti-trash"></i> Delete</a></p>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row">'+
                                            '<div class="col-md-6" style="margin-left: 100px;">'+
                                                '<div class="form-group">'+
                                                    '<h5>Submodule Name <span class="text-danger">*</span></h5>' +
                                                    '<input type="text" class="form-control" id="input1" name="submodule_name_'+counter_submodule+'">' +
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row">'+
                                            '<div class="col-md-6" style="margin-left: 100px;">'+
                                                '<div class="form-group">'+
                                                    '<h5>Submodule Description <span class="text-danger">*</span></h5>' +
                                                    '<textarea id="textarea" name="submodule_description_'+counter_submodule+'" class="form-control"></textarea>'+
                                                    // '<label for="input1">Description Submodul</label>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>');
        counter_submodule++;
    }

    var counter_category = 1;
    function add_category()
    {
      $(".category").append('<div id="delete_category'+counter_category+'">'+
                                '<div class="row">'+
                                    '<div class="col-md-6">'+
                                        '<p class="pull-right text-danger"><a onclick="close_category('+counter_category +')"><i class="ti-close"></i> Delete</a></p>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="row">'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group m-b-40">'+
                                            '<select class="form-control" name="category[]">'+
                                                '<?php foreach ($select_category->result() as $row_category) { ?>'+
                                                    '<option value="<?php echo $row_category->id_category; ?>"><?php echo $row_category->category_name; ?></option>'+
                                                '<?php } ?>'+
                                            '</select>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                        '</div>');
        counter_category++;
    }


    function close_category(no)
    {
      $('#delete_category'+no).remove();
    }

    function close_module(no)
    {
      $('#delete_module'+no).remove();
    }
    function close_submodule(no)
    {
      $('#delete_submodule'+no).remove();
    }

    function close_submodule(module, submodule)
    {
        $('#delete_submodule'+submodule).remove();

        var id = "count_id_submodule_" + module;
        var count_id_submodule = document.getElementById(id);
        var data_module = [];
        data_module = JSON.parse("[" + count_id_submodule.value + "]");

        const index = data_module.indexOf(submodule);
          data_module.splice(index, 1);

        count_id_submodule.value = data_module.toString();
    }
    </script>

    
</body>

</html>
