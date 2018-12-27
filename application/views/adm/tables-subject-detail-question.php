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
    <title>Question Subject Detail | Digix</title>

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
                    <h3 class="text-themecolor">Subject Detail Question</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item">Subject Detail Question</li>
                        <!-- <li class="breadcrumb-item active">admin</li> -->
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Subject Detail Question</h4>
                                <div class="table-responsive m-t-40">
                                <div id="notif"><?php echo $this->session->flashdata('notif'); ?></div>
                                

                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Subject Name</th>
                                                <th>Subject Detail Name</th>
                                                <th>Question Active</th>
                                                <th>Question Inactive</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=1; foreach($select_subject_detail_question->result() as $row_subject_detail_question){ ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row_subject_detail_question->subject_name; ?></td>
                                                <td><?php echo $row_subject_detail_question->subject_detail_name; ?></td>
                                                <td><?php echo $row_subject_detail_question->question_active; ?></td>
                                                <td><?php echo $row_subject_detail_question->question_inactive; ?></td>
                                                <td>
                                                    <a href="<?php echo base_url(); ?>adm/question/detail_subject_detail_question/<?php echo $row_subject_detail_question->id_subject_detail; ?>">
                                                        <button type="button" class="btn btn-default btn-sm" data-toggle="tooltip" title="Detail" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-eye"></i>
                                                        </button> 
                                                    </a> 
                                                    <!-- <a href="<?php echo base_url(); ?>adm/question/add_subject_detail_question/<?php echo $row_subject_detail_question->id_subject_detail; ?>">
                                                        <button type="button" class="btn btn-info btn-sm" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-plus"></i>
                                                        </button>
                                                    </a> -->
                                                    <a href="<?php echo base_url(); ?>adm/question/update_subject_detail_question/<?php echo $row_subject_detail_question->id_subject_detail; ?>">
                                                        <button type="button" class="btn btn-warning btn-sm" aria-haspopup="true" aria-expanded="false">
                                                            <i class="ti-pencil"></i>
                                                        </button>
                                                    </a> 
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete<?php echo $row_subject_detail_question->id_subject_detail; ?>" aria-haspopup="true" aria-expanded="false">
                                                        <i class="ti-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                            <div id="Delete<?php echo $row_subject_detail_question->id_subject_detail; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Delete This Data !</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p style="font-size: 16px">Are you sure want delete this ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url(); ?>adm/question/delete_subject_detail_question/<?php echo $row_subject_detail_question->id_subject_detail; ?>"><button type="submit" class="btn btn-info">Yes</button></a>
                                                            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        </tbody>
                                    </table>
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
    <script src="<?php echo base_url(); ?>assets/adm/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/jquery.slimscroll.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/sidebarmenu.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/adm/js/custom.min.js"></script>
    <!-- This is data table -->
    <script src="<?php echo base_url(); ?>assets/adm/plugins/datatables/jquery.dataTables.min.js"></script>



    <!-- end - This is for export functionality only -->
    <script>
    $(document).ready(function() {
        $('#myTable').DataTable();
    });
   
   setTimeout(function(){ $("#notif").hide(); }, 4000);
    </script>
</body>

</html>
