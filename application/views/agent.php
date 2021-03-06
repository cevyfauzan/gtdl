<?php
############################################################################################
####  Name:             	agent.php                                            	    ####
####  Type:             	ci view - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agent</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="<?php echo base_url()?>assets/dist/img/getdial-icon.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css">
    <!--<link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/select2/select2.min.css">-->
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/jQueryUI/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">

    <script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <!--<script src="<?php echo base_url() ?>assets/plugins/select2/select2.full.min.js"></script>-->
    <script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/jQueryUI/jquery-ui.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?php echo base_url() ?>assets/js/datetimejs.js"></script>

    <script type="text/javascript">
    	var table;

        $(window).load(function() {
            $('.chat').fadeToggle('fast');
            $('.chat-message-counter').fadeToggle('fast');
            $(".loader").fadeOut("slow");
            pause_sec();
        });

        $(document).ready(function() {
            //$(".select2").select2();

            table = $('#listlead').DataTable({
                "searching": false,
                "lengthChange": false,
                "scrollCollapse": true,
                "ordering": false,
                "autoWidth": false,
                "paging": false,
                "info": false,
                "processing": true,
			    "serverSide": true,
                "ajax": {
                    "url": "<?php echo site_url('agent/lead_list')?>",
                    "type": "POST",
                    "data": function ( data ) {
                        data.campaign_id = $('#campaign_id').val();
                        data.dispo_id = $('#dispo_id').val();
                        data.first_name = $('#first_name').val();
                    }
                },
                "fnDrawCallback": function() {
                    var oSettings = this.fnSettings();
                    var iTotalRecords = oSettings.fnRecordsTotal();
                    $("#count_lead").html('Total : '+iTotalRecords+' Lead');	
                },
                "scrollY": "305px",
                "scroller": { loadingIndicator: true },
                "stateSave": true
            });

            $(".sortable").css('cursor', 'pointer');

            $('#modal-hospitals').DataTable({
                "lengthChange": false,
                "ordering": false,
                "autoWidth": false
            });

            $('#live-chat header').on('click', function() {
                $('.chat').slideToggle(300, 'swing');
                $('.chat-message-counter').fadeToggle(300, 'swing');
            });

            $('.chat-close').on('click', function(e) {
                e.preventDefault();
                $('#live-chat').fadeOut(300);
            });

            $('.datepicker').datepicker({
                format: "dd/mm/yyyy"
            });

            $('#manual_name').autocomplete({
                source: "<?php echo site_url('agent/get_by_name/?')?>"
            });

            $('#manual_number').autocomplete({
                source: "<?php echo site_url('agent/get_by_number/?')?>"
            });
        });

        function detail_lead()
        {
            var camp_id =  $('#campaign_id').val();
            $.ajax({
                url : "<?php echo site_url('agent/ajax_detail')?>/" + camp_id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    if(data != null){
                        $('#lead_code_id').val(data.lead_id);
                        $('#lead_name').html(data.first_name);
                        $('#lead_dob').html(data.date_of_birth);
                        $('#lead_city').html(data.city);
                        $('#lead_email').html(data.email);
                        $('#lead_number_det').html(data.phone_number);
                        $('#lead_number_soft').val(data.phone_number);
                        $('#lead_dispo').html(data.status);
                        $('#lead_last_call').html(data.modify_date);
                        $('#lead_schedule').html(data.entry_date);
                        $('#lead_notes').val(data.notes);
                    }else{
                        reset_lead();
                        stop_timer();
                        changeBtntoReady();
                        $('#campaign_id').attr('disabled', false);
                        $('#btn-hangup').attr('disabled', true);
                        $('#modal-no-lead').modal('show');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function save_agent_log()
        {
            $('#btnSave').text('SAVING...');
            $('#btnSave').attr('disabled',true);
            var url;

            var formData = new FormData($('#form-data-call')[0]);
            $.ajax({
                url : "<?php echo site_url('agents/ajax_agent_log')?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        $('#myModal-hangup').modal('hide');
                    }
                    else
                    {
                        for (var i = 0; i < data.inputerror.length; i++) 
                        {
                            $('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
                            $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
                        }
                    }
                    $('#btnSave').text('SUBMIT');
                    $('#btnSave').attr('disabled',false);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error adding / update data');
                    $('#btnSave').text('SUBMIT');
                    $('#btnSave').attr('disabled',false);
                }
            });
        }

        function reset_lead()
        {
            $('#lead_code_id').val('');
            $('#lead_name').html('');
            $('#lead_dob').html('');
            $('#lead_city').html('');
            $('#lead_email').html('');
            $('#lead_number_det').html('');
            $('#lead_number_soft').val('');
            $('#lead_dispo').html('');
            $('#lead_last_call').html('');
            $('#lead_schedule').html('');
            $('#lead_notes').val('');
        }

        function select_camp() {
            var camp =  $('#campaign_id').val();
            if(camp == ''){
                $('#btn-call').attr('disabled', true);
            }else{
                $('#btn-call').attr('disabled', false);
            }
        }

        function changeBtntoCall(){
            detail_lead();
            $('#campaign_id').attr('disabled', true);
            $('#btn-call').attr('disabled', true);
            $('#btn-hangup').attr('disabled', false);
            $('#btn-call-back').attr('disabled', true);
            $('#btn-manual-call').attr('disabled', true);
            $('#btn-create-polis').attr('disabled', false);
            $('#status-lamp').attr('class','fa fa-circle text-success');
            $('#status-call').html('In Call').attr('class','text-success');
            set_timer();
            stop_pause_sec();
            talk_sec();
        }

        function changeBtntoHangup(){
            stop_timer();
            $.ajax({
                url : "<?php echo site_url('agent/ajax_hangup_call')?>",
                type: "POST"
            });
            $('#status-lamp').attr('class','fa fa-circle text-danger');
            $('#status-call').html('Hangup').attr('class','text-danger');
            $('#campaign_id').attr('disabled', false);
            $('#btn-call').attr('disabled', false);
            $('#btn-hangup').attr('disabled', true);
            $('#btn-call-back').attr('disabled', false);
            $('#btn-manual-call').attr('disabled', false);
            $('#btn-create-polis').attr('disabled', true);
            $('#myModal-hangup').modal({backdrop: 'static', keyboard: false});
            $('#myModal-hangup').modal('show');
            $('#status-lamp').attr('class','fa fa-circle text-warning');
            $('#status-call').html('Dispo').attr('class','text-warning');
            stop_talk_sec();
            dispo_sec();
        }

        function changeBtntoReady(){
            //save_agent_log();
            $.ajax({
                url : "<?php echo site_url('agent/ajax_ready_call')?>",
                type: "POST"
            });
            reset_timer();
            stop_dispo_sec();
            pause_sec();
            $('#get-minutes').html('00');
            $('#get-seconds').html('00');
            $('#status-lamp').attr('class','fa fa-circle text-info');
            $('#status-call').html('ready').attr('class','text-info');
            reset_lead();
        }

        function pad(val) {
            valString = val + "";
            if(valString.length < 2) {
            return "0" + valString;
            } else {
            return valString;
            }
        }

        totalSeconds = 0;
        function setTime(minutesLabel, secondsLabel) {
            totalSeconds++;
            secondsLabel.innerHTML = pad(totalSeconds%60);
            minutesLabel.innerHTML = pad(parseInt(totalSeconds/60));
            }

        function set_timer() {
            minutesLabel = document.getElementById("get-minutes");
            secondsLabel = document.getElementById("get-seconds");
            my_int = setInterval(function() { setTime(minutesLabel, secondsLabel)}, 1000);
        }

        function stop_timer() {
            clearInterval(my_int);
        }

        function reset_timer() {
            totalSeconds = 0;
        }

        function pause_sec() {
            var psec = 0;
            ps = setInterval( function(){ $("#pause_sec").val(++psec); }, 1000);        
        }

        function stop_pause_sec() {
            clearInterval(ps);
            var psec = 0;
        }

        function talk_sec() {
            var tsec = 0;
            ts = setInterval( function(){ $("#talk_sec").val(++tsec); }, 1000);        
        }

        function stop_talk_sec() {
            clearInterval(ts);
            var tsec = 0;
        }

        function dispo_sec() {
            var dsec = 0;
            ds = setInterval( function(){ $("#dispo_sec").val(++dsec); }, 1000);        
        }

        function stop_dispo_sec() {
            clearInterval(ds);
            var dsec = 0;
        }

        function onlyNumb(evt) {
		    var charCode = (evt.which) ? evt.which : event.keyCode
		    if (charCode > 31 && (charCode < 48 || charCode > 57))
		    return false;
		    return true;
        }

        function logoutSession() {
            var hgp = $('#btn-hangup').attr("disabled");
            if(hgp != 'disabled'){
                $('#modal-out').modal('show');
            }else{
                window.location = '<?php echo site_url('login/signout')?>';
            }
        }

        function viewSch(a){
            var dsp = a.value;
            if(dsp == 'CALLBK'){
                $('#select-callback').show();
            }else{
                $('#select-callback').hide();
            }
        }

        function personal_notes()
        {
            $.ajax({
                url : "<?php echo site_url('agent/ajax_personal_notes')?>",
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {
                    $('[name="p_notes"]').val(data.notes);
                    $('#myModal-notes').modal('show');
                    $('.modal-title').text('Personal Notes : ' + data.user);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }

        function save_notes()
        {
            $('#btn_save_notes').text('Saving...');
            $('#btn_save_notes').attr('disabled',true);

            var formData = new FormData($('#form-personal_notes')[0]);
            $.ajax({
                url : "<?php echo site_url('agent/ajax_save_notes')?>",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status)
                    {
                        $('#myModal-notes').modal('hide');
                    }
                    $('#btn_save_notes').text('Save');
                    $('#btn_save_notes').attr('disabled',false);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error update data');
                    $('#btn_save_notes').text('Save');
                    $('#btn_save_notes').attr('disabled',false);
                }
            });
        }
    </script>

    <style>
    @charset "utf-8";
    .ui-autocomplete {
        z-index: 215000000 !important;
    }
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

    .clearfix { *zoom: 1; } /* For IE 6/7 */
    .clearfix:before, .clearfix:after {
        content: "";
        display: table;
    }
    .clearfix:after { clear: both; }

    /* ---------- LIVE-CHAT ---------- */

    #live-chat {
        bottom: 37px;
        font-size: 12px;
        right: 25px;
        position: fixed;
        width: 300px;
    }

    #live-chat header {
        background: #3c8dbc;
        border-radius: 5px 5px 0 0;
        color: #fff;
        cursor: pointer;
        padding: 1px 20px;
    }

    #live-chat h4:before {
        background: #1a8a34;
        border-radius: 50%;
        content: "";
        display: inline-block;
        height: 8px;
        margin: 0 8px 0 0;
        width: 8px;
    }

    #live-chat h4 {
        font-size: 14px;
    }

    #live-chat h5 {
        font-size: 12px;
    }

    #live-chat form {
        padding: 10px;
    }

    .chat-message-counter {
        background: #e62727;
        border: 1px solid #fff;
        border-radius: 50%;
        display: none;
        font-size: 12px;
        font-weight: bold;
        height: 28px;
        left: 0;
        line-height: 28px;
        margin: -15px 0 0 -15px;
        position: absolute;
        text-align: center;
        top: 0;
        width: 28px;
    }

    .chat-close {
        background: #1b2126;
        border-radius: 50%;
        color: #fff;
        display: block;
        float: right;
        font-size: 10px;
        height: 16px;
        line-height: 16px;
        margin: 2px 0 0 0;
        text-align: center;
        width: 16px;
    }

    .chat {
        background: #fff;
        padding: 0px 0px 5px 4px;
    }

    .chat-history {
        height: 252px;
        padding: 5px 5px;
        overflow-y: scroll;
    }

    .chat-message {
        margin: 1px 0;
    }

    .chat-message img {
        border-radius: 50%;
        float: left;
    }

    .chat-message-content {
        margin-left: 56px;
    }

    .chat-time {
        float: right;
        font-size: 11px;
    }

    .chat-feedback {
        font-style: italic; 
        margin: 0 0 0 80px;
    }
    </style>
