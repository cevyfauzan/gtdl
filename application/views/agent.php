<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Agent</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="icon" href="<?php echo base_url()?>assets/dist/img/getdial-icon.png" type="image/x-icon" />
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/select2/select2.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">

    <script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
    <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/slimScroll/jquery.slimscroll.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/select2/select2.full.min.js"></script>
    <script src="<?php echo base_url() ?>assets/plugins/fastclick/fastclick.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/app.min.js"></script>
    <script src="<?php echo base_url() ?>assets/dist/js/demo.js"></script>
    <script src="<?php echo base_url() ?>assets/js/datetimejs.js"></script>

    <script type="text/javascript">
        function onlyNumb(evt) {
		    var charCode = (evt.which) ? evt.which : event.keyCode
		        if (charCode > 31 && (charCode < 48 || charCode > 57))
		        return false;
		        return true;
        }
        
        $(function () {
            $(".select2").select2();
            $('#test').attr("disabled", "disabled").off('click');
            $('#modal-hospitals').DataTable({
                "lengthChange": false,
                "ordering": false,
                "autoWidth": false
            });
            $('#listlead').DataTable({
                "lengthChange": false,
                "scrollY": "270px",
                "scrollCollapse": true,
                "ordering": false,
                "autoWidth": false,
                "paging": false,
                "info": false
            });
            $(".datepicker").datepicker({
                format: "dd/mm/yyyy"
            });
        });
        $(document).ready(function () {             
            $('.dataTables_filter input[type="search"]').css(
                {'width':'66px','display':'inline-block'}
            );
        });
    </script>

