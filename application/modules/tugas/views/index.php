<style>
     .media, .media-body {
          overflow: visible !important;
     }

     #map {
          height: 250px;
     }
     
     .controls {
          margin-top: 10px;
          border: 1px solid transparent;
          border-radius: 2px 0 0 2px;
          box-sizing: border-box;
          -moz-box-sizing: border-box;
          height: 32px;
          outline: none;
          box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
     }

     #pac-input {
          background-color: #fff;
          font-family: Roboto;
          font-size: 15px;
          font-weight: 300;
          margin-left: 10px;
          padding: 0 11px 0 13px;
          text-overflow: ellipsis;
          width: 300px;
          top: 55px !important;
          left: 0px !important;
          }

     #pac-input:focus {
          border-color: #4d90fe;
     }

     .pac-container {
          font-family: Roboto;
     }

     #type-selector {
          color: #fff;
          background-color: #4d90fe;
          padding: 5px 11px 0px 11px;
     }

     #type-selector label {
          font-family: Roboto;
          font-size: 13px;
          font-weight: 300;
     }

     #target {
          width: 345px;
     }
     .pac-container {
          display: block !important;
          z-index: 9999;
     }
     .pac-logo:after{
          display: none;
     }
</style>
<section class="section">
     <div class="section-header">
          <h1>Tugas</h1>
          <div class="section-header-breadcrumb">
               <div class="breadcrumb-item active"><a href="#">Transaksi</a></div>
               <div class="breadcrumb-item">Tugas</div>
          </div>
     </div>

     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   <?php
                                   if($this->user->cekadministrator()):
                                   ?>
                                        <button class="btn btn-icon btn-lg btn-info tambah" type="button" title="Tambah Data">
                                             <i class="fas fa-plus"></i> Tambah
                                        </button>
                                   <?php
                                   endif;
                                   ?>
                                   <button type="button" class="refresh btn btn-icon btn-lg btn-success">
                                        <i class="fas fa-sync-alt"></i> Muat Ulang
                                   </button>
                              </h4>
                              <div class="card-header-form">
                                   <a data-collapse="#mycard-collapse" class="btn btn-icon btn-info" href="#"><i class="fas fa-minus"></i></a>
                              </div>
                         </div>
                         <div class="collapse show" id="mycard-collapse">
                              <div class="card-body p-0">
                                   <div style="padding: 30px;">
                                        <div class="table-responsive">
                                             <table class="table" cellpadding="0" cellspacing="0" class="display" width="100%" style="margin-bottom:20px">
                                                  <th>
                                                       Pencarian :
                                                  </th>
                                                  <th>
                                                       <input type="text" name="filter_nama" placeholder="Kode" required="" class="filter_kode form-control" maxlength="20">
                                                  </th>
                                                  <?php
                                                  if($this->user->cekadministrator()):
                                                       ?>
                                                  <th>
                                                       <select class="form-control filter_nama select2" style="width: 100%;">
                                                            <option value="0">Pilih Semua</option>
                                                            <?php
                                                            foreach ($karyawan as $key => $value) {
                                                                 echo "<option value='".$value->id."'>".$value->name."</option>";
                                                            }
                                                            ?>
                                                       </select>
                                                  </th>
                                                  <?php
                                                  else:
                                                  ?>
                                                       <input type="hidden" class="filter_nama">
                                                  <?php
                                                  endif;
                                                  ?>
                                                  <th>
                                                       <select class="form-control select2 filter_status" style="width: 100%;">
                                                            <option value="0">Semua Status</option>
                                                            <option value="menunggu">Menunggu</option>
                                                            <option value="proses">Proses</option>
                                                            <option value="selesai">Selesai</option>
                                                       </select>
                                                  </th>
                                             </table>
                                             <table id="table" class="table align-items-center table-flush">
                                                  <thead class="thead-light">
                                                       <tr>
                                                            <th style="text-align: center;">No</th>
                                                            <th style="text-align: center;">Kode</th>
                                                            <th style="text-align: center;">Pelaksana</th>
                                                            <th style="text-align: center;">Tugas</th>
                                                            <th style="text-align: center;">Tanggal</th>
                                                            <th style="text-align: center;">Status</th>
                                                            <th style="text-align: center;">Aksi</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody class="list">

                                                  </tbody>
                                             </table>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_form" data-backdrop="false">
     <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_pengguna" name="form_pengguna">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tugas</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="hidden" name="id">
                                             <input class="form-control" type="text" name="tugas">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Pegawai</label>
                                        <div class="col-sm-12 col-md-9">
                                             <select class="form-control select2" name="id_karyawan" style="width: 100%;">
                                                  <?php
                                                  foreach ($karyawan as $key => $value) {
                                                       echo "<option value='".$value->id."'>".$value->name."</option>";
                                                  }
                                                  ?>
                                             </select>
                                             <input type="hidden" name="karyawan">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div> 
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal*</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input class="form-control" type="date" name="tanggal">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Keterangan</label>
                                        <div class="col-sm-12 col-md-9">
                                             <textarea class="form-control" style="resize: none;" rows="3" name="keterangan"></textarea>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Pekerjaan*</label>
                                        <div class="col-sm-12 col-md-9">
                                             <select class="select2 form-control" name="status_pekerjaan" style="width: 100%">
                                                  <option value="menunggu">Menunggu</option>
                                                  <option value="proses">Proses</option>
                                                  <option value="selesai">Selesai</option>
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Lokasi</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input id="pac-input" name="alamat" class="form-control alamat" type="text" placeholder="Lokasi Penugasan">
                                             <div id="map"></div>
                                             <input type="hidden" name="data_alamat">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="form-group" style="display:none">
                                   <label for="no_telp">Lat</label>
                                   <input type="form-control" class="form-control lat" name="lat" id="lat">
                              </div>
                              <div class="form-group" style="display:none"> 
                                   <label for="no_telp">Long</label>
                                   <input type="form-control" class="form-control lng" name="lng" id="lng">
                              </div> 
                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="btn" class="btn btn-primary">
                              Simpan
                         </button>
                         <button type="button" class="btn btn-danger" data-dismiss="modal">
                              Batal
                         </button>
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_status" data-backdrop="false">
     <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_status" name="form_status">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-12">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Kode</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" class="form-control kode_status" disabled="">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-12">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tugas</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="text" class="form-control tugas_status" disabled="">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-12">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Status Pekerjaan</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="hidden" name="id">
                                             <select class="select2 form-control" name="pekerjaan_status" style="width: 100%">
                                                  <option value="menunggu">Menunggu</option>
                                                  <option value="proses">Proses</option>
                                                  <option value="selesai">Selesai</option>
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="submit" id="btn_ubah" class="btn btn-primary">
                              Ubah
                         </button>
                         <button type="button" class="btn btn-danger" data-dismiss="modal">
                              Batal
                         </button>
                    </div>
               </form>
          </div>
     </div>
