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
<div class="pull-right">
    <button class="btn btn-success btn-sm" onclick="add_camp()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Campaign</button>
    <a href="" class="btn btn-info btn-sm" onclick="reload_table()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
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
<!-- Modal Add -->
<div id="add-camp" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ADD NEW CAMPAIGN</h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-add">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="camp_id" id="camID" value="80247862" disabled="disabled">
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
						<input type="text" class="form-control" name="camp_name" id="camName" value="Outbound Campaign - 2018-04-10" disabled="disabled">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="list_id" value="1030 >> ListID 1030" readonly>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Country :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="country" value="62 >> getdial" readonly>
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
						<?= form_dropdown('check_dup', $drop_down, '', $attr) ?>
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
							$drop_down = array('P' => '-- SELECT --','MANUAL' => 'MANUAL','RATIO' => 'AUTO_DIAL','ADAPT_AVERAGE' => 'PREDICTIVE');
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
							$attr = 'class="form-control"';
							$drop_down = array('N' => '2018 - 962 - getdial', 'y' => '2017 - 962 - getdial1');
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
                <center><a href="" class="btn btn-success btn-md">SUBMIT</a></center>
				</form>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Edit -->
<div id="edit-camp" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<form action="#" id="form-edit">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">MODIFY CAMPAIGN : <label for="camp_id"></label> - <label for="camp_name"></label></h4>
			</div>
			<div class="modal-body">
				
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign ID :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="camp_id" value="CAMPAIGN 1" readonly>
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
			</form>
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
	var save_method;
	var table;
	var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		table = $('#camp').DataTable({ 
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

		table = $('#tblHopper').DataTable({ 
			"ordering": false,
			"searching": false,
			"autoWidth": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('List/campaign_hopper')?>",
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

		//set input/textarea/select event when change value, remove class error and remove text help block 
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

		//check all
		$("#check-all").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});

	});

	function add_camp()
	{
		save_method = 'add';
		$('#form-add')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string
		$('#add-camp').modal('show'); // show bootstrap modal
		//$('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title
	}

	function edit_camp(campaign_id)
	{
		save_method = 'update';
		$('#form-edit')[0].reset(); // reset form on modals
		$('.form-group').removeClass('has-error'); // clear error class
		$('.help-block').empty(); // clear error string

		//Ajax Load data from ajax
		$.ajax({
			url : "<?php echo site_url('campaigns/campaign_edit')?>/" + campaign_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('label[for="camp_id"]').html(data.campaign_id);
				$('label[for="camp_name"]').html(data.campaign_name);
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
				$('#edit-camp').modal('show');
				//$('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table()
	{
		table.ajax.reload(null,false); //reload datatable ajax 
	}

	function save()
	{
		$('#btnSave').text('saving...'); //change button text
		$('#btnSave').attr('disabled',true); //set button disable 
		var url;

		if(save_method == 'add') {
			url = "<?php echo site_url('person/ajax_add')?>";
		} else {
			url = "<?php echo site_url('person/ajax_update')?>";
		}

		// ajax adding data to database
		var formData = new FormData($('#form')[0]);
		$.ajax({
			url : url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status) //if success close modal and reload ajax table
				{
					$('#modal_form').modal('hide');
					reload_table();
				}
				else
				{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); //select parent twice to select div form-group class and add has-error class
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]); //select span help-block class set text error string
					}
				}
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable 
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding / update data');
				$('#btnSave').text('save'); //change button text
				$('#btnSave').attr('disabled',false); //set button enable 

			}
		});
	}

	function delete_person(id)
	{
		if(confirm('Are you sure delete this data?'))
		{
			// ajax delete data to database
			$.ajax({
				url : "<?php echo site_url('person/ajax_delete')?>/"+id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					//if success reload ajax table
					$('#modal_form').modal('hide');
					reload_table();
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
			if(confirm('Are you sure delete this '+list_id.length+' data?'))
			{
				$.ajax({
					type: "POST",
					data: {id:list_id},
					url: "<?php echo site_url('person/ajax_bulk_delete')?>",
					dataType: "JSON",
					success: function(data)
					{
						if(data.status)
						{
							reload_table();
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

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    });

	$('#camE').change(function() {
		$('#camID').attr('disabled',!this.checked),
		$('#camName').attr('disabled',!this.checked)
	});
</script>