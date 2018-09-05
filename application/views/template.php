<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= $title ?></title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="<?php echo base_url()?>assets/dist/img/getdial-icon.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo base_url()?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/css/skins/_all-skins.min.css">

    <script src="<?php echo base_url()?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url()?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url()?>assets/plugins/fastclick/fastclick.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/app.min.js"></script>
    <script src="<?php echo base_url()?>assets/dist/js/demo.js"></script>
    <script src="<?php echo base_url()?>assets/js/watch.js"></script>
    <script type="text/javascript">
        $(window).load(function() {
            $(".loader").fadeOut("slow");
        });
    </script>

    <style>
        .loader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url(<?php echo base_url();?>assets/dist/img/loader.gif) 50% 50% no-repeat rgb(249,249,249);
            opacity: .8;
        }
    </style>
</head>

<body class="hold-transition skin-blue sidebar-mini fixed">
    <div class="wrapper">
        <header class="main-header">
            <a href="<?= base_url()?>dash" class="logo">
                <span class="logo-mini"><img src="<?php echo base_url()?>assets/dist/img/getdial-icon.png" alt="" style="width:40px"></span>
                <span class="logo-lg"><img src="<?php echo base_url()?>assets/dist/img/getdial.png" alt="" style="width:120px; margin-top: -4px;"></span>
            </a>
            <nav class="navbar navbar-static-top">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                </a>

                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <li>
                            <a>
                                <span><script language="javascript">document.write(tanggallengkap);</script></span>
                                <span>&ensp;</span>
                                <span id="output"></span>
                            </a>
                        </li>
                        <li class="dropdown messages-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-envelope-o"></i>
                                <span class="label label-warning">1</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="header">You have 1 messages</li>
                                <li>
                                    <ul class="menu">
                                        <li>
                                            <a href="#">
                                                <div class="pull-left">
                                                    <img src="<?php echo base_url()?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                                                </div>
                                                <h4>
                                                    Support Team
                                                    <small><i class="fa fa-clock-o"></i> 5 mins</small>
                                                </h4>
                                                <p>Why not buy a new awesome theme?</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="footer"><a href="#">See All Messages</a></li>
                            </ul>
                        </li>

                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src="<?php echo base_url()?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
                                <span class="hidden-xs">CEVY FAUZAN</span> <i class="fa fa-sort-down pull-right"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header">
                                    <img src="<?php echo base_url()?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                                    <p>
                                        Cevy Fauzan - Administrator
                                        <small>Member since Nov. 2017</small>
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?= base_url() ?>login" class="btn btn-default">Sign Out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>

        <aside class="main-sidebar">
            <section class="sidebar">
                <div class="user-panel">
                    <div class="pull-left image">
                        <img src="<?php echo base_url()?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p>Admin 001</p>
                        <a href=""><i class="fa fa-circle text-success"></i> Online</a>
                    </div>
                </div>
                <ul class="sidebar-menu">
                    <li class="header">MENU</li>
                    <li class="" id="dash">
                        <a href="<?= base_url()?>dash">
                            <i class="fa fa-dashboard"></i> <span>Dashboard</span>&ensp;<small class="label pull-right bg-green">New</small>
                        </a>
                    </li>
                    <li class="treeview" id="data">
                        <a href="#">
                            <i class="fa fa-database"></i>
                            <span>Leads</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li id="data-camp"><a href="<?= base_url() ?>campaigns"><i class="fa fa-flag-checkered"></i> Campaigns</a></li>
                            <li id="data-dispo"><a href="<?= base_url() ?>dispo"><i class="fa fa-tags"></i> Dispo&ensp;<small class="label pull-right bg-green">New</small></a></li>
                            <li id="data-list"><a href="<?= base_url() ?>lists"><i class="fa fa-list"></i> Lists</a></li>
                            <li id="data-script"><a href="<?= base_url() ?>scripts"><i class="fa fa-file-text-o"></i> Scripts</a></li>
                        </ul>
                    </li>
                    <li class="treeview" id="set">
                        <a href="#">
                            <i class="fa fa-cogs"></i>
                            <span>Settings</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li id="set-call_times"><a href="<?= base_url() ?>call_times"><i class="fa fa-clock-o"></i> Call Times&ensp;<small class="label pull-right bg-green">New</small></a></li>
                            <li id="set-log"><a href="<?= base_url() ?>logs"><i class="fa fa-send"></i> Logs&ensp;<small class="label pull-right bg-green">New</small></a></li>
                            <li id="set-group"><a href="<?= base_url() ?>user_groups"><i class="fa fa-users"></i> User Groups</a></li>
                            <li id="set-user"><a href="<?= base_url() ?>Users"><i class="fa fa-user"></i> Users</a></li>
                        </ul>
                    </li>
                    <li class="" id="rec">
                        <a href="<?= base_url() ?>recordings">
                            <i class="fa fa-microphone"></i> <span>Recordings</span>
                        </a>
                    </li>
                    <li class="" id="rep">
                        <a href="<?= base_url() ?>report">
                            <i class="fa fa-files-o"></i> <span>Reports</span>
                        </a>
                    </li>
                    <li class="" id="mes">
                        <a href="">
                            <i class="fa fa-envelope-o "></i> <span>Messages</span>
                            <span class="pull-right-container">
                                <small class="label pull-right bg-yellow">1 New</small>
                            </span>
                        </a>
                    </li>
                    <li class="header">AFTER SALES</li>
                    <li class="" id="aft-s">
                        <a href="<?= base_url() ?>aft/sales">
                            <i class="fa fa-cart-arrow-down"></i> <span>Sales</span>
                        </a>
                    </li>
                    <li class="" id="aft-q">
                        <a href="<?= base_url() ?>aft/qc">
                            <i class="fa fa-file-audio-o"></i> <span>Quality Control</span>
                        </a>
                    </li>
                    <li class="" id="aft-r">
                        <a href="<?= base_url() ?>aft/report">
                            <i class="fa fa-file-excel-o"></i> <span>Report Sales</span>
                        </a>
                    </li>
                </ul>
            </section>
        </aside>

        <div class="loader"></div>
        <div class="content-wrapper">
            <!--<?php $this->load->view('template/breadcrumb'); ?>-->

            <section class="content">
                <?php $this->load->view($main); ?>
            </section>
        </div>
        
        <footer class="main-footer">
            <div class="pull-right hidden-xs">
                V 2.0.0 - The Next Generations Contact Centers
            </div>
            <strong>&copy; 2017-2018 <a href="">getDIAL.id</a></strong> All rights reserved.&ensp;<strong>&copy; Powered by <a href="http://getdial.tech" target="blank">Cicalung-solutions</a></strong>
        </footer>
    </div>
</body>
</html>
