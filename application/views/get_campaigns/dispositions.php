<div class="pull-right">
    <button class="btn btn-success btn-sm" onclick="add_status()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Status</button>
    <a href="" class="btn btn-info btn-sm" onclick="reload_table()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
    <a href="" class="btn btn-danger btn-sm" onclick="bulk_delete()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
</div>
<h4><b>Disposition</b></h4>
<br>
<div class="row">
    <div class="col-sm-12 table-responsive">
        <table id="disp" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Campaign ID</th>
                    <th>Campaign Name</th>
                    <th>Custom Dispositions</th>
                    <th width="10%">Action</th>
                    <th width="5%"><input type="checkbox" id="check-all-dispo"></th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="add-disp" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:60%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">CREATE NEW STATUS</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Campaign :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
                            $attr = 'class="form-control"';
                            $drop_down = array('Y' => '-- ALL CAMPAIGN --','N' => 'CAMPAIGN1');
                        ?>
                        <?= form_dropdown('', $drop_down, '', $attr) ?>
                    </div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Status :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
					<div class="col-sm-5">
						&ensp;<font color="red">eg. NEW</font>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Status Name :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="">
					</div>
					<div class="col-sm-4">
						&ensp;<font color="red">eg. NEW CAMPAIGN STATUS</font>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Selectable :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Human Answered :</label>
						</div>
					</div>
					<div class="col-sm-3">
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

<!--======================================================================================================================-->
<script>
	var save_method;
	var table;

	$(document).ready(function() {
		table = $('#disp').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('campaigns/dispo_list')?>",
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

		$("#check-all-recyc").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});
	});
</script>