</div>
<div class="modal fade" tabindex="-1" role="dialog" id="modal_detail" data-backdrop="false">
     <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
               <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
               </div>
               <form role="form" id="form_status" name="form_status">
                    <div class="modal-body">
                         <div class="row">
                              <div class="col-md-12">
                                   <div class="form-group row mb-3">
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-4 col-lg-4" style="font-weight: 800">Tugas</label>
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-8 col-lg-8 tugas"></label>
                                   </div>
                                   <div class="form-group row mb-3">
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-4 col-lg-4" style="font-weight: 800">Penanggung Jawab</label>
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-8 col-lg-8 name"></label>
                                   </div>
                                   <div class="form-group row mb-3">
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-4 col-lg-4" style="font-weight: 800">Tanggal</label>
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-8 col-lg-8 tanggal"></label>
                                   </div>
                                   <div class="form-group row mb-3">
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-4 col-lg-4" style="font-weight: 800">Keterangan</label>
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-8 col-lg-8 keterangan"></label>
                                   </div>
                                   <div class="form-group row mb-3">
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-4 col-lg-4" style="font-weight: 800">Status</label>
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-8 col-lg-8 status"></label>
                                   </div>
                                   <div class="form-group row mb-3">
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-4 col-lg-4" style="font-weight: 800">Lokasi</label>
                                        <label for="example-text-input" class="col-form-label text-md-left col-12 col-md-8 col-lg-8 lokasi"></label>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                         <button type="button" class="btn btn-danger" data-dismiss="modal">
                              Tutup
                         </button>
                    </div>
               </form>
          </div>
     </div>
