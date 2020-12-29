<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Monitoring extends CI_Controller {

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

    public function show($query_id=0) {
        $this->input->load_query($query_id);
        $query_array = array(
            'floor' => $this->input->get('floor'),
        );

        $data['query_id'] = $query_id;
        $data['floor']=$this->input->get('floor');

		$data['title'] = 'PRIMEBIZ HOTEL CIKARANG';
		$data['sign'] = 'Dashboard Login';
		$data['panel'] = 'dashboard/sidepanel';
		$data['container'] = 'dashboard/monitoring' ;
		$data['hotel'] = 'Primebiz Cikarang';
		$data['arr'] = 'All Rights Reserved';
		//$data['roomlist'] = $this->Qdbase_m->show_reserved();
		$data['listfloor'] = $this->Qdbase_m->listfloornew();
		$data['aplist'] = $this->Qdbase_m->show_accesspoint($query_array);
		$data['nourut'] = '1' ;
		$data['judulisi'] = 'Monitoring AP' ;
    $data['isiclass'] = 'fa fa-wifi fa-fw';
		$data['form_cari'] = site_url('index.php/monitoring/cari') ;

		$this->load->view('dashboard/dtpl', $data);
    }

		function cari() {
					$query_array = array(
							'floor' => $this->input->post('floor'),
					);

					$query_id = $this->input->save_query($query_array);
					redirect("index.php/Monitoring/show/$query_id");
			}

}
