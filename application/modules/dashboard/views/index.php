<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOURAPIKEYPLEASE"></script>

<style>
     .fc-event-dot:hover{
          cursor: pointer;
     }
     .fc-unthemed .fc-list-item:hover td {
          cursor: pointer;
     }
     .badge {
          width: 150px;
          height: 30px;
          display: inline-block;
          padding: .55em .10em;
          font-size: 75%;
          font-weight: 500 !important;
          line-height: 1.5;
          text-align: center;
          white-space: nowrap;
          vertical-align: baseline;
          border-radius: .25rem;
          transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;
     }
     .badge-success {
          color: #fff !important;
          background-color: #28a745 !important;
     }

     .badge-danger {
          color: #fff !important;
          background-color: #dc3545 !important;
     }
     .badge-warning {
          color: #fff !important;
          background-color: #ffc107 !important;
     }
     .fc-event, .fc-event:hover{
          color: #fff !important;
          cursor: pointer;
     }
     #script-warning {
          display: none;
          background: #eee;
          border-bottom: 1px solid #ddd;
          padding: 0 10px;
          line-height: 40px;
          text-align: center;
          font-weight: bold;
          font-size: 12px;
          color: red;
     }

     #loading {
          display: none;
          position: absolute;
          top: 10px;
          right: 10px;
     }

     #calendar {
          max-width: 900px;
          margin: 40px auto;
          padding: 0 10px;
     }

</style>
<section class="section">
     <div class="row">
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
               <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                         <i class="fas fa-user-tie"></i>
                    </div>
                    <div class="card-wrap">
                         <div class="card-header" style="background-color: #fff;">
                              <h4>Pegawai Aktif</h4>
                         </div>
                         <div class="card-body">
                              <?php
                                   echo @rp($number['jumlah_karyawan']);
                              ?>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
               <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                         <i class="far fa-clipboard"></i>
                    </div>
                    <div class="card-wrap">
                         <div class="card-header" style="background-color: #fff;">
                              <h4>Penugasan Menunggu</h4>
                         </div>
                         <div class="card-body">
                             <?php
                                   echo @rp($number['menunggu']);
                              ?>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
               <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                         <i class="fas fa-clipboard-list"></i>
                    </div>
                    <div class="card-wrap">
                         <div class="card-header" style="background-color: #fff;">
                              <h4>Penugasan Proses</h4>
                         </div>
                         <div class="card-body">
                             <?php
                                   echo @rp($number['proses']);
                              ?>
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-lg-3 col-md-6 col-sm-6 col-12">
               <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                         <i class="fas fa-clipboard-check"></i>
                    </div>
                    <div class="card-wrap">
                         <div class="card-header" style="background-color: #fff;">
                              <h4 title="Total Realisasi Yang Disetujui">Penugasan Selesai</h4>
                         </div>
                         <div class="card-body">
                              <?php
                                   echo @rp($number['selesai']);
                              ?>
                         </div>
                    </div>
               </div>
          </div>
     </div>
     <div class="section-header">
          <h1>Dashboard</h1>
     </div>
     <div class="row">
          <div class="col-lg-8 col-md-12 col-12 col-sm-12">
               <div class="card">
                    <div class="card-header">
                         <h4>Kalender Penugasan</h4>
                         <div class="card-header-action">
                              <a data-collapse="#mycard-collapse2" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                         </div>
                    </div>
                    <div class="collapse show" id="mycard-collapse2">
                         <div class="card-body">
                              <div id='loading'>loading...</div>
                              <div id='calendar'></div>      
                         </div>
                    </div>
               </div>
               <div class="card">
                    <div class="card-header">
                         <h4>Petugas Penugasan</h4>
                         <div class="card-header-action">
                              <a data-collapse="#mycard-collapse4" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                         </div>
                    </div>
                    <div class="collapse show" id="mycard-collapse4">
                         <div class="card-body">
                              <div id='map' style="width: 100%; height: 500px;"></div>      
                         </div>
                    </div>
               </div>
          </div>
          <div class="col-lg-4 col-md-12 col-12 col-sm-12">
               <div class="card">
                    <div class="card-header">
                         <h4>Aktifitas Terakhir</h4>
                    </div>
                    <div class="card-body">
                         <ul class="list-unstyled list-unstyled-border">
                              <?php
                              foreach ($aktifitas as $key => $value):
                              ?>
                              <li class="media">
                                   <img class="mr-3 rounded-circle" width="50" src="<?php echo base_url('assets/stilla/'); ?>img/avatar/avatar-1.png" alt="avatar">
                                   <div class="media-body">
                                        <div class="media-title"><?php echo $value['name'] ?></div>
                                        <div class="text-primary" style="font-size: 9px;"><?php echo ($value['updated_at'] == null?indonesian_date($value['created_at']):indonesian_date($value['updated_at']))?></div>
                                        <span class="text-small text-muted"><?php echo 'Tugas <b>'.$value['tugas'].'</b> status <b>'.text($value['status_pekerjaan']); ?></b>.</span>
                                   </div>
                              </li>
                              <?php
                              endforeach;
                              ?>
                         </ul>
                         <div class="text-center pt-1 pb-1">
                              <a href="<?php echo base_url('tugas') ?>" class="btn btn-primary btn-lg btn-round">
                                   Lihat Semua
                              </a>
                         </div>
                    </div>
               </div>
               <div class="card">
                    <div class="card-header">
                         <h4>Grafik Karyawan</h4>
                         <div class="card-header-action">
                              <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                         </div>
                    </div>
                    <div class="collapse show" id="mycard-collapse">
                         <div class="card-body">
                              <div id="karyawan" style="height: 200px !important;"></div>
                              
                         </div>
                    </div>
               </div>

               <div class="card">
                    <div class="card-header">
                         <h4>Grafik Penugasan</h4>
                         <div class="card-header-action">
                              <a data-collapse="#mycard-collapse1" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                         </div>
                    </div>
                    <div class="collapse show" id="mycard-collapse1">
                         <div class="card-body">
                              <div id="penugasan" style="height: 200px !important;"></div>
                              
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<link href='<?php echo base_url('assets/');?>packages/core/main.css' rel='stylesheet' />
<link href='<?php echo base_url('assets/');?>packages/daygrid/main.css' rel='stylesheet' />
<link href='<?php echo base_url('assets/');?>packages/timegrid/main.css' rel='stylesheet' />
<link href='<?php echo base_url('assets/');?>packages/list/main.css' rel='stylesheet' />
<script src='<?php echo base_url('assets/');?>packages/core/main.js'></script>
<script src='<?php echo base_url('assets/');?>packages/interaction/main.js'></script>
<script src='<?php echo base_url('assets/');?>packages/daygrid/main.js'></script>
<script src='<?php echo base_url('assets/');?>packages/timegrid/main.js'></script>
<script src='<?php echo base_url('assets/');?>packages/list/main.js'></script>
<script src='<?php echo base_url('assets/');?>packages/core/locales/id.js'></script>
<script>

     document.addEventListener('DOMContentLoaded', function() {
          var calendarEl = document.getElementById('calendar');

          var calendar = new FullCalendar.Calendar(calendarEl, {
               locale: 'id',
               plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
               header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,listWeek'
               },
               defaultDate: '<?php echo date('Y-m-d') ?>',
               editable: false,
               navLinks: true,
               eventLimit: true,
               events: {
                    url: '<?php echo base_url('dashboard/calender/') ?>',
                    failure: function() {
                         document.getElementById('script-warning').style.display = 'block'
                    }
               },
               loading: function(bool) {
                    document.getElementById('loading').style.display =
                    bool ? 'block' : 'none';
               },
               
          });

          calendar.render();
     });