</head>

<body class="hold-transition skin-blue layout-top-nav fixed">
    <div class="loader"></div>
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-logo"><img src="<?php echo base_url() ?>assets/dist/img/getdial.png" alt="" style="width:120px; margin-top: 4px;"></a>
                    </div>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown tasks-menu">
                                <a><span>Total Sales : 12</span></a>
                            </li>
                            <li class="dropdown tasks-menu">
                                <a><span>Total Calls : 120</span></a>
                            </li>
                            <li class="dropdown tasks-menu">
                                <a><span>Total Leads : 720</span></a>
                            </li>

                            <li class="dropdown tasks-menu">
                                <a>
                                    <span>
                                    <span><script language="JavaScript">document.write(tanggallengkap);</script></span>
                                    <span>&ensp;</span>
                                    <span id="output"></span>
                                    </span>
                                </a>
                            </li>

                            <li class="dropdown user user-menu">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <img src="<?php echo base_url('assets/avatar/'.$this->session->userdata('avatar'))?>" class="user-image" alt="User Image">
                                    <span class="hidden-xs"><?= $this->session->userdata('user'); ?></span> <i class="fa fa-sort-down pull-right"></i>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                                        <p>
                                            <?= $this->session->userdata('full_name'); ?> - <?= $this->session->userdata('user_group'); ?>
                                            <small>Member since <?= date('M. Y', strtotime($this->session->userdata('created_date'))); ?></small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-left">
                                            <a href="javascript:void(0);" class="btn btn-default" data-toggle="modal" data-target="#myModal-6" data-backdrop="static" data-keyboard="false">Agent Statistics</a>
                                        </div>
                                        <div class="pull-right">
                                            <a href="javascript:void(0);" onClick="logoutSession();" class="btn btn-default">Sign Out</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>

        <div class="content-wrapper">
            <div class="container">
                <section class="content">
                    <div class="row">
                        <div class="col-md-4" id="content-refresh">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-list"></i> Campaigns</h3>
                                </div>

                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-4" align="right">
                                            <div class="form-group">
                                                <label>Campaign</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-8">
                    						<?= form_dropdown('', $list_camp, '', 'class="form-control" id="campaign_id" onChange="select_camp()"') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-calculator"></i> Softphone</h3>
                                    <div class="box-tools pull-right">
                                        <i class="fa fa-circle text-info" id="status-lamp"></i>
                                        <b><span class="text-info" id="status-call">Ready</span></b>
                                    </div>
                                </div>

                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input type="text" class="form-control" name="" id="lead_number_soft" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-block btn-danger" id="btn-hangup" onClick="changeBtntoHangup();" disabled>Hangup</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-block btn-success" id="btn-call" onClick="changeBtntoCall();" disabled>Call</button>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-block btn-default" id="btn-manual-call" data-toggle="modal" data-target="#myModal-mCall">Manual Call</button>
                                    <br>
                                    <button type="button" class="btn btn-block btn-default" id="btn-call-back" data-toggle="modal" data-target="#myModal-callBack">Call Back</button>
                                    <div class="row" align="center">
                                        <br>
                                        <span>Call Time</span>&ensp;<label id="get-minutes">00</label><span>:</span><label id="get-seconds">00</label>
                                    </div>
                                    <input type="text" name="pause_sec" id="pause_sec">
                                    <input type="text" name="talk_sec" id="talk_sec">
                                    <input type="text" name="dispo_sec" id="dispo_sec">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-search-plus"></i> Detail Lead</h3>
                                </div>

                                <div class="box-body">
                                    <input type="hidden" id="lead_code_id">
                                    <input type="hidden" id="lead_dispo_for_call">
                                    <table class="table table-striped">
                                        <tr>
                                            <td width="30%"><b>Name</b></td>
                                            <td id="lead_name"></td>
                                        </tr>
                                        <tr>
                                            <td><b>DOB</b></td>
                                            <td id="lead_dob"></td>
                                        </tr>
                                        <tr>
                                            <td><b>City</b></td>
                                            <td id="lead_city"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Email</b></td>
                                            <td id="lead_email"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Number</b></td>
                                            <td id="lead_number_det"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Dispo</b></td>
                                            <td id="lead_dispo"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Last Call</b></td>
                                            <td id="lead_last_call"></td>
                                        </tr>
                                        <tr>
                                            <td><b>Scheduling</b></td>
                                            <td id="lead_schedule"></td>
                                        </tr>
                                    </table>
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea class="form-control" rows="6" id="lead_notes" style="resize:none" readonly>Notes for lead</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-wrench"></i> Tools</h3>
                                </div>
                                <div class="box-body">
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-1">Script</button>
                                    <!--<button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-2">Premium</button>
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-3">Hospitals</button>
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-4">BMI Calc</button>
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-5">Age Calc</button>-->
                                    <button type="button" class="btn btn-block btn-default" id="btn-create-polis" data-toggle="modal" data-target="#myModal-1" disabled>Create Polis</button>
                                    <button type="button" class="btn btn-block btn-default" onClick="personal_notes()">Personal Notes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <div id="live-chat">
            <header class="clearfix">
                <h4>Supervisor</h4>
                <span class="chat-message-counter">3</span>
            </header>
            <div class="chat">
                <div class="chat-history">
                    <div class="chat-message clearfix">
                        <img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" alt="" width="32" height="32">
                        <div class="chat-message-content clearfix">
                            <span class="chat-time"><i class="fa fa-clock-o"></i> 13:35</span>
                            <h4>Supervisor</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Error, explicabo quasi ratione odio dolorum harum.</p>
                        </div>
                    </div>
                    <hr>
                    <div class="chat-message clearfix">
                        <img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" alt="" width="32" height="32">
                        <div class="chat-message-content clearfix">
                            <span class="chat-time"><i class="fa fa-clock-o"></i> 13:37</span>
                            <h4>Agent001</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Blanditiis, nulla accusamus magni vel debitis numquam qui tempora rem voluptatem delectus!</p>
                        </div>
                    </div>
                    <hr>
                    <div class="chat-message clearfix">
                        <img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" alt="" width="32" height="32">
                        <div class="chat-message-content clearfix">
                            <span class="chat-time"><i class="fa fa-clock-o"></i> 13:38</span>
                            <h4>Supervisor</h4>
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing.</p>
                        </div>
                    </div>
                </div>
                <!--<p class="chat-feedback">Your partner is typing…</p>-->
                <form method="post">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Type your message…">
                    <span class="input-group-btn">
                        <button type="button" class="btn btn-primary btn-flat"><i class="fa fa-send"></i></button>
                    </span>
                </div>
                </fieldset>
                </form>
            </div>
        </div>

        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    V 2.0.0 - The Next Generations Contact Centers
                </div>
                <strong>&copy; 2017-2018 <a href="">getDIAL.id</a></strong> All rights reserved.&ensp;<strong>&copy; Powered by <a href="http://getdial.tech" target="blank">Cicalung-solutions</a></strong>
            </div>
        </footer>
    </div>