</div>
<script type="text/javascript">
      var geocoder;
     var searchBox;
     var lat;
     var lng;
     var delay = (function(){
          var timer = 0;
          return function(callback, ms){
               clearTimeout(timer);
               timer = setTimeout(callback,ms);
          };
     })();

     dataTable = $('#table').DataTable( {
          paginationType:'full_numbers',
          processing: true,
          serverSide: true,
          filter: false,
          autoWidth:false,
          aLengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
          ajax: {
               url: '<?php echo base_url('tugas/table')?>',
               type: 'POST',
               data: function (data) {
                    data.filter = {    
                         'nama'         : $('.filter_nama').val(),
                         'kode'         : $('.filter_kode').val(),
                         'status'       : $('.filter_status').val(),
                    };
               }
          },
          language: {
               sProcessing: 'Sedang memproses...',
               sLengthMenu: 'Tampilkan _MENU_ entri',
               sZeroRecords: 'Tidak ditemukan data yang sesuai',
               sInfo: 'Menampilkan _START_ sampai _END_ dari _TOTAL_ entri',
               sInfoEmpty: 'Menampilkan 0 sampai 0 dari 0 entri',
               sInfoFiltered: '(disaring dari _MAX_ entri keseluruhan)',
               sInfoPostFix: '',
               sSearch: 'Cari:',
               sUrl: '',
               oPaginate: {
                    sFirst: '<<',
                    sPrevious: '<',
                    sNext: '>',
                    sLast: '>>'
               }
          },
          order: [0, 'desc'],
          columns: [
               {'data':'no'},
               {'data':'kode'},
               {'data':'name'},
               {'data':'tugas'},
               {'data':'tanggal'},
               {'data':'status_pekerjaan'},
               {'data':'aksi','orderable':false},
          ],     
          columnDefs: [
          {
               targets: [0,-1],
               className: 'dt-center'
          }
          ]
     });

     function table_data(){
          dataTable.ajax.reload(null,true);
     }

     $(".filter_nama").change(function(){
           table_data();
     });

     $(".filter_status").change(function(){
          table_data();
     });

     $(".filter_kode").keyup(function(){
          delay(function(){
               table_data();
          }, 800);
     });

     $(".refresh").click(function(){
          table_data();
     });
     
     $("[name=form_pengguna]").on('submit', function(e){
          e.preventDefault();

          $('#btn').text('sedang menyimpan...');
          $('#btn').attr('disabled',true);
          $('.col-sm-12').removeClass('has-error');
          $('.help').empty();

          var form = $('#form_pengguna')[0];
          var data = new FormData(form);
          var url = '<?php echo base_url("tugas/simpan"); ?>';  
          

          Swal.fire({
               text: "Apakah Data ini Ingin Di Simpan?",
               title: "Perhatian",
               icon: 'info',
               showCancelButton: true,
               confirmButtonColor: "#2196F3",
               confirmButtonText: "Simpan",
               cancelButtonText: "Tidak",
               closeOnConfirm: false,
               closeOnCancel: true
          }).then((result) => {
               if (result.value) {
                    $('.confirm').text('sedang menyimpan...');
                    $('.confirm').attr('disabled',true);

                    $.ajax({
                         url: url,
                         type: 'post',
                         data: data,
                         processData:false,
                         contentType:false,
                         cache:false,
                         success: function (res) {
                              var obj = JSON.parse(res);
                              if(obj.status)
                              {
                                   if (obj.success !== true) {
                                        Swal.fire({
                                             text: obj.message,
                                             title: "",
                                             icon: "error",
                                             button: true,
                                             timer: 1000
                                        });
                                   }
                                   else {
                                        Swal.fire({
                                             text: obj.message,
                                             title: "",
                                             icon: "success",
                                             button: true,
                                        }).then((result) => {
                                             if (result.value) {
                                              table_data();
                                              $('#modal_form').modal('hide');
                                         }
                                    });
                                   }
                                   $('#btn').text('Simpan');
                                   $('#btn').attr('disabled',false);
                              }
                              else {
                                   for (var i = 0; i < obj.inputerror.length; i++) 
                                   {
                                        $('[name="'+obj.inputerror[i]+'"]').parent().addClass('has-error');
                                        $('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
                                   }
                                   Swal.fire({
                                        icon: 'error',
                                        text: obj.error_string[0],
                                        title : 'Gagal',
                                        button: true,
                                        timer: 3000
                                   });
                                   $('#btn').text('Simpan');
                                   $('#btn').attr('disabled',false);
                              }
                         }
                    });
               }else{
                    $('.confirm').text('Simpan');
                    $('.confirm').attr('disabled',false);

                    $('#btn').text('Simpan');
                    $('#btn').attr('disabled',false);
               }

          });
     });

     $("[name=form_status]").on('submit', function(e){
          e.preventDefault();

          $('#btn_ubah').text('sedang menyimpan...');
          $('#btn_ubah').attr('disabled',true);
          $('.col-sm-12').removeClass('has-error');
          $('.help').empty();

          var form = $('#form_status')[0];
          var data = new FormData(form);
           var url = '<?php echo base_url("tugas/ubah"); ?>';
          

          Swal.fire({
               text: "Apakah Data ini Ingin Di Simpan?",
               title: "Perhatian",
               icon: 'info',
               showCancelButton: true,
               confirmButtonColor: "#2196F3",
               confirmButtonText: "Simpan",
               cancelButtonText: "Tidak",
               closeOnConfirm: false,
               closeOnCancel: true
          }).then((result) => {
               if (result.value) {
                    $('.confirm').text('sedang menyimpan...');
                    $('.confirm').attr('disabled',true);

                    $.ajax({
                         url: url,
                         type: 'post',
                         data: data,
                         processData:false,
                         contentType:false,
                         cache:false,
                         success: function (res) {
                              var obj = JSON.parse(res);
                              if(obj.status)
                              {
                                   if (obj.success !== true) {
                                        Swal.fire({
                                             text: obj.message,
                                             title: "",
                                             icon: "error",
                                             button: true,
                                             timer: 1000
                                        });
                                   }
                                   else {
                                        Swal.fire({
                                             text: obj.message,
                                             title: "",
                                             icon: "success",
                                             button: true,
                                        }).then((result) => {
                                             if (result.value) {
                                              table_data();
                                              $('#modal_status').modal('hide');
                                         }
                                    });
                                   }
                                   $('#btn_ubah').text('Simpan');
                                   $('#btn_ubah').attr('disabled',false);
                              }
                              else {
                                   for (var i = 0; i < obj.inputerror.length; i++) 
                                   {
                                        $('[name="'+obj.inputerror[i]+'"]').parent().addClass('has-error');
                                        $('[name="'+obj.inputerror[i]+'"]').next().text(obj.error_string[i]); 
                                   }
                                   Swal.fire({
                                        icon: 'error',
                                        text: obj.error_string[0],
                                        title : 'Gagal',
                                        button: true,
                                        timer: 3000
                                   });
                                   $('#btn_ubah').text('Simpan');
                                   $('#btn_ubah').attr('disabled',false);
                              }
                         }
                    });
               }else{
                    $('.confirm').text('Simpan');
                    $('.confirm').attr('disabled',false);

                    $('#btn_ubah').text('Simpan');
                    $('#btn_ubah').attr('disabled',false);
               }

          });
     });

     $(".tambah").click(function(){
          save_method = 'add';
          $('#form_pengguna')[0].reset();
          $('.col-sm-12').removeClass('has-error');
          $('.help').empty();
          $('#modal_form').modal('show');
          $('.modal-title').text('Tambah Tugas');
     });

     function ubah(id)
     {
          save_method = 'edit';
          $('#form_status')[0].reset();
          $('.col-sm-12').removeClass('has-error');
          $('.help').empty();

          $.ajax({
               url : "<?php echo base_url('tugas/lihat/')?>",
               type: "POST",
               data : {
                    id   : id,
               },
               dataType: "JSON",
               success: function(data){
                    $('#modal_status').modal('show');
                    $('.modal-title').text('Ubah Status');
                    $('[name="id"]').val(id);
                    $('[name="pekerjaan_status"]').val(data.data.status_pekerjaan).change();
                    $('.kode_status').val(data.data.kode);
                    $('.tugas_status').val(data.data.tugas);

               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
     }

     function lihat(id)
     {
          save_method = 'edit';
          $('.col-sm-12').removeClass('has-error');
          $('.help').empty();

          $.ajax({
               url : "<?php echo base_url('tugas/lihat/')?>",
               type: "POST",
               data : {
                    id   : id,
               },
               dataType: "JSON",
               success: function(data){
                    $('#modal_detail').modal('show');
                    $('.modal-title').text('Detail Tugas');
                    $('.tugas').html(data.data.tugas);
                    $('.tanggal').html(tanggal_indo(data.data.tanggal));
                    $('.keterangan').html(data.data.keterangan);
                    $('.status').html(data.data.status_pekerjaan);
                    $('.lokasi').html(data.data.alamat);
                    $('.name').html(data.data.name);
                    
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
     }

      function initAutocomplete() {
          var map = new google.maps.Map(document.getElementById('map'), {
               center: {lat: -6.343159, lng: 106.731216},
               zoom: 13,
               mapTypeId: 'roadmap'
          });


          var searchBox = new google.maps.places.SearchBox(document.getElementById('pac-input'));
          map.controls[google.maps.ControlPosition.TOP_CENTER].push(document.getElementById('pac-input'));
          google.maps.event.addListener(searchBox, 'places_changed', function() {
               searchBox.set('map', null);

               var places = searchBox.getPlaces();
               lat = places[0].geometry.location.lat();
               lng = places[0].geometry.location.lng();

               $("#lat").val(lat);
               $("#lng").val(lng);
               var bounds = new google.maps.LatLngBounds();
               var i, place;
               for (i = 0; place = places[i]; i++) {
                  (function(place) {
                     var marker = new google.maps.Marker({

                        position: place.geometry.location
                   });
                     marker.bindTo('map', searchBox, 'map');
                     google.maps.event.addListener(marker, 'map_changed', function() {
                        if (!this.getMap()) {
                           this.unbindAll();
                      }
                 });
                     bounds.extend(place.geometry.location);


                }(place));

             }
             map.fitBounds(bounds);
             searchBox.set('map', map);
             map.setZoom(Math.min(map.getZoom(),12));

        });
     }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOURAPIKEYPLEASE&libraries=places&callback=initAutocomplete" async defer></script>