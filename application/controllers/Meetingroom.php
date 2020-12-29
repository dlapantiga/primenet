<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Meetingroom extends CI_Controller {

	function __Construct()
    {
      	parent:: __Construct();
		$this->load->model('Qdbase_m');
		$this->load->model('date_m');
	}

	public function index() {
		if ($this->session->userdata('haslogin')==TRUE)
		{
			$this->show();
		}else{
			redirect('');
		}
	}

	public function show($query_id=0)
	{
		$this->input->load_query($query_id);
        $query_array = array(
            'roomcari' => $this->input->get('roomcari'),
        );

        $data['query_id'] = $query_id;
        $data['roomcari']=$this->input->get('roomcari');

		$data['title'] = 'PRIMEBIZ HOTEL CIKARANG';
		$data['sign'] = 'Dashboard Login';
		$data['panel'] = 'dashboard/sidepanel';
		$data['container'] = 'dashboard/meetingroom' ;
		$data['hotel'] = 'Primebiz Cikarang';
		$data['arr'] = 'All Rights Reserved';
		$data['judulisi'] = 'Meeting Room' ;
		//$data['roomlist'] = $this->Qdbase_m->show_available();
		$data['roomlist'] = $this->Qdbase_m->show_meeting_room($query_array);
		$data['nourut'] = '1' ;
		$data['isiclass'] = 'fa fa-meetup fa-fw';
		$data['form_actreg'] = site_url('index.php/meetingroom/add') ;
		$data['form_cari'] = site_url('index.php/meetingroom/cari') ;

		$this->Qdbase_m->cekexpiredate();
		$this->load->view('dashboard/dtpl', $data);
	}

	public function add()
	{
		$sdate = date('Y-m-d H:i');
		$stime = date('Hi');
		$udate = strtotime($sdate);

		$durasi = $this->input->post('durasi');
		$convmmen = 86400*$durasi;

		$has = $udate + $convmmen;

		$hdate = date('Y-m-d 12:00', $has);

		$server     = "hotspot1";
		$room 		= $this->input->post('room');
		$password 	= $this->input->post('namatamu');
		$profile    = "meeting_access";

		$startdate = date('M/d/Y');
		$starttime = "12:00:00";
		$event = "if ([len [/ip hotspot user find name=".$room."]] = 1) do={[/ip hotspot user remove [find name=".$room."]] [/ip hotspot active remove [find user=".$room."]] [/system scheduler remove [find name=".$room."]]}";
		$d = $durasi * 24;
		$dh = $d."h";

		//if ($this->routerosapi->connect($this->iphost,$this->userhost,$this->passwdhost)) {
		if ($this->routerosapi->connect($this->session->userdata('iphost'), $this->session->userdata('userhost'), $this->session->userdata('passwdhost'))){
			$this->routerosapi->comm('/ip/hotspot/user/add', array(
				"server" => "$server",
				"name" => "$room",
				"password" => "$password",
				"profile" => "$profile",
			));

			$this->routerosapi->comm('/sys/scheduler/add', array(
				"name" => "$room",
				"start-date" => "$startdate",
				"start-time" => "$starttime",
				"interval" => "$dh",
				"on-event" => "$event",
			));
			
			$this->routerosapi->disconnect();
			$updateroom = $this->Qdbase_m->updatemeetingroomtoreserved($sdate, $stime, $hdate, $room, $password, $durasi);
			redirect('index.php/Meetingroom');
		}

		//$updateroom = $this->Qdbase_m->updatemeetingroomtoreserved($sdate, $stime, $hdate, $room, $password, $durasi);
		//redirect('index.php/Meetingroom');
	}

	function cari() {
        $query_array = array(
            'roomcari' => $this->input->post('roomcari'),
        );

        $query_id = $this->input->save_query($query_array);
        redirect("index.php/Meetingroom/show/$query_id");
    }
}
