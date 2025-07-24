<?php
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
session_start();
include "koneksi/koneksi.php";
include "include/tanggal.php";
include "include/constant.php";
include "include/helper.php";
// echo "<pre>";
// print_r($_SESSION);
// echo "</pre>";
if (is_auth()) {
  ?>
  <!DOCTYPE html>
  <html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>SURAT ELEKTRONIK</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    
    <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">

    <!-- Plugins -->
    <link rel="stylesheet" type="text/css" href="plugins/sw/dist/sweetalert.css">
    <link rel="stylesheet" type="text/css" href="plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
    <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
    
    <!-- jQuery 3 -->
    <script src="bower_components/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="plugins/sw/dist/sweetalert.min.js"></script>
    <!-- Google Font -->
    <link rel="stylesheet"
      href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  </head>
  <body class="hold-transition skin-yellow sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>A</b>LT</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b style="font-size:16px;">SURAT ELEKTRONIK</b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              <!-- Tasks: style can be found in dropdown.less -->
              <li class="dropdown tasks-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i>Tanggal, <?php echo date('d-F-Y'); ?></i>
                </a>
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
              <!-- Tasks: style can be found in dropdown.less -->
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="images/<?php echo auth()?->foto ?? profile()?->foto ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php echo auth()?->nama_user ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="images/<?php echo auth()?->foto ?? profile()?->foto ?>" class="img-circle" alt="User Image">
                    <p>
                      Anda Login Sebagai, <?php echo auth()?->level ?>
                    </p>
                  </li>
                  <!-- Menu Body -->
                  <li class="user-body">
                    <div class="row">
                    </div>
                    <!-- /.row -->
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="?page=profile" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul>
                <!-- Control Sidebar Toggle Button -->
            </ul>
          </div>
        </nav>
      </header>
      <!-- =============================================== -->
      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <?php include "include/menu.php" ?>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- =============================================== -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
        </section>
        <!-- Main content -->
        <section class="content">
          <?php
          include "include/isi.php";
          ?>
        </section>
        <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
      <footer class="main-footer style=background-color: rgba(0, 0, 0, 0.05);">
        <div class="pull-right hidden-xs">
        </div>
        <strong>Copyright &copy; 2025 SISTEM SURAT ELEKTRONIK</a>.</strong> All rights
        reserved.
      </footer>
      <!-- Control Sidebar -->
      <!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->
    <!-- Bootstrap 3.3.7 -->
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="bower_components/select2/dist/js/select2.full.min.js"></script>
    <script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="dist/js/demo.js"></script>
    <script src="plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script>
      $(document).ready(function () {
        $('.sidebar-menu').tree()
      })
    </script>
    <script>
      $(function () {
        //Initialize Select2 Elements
        if ($('.select2').length) {
          $('.select2').select2()
        }
        if ($('[data-mask]').length) {
          //Money Euro
          $('[data-mask]').inputmask()
        }
        if ($('[data-datepicker]').length) {
          //Date picker
          $('[data-datepicker]').datepicker({
            autoclose: true
          })
        }
      })
    </script>
    <script>
      $(function () {
        $('[data-datatable]').DataTable(
          // {
          //   'paging': true,
          //   'lengthChange': false,
          //   'searching': false,
          //   'ordering': true,
          //   'info': true,
          //   'autoWidth': false
          // }
        )
      })
    </script>
  </body>
  </html>
  <?php
  $koneksi->close();
} else {
  header("location:login.php");
}
?>