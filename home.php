<marquee><strong><h4>SELAMAT DATANG DI SISTEM APLIKASI SURAT MASUK, KELUAR & DISPOSISI </strong></marquee></h4>
<?php

if ($_SESSION['admin']) {
	$sql = $koneksi->query("select * from tb_surat_masuk");
	while($data=$sql->fetch_assoc()){
       $masuk=$sql->num_rows;


	}

  $sql = $koneksi->query("select * from tb_surat_keluar");
	while($data=$sql->fetch_assoc()){
       $keluar=$sql->num_rows;


	}

  $sql = $koneksi->query("select * from tb_disposisi");
	while($data=$sql->fetch_assoc()){
       $disposisi=$sql->num_rows;

  }

  $sql = $koneksi->query("select * from tb_user");
  while($data=$sql->fetch_assoc()){
       $user=$sql->num_rows;



	}


}else{

  $sql = $koneksi->query("select * from tb_surat_masuk where tujuan='$tujuan'");
  while($data=$sql->fetch_assoc()){
       $masuk=$sql->num_rows;


  }

  $sql = $koneksi->query("select * from tb_surat_keluar where tujuan='$tujuan'");
  while($data=$sql->fetch_assoc()){
       $keluar=$sql->num_rows;


  }

  $sql = $koneksi->query("select * from tb_disposisi where tujuan='$tujuan'");
  while($data=$sql->fetch_assoc()){
       $disposisi=$sql->num_rows; 

  }

  $sql = $koneksi->query("select * from tb_user where level='$admin'");
  while($data=$sql->fetch_assoc()){
       $user=$sql->num_rows; 

  


  }

}

 




?>
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <!-- <h1>
        Dashboard
        <small><b>Administrator</small></b>
      </h1> -->
      <!-- <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol> -->
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Small boxes (Stat box) -->
      <div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-blue">
            <div class="inner">
              <h3><?php echo $masuk; ?></h3>
              <?php $jumlah_suratmasuk = mysqli_query($koneksi, "select * from tb_surat_tujuan"); ?></h3>
              <h3 class="counter"><?php echo mysqli_num_rows($jumlah_suratmasuk); ?></h3>

              <p><b>Surat Masuk</p></b>
            </div>
            <div class="icon">
              <i class="ion ion-email-unread"></i>
            </div>
            <a href="?page=masuk" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?php echo $keluar; ?></sup></h3>

              <p><b>Surat Keluar</p></b>
            </div>
            <div class="icon">
              <i class="ion ion-email"></i>
            </div>
            <a href="?page=keluar" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-purple">
            <div class="inner">
              <h3><?php echo $disposisi; ?></h3>

              <p><b>Disposisi</p></b>
            </div>
            <div class="icon">
              <i class="ion ion-paper-airplane"></i>
            </div>
            <a href="?page=disposisi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

     <!-- ./col -->
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php $jumlah_user = mysqli_query($koneksi, "select * from tb_user"); ?></h3>
              <h3 class="counter"><?php echo mysqli_num_rows($jumlah_user); ?></h3>
              <p><b>Pengguna Sistem</p></b>
              <?php
                  if($_SESSION['admin']){
                       $user_l=$_SESSION['admin'];

                  }

                  $sql_u = $koneksi->query("select* from tb_user where id='$user_l'");
                  $data_u = $sql_u->fetch_assoc();

                   $tujuan = $data_u['level_pimpinan'];
        ?>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-olive">
            <div class="inner">
              <h3><?php $jumlah_klasifikasi = mysqli_query($koneksi, "select * from ref_klasifikasi"); ?></h3>
              <h3 class="counter"><?php echo mysqli_num_rows($jumlah_klasifikasi); ?></h3>
              <p><b>Jumlah Klasifikasi Surat</p></b>
            </div>
            <div class="icon">
              <i class="ion ion-compose"></i>
            </div>
            <a href="" class="small-box-footer">More info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?php $jumlah_asalsurat = mysqli_query($koneksi, "select * from tb_asal_tujuan"); ?></h3>
              <h3 class="counter"><?php echo mysqli_num_rows($jumlah_asalsurat); ?></h3>
              <p><b>Data Asal/Tujuan Surat</p></b>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
            <a href="" class="small-box-footer">More info<i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        
     <!-- ./col -->
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-maroon">
            <div class="inner">
              <h3><?php $jumlah_departemen = mysqli_query($koneksi, "select * from m_dispos"); ?></h3>
              <h3 class="counter"><?php echo mysqli_num_rows($jumlah_departemen); ?></h3>
              <p><b>Data Divisi Tujuan Disposisi</p></b>
            </div>
            <div class="icon">
              <i class="ion ion-ios-briefcase"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <!-- ./col -->
     <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?php $jumlah_pimpinan = mysqli_query($koneksi, "select * from tb_tujuan"); ?></h3>
              <h3 class="counter"><?php echo mysqli_num_rows($jumlah_pimpinan); ?></h3>
              <p><b>Jumlah Data Pimpinan</p></b>
            </div>
            <div class="icon">
              <i class="ion ion-person-stalker"></i>
            </div>
            <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- pengguna -->
        <!-- <div class="col-lg-6 col-xs-6"> -->
          <!-- small box -->
           <!-- <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?php echo $user; ?></h3>

              <p><strong>Pengguna</strong></p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="?page=user" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div> -->



        
