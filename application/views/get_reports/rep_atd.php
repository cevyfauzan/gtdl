<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		table_apdd1 = $('#atd').DataTable({ 
			"searching": false,
			"paging": false,
			"ordering": false,
			"info": false
		});
	});
</script>

<!--======================================================================================================================-->
<b>Agent Time Detail</b>
<button type="button" class="btn btn-success btn-sm pull-right">Donwload Excel</button>
<div class="row">
    <div class="col-sm-12">
		<b>Time Call Detail</b>
		<table id="atd" class="table table-striped">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>ID</th>
                    <th>Calls</th>
					<th>Agent Time</th>
                    <th>Pause</th>
                    <th>Wait</th>
                    <th>Talk</th>
                    <th>Dispo</th>
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
                    <td>11:36</td>
                    <td>11:36</td>
                    <td>11:36</td>
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
				</tr>
            </tfoot>
        </table>
    </div>
</div>
