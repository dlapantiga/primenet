<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="description" content="Themes Login Hotspot By Codekece">
    <meta name="author" content="Orochi Oim">
    <link rel="shortcut icon" href="favicon.png">

    <title>Network Management Login</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url();?>assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url();?>assets/dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url();?>assets/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link href="assets/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/dist/css/style.css" rel="stylesheet">

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-6 col-md-8 welcome">

            </div>
            <div class="col-xs-12 col-sm-4 col-md-4">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <h1>Dashboard Login</h1>
                    </div>
                    <div class="panel-body">
                        <form  action="<?php echo base_url('index.php/login/cek_user');?>" method="post" >
                            <?php echo $this->session->flashdata('msg'); ?>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-at fa-fw"></i></span>
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                            </div>
                            <div class="input-group ">
                                <span class="input-group-addon"><i class="fa fa-key fa-fw"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                            </div>
                            <button type="submit" id="loading-example-btn" data-loading-text="Loading..." class="btn btn-default btn-block">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="footer">
        <div class="container">
            <p class="text-center">
                &copy; 2020 By Network Management System, All rigths reserved
            </p>
        </div>
    </div>

    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url();?>assets/vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url();?>assets/dist/js/sb-admin-2.js"></script>

    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.backstretch.js"></script>
    <script>
        $(window).load(function(){
            $('#ModalVoucher').modal('');
        });

        $.backstretch([
          "assets/img/1.jpg",
          "assets/img/2.jpg"
          // "img/3.jpg"
          ], {
            fade: 750,
            duration: 4000
        });
    </script>
</body>

</html>
