<?php
############################################################################################
####  Name:             	lead_search.php                                         	####
####  Type:             	ci view - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<script type="text/javascript">
	var save_method;
	var tableLead;
	var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		tableLead = $('#search').DataTable({ 
			"searching": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('lists/lead_list')?>",
				"type": "POST",
				"data": function ( data ) {
					data.phone_number = $('#phone_number').val();
					data.name = $('#name').val();
					data.min_call_date = $('#min_call_date').val();
					data.max_call_date = $('#max_call_date').val();
					data.campaign_id = $('#campaign_id').val();
					data.status = $('#status').val();
					data.user = $('#user').val();
				}
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

		$('#btn-filter').click(function(){ //button filter event click
			tableLead.ajax.reload();  //just reload table
		});
		$('#btn-reset').click(function(){ //button reset event click
			$('#form-filter')[0].reset();
			tableLead.ajax.reload();  //just reload table
		});

		$("input").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("select").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$("#check-all-lead").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});

	function add_lead()
	{
		save_method = 'add';
		$('#form-lead')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#hidden').hide();
		$('[name="list_id"]').attr('disabled',false);
		$('#modal_form_lead').modal('show');
		$('.modal-title').text('Add New Lead');
	}

	function edit_lead(lead_id)
	{
		save_method = 'update';
		$('#form-lead')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();

		$.ajax({
			url : "<?php echo site_url('lists/ajax_edit_lead')?>/" + lead_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="lead_id"]').val(data.lead_id).attr('readonly',true);
				$('[name="camp_id"]').val(data.campaign_id).attr('readonly',true);
				$('[name="list_id"]').val(data.list_id).attr('disabled',true);
				$('[name="first_name"]').val(data.first_name);
				$('[name="address1"]').val(data.address1);
				$('[name="address2"]').val(data.address2);
				$('[name="city"]').val(data.city);
				$('[name="zip"]').val(data.postal_code);
				$('[name="dob"]').val(data.date_of_birth);
				$('[name="phone_number"]').val(data.phone_number);
				$('[name="email"]').val(data.email);
				$('[name="dispo"]').val(data.status);
				$('[name="user"]').val(data.user);
				$('[name="notes"]').val(data.notes);
				$('#hidden').show();
				$('#modal_form_lead').modal('show');
				$('.modal-title').text('Modify Lead : ' + data.lead_id + ' - ' + data.first_name);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table_lead()
	{
		tableLead.ajax.reload(null,false);
	}

	function save_lead()
	{
		$('#bntSaveLead').text('SAVING...');
		$('#bntSaveLead').attr('disabled',true);
		var url;

		if(save_method == 'add') {
			url = "<?php echo site_url('lists/ajax_add_lead')?>";
		} else {
			url = "<?php echo site_url('lists/ajax_update_lead')?>";
		}

		var formDataLead = new FormData($('#form-lead')[0]);
		$.ajax({
			url : url,
			type: "POST",
			data: formDataLead,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status)
				{
					$('#modal_form_lead').modal('hide');
					reload_table_lead();
				}
				else
				{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
					}
				}
				$('#bntSaveLead').text('SUBMIT');
				$('#bntSaveLead').attr('disabled',false);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding / update data');
				$('#bntSaveLead').text('SUBMIT');
				$('#bntSaveLead').attr('disabled',false);
			}
		});
	}

	function delete_lead(lead_id)
	{
		if(confirm('Are you sure you want to delete this lead ?'))
		{
			$.ajax({
				url : "<?php echo site_url('lists/ajax_delete_lead')?>/"+lead_id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					$('#modal_form_lead').modal('hide');
					reload_table_lead();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}

	function bulk_delete_lead()
	{
		var lead_id = [];
		$(".data-check:checked").each(function() {
			lead_id.push(this.value);
		});
		if(lead_id.length > 0)
		{
			if(confirm('Are you sure delete lead '+lead_id+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {lead_id:lead_id},
					url: "<?php echo site_url('lists/ajax_bulk_delete_lead')?>",
					dataType: "JSON",
					success: function(data)
					{
						if(data.status)
						{
							reload_table_lead();
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

    function onlyNumb(evt) {
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	    return false;
	    return true;
    }
</script>

<!--======================================================================================================================-->
<div class="pull-right">
    <a href="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#add-search" data-backdrop="static" data-keyboard="false" title="Search"><i class="fa fa-search"></i>&ensp;Search Lead</a>
    <button class="btn btn-success btn-sm" onclick="add_lead()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Lead</button>
    <a href="" class="btn btn-info btn-sm" onclick="reload_table_lead()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
    <a href="" class="btn btn-danger btn-sm" onclick="bulk_delete_lead()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
</div>
<h4><b>Show Leads</b></h4>
<br>
<div class="row">
    <div class="col-sm-12 table-responsive">
        <table id="search" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="7%">Lead ID</th>
                    <th>List ID</th>
                    <th>Phone</th>
					<th>Fullname</th>
                    <th>Last Call Date</th>
                    <th>Status</th>
                    <th>Last Agent</th>
                   	<th width="10%">Action</th>
                    <th width="5%"><input type="checkbox" id="check-all-lead"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="add-search" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">LEAD SERACH OPTIONS</h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-filter">
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Number :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="phone_number" minlength="8" maxlength="13" onkeypress="return onlyNumb(event);">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="name">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Call Date :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control date" id="min_call_date">
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control date" id="max_call_date">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Campaign ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?php 
							$attr = 'class="form-control" id="campaign_id"';
						?>
						<?= form_dropdown('', $drop_down_camp, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Dispo :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?php 
							$attr = 'class="form-control" id="status"';
						?>
						<?= form_dropdown('', $drop_down_dispo, 'NEW', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Last Agent :</label>
						</div>
					</div>
					<div class="col-sm-6">
                        <?php 
							$attr = 'class="form-control" id="user"';
							$drop_down = array('' => '-- ALL AGENT --','N' => 'AGENT001');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
				<br>
               	<center>
					<button type="button" id="btn-filter" class="btn btn-primary" title="Filter" data-dismiss="modal">SEARCH</button>
					<button type="button" id="btn-reset" class="btn btn-warning" title="Reset">RESET</button>
					<button type="button" class="btn btn-danger" title="Close" data-dismiss="modal">CLOSE</button>
				</center>
				</form>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Lead -->
<div id="modal_form_lead" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-lead">
				<div id="hidden" style="display:none">
					<div class="row">
						<div class="col-sm-3" align="right">
							<div class="form-group">
								<label>Lead ID :</label>
							</div>
						</div>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="lead_id">
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3" align="right">
							<div class="form-group">
								<label>Campaign :</label>
							</div>
						</div>
						<div class="col-sm-6">
							<input type="text" class="form-control" name="camp_id">
						</div>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>List ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?= form_dropdown('list_id', $drop_down_list, '', 'class="form-control"') ?>
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="first_name">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Address 1 :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="address1">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Address 2 :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="address2">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>City :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="city">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>ZIP :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="zip" maxlength="5" onkeypress="return onlyNumb(event);">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Date Of Birth :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control date" name="dob">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Number :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="phone_number" minlength="8" maxlength="13" onkeypress="return onlyNumb(event);">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Email :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="email" class="form-control" name="email">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Dispo :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?php 
							$attr = 'class="form-control"';
						?>
						<?= form_dropdown('dispo', $drop_down_dispo, 'NEW', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?= form_dropdown('user', $drop_down_user, '', 'class="form-control"') ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Notes :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<textarea class="form-control" name="notes" rows="3"></textarea>
					</div>
				</div>
				<br>
				<center>
					<button id="bntSaveLead" onclick="save_lead()" class="btn btn-success btn-md">SUBMIT</button>&ensp;
					<button class="btn btn-danger btn-md" data-dismiss="modal">CLOSE</button>
				</center>
				</form>
			</div>
		</div>			
	</div>
</div>
