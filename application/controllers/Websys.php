<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Websys extends CI_Controller {

	function __Construct()
    {
      	parent:: __Construct();
		$this->load->model('Qdbase_m');
		$this->load->model('Date_m');
	}

	public function index()
	{
		if ($this->session->userdata('haslogin')==TRUE)
		{
			redirect('index.php/Dashboard');
		}else{
			$data['title'] = 'PRIMEBIZ HOTEL CIKARANG';
			$data['sign'] = 'Dashboard Login';
			$data['content'] = 'login';
			$data['hotel'] = 'Primebiz Cikarang';
			$data['arr'] = 'All Rights Reserved';
			$data['totalsedia'] = $this->Qdbase_m->countavailable();

			$this->Qdbase_m->cekexpiredate();
			$this->load->view('tpl', $data);
		}
	}

	public function login()
	{
		$username = "";
		$password = "";
		$name = "";

		$iphost 	= "192.168.100.1";
		$userhost 	= "syswifi";
		$passwdhost	= "supermiesedap";

		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$passh = md5($password);
		//$passh = hash('md5', $password);
		$cek = $this->Qdbase_m->cek_login($username, $passh);
		if(count($cek) == 1)
		{
			foreach ($cek as $h) {
				$this->session->set_userdata(array(
				'haslogin'		=> TRUE,
				'email'			=> $h['email'],
				'name'			=> $h['name'],
				'iphost' 		=> $iphost,
				'userhost' 		=> $userhost,
				'passwdhost'	=> $passwdhost,
				'levelweb'		=> $h['level'],
				));
			}

			//$this->session->set_flashdata('msg','<div class="alert alert-success text-center">Username / Password benar..!!</div>');
			redirect('index.php/Dashboard');
		} else {
			$this->session->set_flashdata('msg','<div class="alert alert-warning text-center">Username / Password salah..!!</div>');
        	redirect('');
        }
	}

	public function getroom($id)
    {
        $data = $this->db->query("SELECT * FROM tblroom where id=". $id )->result_array();
        echo json_encode($data);
    }

	public function logout()
	{
		$this->session->sess_destroy();
		//redirect('login','refresh');
    	redirect('', 'refresh');
	}

	function cekexpiredate()
	{
		// $sdatenow = $this->Date_m->getnow();
		// $sdateexpired = $this->Date_m->datecekexpired();
		// $countdateexpired = $this->Date_m->countexpireddate($sdateexpired);
		// $detaildata = $this->Qdbase_m->cekdataexpired($sdateexpired);
		//
		// if ($sdatenow > $sdateexpired) {
		// 	if ($countexpireddate > 0) {
		// 		foreach ($data => $hasil) {
		// 			$this->Qdbase_m->updatetoavailablebyid($hasil['id']);
		// 		}
		// 	}
		// }
	}

}
