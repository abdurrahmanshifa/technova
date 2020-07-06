<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
      <title><?php echo $site_title; ?></title>
      <link rel="icon" type="image/png" href="<?php echo base_url('assets/login/'); ?>images/logo.png" />
      <!-- General CSS Files -->
      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/css/bootstrap.min.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/'); ?>/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/css/style.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/css/components.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/plugins/sweetalert2/sweetalert2.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/plugins/datatables-bs4/css/dataTables.bootstrap4.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/'); ?>/vendor/select2/dist/css/select2.min.css" type="text/css">
      <style type="text/css">
            .select2-container--default .select2-selection--single {
                  border: 1px solid #e4e6fc !important;
            }

            .select2-selection__rendered {
                  color: #6c757d !important;
                  top: 8px;
                  position: relative;
                  font-weight: 500;
            }

            .modal-open .modal {
                  background: rgba(105, 105, 105, 0.5)
            }
      </style>
</head>

<body>
      <div id="app">
            <div class="main-wrapper">
                  <div class="navbar-bg"></div>
                  <nav class="navbar navbar-expand-lg main-navbar">
                        <form class="form-inline mr-auto">
                              <ul class="navbar-nav mr-3">
                                    <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>

                              </ul>
                        </form>
                        <ul class="navbar-nav navbar-right">
                              <li class="dropdown">
                                    <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                          <?php
                                                echo '<img class="rounded-circle mr-3" src="' . base_url('assets/stilla/img/avatar/avatar-1.png') . '"  alt="...">';
                                          ?>
                                          <div class="d-sm-none d-lg-inline-block">
                                                <label style="    top: 15px;position: relative;">
                                                      Hi, <?php echo $this->session->userdata('name'); ?>
                                                      <p style="top: -6px;position: relative;"><?php echo $this->session->userdata('role'); ?></p>
                                                </label>
                                          </div>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                          <a href="javascript:void(0);" class="dropdown-item ubah-password has-icon">
                                                <i class="fas fa-user"></i> Ubah Password
                                          </a>
                                          <a href="<?php echo base_url('logout'); ?>" class="dropdown-item has-icon">
                                                <i class="fas fa-sign-out-alt"></i> Keluar
                                          </a>
                                    </div>
                              </li>
                        </ul>
                  </nav>
                  <div class="main-sidebar">
                        <aside id="sidebar-wrapper">
                              <div class="sidebar-brand">
                                    <a href="<?php echo base_url('dashboard') ?>" style="font-weight: 900;font-size: 11px;position: relative;top: 2px;">
                                          <img src="<?php echo base_url('assets/stilla/img/stisla-fill.svg') ?>" width="50px;" alt="">
                                          PenugasanKaryawan
                                    </a>
                              </div>
                              <div class="sidebar-brand sidebar-brand-sm">
                                    <a href="<?php echo base_url('dashboard'); ?>">
                                         <img src="<?php echo base_url('assets/stilla/img/stisla-fill.svg') ?>" width="50px;" alt="">
                                    </a>
                              </div>
                              <?php
                              $this->load->view('templates/menu');
                              ?>
                        </aside>
                  </div>

                  <!-- Main Content -->
                  <script src="<?php echo base_url('assets/stilla/'); ?>/vendor/jquery/dist/jquery.min.js"></script>
                  <script src="<?php echo base_url('assets/stilla/'); ?>/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
                  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
                  <!-- Optional JS -->
                  <script src="<?php echo base_url('assets/stilla/plugins/datatables/jquery.dataTables.js'); ?>"></script>
                  <script src="<?php echo base_url('assets/stilla/plugins/datatables-bs4/js/dataTables.bootstrap4.js'); ?>"></script>
                  <script src="<?php echo base_url('assets/stilla/plugins/select2/js/select2.full.min.js'); ?>"></script>
                  <script src="<?php echo base_url('assets/stilla/plugins/sweetalert2/sweetalert2.min.js'); ?>"></script>
                  <!-- Toastr -->
                  <script src="<?php echo base_url('assets/stilla/plugins/toastr/toastr.min.js'); ?>"></script>
                  <script src="<?php echo base_url('assets/stilla/js/stisla.js'); ?>"></script>

                  <!-- Template JS File -->
                  <script src="<?php echo base_url('assets/stilla/js/scripts.js'); ?>"></script>
                  <script src="<?php echo base_url('assets/stilla/js/custom.js'); ?>"></script>
                  <?php echo $scripts_header; ?>
                  <div class="main-content">
                        <?php
                        echo $content;
                        ?>
                  </div>
                  <div class="modal fade" tabindex="-1" role="dialog" id="modal_password" data-backdrop="false">
                        <div class="modal-dialog modal-md" role="document">
                              <div class="modal-content">
                                    <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLongTitle"></h5>
                                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span></button>
                                    </div>
                                    <form role="form" id="form_password" name="form_password">
                                          <div class="modal-body">
                                                <div class="row">
                                                      <div class="col-md-12">
                                                            <div class="form-group row mb-4">
                                                                  <label class="col-form-label col-12 col-md-12 col-lg-12">Password Lama*</label>
                                                                  <div class="col-sm-12 col-md-12">
                                                                        <input class="form-control" type="password" name="pass_lama">
                                                                        <span class="help form-control-label"></span>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                  <label class="col-form-label col-12 col-md-12 col-lg-12">Password Baru*</label>
                                                                  <div class="col-sm-12 col-md-12">
                                                                        <input class="form-control" type="password" name="pass_baru">
                                                                        <span class="help form-control-label"></span>
                                                                  </div>
                                                            </div>
                                                            <div class="form-group row mb-4">
                                                                  <label class="col-form-label col-12 col-md-12 col-lg-12">Konfirmasi Password*</label>
                                                                  <div class="col-sm-12 col-md-12">
                                                                        <input class="form-control" type="password" name="pass_konf">
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
                  <footer class="main-footer">
                        <div class="footer-left">
                              Copyright &copy; 2018 <label style="color: #007bff;font-size: 1px;">
                                    <div class="bullet"></div> Design By <a style="color: #007bff;" href="https://nauval.in/">Muhamad Nauval Azhar
                              </label></a>
                        </div>
                        <div class="footer-right">
                              2.3.0
                        </div>
                  </footer>
            </div>
      </div>
      <script type="text/javascript">
            $('.select2').select2();

            $("[name=form_password]").on('submit', function(e) {
                  e.preventDefault();

                  $('#btn').text('sedang menyimpan...');
                  $('#btn').attr('disabled', true);
                  $('.form-group').removeClass('has-error');
                  $('.help').empty();

                  var form = $('#form_password')[0];
                  var data = new FormData(form);
                  var url = '<?php echo base_url("karyawan/ubah_password"); ?>';


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
                              $('.confirm').attr('disabled', true);

                              $.ajax({
                                    url: url,
                                    type: 'post',
                                    data: data,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    success: function(res) {
                                          var obj = JSON.parse(res);
                                          if (obj.status) {
                                                if (obj.success !== true) {
                                                      Swal.fire({
                                                            text: obj.message,
                                                            title: "",
                                                            icon: "error",
                                                            button: true,
                                                            timer: 1000
                                                      });
                                                } else {
                                                      Swal.fire({
                                                            text: obj.message,
                                                            title: "",
                                                            icon: "success",
                                                            button: true,
                                                            confirmButtonText: "Keluar",
                                                      }).then((result) => {
                                                            if (result.value) {
                                                                  window.location.replace("<?php echo base_url('logout'); ?>");
                                                            }
                                                      });
                                                }
                                                $('#btn').text('Simpan');
                                                $('#btn').attr('disabled', false);
                                          } else {
                                                for (var i = 0; i < obj.inputerror.length; i++) {
                                                      $('[name="' + obj.inputerror[i] + '"]').parent().addClass('has-error');
                                                      $('[name="' + obj.inputerror[i] + '"]').next().text(obj.error_string[i]);
                                                }
                                                Swal.fire({
                                                      icon: 'error',
                                                      text: obj.error_string[0],
                                                      title: 'Gagal',
                                                      button: true,
                                                      timer: 3000
                                                });
                                                $('#btn').text('Simpan');
                                                $('#btn').attr('disabled', false);
                                          }
                                    }
                              });
                        } else {
                              $('.confirm').text('Simpan');
                              $('.confirm').attr('disabled', false);

                              $('#btn').text('Simpan');
                              $('#btn').attr('disabled', false);
                        }

                  });
            });

            $(".ubah-password").click(function() {
                  $('#form_password')[0].reset();
                  $('.form-group').removeClass('has-error');
                  $('.help').empty();
                  $('#modal_password').modal('show');
                  $('.modal-title').text('Ubah Password');

            });


            function Angkasaja(evt) {
                  var charCode = (evt.which) ? evt.which : event.keyCode
                  if (charCode > 31 && (charCode < 48 || charCode > 57))
                        return false;
                  return true;
            }

            function tanggal_indo(data) {
                  if (data == '0000-00-00') {
                        return '-';
                  } else {
                        var tgl = data.split("-");
                        return tgl[2] + ' ' + get_bulan(tgl[1]) + ' ' + tgl[0];
                  }

            }

            function format_uang(bilangan) {
                  if (bilangan != null) {
                        var number_string = bilangan.toString(),
                              sisa = number_string.length % 3,
                              rupiah = number_string.substr(0, sisa),
                              ribuan = number_string.substr(sisa).match(/\d{3}/g);

                        if (ribuan) {
                              separator = sisa ? '.' : '';
                              rupiah += separator + ribuan.join('.');
                        }
                  } else {
                        rupiah = '';
                  }


                  return rupiah;
            }

            function get_bulan(data) {
                  var id = parseInt(data);
                  switch (id) {
                        case 1: {
                              return 'Januari';
                              break;
                        }
                        case 2: {
                              return 'Februari';
                              break;
                        }
                        case 3: {
                              return 'Maret';
                              break;
                        }
                        case 4: {
                              return 'April';
                              break;
                        }
                        case 5: {
                              return 'Mei';
                              break;
                        }
                        case 6: {
                              return 'Juni';
                              break;
                        }
                        case 7: {
                              return 'Juli';
                              break;
                        }
                        case 8: {
                              return 'Agustus';
                              break;
                        }
                        case 9: {
                              return 'September';
                              break;
                        }
                        case 10: {
                              return 'Oktober';
                              break;
                        }
                        case 11: {
                              return 'November';
                              break;
                        }
                        case 12: {
                              return 'Desember';
                              break;
                        }
                  }
            }
      </script>
</body>

</html>