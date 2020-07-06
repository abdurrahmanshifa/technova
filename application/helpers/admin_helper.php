<?php

function kode($table,$where)
{
    
    $CI = get_instance();
    do {
        $token = "";
        $codeAlphabet= "abcdefghijklmnopqrstuvwxyz";
        $codeAlphabet.= "0123456789";
        $max = strlen($codeAlphabet);

        for ($i=0; $i < 5; $i++) {
            $token .= $codeAlphabet[random_int(0, $max-1)];
        }

        $cek['select']  = $where;
        $cek['table']   = $table;
        $cek['where']   = $where.' = "'.$token.'"';
        $data           = $CI->query->getNum($cek);
    }while ($data >= 1);

    return $token;
}

function rp($data)
{
    if(!empty($data))
    {
        return number_format($data,0,',','.');
    }else{
        return 0;
    }
}

function indonesian_date ($timestamp = '', $date_format = 'l, j F Y | H:i', $suffix = 'WIB') {

    if($timestamp == '0000-00-00 00:00:00' OR $timestamp == null)
    {
        return '-';
        exit();
    }

    if (trim ($timestamp) == '')
    {
        $timestamp = time ();
    }
    elseif (!ctype_digit ($timestamp))
    {
        $timestamp = strtotime ($timestamp);
    }
    # remove S (st,nd,rd,th) there are no such things in indonesia :p
    $date_format = preg_replace ("/S/", "", $date_format);
    $pattern = array (
        '/Mon[^day]/','/Tue[^sday]/','/Wed[^nesday]/','/Thu[^rsday]/',
        '/Fri[^day]/','/Sat[^urday]/','/Sun[^day]/','/Monday/','/Tuesday/',
        '/Wednesday/','/Thursday/','/Friday/','/Saturday/','/Sunday/',
        '/Jan[^uary]/','/Feb[^ruary]/','/Mar[^ch]/','/Apr[^il]/','/May/',
        '/Jun[^e]/','/Jul[^y]/','/Aug[^ust]/','/Sep[^tember]/','/Oct[^ober]/',
        '/Nov[^ember]/','/Dec[^ember]/','/January/','/February/','/March/',
        '/April/','/June/','/July/','/August/','/September/','/October/',
        '/November/','/December/',
    );
    $replace = array ( 'Sen','Sel','Rab','Kam','Jum','Sab','Min',
        'Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu',
        'Jan','Feb','Mar','Apr','Mei','Jun','Jul','Ags','Sep','Okt','Nov','Des',
        'Januari','Februari','Maret','April','Juni','Juli','Agustus','Sepember',
        'Oktober','November','Desember',
    );
    $date = date ($date_format, $timestamp);
    $date = preg_replace ($pattern, $replace, $date);
    $date = "{$date} {$suffix}";
    return $date;
} 

function indonesian_date_2 ($tanggal) {
    if($tanggal == '0000-00-00')
    {
        return $tanggal;
    }else{
        $hari = array ( 1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $bulan = array (1 =>   'Januari',
           'Februari',
           'Maret',
           'April',
           'Mei',
           'Juni',
           'Juli',
           'Agustus',
           'September',
           'Oktober',
           'November',
           'Desember'
       );
        $split      = explode('-', $tanggal);
        $tgl_indo = $split[2] . ' ' . $bulan[ (int)$split[1] ] . ' ' . $split[0];
        $num = date('N', strtotime($tanggal));
        return $hari[$num] . ', ' . $tgl_indo;    
    }
    
} 

function text($data)
{
     return xss(ucwords(strtolower($data)));
}

function xss($var)
{
     return htmlentities($var, ENT_QUOTES, 'UTF-8');
}

function kirim_email_pemberitahuan($id){
    $CI = get_instance();
    $query['select']    = 't.*,k.name,k.email';
    $query['table']     = 'tugas t';
    $query['join'][0]   = array('karyawan k','k.id = t.id_karyawan');
    $query['where']     = 't.id = "'.$id.'"';
    $data               = $CI->query->getRow($query); 

     $CI->email->from('noreply@penugasankaryawan.co.id', 'Penugasan Karyawan'); 
     $CI->email->to($data->email);
     $CI->email->subject('Pemberitahuan Penugasan '.text($data->tugas).' - '.indonesian_date_2($data->tanggal));
     $CI->email->message('
          <html>
          <head>
          <title>Data anda berhasil dikirim</title>
          </head>
          <body>
          <style type="text/css">
          h3 {
               font-family:HelveticaNeue-Light,arial,sans-serif; font-size:16px; line-height: 30px; font-weight:bold;margin:0; padding:0
          }
          </style>
          <table align="center" width="100%" border="0" cellspacing="0" cellpadding="0" bgcolor="#eeeeee" style="padding: 30px;">
          <tbody>
          <td>
          <table align="center" border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
          <td bgcolor="#007bff" style="padding: 15px; color: #fff; text-align: center;">
          <h3>PENUGASAN KARYAWAN</h3>
          </td>
          </tr>
          <tr>
          <td bgcolor="#fff" style="padding: 20px">
          <p style="text-align: justify; color:#000;font-weight:400">
          Hai <b>'.text($data->name).'</b>, Anda mendapatkan tugas <b>'.text($data->tugas).'</b> dengan kode <b>'.text($data->kode).'</b> dan berlokasi di <b>'.$data->alamat.'</b> pada tanggal <b>'.indonesian_date_2($data->tanggal).'</b>. Keterangan : <b><i>"'.text($data->keterangan).'"</i></b>
          </p>

          <p style="text-align: justify; color:#000;font-weight:400">
          Demikian disampaikan, harap segera melaporkan hasil progress melalui aplikasi, <a href="'.base_url().'" target="_blank">Klik disini</a>.
          </p>
          <p style="color:#000;font-weight:400;margin:0">
          Salam, 
          </p>
          <p style="color:#000;font-weight:400;margin:0">
          Administrator
          </p>
          </td>
          </tr>
          </table>
          </td>
          </tbody>
          </table>
          </body>
          </html>     
          ');
     $CI->email->set_mailtype('html');
     $result = $CI->email->send();
     return $result;
}

// Parses a string into a DateTime object, optionally forced into the given timeZone.
function parseDateTime($string, $timeZone=null) {
  $date = new DateTime(
    $string,
    $timeZone ? $timeZone : new DateTimeZone('UTC')
      // Used only when the string is ambiguous.
      // Ignored if string has a timeZone offset in it.
  );
  if ($timeZone) {
    // If our timeZone was ignored above, force it.
    $date->setTimezone($timeZone);
  }
  return $date;
}


// Takes the year/month/date values of the given DateTime and converts them to a new DateTime,
// but in UTC.
function stripTime($datetime) {
  return new DateTime($datetime->format('Y-m-d'));
}

function getTanggal($data)
{
   return substr($data,0, 10);
}
