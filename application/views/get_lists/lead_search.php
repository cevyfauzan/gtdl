<script type="text/javascript">
	var save_method;
	var table;

	$(document).ready(function() {
		table = $('#search').DataTable({ 
			"ordering": false,
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
					//data.campaign_id = $('#campaign_id').val();
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
			table.ajax.reload();  //just reload table
		});
		$('#btn-reset').click(function(){ //button reset event click
			$('#form-filter')[0].reset();
			table.ajax.reload();  //just reload table
		});

		$("#check-all").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});
</script>

<!--======================================================================================================================-->
<div class="pull-right">
    <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-search" data-backdrop="static" data-keyboard="false" title="Add"><i class="fa fa-search"></i>&ensp;Search Lead</a>
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
                    <th width="5%"><input type="checkbox" class="minimal"></th>
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
				<form role="form" id="form-filter" method="post">
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Number :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="phone_number" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" id="name" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Call Date :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control date" id="min_call_date" value="">
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control date" id="max_call_date" value="">
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
						<?= form_dropdown('', $drop_down_dispo, '', $attr) ?>
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

<!-- Modal Edit -->
<div id="edit-lead" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">LEAD INFORMATION</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Lead ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<b>2</b>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>LIst ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<b>101</b>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="CEVY FAUZAN">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Address :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="PASAR MINGGU">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>City :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="JAKARTA">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>ZIP :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="12530">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Date Of Birth :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control date" name="" value="01-08-1995">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Number :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="087725601381">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Email :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="CEVYFAUZAN@GMAIL.COM">
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
							$drop_down = array('Y' => 'NEW','N' => 'BUSY');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Comment :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<textarea class="form-control" name="" id="" rows="3"></textarea>
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SUBMIT</a></center>
			</div>
		</div>			
	</div>
</div>
