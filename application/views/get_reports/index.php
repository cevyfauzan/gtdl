<?php
############################################################################################
####  Name:             	index.php                                                   ####
####  Type:             	ci views - administrator                     				####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datepicker/datepicker3.css">
<script src="<?php echo base_url()?>assets/plugins/datepicker/bootstrap-datepicker.js"></script>
<script>
	$(function () {
		$(".date").datepicker({
			format: "dd/mm/yyyy"
		});
	});

    function show_report() {
        var repType =  $('[name="rep_type"]').val();
        if(repType == 'rep_apd'){
			var url = "<?= base_url('report/rep_apd') ?>";
			$('#boxReport').show();
            $('#showReport').load(url);
        }else if(repType == 'rep_atd'){
			var url = "<?= base_url('report/rep_atd') ?>";
			$('#boxReport').show();
            $('#showReport').load(url);
        }else if(repType == 'rep_dash'){
			var url = "<?= base_url('report/rep_dash') ?>";
			$('#boxReport').show();
            $('#showReport').load(url);
        }else if(repType == 'rep_dss'){
			var url = "<?= base_url('report/rep_dss') ?>";
			$('#boxReport').show();
            $('#showReport').load(url);
        }else if(repType == 'rep_ecr'){
			var url = "<?= base_url('report/rep_ecr') ?>";
			$('#boxReport').show();
            $('#showReport').load(url);
        }else if(repType == 'rep_spa'){
			var url = "<?= base_url('report/rep_spa') ?>";
			$('#boxReport').show();
            $('#showReport').load(url);
        }else if(repType == 'rep_st'){
			var url = "<?= base_url('report/rep_st') ?>";
			$('#boxReport').show();
            $('#showReport').load(url);
        }else if(repType == 'rep_sr'){
			var url = "<?= base_url('report/rep_sr') ?>";
			$('#boxReport').show();
            $('#showReport').load(url);
        }else{
			$('#boxReport').hide();
            $('#showReport').html('');
        }
    }

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
							$attr = 'class="form-control" onChange="show_report()"';
							$drop_down = array('' => '-- Select Report --', 'rep_apd' => 'Agent Performance Detail', 'rep_atd' => 'Agent Time Detail', 'rep_dash' => 'Dashboard', 'rep_dss' => 'Dial Statuses Summary', 'rep_ecr' => 'Export Call Report', 'rep_spa' => 'Sales per Agent', 'rep_st' => 'Sales Tracker', 'rep_sr' => 'Statistical Report');
						?>
						<?= form_dropdown('rep_type', $drop_down, '', $attr) ?>
					</div>
					<div class="col-sm-3">
						<?= form_dropdown('rep_camp', $list_camp, '', 'class="form-control"') ?>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control date" name="rep_start_date" placeholder="start date" value="<?php echo date('Y-m-d') ?>">
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control date" name="rep_end_date" placeholder="end date" value="<?php echo date('Y-m-d') ?>">
					</div>
					<!--<div class="col-sm-2">
						<button type="button" class="btn btn-success btn-block" onClick="show_report()">Show</button>
					</div>-->
				</div>
            </div>
        </div>
    </div>
</div>

<div class="row" id="boxReport" style="display:none">
    <div class="col-sm-12">
        <div class="box box-solid">
            <div class="box-body" id="showReport"></div>
        </div>
    </div>
</div>
<!--======================================================================================================================-->