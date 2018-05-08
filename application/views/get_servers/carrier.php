<div class="row">
    <div class="col-sm-12 table-responsive">
        <table id="servCar" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Carrier ID</th>
                    <th>Name</th>
					<th>Registration</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>getdial</td>
                    <td>getdial</td>
                    <td></td>
                    <td style="color:green">ACTIVE</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<!--======================================================================================================================-->
<script>
    $(function () {
		$('#servCar').DataTable({
			"lengthChange": false,
			"ordering": false,
			"autoWidth": false,
			"searching": false
		});
	});
</script>