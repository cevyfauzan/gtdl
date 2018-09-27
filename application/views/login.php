<?php
############################################################################################
####  Name:             	login.php                                                   ####
####  Type:             	ci views - administrator                     				####	
####  Version:          	2.0.0                                                       ####	   
####  Copyright:        	getdial. (c) 2017-2018										####
####  Written by:       	Cevy Fauzan					                              	####
####  Edited by:			Cevy Fauzan				   					 				####
####  License:          	                                                  			####
############################################################################################
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>The Next Generations Contact Centers</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" href="<?php echo base_url()?>assets/dist/img/getdial-icon.png" type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">

        <script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
		<script>
			function post(a){
				$('#message').hide();
				$.ajax({
					type: 'POST',
					url: $(a).attr('action'),
					data: $(a).serialize(),
					success: function(data) {
						$('#message').fadeIn('fast').html(data);
					}
				});
				return false;
			}
		</script>
    </head>

    <body class="hold-transition login-page">
        <div class="login-box">
            <div class="login-logo">
                <img src="<?php echo base_url() ?>assets/dist/img/getdial.png" alt="" style="width:180px">
                <p style="font-size:12px; color:#000;">The Next Generations Contact Centers</p>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">System access</p>
                <form role="login" accept-charset="utf-8" action="<?= base_url() ?>login/check/" onsubmit="return post(this);" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" autofocus required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="password" placeholder="Password" required>
                    <span class="glyphicon glyphicon-eye-close form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <div class="col-xs-8" id="message"></div>
                </div>
                </form>
                <br>
                <center><strong>&copy; 2018 <a href="http://getdial.tech" target="blank">getDIAL.id</a></strong> v 2.0.0</center>
                <center><strong>&copy; Powered by <a href="http://getdial.tech" target="blank">Cicalung-solutions</a></strong></center>
            </div>
        </div>
    </body>
</html>
