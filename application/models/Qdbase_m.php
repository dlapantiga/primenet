<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class Qdbase_m extends CI_Model
  {
    public function __Construct()
    {
      parent:: __Construct();
      $this->load->model('Date_m');
    }

    function cek_login2($username="", $passh="", $ilogin = "") {
      $query = $this->db->get_where('tbluers',  array('email' => $username, 'password' => $passh, 'iactive' => 0 ,'ilogin' => $ilogin ));
      $query = $query->result_array();
      return $query;
    }

    public function cek_login($username="", $passh="") {
      $active = 0;

      $sql = 'select a.*, b.ntype level from tblusers a, tbltype b ';
      $sql .= 'WHERE a.idtype = b.id ';
      $sql .= 'AND a.email = "'.$username.'" ';
      $sql .= 'AND a.password = "'.$passh.'" ';
      $sql .= 'and a.iactive = ' .$active ;
      $data = $this->db->query($sql)->result_array();
      return $data;

    }

    function get_nameuser($email) {
      $this->db->select('name');
      $this->db->from('tblusers');
      $this->db->where('email', $email);
      $q = $this->db->get();
      $row = $q->row();
      $data = $row->name;
      return $data;
    }

    function show_available() {
      $sql = $this->db->query("SELECT * FROM tblroom WHERE imeeting = 0 and ireserved = 0 and iactive = 0  ORDER BY id");
      return $sql->result_array();
    }

    function show_available2($query_array) {
      $this->db->select(' * ');
      $this->db->where('imeeting', 0);
      $this->db->where('ireserved', 0);
      $this->db->where('iactive', 0);
      $this->db->order_by('id');
      if (strlen($query_array['roomcari'])) {
          $this->db->like('room',$query_array['roomcari']);
      }
      return $this->db->get('tblroom');
    }

    function show_user($query_array) {
      $this->db->select(' a.*, b.ntype level ');
      $this->db->join('tbltype b', 'a.idtype = b.id');
      $this->db->order_by('a.id');
      if (strlen($query_array['usercari'])) {
          $this->db->like('a.name',$query_array['usercari']);
      }
      return $this->db->get('tblusers a');
    }

    function show_reserved() {
      $sql = $this->db->query("SELECT * FROM tblroom WHERE imeeting = 0 and ireserved = 1 and iactive = 0 ORDER BY startdate, starttime asc");
      return $sql->result_array();
    }

    function show_reserved2($query_array) {
      $this->db->select(' * ');
      //$this->db->where('imeeting', 0);
      $this->db->where('ireserved', 1);
      $this->db->where('iactive', 0);
      $this->db->order_by('expiredate');
      if (strlen($query_array['roomcari'])) {
          $this->db->like('room',$query_array['roomcari']);
      }
      return $this->db->get('tblroom');
    }

    function show_meeting_room($query_array) {
      $this->db->select(' * ');
      $this->db->where('imeeting', 1);
      $this->db->where('ireserved', 0);
      $this->db->where('iactive', 0);
      $this->db->order_by('room');
      if (strlen($query_array['roomcari'])) {
          $this->db->like('room',$query_array['roomcari']);
      }
      return $this->db->get('tblroom');
    }

    function countavailable() {
      $sql = $this->db->query("SELECT * FROM tblroom WHERE imeeting = 0 and iactive = 0 ORDER BY id");
      $cnt = $sql->result();
      return count($cnt);
    }

    function updateroomtoreserved($awal, $jam, $akhir, $room, $name, $lama) {
      $sql = $this->db->query("UPDATE tblroom set ireserved = 1, name = '".$name."', startdate = '".$awal."', expiredate = '".$akhir."',
        starttime = '".$jam."', durasi = '".$lama."' where room = '".$room."' ");
      return $sql;
    }

    function updatetoavailable($room) {
      $sql = $this->db->query("UPDATE tblroom set name=DEFAULT, durasi=0, startdate=DEFAULT, starttime=DEFAULT, expiredate=DEFAULT,
        ireserved=0 where room = '".$room."' ");
      return $sql;
    }

    function updatetoavailablebyid($id) {
      $sql = $this->db->query("UPDATE tblroom set name=DEFAULT, durasi=0, startdate=DEFAULT, starttime=DEFAULT, expiredate=DEFAULT,
        ireserved=0 where id = '".$id."' ");
      return $sql;
    }
    function updatemeetingroomtoreserved($awal, $jam, $akhir, $room, $name, $lama) {
      $sql = $this->db->query("UPDATE tblroom set ireserved = 1, name = '".$name."', startdate = '".$awal."', expiredate = '".$akhir."',
        starttime = '".$jam."', durasi = '".$lama."' where room = '".$room."' ");
      return $sql;
    }

    function cekdataexpired($dateexp)
    {
      $this->db->select('*');
      $this->db->from('tblroom');
      $this->db->like('expiredate', $dateexp);
      $q = $this->db->get();
      return $q;
    }

    function cekexpiredate()
    {
      $sdatenow = date('Y-m-d');
      //$sdatenow = $this->Date_m->getnow();
      $sdateexpired = $this->Date_m->datecekexpired();
      $countdateexpired = $this->Date_m->countexpireddate($sdatenow);
      $detaildata = $this->Qdbase_m->cekdataexpired($sdatenow);

      $stime = $this->Date_m->gettime();
      if ($stime >= '11:50' and $stime <= '12:15' ) {
        //if ($sdatenow >= $sdateexpired) {
          if ($countdateexpired > 0) {
            foreach ($detaildata->result_array() as $hasil) {
              //$getid = $hasil['id'];
              //$kamar = $hasil['room'];
              $this->Qdbase_m->insertdatalogauto($hasil['room']);
              $this->Qdbase_m->updatetoavailablebyid($hasil['id']);
            }
          }
        //}
      }
      //print $sdateexpired;
    }

    function getdata($sfield, $sroom){
        $this->db->select($sfield);
        $this->db->from('tblroom');
        $this->db->where('room', $sroom);
        $q = $this->db->get();
        $row = $q->row();
        $data = $row->$sfield;
        return $data;
      }

      function hitunghari($sawal, $sakhir){
        $this->db->select("datediff('".$sakhir."','".$sawal."') hasil");
        $q = $this->db->get();
        $row = $q->row();
        $data = $row->hasil;
        return $data;
      }

      function insertdatalog($room){
        if ($this->routerosapi->connect($this->session->userdata('iphost'), $this->session->userdata('userhost'), $this->session->userdata('passwdhost'))){
          $ina = 0;
          $outa = 0;
          $inu = 0;
          $outu = 0;
          $address = '';
          $macaddr = '';

          $where = '?user='.$room;
          $this->routerosapi->write('/ip/hotspot/active/getall',false);
          $this->routerosapi->write($where);
          $hotspot_active = $this->routerosapi->read();
          $total_active = count($hotspot_active);
          if($total_active > 0) {
            foreach ($hotspot_active as $user)
            {
              $ina =  $user['bytes-in'];
              $outa =  $user['bytes-out'];
              $address = $user['address'];
              $macaddr = $user['mac-address'];
            }
          }

          $where = '?name='.$room;
          $this->routerosapi->write('/ip/hotspot/user/getall',false);
          $this->routerosapi->write($where);
          $hotspot_users = $this->routerosapi->read();
          $total_results = count($hotspot_users);
          foreach ($hotspot_users as $user)
          {
            $inu =  $user['bytes-in'];
            $outu =  $user['bytes-out'];
          }

          $hasilout = $outa + $outu;
          $hasilin = $ina + $outa;
          $this->routerosapi->disconnect();

          //print_r('Download : ' .$outa. ' + ' .$outu. ' = ' .$hasilout);
          //print_r('  Upload : ' .$ina. ' + ' .$inu. ' = ' .$hasilin);

          $sdate = $this->getdata('startdate', $room);
          $user = $this->getdata('name', $room);
          $enddate = date('Y-m-d');
          $totalhari = $this->hitunghari($sdate, $enddate);

          $data = array('room' => $room,
            'name' => $user,
            'startdate' => $sdate,
            'enddate' => $enddate,
            'sumdate' => $totalhari,
            'ipaddress' => $address,
            'macaddress' => $macaddr,
            'usedl' => $hasilout,
            'useul' => $hasilin,
            );

          // print_r($totalhari);
          $this->insertdata($data);
        }


      }

      function insertdatalogauto($room){
        if ($this->routerosapi->connect($this->session->userdata('iphost'), $this->session->userdata('userhost'), $this->session->userdata('passwdhost'))){
          $ina = 0;
          $outa = 0;
          $inu = 0;
          $outu = 0;
          $address = '';
          $macaddr = '';

          $where = '?user='.$room;
          $this->routerosapi->write('/ip/hotspot/active/getall',false);
          $this->routerosapi->write($where);
          $hotspot_active = $this->routerosapi->read();
          $total_active = count($hotspot_active);
          if($total_active > 0) {
            foreach ($hotspot_active as $user)
            {
              $ina =  $user['bytes-in'];
              $outa =  $user['bytes-out'];
              $address = $user['address'];
              $macaddr = $user['mac-address'];
            }
          }

          $where = '?name='.$room;
          $this->routerosapi->write('/ip/hotspot/user/getall',false);
          $this->routerosapi->write($where);
          $hotspot_users = $this->routerosapi->read();
          $total_results = count($hotspot_users);
          foreach ($hotspot_users as $user)
          {
            $inu =  $user['bytes-in'];
            $outu =  $user['bytes-out'];
          }

          $hasilout = $outa + $outu;
          $hasilin = $ina + $outa;

          //print_r('Download : ' .$outa. ' + ' .$outu. ' = ' .$hasilout);
          //print_r('  Upload : ' .$ina. ' + ' .$inu. ' = ' .$hasilin);

          $sdate = $this->getdata('startdate', $room);
          $user = $this->getdata('name', $room);
          $enddate = date('Y-m-d');
          $totalhari = $this->hitunghari($sdate, $enddate);

          $data = array('room' => $room,
            'name' => $user,
            'startdate' => $sdate,
            'enddate' => $enddate,
            'sumdate' => $totalhari,
            'ipaddress' => $address,
            'macaddress' => $macaddr,
            'usedl' => $hasilout,
            'useul' => $hasilin,
            );

          // print_r($totalhari);
          $this->insertdata($data);

          $roomisi = $this->routerosapi->comm('/ip/hotspot/user/getall', array(
    				    ".proplist"=> ".id",
                "?name" => $room,
          ));
    			$this->routerosapi->comm('/ip/hotspot/user/remove', array(
    	            ".id" => $roomisi[0][".id"],
    	            )
              );

          $cekactive = $this->routerosapi->comm('/ip/hotspot/active/getall', array(
            ".proplist"=> ".id",
            "?user" => $room,
          ));
    			$this->routerosapi->comm('/ip/hotspot/active/remove', array(
    	            ".id" => $cekactive[0][".id"],
    	            )
    	        );

          $hapusjadwal = $this->routerosapi->comm('/system/scheduler/getall', array(
    				    ".proplist"=> ".id",
                "?name" => $room,
          ));
          $this->routerosapi->comm('/system/scheduler/remove', array(
    	            ".id" => $hapusjadwal[0][".id"],
    	            )
    	        );

          $this->routerosapi->disconnect();
        }


      }

      function insertdata($data)
      {
         return $this->db->insert('tbllogs', $data);
      }

 function getdatalogs($sdari, $ssampai) {
      // $sql = $this->db->query("SELECT * FROM tbllogs where startdate >= '".$sawal."' and startdate <= '".$ssampai."' order by startdate, enddate");
      // return $sql->result_array();
      $sql = "select * from tbllogs ";
      $sql = $sql."where startdate >= '".$this->Date_m->formatreport($sdari)."' ";
      $sql = $sql."and startdate <= '".$this->Date_m->formatreport($ssampai)."' ";
      $sql = $sql."order by startdate, enddate ";
      $query = $this->db->query($sql);
      return $query->result_array();
    }

    function show_accesspoint($query_array) {
        $this->db->select(' * ');
        if (strlen($query_array['floor'])) {
            $this->db->like('nfl',$query_array['floor']);
          } else {
            $this->db->where('nfl', '01');
          }
        $this->db->where('ishow', 0);

        //$this->db->order_by('id');
        return $this->db->get('tblaccesspoint');
      }

      function getstatusbyip($ip) {
        $command = "ping -c 2 ".$ip;
        $ping = exec($command, $output, $status);
        //print_r($output);
        if ($status === 0) {
        //if (strpos($output[2], 'unreachable') !== FALSE) {
          return '<span style="color:green;">ONLINE</span>';
        } else {
          return '<span style="color:red;">OFFLINE</span>';
        }
      }

      function listfloor() {
        $sql = 'select distinct nfl from tblaccesspoint where ishow = 0 order by id asc';
        $data = $this->db->query($sql);
        return $data->result();
      }

      function listfloornew() {
        $this->db->distinct();
        $this->db->select('nfl');
        $this->db->where('ishow', 0);
        $query = $this->db->get('tblaccesspoint');

        return $query->result();
      }

  }