<!-- Modal Hangup -->
<div id="myModal-hangup" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">Dispo</label>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <?= form_dropdown('dispo_id', $list_dispo_hgp, '', 'class="form-control" onChange="viewSch(this);"') ?>
                    </div>
                </div>
                <div class="row" id="select-callback" style="display:none;">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">Scheduling</label>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control datepicker" name="" id="">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control timepicker" name="" id="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="control-label">Note</label>
                        </div>
                    </div>
                    <div class="col-sm-9">
                    <textarea class="form-control" rows="3" name="" id=""></textarea>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal" onClick="changeBtntoReady();"><i class="fa fa-save"></i>&ensp;Submit</button>
            </div>
		</div>			
	</div>
</div>

<!-- Modal Manual Call -->
<div id="myModal-mCall" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:30%;">
		<div class="modal-content">
            <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Manual Call</h4>
			</div>

            <form action="" method="post" name="callManual">
			<div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input type="text" class="form-control" name="" id="manual_name" placeholder="Input Name" minlength="2" maxlength="50">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input type="text" class="form-control" name="" id="manual_number" placeholder="Input Number" minlength="8" maxlength="13" onkeypress="return onlyNumb(event);">
                            </div>
                        </div>
                    </div>
                </div>
                <legend></legend>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table table-striped">
                            <tr>
                                <td colspan="2"><b>Result :</b></td>
                            </tr>
                            <tr>
                                <td width="30%"><b>Name</b></td>
                                <td id=""></td>
                            </tr>
                            <tr>
                                <td><b>Number</b></td>
                                <td id=""></td>
                            </tr>
                            <tr>
                                <td><b>Dispo</b></td>
                                <td id=""></td>
                            </tr>
                            <tr>
                                <td><b>Last Call</b></td>
                                <td id=""></td>
                            </tr>
                            <tr>
                                <td><b>Scheduling</b></td>
                                <td id=""></td>
                            </tr>
                        </table>
                    </div>
                </div>
			</div>
            <div class="modal-footer">
                <button type="button" id="" class="btn btn-success btn-sm" title="Submit" data-dismiss="modal"><i class="fa fa-send"></i>&ensp;Submit</button>
                <button type="reset" id="" class="btn btn-primary btn-sm" title="Clear Form"><i class="fa fa-trash"></i>&ensp;Clear</button>
                <button type="button" id="" class="btn btn-default btn-sm" title="Refresh" data-dismiss="modal"><i class="fa fa-close"></i>&ensp;Close</button>
            </div>
            </form>
		</div>			
	</div>
