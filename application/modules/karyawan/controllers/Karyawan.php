<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Karyawan extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('template','session'));
		$this->load->model('query_model','query');
		$this->load->model('user_model','user');
		$this->load->model('table_model','table');
		$this->load->libraries(array('upload','form_validation'));
		$this->template->set_layout('templates/index');
	}

	public function index()
	{
		if(!$this->user->ceklogin())
		{
			redirect(base_url('login'));
		}else if(!$this->user->cekadministrator())
        {
            redirect(base_url('tugas'));
        }

		$this->template->add_title_segment('DATA KARYAWAN');


		$this->data = array(
			'active'		=> 'karyawan',
		);
		$this->template->render("index",$this->data);
	}

	public function table(){

		$parameter = array(
			'draw'		=>	$this->input->post('draw',true),
			'start'		=>	$this->input->post('start',true),
			'length'	=>	$this->input->post('length',true),
			'order'		=>	json_encode($this->input->post('order',true)),
			'columns'	=>	json_encode($this->input->post('columns',true)),
			'filter'	=>	json_encode($this->input->post('filter',true)),
		);

	
        $json_url = base_url('api/karyawan/table');
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
			'nip'				=>	$this->input->post('nip',true),
			'name'				=> 	$this->input->post('name',true),
			'password'			=> 	$this->input->post('password',true),
			'tanggal_lahir'		=> 	$this->input->post('tanggal_lahir',true),
			'jenis_kelamin'		=> 	$this->input->post('jenis_kelamin',true),
			'email'				=> 	$this->input->post('email',true),
			'alamat_lengkap'	=> $this->input->post('alamat_lengkap',true),
		);

	    $json_url = base_url('api/karyawan/simpan');
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
		$json_url = base_url('api/karyawan/detail');
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
			'nip'				=>	$this->input->post('nip',true),
			'name'				=> 	$this->input->post('name',true),
			'password'			=> 	$this->input->post('password',true),
			'tanggal_lahir'		=> 	$this->input->post('tanggal_lahir',true),
			'jenis_kelamin'		=> 	$this->input->post('jenis_kelamin',true),
			'email'				=> 	$this->input->post('email',true),
			'alamat_lengkap'	=> 	$this->input->post('alamat_lengkap',true),
		);

	    $json_url = base_url('api/karyawan/ubah');
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($parameter));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE,true);
        curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
        $data = json_decode(curl_exec($ch),true);
        echo json_encode($data);
	}

	public function ubah_password()
	{
		$parameter = array(
			'id'				=> $this->session->userdata('id'),
			'pass_lama'			=> $this->input->post('pass_lama',true),
			'pass_baru'			=> $this->input->post('pass_baru',true),
			'pass_konf'			=> $this->input->post('pass_konf',true),
		);

	    $json_url = base_url('api/karyawan/ubah_password');
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($parameter));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE,true);
        curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
        $data = json_decode(curl_exec($ch),true);
        echo json_encode($data);
	}

	public function hapus() {
		$parameter = array(
			'id'	=> $this->input->post('id')
		);
		$json_url = base_url('api/karyawan/hapus');
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($parameter));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE,true);
        curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
        $data = json_decode(curl_exec($ch),true);
        echo json_encode($data);
	}

	public function restore() {
		$parameter = array(
			'id'	=> $this->input->post('id')
		);
		$json_url = base_url('api/karyawan/restore');
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
