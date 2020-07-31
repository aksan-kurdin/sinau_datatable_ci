<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aplikasi_m extends CI_Model {

    
    public function __construct()
    {
        parent::__construct();
    }

    public function simpan_data($data) {
        $this->db->insert('pegawai', $data);
        return TRUE;
    }
    
    public function data_pegawai(){
        $query = $this->db->get('pegawai');
        return $query->result_array();
    }
    

}

/* End of file Aplikasi_m.php */
