<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public $iphost 		= '112.78.150.26' ;
	public $userhost 	= 'system' ;
	public $passwdhost	= 'enigma' ;

	function __Construct()
    {
      	parent:: __Construct();
		$this->load->model('Qdbase_m');
	}

	public function index_old()
	{
		if ($this->session->userdata('haslogin')==TRUE)
		{
			$data['title'] = 'PRIMEBIZ HOTEL CIKARANG';
			$data['sign'] = 'Dashboard Login';
			$data['panel'] = 'dashboard/sidepanel';
			$data['apimtk'] = 'trafik';
			$data['container'] = 'dashboard/containerlist' ;
			$data['hotel'] = 'Primebiz Cikarang';
			$data['arr'] = 'All Rights Reserved';
			$data['judulisi'] = 'Dashboard' ;
			$data['totalsedia'] = $this->Qdbase_m->countavailable();
			$data['nourut'] = '1';

			$this->load->view('dashboard/dtpl', $data);
		}else{
			redirect('');
		}
	}

	public function index()
	{
		if ($this->session->userdata('haslogin')==TRUE)
		{
			$data['title'] = 'PRIMEBIZ HOTEL CIKARANG';
			$data['sign'] = 'Dashboard Login';
			$data['panel'] = 'dashboard/sidepanel';
			$data['apimtk'] = 'trafik';
			$data['container'] = 'dashboard/containerlist' ;
			$data['hotel'] = 'Primebiz Cikarang';
			$data['arr'] = 'All Rights Reserved';
			$data['judulisi'] = 'Dashboard' ;
			$data['isiclass'] = 'fa fa-dashboard fa-fw';
			$data['totalsedia'] = $this->Qdbase_m->countavailable();
			$data['nourut'] = '1';

			// if ($this->routerosapi->connect($this->iphost,$this->userhost,$this->passwdhost))
			if ($this->routerosapi->connect($this->session->userdata('iphost'), $this->session->userdata('userhost'), $this->session->userdata('passwdhost')))
			{
				$this->routerosapi->write('/ip/hotspot/active/getall');
				$hotspot_users = $this->routerosapi->read();
				$this->routerosapi->disconnect();
				$total_results = count($hotspot_users);
				if ($total_results > 0)
				{
					$data['total_results'] = $total_results;
					$table  = '<table class="table table-bordered table-hover">';
					$table .= '<thead>';
					$table .= '<tr>';
					$table .= '<th class="text-center">#</th>';
					$table .= '<th class="col-md-2 text-center">Name</th>';
					$table .= '<th class="text-center">Address</th>';
					$table .= '<th class="text-center">MAC Address</th>';
					$table .= '<th class="text-center">Download</th>';
					$table .= '<th class="text-center">Upload</th>';
					$table .= '<th class="text-center">Uptime</th>';
					$table .= '<th class="text-center"></th>';
					$table .= '</tr>';
					$table .= '</thead>';
					$i = 1;

					foreach ($hotspot_users as $user)
					{
						$table .= '<tr>';
						if($user['user'] != 'free') {
							$table .= '<td class="text-center">'.$i.'</td>';
							$table .= '<td class="col-md-1 text-left">'.$user['user'].'</td>';
							$table .= '<td class="col-md-2 text-center">'.$user['address'].'</td>';
							if (isset($user['mac-address']))
							{
								$table .= '<td class="col-md-2 text-center">'.$user['mac-address'].'</td>';
							}else{
								$table .= '<td class="col-md-2 text-center">&nbsp;</td>';
							}

							// Total Download
							if (($user['bytes-out']) >= '1073741824')
							{
								$byteso = number_format(($user['bytes-out']) / 1073741824, 2) . ' GB';
							}
					        elseif (($user['bytes-out']) >= '1048576')
					        {
					            $byteso = number_format(($user['bytes-out']) / 1048576, 2) . ' MB';
					        }
					        elseif (($user['bytes-out']) >= 1024)
					        {
					            $byteso = number_format(($user['bytes-out']) / 1024, 2) . ' KB';
					        }
					        elseif (($user['bytes-out']) > 1)
					        {
					            $byteso = ($user['bytes-out']) . ' bytes';
					        }
					        elseif (($user['bytes-out']) == 1)
					        {
					            $byteso = ($user['bytes-out']) . ' byte';
					        }
					        else
					        {
					            $byteso = '0 bytes';
					        }
					        $table .= '<td class="col-md-2 text-center">'.$byteso.'</td>';

					        // Total Upload
							if (($user['bytes-in']) >= 1073741824)
							{
								$bytesi = number_format(($user['bytes-in']) / 1073741824, 2) . ' GB';
							}
					        elseif (($user['bytes-in']) >= 1048576)
					        {
					            $bytesi = number_format(($user['bytes-in']) / 1048576, 2) . ' MB';
					        }
					        elseif (($user['bytes-in']) >= 1024)
					        {
					            $bytesi = number_format(($user['bytes-in']) / 1024, 2) . ' KB';
					        }
					        elseif (($user['bytes-in']) > 1)
					        {
					            $bytesi = ($user['bytes-in']) . ' bytes';
					        }
					        elseif (($user['bytes-in']) == 1)
					        {
					            $bytesi = ($user['bytes-in']) . ' byte';
					        }
					        else
					        {
					            $bytesi = '0 bytes';
					        }
							$table .= '<td class="col-md-2 text-center">'.$bytesi.'</td>';
							$table .= '<td class="col-md-1 text-center">'.$user['uptime'].'</td>';
							$table .= '<td>';
							//$table .= anchor('hotspot/update/'.$user['.id'],'<button type="button" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-edit"></span> Update</button>').' ';
							//$table .= anchor('dashboard/remove/'.$user['.id'],'<button type="button" class="btn btn-danger btn-sm text-center"></button>').' ';
							$table .= anchor('index.php/dashboard/remove/'.$user['.id'],'<span class="glyphicon glyphicon-trash text-center"></span>').' ';
							// if ($user['disabled'] == 'false'){
							// 	$table .= anchor('hotspot/disable/'.$user['.id'],'<button type="button" class="btn btn-warning btn-sm"><span class="glyphicon glyphicon-remove"></span> Disable</button>');
							// }else{
							// 	$table .= anchor('hotspot/enable/'.$user['.id'],'<button type="button" class="btn btn-info btn-sm"><span class="glyphicon glyphicon-ok"></span> Enable</button>');
							// }
							$table .= '</td>';
							$table .= '</tr>';
							$i++;
						}
					}
					$table .= '</table>';
					$data['table'] = $table;
				}
			}

			$data['link'] = array('link_tambah' => anchor('index.php/dashboard/add', '<button type="button" class="btn btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span> Quick Add Wifi</button>'));
			$this->Qdbase_m->cekexpiredate();
			$this->load->view('dashboard/dtpl', $data);
		}else{
			redirect('');
		}
	}

	public function remove($id){
		// if ($this->routerosapi->connect($this->iphost,$this->userhost,$this->passwdhost)) {
		if ($this->routerosapi->connect($this->session->userdata('iphost'), $this->session->userdata('userhost'), $this->session->userdata('passwdhost'))){
			$this->routerosapi->write('/ip/hotspot/active/remove',false);
			$this->routerosapi->write('=.id='.$id);
			$hotspot_users = $this->routerosapi->read();
			$this->routerosapi->disconnect();

			redirect('index.php/dashboard');
		}
	}

	// function cekexpiredate()
	// {
	// 	$sdatenow = $this->Date_m->getnow();
	// 	$sdateexpired = $this->Date_m->datecekexpired();
	// 	$countdateexpired = $this->Date_m->countexpireddate($sdateexpired);
	// 	$detaildata = $this->Qdbase_m->cekdataexpired($sdateexpired);
	//
	// 	$stime = $this->Date_m->gettime();
	// 	if ($stime >= '12:00' and $stime <= '12:20' ) {
	// 		if ($sdatenow > $sdateexpired) {
	// 			if ($countdateexpired > 0) {
	// 				foreach ($detaildata->result_array() as $hasil) {
	// 					$getid = $hasil['id'];
	// 					$clearexpiredbyid = $this->Qdbase_m->updatetoavailablebyid($hasil['id']);
	// 				}
	// 			}
	// 		}
	// 	}
	// 	//print $stime
	// }

}
