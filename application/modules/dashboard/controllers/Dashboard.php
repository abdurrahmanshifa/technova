<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {

     public function __construct() {
          parent::__construct();
          $this->load->library(array('template','session'));
          $this->load->model('query_model','query');
          $this->load->model('user_model','user');
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

          $this->template->add_title_segment('DASHBOARD');

          $this->data = array(
               'active'            => 'dashboard',
               'number'            => $this->number(),
               'status_karyawan'   => $this->status_karyawan(),
               'status_tugas'   => $this->status_tugas(),
               'aktifitas'     => $this->aktifitas_terakhir(),
               'map_penugasan'     => $this->map_penugasan(),
          );
          $this->template->render("index",$this->data);
     }

     private function number()
     {
          $json_url = base_url('api/dashboard/number');
          $ch = curl_init( $json_url );
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_VERBOSE,true);
          curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
          $data = json_decode(curl_exec($ch),true);
          return $data;
     } 

     private function status_karyawan()
     {
          $json_url = base_url('api/dashboard/status_karyawan');
          $ch = curl_init( $json_url );
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_VERBOSE,true);
          curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
          $data = json_decode(curl_exec($ch),true);
          return $data;
     } 

     private function status_tugas()
     {
          $json_url = base_url('api/dashboard/status_tugas');
          $ch = curl_init( $json_url );
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_VERBOSE,true);
          curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
          $data = json_decode(curl_exec($ch),true);
          return $data;
     }

     private function aktifitas_terakhir($type=null)
     {
          if($type == null)
          {
               $parameter = array(
                    'limit'   => 10
               );     
          }else{
               $parameter = array();
          }

          
          $json_url = base_url('api/dashboard/aktifitas_terakhir');
          $ch = curl_init( $json_url );
          curl_setopt($ch, CURLOPT_POST, 1);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
          curl_setopt($ch, CURLOPT_POSTFIELDS,http_build_query($parameter));
          curl_setopt($ch, CURLOPT_VERBOSE,true);
          curl_setopt($ch, CURLOPT_USERPWD, LAPI_U . ':' . LAPI_P);
          $data = json_decode(curl_exec($ch),true);
          return $data;
     } 

     public function calender()
     {
// Short-circuit if the client did not give us a date range.
          if (!isset($_GET['start']) || !isset($_GET['end'])) {
               die("Please provide a date range.");
          }

// Parse the start/end parameters.
// These are assumed to be ISO8601 strings with no time nor timeZone, like "2013-12-29".
// Since no timeZone will be present, they will parsed as UTC.
          $range_start = parseDateTime($_GET['start']);
          $range_end = parseDateTime($_GET['end']);

// Parse the timeZone parameter if it is present.
          $time_zone = null;
          if (isset($_GET['timeZone'])) {
               $time_zone = new DateTimeZone($_GET['timeZone']);
          }

// Read and parse our events JSON file into an array of event data arrays.
          $json = $this->filejson($_GET['start'],$_GET['end']);
          echo $json;
          exit();
          $input_arrays = json_decode($json, true);

// Accumulate an output array of event data arrays.
          $output_arrays = array();
          foreach ($input_arrays as $array) {

// Convert the input array into a useful Event object
               $event = new Event($array, $time_zone);

// If the event is in-bounds, add it to the output
               if ($event->isWithinDayRange($range_start, $range_end)) {
                    $output_arrays[] = $event->toArray();
               }
          }

// Send JSON to the client.
          echo json_encode($output_arrays);
     }

     public function filejson($start,$end)
     {
          $awal = getTanggal($start);
          $akhir = getTanggal($end);

          $array = array();
          $tgl = array();
          $sesi = array();
          $i=0; 
     
          $result             = $this->aktifitas_terakhir();

          foreach ($result as $value) {
               if($value['status_pekerjaan'] == 'selesai')
               {
                    $array[$i]['id']    = $value['id'];
                    $array[$i]['title'] = $value['name'].' - '.$value['tugas'].' - '.text($value['status_pekerjaan']);
                    $array[$i]['start'] = $value['tanggal'];
                    $array[$i]['color'] = '#28a745';  
               }else if($value['status_pekerjaan'] == 'proses'){
                    $array[$i]['id']    = $value['id'];
                    $array[$i]['title'] = $value['name'].' - '.$value['tugas'].' - '.text($value['status_pekerjaan']);
                    $array[$i]['start'] = $value['tanggal'];
                    $array[$i]['color'] = '#007bff';  
               }else{
                    $array[$i]['id']    = $value['id'];
                    $array[$i]['title'] = $value['name'].' - '.$value['tugas'].' - '.text($value['status_pekerjaan']);
                    $array[$i]['start'] = $value['tanggal'];
                    $array[$i]['color'] = '#dc3545';  
               }

               $i++;
          }
          return json_encode($array);
     }

     public function map_penugasan()
     {
          $data_unit             = $this->aktifitas_terakhir();
          $data_unit_hasil = array();
          $i=0;
          foreach($data_unit as $result){
               $data_unit_hasil[$i][0] = $result['tugas'].'<br><b>'.$result['name'].' - '.$result['status_pekerjaan'].'</b>';
               $data_unit_hasil[$i][1] = $result['lat'];
               $data_unit_hasil[$i][2] = $result['long'];
               if($result['status_pekerjaan'] == 'selesai')
               {
                    $data_unit_hasil[$i][3] = 'green';
               }else if($result['status_pekerjaan'] == 'proses'){
                    $data_unit_hasil[$i][3] = 'yellow';
               }else{
                    $data_unit_hasil[$i][3] = 'red';
               } 
               $i++;
          }
          
          return json_encode($data_unit_hasil);
          
     }
}
