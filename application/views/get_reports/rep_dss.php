<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
	$(document).ready(function() {
		table_apdd1 = $('#dss').DataTable({ 
			"searching": false,
			"paging": false,
			"ordering": false,
			"info": false
		});
	});
</script>

<!--======================================================================================================================-->
<b>Dial Statuses Summary</b>
<div class="row">
    <div class="col-sm-12">
		<table id="dss" class="table table-striped">
            <thead>
                <tr>
                    <th>Dispo</th>
                    <th>Dispo Desc</th>
					<?php for($i=0;$i<11;$i++){ ?>
					<th width="5%"><?= $i ?></th>
					<?php } ?>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
				<?php foreach($list_dispo as $row1){ ?>
				<tr>
                    <td><?= $row1->status; ?></td>
                    <td><?= $row1->status_name; ?></td>
                    <td>0</td>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td>7</td>
                    <td>8</td>
                    <td>9</td>
                    <td>10</td>
                    <td>1111</td>
				</tr>
				<?php } ?>
			</body>
            <tfoot>
				<tr>
                    <th colspan="2">Total Count from ALL CAMPAIGNS</th>
                    <th>0</th>
                    <th>10</th>
                    <th>20</th>
                    <th>30</th>
                    <th>40</th>
                    <th>50</th>
                    <th>60</th>
                    <th>70</th>
                    <th>80</th>
                    <th>90</th>
                    <th>100</th>
                    <th>11111</th>
				</tr>
            </tfoot>
        </table>
    </div>
</div>

<!--======================================================================================================================-->