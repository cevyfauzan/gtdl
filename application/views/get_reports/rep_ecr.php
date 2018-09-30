<b>Export Call Reports</b>
<div class="row">
    <div class="col-sm-3">
		<label>Select Campaigns</label>
        <?= form_dropdown('', $list_camp, '', 'multiple class="form-control"') ?>
	</div>
    <div class="col-sm-3">
		<label>Select Lists</label>
		<?= form_dropdown('', $list_lists, '', 'multiple class="form-control"') ?>
	</div>
    <div class="col-sm-3">
		<label>Select Dispo</label>
		<?= form_dropdown('', $list_dispo_ecr, '', 'multiple class="form-control"') ?>
	</div>
    <div class="col-sm-3">
		<br>
		<button type="button" class="btn btn-success">Donwload Excel</button>
	</div>
</div>

<!--======================================================================================================================-->