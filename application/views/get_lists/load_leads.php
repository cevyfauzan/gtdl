<script type="text/javascript">
	$(document).ready(function() 
    {
		var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');

        $('#uploadform').ajaxForm({
        	beforeSend: function() {
            			status.empty();
                        var percentVal = '0%';
                        bar.width(percentVal);
                        percent.html(percentVal);
                	},
            uploadProgress: function(event, position, total, percentComplete) {
                        var percentVal = percentComplete + '%';
                        bar.width(percentVal);
                        percent.html(percentVal);
                	},
            complete: function(xhr) {
                        document.forms["uploadform"].submit();

            }
		});
	});
		
	function checkmes(){
	var leadfile = document.getElementById('leadfile').value;	
	var leadfile2 = document.getElementById('leadfile').value;	
	
	var lead_file = $('#leadfile').val();
        var valid_extensions = /(\.xls|\.xlsx|\.csv|\.ods|\.sxc)$/i;
        if (lead_file.length < 1)
        {
            alert('Please include a lead file.');
            return false;
        }else{
            if (valid_extensions.test(lead_file))
            {
                $('.progressBar').show();
                $('#uploadleads').submit();
                $('#box').css('position','absolute');
            }else{
                alert('Uploaded file is invalid: '+lead_file+'<br /><br />File must be in Excel format (xls, xlsx) or in Comma Separated Values (csv).');
                return false;
            }
        }
	}

	function ParseFileName() {
		if (!document.uploadform.OK_to_process) 
		{	
			var filename = document.getElementById("leadfile").value;
			var endstr = filename.lastIndexOf('');
			if (endstr>-1) 
			{
				endstr++;
				document.getElementById('leadfile_name').value=filename;
			}
		}
	}
</script>

<!--======================================================================================================================-->
<h4><b>Load Leads</b></h4>
<br>
<form action="#" name="uploadform" id="uploadform" method="post" onSubmit="ParseFileName()" enctype="multipart/form-data">
<input type="hidden" name="leadsload" id="leadsloadok" value="ok">
<input type="hidden" name="tabvalsel" id="tabvalsel" value="<?=$tabvalsel?>">
<input type="hidden" name="leadfile_name" id="leadfile_name" value="<?=$leadfile_name?>">

<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>Leads File :</label>
		</div>
	</div>
	<div class="col-sm-4">
		<input type="file" class="form-control" name="leadfile" id="leadfile" value="<?= $leadfile ?>">
		<div class="progress progress-xs active">
            <div class="progress-bar progress-bar-success progress-bar-striped bar" role="progressbar" aria-valuemin="0" aria-valuemax="100">
                <span class="sr-only percent">20% Complete</span>
            </div>
        </div>
	</div>
</div>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>List ID :</label>
		</div>
	</div>
	<div class="col-sm-3">
		<?= form_dropdown('list_id_override', $list_list, '', 'class="form-control"') ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>Phone Code :</label>
		</div>
	</div>
	<div class="col-sm-3">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('' => '-- NONE --', '62' => '62 - IND');
		?>
		<?= form_dropdown('phone_code_override', $drop_down, '', $attr) ?>
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
			$attr = 'class="form-control"';
			$drop_down = array('NONE' => 'NO DUPLICATE CHECK','DUPSYS' => 'CHECK FOR DUPLICATES BY PHONE IN ENTIRE SYSTEM');
		?>
		<?= form_dropdown('dupcheck', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-4" align="right">
		<div class="form-group">
			<label>Timezone :</label>
		</div>
	</div>
	<div class="col-sm-3">
		<?php 
			$attr = 'class="form-control"';
			$drop_down = array('AREA' => 'COUNTRY CODE AND AREA CODE ONLY','POSTAL' => 'POSTAL CODE FIRST','TZCODE' => 'OWNER TIME ZONE CODE FIRST');
		?>
		<?= form_dropdown('postalgmt', $drop_down, '', $attr) ?>
	</div>
</div>
<center><button type="submit" class="btn btn-success btn-md" name="submit_file" id="submit_file" onclick="return checkmes();">UPLOAD</button></center>
</form>
<br>

<?php 
	if($fields!=null) {
?>

<form action="go_list" name="uploadform2" id="uploadform2" method="post" onSubmit="ParseFileName()" enctype="multipart/form-data">
<input type="hidden" name="leadsload" value="okfinal">
<input type="hidden" name="lead_file" id="lead_file" value="<?=$lead_file?>">
<input type="hidden" name="leadfile" id="leadfile" value="<?=$leadfile?>">
<input type="hidden" name="list_id_override" value="<?=$list_id_override?>">
<input type="hidden" name="phone_code_override" value="<?=$phone_code_override?>">
<input type="hidden" name="dupcheck" value="<?=$dupcheck?>">
<input type="hidden" name="leadfile_name" id="leadfile_name" value="<?=$leadfile_name?>">
<input type="hidden" name="superfinal" id="superfinal">

<legend></legend>
<center><b>Processing...</center>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Phone Number :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Name :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Address 1 :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Address 2 :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>City :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>DOB :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Email :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<div class="row">
	<div class="col-sm-5" align="right">
		<div class="form-group">
			<label>Comments :</label>
		</div>
	</div>
	<div class="col-sm-2">
        <?php 
			$attr = 'class="form-control"';
			$drop_down = array('N' => 'Listid 1001', 'Y' => 'Listid 1002');
		?>
		<?= form_dropdown('', $drop_down, '', $attr) ?>
	</div>
</div>
<center><a href="" class="btn btn-success btn-md">PROCESS</a></center>

<?php } ?>