</div>

<!-- Modal Script -->
<div id="myModal-1" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:75%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Script</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>&ensp;Close</button>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Premium -->
<div id="myModal-2" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Premium</h4>
			</div>
			<div class="modal-body">
                <table id="" class="table table-bordered table-striped">
					<thead>
						<tr>
							<th rowspan="2" width="30%" style="text-align: center;">Product</th>
                            <th colspan="6" width="70%" style="text-align: center;">Age Distance</th>
                        </tr>
                        <tr>
                            <th width="11%" style="text-align: center;">0 - 19</th>
							<th width="11%" style="text-align: center;">20 - 29</th>
							<th width="11%" style="text-align: center;">30 - 39</th>
							<th width="11%" style="text-align: center;">40 - 49</th>
							<th width="11%" style="text-align: center;">50 - 59</th>
							<th width="11%" style="text-align: center;">60 - 65</th>
						</tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Smile Medical Plan A</td>
                            <td>100.000</td>
                            <td>200.000</td>
                            <td>300.000</td>
                            <td>400.000</td>
                            <td>500.000</td>
                            <td>600.000</td>
                        </tr>    
                    </tbody>            
                </table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Hospitals -->
<div id="myModal-3" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:80%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Hospitals</h4>
			</div>
			<div class="modal-body">
                <table id="modal-hospitals" class="table table-bordered table-striped">
					<thead>
						<tr>
                            <th width="5%">No</th>
							<th width="25%">Name</th>
							<th width="30%">Address</th>
							<th width="25%">City - Province</th>
							<th width="15%">Contact</th>
						</tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Tasik Medical Center (TMC)</td>
                            <td>Jl HZ Mustofa No 29</td>
                            <td>Tasikmalaya - Jawa Barat</td>
                            <td>(0265) 87897433</td>
                        </tr>    
                    </tbody>            
                </table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>			
	</div>
