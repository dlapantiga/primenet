<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	function __Construct() {
      	parent:: __Construct();
				$this->load->model('m_dbase');
	}

	public function indextemplate() {
		$this->template->load('index2','index2');
	}

	public function index()
	{
		if ($this->session->userdata('islogin')==TRUE)
		{
			//$this->load->view('dashboard/main');
			$this->template->LOAD('dashboard/main', 'dashboard/dash');
		}else{
			redirect('');
	}
}

}
