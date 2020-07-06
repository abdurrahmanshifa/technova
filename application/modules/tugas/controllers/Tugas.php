<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tugas extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('template','session'));
		$this->load->model('query_model','query');
		$this->load->model('user_model','user');
		$this->load->model('table_model','table');
		$this->load->libraries(array('upload','form_validation','email'));
		$this->template->set_layout('templates/index');
	}

	public function index()
	{
		if(!$this->user->ceklogin())
		{
			redirect(base_url('login'));
		}

		$this->template->add_title_segment('TUGAS KARYAWAN');


		$this->data = array(
			'active'		=> 'tugas',
			'karyawan' 		=> $this->query->option(array('karyawan','status = 1 AND role != "administrator"')),
		);
		$this->template->render("index",$this->data);
	}

	public function table(){

		if(!$this->user->cekadministrator())
		{
			$filter['id_karyawan']	= $this->session->userdata('id');
		}
		$parameter = array(
			'draw'		=>	$this->input->post('draw',true),
			'start'		=>	$this->input->post('start',true),
			'length'	=>	$this->input->post('length',true),
			'order'		=>	json_encode($this->input->post('order',true)),
			'columns'	=>	json_encode($this->input->post('columns',true)),
			'filter'	=>	json_encode($this->input->post('filter',true)),
		);

	
        $json_url = base_url('api/tugas/table');
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($parameter));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE,true);
        curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
        $data = json_decode(curl_exec($ch),true);
        echo json_encode($data);
    }

    public function simpan()
	{

		$parameter = array(
			'tugas'				=>	$this->input->post('tugas',true),
			'id_karyawan'		=> 	$this->input->post('id_karyawan',true),
			'tanggal'			=> 	$this->input->post('tanggal',true),
			'keterangan'		=> 	$this->input->post('keterangan',true),
			'status_pekerjaan'	=> 	$this->input->post('status_pekerjaan',true),
			'alamat'			=> 	$this->input->post('alamat',true),
			'lat'				=> $this->input->post('lat',true),
			'lng'				=> $this->input->post('lng',true),
		);

	    $json_url = base_url('api/tugas/simpan');
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($parameter));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE,true);
        curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
        $data = json_decode(curl_exec($ch),true);
        echo json_encode($data);
	}

	public function lihat()
	{
		$parameter = array(
			'id'	=> $this->input->post('id')
		);
		$json_url = base_url('api/tugas/detail');
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($parameter));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE,true);
        curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
        $data = json_decode(curl_exec($ch),true);
        echo json_encode($data);
	}


	public function ubah()
	{
		$parameter = array(
			'id'				=> 	$this->input->post('id',true),
			'status_pekerjaan'	=> 	$this->input->post('pekerjaan_status',true),
		);

	    $json_url = base_url('api/tugas/ubah');
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($parameter));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE,true);
        curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
        $data = json_decode(curl_exec($ch),true);
        echo json_encode($data);
	}



}
