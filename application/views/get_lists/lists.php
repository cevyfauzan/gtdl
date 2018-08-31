<?php
############################################################################################
####  Name:             	lists.php                                             		####
####  Type:             	ci views - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<script type="text/javascript">
	var save_method;
	var tableList;

	$(document).ready(function() {
		tableList = $('#list').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('lists/lists_list')?>",
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

	function add_list()
	{
		save_method = 'add';
		$('#form-list')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form_list').modal('show');
		$('.modal-title').text('Add New List');
	}

	function edit_list(list_id)
	{
		save_method = 'update';
		$('#form-list')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();

		$.ajax({
			url : "<?php echo site_url('lists/ajax_edit')?>/" + list_id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="list_id"]').val(data.list_id);
				$('[name="list_name"]').val(data.list_name);
				$('[name="list_desc"]').val(data.list_description);
				$('[name="camp_id"]').val(data.campaign_id);
				$('[name="active"]').val(data.active);
				$('#modal_form_list').modal('show');
				$('.modal-title').text('Modify List : ' + data.list_id + ' - ' + data.list_name);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function reload_table_list()
	{
		tableList.ajax.reload();
	}

	function save()
	{
		$('#btnSave').text('SAVING...');
		$('#btnSave').attr('disabled',true);
		var url;

		if(save_method == 'add') {
			url = "<?php echo site_url('lists/ajax_add')?>";
		} else {
			url = "<?php echo site_url('lists/ajax_update')?>";
		}

		var formData = new FormData($('#form-list')[0]);
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
					$('#modal_form_list').modal('hide');
					reload_table_list();
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

	function delete_list(list_id)
	{
		if(confirm('Are you sure you want to delete this list ?'))
		{
			$.ajax({
				url : "<?php echo site_url('lists/ajax_delete')?>/" + list_id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					$('#modal_form_list').modal('hide');
					reload_table_list();
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
			if(confirm('Are you sure delete list '+list_id+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {list_id:list_id},
					url: "<?php echo site_url('lists/ajax_bulk_delete')?>",
					dataType: "JSON",
					success: function(data)
					{
						if(data.status)
						{
							reload_table_list();
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
</script>

<!--======================================================================================================================-->
<div class="pull-right">
    <button class="btn btn-success btn-sm" onclick="add_list()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New List</button>
    <a href="" class="btn btn-info btn-sm" onclick="reload_table()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
    <a href="" class="btn btn-danger btn-sm" onclick="bulk_delete()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
</div>
<h4><b>Show List</b></h4>
<br>
<div class="row">
    <div class="col-sm-12 table-responsive">
        <table id="list" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>List ID</th>
                    <th>List Name</th>
                    <th>Status</th>
					<th>Last Call Date</th>
                    <th>Leads Count</th>
                    <th>Campaign</th>
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
<!-- Modal From List -->
<div id="modal_form_list" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-list">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="list_id" value="<?= $list_id?>" readonly>
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List Name :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="list_name" value="<?= $list_name?>">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>List Description :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="list_desc">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?= form_dropdown('camp_id', $list_camp, '', 'class="form-control"') ?>
						<span class="help-block"></span>
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
