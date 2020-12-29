<?php
  require('<?php echo base_url();?>mikrouter/API/routeros_api.class.php');
  include('<?php echo base_url();?>mikrouter/config.php');

  $server       = "hotspot1";
  $iduser       = ($_POST['room']);
  $password    = ($_POST['namatamu']);
  $profile      = "guest_access";
  //$comment      = "--" . $server . "-" . $iduser . "-" . date("d.m.y") . "-" . rand(100,999);

  $API = new RouterosAPI();
  $API->debug = false;
  $API->connect($iphost,$userhost,$passwdhost);

  $API->write('/ip/hotspot/user/profile/print', false);
  $API->write('?=name='.$profile.'');


  if ($password1 == '') {

      $API->comm("/ip/hotspot/user/add", array(
            "server" => "$server",
            "name" => "$iduser",
            "password" => "$password",
            "profile" => "$profile",
          ));
      $API->disconnect();

  } else {
    //header('location:index.php');
    redirect('availabe');
  }

?>
