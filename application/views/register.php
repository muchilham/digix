<!DOCTYPE html>

<div id="register">
  <div id="register-box">
      <div class="header-form">
        <h1 style="">Welcome</h1>
        <p>Mulai perjalananmu di digiX dengan mengisi form berikut:</p>
      </div>
      <form id="form-regist" class="col s12" action="<?php echo base_url();?>index/register" method="POST" enctype="multipart/form-data">
              <div class="row form-group">
                  <div class="input-group col s12">
                    <label class="register-label" for="id_user">Username</label>
                    <input id="id_user" type="text" name="id_user" required="">
                  </div>
              </div>
              <div class="row form-group">
                  <div class="input-group col s6">
                    <label class="register-label" for="first_name">Nama Depan</label>
                    <input id="first_name" type="text" name="first_name" required>
                  </div>
                  <div class="input-group col s6">
                    <label class="register-label" for="last_name">Nama Belakang</label>
                    <input id="last_name" type="text" name="last_name"  required>
                  </div>
              </div>
              <div class="row form-group">
                  <div class="input-group col s12">
                    <label class="register-label" for="user_email">Email</label>
                    <input id="user_email" type="email" name="user_email" required >
                  </div>
              </div>
              <div class="row form-group">
                  <div class="input-group col s12">
                    <label class="register-label" for="user_password2">Password</label>
                    <input id="user_password2" type="password" name="user_password2" required >
                  </div>
              </div>
              <div class="row form-group">
                  <div class="input-group col s12">
                    <label class="register-label" for="user_password3">Retype Password</label>
                    <input id="user_password3" type="password" name="user_password3"  class="form-control" required>
                  </div>
              </div>
              <div class="row center">
                      <button type="submit" name="action" class="btn btn-register blue darken-3" style="width: 70%;">DAFTAR</button>
              </div>
          </form>
  </div>
</div>