</script>
<script type="text/javascript">
     Highcharts.chart('karyawan', {
          chart: {
               plotBackgroundColor: null,
               plotBorderWidth: null,
               plotShadow: false,
               type: 'pie'
          },
          title: {
               text: ''
          },
          tooltip: {
               pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          accessibility: {
               point: {
                    valueSuffix: '%'
               }
          },
          plotOptions: {
               pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                         enabled: false
                    },
                    showInLegend: true
               }
          },
          series: [{
               name: 'Karyawan',
               colorByPoint: true,
               data: [
               <?php
               foreach ($status_karyawan as $key => $value) {
               ?>
                    {
                         name: '<?php echo $value['name']; ?>',
                         y: <?php echo $value['jml']; ?>,
                    },
               <?php
               }
               ?>
                    
               ]
          }]
     });

     Highcharts.chart('penugasan', {
          chart: {
               plotBackgroundColor: null,
               plotBorderWidth: null,
               plotShadow: false,
               type: 'pie'
          },
          title: {
               text: ''
          },
          tooltip: {
               pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
          },
          accessibility: {
               point: {
                    valueSuffix: '%'
               }
          },
          plotOptions: {
               pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                         enabled: false
                    },
                    showInLegend: true
               }
          },
          series: [{
               name: 'Tugas',
               colorByPoint: true,
               data: [
               <?php
               foreach ($status_tugas as $key => $value) {
               ?>
                    {
                         name: '<?php echo $value['name']; ?>',
                         y: <?php echo $value['jml']; ?>,
                    },
               <?php
               }
               ?>
                    
               ]
          }]
     });

     var locations = 
          <?php echo $map_penugasan; ?>;

     var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 10,
          center: new google.maps.LatLng(-6.2218781, 106.76084),
          mapTypeId: google.maps.MapTypeId.ROADMAP
     });

     var infowindow = new google.maps.InfoWindow();

     var marker, i;


     for (i = 0; i < locations.length; i++) {
          var url = "http://maps.google.com/mapfiles/ms/icons/";
          url += locations[i][3] + "-dot.png";

          marker = new google.maps.Marker({
               position: new google.maps.LatLng(locations[i][1], locations[i][2]),
               map: map,
               icon : url, 
          });

          google.maps.event.addListener(marker, 'click', (function(marker, i) {
               return function() {
                    infowindow.setContent(locations[i][0]);
                    infowindow.open(map, marker);
               }
          })(marker, i));
     }
</script>