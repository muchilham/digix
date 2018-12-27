<header class="topbar">
            <nav class="navbar top-navbar navbar-expand-md navbar-light">
               
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">
                        <b>
                            <img src="<?php echo base_url(); ?>assets/adm/images/logo-icon.png" alt="homepage" class="dark-logo" width="70%"/>
                        </b>
                        
                    </a>
                </div>

                <div class="navbar-collapse">

                    <ul class="navbar-nav mr-auto mt-md-0">
                        <li class="nav-item"> <a class="nav-link nav-toggler hidden-md-up text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="mdi mdi-menu"></i></a> </li>
                        <li class="nav-item m-l-10"> <a class="nav-link sidebartoggler hidden-sm-down text-muted waves-effect waves-dark" href="javascript:void(0)"><i class="ti-menu"></i></a> </li>
                    </ul>

                    <ul class="navbar-nav my-lg-0">
                       

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle text-muted waves-effect waves-dark" href="" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo base_url(); ?>assets/adm/images/account/<?php echo $this->session->userdata('user_photo'); ?>" alt="user" class="profile-pic" /></a>
                            <div class="dropdown-menu dropdown-menu-right scale-up">
                                <ul class="dropdown-user">
                                    <li>
                                        <div class="dw-user-box">
                                            <div class="u-img"><img src="<?php echo base_url(); ?>assets/adm/images/account/<?php echo $this->session->userdata('user_photo'); ?>" alt="user"></div>
                                            <div class="u-text">
                                                <h4><?php echo $this->session->userdata('id_user'); ?></h4>
                                                
                                        </div>
                                    </li>
                                    
                                    <li role="separator" class="divider"></li>
                                    <li><a href="<?php echo base_url(); ?>adm/main/logout"><i class="fa fa-power-off"></i> Logout</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="left-sidebar">
            <div class="scroll-sidebar">
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-devider"></li>
                        <li class="nav-small-cap">PERSONAL</li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Account<span class="label label-rouded label-themecolor pull-right">2</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>adm/account/admin">Admin </a></li>
                                <li><a href="<?php echo base_url(); ?>adm/account/user">User</a></li>
                            </ul>
                        </li>
                         <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Category</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>adm/category">Category Tables </a></li>
                            </ul>
                        </li>
                         <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Subject<span class="label label-rouded label-themecolor pull-right">2</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>adm/subject">Subject Tables</a></li>
                                <li><a href="<?php echo base_url(); ?>adm/subject/detail">Subject Detail Tables</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Question<span class="label label-rouded label-themecolor pull-right">3</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>adm/question">Question Tables</a></li>
                                <li><a href="<?php echo base_url(); ?>adm/question/subject_detail_question">Question Subject Detail Tables</a></li>
                                <li><a href="<?php echo base_url(); ?>adm/question/group">Question Group Tables</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Exam</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>adm/exam">Exam Tables</a></li>
                            </ul>
                        </li>
                        <li> <a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Answer<span class="label label-rouded label-themecolor pull-right">2</span></span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>adm/answer/choice_one">Multiple One </a></li>
                                <li><a href="<?php echo base_url(); ?>adm/answer/essay">Essay</a></li>
                            </ul>
                        </li>
                        <li><a class="has-arrow waves-effect waves-dark" href="#" aria-expanded="false"><span class="hide-menu">Review</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="<?php echo base_url(); ?>adm/answer/choice_one">Review Tables </a></li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>