<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		table_apdd1 = $('#spa').DataTable({ 
			"searching": false,
			"paging": false,
			"ordering": false,
			"info": false
		});
	});
</script>

<!--======================================================================================================================-->
<b>Sales per Agent</b>
<button type="button" class="btn btn-success btn-sm pull-right">Donwload Excel</button>
<div class="row">
    <div class="col-sm-12">
		<table id="spa" class="table table-striped">
            <thead>
                <tr>
                    <th>Fullname</th>
                    <th>ID</th>
                    <th>Sales Count</th>
                </tr>
            </thead>
            <tbody>
				<?php foreach($list_apd1 as $row){ ?>
				<tr>
                    <td><?= $row->full_name; ?></td>
                    <td><?= $row->user; ?></td>
                    <td>10</td>
				</tr>
				<?php } ?>
			</body>
            <tfoot>
				<tr>
                    <th colspan="2">TOTAL</th>
                    <th>100</th>
				</tr>
            </tfoot>
        </table>
    </div>
</div>
