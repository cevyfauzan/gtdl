<?php
############################################################################################
####  Name:             	dispo.php                                             		####
####  Type:             	ci view - administrator                     				####	
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
<script type="text/javascript">
	var save_method;
	var table;
	var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		table = $('#dispo').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('dispo/disposition_list')?>",
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

	function add_dispo()
	{
		save_method = 'add';
		$('#form-dispo')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form').modal('show');
		$('.modal-title').text('Add New Dispo');
		$('[name="status"]').attr('readonly',false);
	}

	function edit_dispo(status)
	{
		save_method = 'update';
		$('#form-dispo')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();

		$.ajax({
			url : "<?php echo site_url('dispo/ajax_edit')?>/" + status,
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
				$('[name="status"]').attr('readonly',true);
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
			url = "<?php echo site_url('dispo/ajax_add')?>";
		} else {
			url = "<?php echo site_url('dispo/ajax_update')?>";
		}

		var formData = new FormData($('#form-dispo')[0]);
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

	function delete_dispo(status)
	{
		if(confirm('Are you sure you want to delete this data ?'))
		{
			$.ajax({
				url : "<?php echo site_url('dispo/ajax_delete')?>/"+status,
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
			if(confirm('Are you sure delete this status '+list_id+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {status:list_id},
					url: "<?php echo site_url('dispo/ajax_bulk_delete')?>",
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
		document.getElementById("data-dispo").className = "active";
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
                <h2 class="box-title"><b>Dispo</b></h2>
				<div class="pull-right">
					<button type="button" class="btn btn-success btn-sm" onclick="add_dispo()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Dispo</button>
					<a href="" class="btn btn-info btn-sm" onclick="reload_table()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
					<a href="" class="btn btn-danger btn-sm" onclick="bulk_delete()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
				</div>
            </div>
            <div class="box-body">
            <table id="dispo" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>Desc</th>
                        <th>Select</th>
                        <th>Human Answer</th>
                        <th>Sale</th>
                        <th>Do Not Call</th>
                        <th>Cust Contact</th>
                        <th>Not Interest</th>
                        <th>Unwork</th>
                        <th>Callback</th>
                        <th>Complete</th>
                        <th width="7%">Action</th>
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
<!-- Modal Dispo -->
<div id="modal_form" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-dispo">
	            <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Status :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="status">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Desc :</label>
						</div>
					</div>
					<div class="col-sm-5">
						<input type="text" class="form-control" name="status_name">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Selectable :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('select', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Human Answer :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('ha', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Sale :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('sale', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Do Not Call :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('dnc', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Customer Contact :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('cc', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Not Interested :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('ni', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Unworkable :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('unwork', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Callback :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('callback', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Completed :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('complete', $drop_down, '', $attr) ?>
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

