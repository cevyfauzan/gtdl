<?php
############################################################################################
####  Name:             	server.php                                             		####
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
<script type="text/javascript">
	var save_method;
	var tableServ;

	$(document).ready(function() {
		tableServ = $('#server').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('server/server_list')?>",
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
		$("select").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});

		$("#check-all").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});

	function add_server()
	{
		save_method = 'add';
		$('#form-server')[0].reset();
		$('.row').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form_server').modal('show');
		$('#adv_server').hide();
		$('.modal-title').text('Add New Server');
		$('[name="server_id"]').attr('readonly',false);
	}

	function edit_server(server_id)
	{
		save_method = 'update';
		$('#form-server')[0].reset();
		$('.row').removeClass('has-error');
		$('.help-block').empty();

		$.ajax({
			url : "<?php echo site_url('server/ajax_edit')?>/" + server_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="server_id"]').val(data.server_id);
				$('[name="server_name"]').val(data.server_description);
				$('[name="server_ip"]').val(data.server_ip);
				$('[name="active"]').val(data.active);
				$('[name="ast_ver"]').val(data.asterisk_version);
				$('[name="user_group"]').val(data.user_group);
				$('[name="max_trunk"]').val(data.max_vicidial_trunks);
				$('[name="max_call"]').val(data.outbound_calls_per_second);
				$('[name="rec_limit"]').val(data.vicidial_recording_limit);
				$('[name="server_id"]').attr('readonly',true);
				$('#adv_server').show();
				$('#modal_form_server').modal('show');
				$('.modal-title').text('Modify server : ' + data.server_id + ' - ' + data.server_ip);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	/*function info_server(server_id)
	{
		$('.row').removeClass('has-error');
		$('.help-block').empty();
		$.ajax({
			url : "<?php echo site_url('server/ajax_edit')?>/" + server_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="server_id"]').val(data.server_id);
				$('[name="server_name"]').val(data.server_description);
				$('[name="server_ip"]').val(data.server_ip);
				$('[name="active"]').val(data.active);
				$('[name="ast_ver"]').val(data.asterisk_version);
				$('[name="user_group"]').val(data.user_group);
				$('[name="max_trunk"]').val(data.max_vicidial_trunks);
				$('[name="max_call"]').val(data.outbound_calls_per_second);
				$('[name="rec_limit"]').val(data.vicidial_recording_limit);
				$('#info_server').modal('show');
				$('.modal-title').text('Info server : ' + data.server_id + ' - ' + data.server_ip);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}*/

	function reload_table_server()
	{
		tableServ.ajax.reload();
	}

	function save()
	{
		$('#btnSave').text('SAVING...');
		$('#btnSave').attr('disabled',true);
		var url;

		if(save_method == 'add') {
			url = "<?php echo site_url('server/ajax_add')?>";
		} else {
			url = "<?php echo site_url('server/ajax_update')?>";
		}

		var formData = new FormData($('#form-server')[0]);
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
					$('#modal_form_server').modal('hide');
					reload_table_server();
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

	function delete_server(server_id)
	{
		if(confirm('Are you sure you want to delete this server ?'))
		{
			$.ajax({
				url : "<?php echo site_url('server/ajax_delete')?>/"+server_id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					$('#modal_form_server').modal('hide');
					reload_table_server();
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
			if(confirm('Are you sure delete server '+list_id+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {server_id:list_id},
					url: "<?php echo site_url('server/ajax_bulk_delete')?>",
					dataType: "JSON",
					success: function(data)
					{
						if(data.status)
						{
							reload_table_server();
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

	function nav_active(){
		document.getElementById("set").className = "active";
		document.getElementById("set-server").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
			<div class="box-header">
                <h2 class="box-title"><b>Servers</b></h2>
				<div class="pull-right">
					<div class="pull-right">
						<button class="btn btn-success btn-sm" onclick="add_server()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Server</button>
						<a href="" class="btn btn-info btn-sm" onclick="reload_table_server()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
						<a href="" class="btn btn-danger btn-sm" onclick="bulk_delete()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
					</div>
				</div>
            </div>
            <div class="box-body">
            <table id="server" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Server ID</th>
                        <th>Server Name</th>
                        <th>Server IP</th>
                        <th>Status</th>
                        <th>Asterisk</th>
                        <th>GMT</th>
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
<div id="modal_form_server" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-server">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="server_id" maxlength="8">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server Name :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="server_name">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server IP :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="server_ip">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Asterisk Version :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="ast_ver">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>User Group :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
							$drop_down = array('---ALL---' => 'All User Groups','administrations' => 'Administrators','agents' => 'Agents');
						?>
						<?= form_dropdown('user_group', $drop_down, '', 'class="form-control"') ?>
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
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('active', $drop_down, '', 'class="form-control"') ?>
					</div>
				</div>
				<div id="adv_server">
					<div class="row">
						<div class="col-sm-4" align="right">
							<div class="form-group">
								<label>Max Trunks :</label>
							</div>
						</div>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="max_trunk" onkeypress="return onlyNumb(event);" maxlength="3">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4" align="right">
							<div class="form-group">
								<label>Max Call per Second :</label>
							</div>
						</div>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="max_call" onkeypress="return onlyNumb(event);" maxlength="3">
							<span class="help-block"></span>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4" align="right">
							<div class="form-group">
								<label>Recording Limit :</label>
							</div>
						</div>
						<div class="col-sm-3">
							<input type="text" class="form-control" name="rec_limit" onkeypress="return onlyNumb(event);" maxlength="3">
							<span class="help-block"></span>
						</div>
						<div class="col-sm-2">
							<label>Minutes</label>
						</div>
					</div>
				</div>
				<br>
				<center>
					<button id="btnSave" onclick="save()" class="btn btn-success btn-md">SUBMIT</button>&ensp;
					<button class="btn btn-danger btn-md" data-dismiss="modal">CLOSE</button>
				</center>
				</form>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Info -->
<!--<div id="info_server" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="server_id">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server Name :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="server_description">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server IP :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="server_ip">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Asterisk Version :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="ast_ver">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Max Trunk :</label>
						</div>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="max_trunk">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Max Call per Second :</label>
						</div>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="max_call">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Recording Limit :</label>
						</div>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="rec_limit">
					</div>
					<div class="col-sm-2">
						<label>Minutes</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>User Group :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
							$drop_down = array('---ALL---' => 'All User Groups','administrations' => 'Administrators','agents' => 'Agents');
						?>
						<?= form_dropdown('user_group', $drop_down, '', 'class="form-control"') ?>
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
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('active', $drop_down, '', 'class="form-control"') ?>
					</div>
				</div>
				<br>
				<center>
					<button class="btn btn-danger btn-md" data-dismiss="modal">CLOSE</button>
				</center>
				<br>
				<legend></legend>
				<div class="row">
					<div class="col-md-12">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs" id="serverTabs">
								<li class="active"><a href="#tab_1" data-toggle="tab">Carriers Within this Server</a></li>
								<li><a href="#tab_2" data-toggle="tab">Phones Within this Server</a></li>
								<li><a href="#tab_3" data-toggle="tab">Conferences Within this Server</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1">
									<table id="carrier_server" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Carrier ID</th>
												<th>Carrier Name</th>
												<th>Server IP</th>
												<th>Protocol</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tab_2">
									<table id="phone_server" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Extension</th>
												<th>Server IP</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
								<div class="tab-pane" id="tab_3">
									<table id="conf_server" class="table table-bordered table-striped">
										<thead>
											<tr>
												<th>Conf Exten</th>
												<th>Server IP</th>
												<th>Extension</th>
											</tr>
										</thead>
										<tbody>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>
</div>-->
