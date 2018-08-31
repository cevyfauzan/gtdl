<?php
############################################################################################
####  Name:             	system_setting.php                                        	####
####  Type:             	ci views - administrator                     				####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	GOAutoDial Inc. (c) 2011-2013								####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
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
						<input type="text" class="form-control" name="" value="<?= $list['version'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>DB Schema Version :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['db_schema_version'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>DB Schema Update Date :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['db_schema_update_date'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Auto User-add Value :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['auto_user_add_value'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Install Date :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['install_date'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Timeclock End Of Day :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['timeclock_end_of_day'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Timeclock Last Auto Logout :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['timeclock_last_reset_date'];?>">
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
							$drop_down_api = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_api, $list['vdc_agent_api_active'], $attr) ?>
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
							$drop_down_callback = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_callback, $list['agentonly_callback_campaign_lock'], $attr) ?>
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
							$drop_down_sound = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_sound,  $list['sounds_central_control_active'], $attr) ?>
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
						?>
						<?= form_dropdown('', $drop_down_server, $list['active_voicemail_server'], $attr) ?>
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
							$drop_down_auto_dial_limit = array('Y' => '20');
						?>
						<?= form_dropdown('', $drop_down_auto_dial_limit, $list['auto_dial_limit'], $attr) ?>
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
							$drop_down = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down, $list['outbound_autodial_active'], $attr) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Max FILL Calls per Second :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['outbound_calls_per_second'];?>">
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
							$drop_down_custom = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_custom, $list['allow_custom_dialplan'], $attr) ?>
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
							$drop_down_cross = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_cross, $list['generate_cross_server_exten'], $attr) ?>
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
							$drop_down_territories = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_territories, $list['user_territories_active'], $attr) ?>
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
							$drop_down_webform = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_webform, $list['enable_second_webform'], $attr) ?>
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
							$drop_down_tts = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_tts, $list['enable_tts_integration'], $attr) ?>
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
							$drop_down_callcard = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_callcard, $list['callcard_enabled'], $attr) ?>
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
							$drop_down_field = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_field, $list['custom_fields_enabled'], $attr) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>First Login Trigger :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['first_login_trigger'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Default Phone Registration Password :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['default_phone_registration_password'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Default Phone Login Password :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['default_phone_login_password'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Default Server Password :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['default_server_password'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Slave Database Server :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['slave_db_server'];?>">
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
                       		<textarea class="form-control" name="" value="<?= $list['custom_dialplan_entry'];?>" rows="5"></textarea>
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
							$drop_down = array('1' => 'YES','0' => 'NO');
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
						<input type="text" class="form-control" name="" value="<?= $list['label_first_name'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Address1 :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['label_address1'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Address2 :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['label_address2'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label City :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['label_city'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Province :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['label_province'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label ZIP Code :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['label_postal_code'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Gender :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['label_gender'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Phone Number :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['label_phone_number'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Email :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['label_email'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Label Comments :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['label_comments'];?>">
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
							$drop_down_qc_features = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_qc_features, $list['qc_features_active'], $attr) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>QC Last Pull Time :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['qc_last_pull_time'];?>">
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
							$drop_down_webphone = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_webphone, $list['default_webphone'], $attr) ?>
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
							$drop_down_ext_server = array('1' => 'YES','0' => 'NO');
						?>
						<?= form_dropdown('', $drop_down_ext_server, $list['default_external_server_ip'], $attr) ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Webphone URL :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['webphone_url'];?>">
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4" align="right">
						<div class="form-group">
							<label>Webphone System Key :</label>
						</div>
					</div>
					<div class="col-sm-3">
						<input type="text" class="form-control" name="" value="<?= $list['webphone_systemkey'];?>">
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