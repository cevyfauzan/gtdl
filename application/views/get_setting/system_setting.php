<div class="row">
    <div class="col-sm-12">
        <div class="box box-primary">
			<div class="box-header">
                <h2 class="box-title"><b>System Settings</b></h2>
            </div>
            <div class="box-body">
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Version :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>DB Schema Version :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>DB Schema Update Date :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Auto User-add Value :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Install Date :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Timeclock End Of Day :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Timeclock Last Auto Logout :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Header Date Format :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'MS_DASH_24HR 2018-12-31 23:59:59');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Customer Date Format :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'MS_DASH_24HR 2018-12-31 23:59:59');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Customer Phone Format :</label>
						</div>
					</div>
					<div class="col-sm-4">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => 'US_PARN (000)000-0000');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Agent API Active :</label>
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Agent Only Callback Campaign Lock :</label>
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Central Sound Control Active :</label>
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Active Voicemail Server :</label>
						</div>
					</div>
					<div class="col-sm-3">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '192.168.1.1 - getdial server');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Auto Dial Limit :</label>
						</div>
					</div>
					<div class="col-sm-2">
                        <?php 
							$attr = 'class="form-control"';
							$drop_down = array('Y' => '20');
						?>
						<?= form_dropdown('', $drop_down, '', $attr) ?>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Outbound Auto-Dial Active :</label>
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
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Max FILL Calls per Second :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Allow Custom Dialplan Entries :</label>
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Generate Cross-Server Phone Extensions :</label>
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>User Territories Active :</label>
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Enable Second Webform :</label>
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Enable TTS Integration :</label>
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Enable CallCard :</label>
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Enable Custom List Fields :</label>
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
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>First Login Trigger :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Default Phone Registration Password :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Default Phone Login Password :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Default Server Password :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Slave Database Server :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Custom Dialplan Entry :</label>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="form-group">
                       		<textarea class="form-control" name="" rows="5"></textarea>
					   	</div>
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Reload Dialplan On Servers :</label>
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
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Name :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Address1 :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Address2 :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label City :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Province :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label ZIP Code :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Gender :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Phone Number :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Email :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Comments :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>QC Features Active :</label>
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
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>QC Last Pull Time :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Default Webphone :</label>
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
                <div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Default External Server IP :</label>
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
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Webphone URL :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Webphone System Key :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="">
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
	function nav_active(){
		document.getElementById("set").className = "active";
		document.getElementById("set-setting").className = "active";
	}
	$(document).ready(function() {
		nav_active();
	});
</script>