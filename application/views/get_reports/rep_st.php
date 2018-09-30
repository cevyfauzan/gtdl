<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		table_apdd1 = $('#st').DataTable({ 
			"searching": false,
			"ordering": false
		});
	});
</script>

<!--======================================================================================================================-->
<b>Sales Tracker</b>
<button type="button" class="btn btn-success btn-sm pull-right">Donwload Excel</button>
<div class="row">
    <div class="col-sm-12">
		<table id="st" class="table table-striped">
            <thead>
                <tr>
                    <th>Sale No</th>
                    <th>Call Time</th>
                    <th>Agent</th>
                    <th>Phone Number</th>
                    <th>Name</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
				<?php 
					$i = 1;
					foreach($list_lead as $row){ 
				?>
				<tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row->modify_date; ?></td>
                    <td><?= $row->user; ?></td>
                    <td><?= $row->phone_number; ?></td>
                    <td><?= $row->first_name; ?></td>
                    <td><i class="fa fa-info-circle text-info"></i></td>
				</tr>
				<?php } ?>
			</body>
        </table>
    </div>
</div>
