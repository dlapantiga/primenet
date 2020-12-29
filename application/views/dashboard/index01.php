<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta http-equiv="refresh" content="60">

        <title><?php echo $title; ?></title>

        <!-- Bootstrap Core CSS -->
        <link href="<?php echo base_url(); ?>assets/css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="<?php echo base_url(); ?>assets/css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="<?php echo base_url(); ?>assets/css/startmin.css" rel="stylesheet">


        <!-- Morris Charts CSS -->
        <!-- <link href="<?php echo base_url(); ?>assets/css/morris.css" rel="stylesheet"> -->

        <!-- Custom Fonts -->
        <link href="<?php echo base_url(); ?>assets/css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script> -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/bootstrap2.min.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/popper.min.js"></script>

        <!-- <script type="text/javascript">
          $(function() {
            startrefresh();
          });

          function startrefresh() {
            setTimeout(startrefresh,30);
          }
        </script> -->
    </head>
    <body>
        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand"><?php echo $hotel; ?></a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">
                    <li class="dropdown navbar-inverse">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> <b>Welcome, <?php echo $this->session->userdata('name'); ?> (<?php echo $this->session->userdata('levelweb'); ?>)</b></a></li>
                        <li><a href="https://api.whatsapp.com/send?phone=087824210618" target="_blank" title="Whatsapp Support"><i class="fa fa-whatsapp fa-fw"></i> Contact Support: 0878 2421 0618</a></li>
                        <!-- <li><a href="#"><i class="fa fa-user fa-fw" title="Setting Profile..."></i> My Profile</a></li> -->
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url(); ?>index.php/websys/logout"><i class="fa fa-sign-out fa-fw" title="Keluar Webservice..."></i> Logout</a></li>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <?php $this->load->view($panel);?>
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="<?php echo $isiclass; ?>"></i> <?php echo $judulisi; ?></h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->

                    <?php $this->load->view($container);?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="<?php echo base_url(); ?>assets/js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="<?php echo base_url(); ?>assets/js/startmin.js"></script>
        <script src="<?php echo base_url(); ?>assets/js/sb-admin-2.js"></script>




        <script type="text/javascript">

        function getroom(id)
        {
          $("#reserveModal").modal('show');
          var serviceurl = "<?php echo base_url() ?>index.php/websys/getroom/" + id;
            $.ajax({
              type: "POST",
              url: serviceurl,
              dataType: "json",
              contentType: "application/json; charset=utf-8",
              contentType: "text/json",
              success: function (success) {
                for (i=0;i < success.length;i++) {
                  var data = success[i];
                  document.getElementById("room").value= data.room;
                }

              },
              error: function (xhr, ajaxOptions, thrownError)
              {
                $.Notification.notify('error','top right','Sorry for this problem!', 'You have an error while processing data. Please try again!');
              }
            });
        }

        function getroomco(id)
        {
          $("#checkoutModal").modal('show');
          var serviceurl = "<?php echo base_url() ?>index.php/websys/getroom/" + id;
            $.ajax({
              type: "POST",
              url: serviceurl,
              dataType: "json",
              contentType: "application/json; charset=utf-8",
              contentType: "text/json",
              success: function (success) {
                for (i=0;i < success.length;i++) {
                  var data = success[i];
                  document.getElementById("room").value= data.room;
                }
              },
              error: function (xhr, ajaxOptions, thrownError)
              {
                $.Notification.notify('error','top right','Sorry for this problem!', 'You have an error while processing data. Please try again!');
              }
            });
        }

        </script>

        <script type="text/javascript">
            document.getElementById('namatamu').onkeypress = function(e)
            {
                var event = e || window.event;
                var charCode = event.which || event.keyCode;

                if ( charCode == '13' ) {
                    document.getElementById('durasi').focus();
                    return false;
                }
            }

            document.getElementById('cancelcl').onclick {
              clearForm();
            }

            function clearForm()
            {
                document.getElementById("namatamu").value = "";
                document.getElementById("durasi").value = "";
            }

        </script>

        <script>
          function onlynumber(evt) {
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57 ))
              return false;
           return true;
         }
       </script>

    </body>
</html>
