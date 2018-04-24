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
                            <span>Data</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li class="" id="data-camp"><a href="<?= base_url() ?>campaigns"><i class="fa fa-flag-checkered"></i> Campaigns</a></li>
                            <li class="" id="data-list"><a href="<?= base_url() ?>lists"><i class="fa fa-list"></i> Lists</a></li>
                            <li class="" id="data-script"><a href="<?= base_url() ?>scripts"><i class="fa fa-file-text-o"></i> Scripts</a></li>
                            <li class="" id="data-user"><a href="<?= base_url() ?>Users"><i class="fa fa-user"></i> Users</a></li>
                        </ul>
                    </li>
                    <li class="treeview" id="tele">
                        <a href="#">
                            <i class="fa fa-phone"></i>
                            <span>Telephony</span>
                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li id="tele-call_times"><a href="<?= base_url() ?>call_times"><i class="fa fa-clock-o"></i> Call Times&ensp;<small class="label pull-right bg-green">New</small></a></li>
                            <li id="tele-carrier"><a href="<?= base_url() ?>carriers"><i class="fa fa-signal"></i> Carriers</a></li>
                            <li id="tele-phones"><a href="<?= base_url() ?>phones"><i class="fa fa-phone-square"></i> Phones</a></li>
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
                            <li id="set-dispo"><a href="<?= base_url() ?>dispo"><i class="fa fa-tags"></i> Dispo&ensp;<small class="label pull-right bg-green">New</small></a></li>
                            <li id="set-log"><a href="<?= base_url() ?>logs"><i class="fa fa-send"></i> Logs&ensp;<small class="label pull-right bg-green">New</small></a></li>
                            <li id="set-server"><a href="<?= base_url() ?>server"><i class="fa fa-server"></i> Servers</a></li>
                            <li id="set-setting"><a href="<?= base_url() ?>system_setting"><i class="fa fa-gears"></i> System Settings</a></li>
                            <li id="set-group"><a href="<?= base_url() ?>user_groups"><i class="fa fa-users"></i> User Groups</a></li>
                        </ul>
                    </li>
                    <li class="" id="rec">
                        <a href="<?= base_url() ?>recordings">
                            <i class="fa fa-microphone"></i> <span>Recording</span>
                        </a>
                    </li>
                    <li class="" id="rep">
                        <a href="<?= base_url() ?>report">
                            <i class="fa fa-files-o"></i> <span>Report</span>
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
                </ul>
            </section>
        </aside>