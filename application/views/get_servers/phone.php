<div class="row">
    <div class="col-sm-12 table-responsive">
        <table id="phoneCar" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Extension</th>
                    <th>Name</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=8001;$i<8021;$i++){ ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= $i ?></td>
                    <td style="color:green">ACTIVE</td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!--======================================================================================================================-->
<script>
    $(function () {
		$('#phoneCar').DataTable({
			"ordering": false,
			"autoWidth": false,
			"searching": false
		});
	});
</script>