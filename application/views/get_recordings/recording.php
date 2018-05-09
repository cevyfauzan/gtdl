<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/all.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
			<div class="box-header">
                <h2 class="box-title"><b>Recordings</b></h2>
				<div class="pull-right">
                    <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#filter" title="Add"><i class="fa fa-search"></i>&ensp;Filter Recording</a>
				</div>
            </div>
            <div class="box-body">
            <table id="record" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Lead ID</th>
                        <th>Phone</th>
                        <th>Call Date</th>
                        <th>Duration</th>
                        <th>Agent</th>
                        <th>Call Disposition</th>
                        <th>Recordings</th>
                        <th width="10%">Action</th>
                        <th width="5%"><input type="checkbox" class="minimal"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>123456789</td>
                        <td>087725601381</td>
                        <td>2018-12-31 23:59:59</td>
                        <td>23:59:59</td>
                        <td>agent001</td>
                        <td>Sale Made</td>
                        <td>File name recording</td>
                        <td>
                            <a href="" title="Download" data-toggle="modal"><i class="fa fa-download text-info"></i></a>&ensp;
                            <a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this data ?');"><i class="fa fa-remove text-red"></i></a>&ensp;
                            <a href="" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;
                        </td>
                        <td><input type="checkbox" class="minimal"></td>
                    </tr>
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
				<h4 class="modal-title">FILTER RECORDINGS</h4>
			</div>
			<div class="modal-body">
			<div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Number :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" id="" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Name :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control date" name="" id="" value="">
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control date" name="" id="" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Lead ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" id="" value="">
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
							$drop_down = array('Y' => '-- ALL DISPO --','N' => 'SALE');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
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
							$drop_down = array('Y' => '-- ALL AGENT --','N' => 'agent001');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Recording :</label>
						</div>
					</div>
					<div class="col-sm-6">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '-- ALL AGENT --','N' => 'AGENT001');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
				<br>
               	<center>
					<button type="button" id="btn-filter" class="btn btn-primary" title="Filter">SEARCH</button>
					<button type="button" id="btn-reset" class="btn btn-warning" title="Reset">RESET</button>
				</center>
			</div>
		</div>			
	</div>
</div>

<!--======================================================================================================================-->
<script>
    $(function () {
		$('#record').DataTable({
			"ordering": false,
			"searching": false,
			"autoWidth": false
		});
		$(".date").datepicker();
	});

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    });

	function nav_active(){
		document.getElementById("rec").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>