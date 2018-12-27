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

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS  -->
        <link href="<?php echo base_url(); ?>assets/css/icon.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/main.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/font-awesome.css">
        <link rel="icon" type="image/png" sizes="12x21" href="<?php echo base_url(); ?>assets/img/faveico.png">

        <title>digiX! Sukses ujian dimulai dari sini...</title>

    <meta name="title" content="digiX! Sukses ujian dimulai dari sini...">
    <meta name="description" content="Aplikasi simulasi ujian online terlengkap di Indonesia">
    <meta name="keywords" content="Ujian Nasional, UNAS, SBMPTN, Perguruan Tinggi, Sekolah, STAN, Sekolah Kedinasan, Ujian, CPNS, BUMN, Tes, Psikotes, TPA, Tes Potensi Akademik">
    </head>


<body>
    <nav class="white row">
      <div class="logo-container col s2">
        <a href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo_v6.png" alt=""></a>
      </div>
      <div class="search-container col s4">
        <form class="col s8" action="<?php echo base_url();?>explore/index" method="get" action="#" accept-charset="UTF-8" style="margin-top:10px">
          <div class="col s10">
            <input maxlength="200" autocomplete="off" placeholder="Masukkan kata pencarian..." id="search-input" name="param" type="text" style="color:black;">
          </div>
          <div class="col s2">
            <button class="waves-effect waves-light btn blue darken-3"><i class="fa fa-search"></i></button>
          </div>
        </form>
      </div>
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
                
      <ul class="hide-on-med-and-down">
          <li><a class="navigation" href="<?php echo base_url(); ?>explore">Jelajahi</a></li>
          <li><a class="navigation" href="#">Mentoring</a></li>
          <li><a class="navigation" href="#">Hubungi Kami</a></li>
          <?php if(!$this->session->logged_in)
          { ?>
          <li><a class="navigation modal-trigger" id="login" href="#login-modal">Log In</a></li>
          <li><a class="waves-effect waves-light btn-large signup-button-nav blue darken-3 modal-trigger" href="#register-modal">Register</a></li>
          <li id="notif"><?php echo $this->session->flashdata('notif'); ?></li>
          <?php } else {?> 
          <li><a class="dropdown-trigger waves-effect waves-light btn-large signup-button-nav blue darken-3 " href="#!" data-target="dropdown-user"><?php echo $this->session->id_user; ?><i class="material-icons right">arrow_drop_down</i></a></li>
              
          <?php } ?>
      </ul>
    </nav>