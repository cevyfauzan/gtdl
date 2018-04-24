<div class="pull-right">
    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-recyc" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Status</a>
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
                    <th width="5%"><input type="checkbox" class="minimal"></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1;$i<15;$i++){ ?>
                <tr>
                    <td>CAMPAIGN<?= $i ?></td>
                    <td>Campaign <?= $i ?></td>
                    <td><del>NONE</del></td>
                    <td>
                        <a href="" title="Edit" data-toggle="modal" data-target="#lead-recyc"><i class="fa fa-edit text-yellow"></i></a>&ensp;
                        <a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this data ?');"><i class="fa fa-remove text-red"></i></a>&ensp;
                        <a href="" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;
                    </td>
                    <td><input type="checkbox" class="minimal"></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="add-recyc" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:60%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">CREATE NEW LEAD RECYCLING</h4>
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
					<div class="col-sm-5">
                    <?php 
                            $attr = 'class="form-control"';
                            $drop_down = array('Y' => '-- SELECT --','N' => 'BUSY');
                        ?>
                        <?= form_dropdown('', $drop_down, '', $attr) ?>
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
				<br>
                <center><a href="" class="btn btn-success btn-md">SUBMIT</a></center>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Lead Recycle -->
<div id="lead-recyc" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:70%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">LEAD RECYCLING WITHIN THIS CAMPAIGN : CAMPAIGN1</h4>
			</div>
			<div class="modal-body">
            <table class="table table-bordered table-striped table_responsive">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Attempt Delay</th>
                            <th>Maximum Attempts</th>
                            <th>Leads at Limits</th>
                            <th>Active</th>
                            <th width="10%">Action</th>
                            <th width="5%"><input type="checkbox" class="minimal"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i=1;$i<5;$i++){ ?>
                        <tr>
                            <td>NEW</td>
                            <td>2 Mins</td>
                            <td>1</td>
                            <td>23</td>
                            <td style="color:green">YES</td>
                            <td>
                                <a href="" title="Edit" data-toggle="modal" data-target="#lead-recyc-detail"><i class="fa fa-edit text-yellow"></i></a>&ensp;
                                <a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this data ?');"><i class="fa fa-remove text-red"></i></a>&ensp;
                                <a href="" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;
                            </td>
                            <td><input type="checkbox" class="minimal"></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
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

<!--======================================================================================================================-->
<script>
	function change(b){
		var id = b.value;
		if(id == 'Y' || id == 'P'){
			$('#autoDial').hide();
		}else{
			$('#autoDial').show();
		}
	}

    $(function () {
		$('#recyc').DataTable({
			"ordering": false,
			"autoWidth": false
		});
	});

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    });

	$('#camE').change(function() {
		$('#camIDs').attr('disabled',!this.checked),
		$('#camNames').attr('disabled',!this.checked)
	});
</script>