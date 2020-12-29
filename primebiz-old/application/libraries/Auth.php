<?php if ( ! defined('BASEPATH')) exit('No direct scrip access allowed');

class Auth {

	public function cek_login()
	{
		$this->ci =& get_instance();
		$this->sesi  = $this->ci->session->userdata('islogin');
		if($this->sesi != TRUE)
		{
			// redirect(base_url('login','refresh'));
			redirect('login','refresh');
			exit();
		}
	}
}
