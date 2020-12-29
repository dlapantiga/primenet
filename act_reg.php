<?php
  // require('API/routeros_api.class.php');
  include('config.php');

  $server     = "hotspot1";
  $room       = ($_POST['room']);
  $password   = ($_POST['namatamu']);
  $profile    = "guest_access";
  // $comment      = "--" . $server . "-" . $iduser . "-" . date("d.m.y") . "-" . rand(100,999);

  $API = new RouterosAPI();
  $API->debug = false;
  $API->connect($iphost,$userhost,$passwdhost);

  $API->write('/ip/hotspot/user/profile/print', false);
  $API->write('?=name='.$profile.'');

  $API->comm("/ip/hotspot/user/add", array(
        "server" => "$server",
        "name" => "$room",
        "password" => "$password",
        "profile" => "$profile",
      ));
  $API->disconnect();

  header('location:Available');
?>
