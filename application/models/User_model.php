<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model{

	

	public function __construct()

	{

		parent::__construct();

		//$this->load->library('database');

		//$this->load->database();
		$this->db = $this->load->database('default', true);

     }

     

	    

	public function setSession($data)
	{
		$array = array(
			md5('login')	=> true,
			'id'			=> $data['id'],
			'name'			=> $data['name'],
			'role'			=> $data['role'],
		);
		$this->session->set_userdata($array);
		return true;
	}



	public function ceklogin()

	{

		$cek = md5('login');

		if($this->session->userdata($cek))

		{

			return true;

		}else{

			return false;

		}

	}


	public function cekadministrator()

	{

		if($this->session->userdata('role') == 'Administrator')

		{

			return true;

		}else{

			return false;

		}

	}




}

