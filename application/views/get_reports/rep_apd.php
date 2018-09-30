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
		table_apdd2 = $('#apd2').DataTable({ 
			"searching": false,
			"paging": false,
			"ordering": false,
			"info": false
		});
	});
</script>

<!--======================================================================================================================-->
<b>Agent Performance Detail</b>
<button type="button" class="btn btn-success btn-sm pull-right">Donwload Excel</button>
<div class="row">
    <div class="col-sm-12">
		<b>Time Call Detail</b>
		<table id="apd1" class="table table-striped">
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
                    <td>11:36</td>
                    <td>1:41</td>
                    <td>11:36</td>
                    <td>1:41</td>
                    <td>11:36</td>
                    <td>1:41</td>
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
		<table id="apd2" class="table table-striped">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <?php foreach($list_dispo as $row1){ ?>
                    <th width="7%"><?= $row1->status; ?></th>
                    <?php } ?>
                </tr>
            </thead>
            <tbody>
				<?php foreach($list_apd1 as $row2){ ?>
				<tr>
                    <td><?= $row2->full_name; ?></td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>1</td>
                    <td>2</td>
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
                    <th></th>
                    <th></th>
                    <th>20</th>
				</tr>
            </tfoot>
        </table>
    </div>
</div>

<!--======================================================================================================================-->