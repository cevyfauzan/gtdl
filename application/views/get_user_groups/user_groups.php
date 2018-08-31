<?php
############################################################################################
####  Name:             	user_group.php                                             	####
####  Type:             	ci views - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/all.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
			<div class="box-header">
                <h2 class="box-title"><b>User Groups</b></h2>
				<div class="pull-right">
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-group" data-backdrop="static" data-keyboard="false" title="Add"><i class="fa fa-plus"></i>&ensp;Add New User Group</a>
				</div>
            </div>
            <div class="box-body">
            <table id="group" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User Group</th>
                        <th>Group Name</th>
                        <th>Forced Timelock</th>
                        <th width="10%">Action</th>
                        <th width="5%"><input type="checkbox" id="check-all"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="add-group" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ADD NEW USER GROUP</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User Group :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Group Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="password" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Group Template :</label>
						</div>
					</div>
					<div class="col-sm-6">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'ADMINISTRATOR','N' => 'AGENTS','O' => 'SUPERVISOR');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Group Level :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '1','N' => '2');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Dashboard :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Todays Status</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Account Info</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Agent Lead Status</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Server Settings</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>System Service</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Create</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Read</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Update</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Delete</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Campaign :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Create</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Read</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Update</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Delete</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>List :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Create</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Read</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Update</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Delete</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Load Leads :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Create</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Script :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Create</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Read</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Update</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Delete</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Report :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Statistical Report</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Agent Time Detail</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Agent Performance Detail</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Dial Status Summary</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Sales Per Agent</label>&ensp;<br>
						<input type="checkbox" name="" class="minimal">&ensp;<label>Sales Tracker</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Export Call Report</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Dashboard</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label> Advance Script</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Recording :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Allowed Recording View</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Support :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Allowed Support</label>
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SUBMIT</a></center>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Edit -->
<div id="edit-group" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">EDIT USER GROUP</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User Group :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Group Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="password" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Force Timeclock Login :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO','O' => 'ADMIN EXEMPT');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Shift Enforcement :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'OFF','N' => 'ALL');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Dashboard :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Todays Status</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Account Info</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Agent Lead Status</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Server Settings</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>System Service</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Create</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Read</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Update</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Delete</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Campaign :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Create</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Read</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Update</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Delete</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>List :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Create</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Read</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Update</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Delete</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Load Leads :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Create</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Script :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Create</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Read</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Update</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Delete</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Report :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Statistical Report</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Agent Time Detail</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Agent Performance Detail</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Dial Status Summary</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Sales Per Agent</label>&ensp;<br>
						<input type="checkbox" name="" class="minimal">&ensp;<label>Sales Tracker</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Export Call Report</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label>Dashboard</label>&ensp;
						<input type="checkbox" name="" class="minimal">&ensp;<label> Advance Script</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Recording :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Allowed Recording View</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Support :</label>
						</div>
					</div>
					<div class="col-sm-9">
						<input type="checkbox" name="" class="minimal">&ensp;<label>Allowed Support</label>
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SAVE SETTING</a></center>
			</div>
		</div>			
	</div>
</div>

<!--======================================================================================================================-->
<script>
	var save_method;
	var table;

	$(document).ready(function() {
		table = $('#group').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('user_groups/user_group_list')?>",
				"type": "POST"
			},
			"columnDefs": [
				{ 
					"targets": [ 0 ],
					"orderable": false,
				},
				{ 
					"targets": [ -1 ],
					"orderable": false,
				},
			],
		});

		$("#check-all").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});

	function nav_active(){
		document.getElementById("set").className = "active";
		document.getElementById("set-group").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>