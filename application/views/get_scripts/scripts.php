<?php
############################################################################################
####  Name:             	scripts.php                                             	####
####  Type:             	ci views - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>


<!--======================================================================================================================-->
<script type="text/javascript">
	var save_method;
	var table;

	$(document).ready(function() {
		table = $('#scripts').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('scripts/script_list')?>",
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

	function add_script()
	{
		save_method = 'add';
		$('#form-script')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form').modal('show');
		$('.modal-title').text('Add New Script');
		$('[name="script_id"]').attr('readonly',false);
	}

	function edit_script(script_id)
	{
		save_method = 'update';
		$('#form-script')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();

		$.ajax({
			url : "<?php echo site_url('scripts/ajax_edit')?>/" + script_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="script_id"]').val(data.script_id);
				$('[name="script_name"]').val(data.script_name);
				$('[name="script_comments"]').val(data.script_comments);
				$('[name="active"]').val(data.active);
				$('[name="script_text"]').val(data.script_text);
				$('[name="script_id"]').attr('readonly',true);
				$('#modal_form').modal('show');
				$('.modal-title').text('Modify Script');
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
			url = "<?php echo site_url('scripts/ajax_add')?>";
		} else {
			url = "<?php echo site_url('scripts/ajax_update')?>";
		}

		var formData = new FormData($('#form-script')[0]);
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

	function delete_script(script_id)
	{
		if(confirm('Are you sure you want to delete this data ?'))
		{
			$.ajax({
				url : "<?php echo site_url('scripts/ajax_delete')?>/"+script_id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					reload_table();
					$('#modal_form').modal('hide');
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
			if(confirm('Are you sure delete this script '+list_id+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {script_id:list_id},
					url: "<?php echo site_url('scripts/ajax_bulk_delete')?>",
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

	function nav_active(){
		document.getElementById("data").className = "active";
		document.getElementById("data-script").className = "active";
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
                <h2 class="box-title"><b>Scripts</b></h2>
				<div class="pull-right">
					<?php if($this->session->userdata('allow_add') == 'Y'){?>
					<button type="button" class="btn btn-success btn-sm" onclick="add_script()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Script</button>
					<?php } ?>
					<a href="" class="btn btn-info btn-sm" onclick="reload_table()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
					<?php if($this->session->userdata('allow_delete') == 'Y'){?>
					<a href="" class="btn btn-danger btn-sm" onclick="bulk_delete()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
					<?php } ?>
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
<!-- Modal Script -->
<div id="modal_form" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-script">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="script_id">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script Name :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="script_name">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Script Comments :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="script_comments">
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
						<?= form_dropdown('active', $drop_down, '', $attr) ?>
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
                       <textarea class="form-control" name="script_text" rows="10"></textarea>
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
