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
                    <h3 class="text-themecolor">Account</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/exam">exam</a></li>
                        <li class="breadcrumb-item active">add exam</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Form Add</h4>
                            
                                <form class="m-t-40 form-material" method="post" action="<?php echo base_url(); ?>adm/exam/proses_update_exam/<?php echo $id_exam; ?>" enctype="multipart/form-data">
                                    <h3 class="card-title">Exam</h3>
                                    <hr>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-3">
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-40">
                                                <input type="text" class="form-control" id="input1" name="exam_name" placeholder="Name Exam" value="<?php echo $select_exam->exam_name; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-40">
                                                <textarea name="exam_description" id="textarea" class="form-control summernote" placeholder="Description Exam"><?php echo $select_exam->exam_description; ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-40">
                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"> 
                                                        <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"><?php echo $select_exam->exam_image; ?></span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-default btn-file"> 
                                                        <span class="fileinput-new">Select file</span> 
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="exam_image" value=""> 
                                                    </span> 
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-6">
                                            <div class="form-group m-b-40">
                                                <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                    <div class="form-control" data-trigger="fileinput"> 
                                                        <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"><?php echo $select_exam->exam_image2; ?></span>
                                                    </div>
                                                    <span class="input-group-addon btn btn-default btn-file"> 
                                                        <span class="fileinput-new">Select file 2</span> 
                                                        <span class="fileinput-exists">Change</span>
                                                        <input type="file" name="exam_image2" value=""> 
                                                    </span> 
                                                    <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <h3 class="card-title">Modul & Submodul</h3>
                                    <hr>
                                    <br>

                                    <!-- Modul -->
                                    <div class="modul">
                                        <?php
                                        $counter_modul = 0;
                                        $counter_submodul = 0;
                                        foreach ($select_modul->result() as $row_modul) { ?>
                                            <div id="delete_modul<?php echo $counter_modul; ?>">
                                            <input type="hidden" class="form-control" id="input" name="id_modul[]" placeholder="Modul" value="<?php echo $row_modul->id_module; ?>">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <p class="pull-right text-danger"><a onclick="delete_modul('<?php echo $row_modul->id_module; ?>','<?php echo $counter_modul; ?>')"><i class="ti-close"></i> Delete</a></p>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group m-b-40">
                                                            <input type="text" class="form-control" id="input1" name="modul[]" placeholder="Modul" value="<?php echo $row_modul->module_name; ?>">
                                                            <span class="bar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group m-b-40">
                                                            <textarea id="textarea" class="form-control" name="modul_description[]" placeholder="Modul Description"><?php echo $row_modul->module_description; ?></textarea>
                                                            <span class="bar"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group m-b-40">
                                                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                                                                <div class="form-control" data-trigger="fileinput"> 
                                                                    <i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"><?php echo $row_modul->module_image; ?></span>
                                                                </div>
                                                                <span class="input-group-addon btn btn-default btn-file"> 
                                                                    <span class="fileinput-new">Select file</span> 
                                                                    <span class="fileinput-exists">Change</span>
                                                                    <input type="file" name="modul_image[]" value=""> 
                                                                </span> 
                                                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Submodul -->
                                                <div class="submodul<?php echo $counter_modul; ?>">
                                                    <?php 
                                                        
                                                        $select_submodul = $this->Data_model->select_submodul_get($id_exam,$row_modul->id_module)->result(); 
                                                        foreach ($select_submodul as $row_submodul) {
                                                    ?>
                                                    
                                                        <div id="delete_submodul<?php echo $counter_submodul; ?>">
                                                            <input type="hidden" class="form-control" id="input" name="id_submodul_<?php echo $counter_modul; ?>[]" placeholder="Modul" value="<?php echo $row_submodul->id_module; ?>">
                                                            <div class="row">
                                                                <div class="col-md-6" style="margin-left: 100px;">
                                                                    <p class="pull-right text-danger"><a onclick="delete_submodul('<?php echo $row_submodul->id_module; ?>','<?php echo $counter_submodul++; ?>')"><i class="ti-close"></i> Delete</a></p>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6" style="margin-left: 100px;">
                                                                    <div class="form-group m-b-40">
                                                                        <input type="text" class="form-control" id="input1" name="submodul_<?php echo $counter_modul; ?>[]" placeholder="Submodul" value="<?php echo $row_submodul->module_name; ?>">
                                                                        <span class="bar"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6" style="margin-left: 100px;">
                                                                    <div class="form-group m-b-40">
                                                                        <textarea id="textarea" name="submodul_description_<?php echo $counter_modul; ?>[]" class="form-control" placeholder="Submodul Description"><?php echo $row_submodul->module_description; ?></textarea>
                                                                        <span class="bar"></span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php  } ?>
                                                </div>
                                                <p style="margin-left: 100px;" class="text-primary"><a onclick="add_submodul('<?php echo $counter_modul; ?>')"><i class="ti-plus"></i> Add Submodul</a></p>
                                                <br><br>
                                            </div>
                                        <?php  
                                        $counter_modul++; 
                                        } 
                                        $counter_submodul++;?>
                                    </div>
                                    <!-- End Modul -->
                                    <p class="count_modul"><input type="hidden" name="count_modul" class="form-control" value="<?php echo $counter_modul-1; ?>"></p>
                                    <p class="text-primary"><a onclick="add_modul()"><i class="ti-plus"></i> Add Modul</a></p>
                                    <br>

                                    <h3 class="card-title">Category</h3>
                                    <hr>
                                    <br>

                                    <div class="category">
                                    <?php
                                    $counter_category = 0; 
                                    foreach ($select_exam_category->result() as $row_exam_category) { ?>
                                        <div id="delete_category<?php echo $counter_category; ?>">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <p class="pull-right text-danger"><a onclick="close_category('+counter_category +')"><i class="ti-close"></i> Delete</a></p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group m-b-40">
                                                        <select class="form-control" name="category[]">
                                                            <?php foreach ($select_category->result() as $row_category) { ?>
                                                                <option value="<?php echo $row_category->id_category; ?>"><?php echo $row_category->category_name; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php $counter_category++; } ?>
                                    </div>
                                    
                                    <p class="text-primary"><a onclick="add_category()"><i class="ti-plus"></i> Add Category</a></p>
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

    var counter_modul = <?php echo $counter_modul; ?>;
    function add_modul()
    {
      $(".modul").append('<div id="delete_modul'+counter_modul+'">'+
                            '<div class="row">'+
                                '<div class="col-md-6">'+
                                    '<p class="pull-right text-danger"><a onclick="close_modul('+counter_modul+')"><i class="ti-close"></i> Delete</a></p>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-md-6">'+
                                    '<div class="form-group m-b-40">'+
                                        '<input type="text" class="form-control" id="input1" name="modul[]" placeholder="Modul">'+
                                        '<span class="bar"></span>'+
                                        // '<label for="input1">Modul</label>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-md-6">'+
                                    '<div class="form-group m-b-40">'+
                                        '<textarea id="textarea" class="form-control" name="modul_description[]" placeholder="Modul Description"></textarea>'+
                                        '<span class="bar"></span>'+
                                        // '<label for="input1">Description Modul</label>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="row">'+
                                '<div class="col-md-6">'+
                                    '<div class="form-group m-b-40">'+
                                        '<div class="fileinput fileinput-new input-group" data-provides="fileinput">'+
                                            '<div class="form-control" data-trigger="fileinput"> '+
                                                '<i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span>'+
                                            '</div>'+
                                            '<span class="input-group-addon btn btn-default btn-file"> '+
                                                '<span class="fileinput-new">Select file</span> '+
                                                '<span class="fileinput-exists">Change</span>'+
                                                '<input type="file" name="modul_image[]"> '+
                                            '</span> '+
                                            '<a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a> '+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                            '<div class="submodul'+counter_modul+'">'+
                                
                            '</div>'+
                            '<p style="margin-left: 100px;" class="text-primary"><a onclick="add_submodul('+counter_modul+')"><i class="ti-plus"></i> Add Submodul</a></p>'+
                        '<br><br></div>');

        var count_modul = counter_modul++;
        $('.count_modul').html('<input type="hidden" name="count_modul" class="form-control" value="'+count_modul+'">');
        // counter_modul++;
    }

    var counter_submodul = <?php echo $counter_submodul++; ?>;
    function add_submodul(submodul)
    {
      $(".submodul"+submodul).append('<div id="delete_submodul'+counter_submodul+'">'+
                                        '<input type="hidden" class="form-control" id="input" name="id_submodul_'+submodul+'[]"placeholder="Modul" value="">'+
                                        '<div class="row">'+
                                            '<div class="col-md-6" style="margin-left: 100px;">'+
                                                '<p class="pull-right text-danger"><a onclick="close_submodul('+counter_submodul+')"><i class="ti-close"></i> Delete</a></p>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row">'+
                                            '<div class="col-md-6" style="margin-left: 100px;">'+
                                                '<div class="form-group m-b-40">'+
                                                    '<input type="text" class="form-control" id="input1" name="submodul_'+submodul+'[]" placeholder="Submodul">'+
                                                    '<span class="bar"></span>'+
                                                    // '<label for="input1">Submodul</label>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="row">'+
                                            '<div class="col-md-6" style="margin-left: 100px;">'+
                                                '<div class="form-group m-b-40">'+
                                                    '<textarea id="textarea" name="submodul_description_'+submodul+'[]" class="form-control" placeholder="Submodul Description"></textarea>'+
                                                    '<span class="bar"></span>'+
                                                    // '<label for="input1">Description Submodul</label>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>');
    counter_submodul++;
    }

    var counter_category = <?php echo $counter_category; ?>;
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

    function close_modul(no)
    {
      $('#delete_modul'+no).remove();
    }
    function close_submodul(no)
    {
      $('#delete_submodul'+no).remove();
    }
    function close_category(no)
    {
      $('#delete_category'+no).remove();
    }

    function delete_modul($id_modul,$no)
    {
        $('#delete_modul'+$no).remove();

        $.ajax({
            url:"<?php echo base_url() ?>adm/exam/delete_modul/"+$id_modul,
            type:"POST",
            dataType:"JSON",
            // data:$('#form-update').serialize(),
            success: function(response)
            {
                response.msg;
            }
        })
    }

    function delete_submodul($id_submodul,$no)
    {
        $('#delete_submodul'+$no).remove();

        $.ajax({
            url:"<?php echo base_url() ?>adm/exam/delete_submodul/"+$id_submodul,
            type:"POST",
            dataType:"JSON",
            // data:$('#form-update').serialize(),
            success: function(response)
            {
                response.msg;
            }
        })
    }

    </script>

    
</body>

</html>
