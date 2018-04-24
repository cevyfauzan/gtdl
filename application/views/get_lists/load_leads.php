<h4><b>Load Leads</b></h4>
<br>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>Leads File :</label>
		</div>
	</div>
	<div class="col-sm-4">
		<input type="file" class="form-control" name="">
	</div>
</div>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>List ID :</label>
		</div>
	</div>
	<div class="col-sm-3">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>Phone Code :</label>
		</div>
	</div>
	<div class="col-sm-3">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Load From Lead FILE', 'Y' => '62 - IND');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
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
			$attr = 'class="form-control"';
			$drop_down = array('Y' => 'NO DUPLICATE CHECK','N' => 'DUPLICATE FOR THIS CAMPAIGN');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>Timezone :</label>
		</div>
	</div>
	<div class="col-sm-3">
		<?php 
			$attr = 'class="form-control"';
			$drop_down = array('Y' => 'NO DUPLICATE CHECK','N' => 'DUPLICATE FOR THIS CAMPAIGN');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<center><a href="" class="btn btn-success btn-md">UPLOAD</a></center>
<br>
<legend></legend>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Phone Number :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Name :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Address 1 :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Address 2 :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>City :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>DOB :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Email :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Comments :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<center><a href="" class="btn btn-success btn-md">PROCESS</a></center>

<!--======================================================================================================================-->
<script></script>