<?php
class Date_m extends CI_Model {
	/**
	 * Constructor
	 */
     public function __construct() {
     	parent::__construct();
     }

	function getnow()
	{
		$sql="select now() tgl";
		$q=$this->db->query($sql);
		foreach ($q->result() as $row)
		{
		   $ret=$row->tgl;
		}
		return $ret;
	}

	function getnow2()
	{
		$sql="select DATE_FORMAT(NOW(),'%Y%m%d') tgl";
		$q=$this->db->query($sql);
		foreach ($q->result() as $row)
		{
		   $ret=$row->tgl;
		}
		return $ret;
	}

  function gettime()
	{
		$sql="select TIME_FORMAT(now(), '%H:%i') jam";
		$q=$this->db->query($sql);
		foreach ($q->result() as $row)
		{
		   $ret=$row->jam;
		}
		return $ret;
	}

	function mysqlformat($ndate)
	{
		$date1=substr($ndate,6,4);
		$date2=substr($ndate,3,2);
		$date3=substr($ndate,0,2);
		$ret=$date1."-".$date2."-".$date3;
		return $ret;
	}

	function mysqlformat2($yyyymmdd)
	{
		$date1=substr($yyyymmdd,6,2);
		$date2=substr($yyyymmdd,4,2);
		$date3=substr($yyyymmdd,0,4);
		$ret=$date3."-".$date2."-".$date1;
		return $ret;
	}

	function to_english($yyyymmdd)
	{
		$date1=substr($yyyymmdd,6,2);
		$date2=substr($yyyymmdd,4,2);
		$date3=substr($yyyymmdd,0,4);
		$ret=$date2."/".$date1."/".$date3;
		return $ret;
	}

	function normalformat($ndate)
	{
		//2014-02-02
		//0123456789
		$date1=substr($ndate,8,2);
		$date2=substr($ndate,5,2);
		$date3=substr($ndate,0,4);
		$ret=$date1."-".$date2."-".$date3;
		return $ret;
	}

	function formatreport($ndate)
	{
		//01-01-2020
		//0123456789
		$date1=substr($ndate,6,4);
		$date2=substr($ndate,3,2);
		$date3=substr($ndate,0,2);
		$ret=$date1."-".$date2."-".$date3;
		return $ret;
	}

	function normalformatdatetime($ndate)
	{
		//2014-02-02 23:00
		//0123456789012345
		$date1=substr($ndate,8,2);
		$date2=substr($ndate,5,2);
		$date3=substr($ndate,0,4);
		$time=substr($ndate,11,5);
		$ret=$date1."-".$date2."-".$date3." ".$time;
		return $ret;
	}

	function normaltime($ndate)
	{
		//2014
		//0123
		$date1=substr($ndate,0,2);
		$date2=substr($ndate,2,2);
		$date3=substr($ndate,0,4);
		$ret=$date1.":".$date2;
		return $ret;
	}

	function yyyymmdd($ndate)
	{
		$date1=substr($ndate,8,2);
		$date2=substr($ndate,5,2);
		$date3=substr($ndate,0,4);
		$ret=$date3.$date2.$date1;
		return $ret;
	}

  function normalformatdatetime2($ndate)
	{
		//02-02-2020 23:00
		//0123456789012345
		$date1=substr($ndate,0,2);
		$date2=substr($ndate,3,2);
		$date3=substr($ndate,6,4);
		$time=substr($ndate,11,5);
		$ret=$time." ".$date1."-".$date2."-".$date3;
		return $ret;
	}

  function datecekexpired()
  {
    //$sql =  $this->db->query("select DATE_FORMAT(NOW(),'%Y-%m-%d' ' ' '12:00') tglex");
    //return $sql;

    $sql="select DATE_FORMAT(NOW(),'%Y-%m-%d' ' ' '12:00') tglex";
		$q=$this->db->query($sql);
		foreach ($q->result() as $row)
		{
		   $ret=$row->tglex;
		}
		return $ret;
  }

  function countexpireddate($dateexp)
  {
    //$sql = $this->db->query("select count(*) from (select distinct expiredate from tblroom where expiredate = (select DATE_FORMAT(NOW(),'%d-%m-%Y'))) total");
    //$sql = $this->db->query("select count(*) from (select distinct expiredate from tblroom where expiredate ='".$dateexp."') total");
    $sql = "select distinct count(*) as total from tblroom where expiredate like '".$dateexp."%' ";
    $q=$this->db->query($sql);
		foreach ($q->result() as $row)
		{
		   $ret=$row->total;
		}
		return $ret;
  }

}
