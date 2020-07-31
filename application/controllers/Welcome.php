<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$data['title']='Penanganan Form';
		$this->load->view('form_contoh',$data );
	}

	public function proses()
	{
		$this->form_validation->set_rules('txtNIP','nip','required|numeric');
		$this->form_validation->set_rules('txtNama','nama','required');
		if ($this->form_validation->run()===TRUE) {
			$info['success']=TRUE;
			$info['message']='Success!';
		} else {
			$info['success']=FALSE;
			$info['errors']=validation_errors();
		}
		$this->output->set_content_type('application/json')->set_output(json_encode($info));
	}
}
