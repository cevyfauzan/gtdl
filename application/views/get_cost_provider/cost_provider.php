<?php
############################################################################################
####  Name:             	cost_provider.php                                           ####
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

<!--======================================================================================================================-->
<script type="text/javascript">
	var save_method;
	var table;
	var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		table = $('#cost_provider').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('cost_provider/provider_list')?>",
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

		$("#check-all").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});

	function add_ct()
	{
		save_method = 'add';
		$('#form-cost')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#modal_form').modal('show');
		$('.modal-title').text('Add New Provider');
	}

	function edit_ct(id)
	{
		save_method = 'update';
		$('#form-cost')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();

		$.ajax({
			url : "<?php echo site_url('cost_provider/ajax_edit')?>/" + id,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				$('[name="provider"]').val(data.provider);
				$('[name="prefix"]').val(data.prefix);
				$('[name="cost_sec"]').val(data.cost_sec);
				$('#modal_form').modal('show');
				$('.modal-title').text('Modify Provider');
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
			url = "<?php echo site_url('cost_provider/ajax_add')?>";
		} else {
			url = "<?php echo site_url('cost_provider/ajax_update')?>";
		}

		var formData = new FormData($('#form-cost')[0]);
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

	function delete_ct(id)
	{
		if(confirm('Are you sure you want to delete this data ?'))
		{
			$.ajax({
				url : "<?php echo site_url('cost_provider/ajax_delete')?>/"+id,
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
			if(confirm('Are you sure delete this call time '+list_id+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {id:list_id},
					url: "<?php echo site_url('cost_provider/ajax_bulk_delete')?>",
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

	function onlyNumb(evt) {
		var charCode = (evt.which) ? evt.which : event.keyCode
		    if (charCode > 31 && (charCode < 48 || charCode > 57))
		    return false;
		    return true;
    }

	function nav_active(){
		document.getElementById("set").className = "active";
		document.getElementById("set-cost_provider").className = "active";
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
                <h2 class="box-title"><b>Cost Provider</b></h2>
				<div class="pull-right">
					<?php if($this->session->userdata('allow_add') == 'Y'){?>
					<button type="button" class="btn btn-success btn-sm" onclick="add_ct()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Provider</button>
					<?php } ?>
					<a href="" class="btn btn-info btn-sm" onclick="reload_table()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
					<?php if($this->session->userdata('allow_delete') == 'Y'){?>
					<a href="" class="btn btn-danger btn-sm" onclick="bulk_delete()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
					<?php } ?>
				</div>
            </div>
            <div class="box-body">
            <table id="cost_provider" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Provider</th>
                        <th>Prefix</th>
                        <th>Cost / sec</th>
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
<!-- Modal Call Time -->
<div id="modal_form" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-cost">
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Provider :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="provider">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Prefix :</label>
						</div>
					</div>
					<div class="col-sm-7">
						<input type="text" class="form-control" name="prefix">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Cost / sec :</label>
						</div>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="cost_sec" onkeypress="return onlyNumb(event);">
						<span class="help-block"></span>
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
