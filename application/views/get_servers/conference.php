<div class="row">
    <div class="col-sm-12 table-responsive">
        <table id="confCar" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Conference</th>
					<th>Extension</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=8600051;$i<8600071;$i++){ ?>
                <tr>
                    <td><?= $i ?></td>
                    <td></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!--======================================================================================================================-->
<script>
    $(function () {
		$('#confCar').DataTable({
			"ordering": false,
			"autoWidth": false,
			"searching": false
		});
	});
</script>