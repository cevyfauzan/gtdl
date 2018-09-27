<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		table_apdd1 = $('#apd1').DataTable({ 
			"searching": false,
			"paging": false,
			"ordering": false,
			"info": false
		});
	});
</script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-sm-12">
		<b>Time Call Detail</b>
		<table id="apd1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>ID</th>
                    <th>Calls</th>
					<th>Time</th>
                    <th>Pause</th>
                    <th>Avg</th>
                    <th>Wait</th>
                    <th>Avg</th>
                    <th>Talk</th>
                    <th>Avg</th>
                    <th>Dispo</th>
                    <th>Avg</th>
                </tr>
            </thead>
            <tbody>
				<?php foreach($list_apd1 as $row1){ ?>
				<tr>
                    <td><?= $row1->full_name; ?></td>
                    <td><?= $row1->user; ?></td>
                    <td>100</td>
                    <td>1:12:31</td>
                    <td>11:36</td>
                    <td>1:41</td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
				</tr>
				<?php } ?>
			</body>
            <tfoot>
				<tr>
                    <th>TOTAL</th>
                    <th>10 Agents</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
				</tr>
            </tfoot>
        </table>
    </div>
</div>
<br>
<legend></legend>
<div class="row">
    <div class="col-sm-12">
		<b>Dispo Call Detail</b>
		<table id="apd1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>Dispo1</th>
					<th>Dispo2</th>
                    <th>Dispo3</th>
                    <th>Dispo4</th>
                    <th>Dispo5</th>
                    <th>Dispo6</th>
                    <th>Dispo7</th>
                </tr>
            </thead>
            <tbody>
				<?php foreach($list_apd1 as $row1){ ?>
				<tr>
                    <td><?= $row1->full_name; ?></td>
                    <td>100</td>
                    <td>1:12:31</td>
                    <td>11:36</td>
                    <td>1:41</td>
                    <td></td>
                    <td></td>
                    <td></td>
				</tr>
				<?php } ?>
			</body>
            <tfoot>
				<tr>
                    <th>TOTAL</th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
                    <th></th>
				</tr>
            </tfoot>
        </table>
    </div>
</div>

<!--======================================================================================================================-->