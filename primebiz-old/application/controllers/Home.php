<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {


	public function indextemplate()
	{
		$this->template->load('index2','index2');
	}

	public function index2()
	{
		$this->load->view('index');
	}

	public function index()
	{
		if ($this->session->userdata('islogin')==TRUE)
		{
			redirect('dashboard');
		}else{
			$this->load->view('index');
		}
	}

}
