<?php
############################################################################################
####  Name:             	user_group.php                                             	####
####  Type:             	ci views - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
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

	function add_group()
	{
		save_method = 'add';
		$('#form-user_group')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form').modal('show');
		$('.modal-title').text('Add New User Group');
		$('[name="user_group"]').attr('readonly',false);
	}

	function edit_group(status)
	{
		save_method = 'update';
		$('#form-user_group')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();

		$.ajax({
			url : "<?php echo site_url('user_groups/ajax_edit')?>/" + status,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="status"]').val(data.status);
				$('[name="status_name"]').val(data.status_name);
				$('[name="select"]').val(data.selectable);
				$('[name="ha"]').val(data.human_answered);
				$('[name="sale"]').val(data.sale);
				$('[name="dnc"]').val(data.dnc);
				$('[name="cc"]').val(data.customer_contact);
				$('[name="ni"]').val(data.not_interested);
				$('[name="unwork"]').val(data.unworkable);
				$('[name="callback"]').val(data.scheduled_callback);
				$('[name="complete"]').val(data.completed);
				$('[name="user_group"]').attr('readonly',true);
				$('#modal_form').modal('show');
				$('.modal-title').text('Modify Dispo');
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from database');
			}
		});
	}

	function reload_table()
	{
		table.ajax.reload(null,false);
	}

	function save()
	{
		$('#btnSave').text('SAVING...');
		$('#btnSave').attr('disabled',true);
		var url;

		if(save_method == 'add') {
			url = "<?php echo site_url('user_groups/ajax_add')?>";
		} else {
			url = "<?php echo site_url('user_groups/ajax_update')?>";
		}

		var formData = new FormData($('#form-user_group')[0]);
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
					$('#modal_form').modal('hide');
					reload_table();
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

	function delete_group(user_group)
	{
		if(confirm('Are you sure you want to delete this data ?'))
		{
			$.ajax({
				url : "<?php echo site_url('user_groups/ajax_delete')?>/"+user_group,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
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
			if(confirm('Are you sure delete this status '+list_id+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {status:list_id},
					url: "<?php echo site_url('user_groups/ajax_bulk_delete')?>",
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

	function change(a){
		var type = a.value;
		if(type == 'ADMINISTRATORS'){
			$('#hidden').show();
		}else{
			$('#hidden').hide();
		}
	}

	function nav_active(){
		document.getElementById("set").className = "active";
		document.getElementById("set-group").className = "active";
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
                <h2 class="box-title"><b>User Groups</b></h2>
				<div class="pull-right">
					<button type="button" class="btn btn-success btn-sm" onclick="add_group()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New User Group</button>
					<a href="" class="btn btn-info btn-sm" onclick="reload_table()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
					<a href="" class="btn btn-danger btn-sm" onclick="bulk_delete()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
				</div>
            </div>
            <div class="box-body">
            <table id="group" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User Group</th>
                        <th>Group Name</th>
                        <th>Access</th>
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
<div id="modal_form" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-user_group">
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User Group :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="user_group">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Group Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="group_name">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User Type :</label>
						</div>
					</div>
					<div class="col-sm-6">
                        <?php 
							$attr = 'class="form-control" onChange="change(this);"';
							$drop_down = array('ADMINISTRATORS' => 'ADMINISTRATORS','AGENTS' => 'AGENTS');
						?>
						<?= form_dropdown('user_type', $drop_down, '', $attr) ?>
					</div>
				</div>
				<div id="hidden">
					<div class="row">
						<div class="col-sm-3" align="right">
							<div class="form-group">
								<label>Permission :</label>
							</div>
						</div>
						<div class="col-sm-9">
							<label>
								<input type="checkbox" name="a_add"> Allow Add&ensp;&ensp;
								<input type="checkbox" name="a_modify"> Allow Modify&ensp;&ensp;
								<input type="checkbox" name="a_delete"> Allow Delete
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3" align="right">
							<div class="form-group">
								<label>Menu :</label>
							</div>
						</div>
						<div class="col-sm-3">
							<label>Leads<br>
								├──<input type="checkbox" name="access[]" value="campaigns"> Campaigns<br>
								├──<input type="checkbox" name="access[]" value="dispo"> Dispo<br>
								├──<input type="checkbox" name="access[]" value="lists"> Lists<br>
								└──<input type="checkbox" name="access[]" value="scripts"> Scripts
							</label>
						</div>
						<div class="col-sm-3">
							<label>Setting<br>
								├──<input type="checkbox" name="access[]" value="call-times"> Call Times<br>
								├──<input type="checkbox" name="access[]" value="logs"> Logs<br>
								├──<input type="checkbox" name="access[]" value="user-groups"> User Groups<br>
								└──<input type="checkbox" name="access[]" value="users"> Users
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-3"></div>
						<div class="col-sm-3">
							<label>
								<input type="checkbox" name="access[]" value="recordings"> Recordings<br>
								<input type="checkbox" name="access[]" value="report"> Report<br>
								<input type="checkbox" name="access[]" value="messages"> Messages<br>
							</label>
						</div>
						<div class="col-sm-3">
							<label>After Sales<br>
								├──<input type="checkbox" name="access[]" value="sales"> Sales<br>
								├──<input type="checkbox" name="access[]" value="qc"> Quality Control<br>
								└──<input type="checkbox" name="access[]" value="report-sales"> Report Sales<br>
							</label>
						</div>
					</div>
				</div>
				<br>
				<center>
					<button type="button" id="btnSave" onclick="save()" class="btn btn-success btn-md">SUBMIT</button>&ensp;
					<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">CLOSE</button>
				</center>
				</form>
			</div>
		</div>			
	</div>
</div>