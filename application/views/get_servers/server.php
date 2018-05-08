<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/iCheck/all.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
			<div class="box-header">
                <h2 class="box-title"><b>Servers</b></h2>
				<div class="pull-right">
                    <a href="" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-server" title="Add"><i class="fa fa-plus"></i>&ensp;Add New Server</a>
				</div>
            </div>
            <div class="box-body">
            <table id="servers" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Server ID</th>
                        <th>Server Name</th>
                        <th>Server IP</th>
                        <th>Status</th>
                        <th>Asterisk</th>
                        <th>GMT</th>
                        <th width="10%">Action</th>
                        <th width="5%"><input type="checkbox" class="minimal"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>getdial</td>
                        <td>getdial</td>
                        <td>192.168.1.1</td>
                        <td style="color:green">ACTIVE</td>
                        <td>1.8.23.0</td>
                        <td>7.00</td>
                        <td>
                            <a href="" title="Edit" data-toggle="modal" data-target="#edit-server"><i class="fa fa-edit text-yellow"></i></a>&ensp;
                            <a href="" title="Delete" onclick="return confirm('Are you sure you want to delete this data ?');"><i class="fa fa-remove text-red"></i></a>&ensp;
                            <a href="" title="Info"><i class="fa fa-info-circle text-info"></i></a>&ensp;
                        </td>
                        <td><input type="checkbox" class="minimal"></td>
                    </tr>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="add-server" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">ADD NEW SERVER</h4>
			</div>
			<div class="modal-body">
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server Name :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server IP :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Asterisk Version :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>User Group :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'All User Groups','N' => 'Administrators','M' => 'Agents');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Active :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SUBMIT</a></center>
			</div>
		</div>			
	</div>
</div>

<!-- Modal Edit -->
<div id="edit-server" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">MODIFY SERVER</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server ID :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server Name :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Server IP :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Asterisk Version :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Max Trunk :</label>
						</div>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Max Call per Second :</label>
						</div>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="" >
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Recording Limit :</label>
						</div>
					</div>
					<div class="col-sm-2">
						<input type="text" class="form-control" name="" >
					</div>
					<div class="col-sm-2">
						<label>Minutes</label>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>User Group :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'All User Groups','N' => 'Administrators','M' => 'Agents');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Active :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
				<br>
                <center><a href="" class="btn btn-success btn-md">SAVE SETTING</a></center>
				<br>
				<legend></legend>
				<div class="row">
					<div class="col-md-12">
						<div class="nav-tabs-custom">
							<ul class="nav nav-tabs" id="serverTabs">
								<li class="active"><a href="#tab_1" data-toggle="tab" data-url="<?= base_url() ?>server/get_carrier">Carriers Within this Server</a></li>
								<li><a href="#tab_2" data-toggle="tab" data-url="<?= base_url() ?>server/get_phone">Phones Within this Server</a></li>
								<li><a href="#tab_3" data-toggle="tab" data-url="<?= base_url() ?>server/get_conference">Conferences Within this Server</a></li>
							</ul>
							<div class="tab-content">
								<div class="tab-pane active" id="tab_1"></div>
								<div class="tab-pane" id="tab_2"></div>
								<div class="tab-pane" id="tab_3"></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>			
	</div>
</div>

<!--======================================================================================================================-->
<script>
	$(document).ready(function() {
        $('#serverTabs a').click(function (e) {
            e.preventDefault();
            var url = $(this).attr("data-url");
            var href = this.hash;
            var pane = $(this);
            
            $(href).load(url,function(result){      
                pane.tab('show');
            });
        });
        $('#tab_1').load($('.active a').attr("data-url"),function(result){
            $('#tab_1').tab('show');
        });
    });

    $(function () {
		$('#servers').DataTable({
			"ordering": false,
			"autoWidth": false
		});
	});

    $('input[type="checkbox"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue'
    });

	function nav_active(){
		document.getElementById("set").className = "active";
		document.getElementById("set-server").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>