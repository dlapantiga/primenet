<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __Construct()
    {
      	parent:: __Construct();
				$this->load->model('m_dbase');
	}

	public function index()
	{
		if ($this->session->userdata('islogin')==TRUE)
		{
			redirect('dashboard');
		}else{
			redirect('');
		}
	}

	function cek_user()
	{
		$username = "";
		$password = "";
		$name = "";

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		// $passh = md5($password);
		$passh = hash('md5', $password);
		$cek = $this->m_dbase->cek_login(strtoupper($username), $passh, 0);
		if(count($cek) == 1) {
			$this->session->set_userdata(array(
				'islogin' => TRUE,
				'username' => $username,
				'name' => $this->m_dbase->get_nameuser($username),
				));

			redirect('dashboard');
		} else {
			 $this->session->set_flashdata('msg','<div class="alert alert-success text-center">Username / Password salah..!!</div>');
        	 //$this->load->view('v_login');
					 redirect('');

         }
		}


	}
