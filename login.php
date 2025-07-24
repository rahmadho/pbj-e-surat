<?php
ob_start();
session_start();
include "koneksi/koneksi.php";
include "include/helper.php";
if (is_auth()) {
  header("location:index.php");
} else {
  if (isset($_POST['login'])) {
    $nama = $_POST['nama'];
    $pass = $_POST['pass'];
    $ambil = $koneksi->prepare("SELECT * FROM tb_user WHERE username = ? AND password = ?");
    $ambil->bind_param("ss", $nama, $pass);
    $ambil->execute();
    $data = $ambil->get_result();
    $data = $data->fetch_object();   
    if ($data) {
      $ambil->close();

      $_SESSION['auth'] = $data;

      $profile = $koneksi->query("SELECT * FROM tb_profile");
      $profile_data = $profile->fetch_object();
      $_SESSION['profile'] = $profile_data;

      header("location:index.php");
      exit;
    } else {
      ?>
      <script type="text/javascript">
        alert("Login Gagal Username dan Password Salah.. Silahkan Ulangi Lagi");
      </script>
      <?php
    }
  }
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Halaman Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
    <!-- Google Font -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <?php
  $sql = $koneksi->query("select * from tb_profile");
  $data = $sql->fetch_object();
  ?>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
      </div>
      <!-- /.login-logo -->
      <div class="login-box-body" style="text-align: center;">
        <img style="text-align: center;" src="images/<?php echo $data->foto ?>" width="160" height="160">
        </br></br>
        <a href="" style="color: black; font-size: 20px;"><b>APLIKASI SURAT ELEKTRONIK</a>
        <p class="login-box-msg" style="color: black; font-size: 16px;">Please Login Your Account</p>
        <form method="post">
          <div class="form-group has-feedback">
            <input type="text" class="form-control" placeholder="Your Username " name="nama" />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>
          <div class="form-group has-feedback">
            <input type="password" class="form-control" placeholder="Your Password" name="pass" />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>
          <div class="row">
            <!-- /.col -->
            <div class="col-xs-12">
              <button type="submit" name="login" class="btn btn-info btn-block btn-flat">Login</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <!-- /.login-box-body -->
      </div>
      <!-- /.login-box -->
      <!-- jQuery 3 -->
      <script src="bower_components/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap 3.3.7 -->
      <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
  </html>
  <?php
}
?>