</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="" class="navbar-logo"><img src="<?php echo base_url() ?>assets/dist/img/getdial.png" alt="" style="width:120px; margin-top: 4px;"></a>
                    </div>

                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown tasks-menu">
                                <a>
                                    <span>
                                    <span><script language="JavaScript">document.write(tanggallengkap);</script></span>
                                    <span>&ensp;</span>
                                    <span id="output"></span>
                                    </span>
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
                                                <img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
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
                                    <img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
                                    <span class="hidden-xs">Agent001</span>
                                </a>
                                <ul class="dropdown-menu">
                                    <li class="user-header">
                                        <img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
                                        <p>
                                            Agent001 - Agent
                                            <small>Member since Agustus 2017</small>
                                        </p>
                                    </li>
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="<?= base_url() ?>agent/login" class="btn btn-default">Logout</a>
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
                        <div class="col-md-4">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-list"></i> List Lead</h3>
                                </div>

                                <form class="form-horizontal" action="agc.php">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Campaign</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">All Campaign</option>
                                                <option>Alaska</option>
                                                <option>California</option>
                                                <option>Delaware</option>
                                                <option>Tennessee</option>
                                                <option>Texas</option>
                                                <option>Washington</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputEmail3" class="col-sm-3 control-label">Dispo</label>
                                        <div class="col-sm-9">
                                            <select class="form-control select2" style="width: 100%;">
                                                <option selected="selected">All Dispo</option>
                                                <option>New</option>
                                                <option>Call Back</option>
                                                <option>Hangup</option>
                                                <option>No Answer</option>
                                                <option>No Body Pickup</option>
                                                <option>Reject Up Front</option>
                                                <option>Thinking</option>
                                            </select>
                                        </div>
                                    </div>
                                    <table id="listlead" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="7%">No</th>
                                                <th>Name</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php for($i=1; $i<=10; $i++) { ?>
                                            <tr onclick="window.location='';" style="cursor:pointer">
                                                <td><?php echo $i; ?></td>
                                                <td>Cevy Fauzan</td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                    <span><b>Total</b>&ensp;:&ensp;<?php echo $i++; ?> Data</span>
                                </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-md-5">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-search-plus"></i> Detail Lead</h3>
                                </div>

                                <div class="box-body">
                                    <table class="table table-striped">
                                        <tr>
                                            <td style="width: 30%"><b>Name</b></td>
                                            <td>: &ensp;Cevy Fauzan</td>
                                        </tr>
                                        <tr>
                                            <td><b>Number</b></td>
                                            <td>: &ensp;087725601381</td>
                                        </tr>
                                        <tr>
                                            <td><b>Dispo</b></td>
                                            <td>: &ensp;Call Back</td>
                                        </tr>
                                        <tr>
                                            <td><b>Last Call</b></td>
                                            <td>: &ensp;17 Des 2017 - 15:12:00</td>
                                        </tr>
                                        <tr>
                                            <td><b>Scheduling</b></td>
                                            <td>: &ensp;19 Des 2017 - 15:12:00</td>
                                        </tr>
                                    </table>
                                    <div class="form-group">
                                        <label>Note</label>
                                        <textarea class="form-control" rows="6" readonly>Notes for lead</textarea>
                                    </div>
                                    <div class="callout callout-danger">
                                    <p>No more lead for this campaign !!!</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-calculator"></i> Softphone</h3>
                                    <div class="box-tools pull-right" data-toggle="tooltip" title="Active">
                                        <!--<i class="fa fa-square text-green"></i>                                        
                                        <span class="text-green"><b>Live Call</b></span>-->
                                        <i class="fa fa-circle text-info"></i>                                        
                                        <span class="text-info"><b>Ready</b></span>
                                        <!--<i class="fa fa-square text-red"></i>                                        
                                        <span class="text-red"><b>Hangup</b></span>-->
                                    </div>
                                </div>

                                <form action="" method="post">
                                <div class="box-body">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-phone"></i>
                                                </div>
                                                <input type="text" class="form-control" name="" id="phoneNumber" value="087725601381" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-mCall">Manual Call</button>
                                    <br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <button type="button" class="btn btn-block btn-danger" data-toggle="modal" data-target="#myModal-hangup">Hangup</button>
                                        </div>
                                        <div class="col-sm-6">
                                            <button type="submit" class="btn btn-block btn-success">Call</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                            </div>

                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><i class="fa fa-wrench"></i> Tools</h3>
                                </div>
                                <div class="box-body">
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-1">Script</button>
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-2">Premium</button>
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-3">Hospitals</button>
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-4">BMI Calc</button>
                                    <button type="button" class="btn btn-block btn-default" data-toggle="modal" data-target="#myModal-5">Age Calc</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>

        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>&copy; 2017 <a href="">getDIAL</a>.</strong> All rights reserved.
            </div>
        </footer>
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
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-user"></i>
                            </div>
                            <input type="text" class="form-control" name="" id="" placeholder="Input Name" minlength="2" maxlength="50">
                        </div>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input type="text" class="form-control" name="Input" id="" placeholder="Input Number" minlength="8" maxlength="13" onkeypress="return onlyNumb(event);">
                        </div>
                    </div>
                </div>
                <br>
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '1';">1</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '2';">2</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '3';">3</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '4';">4</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '5';">5</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '6';">6</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '7';">7</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '8';">8</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '9';">9</button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '*';">*</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '0';">0</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value += '#';">#</button>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value.substring(0, callManual.Input.value.length - 1);">Del</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" class="btn btn-block btn-default" onClick="callManual.Input.value = '';">Clear</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <button type="submit" class="btn btn-block btn-success">Call</button>
                    </div>
                </div>
			</div>
            </form>
		</div>			
	</div>
</div>

<!-- Modal Hangup -->
<div id="myModal-hangup" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-body">
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Dispo</label>
                    </div>
                    <div class="col-sm-9">
                        <select class="form-control">
                            <option selected="selected">Select Dispo</option>
                            <option>Call Back</option>
                            <option>Hangup</option>
                            <option>No Answer</option>
                            <option>No Body Pickup</option>
                            <option>Reject Up Front</option>
                            <option>Sale</option>
                            <option>Thinking</option>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Scheduling</label>
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control datepicker" name="" id="">
                    </div>
                    <div class="col-sm-3">
                        <input type="text" class="form-control timepicker" name="" id="">
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-sm-3">
                        <label class="control-label">Note</label>
                    </div>
                    <div class="col-sm-9">
                    <textarea class="form-control" rows="3" name="" id=""></textarea>
                    </div>
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Submit</button>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Script -->
<div id="myModal-1" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:80%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Script</h4>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>			
	</div>
</div>
</body>
</html>
