<?php
defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('Asia/Jakarta');

class Report extends CI_Controller {

	function __Construct()
    {
      	parent:: __Construct();
		$this->load->model('Qdbase_m');
		$this->load->model('Date_m');
	}

	public function index() {
		if ($this->session->userdata('haslogin')==TRUE)
		{
			$this->show();
		}else{
			redirect('');
		}
	}

	function show() {
		$periode1=$this->input->post('periode1');
		$periode2=$this->input->post('periode2');
		
		$data['title'] = 'PRIMEBIZ HOTEL CIKARANG';
		$data['sign'] = 'Report';
		$data['panel'] = 'dashboard/sidepanel';
		$data['container'] = 'dashboard/report' ;
		$data['hotel'] = 'Primebiz Cikarang';
		$data['arr'] = 'All Rights Reserved';
		$data['judulisi'] = 'Report' ;
		$data['isiclass'] = 'fa fa-bar-chart fa-fw';
		$data['periode1'] = $periode1;
		$data['periode2'] = $periode2;
		$data['loglist'] = $this->Qdbase_m->getdatalogs($periode1, $periode2);
		$data['nourut'] = '1';
		$data['showdata'] = site_url('index.php/report/show');

		$this->load->view('dashboard/dtpl', $data);
	}
}