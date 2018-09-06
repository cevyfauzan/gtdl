<h4><b>Load Leads</b></h4>
<br>
<form action="#" name="" id="" method="post" onSubmit="" enctype="multipart/form-data">
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>Leads File :</label>
		</div>
	</div>
	<div class="col-sm-4">
		<input type="file" class="form-control" name="" id="">
		<div class="progress progress-xs active">
            <div class="progress-bar progress-bar-success progress-bar-striped bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only percent">20% Complete</span>
            </div>
        </div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>List ID :</label>
		</div>
	</div>
	<div class="col-sm-3">
		<?= form_dropdown('list_id_override', $list_list, '', 'class="form-control"') ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>Duplicate Check :</label>
		</div>
	</div>
	<div class="col-sm-4">
		<?php 
			$drop_down = array('NONE' => 'NO DUPLICATE CHECK','DUPSYS' => 'CHECK FOR DUPLICATES BY PHONE IN SYSTEM');
		?>
		<?= form_dropdown('dupcheck', $drop_down, '', 'class="form-control"') ?>
	</div>
</div>
<center><button type="submit" class="btn btn-success btn-md" name="" id="" onclick="">UPLOAD</button></center>
</form>
