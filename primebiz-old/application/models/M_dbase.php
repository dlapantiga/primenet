<?php
  defined('BASEPATH') OR exit('No direct script access allowed');
  class M_dbase extends CI_Model
  {
    public function __Construct()
    {
      parent:: __Construct();
    }

    function cek_login($username="", $passh="", $ilogin = "") {
      $query = $this->db->get_where('tblusers',  array('email' => $username, 'password' => $passh, 'iactive' => 0 ,'ilogin' => $ilogin ));
      $query = $query->result_array();
      return $query;
    }

    function get_nameuser($email) {
      $this->db->select('name');
      $this->db->from('tblusers');
      $this->db->where('email', $email);
      $q = $this->db->get();
      $row = $q->row();
      $data = $row->name;
      return $data;
    }

    function show_available() {
      $sql = $this->db->query("SELECT * FROM tblroom WHERE iactive = 0 ORDER BY id");
      return $sql->result_array();
    }

    function show_reserved() {
      $sql = $this->db->query("SELECT * FROM tblroom WHERE iactive = 1 ORDER BY id");
      return $sql->result_array();
    }

    function getavailabe($query_array,$all) {
        $this->db->select('room, durasi');
        $this->db->where('iactive',0);

        // if (strlen($query_array['room'])) {
        //     $this->db->like('room',$query_array['room']);
        // }

        // if (strlen($query_array['durasi'])) {
        //     $this->db->like('durasi',$query_array['durasi']);
        // }

        $this->db->order_by('id');
        $sql_query=$this->db->get('tblroom');
        return $sql_query->num_rows();
    }

    public function getlistavailable($query_array,$perPage, $uri,$sort_by, $sort_order){
      $sql = $this->db->query("SELECT * FROM tblroom ");
      $this->db->where('iactive',0);
      $this->db->order_by('id');
        // if (strlen($query_array['room'])) {
        //     $this->db->like('room',$query_array['room']);
        // }

        // if (strlen($query_array['durasi'])) {
        //     $this->db->like('durasi',$query_array['durasi']);
        // }
      return $this->db->get('tblroom',$perPage, $uri);
    }


  }
