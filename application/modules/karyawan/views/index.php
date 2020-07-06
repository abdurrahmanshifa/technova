<section class="section">
     <div class="section-header">
          <h1>Karyawan</h1>
          <div class="section-header-breadcrumb">
               <div class="breadcrumb-item active"><a href="#">Master Data</a></div>
               <div class="breadcrumb-item">Karyawan</div>
          </div>
     </div>

     <div class="section-body">
          <div class="row">
               <div class="col-12">
                    <div class="card">
                         <div class="card-header">
                              <h4>
                                   <button class="btn btn-icon btn-lg btn-info tambah" type="button" title="Tambah Data">
                                        <i class="fas fa-plus"></i> Tambah
                                   </button>
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
                                                       <input type="text" name="filter_nama" placeholder="Nama" required="" class="filter_nama form-control" maxlength="20">
                                                  </th>
                                                  <th>
                                                       <select class="form-control select2 filter_kelamin" style="width: 100%;">
                                                            <option value="0">Semua Kelamin</option>
                                                            <option value="Laki - laki">Laki - laki</option>
                                                            <option value="Perempuan">Perempuan</option>
                                                       </select>
                                                  </th>
                                                  <th>
                                                       <select class="form-control select2 filter_status" style="width: 100%;">
                                                            <option value="a">Semua Status</option>
                                                            <option value="1">Aktif</option>
                                                            <option value="0">Tidak Aktif</option>
                                                       </select>
                                                  </th>
                                             </table>
                                             <table id="table" class="table align-items-center table-flush">
                                                  <thead class="thead-light">
                                                       <tr>
                                                            <th style="text-align: center;">No</th>
                                                            <th style="text-align: center;">NIP</th>
                                                            <th style="text-align: center;">Nama</th>
                                                            <th style="text-align: center;">Jenis Kelamin</th>
                                                            <th style="text-align: center;">Terakhir Online</th>
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
     <div class="modal-dialog modal-lg" role="document">
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
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">NIP*</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="hidden" name="id">
                                             <input class="form-control" type="text" name="nip" onkeypress="return Angkasaja(event)">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Nama Lengkap*</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input class="form-control" type="text" name="name">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div> 
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Password*</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input class="form-control" type="password" name="password">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Tanggal Lahir*</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input class="form-control" type="date" name="tanggal_lahir">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Jenis Kelamin*</label>
                                        <div class="col-sm-12 col-md-9">
                                             <select class="select2 form-control" name="jenis_kelamin" style="width: 100%">
                                                  <option value="Laki - laki"> Laki - laki</option>
                                                  <option value="Perempuan"> Perempuan</option>
                                             </select>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Email*</label>
                                        <div class="col-sm-12 col-md-9">
                                             <input type="email" class="form-control" name="email">
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
                              </div>
                              <div class="col-md-6">
                                   <div class="form-group row mb-4">
                                        <label class="col-form-label text-md-right col-12 col-md-3 col-lg-3">Alamat Lengkap</label>
                                        <div class="col-sm-12 col-md-9">
                                             <textarea class="form-control" style="resize: none;" rows="3" name="alamat_lengkap"></textarea>
                                             <span class="help form-control-label"></span>
                                        </div>
                                   </div>
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
<script type="text/javascript">
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
               url: '<?php echo base_url('karyawan/table')?>',
               type: 'POST',
               data: function (data) {
                    data.filter = {    
                         'nama'         : $('.filter_nama').val(),
                         'jenis_kelamin': $('.filter_kelamin').val(),
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
               {'data':'nip'},
               {'data':'name'},
               {'data':'jenis_kelamin'},
               {'data':'last_login'},
               {'data':'status'},
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

     $(".filter_nama").keyup(function(){
          delay(function(){
               table_data();
          }, 800);
     });

     $(".filter_status").change(function(){
          table_data();
     });

     $(".filter_kelamin").change(function(){
          table_data();
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
          if(save_method == 'edit')
          {
               var url = '<?php echo base_url("karyawan/ubah"); ?>';
          }else{
               var url = '<?php echo base_url("karyawan/simpan"); ?>';     
          }
          

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

     $(".tambah").click(function(){
          save_method = 'add';
          $('#form_pengguna')[0].reset();
          $('.col-sm-12').removeClass('has-error');
          $('.help').empty();
          $('#modal_form').modal('show');
          $('.modal-title').text('Tambah Karyawan');
          $('[name="nip"]').removeAttr('readonly');
          $('#btn').removeAttr('disabled');
          $('[name="jenis_kelamin"]').removeAttr('disabled');
          $('[name="name"]').removeAttr('readonly');
          $('[name="tanggal_lahir"]').removeAttr('readonly');
          $('[name="email"]').removeAttr('readonly');
          $('[name="alamat_lengkap"]').removeAttr('readonly');
          $('[name="password"]').removeAttr('readonly');
     });

     function hapus(id)
     {
          Swal.fire({
               text: "Apakah Data ini Ingin Di Nonaktifkan?",
               title: "Perhatian",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: "#2196F3",
               confirmButtonText: "Iya",
               cancelButtonText: "Tidak",
               closeOnConfirm: false,
               closeOnCancel: true
          }).then((result) => {
               if (result.value) {
                    $.ajax({
                         url : "<?php echo base_url('karyawan/hapus/')?>",
                         type: "POST",
                         data : {
                              id   : id,
                         },
                         dataType: "JSON",
                         success: function (obj) {
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
                                        }
                                   });
                              }
                         },
                         error: function (jqXHR, textStatus, errorThrown){
                              alert('Error get data from ajax');
                         }
                    });
               }else{
                    table_data(); 
               }
          });
     }

     function restore(id)
     {
          Swal.fire({
               text: "Apakah Data ini Ingin Di Aktifkan?",
               title: "Perhatian",
               icon: 'warning',
               showCancelButton: true,
               confirmButtonColor: "#2196F3",
               confirmButtonText: "Iya",
               cancelButtonText: "Tidak",
               closeOnConfirm: false,
               closeOnCancel: true
          }).then((result) => {
               if (result.value) {
                    $.ajax({
                         url : "<?php echo base_url('karyawan/restore/')?>",
                         type: "POST",
                         data : {
                              id   : id,
                         },
                         dataType: "JSON",
                         success: function (obj) {
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
                                        }
                                   });
                              }
                         },
                         error: function (jqXHR, textStatus, errorThrown){
                              alert('Error get data from ajax');
                         }
                    });
               }else{
                table_data(); 
           }

      });
     }

     function ubah(id)
     {
          save_method = 'edit';
          $('#form_pengguna')[0].reset();
          $('.col-sm-12').removeClass('has-error');
          $('.help').empty();

          $.ajax({
               url : "<?php echo base_url('karyawan/lihat/')?>",
               type: "POST",
               data : {
                    id   : id,
               },
               dataType: "JSON",
               success: function(data){
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Ubah Karyawan');
                    $('[name="id"]').val(id);
                    $('[name="nip"]').val(data.data.nip);
                    $('[name="jenis_kelamin"]').val(data.data.jenis_kelamin).change();
                    $('[name="name"]').val(data.data.name);
                    $('[name="tanggal_lahir"]').val(data.data.tanggal_lahir);
                    $('[name="email"]').val(data.data.email);
                    $('[name="alamat_lengkap"]').val(data.data.alamat_lengkap);

                    $('[name="nip"]').attr('readonly',true);
                    $('#btn').removeAttr('disabled');
                    $('[name="jenis_kelamin"]').removeAttr('disabled');
                    $('[name="name"]').removeAttr('readonly');
                    $('[name="tanggal_lahir"]').removeAttr('readonly');
                    $('[name="email"]').removeAttr('readonly');
                    $('[name="alamat_lengkap"]').removeAttr('readonly');
                    $('[name="password"]').removeAttr('readonly');
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
     }

     function lihat(id)
     {
          save_method = 'edit';
          $('#form_pengguna')[0].reset();
          $('.col-sm-12').removeClass('has-error');
          $('.help').empty();

          $.ajax({
               url : "<?php echo base_url('karyawan/lihat/')?>",
               type: "POST",
               data : {
                    id   : id,
               },
               dataType: "JSON",
               success: function(data){
                    $('#modal_form').modal('show');
                    $('.modal-title').text('Detail Karyawan');
                    $('[name="nip"]').val(data.data.nip);
                    $('[name="jenis_kelamin"]').val(data.data.jenis_kelamin).change();
                    $('[name="name"]').val(data.data.name);
                    $('[name="tanggal_lahir"]').val(data.data.tanggal_lahir);
                    $('[name="email"]').val(data.data.email);
                    $('[name="alamat_lengkap"]').val(data.data.alamat_lengkap);

                    $('[name="nip"]').attr('readonly',true);
                    $('#btn').attr('disabled',true);
                    $('[name="jenis_kelamin"]').attr('disabled',true);
                    $('[name="name"]').attr('readonly',true);
                    $('[name="tanggal_lahir"]').attr('readonly',true);
                    $('[name="email"]').attr('readonly',true);
                    $('[name="alamat_lengkap"]').attr('readonly',true);
                    $('[name="password"]').attr('readonly',true);
               },
               error: function (jqXHR, textStatus, errorThrown){
                    alert('Error get data from ajax');
               }
          });
     }
</script>