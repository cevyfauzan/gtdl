<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '-- Select Report --','N' => 'Dashboard');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control date" name="" placeholder="start date">
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control date" name="" placeholder="end date">
					</div>
					<div class="col-sm-2">
						<button type="submit" class="btn btn-success btn-block">Show</button>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->

<script>
	$(function () {
		/*$('#table').DataTable({
			"ordering": false,
			"autoWidth": false,
			"searching": false
		});*/
		$(".date").datepicker();
	});

	function nav_active(){
		document.getElementById("aft-r").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>