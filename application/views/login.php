<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>getDIAL.tech Login</title>
        <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
        <link rel="icon" href="<?php echo base_url()?>assets/dist/img/getdial-icon.png" type="image/x-icon" />
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url()?>assets/dist/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">

        <script src="<?php echo base_url() ?>assets/plugins/jQuery/jquery-2.2.3.min.js"></script>
        <script src="<?php echo base_url() ?>assets/bootstrap/js/bootstrap.min.js"></script>
    </head>

    <body class="hold-transition login-page">
    <br><br>
        <div class="login-box">
            <div class="login-logo">
                <img src="<?php echo base_url() ?>assets/dist/img/getdial.png" alt="" style="width:170px">
                <p style="font-size:12px; color:#000;">The Next Generations Contact Centers</p>
            </div>
            <div class="login-box-body">
                <p class="login-box-msg">Sign in to start your session</p>
                <form action="<?php echo base_url() ?>dash/" method="post">
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name="" id="" placeholder="Username" autocomplete="off" autofocus required>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name="" id="" placeholder="Password" required>
                    <span class="glyphicon glyphicon-eye-close form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <div class="col-xs-8">
                        <strong style="color:#2ada13;">Success!</strong> Sign In.
                    </div>
                </div>
                </form>
                <div class="social-auth-links text-center">
                    <p>- OR -</p>
                    <a href="" class="btn btn-block btn-primary"><i class="fa fa-user"></i>&ensp;Sign in using Agent</a>
                </div>
                <center><strong>&copy; 2018 <a href="http://getdial.tech" target="blank">getDIAL.tech</a></strong> v2.0.1</center>
            </div>
        </div>
    </body>
</html>
