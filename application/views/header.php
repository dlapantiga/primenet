<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title><?php echo $title; ?></title>

        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/metisMenu.min.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/startmin.css" rel="stylesheet">
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">
        <link href="<?php echo base_url(); ?>assets/css/square/blue.css" rel="stylesheet" type="text/css" />
        
        <script type="text/javascript">
            function notify_success(pesan){
                new PNotify({
                    title: 'Berhasil',
                    text: pesan,
                    type: 'success',
                    history: false,
                    delay:4000
                });
            }

            function notify_info(pesan){
                new PNotify({
                    title: 'Informasi',
                    text: pesan,
                    type: 'info',
                    history: false,
                    delay:2000
                });
            }

            function notify_error(pesan){
                new PNotify({
                    title: 'Error',
                    text: pesan,
                    type: 'error',
                    history: false,
                    delay:2000
                });
            }
        </script>
    </head>
    <body>

    <div>
         <div class="header">
            <img src="<?php base_url(); ?>assets/img/pbci.png" width="250px" class="center"></img>
        </div>
    </div>