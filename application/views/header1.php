<html>
<head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0">

        <!--Import Font Awesome Icon-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="<?php echo base_url(); ?>assets/css/icon.css" rel="stylesheet">
        <!--Import materialize.css-->

        <!--Upgraded to new materialize: <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css">-->
        
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/materialize.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
        <link href="https://cdn.jsdelivr.net/jquery.webui-popover/1.2.1/jquery.webui-popover.min.css" rel="stylesheet" />

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS  -->
        <link href="<?php echo base_url(); ?>assets/css/icon.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
        <link rel="icon" type="image/png" sizes="12x21" href="<?php echo base_url(); ?>assets/img/faveico.png">
        
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/treeview.css">
        <style type="text/css">
            .ajax-load{
                background: transparent;
                padding: 10px 0px;
                width: 100%;
            }
        </style>

        <title>digiX! Sukses ujian dimulai dari sini...</title>

    <meta name="title" content="digiX! Sukses ujian dimulai dari sini...">
    <meta name="description" content="Aplikasi simulasi ujian online terlengkap di Indonesia">
    <meta name="keywords" content="Ujian Nasional, UNAS, SBMPTN, Perguruan Tinggi, Sekolah, STAN, Sekolah Kedinasan, Ujian, CPNS, BUMN, Tes, Psikotes, TPA, Tes Potensi Akademik">
    </head>


<body>

<div class="navbar-fixed">
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a href="<?php echo base_url(); ?>" class="brand-logo black-text"><img src="<?php echo base_url(); ?>assets/img/logo_v6.png" alt=""></a>
            
                <?php if($this->session->logged_in)
                { ?>
                <ul id="dropdown-user" class="dropdown-content">
                    <li><a href="#!">Profile</a></li>
                    <li><a href="#!">Result Exam</a></li>
                    <!-- <li><a href="<?php echo base_url(); ?>testimoni">Review</a></li> -->
                    <li class="divider"></li>
                    <li><a href="<?php echo base_url();?>index/logout">Logout</a></li>
                </ul>
                <?php } ?>
            <ul class="right hide-on-med-and-down">
                <li><a class="navigation" href="<?php echo base_url(); ?>explore">Jelajahi</a></li>
                <li><a class="navigation" href="#">Mentoring</a></li>
                <li><a class="navigation" href="#">Hubungi Kami</a></li>
                <?php if(!$this->session->logged_in)
                { ?>
                <li><a class="navigation modal-trigger" id="login"  href="#login-modal">Log In</a></li>
                <li><a class="waves-effect waves-light btn-large signup-button-nav blue darken-3 modal-trigger"  href="#register-modal">Register</a></li>
                <li id="notif"><?php echo $this->session->flashdata('notif'); ?></li>
                <?php } else {?> 
                <li><a class="dropdown-trigger waves-effect waves-light btn-large signup-button-nav blue darken-3 " href="#!" data-target="dropdown-user"><?php echo $this->session->id_user; ?><i class="material-icons right">arrow_drop_down</i></a></li>
                    
                <?php } ?>
            </ul>
            <ul id="nav-mobile" class="sidenav">
                <li><a href="<?php echo base_url();?>explore">Jelajahi</a></li>
                <li><a href="#">Mentoring</a></li>
                <li><a href="#">Komunitas</a></li>
                <?php if(!$this->session->logged_in)
                { ?>
                <li><a class="modal-trigger" href="#login-modal">Log In</a></li>

                <li><a class="modal-trigger" href="#register-modal">Register</a></li>
                <?php } 
                else { ?>  
                    <li><a href="#!" data-target="dropdown-user" ><?php echo $this->session->id_user; ?></a></li>
                <?php } ?>
            </ul>
            <a href="#" data-target="nav-mobile" class="sidenav-trigger button-collapse black-text"><i class="material-icons">menu</i></a>

        </div>
    </nav>
    
</div>

    
