<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<!--======================================================================================================================-->
<script type="text/javascript">
	var save_method;
	var table;
	var base_url = '<?php echo base_url();?>';

	$(document).ready(function() {
		table = $('#record').DataTable({ 
			"searching": false,
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('recordings/recording_list')?>",
				"type": "POST",
				"data": function ( data ) {
                data.phone = $('[name="phone"]').val();
                data.awal = $('[name="awal"]').val();
                data.akhir = $('[name="akhir"]').val();
                data.fullname = $('[name="fullname"]').val();
                data.dispo = $('[name="dispo"]').val();
                data.agent = $('[name="agent"]').val();
                data.campaign = $('[name="campaign"]').val();
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

		$('#btn-filter').click(function(){
       		table.ajax.reload();
		});

		$('#btn-reset').click(function(){
			$('#form-filter')[0].reset();
			table.ajax.reload();
		});

		$(".date").datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true
		});

		$("#check-all").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});

	function reload_table()
	{
		table.ajax.reload(null,false);
	}

	function nav_active(){
		document.getElementById("rec").className = "active";
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
                <h2 class="box-title"><b>Recordings</b></h2>
				<div class="pull-right">
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#filter" title="Add"><i class="fa fa-search"></i>&ensp;Filter Recording</a>
					<a href="" class="btn btn-info btn-sm" onclick="reload_table()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
				</div>
            </div>
            <div class="box-body">
            <table id="record" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Call Date</th>
                        <th>Duration</th>
                        <th>Agent</th>
                        <th>Call Disposition</th>
                        <th>Campaign</th>
                        <th>Recordings</th>
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
<!-- Modal Filter -->
<div id="filter" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Filter recordings</h4>
			</div>
			<div class="modal-body">
				<form method="post" accept-charset="utf-8" role="form" id="form-filter">
				<div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Number :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="phone">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Call Date :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control date" name="awal" value="<?php echo date('Y-m-d'); ?>">
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control date" name="akhir" value="<?php echo date('Y-m-d'); ?>">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="fullname">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Call Dispo :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?php 
							$attr = 'class="form-control"';
						?>
						<?= form_dropdown('dispo', $list_dispo, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Agent :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?php 
							$attr = 'class="form-control"';
						?>
						<?= form_dropdown('agent', $list_agent, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Campaign :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?php 
							$attr = 'class="form-control"';
						?>
						<?= form_dropdown('campaign', $list_camp, '', $attr) ?>
					</div>
				</div>
				<br>
               	<center>
					<button type="button" id="btn-filter" class="btn btn-primary" title="Filter" data-dismiss="modal">SEARCH</button>
					<button type="reset" id="btn-reset" class="btn btn-warning" title="Reset">RESET</button>
					<button type="button" class="btn btn-danger" title="Close" data-dismiss="modal">CLOSE</button>
				</center>
				</form>
			</div>
		</div>			
	</div>
</div>
