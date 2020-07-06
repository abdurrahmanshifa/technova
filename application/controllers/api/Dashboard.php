<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

class Dashboard extends REST_Controller {

    function __construct($config = 'rest'){
        parent::__construct($config);
        $this->load->model('query_model','query');
        $this->load->model('table_model','table');
    }

    public function number_post()
    {
        $query['select']    = 'id';
        $query['table']     = 'karyawan';
        $query['where']     = 'status = 1 AND role = "Employee"';
        $jumlah_karyawan    = $this->query->getNum($query);

        $menunggu           = $this->query->getJumlahTugas('menunggu');
        $proses           = $this->query->getJumlahTugas('proses');
        $selesai           = $this->query->getJumlahTugas('selesai');     

        $output = array(
            'jumlah_karyawan'   => $jumlah_karyawan,
            'menunggu'          => $menunggu,
            'proses'            => $proses,
            'selesai'           => $selesai

        );
        $this->set_response($output, REST_Controller::HTTP_CREATED);
        
    }

    public function status_karyawan_post()
    {
        $query['select']    = 'id';
        $query['table']     = 'karyawan';
        $query['where']     = 'status = 1 AND role = "Employee"';
        $aktif              = $this->query->getNum($query);

        $query1['select']   = 'id';
        $query1['table']    = 'karyawan';
        $query1['where']    = 'status = 0 AND role = "Employee"';
        $tidak_aktif        = $this->query->getNum($query1);

        $output[0]['name']  = 'Karyawan Aktif';
        $output[0]['jml']   = $aktif;

        $output[1]['name']  = 'Karyawan Tidak Aktif';
        $output[1]['jml']   = $tidak_aktif;


        $this->set_response($output, REST_Controller::HTTP_CREATED);
        
    }

    public function status_tugas_post()
    {
        $menunggu           = $this->query->getJumlahTugas('menunggu');
        $proses           = $this->query->getJumlahTugas('proses');
        $selesai           = $this->query->getJumlahTugas('selesai');  

        $output[0]['name']  = 'Menunggu';
        $output[0]['jml']   = $menunggu;

        $output[1]['name']  = 'Proses';
        $output[1]['jml']   = $proses;

        $output[2]['name']  = 'selesai';
        $output[2]['jml']   = $selesai;


        $this->set_response($output, REST_Controller::HTTP_CREATED);
        
    }

    public function aktifitas_terakhir_post()
    {
        
        $output = $this->query->getAktifitas();

        $this->set_response($output, REST_Controller::HTTP_CREATED);
        
    }

}
