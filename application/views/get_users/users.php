<?php
############################################################################################
####  Name:             	users.php	                                             	####
####  Type:             	ci views - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<link rel="stylesheet" href="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.css">
<script src="<?php echo base_url()?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/plugins/datatables/dataTables.bootstrap.min.js"></script>
<script>
	var save_method;
	var table;

	$(document).ready(function() {
		table = $('#user').DataTable({ 
			"ordering": false,
			"processing": true,
			"serverSide": true,
			"order": [],
			"ajax": {
				"url": "<?php echo site_url('users/user_list')?>",
				"type": "POST"
			},
			"columnDefs": [
				{ 
					"targets": [ 0 ],
					"orderable": false,
				},
				{ 
					"targets": [ -1 ],
					"orderable": false,
				},
			],
		});

		$("input").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("select").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("#check-all").click(function () {
			$(".data-check").prop('checked', $(this).prop('checked'));
		});

		$("#file").on("change", function()
		{
			var files = !!this.files ? this.files : [];
			if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
			
			if (/^image/.test( files[0].type)){ // only image file
				var reader = new FileReader(); // instance of the FileReader
				reader.readAsDataURL(files[0]); // read the local file
				
				reader.onloadend = function(){ // set image data as background of div
					$("#imagePreview").css("background-image", "url("+this.result+")");
				}
			}
		});
	});


	function add_user()
	{
		save_method = 'add';
		$('#form-user')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('[name="user"]').attr('readonly',false);
		$('#user-avatar').hide();
		$('#hide-pass').show();
		$('#imagePreview').css("background-image", "url('')");
		$('#modal_form').modal('show');
		$('.modal-title').text('Add New User');
	}

	function edit_user(user)
	{
		save_method = 'update';
		$('#form-user')[0].reset();
		$('.form-group').removeClass('has-error');
		$('.help-block').empty();
		$('#imagePreview').css("background-image", "url('')");

		$.ajax({
			url : "<?php echo site_url('users/ajax_edit')?>/" + user,
			type: "GET",
			dataType: "JSON",
			success: function(data)
			{
				if(data.user == 'admin'){
					$('#hide-pass').hide();
				}else{
					$('#hide-pass').show();
				}
				$('[name="user"]').val(data.user).attr('readonly',true);
				$('[name="password"]').val(data.pass);
				$('[name="fullname"]').val(data.full_name);
				$('[name="phone_login"]').val(data.phone_login);
				$('[name="phone_pass"]').val(data.phone_pass);
				$('[name="user_group"]').val(data.user_group);
				$('[name="active"]').val(data.active);
				$('[id="avatar"]').attr("src", "<?php echo base_url('assets/avatar/')?>"+data.avatar);
				$('#user-avatar').show();
				$('#modal_form').modal('show');
				$('.modal-title').text('Modify User : ' + data.user);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error get data from database');
			}
		});
	}

	function reload_table()
	{
		table.ajax.reload(null,false);
	}

	function save()
	{
		$('#btnSave').text('SAVING...');
		$('#btnSave').attr('disabled',true);
		var url;

		if(save_method == 'add') {
			url = "<?php echo site_url('users/ajax_add')?>";
		} else {
			url = "<?php echo site_url('users/ajax_update')?>";
		}

		var formData = new FormData($('#form-user')[0]);
		$.ajax({
			url : url,
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status)
				{
					$('#modal_form').modal('hide');
					reload_table();
				}
				else
				{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error'); 
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
					}
				}
				$('#btnSave').text('SUBMIT');
				$('#btnSave').attr('disabled',false);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error adding / update data');
				$('#btnSave').text('SUBMIT');
				$('#btnSave').attr('disabled',false);
			}
		});
	}

	function delete_user(user)
	{
		if(confirm('Are you sure you want to delete this data ?'))
		{
			$.ajax({
				url : "<?php echo site_url('users/ajax_delete')?>/"+user,
				type: "POST",
				dataType: "JSON",
				success: function(data)
				{
					$('#modal_form').modal('hide');
					reload_table();
				},
				error: function (jqXHR, textStatus, errorThrown)
				{
					alert('Error deleting data');
				}
			});

		}
	}

	function bulk_delete()
	{
		var user = [];
		$(".data-check:checked").each(function() {
				user.push(this.value);
		});
		if(user.length > 0)
		{
			if(confirm('Are you sure delete this User group '+user+' ?'))
			{
				$.ajax({
					type: "POST",
					data: {user:user},
					url: "<?php echo site_url('users/ajax_bulk_delete')?>",
					dataType: "JSON",
					success: function(data)
					{
						if(data.status)
						{
							reload_table();
						}
						else
						{
							alert('Failed.');
						}
					},
					error: function (jqXHR, textStatus, errorThrown)
					{
						alert('Error deleting data');
					}
				});
			}
		}
		else
		{
			alert('No data selected');
		}
	}

    function onlyNumb(evt) {
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	    return false;
	    return true;
    }

	function nav_active(){
		document.getElementById("set").className = "active";
		document.getElementById("set-user").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>

<style>
	#imagePreview {
		width: 150px;
		height: 150px;
		background-position: center center;
		background-size: cover;
		-webkit-box-shadow: 0 0 1px 1px rgba(0, 0, 0, .2);
		display: inline-block;
	}
