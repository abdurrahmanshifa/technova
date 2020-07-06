<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="UTF-8">
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
     <title>LOGIN PENUGASAN</title>

      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/css/bootstrap.min.css') ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/'); ?>/vendor/@fortawesome/fontawesome-free/css/all.min.css" type="text/css">

      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/css/style.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/css/components.css'); ?>">
      <link rel="stylesheet" href="<?php echo base_url('assets/stilla/plugins/sweetalert2/sweetalert2.css') ?>">
</head>

<body>
     <div id="app">
          <section class="section">
               <div class="d-flex flex-wrap align-items-stretch">
                    <div class="col-lg-4 col-md-6 col-12 order-lg-1 min-vh-100 order-2 bg-white">
                         <div class="p-4 m-3">
                              <img src="<?php echo base_url('assets/stilla/img/stisla-fill.svg') ?>" alt="logo" width="80" class="shadow-light rounded-circle mb-5 mt-2">
                              <h4 class="text-dark font-weight-normal">Selamat Datang di <span class="font-weight-bold">Aplikasi Penugasan</span></h4>
                              <p class="text-muted">Harap login terlebih dahulu sebelum masuk dalam sistem.</p>
                              <form method="POST" action="" name="form_password" id="form_password">
                                   <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" autofocus>
                                        <span class="help"></span>
                                   </div>

                                   <div class="form-group">
                                        <div class="d-block">
                                             <label for="password" class="control-label">Password</label>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2">
                                        <span class="help"></span>
                                   </div>


                                   <div class="form-group text-right">

                                        <button type="submit" class="btn btn-primary btn-lg btn-icon icon-right" tabindex="4">
                                             Login
                                        </button>
                                   </div>
                              </form>

                              <div class="text-center mt-5 text-small">
                                   Copyright &copy; Your Company. Made with 💙 by Stisla
                                   <div class="mt-2">
                                        <a href="#">Privacy Policy</a>
                                        <div class="bullet"></div>
                                        <a href="#">Terms of Service</a>
                                   </div>
                              </div>
                         </div>
                    </div>
                    <div class="col-lg-8 col-12 order-lg-2 order-1 min-vh-100 background-walk-y position-relative overlay-gradient-bottom" data-background="<?php echo base_url('assets/stilla/img/unsplash/login-bg.jpg');?>">
                         <div class="absolute-bottom-left index-2">
                              <div class="text-light p-5 pb-2">
                                   <div class="mb-5 pb-3">
                                        <h1 class="mb-2 display-4 font-weight-bold"><?php echo date('H:i:s') ?></h1>
                                        <h5 class="font-weight-normal text-muted-transparent">Bali, Indonesia</h5>
                                   </div>
                                   Photo by <a class="text-light bb" target="_blank" href="https://unsplash.com/photos/a8lTjWJJgLA">Justin Kauffman</a> on <a class="text-light bb" target="_blank" href="https://unsplash.com">Unsplash</a>
                              </div>
                         </div>
                    </div>
               </div>
          </section>
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
   <script type="text/javascript">
         $("[name=form_password]").on('submit', function(e) {
                  e.preventDefault();

                  $('#btn').text('sedang menyimpan...');
                  $('#btn').attr('disabled', true);
                  $('.form-group').removeClass('has-error');
                  $('.help').empty();

                  var form = $('#form_password')[0];
                  var data = new FormData(form);
                  var url = '<?php echo base_url("login/proses"); ?>';

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
                                   title: obj.title,
                                   icon: "error",
                                   button: true,
                                   timer: 1000
                              });
                          } else {
                               Swal.fire({
                                   text: obj.message,
                                   title: obj.title,
                                   icon: "success",
                                   button: true,
                                   confirmButtonText: "Masuk",
                              }).then((result) => {
                                   if (result.value) {
                                       window.location.replace("<?php echo base_url('dashboard'); ?>");
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
            });
   </script>
</body>
</html>
