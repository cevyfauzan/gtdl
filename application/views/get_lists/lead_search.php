<div class="pull-right">
    <a href="" class="btn btn-info btn-sm" data-toggle="modal" data-target="#add-search" data-backdrop="static" data-keyboard="false" title="Add"><i class="fa fa-search"></i>&ensp;Search Lead</a>
</div>
<h4><b>Show Leads</b></h4>
<br>
<div class="row">
    <div class="col-sm-12 table-responsive">
        <table id="search" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="7%">Lead ID</th>
                    <th>List ID</th>
                    <th>Phone</th>
					<th>Fullname</th>
                    <th>Last Call Date</th>
                    <th>Status</th>
                    <th>Last Agent</th>
                   	<th width="10%">Action</th>
                    <th width="5%"><input type="checkbox" class="minimal"></th>
                </tr>
            </thead>
            <tbody>
                <?php for($i=1;$i<15;$i++){ ?>
                <tr>
                    <td><?= $i ?></td>
                    <td>101</td>
                    <td>087725601381</td>
                    <td>CEVY FAUZAN</td>
                    <td>2018-04-20 10:01:53</td>
                    <td>NEW</td>
                    <td>agent001</td>
                    <td>
                        <a href="" title="Edit" data-toggle="modal" data-target="#edit-lead" data-backdrop="static" data-keyboard="false"><i class="fa fa-edit text-yellow"></i></a>&ensp;
                        <a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this data ?');"><i class="fa fa-remove text-red"></i></a>&ensp;
                        <a href="" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;
                    </td>
                    <td><input type="checkbox" class="minimal"></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="add-search" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">LEAD SERACH OPTIONS</h4>
			</div>
			<div class="modal-body">
				<form method="post" accept-charset="utf-8" role="form" id="form-filter" method="post" action="<?= base_url() ?>">
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Number :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" id="" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Call Date :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control date" name="" id="" value="">
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control date" name="" id="" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Lead ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" id="" value="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Campaign ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '-- ALL CAMPAIGN --','N' => 'CAMPAIGN1');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Dispo :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '-- ALL DISPO --','N' => 'NO ANSWER');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Last Agent :</label>
						</div>
					</div>
					<div class="col-sm-6">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '-- ALL AGENT --','N' => 'AGENT001');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
				<br>
               	<center>
					<button type="button" id="btn-filter" class="btn btn-primary" title="Filter">SEARCH</button>
					<button type="button" id="btn-reset" class="btn btn-warning" title="Reset">RESET</button>
				</center>
				</form>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Edit -->
<div id="edit-lead" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">LEAD INFORMATION</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Lead ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<b>2</b>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>LIst ID :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<b>101</b>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Name :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="CEVY FAUZAN">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Address :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="PASAR MINGGU">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>City :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="JAKARTA">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>ZIP :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="12530">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Date Of Birth :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control date" name="" value="01-08-1995">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Number :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="087725601381">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Email :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<input type="text" class="form-control" name="" value="CEVYFAUZAN@GMAIL.COM">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Dispo :</label>
						</div>
					</div>
					<div class="col-sm-6">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'NEW','N' => 'BUSY');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Comment :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<textarea class="form-control" name="" id="" rows="3"></textarea>
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SUBMIT</a></center>
			</div>
		</div>			
	</div>
</div>

<!--======================================================================================================================-->
<script>
	function change(b){
		var id = b.value;
		if(id == 'Y' || id == 'P'){
			$('#autoDial').hide();
		}else{
			$('#autoDial').show();
		}
	}
    $(function () {
		$('#search').DataTable({
			"ordering": false,
			"autoWidth": false,
			"searching": false
		});
		$(".date").datepicker();
	});

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    });

	$('#camE').change(function() {
		$('#camID').attr('disabled',!this.checked),
		$('#camName').attr('disabled',!this.checked)
	});
</script>