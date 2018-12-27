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
    <link href="<?php echo base_url(); ?>assets/adm/css/style.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adm/css/colors/blue.css" id="theme" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/adm/css/treeview.css" id="theme" rel="stylesheet">
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
                    <h3 class="text-themecolor">Detail Exam</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/exam">exam</a></li>
                        <li class="breadcrumb-item active">detail exam</li>
                    </ol>
                </div>
            </div>
           
            <div class="container-fluid">

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Exam</h4><br><br>
                                <div id="notif"><?php echo $this->session->flashdata('notif'); ?></div>
                                <h3 class="card-title"><?php echo $select_exam->exam_name; ?></h3>
                                <h6 class="card-subtitle"><?php echo $select_exam->exam_description; ?></h6>
                                <div>
                                    <img src="<?php echo base_url(); ?>assets/adm/images/exam/<?php echo $select_exam->exam_image; ?>" alt="user" width="50" class="img-circle">
                                </div>
                                <br>
                                <hr>
                                <br>
                                    <ul id="tree2" class="tree">
                                    <?php 
                                        $no_modul = 1;
                                        foreach ($select_modul->result() as $row_modul) 
                                        { 
                                    ?>
                                            <li>
                                                <a href="#" style="font-size: 19px;"><?php echo $no_modul; ?>. <?php echo $row_modul->module_name; ?></a>
                                                <h6 style="margin-left: 23px;">
                                                    Description : <?php echo $row_modul->module_description; ?> 
                                                </h6>
                                                

                                                <ul>
                                                    <?php
                                                        $select_submodul= $this->Data_model->select_submodul_get($id_exam,$row_modul->id_module);
                                                        $no_submodul=1;
                                                        foreach ($select_submodul->result() as $row_submodul) 
                                                        { 
                                                    ?>
                                                            <li>
                                                                <?php echo $no_modul; ?>.<?php echo $no_submodul; ?> <?php echo $row_submodul->module_name;?>
                                                                <h6>Description : <?php echo $row_submodul->module_description; ?>
                                                                    <?php 
                                                                        $count = $this->Data_model->select_exam_question($row_submodul->id_module)->num_rows();

                                                                        if($count > 0)
                                                                        {
                                                                    ?>
                                                                        <a href="<?php echo base_url(); ?>adm/exam/question/<?php echo $row_submodul->id_module; ?>">
                                                                            <button type="button" class="btn btn-outline btn-sm">
                                                                                <i class="ti-pencil-alt"></i>
                                                                            </button>
                                                                        </a> 
                                                                        <?php
                                                                        }
                                                                        else
                                                                        {
                                                                    ?>
                                                                            <a data-toggle="modal" data-target="#type<?php echo $row_submodul->id_module; ?>" href="#">
                                                                                <button type="button" class="btn btn-outline btn-sm">
                                                                                    <i class="ti-pencil-alt"></i>
                                                                                </button>
                                                                            </a> 
                                                                    <?php } ?>
                                                                </h6>
                                                            </li>

                                                            <?php
                                                                if($count < 1)
                                                                {   
                                                            ?>
                                                                    <div id="type<?php echo $row_submodul->id_module; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <h3>choose one for your question type...</h3>
                                                                                    <form action="<?php echo base_url(); ?>adm/exam/question/<?php echo $row_submodul->id_module; ?>" method="post">
                                                                                        <select class="form-control" name="exam_question_type">
                                                                                            <option value="0">Multiple One</option>
                                                                                            <option value="1">Essay</option>
                                                                                        </select>
                                                                                        <br>
                                                                                        <br>
                                                                                        <div class="pull-right">
                                                                                            <button type="submit" class="btn btn-info">Create</button>
                                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                            <?php    
                                                                }
                                                            $no_submodul++; 
                                                        }
                                                    ?>
                                                </ul>
                                            </li>
                                    <?php 
                                        $no_modul++; 
                                        } 
                                    ?>
                                    </ul>

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
    <!-- <script src="<?php echo base_url(); ?>assets/adm/js/treeview.js"></script> -->
   
    
</body>

</html>
