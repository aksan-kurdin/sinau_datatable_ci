<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Aplikasi extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('aplikasi_m');
    }


    public function index()
    {
        $this->data['title'] = 'Aplikasi Sederhana';
        $this->themes->display('content/tampil_data', $this->data);
    }

    public function simpan()
    {
        $this->form_validation->set_rules('txtNama', 'NAMA', 'required');
        $this->form_validation->set_rules('txtKelamin', 'KELAMIN', 'required');
        $this->form_validation->set_rules('txtTelp', 'TELEPON', 'required|numeric');
        $this->form_validation->set_rules('txtKTP', 'KTP', 'required|numeric');
        if ($this->form_validation->run() === TRUE) {
            $info['success'] = TRUE;
            $data = array(
                'nama'      => $this->input->post('txtNama'),
                'kelamin'   => $this->input->post('txtKelamin'),
                'no_telp'   => $this->input->post('txtTelp'),
                'no_ktp'    => $this->input->post('txtKTP')
            );
            $this->aplikasi_m->simpan_data($data);
            $info['message'] = 'Berhasil Tersimpan';
        } else {
            $info['success'] = FALSE;
            $info['errors'] = validation_errors();
        }
        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }


    public function tampil_data_ubah()
    {
        $id = $this->input->post('id');
        $data = $this->aplikasi_m->ambil($id);
        $this->output->set_content_type('application/json')->set_output(json_encode($data));
    }

    public function simpan_ubah()
    {
        $this->form_validation->set_rules('txtId', 'ID', 'required');
        $this->form_validation->set_rules('txtNama', 'NAMA', 'required');
        $this->form_validation->set_rules('txtKelamin', 'KELAMIN', 'required');
        $this->form_validation->set_rules('txtTelp', 'TELEPON', 'required|numeric');
        $this->form_validation->set_rules('txtKTP', 'KTP', 'required|numeric');

        if ($this->form_validation->run() === TRUE) {
            $info['success'] = TRUE;
            $data = array(
                'id' => $this->input->post('txtId'),
                'nama' => $this->input->post('txtNama'),
                'kelamin' => $this->input->post('txtKelamin'),
                'no_telp' => $this->input->post('txtTelp'),
                'no_ktp' => $this->input->post('txtKTP')
            );
            $this->aplikasi_m->ubah_data($data);
            $info['message'] = 'Berhasil diubah';
        } else {
            $info['success'] = FALSE;
            $info['errors'] = validation_errors();
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    public function hapus()
    {
        $this->form_validation->set_rules('id', 'ID', 'required');

        if ($this->form_validation->run() === TRUE) {
            $info['success'] = TRUE;
            $id = $this->input->post('id');
            $data = $this->aplikasi_m->hapus($id);
            $info['message'] = 'Berhasil Terhapus';
        } else {
            $info['success'] = FALSE;
            $info['errors'] = validation_errors();
        }

        $this->output->set_content_type('application/json')->set_output(json_encode($info));
    }

    public function data_pegawai()
    {
        $pegawai = $this->aplikasi_m->data_pegawai();
        $data = array();
        $no = 1;
        foreach ($pegawai as $rows) {
            array_push(
                $data,
                array(
                    $no++,
                    $rows['nama'],
                    $rows['kelamin'],
                    $rows['no_telp'],
                    $rows['no_ktp'],
                    '<a href="javascript:void(0)" class="btn btn-warning btn-sm" onclick="data_ubah(' . "'" . $rows['id'] . "'" . ')">Ubah</a>
                    <a href="javascript:void(0)" class="btn btn-danger btn-sm" onclick="hapus(' . "'" . $rows['id'] . "'" . ')">Hapus</a>'
                )
            );
        }
        $this->output->set_content_type('application/json')->set_output(json_encode(array('data' => $data)));
    }
}

/* End of file Controllername.php */
