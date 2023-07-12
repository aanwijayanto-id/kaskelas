  <div class="container">

      <div class="card o-hidden border-0 shadow-lg my-5 col-lg-6 mx-auto">
          <div class="card-body p-0">
              <!-- Nested Row within Card Body -->
              <div class="row">
                  <div class="col-lg">
                      <div class="p-5">
                          <div class="text-center">
                              <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                          </div>
                          <form class="user" method="POST" action=" <?= base_url('auth/registrasi'); ?> ">
                              <div class="form-group">
                                  <input type="text" class="form-control form-control-user" id="name" name="name" placeholder="Nama" value="<?= set_value('name') ?>">
                                  <?= form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                              </div>
                              <div class="form-group">
                                  <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Alamat Email" value="<?= set_value('email'); ?>">
                                  <?= form_error('email', '<small class="text-danger pl-3">', '</small>'); ?>

                              </div>
                              <div class="form-group row">
                                  <div class="col-sm-6 mb-3 mb-sm-0">
                                      <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password">
                                  </div>
                                  <div class="col-sm-6">
                                      <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Konfirmasi Password">
                                  </div>
                              </div>
                              <button type="submit" class="btn btn-primary btn-user btn-block">
                                  Registrasi Akun
                              </button>
                          </form>
                          <hr>

                          <div class="text-center">
                              <a class="small" href=" <?= base_url('auth'); ?> ">Sudah punya Akun? Login!</a>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div>