</style>

<!--======================================================================================================================-->
<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
			<div class="box-header">
                <h2 class="box-title"><b>Users</b></h2>
				<div class="pull-right">
					<button type="button" class="btn btn-success btn-sm" onclick="add_user()" title="Add"><i class="fa fa-plus"></i>&ensp;Add New User</button>
					<a href="" class="btn btn-info btn-sm" onclick="reload_table()" title="Refresh"><i class="fa fa-refresh"></i>&ensp;Refresh</a>
					<a href="" class="btn btn-danger btn-sm" onclick="bulk_delete()" title="Delete Selected"><i class="fa fa-remove"></i>&ensp;Delete Selected</a>
				</div>
            </div>
            <div class="box-body">
            <table id="user" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Group</th>
                        <th>Status</th>
                        <th width="10%">Action</th>
                        <th width="5%"><input type="checkbox" id="check-all"></th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            </div>
        </div>
    </div>
</div>

<!--======================================================================================================================-->
<!-- Modal Add -->
<div id="modal_form" class="modal fade" role="dialog">
	<div class="modal-dialog" style="width:50%;">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title"></h4>
			</div>
			<div class="modal-body">
				<form action="#" id="form-user">
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="user" minlenght="4" maxlength="10">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row" id="hide-pass">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Password :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<input type="password" class="form-control" name="password" minlength="4" maxlength="20">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Fullname :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="fullname">
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Login :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="phone_login" minlength="4" maxlength="4" onkeypress="return onlyNumb(event);">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Phone Pass :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<input type="text" class="form-control" name="phone_pass">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>User Group :</label>
						</div>
					</div>
					<div class="col-sm-4">
						<?= form_dropdown('user_group', $list_user_group, '', 'class="form-control"') ?>
						<span class="help-block"></span>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Active :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
							$drop_down = array('Y' => 'YES','N' => 'NO');
						?>
						<?= form_dropdown('active', $drop_down, '', 'class="form-control"') ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-3" align="right">
						<div class="form-group">
							<label>Avatar :</label>
						</div>
					</div>
					<div class="col-md-3" id="user-avatar">
						<div class="form-group" align="center">
							<img id="avatar" style="width:150px;height:150px;"><br>
							User Avatar
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<div id="imagePreview"></div>
							<input type="file" name="avatar" class="form-control" id="file">
							<span class="help-block"></span>
						</div>
					</div>
				</div>
				<br>
				<center>
					<button type="button" id="btnSave" onclick="save()" class="btn btn-success btn-md">SUBMIT</button>&ensp;
					<button type="button" class="btn btn-danger btn-md" data-dismiss="modal">CLOSE</button>
				</center>
				</form>
			</div>
		</div>			
	</div>
</div>