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
                <h2 class="box-title"><b>Users</b></h2>
				<div class="pull-right">
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-users" data-backdrop="static" data-keyboard="false" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Users</a>
				</div>
            </div>
            <div class="box-body">
            <table id="phones" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Level</th>
                        <th>Group</th>
                        <th>Status</th>
                        <th width="10%">Action</th>
                        <th width="5%"><input type="checkbox" class="minimal"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=01;$i<20;$i++){ ?>
                    <tr>
                        <td>agent<?= $i ?></td>
                        <td>agent<?= $i ?></td>
                        <td>1</td>
                        <td>AGENTS</td>
                        <td style="color:green">ACTIVE</td>
                        <td>
                            <a href="" title="Edit" data-toggle="modal" data-target="#edit-users" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit text-yellow"></i></a>&ensp;
                            <a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this data ?');"><i class="fa fa-remove text-red"></i></a>&ensp;
                            <a href="" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;
                        </td>
                        <td><input type="checkbox" class="minimal"></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="add-users" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ADD NEW USERS</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" minlenght="4" maxlength="10">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Password :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="password" class="form-control" name="" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Fullname :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Login :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Pass :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User Group :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'ADMINISTRATOR','N' => 'AGENTS');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User Level :</label>
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
							<label>Active :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control" onChange="change(this);"';
							$drop_down = array('P' => 'YES','Y' => 'NO');
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
<div id="edit-users" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">EDIT USER</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="agent001" readonly>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Password :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="password" class="form-control" name="" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Fullname :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Login :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Pass :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User Group :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'ADMINISTRATOR','N' => 'AGENTS');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User Level :</label>
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
							<label>Active :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control" onChange="change(this);"';
							$drop_down = array('P' => 'YES','Y' => 'NO');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
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
    $(function () {
		$('#phones').DataTable({
			"ordering": false,
			"autoWidth": false
		});
	});

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    });

	function nav_active(){
		document.getElementById("set").className = "active";
		document.getElementById("set-user").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>