<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Table_model extends CI_model
{
	public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);
    }



	private function _get_datatables_query($type=null,$sort=null,$order=null)
    {         
        $orders = json_decode($_POST['order'],true);
        $columns = json_decode($_POST['columns'],true);
        switch ($type) {
            case 'karyawan':
            
                $this->db->select('*');
                $this->db->from('karyawan');
                if($orders[0]['column'] == 0)
                {
                     $this->db->order_by('id',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
                $this->db->where('role != "Administrator"');
                $filter   = $_POST['filter'];
                if(@$filter['nama']) $this->db->like('name', $filter['nama']);
                if(@$filter['jenis_kelamin'])$this->db->where('jenis_kelamin', $filter['jenis_kelamin']);
                if($filter['status'] != 'a')
                {
                    $this->db->where('status', $filter['status']);   
                }
            break;
            case 'tugas':
            
                $this->db->select('t.*,k.name');
                $this->db->from('tugas t');
                $this->db->join('karyawan k','k.id = t.id_karyawan');

                if($orders[0]['column'] == 0)
                {
                     $this->db->order_by('id',$order);
                }else{
                     $this->db->order_by($sort,$order);
                }
                $filter   = $_POST['filter'];

                if(isset($filter['id_karyawan']))
                {
                    $this->db->where('t.id_karyawan', $filter['id_karyawan']);
                }else{
                    if(@$filter['id_karyawan'])$this->db->where('t.id_karyawan', $filter['nama']);
                }
                if(@$filter['status'])$this->db->where('status_pekerjaan', $filter['status']);
            break;
            default:
            break;
        }
    }

 

    function get_datatables($type=null,$sort=null,$order=null)
    {
        $this->_get_datatables_query($type,$sort,$order);
        if($_POST['length'] != -1){
            $this->db->limit($_POST['length'], $_POST['start']);
        }

        $query = $this->db->get();
        return $query->result();
    }



    function count_filtered($type=null)
    {
        $this->_get_datatables_query($type);
        $query = $this->db->get();
        return $query->num_rows();
    }


    public function count_all($type=null)
    {
        $this->_get_datatables_query($type);
        $db_results = $this->db->get();
        $results = $db_results->result();
        $num_rows = $db_results->num_rows();
        return $num_rows;
    }



    

}

