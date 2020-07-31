<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aplikasi_m extends CI_Model
{


    public function __construct()
    {
        parent::__construct();
    }

    public function simpan_data($data)
    {
        $this->db->insert('pegawai', $data);
        return TRUE;
    }

    public function ambil($id)
    {
        $this->db->select('*');
        $this->db->from('pegawai');
        $this->db->where('id', $id);
        $q = $this->db->get();
        return $q->row();
    }

    public function ubah_data($data)
    {
        $this->db->where(array('id' => $data['id']));
        $this->db->update('pegawai', $data);
        return TRUE;
    }

    public function hapus($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('pegawai');
    }

    public function data_pegawai()
    {
        $query = $this->db->get('pegawai');
        return $query->result_array();
    }
}

/* End of file Aplikasi_m.php */
