<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
	$(function () {
		/*$('#table').DataTable({
			"ordering": false,
			"autoWidth": false,
			"searching": false
		});*/
		$(".date").datepicker({
			format: "dd/mm/yyyy"
		});
	});

	function nav_active(){
		document.getElementById("rep").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('' => '-- Select Report --', 'rep_dash' => 'Dashboard', 'rep_atd' => 'Agent Time Detail', 'rep_apd' => 'Agent Performance Detail', 'rep_dss' => 'Dial Statuses Summary', 'rep_ecr' => 'Export Call Report', 'rep_spa' => 'Sales per Agent', 'rep_st' => 'Sales Tracker');
						?>
						<?= form_dropdown('rep_type', $drop_down, '', $attr) ?>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '-- Select Campiagn --','N' => 'CAMPAIGN1');
						?>
						<?= form_dropdown('rep_camp', $list_camp, '', $attr) ?>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control date" name="rep_start_date" placeholder="start date">
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control date" name="rep_end_date" placeholder="end date">
					</div>
					<div class="col-sm-2">
						<button type="button" class="btn btn-success btn-block" onClick="">Show</button>
					</div>
				</div>
            </div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->