<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Login extends REST_Controller {

    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->model('query_model','query');
        $this->load->model('table_model','table');
        $this->load->helper('security');
        $this->load->libraries(array('upload','form_validation'));
    }

    public function index_post()
    {
        $output = $this->_validate();
        if($output['status'] == true)
        {
            $query['select']    = '*';
            $query['table']     = 'karyawan';
            $query['where']     = 'email = "'.$this->input->post('email',true).'" AND status = 1';
            $cek                = $this->query->getNum($query);
            $data               = $this->query->getRow($query);
            if($cek > 0){

                if(password_verify($this->input->post('password'), $data->password)) {
                    $output = array(
                        'message'   => 'Selamat Datang '.$data->name,
                        'type'      => 'success',
                        'status'    => true,
                        'success'   => true,
                        'id'        => $data->id,
                        'name'      => $data->name,
                        'role'      => $data->role,
                        'title'     => 'Login Berhasil'
                    );

                    $this->query->update('karyawan',array('id' => $data->id),array('last_login' => date('Y-m-d H:s:i')));
                }else{
                    $output = array(
                        'title'     => 'Login Gagal!',
                        'message'   => 'Maaf email atau password anda salah, silahkan ulangi lagi!',
                        'success'   => false,
                        'status'    => true,
                    );
                }
                
            }else{
                $output = array(
                    'username'  => $this->input->post('username'),
                    'title'     => 'Login Gagal!',
                    'message'   => 'Maaf email tidak terdaftar!',
                    'success'   => false,
                    'status'    => true,
                );
            }
        }

        $this->set_response($output, REST_Controller::HTTP_CREATED);
        
    }

    public function _validate()
    {
        $data = array();
        $data['status'] = TRUE;
        $this->form_validation->set_rules('email','email','required|valid_email|trim');
        $this->form_validation->set_rules('password','password','required|trim');

        $config = array(
                    array(
                            'field' => 'password',
                            'label' => 'password',
                            'rules' => 'required',
                            'errors' => array(
                                    'required'   => 'Password tidak boleh kosong!',
                            ),
                    ),
                    array(
                            'field' => 'email',
                            'label' => 'email',
                            'rules' => 'required|valid_email',
                            'errors' => array(
                                    'required'      => 'Alamat email tidak boleh kosong!',
                                    'valid_email'      => 'Alamat email tidak valid!',
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

            if(form_error('password') != '')
            {
                $data['inputerror'][] = 'password';
                $data['error_string'][] = strip_tags(form_error('password'));
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

    function cek_nip()
    {
        if(empty($_POST['nip']))
        {
            return true;
        }else{
            $query['select']    = 'nip';
            $query['table']     = 'karyawan';
            $query['where']     = 'nip = "'.$this->input->post('nip').'"';
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
