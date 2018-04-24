<div class="pull-right">
    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-list" data-backdrop="static" data-keyboard="false" title="Add"><i class="fa fa-plus"></i>&ensp;Add New List</a>
</div>
<h4><b>Show List</b></h4>
<br>
<div class="row">
    <div class="col-sm-12 table-responsive">
        <table id="list" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>List ID</th>
                    <th>Desciption</th>
                    <th>Status</th>
					<th>Last Call Date</th>
                    <th>Leads Count</th>
                    <th>Campaign</th>
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
                    <td>2018-04-11 20:31:11</td>
                    <td style="color:red">100</td>
                    <td>CAMPAIGN<?= $i ?></td>
                    <td>
                        <a href="" title="Edit" data-toggle="modal" data-target="#edit-list" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit text-yellow"></i></a>&ensp;
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

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="add-list" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ADD NEW LIST</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" id="camID" value="80247862" disabled="disabled">
					</div>
					<div class="col-sm-5">
						<input type="checkbox" id="camE">&ensp;<font color="red">Check to edit list id and name</font>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List Name :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="" id="camName" value="Outbound Campaign - 2018-04-10" disabled="disabled">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List Description :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="" value="1030 >> ListID 1030">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign :</label>
						</div>
					</div>
					<div class="col-sm-5">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'NO DUPLICATE CHECK','N' => 'DUPLICATE FOR THIS CAMPAIGN');
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
<div id="edit-list" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">MODIFY LIST : LISTID 1001</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						1001
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="Listid 1001">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List Description :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign :</label>
						</div>
					</div>
					<div class="col-sm-5">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'CAMPAIGN1','N' => 'CAMPAIGN2');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Reset Time :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'MANUAL','N' => 'AUTO_DIAL','O' => 'PREDICTIVE');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Reset Lead Called Status :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'SLOW','N' => 'NORMAL','O' => 'HIGH');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
					<div class="col-sm-2" align="right">
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
							<label>Agent Script Override :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('N' => '2018 - 962 - getdial', 'Y' => 'NONE');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign CID Override :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'NONE','N' => 'SCRIPT001','O' => 'SCRIPT002');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Web Form :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="4048915588">
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SAVE SETTINGS</a></center>
			</div>
		</div>			
	</div>
</div>

<!--======================================================================================================================-->
<script>
	function change(b){
		var id = b.value;
		if(id == 'Y' || id == 'P'){
			$('#autoDial').hide();
		}else{
			$('#autoDial').show();
		}
	}
    $(function () {
		$('#list').DataTable({
			"ordering": false,
			"autoWidth": false
		});
	});

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    });

	$('#camE').change(function() {
		$('#camID').attr('disabled',!this.checked),
		$('#camName').attr('disabled',!this.checked)
	});
</script>