</div>

<!-- Modal BMI Calc -->
<div id="myModal-4" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">BMI Calculator</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Age Calc -->
<div id="myModal-5" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Age Calculator</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Agent Performance -->
<div id="myModal-6" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Agent Performance</h4>
			</div>
			<div class="modal-body">
                <center><h3>Under Construction...!!!</h3></center>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>&ensp;Close</button>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Notes Agent -->
<div id="myModal-notes" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:75%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
            <form action="#" id="form-personal_notes">
			<div class="modal-body pad" style="background: #e2e6e9">
                <textarea class="form-control" name="p_notes" placeholder="Place some text here" style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
			</div>
			<div class="modal-footer">
                <button type="button" class="btn btn-primary btn-sm" id="btn_save_notes" onClick="save_notes()"><i class="fa fa-save"></i>&ensp;Save</button>
				<button type="button" class="btn btn-default btn-sm" data-dismiss="modal"><i class="fa fa-close"></i>&ensp;Close</button>
			</div>
            </form>
		</div>			
	</div>
</div>

<div id="modal-no-lead" class="modal modal-danger fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-body">
                <center><h3>No More Leads...!!!</h3></center>
			</div>
		</div>			
	</div>
</div>

<div id="modal-out" class="modal modal-danger fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-body">
                <center><h3>Can't sign out...!!! You're in the process of calling</h3></center>
			</div>
		</div>			
	</div>
</div>
</body>
</html>
