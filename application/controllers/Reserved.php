<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reserved extends CI_Controller {

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
		$data['container'] = 'dashboard/reservedroom' ;
		$data['hotel'] = 'Primebiz Cikarang';
		$data['arr'] = 'All Rights Reserved';
		//$data['roomlist'] = $this->Qdbase_m->show_reserved();
		$data['roomlist'] = $this->Qdbase_m->show_reserved2($query_array);
		$data['nourut'] = '1' ;
		$data['judulisi'] = 'Reserved Room' ;
    $data['isiclass'] = 'fa fa-check-square-o fa-fw';
		$data['form_co'] = site_url('index.php/reserved/remove') ;
		$data['form_cari'] = site_url('index.php/reserved/cari') ;

		$this->Qdbase_m->cekexpiredate();
		$this->load->view('dashboard/dtpl', $data);

	}

	public function remove(){

		$room 		= $this->input->post('room');

		//insert data untuk jadi laporan
		$this->Qdbase_m->insertdatalog($room);

		if ($this->routerosapi->connect($this->session->userdata('iphost'), $this->session->userdata('userhost'), $this->session->userdata('passwdhost'))){


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


			//$hotspot_users = $this->routerosapi->read();
			$this->routerosapi->disconnect();

			$updateroom = $this->Qdbase_m->updatetoavailable($room);
			redirect('index.php/Reserved');
		}

		//$updateroom = $this->Qdbase_m->updatetoavailable($room);
		//redirect('Reserved');
	}

	function cari() {
        $query_array = array(
            'roomcari' => $this->input->post('roomcari'),
        );

        $query_id = $this->input->save_query($query_array);
        redirect("index.php/Reserved/show/$query_id");
    }
}
