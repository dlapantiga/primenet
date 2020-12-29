    <!-- <div class="footer">
    </div> -->
    <div class="container">
      <p class="text-center">
        <!-- &copy; 2020 PBC - CIKARANG - IT/MIS - All rights reserved -->
        &copy; <?php echo date('Y'); ?> <?php echo $hotel; ?> - IT/MIS - <?php echo $arr; ?>
      </p>
    </div>

    <script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/metisMenu.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/startmin.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/jquery.backstretch.js"></script>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.all.min.js"></script> -->
    <script src="<?php echo base_url(); ?>assets/js/sweetalert2.all.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/myqueryscript.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/icheck.min.js" type="text/javascript"></script>
    <script>
        $.backstretch([
          "assets/img/1.jpg",
          "assets/img/2.jpg"
          // "img/3.jpg"
          ], {
            fade: 750,
            duration: 4000
        });
    </script>

    <script type="text/javascript">
        function showpassword()
        {
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }

        $(function ()
        {
            $('#username').focus();

            $('#show-password').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' // optional
            });

            $('#show-password').on('ifChanged', function(event)
            {
                showpassword();
            });
        });

        document.getElementById('username').onkeypress = function(e)
        {
            var event = e || window.event;
            var charCode = event.which || event.keyCode;

            if ( charCode == '13' ) {
                document.getElementById('password').focus();
                return false;
            }
        }

        document.getElementById('password').onkeypress = function(e)
        {
            var event = e || window.event;
            var charCode = event.which || event.keyCode;

            if ( charCode == '13' ) {
                CheckUsername();
                return false;
            }
        }

        function clearForm()
        {
            document.getElementById("username").value = "";
            document.getElementById("password").value = "";

            document.getElementById('username').focus();
        }

    </script>

    </body>
</html>
