<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
			<div class="box-header">
                <h2 class="box-title"><b>Logs</b></h2>
				<div class="pull-right">
                    <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#filter" title="Add"><i class="fa fa-search"></i>&ensp;Filter Logs</a>
				</div>
            </div>
            <div class="box-body">
            <table id="log" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User</th>
                        <th>IP Address</th>
                        <th>Date</th>
                        <th>Action</th>
                        <th>Detail</th>
                        <th>Query</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>admin</td>
                        <td>192.168.1.215</td>
                        <td>2018-12-31 23:59:59</td>
                        <td>Login</td>
                        <td>admin logged-in</td>
                        <td></td>
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
				<h4 class="modal-title">FILTER LOGS</h4>
			</div>
			<div class="modal-body">
			<div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" id="" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Date :</label>
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
							<label>Action :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '-- ALL ACTION --','N' => 'LOGIN');
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
		$('#log').DataTable({
			"ordering": false,
			"searching": false,
			"autoWidth": false
		});
		$(".date").datepicker();
	});

	function nav_active(){
		document.getElementById("set").className = "active";
		document.getElementById("set-log").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>