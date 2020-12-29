<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Availableroom extends CI_Controller {

	function __Construct() {
      	parent:: __Construct();
      	$this->auth->cek_login();
				$this->load->model('m_dbase');
	}

	var $limit = 200;
    var $uri_segment = 5;
    var $empt = 0;

	public function index()
	 {
			 $data['room'] = $this->m_dbase->show_available();
			 $this->template->LOAD('dashboard/main', 'dashboard/available', $data);
             //$this->showroom();
	 }

	public function showroom($sort_by = 'room', $sort_order = 'asc') {
	  $query_array = array(
	    'room' => $this->input->get('room'),
	    'name' => $this->input->get('name'),
	    'durasi' => $this->input->get('durasi'),
		'iactive' => $this->input->get('iactive'),
	  );


    $data['room']=$this->input->get('room');
    $data['header']='Available Room';

	$config['base_url'] = base_url() . "availableroom/index/$sort_by/$sort_order";
    $config['total_rows'] = $this->m_dbase->getavailabe($query_array,true);
	$config['per_page']=$this->limit;
    $config['num_links'] = 2;
    $config['kosong'] = $this->empt;
    $config['uri_segment'] = $this->uri_segment;
    $config['full_tag_open'] = '<ul class="pagination">';
    $config['full_tag_close'] = '</ul>';
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_tag_open'] = '<li>';
    $config['prev_tag_close'] = '</li>';
	$config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['cur_tag_open'] = '<li class="active"><a href="#"><span class="sr-only">(current)</span>';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    $config['first_link']='<span class="glyphicon glyphicon-fast-backward"></span>';
    $config['last_link']='<span class="glyphicon glyphicon-fast-forward"></span>';
    $config['next_link']='<span class="glyphicon glyphicon-step-forward"></span>';
    $config['prev_link']='<span class="glyphicon glyphicon-step-backward"></span>';
    $this->pagination->initialize($config);

    $data['sort_by'] =  $sort_by;
    $data['sort_order'] =  $sort_order;
    $data['halaman']=$this->pagination->create_links();
	$data['roomavailable'] = $this->m_dbase->getlistavailable($query_array,$config['per_page'],$this->uri->segment($this->uri_segment),$sort_by,$sort_order);
	//$data['form_action']   = site_url('siswa2/search/');
    $this->template->LOAD('dashboard/main', 'dashboard/v_available', $data);
	}

}
