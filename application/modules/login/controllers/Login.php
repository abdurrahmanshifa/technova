<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends MY_Controller {

	public function __construct() {
		parent::__construct();
		$this->load->library(array('template','session'));
		$this->load->model('query_model','query');
		$this->load->model('user_model','user');
		$this->load->model('table_model','table');
	}

	public function index()
	{
		if($this->user->ceklogin())
		{
			redirect(base_url('dashboard'));
		}

		$this->load->view("index");
	}

	public function proses()
	{
		$parameter = array(
			'email'		=>	$this->input->post('email',true),
			'password'	=>	$this->input->post('password',true),
		);

	
        $json_url = base_url('api/login');
        $ch = curl_init( $json_url );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($parameter));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE,true);
        curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
        $data = json_decode(curl_exec($ch),true);
        if($data['success'] == true)
        {
        	$this->user->setSession($data);
        }
        echo json_encode($data);
	}

	public function keluar() {
		$this->session->sess_destroy();
		redirect(base_url());

	}

}
