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
                <h2 class="box-title"><b>Scripts</b></h2>
				<div class="pull-right">
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-script" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Scripts</a>
				</div>
            </div>
            <div class="box-body">
            <table id="scripts" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Script ID</th>
                        <th>Script Name</th>
                        <th>Status</th>
                        <th>Type</th>
                        <th width="10%">Action</th>
                        <th width="5%"><input type="checkbox" class="minimal"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php for($i=1001;$i<1015;$i++){ ?>
                    <tr>
                        <td><?= $i ?></td>
                        <td>Listid <?= $i ?></td>
                        <td style="color:green">ACTIVE</td>
                        <td>Default</td>
                        <td>
                            <a href="" title="Edit" data-toggle="modal" data-target="#edit-script"><i class="fa fa-edit text-yellow"></i></a>&ensp;
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
<div id="add-script" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ADD NEW SCRIPT</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="script001" readonly>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script Name :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script Comments :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="" >
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script Text :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
							$attr = 'class="form-control" onChange="change(this);"';
							$drop_down = array('P' => 'YES','Y' => 'NO');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
					<div class="col-sm-4">
                        <a href="" class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i>&ensp;Insert</a>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-7">
                       <textarea class="form-control" name="" rows="10"></textarea>
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SUBMIT</a></center>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Edit -->
<div id="edit-script" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ADD NEW SCRIPT</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="script001" readonly>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script Name :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script Comments :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="" >
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script Text :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
							$attr = 'class="form-control" onChange="change(this);"';
							$drop_down = array('P' => 'YES','Y' => 'NO');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
					<div class="col-sm-4">
                        <a href="" class="btn btn-primary btn-sm" ><i class="fa fa-plus"></i>&ensp;Insert</a>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4"></div>
					<div class="col-sm-7">
                       <textarea class="form-control" name="" rows="10"></textarea>
                       <a href="" class="btn btn-info btn-sm"><i class="fa fa-eye"></i>&ensp;Preview</a>
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
		$('#scripts').DataTable({
			"ordering": false,
			"autoWidth": false
		});
	});

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    });

	function nav_active(){
		document.getElementById("data").className = "active";
		document.getElementById("data-script").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>