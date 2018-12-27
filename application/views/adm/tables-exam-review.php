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
    <title>Exam Review | Digix</title>

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
                    <h3 class="text-themecolor">Exam Review</h3>
                </div>
                <div class="col-md-7 align-self-center">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/dashboard">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="<?php echo base_url(); ?>adm/exam">Exam</a></li>
                        <li class="breadcrumb-item">Exam Review</li>
                        <!-- <li class="breadcrumb-item active">admin</li> -->
                    </ol>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Exam Review Table</h4>
                                <div class="table-responsive m-t-40">
                                <div id="notif"><?php echo $this->session->flashdata('notif'); ?></div>
                                <a href="<?php echo base_url(); ?>adm/exam/add_exam_review/<?php echo $id_exam;?>"><button type="button" class="btn btn-info btn-sm" aria-haspopup="true" aria-expanded="false"><i class="ti-plus"></i> Add</button></a>

                                    <table id="myTable" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Exam Name</th>
                                                <th>Review Name</th>
                                                <th>Review</th>
                                                <th>Review Created</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $no=1; foreach($select_exam_review_by_id_exam->result() as $row_exam_review){ ?>
                                            <tr>
                                                <td><?php echo $no++; ?></td>
                                                <td><?php echo $row_exam_review->exam_name; ?></td>
                                                <td><?php echo $row_exam_review->review_name; ?></td>
                                                <td><?php echo $row_exam_review->review; ?></td>
                                                <td><?php echo $row_exam_review->review_created; ?></td>
                                                <td><a href="<?php echo base_url(); ?>adm/exam/update_exam_review/<?php echo $row_exam_review->id_exam.'/'.$row_exam_review->id_exam_review; ?>"><button type="button" class="btn btn-warning btn-sm" aria-haspopup="true" aria-expanded="false"><i class="ti-pencil"></i></button> </a> <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#Delete<?php echo $row_exam_review->id_exam_review; ?>" aria-haspopup="true" aria-expanded="false"><i class="ti-trash"></i></button></td>
                                            </tr>

                                            <div id="Delete<?php echo $row_exam_review->id_exam_review; ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="myModalLabel">Delete This Data !</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p style="font-size: 16px">Are you sure want delete this ?</p>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="<?php echo base_url(); ?>adm/exam/delete_exam_review/<?php echo $row_exam_review->id_exam.'/'.$row_exam_review->id_exam_review; ?>""><button type="submit" class="btn btn-info">Yes</button></a>
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
        
        $(document).ready(function() {
            var table = $('#example').DataTable({
                "columnDefs": [{
                    "visible": false,
                    "targets": 2
                }],
                "order": [
                    [2, 'asc']
                ],
                "displayLength": 25,
                "drawCallback": function(settings) {
                    var api = this.api();
                    var rows = api.rows({
                        page: 'current'
                    }).nodes();
                    var last = null;
                    api.column(2, {
                        page: 'current'
                    }).data().each(function(group, i) {
                        if (last !== group) {
                            $(rows).eq(i).before('<tr class="group"><td colspan="5">' + group + '</td></tr>');
                            last = group;
                        }
                    });
                }
            });
            // Order by the grouping
            $('#example tbody').on('click', 'tr.group', function() {
                var currentOrder = table.order()[0];
                if (currentOrder[0] === 2 && currentOrder[1] === 'asc') {
                    table.order([2, 'desc']).draw();
                } else {
                    table.order([2, 'asc']).draw();
                }
            });
        });
    });
   
   setTimeout(function(){ $("#notif").hide(); }, 4000);
    </script>
</body>

</html>
