<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Query_model extends CI_Model{

	

	public function __construct()

	{

		parent::__construct();

		//$this->load->library('database');

		//$this->load->database();
		$this->db = $this->load->database('default', true);

     }

     

	    

	public function insert($table,$data)

	{

		$this->db->insert($table,$data);

		return true;

	}



	public function insert_id($table,$data)

	{

		$this->db->insert($table,$data);

		return $this->db->insert_id();

	}	



	public function update($table,$where,$data)

	{

		// $this->db->where($where);

		// $insert = $this->db->update($table, $data);

		// return $insert;

		return $this->db->update($table, $data, $where);

		//return $this->db->affected_rows();

		// return true;

	}



	public function delete($table,$where)

	{

		$this->db->delete($table, $where);

		return true;

	}



	public function getData($value='') {

		$this->db->select($value['select']);

		$this->db->from($value['table']);



		if (isset($value['where'])) {

			$this->db->where($value['where']);

		}



		if (isset($value['like'])) {

			$this->db->like($value['like']);

		}



		if (isset($value['or_like'])) {

			$this->db->or_like($value['or_like']);

		}



		if (isset($value['join'])) {

			foreach ($value['join'] as $join) {

				$this->db->join($join['0'],$join['1'],'left');

			}

		}



		if (isset($value['group'])) {

			$this->db->group_by($value['group']);

		}



		if (isset($value['limit'])) {

			$this->db->limit($value['limit']);

		}

		if (isset($value['having'])) {

			$this->db->having($value['having']);

		}

		if (isset($value['order'])) {

			$this->db->order_by($value['order']);

		}

		

		$result = $this->db->get()->result();

		return $result;

	}



	public function getRow($value='')

	{

		$this->db->select($value['select']);

		$this->db->from($value['table']);



		if (isset($value['where'])) {

			$this->db->where($value['where']);

		}



		if (isset($value['join'])) {

			foreach ($value['join'] as $join) {

				$this->db->join($join['0'],$join['1'],(isset($join['2'])?$join['2']:null));

			}

		}



		if (isset($value['group'])) {

			$this->db->group_by($value['group']);

		}



		if (isset($value['limit'])) {

			$this->db->limit($value['limit']);

		}

		if (isset($value['order'])) {

			$this->db->order_by($value['order']);

		}

		

		$result = $this->db->get()->row();

		return $result;

	}



	public function getNum($value='')

	{

		$this->db->select($value['select']);

		$this->db->from($value['table']);



		if (isset($value['where'])) {

			$this->db->where($value['where']);

		}



		if (isset($value['join'])) {

			foreach ($value['join'] as $join) {

				$this->db->join($join['0'],$join['1'],'left');

			}

		}



		if (isset($value['group'])) {

			$this->db->group_by($value['group']);

		}



		if (isset($value['limit'])) {

			$this->db->limit($value['limit']);

		}

		if (isset($value['order'])) {

			$this->db->order_by($value['order']);

		}

		

		$result = $this->db->get()->num_rows();

		return $result;

	}

	public function option($value)
	{
		$this->db->select('*');
		$this->db->from($value[0]);
		if(isset($value[1]))
		{
			$this->db->where($value[1]);
		}
		return $this->db->get()->result();
	}



	public function insert_multiple($table,$data){

     	$this->db->insert_batch($table, $data);

    	} 



	public function getID($value='')

	{

		if (isset($value['select'])) {

			$this->db->select($value['select']);

		}

		$this->db->from($value['table']);



		if (isset($value['where'])) {

			$this->db->where($value['where']);

		}



		$result = $this->db->get()->row();

		return $result;

	}


	public function getJumlahTugas($status)
	{
		$this->db->select('id');
		$this->db->from('tugas');
		$this->db->where('status_pekerjaan',$status);
		return $this->db->get()->num_rows();
	}

	public function getAktifitas()
	{
		$this->db->select('t.*,k.name');
		$this->db->from('tugas t');
		$this->db->join('karyawan k','k.id = t.id_karyawan');
		$this->db->order_by('updated_at','DESC');
		$this->db->order_by('created_at','DESC');
		if($this->input->post('limit'))
		{
			$this->db->limit($this->input->post('limit'));	
		}
		
		$result = $this->db->get()->result();

		return $result;
	}
}

