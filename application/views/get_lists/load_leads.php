<?php
############################################################################################
####  Name:             	load_leads.php                                             	####
####  Type:             	ci views - administrator                     				####
####  Version:          	2.0.0                                                       ####
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<script type="text/javascript">
	$(document).ready(function() {
		$("input").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
		$("select").change(function(){
			$(this).parent().parent().removeClass('has-error');
			$(this).next().empty();
		});
	});

	function upload()
	{
		$('#btnUpload').text('UPLOADING...');
		$('#btnUpload').attr('disabled',true);

		var formData = new FormData($('#form-load')[0]);
		$.ajax({
			url : "<?php echo site_url('lists/ajax_upload')?>",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			dataType: "JSON",
			success: function(data)
			{
				if(data.status)
				{
					$('#form-load')[0].reset();
					alert('Success upload ' + data.totalRows + ' lead.');
				}
				else
				{
					for (var i = 0; i < data.inputerror.length; i++) 
					{
						$('[name="'+data.inputerror[i]+'"]').parent().parent().addClass('has-error');
						$('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]);
					}
				}
				$('#btnUpload').text('UPLOAD');
				$('#btnUpload').attr('disabled',false);
			},
			error: function (jqXHR, textStatus, errorThrown)
			{
				alert('Error upload data');
				$('#btnUpload').text('UPLOAD');
				$('#btnUpload').attr('disabled',false);
			}
		});
	}
</script>

<!--======================================================================================================================-->
<h4><b>Load Leads</b></h4>
<br>
<form action="#" id="form-load" enctype="multipart/form-data">
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>Leads File :</label>
		</div>
	</div>
	<div class="col-sm-4">
		<input type="file" class="form-control" name="lead_file">
		<span class="help-block"></span>
	</div>
</div>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>List ID :</label>
		</div>
	</div>
	<div class="col-sm-3">
		<?= form_dropdown('list_id', $list_list, '', 'class="form-control"') ?>
		<span class="help-block"></span>
	</div>
</div>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>Duplicate Check :</label>
		</div>
	</div>
	<div class="col-sm-4">
		<?php 
			$drop_down = array('NONE' => 'NO DUPLICATE CHECK','DUPSYS' => 'CHECK FOR DUPLICATES BY PHONE IN SYSTEM');
		?>
		<?= form_dropdown('dupcheck', $drop_down, '', 'class="form-control"') ?>
	</div>
</div>
<center><button type="button" class="btn btn-success btn-md" id="btnUpload" onclick="upload()">UPLOAD</button></center>
</form>
