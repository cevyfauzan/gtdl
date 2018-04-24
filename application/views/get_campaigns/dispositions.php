<div class="pull-right">
    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-disp" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Status</a>
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
                        <a href="" title="Edit" data-toggle="modal" data-target="#edit"><i class="fa fa-edit text-yellow"></i></a>&ensp;
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
	function change(b){
		var id = b.value;
		if(id == 'Y' || id == 'P'){
			$('#autoDial').hide();
		}else{
			$('#autoDial').show();
		}
	}

    $(function () {
		$('#disp').DataTable({
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