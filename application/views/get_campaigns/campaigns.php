<?php
############################################################################################
####  Name:             	campaigns.php                                             	####
####  Type:             	ci view - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<script type="text/javascript">
	var save_method;
	var tableCamp;
	var tableList;
	var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		tableCamp = $('#camp').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('campaigns/campaign_list')?>",
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
		
		var aaa = document.getElementById("campID").value;
		tableList = $('#tblHopper').DataTable({ 
			"ordering": false,
			"searching": false,
			"autoWidth": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('campaigns/list_camp/')?>" + aaa,
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

		$("input").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("textarea").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("select").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$("#check-all").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});

	function add_camp()
	{
		save_method = 'add';
		$('#form-camp')[0].reset();
		$('.row').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form_camp').modal('show');
		$('#list_camp').hide();
		$('.modal-title').text('Add New Campaign');
		$('[name="camp_id"]').attr('readonly',false);
	}

	function edit_camp(campaign_id)
	{
		save_method = 'update';
		$('#form-camp')[0].reset();
		$('.row').removeClass('has-error');
		$('.help-block').empty();

		$.ajax({
			url : "<?php echo site_url('campaigns/ajax_edit')?>/" + campaign_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="camp_id"]').val(data.campaign_id);
				$('[name="camp_name"]').val(data.campaign_name);
				$('[name="camp_desc"]').val(data.campaign_description);
				$('[name="camp_carrier"]').val(data.dial_prefix);
				$('[name="active"]').val(data.active);
				$('[name="dial_method"]').val(data.dial_method);
				$('[name="auto_dial_level"]').val(data.auto_dial_level);
				$('[name="camp_cid"]').val(data.campaign_cid);
				$('[name="camp_rec"]').val(data.campaign_recording);
				$('[name="amd"]').val(data.campaign_vdad_exten);
				$('[name="camp_script"]').val(data.campaign_script);
				$('[name="call_time"]').val(data.local_call_time);
				$('[name="camp_id"]').attr('readonly',true);
				$('[name="camp_name"]').attr('required',true);
				$('#list_camp').show();
				$('#modal_form_camp').modal('show');
				$('.modal-title').text('Modify Campaign : ' + data.campaign_id + ' - ' + data.campaign_name);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function info_camp(campaign_id)
	{
		$('.row').removeClass('has-error');
		$('.help-block').empty();
		$.ajax({
			url : "<?php echo site_url('campaigns/ajax_edit')?>/" + campaign_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="camp_id"]').val(data.campaign_id);
				$('[name="camp_name"]').val(data.campaign_name);
				$('[name="camp_desc"]').val(data.campaign_description);
				$('[name="active"]').val(data.active);
				$('[name="dial_method"]').val(data.dial_method);
				$('[name="auto_dial_level"]').val(data.auto_dial_level);
				$('[name="camp_cid"]').val(data.campaign_cid);
				$('[name="camp_rec"]').val(data.campaign_recording);
				$('[name="amd"]').val(data.campaign_vdad_exten);
				$('[name="camp_script"]').val(data.campaign_script);
				$('[name="call_time"]').val(data.local_call_time);
				$('#info-camp').modal('show');
				$('.modal-title').text('Info Campaign : ' + data.campaign_id + ' - ' + data.campaign_name);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table_camp()
	{
		tableCamp.ajax.reload();
	}

	function save()
	{
		$('#btnSave').text('SAVING...');
		$('#btnSave').attr('disabled',true);
		var url;

		if(save_method == 'add') {
			url = "<?php echo site_url('campaigns/ajax_add')?>";
		} else {
			url = "<?php echo site_url('campaigns/ajax_update')?>";
		}

		var formData = new FormData($('#form-camp')[0]);
		$.ajax({
			url : url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status)
				{
					$('#modal_form_camp').modal('hide');
					reload_table_camp();
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

	function delete_camp(campaign_id)
	{
		if(confirm('Are you sure you want to delete this campaign ?'))
		{
			$.ajax({
				url : "<?php echo site_url('campaigns/ajax_delete')?>/"+campaign_id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					$('#modal_form_camp').modal('hide');
					reload_table_camp();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}

	function bulk_delete()
	{
		var list_id = [];
		$(".data-check:checked").each(function() {
				list_id.push(this.value);
		});
		if(list_id.length > 0)
		{
			if(confirm('Are you sure delete campaign '+list_id+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {camp_id:list_id},
					url: "<?php echo site_url('campaigns/ajax_bulk_delete')?>",
					dataType: "JSON",
					success: function(data)
					{
						if(data.status)
						{
							reload_table_camp();
						}
						else
						{
							alert('Failed.');
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error deleting data');
					}
				});
			}
		}
		else
		{
			alert('No data selected');
		}
	}

	function change(b){
		var id = b.value;
		if(id == 'Y' || id == 'MANUAL'){
			$('#autoDial').hide();
		}else{
			$('#autoDial').show();
		}
	}
</script>

<!--======================================================================================================================-->
<div class="pull-right">
    <button class="btn btn-success btn-sm" onclick="add_camp()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Campaign</button>
    <a href="" class="btn btn-info btn-sm" onclick="reload_table_camp()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
    <a href="" class="btn btn-danger btn-sm" onclick="bulk_delete()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
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
                    <th width="5%"><input type="checkbox" id="check-all"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Campaign -->
<div id="modal_form_camp" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-camp">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="camp_id" id="campID" maxlength="8">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign Name :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="camp_name">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign Description :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="camp_desc">
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
						<?= form_dropdown('active', $drop_down, '', $attr) ?>
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
							$drop_down = array('MANUAL' => 'MANUAL','RATIO' => 'AUTO_DIAL','ADAPT_AVERAGE' => 'PREDICTIVE');
						?>
						<?= form_dropdown('dial_method', $drop_down, '', $attr) ?>
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
							$drop_down = array('0' => 'OFF','1.0' => 'SLOW','2.0' => 'NORMAL', '4.0' => 'HIGH','6.0' => 'MAX','ADVANCE' => 'ADVANCE');
						?>
						<?= form_dropdown('auto_dial_level', $drop_down, '', $attr) ?>
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
						//$dial_prefix["--CUSTOM--"] = "CUSTOM DIAL PREFIX";
						$attr = 'class="form-control"';
						$selected_prefix = "";
						foreach ($carrier_info as $id => $carrier)
						{
							$prefix = str_replace("N","",str_replace("X","",$carrier['prefix']));
							if (strlen($prefix) > 0)
							{
								$dial_prefix[$prefix] = "$id - $prefix - {$carrier['carrier_name']}";
							}
						}
						?>
						<?= form_dropdown('camp_carrier', $dial_prefix,$selected_prefix, $attr) ?>
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
						?>
						<?= form_dropdown('camp_script', $list_script, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign Caller ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="camp_cid" value="4048915588">
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
							$drop_down = array('ALLFORCE' => 'ON','NEVER' => 'OFF');
						?>
						<?= form_dropdown('camp_rec', $drop_down, '', $attr) ?>
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
							$drop_down = array('8368' => 'OFF','8369' => 'ON');
						?>
						<?= form_dropdown('amd', $drop_down, '', $attr) ?>
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
						?>
						<?= form_dropdown('call_time', $list_call_time, '', $attr) ?>
					</div>
                </div>
				<br>
				<center>
					<button id="btnSave" onclick="save()" class="btn btn-success btn-md">SUBMIT</button>&ensp;
					<button class="btn btn-danger btn-md" data-dismiss="modal">CLOSE</button>
				</center>
				</form>
				<div id="list_camp">
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
				</div>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Info -->
<form action="#" id="form-info">
<div id="info-camp" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></label></h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign ID :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="camp_id" id="campID" readonly>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign Name :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="camp_name">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign Description :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="camp_desc">
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
						<?= form_dropdown('active', $drop_down, '', $attr) ?>
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
							$drop_down = array('MANUAL' => 'MANUAL','RATIO' => 'AUTO_DIAL','ADAPT_AVERAGE' => 'PREDICTIVE');
						?>
						<?= form_dropdown('dial_method', $drop_down, '', $attr) ?>
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
							$drop_down = array('0' => 'OFF','1.0' => 'SLOW','2.0' => 'NORMAL', '4.0' => 'HIGH','6.0' => 'MAX','ADVANCE' => 'ADVANCE');
						?>
						<?= form_dropdown('auto_dial_level', $drop_down, '', $attr) ?>
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
						<?= form_dropdown('camp_carrier', $drop_down, '', $attr) ?>
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
						?>
						<?= form_dropdown('camp_script', $list_script, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign Caller ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="camp_cid">
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
							$drop_down = array('ALLFORCE' => 'ON','NEVER' => 'OFF');
						?>
						<?= form_dropdown('camp_rec', $drop_down, '', $attr) ?>
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
							$drop_down = array('8368' => 'OFF','8369' => 'ON');
						?>
						<?= form_dropdown('amd', $drop_down, '', $attr) ?>
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
						?>
						<?= form_dropdown('call_time', $list_call_time, '', $attr) ?>
					</div>
                </div>
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
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1001</td>
                            <td>ListID 1001</td>
                            <td>Outbound ListID</td>
                            <td>4076</td>
                            <td style="color:green">YES</td>
                            <td>2018-04-08 21:09:43</td>
                        </tr>
                    </tbody>
                </table>
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
				<h4 class="modal-title">CURRENT HOPPER LIST : <label for="camp_id"></label> - <label for="camp_name"></label></h4>
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
                        </tr>
                    </thead>
                    <tbody>
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
</form>
