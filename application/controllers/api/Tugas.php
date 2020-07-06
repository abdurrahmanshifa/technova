<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Tugas extends REST_Controller {

    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->model('query_model','query');
        $this->load->model('table_model','table');
        $this->load->helper('security');
        $this->load->libraries(array('upload','form_validation','email'));
    }

    public function simpan_post()
    {
        $output = $this->_validate();
        if($output['status'] == true)
        {
            $parameter = array(
                'kode'              => kode('tugas','kode'),
                'tugas'             =>  $this->input->post('tugas',true),
                'id_karyawan'       =>  $this->input->post('id_karyawan',true),
                'tanggal'           =>  $this->input->post('tanggal',true),
                'keterangan'        =>  $this->input->post('keterangan',true),
                'status_pekerjaan'  =>  $this->input->post('status_pekerjaan',true),
                'alamat'            =>  $this->input->post('alamat',true),
                'lat'               => $this->input->post('lat',true),
                'long'              => $this->input->post('lng',true),
                'created_at'        => date('Y-m-d H:s:i'),
            );
            $insert = $this->query->insert_id('tugas',$parameter);
            kirim_email_pemberitahuan($insert);
            if (!$insert)
            {
                $output = array(
                    'success'   => false, 
                    'message'   => 'Data gagal ditambahkan',
                    'status'    => TRUE
                );
            }
            else 
            {
                $output = array(
                    'success' => true,
                    'message' => 'Data Berhasil ditambahkan',
                    'status' => TRUE
                );
            }   
        }

        $this->set_response($output, REST_Controller::HTTP_CREATED);
        
    }

    public function ubah_post()
    {
        $parameter = array(
            'status_pekerjaan'  =>  $this->input->post('status_pekerjaan',true),
            'updated_at'        => date('Y-m-d H:s:i'),
        );

        $insert = $this->query->update('tugas',array('id' => $this->input->post('id')),$parameter);
        if (!$insert)
        {
            $output = array(
                'success'   => false, 
                'message'   => 'Data gagal diubah',
                'status'    => TRUE
            );
        }
        else 
        {
            $output = array(
                'success' => true,
                'message' => 'Data Berhasil diubah',
                'status' => TRUE
            );
        }   

        $this->set_response($output, REST_Controller::HTTP_CREATED);
        
    }

    public function detail_post()
    {

        if($this->input->post('id'))
        {
            $query['select']    = 't.*,k.name';
            $query['table']     = 'tugas t';
            $query['join'][0]   = array('karyawan k','k.id = t.id_karyawan');
            $query['where']     = 't.id = "'.$this->input->post('id').'"';
            $result             = $this->query->getRow($query); 
            if(isset($result))
            {
                $output = array(
                    'success'   => true,
                    'message'   => 'Data berhasil ditemukan',
                    'status'    => true,
                    'data'      => $result
                );
            }else{
               $output = array(
                    'success' => false,
                    'message' => 'Data gagal ditemukan',
                    'status' => false
                );
            }
        }else{
            $output = array(
                    'success' => false,
                    'message' => 'Data gagal ditemukan',
                    'status' => false
                );
        }
        
        
        $this->set_response($output, REST_Controller::HTTP_CREATED);
    }

    public function table_post()
    {
        $data = array();
        $draw = $this->input->post("draw");
        $start = $this->input->post("start");
        $length = $this->input->post("length");

        $order = json_decode($_POST['order'],true);
        $columns = json_decode($_POST['columns'],true);

        $_POST['filter'] = json_decode($_POST['filter'],true);
       
        $sort     = isset($columns[$order[0]['column']]['data']) ? strval($columns[$order[0]['column']]['data']) : 'nama';
        $order    = isset($order[0]['dir']) ? strval($order[0]['dir']) : 'asc';
        $list       = $this->table->get_datatables('tugas',$sort,$order);
        $no = 0;
        foreach ($list as $key => $l) {
            $no++;
            $l->no      = $no;
            $l->tanggal = indonesian_date_2($l->tanggal);
            $l->status_pekerjaan = text($l->status_pekerjaan);
            $l->aksi = '
                <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah(\''.$l->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                <a title="Lihat Data" class="btn btn-info btn-sm" onclick="lihat(\''.$l->id.'\')"> <i class="fas fa-eye text-white"></i></a>
                ';
            $data[]     = $l;
        }


        $output = array(
            "recordsTotal"      => $this->table->count_all('tugas',$sort,$order),
            "recordsFiltered"   => $this->table->count_filtered('tugas',$sort,$order),
            "data"              => $data,
        );
       $this->set_response($output, REST_Controller::HTTP_CREATED);
    }

    public function _validate($type=null)
    {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('tugas','tugas','required');
        $this->form_validation->set_rules('tanggal','tanggal','required');
        $this->form_validation->set_rules('alamat','alamat','required');
        

        $config = array(
                    array(
                            'field' => 'tugas',
                            'label' => 'tugas',
                            'rules' => 'required|trim',
                            'errors' => array(
                                    'required'      => 'Tugas tidak boleh kosong!',
                            ),
                    ),
                    array(
                            'field' => 'tanggal',
                            'label' => 'tanggal',
                            'rules' => 'required|trim',
                            'errors' => array(
                                    'required'      => 'Tanggal tidak boleh kosong!',
                            ),
                    ),
                    array(
                            'field' => 'alamat',
                            'label' => 'alamat',
                            'rules' => 'required|trim',
                            'errors' => array(
                                    'required'      => 'alamat tidak boleh kosong!',
                            ),
                    ),
                );

        $this->form_validation->set_rules($config);

        if ($this->form_validation->run() == FALSE)
        {

            $data = array();
            $data['error_string'] = array();
            $data['inputerror'] = array();
            $data['status'] = TRUE;


            if($type == null)
            {
                if(form_error('tugas') != '')
                {
                    $data['inputerror'][] = 'tugas';
                    $data['error_string'][] = strip_tags(form_error('tugas'));
                    $data['status'] = FALSE;
                }
            }
            if(form_error('tanggal') != '')
            {
                $data['inputerror'][] = 'tanggal';
                $data['error_string'][] = strip_tags(form_error('tanggal'));
                $data['status'] = FALSE;
            }
            if(form_error('alamat') != '')
            {
                $data['inputerror'][] = 'data_alamat';
                $data['error_string'][] = strip_tags(form_error('alamat'));
                $data['status'] = FALSE;
            }
            
        }

        return $data;
    }

    function cek_nip()
    {
        if(empty($_POST['nip']))
        {
            return true;
        }else{
            $query['select']    = 'nip';
            $query['table']     = 'karyawan';
            if($this->input->post('id'))
            {
                $query['where']     = 'nip = "'.$this->input->post('nip').'" AND id != "'.$this->input->post('id').'"';
            }else{
                $query['where']     = 'nip = "'.$this->input->post('nip').'"';
            }
            $cek                = $this->query->getNum($query);
            if($cek > 0 )
            {
                return false;
            }else{
                return true;
            }    
        }
        
    }

    function cek_email()
    {
        if(empty($_POST['email']))
        {
            return true;
        }else{
            $query['select']    = 'email';
            $query['table']     = 'karyawan';
            if($this->input->post('id'))
            {
                $query['where']     = 'email = "'.$this->input->post('email').'" AND id != "'.$this->input->post('id').'"';
            }else{
                $query['where']     = 'email = "'.$this->input->post('email').'"';
            }
            $cek                = $this->query->getNum($query);
            if($cek > 0 )
            {
                return false;
            }else{
                return true;
            }    
        }
        
    }

}
