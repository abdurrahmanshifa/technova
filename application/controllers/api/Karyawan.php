<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Karyawan extends REST_Controller {

    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->model('query_model','query');
        $this->load->model('table_model','table');
        $this->load->helper('security');
        $this->load->libraries(array('upload','form_validation'));
    }

    public function simpan_post()
    {
        $output = $this->_validate();
        if($output['status'] == true)
        {
            $parameter = array(
                'nip'               =>  $this->input->post('nip'),
                'name'              =>  $this->input->post('name'),
                'password'          =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'tanggal_lahir'     =>  $this->input->post('tanggal_lahir'),
                'jenis_kelamin'     =>  $this->input->post('jenis_kelamin'),
                'email'             =>  $this->input->post('email'),
                'alamat_lengkap'    => $this->input->post('alamat_lengkap'),
                'status'            => 1,
                'role'              => 'Employee',
                'created_at'        => date('Y-m-d H:s:i'),
            );
            $insert = $this->query->insert('karyawan',$parameter);
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
        $output = $this->_validate('ubah');
        if($output['status'] == true)
        {
            if($this->input->post('password'))
            {
                $parameter = array(
                    'nip'               =>  $this->input->post('nip'),
                    'name'              =>  $this->input->post('name'),
                    'password'          =>  password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                    'tanggal_lahir'     =>  $this->input->post('tanggal_lahir'),
                    'jenis_kelamin'     =>  $this->input->post('jenis_kelamin'),
                    'email'             =>  $this->input->post('email'),
                    'alamat_lengkap'    => $this->input->post('alamat_lengkap'),
                    'status'            => 1,
                    'role'              => 'Employee',
                    'updated_at'        => date('Y-m-d H:s:i'),
                );
            }else{
                $parameter = array(
                    'nip'               =>  $this->input->post('nip'),
                    'name'              =>  $this->input->post('name'),
                    'tanggal_lahir'     =>  $this->input->post('tanggal_lahir'),
                    'jenis_kelamin'     =>  $this->input->post('jenis_kelamin'),
                    'email'             =>  $this->input->post('email'),
                    'alamat_lengkap'    => $this->input->post('alamat_lengkap'),
                    'status'            => 1,
                    'role'              => 'Employee',
                    'updated_at'        => date('Y-m-d H:s:i'),
                );
            }
            
            $insert = $this->query->update('karyawan',array('id' => $this->input->post('id')),$parameter);
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
        }

        $this->set_response($output, REST_Controller::HTTP_CREATED);
        
    }

    public function ubah_password_post()
    {
        $output = $this->_validate_pass();
        if($output['status'] == true)
        {
             $parameter = array(
                    'password'          =>  password_hash($this->input->post('pass_baru'), PASSWORD_DEFAULT),
                    'updated_at'        =>  date('Y-m-d H:s:i'),
                    
                );
            
            $insert = $this->query->update('karyawan',array('id' => $this->input->post('id')),$parameter);
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
        }

        $this->set_response($output, REST_Controller::HTTP_CREATED);
        
    }

    public function detail_post()
    {

        if($this->input->post('id'))
        {
            $query['select']    = '*';
            $query['table']     = 'karyawan';
            $query['where']     = 'id = "'.$this->input->post('id').'"';
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

    public function hapus_post()
    {
        if($this->input->post('id'))
        {
            $data = array(
                'status'            => 0,
                'updated_at'        => date('Y-m-d H:s:i'),
            );
            $insert = $this->query->update('karyawan',array('id' => $this->input->post('id')),$data);
            if (!$insert)
            {
                $output = array(
                    'success' => false,
                    'message' => 'Data gagal dinonaktifkan',
                    'status' => true
                );
            }
            else 
            {
                $output = array(
                    'success' => true,
                    'message' => 'Data berhasil dinonaktifkan',
                    'status' => true
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

    public function restore_post()
    {
        if($this->input->post('id'))
        {
            $data = array(
                'status'            => 1,
                'updated_at'        => date('Y-m-d H:s:i'),
            );
            $insert = $this->query->update('karyawan',array('id' => $this->input->post('id')),$data);
            if (!$insert)
            {
                $output = array(
                    'success' => false,
                    'message' => 'Data gagal diaktifkan',
                    'status' => true
                );
            }
            else 
            {
                $output = array(
                    'success' => true,
                    'message' => 'Data berhasil diaktifkan',
                    'status' => true
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
        $list       = $this->table->get_datatables('karyawan',$sort,$order);
        $no = 0;
        foreach ($list as $key => $l) {
            $no++;
            $l->no      = $no;
            $l->status  = ($l->status == 1 ?'Aktif':'Tidak Aktif');
            $l->last_login = indonesian_date($l->last_login);
            if($l->status == 'Aktif')
            {
                $l->aksi = '
                <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah(\''.$l->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                <a title="Lihat Data" class="btn btn-info btn-sm" onclick="lihat(\''.$l->id.'\')"> <i class="fas fa-eye text-white"></i></a>
                <a title="Hapus Data" class="btn btn-danger btn-sm" onclick="hapus(\''.$l->id.'\')"> <i class="fas fa-trash-alt text-white"></i></a>
                ';
            }else{
                $l->aksi = '
                <a title="Ubah Data" class="btn btn-success btn-sm" onclick="ubah(\''.$l->id.'\')"> <i class="fas fa-edit text-white"></i></a>
                <a title="Lihat Data" class="btn btn-info btn-sm" onclick="lihat(\''.$l->id.'\')"> <i class="fas fa-eye text-white"></i></a>
                <a title="Aktifkan Data" class="btn btn-primary btn-sm" onclick="restore(\''.$l->id.'\')"> <i class="fas fa-trash-restore-alt text-white"></i></a>
                ';
            }
            $data[]     = $l;
        }


        $output = array(
            "recordsTotal"      => $this->table->count_all('karyawan',$sort,$order),
            "recordsFiltered"   => $this->table->count_filtered('karyawan',$sort,$order),
            "data"              => $data,
        );
       $this->set_response($output, REST_Controller::HTTP_CREATED);
    }

    public function _validate($type=null)
    {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('nip','NIP','required|callback_cek_nip|is_numeric|min_length[10]');
        $this->form_validation->set_rules('name','name','required');
        if($type == null)
        {
            $this->form_validation->set_rules('password','password','required|min_length[8]|alpha_numeric');            
        }
        $this->form_validation->set_rules('tanggal_lahir','tanggal_lahir','required');
        $this->form_validation->set_rules('email','email','required|valid_email|callback_cek_email');

        $config = array(
                    array(
                            'field' => 'nip',
                            'label' => 'nip',
                            'rules' => 'required|callback_cek_nip|is_numeric|min_length[10]',
                            'errors' => array(
                                    'required'   => 'NIP tidak boleh kosong!',
                                    'cek_nip'  => 'NIP sudah terdaftar disistem!',
                                    'is_numeric' => 'NIP hanya boleh angka!',
                                    'min_length'    => 'Panjang minimal 10 karakter!'
                            ),
                    ),
                    array(
                            'field' => 'name',
                            'label' => 'name',
                            'rules' => 'required|trim',
                            'errors' => array(
                                    'required' => 'Nama lengkap tidak boleh kosong!',
                            ),
                    ),
                    array(
                            'field' => 'password',
                            'label' => 'password',
                            'rules' => 'required|min_length[8]|alpha_numeric|trim',
                            'errors' => array(
                                    'required'      => 'Password tidak boleh kosong!',
                                    'min_length'    => 'Panjang minimal 8 karakter!'
                            ),
                    ),
                    array(
                            'field' => 'tanggal_lahir',
                            'label' => 'tanggal_lahir',
                            'rules' => 'required|trim',
                            'errors' => array(
                                    'required'      => 'Tanggal lahir tidak boleh kosong!',
                            ),
                    ),
                    array(
                            'field' => 'email',
                            'label' => 'email',
                            'rules' => 'required|valid_email|callback_cek_email',
                            'errors' => array(
                                    'required'      => 'Alamat email tidak boleh kosong!',
                                    'valid_email'      => 'Alamat email tidak valid!',
                                    'cek_email'     => 'Email sudah terdaftar disistem!',
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


            if(form_error('nip') != '')
            {
                $data['inputerror'][] = 'nip';
                $data['error_string'][] = strip_tags(form_error('nip'));
                $data['status'] = FALSE;
            }

            if(form_error('name') != '')
            {
                $data['inputerror'][] = 'name';
                $data['error_string'][] = strip_tags(form_error('name'));
                $data['status'] = FALSE;
            }
            if($type == null)
            {
                if(form_error('password') != '')
                {
                    $data['inputerror'][] = 'password';
                    $data['error_string'][] = strip_tags(form_error('password'));
                    $data['status'] = FALSE;
                }
            }
            if(form_error('tanggal_lahir') != '')
            {
                $data['inputerror'][] = 'tanggal_lahir';
                $data['error_string'][] = strip_tags(form_error('tanggal_lahir'));
                $data['status'] = FALSE;
            }
            if(form_error('email') != '')
            {
                $data['inputerror'][] = 'email';
                $data['error_string'][] = strip_tags(form_error('email'));
                $data['status'] = FALSE;
            }
            
        }

        return $data;
    }

    public function _validate_pass()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('pass_lama',true) == '')
        {
            $data['inputerror'][] = 'pass_lama';
            $data['error_string'][] = 'Password tidak boleh kosong';
            $data['status'] = FALSE;
        }else{
            $query['select']    = 'password';
            $query['table']     = 'karyawan';
            $query['where']     = 'id = "'.$this->input->post('id',true).'"';
            $cek                = $this->query->getRow($query);
            
            if(!password_verify($this->input->post('pass_lama'), $cek->password))
            {
                $data['inputerror'][] = 'pass_lama';
                $data['error_string'][] = 'Password lama tidak sama, silahkan ulangi lagi.';
                $data['status'] = FALSE;
            }
        }

        if($this->input->post('pass_baru',true) == '')
        {
            $data['inputerror'][] = 'pass_baru';
            $data['error_string'][] = 'Password tidak boleh kosong';
            $data['status'] = FALSE;
        }

        if($this->input->post('pass_konf',true) == '')
        {
            $data['inputerror'][] = 'pass_konf';
            $data['error_string'][] = 'Password tidak boleh kosong';
            $data['status'] = FALSE;
        }else if($this->input->post('pass_baru',true) != $this->input->post('pass_konf',true)){
            $data['inputerror'][] = 'pass_konf';
            $data['error_string'][] = 'Password konfirmasi tidak sama';
            $data['status'] = FALSE;
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
