<?php
############################################################################################
####  Name:             	lead_recycling.php                                         	####
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
	var tableRecyc;
	var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		tableRecyc = $('#recyc').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('campaigns/recycle_list')?>",
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

		$("#check-all-recyc").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});
		
	function add_recyc()
	{
		//save_method = 'addRecyc';
		$('#form-add_recyc')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#add-recyc').modal('show');
		$('.modal-title').text('Add New Lead Recycle');
	}

	function edit_recyc(campaign_id)
	{
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		
		$.ajax({
			url : "<?php echo site_url('campaigns/ajax_edit_recycle')?>/" + campaign_id,
			type: "GET",
			dataType: "JSON",
			cache: false,
			success: function(data)
			{
				table_detail(campaign_id);
				$('#lead-recyc').modal('show');
				$('.modal-title').text('Modify Lead Recycle Campaign : ' + campaign_id);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from ajax');
			}
		});
	}

	function table_detail(campaign_id)
	{
				$('#detail_recyc').DataTable({ 
					"info": false,
					"ordering": false,
					"searching": false,
					"paging": false,
					"processing": true,
					"serverSide": true,
					"cache": false,
					"ajax": {
						"url": "<?php echo site_url('campaigns/detail_recycle')?>/" + campaign_id,
						"type": "POST"
					},
				});
	}

	function reload_table_recyc()
	{
		tableRecyc.ajax.reload(null,false);
	}

	function save_recyc()
	{
		$('#btnSaveRecyc').text('SAVING...');
		$('#btnSaveRecyc').attr('disabled',true);
		var url;
		url = "<?php echo site_url('campaigns/ajax_add_recycle')?>";

		var formDataRecyc = new FormData($('#form-add_recyc')[0]);
		$.ajax({
			url : url,
			type: "POST",
			data: formDataRecyc,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status)
				{
					$('#add-recyc').modal('hide');
					reload_table_recyc();
				}
				else
				{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
					}
				}
				$('#btnSaveRecyc').text('SUBMIT');
				$('#btnSaveRecyc').attr('disabled',false);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding data');
				$('#btnSaveRecyc').text('SUBMIT');
				$('#btnSaveRecyc').attr('disabled',false);
			}
		});
	}

	function delete_all_recyc(campaign_id)
	{
		if(confirm('Are you sure you want to delete this recycle ?'))
		{
			$.ajax({
				url : "<?php echo site_url('campaigns/ajax_delete_all_recycle')?>/" + campaign_id,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					reload_table_recyc();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}

	function bulk_delete_all_recyc()
	{
		var list_id = [];
		$(".data-check:checked").each(function() {
				list_id.push(this.value);
		});
		if(list_id.length > 0)
		{
			if(confirm('Are you sure delete selected campaign ?'))
			{
				$.ajax({
					type: "POST",
					data: {camp_id:list_id},
					url: "<?php echo site_url('campaigns/ajax_bulk_delete_all_recycle')?>",
					dataType: "JSON",
					success: function(data)
					{
						if(data.status)
						{
							reload_table_recyc();
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
    <button type="button" class="btn btn-success btn-sm" onclick="add_recyc()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Lead Recycle</button>
    <a href="" class="btn btn-info btn-sm" onclick="reload_table_recyc()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
    <a href="" class="btn btn-danger btn-sm" onclick="bulk_delete_all_recyc()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
</div>
<h4><b>Lead Recycling</b></h4>
<br>
<div class="row">
    <div class="col-sm-12 table-responsive">
        <table id="recyc" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Campaign ID</th>
                    <th>Campaign Name</th>
                    <th>Lead Recycles</th>
                    <th width="10%">Action</th>
                    <th width="5%"><input type="checkbox" id="check-all-recyc"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="add-recyc" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-add_recyc">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<?php 
							$attr = 'class="form-control"';
						?>
                        <?= form_dropdown('camp_id_recyc', $list_camp, '', $attr) ?>
						<span class="help-block"></span>
                    </div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Status :</label>
						</div>
					</div>
					<div class="col-sm-5">
                        <?= form_dropdown('status_recyc', $list_dispo, '', 'class="form-control"') ?>
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Attempt Delay :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="input-group">
							<input type="text" class="form-control" name="a_delay" maxlength="3" onkeypress="return onlyNumb(event);" value="2">
							<div class="input-group-addon">mins</div>
						</div>
						<span class="help-block"></span>
					</div>
					<div class="col-sm-5">
						&ensp;<font color="red">SHOULD BE FROM 2 TO 720 MINS (12 HOURS)</font>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Attempt Maximum :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('1' => '1','2' => '2','3' => '3','4' => '4','5' => '5','6' => '6','7' => '7','8' => '8','9' => '9','10' => '10');
						?>
						<?= form_dropdown('a_max', $drop_down, '', $attr) ?>
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
				<br>
				<center>
					<button type="button" id="btnSaveRecyc" onclick="save_recyc()" class="btn btn-success btn-md">SUBMIT</button>&ensp;
					<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">CLOSE</button>
				</center>
				</form>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Lead Recycle -->
<div id="lead-recyc" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-edit_recyc">
            	<table id="detail_recyc" class="table table-bordered table-striped table_responsive">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Attempt Delay</th>
                            <th>Maximum Attempts</th>
                            <th>Leads at Limits</th>
                            <th>Active</th>
                            <th width="10%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
				</form>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Lead Recycle Detail -->
<div id="lead-recyc-detail" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">LEAD RECYCLING WITHIN THIS CAMPAIGN : CAMPAIGN1, STATUS : NEW</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Status :</label>
						</div>
					</div>
					<div class="col-sm-5">
                        <input type="text" class="form-control" name="" value="NEW" readonly>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Attempt Delay :</label>
						</div>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="">
					</div>
					<div class="col-sm-6">
						&ensp;<font color="red">SHOULD BE FROM 2 TO 720 MINS (12 HOURS)</font>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Attempt Maximum :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '1','N' => '2');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
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
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SUBMIT</a></center>
			</div>
		</div>			
	</div>
</div>
