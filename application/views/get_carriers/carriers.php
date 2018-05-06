<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/all.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
			<div class="box-header">
                <h2 class="box-title"><b>Carriers</b></h2>
				<div class="pull-right">
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-carrier" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Carrier</a>
				</div>
            </div>
            <div class="box-body">
            <table id="carrier" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Carrier ID</th>
                        <th>Carrier Name</th>
                        <th>Server IP</th>
                        <th>Protocol</th>
                        <th>Registration</th>
                        <th>Status</th>
                        <th width="10%">Action</th>
                        <th width="5%"><input type="checkbox" class="minimal"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>getdial</td>
                        <td>getdial</td>
                        <td>192.168.1.154</td>
                        <td>SIP</td>
                        <td style="color:green">Registered</td>
                        <td style="color:green">ACTIVE</td>
                        <td>
                            <a href="" title="Edit" data-toggle="modal" data-target="#edit-carrier"><i class="fa fa-edit text-yellow"></i></a>&ensp;
                            <a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this data ?');"><i class="fa fa-remove text-red"></i></a>&ensp;
                            <a href="" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;
                        </td>
                        <td><input type="checkbox" class="minimal"></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="add-carrier" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ADD NEW CARRIER</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Carrier ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Carrier Name :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Carrier Desc :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Admin User Group :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'All User Groups','N' => 'Administrators','M' => 'Agents');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Account Entry :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
                       		<textarea class="form-control" name="" rows="10"></textarea>
					   	</div>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Protocol :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'SIP','N' => 'IAX');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Globals String :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Dialplan Entry :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
                       		<textarea class="form-control" name="" rows="7"></textarea>
					   	</div>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '192.168.1.1 - getdial server');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Active :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SUBMIT</a></center>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Edit -->
<div id="edit-carrier" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">MODIFY CARRIER</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Carrier ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Carrier Name :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Carrier Desc :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Admin User Group :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'All User Groups','N' => 'Administrators','M' => 'Agents');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Account Entry :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
                       		<textarea class="form-control" name="" rows="10"></textarea>
					   	</div>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Protocol :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'SIP','N' => 'IAX');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Globals String :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Dialplan Entry :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
                       		<textarea class="form-control" name="" rows="7"></textarea>
					   	</div>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '192.168.1.1 - getdial server');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Active :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SUBMIT</a></center>
			</div>
		</div>			
	</div>
</div>

<!--======================================================================================================================-->
<script>
    $(function () {
		$('#carrier').DataTable({
			"ordering": false,
			"autoWidth": false
		});
	});

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    });

	function nav_active(){
		document.getElementById("tele").className = "active";
		document.getElementById("tele-carrier").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>