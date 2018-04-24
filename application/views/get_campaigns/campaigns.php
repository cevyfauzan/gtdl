<div class="pull-right">
    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-camp" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Campaign</a>
</div>
<h4><b>Campaign</b></h4>
<br>
<div class="row">
    <div class="col-sm-12 table-responsive">
        <table id="camp" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Campaign ID</th>
                    <th>Campaign Name</th>
                    <th>Dial Method</th>
                    <th>Status</th>
                    <th width="10%">Action</th>
                    <th width="5%"><input type="checkbox" class="minimal"></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1;$i<15;$i++){ ?>
                <tr>
                    <td>CAMPAIGN<?= $i ?></td>
                    <td>Campaign <?= $i ?></td>
                    <td>Auto Dial</td>
                    <td style="color:green">ACTIVE</td>
                    <td>
                        <a href="" title="Edit" data-toggle="modal" data-target="#edit-camp"><i class="fa fa-edit text-yellow"></i></a>&ensp;
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
<div id="add-camp" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ADD NEW CAMPAIGN</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" id="camID" value="80247862" disabled="disabled">
					</div>
					<div class="col-sm-5">
						<input type="checkbox" id="camE">&ensp;<font color="red">Check to edit campaign id and name</font>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign Name :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="" id="camName" value="Outbound Campaign - 2018-04-10" disabled="disabled">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="1030 >> ListID 1030" readonly>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Country :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="62 >> getdial" readonly>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Check For Duplicate :</label>
						</div>
					</div>
					<div class="col-sm-3">
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
							<label>Dial Method :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control" onChange="change(this);"';
							$drop_down = array('P' => '-- SELECT --','Y' => 'MANUAL','N' => 'AUTO_DIAL','O' => 'PREDICTIVE');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row" id="autoDial" style="display:none">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Auto Dial Level :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'SLOW','N' => 'NORMAL','O' => 'HIGH');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Carrier to this Campaign :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('N' => '2018 - 962 - getdial', 'y' => '2017 - 962 - getdial1');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script :</label>
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
							<label>Campaign Recording :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'ON','N' => 'OFF');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Answering Machine Detection :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'OFF','N' => 'ON');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Local Call Time :</label>
						</div>
					</div>
					<div class="col-sm-5">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '24 Hours - Default 24 Hours Calling','N' => 'N');
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
<div id="edit-camp" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">MODIFY CAMPAIGN : CAMPAIGN1 - CAMPAIGN 1</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						CAMPAIGN1
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="CAMPAIGN 1">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign Description :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="">
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
							$drop_down = array('Y' => 'Y','N' => 'N');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Dial Method :</label>
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
							<label>Auto Dial Level :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'SLOW','N' => 'NORMAL','O' => 'HIGH');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Carrier to this Campaign :</label>
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
							<label>Script :</label>
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
							<label>Campaign Caller ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="4048915588">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign Recording :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'ON','N' => 'OFF');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Answering Machine Detection :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'OFF','N' => 'ON');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Local Call Time :</label>
						</div>
					</div>
					<div class="col-sm-5">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '24 Hours - Default 24 Hours Calling','N' => 'N');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
                </div>
                <center><a href="" class="btn btn-success btn-md">SAVE SETTINGS</a></center>
				<br>
				<legend></legend>
                <center><h4>LISTS WITHIN THIS CAMPAIGN<h4></center>
                <table class="table table-bordered table-striped table_responsive">
                    <thead>
                        <tr>
                            <th>List ID</th>
                            <th>List Name</th>
                            <th>Description</th>
                            <th>Leads Count</th>
                            <th>Active</th>
                            <th>Last Call Date</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1001</td>
                            <td>ListID 1001</td>
                            <td>Outbound ListID</td>
                            <td>4076</td>
                            <td style="color:green">YES&ensp;<input type="checkbox" class="minimal" checked></td>
                            <td>2018-04-08 21:09:43</td>
                            <td><a href="" title="Edit"><i class="fa fa-edit text-yellow"></i></a></td>
                        </tr>
                    </tbody>
                </table>
                <center><a href="" class="btn btn-success btn-sm">SAVE ACTIVE LIST CHANGE</a></center>
                <br>
                <center>This campaign has 1 active lists and 0 inactive lists</center>
                <center>This campaign has 1034 leads in the queue (dial hopper)</center>
                <center><a href="" title="Edit" data-toggle="modal" data-target="#hopper">View leads in the hopper for this campaign</a></center>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Hopper -->
<div id="hopper" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">CURRENT HOPPER LIST : CAMPAIGN1 - CAMPAIGN 1</h4>
			</div>
			<div class="modal-body">
				<table id="tblHopper" class="table table-bordered table-striped table_responsive">
                    <thead>
                        <tr>
                            <th width="5%">Order</th>
                            <th width="7%">LeadID</th>
                            <th width="7%">ListID</th>
                            <th width="20%">Phone Number</th>
                            <th>Name</th>
                            <th width="7%">Status</th>
                            <th width="7%">Count</th>
                            <th width="7%">Source</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php for($i=1;$i<1035;$i++){ ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td>61763</td>
                            <td><?= $i ?></td>
                            <td>087725601381</td>
                            <td>CEVY FAUZAN</td>
                            <td>NEW</td>
                            <td>3</td>
                            <td>N</td>
                        </tr>
						<?php } ?>
                    </tbody>
                </table>
                <div class="row">
					<div class="col-sm-12" >
						<label>Sources :</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-1" align="right"><label>A :</label></div>
					<div class="col-sm-2">Auto-alt-dial</div>
					<div class="col-sm-1" align="right"><label>C :</label></div>
					<div class="col-sm-2">Scheduled Callbacks</div>
					<div class="col-sm-1" align="right"><label>N :</label></div>
					<div class="col-sm-2">New Lead Order</div>
					<div class="col-sm-1" align="right"><label>P:</label></div>
					<div class="col-sm-2">Non Agent Hopper Load</div>
				</div>
                <div class="row">
					<div class="col-sm-1" align="right"><label>Q :</label></div>
					<div class="col-sm-2">No Hpper Queue Insert</div>
					<div class="col-sm-1" align="right"><label>R :</label></div>
					<div class="col-sm-2">Recycled Leads</div>
					<div class="col-sm-1" align="right"><label>S :</label></div>
					<div class="col-sm-2">Standart Hopper Load</div>
				</div>
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
		$('#camp').DataTable({
			"ordering": false,
			"autoWidth": false
		});
		$('#tblHopper').DataTable({
			"ordering": false,
			"searching": false,
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