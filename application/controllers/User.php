<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class User extends CI_Controller {

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
        'usercari' => $this->input->get('usercari'),
    );

    $data['query_id'] = $query_id;
    $data['usercari']=$this->input->get('usercari');

		$data['title'] = 'PRIMEBIZ HOTEL CIKARANG';
		$data['sign'] = 'Dashboard Login';
		$data['panel'] = 'dashboard/sidepanel';
		$data['container'] = 'dashboard/user' ;
		$data['hotel'] = 'Primebiz Cikarang';
		$data['arr'] = 'All Rights Reserved';
		$data['judulisi'] = 'User Management' ;
		//$data['roomlist'] = $this->Qdbase_m->show_available();
		$data['userlist'] = $this->Qdbase_m->show_user($query_array);
		$data['nourut'] = '1' ;
    $data['isiclass'] = 'fa fa-user fa-fw';
    $data['form_actreg'] = site_url('index.php/user/add') ;
		$data['form_cari'] = site_url('index.php/user/cari') ;
    $data['link'] = array('link_tambah' => anchor('index.php/User/add', '<button type="button" class="btn btn-primary btn-sm"><span class="fa fa-pencil-square-o fa-fw"></span> Add User...</button>'));
    //$data['link'] = array('link_tambah' => anchor('index.php/User/add', '<a data-toggle="modal" title="Edit user..." data-target="#reserveModal"><i class="fa fa-pencil-square-o fa-fw"></i>  Tambah</a>'));
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
		$profile    = "guest_access";

		//if ($this->routerosapi->connect($this->iphost,$this->userhost,$this->passwdhost)) {
		if ($this->routerosapi->connect($this->session->userdata('iphost'), $this->session->userdata('userhost'), $this->session->userdata('passwdhost'))){
			$this->routerosapi->comm('/ip/hotspot/user/add', array(
				"server" => "$server",
				"name" => "$room",
				"password" => "$password",
				"profile" => "$profile",
			));
			$this->routerosapi->disconnect();
			$updateroom = $this->Qdbase_m->updateroomtoreserved($sdate, $stime, $hdate, $room, $password, $durasi);
			redirect('index.php/Available');
		}

		//$updateroom = $this->Qdbase_m->updateroomtoreserved($sdate, $stime, $hdate, $room, $password, $durasi);
		//redirect('Available');
	}

	function cari() {
        $query_array = array(
            'usercari' => $this->input->post('usercari'),
        );

        $query_id = $this->input->save_query($query_array);
        redirect("index.php/User/show/$query_id");
    }
}
