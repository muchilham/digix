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
                    <h3 class="text-themecolor">Account</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                        <li class="breadcrumb-item">exam</li>
                        <li class="breadcrumb-item active">add exam</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Check Question Essay</h4>
                                <div class="table-responsive">
                                    <form action="<?php echo base_url();?>adm/answer/proses_check_answer/<?php echo $id_answer; ?>" method="post">
                                        <table class="table table-bordered">
                                            <tbody>
                                            <?php $no=1; foreach ($select_answer_detail->result() as $row_answer) { ?>
                                            <input type="hidden" name="id_answer_detail[]" value="<?php echo $row_answer->id_answer_detail; ?>">
                                                <tr>
                                                    <td width="30%"><?php echo $row_answer->question; ?></td>
                                                    <td>answer : 
                                                    <b style="font-weight: 600"><?php echo $row_answer->answer_value; ?></b>
                                                    <br>
                                                    <br>
                                                    <div id="correct<?php echo $no; ?>" style="<?php if($row_answer->answer_status == 1) { ?> display: none; <?php } ?>">
                                                    <textarea rows="5" id="textarea" class="form-control" name="answer_correct[]" placeholder=""></textarea>
                                                    </div>
                                                    </td>
                                                    <td class="text-nowrap" width="10%">
                                                        <input type="checkbox" id="basic_checkbox<?php echo $no; ?>" class="filled-in" name="correct[]" value="1" onclick="toggle('correct<?php echo $no; ?>')" <?php if($row_answer->answer_status == 1) { ?> checked <?php } ?>/>
                                                        <label for="basic_checkbox<?php echo $no; ?>">Correct</label><br>
                                                        <small>* Checklist <code>CORRECT</code> if answer is true</small>          
                                                    </td>
                                                </tr>
                                            <?php $no++; } ?>
                                            </tbody>
                                        </table>
                                        <div class="text-xs-right pull-right">
                                            <button type="submit" class="btn btn-info">Finish</button>
                                        </div>
                                    </form>
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
    <script>
        function toggle(id) {
            if (document.getElementById(id).style.display == 'none') {
                document.getElementById(id).style.display = 'block';
            } else {
                document.getElementById(id).style.display = 'none';
            }
        }
    </script>

    
</body>

</html>
