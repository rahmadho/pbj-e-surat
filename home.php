<marquee><strong><h4>SELAMAT DATANG DI SISTEM APLIKASI SURAT MASUK, KELUAR & DISPOSISI</strong></marquee>
<?php
if (is_admin()) {
  $sql = $koneksi->query("select * from tb_surat_masuk");
  while ($data = $sql->fetch_assoc()) {
    $masuk = $sql->num_rows;
  }
  $sql = $koneksi->query("select * from tb_surat_keluar");
  while ($data = $sql->fetch_assoc()) {
    $keluar = $sql->num_rows;
  }
  $sql = $koneksi->query("select * from tb_disposisi");
  while ($data = $sql->fetch_assoc()) {
    $disposisi = $sql->num_rows;
  }
  $sql = $koneksi->query("select * from tb_user");
  while ($data = $sql->fetch_assoc()) {
    $user = $sql->num_rows;
  }
} else {
  $user_id  = auth()->id;
  if (!is_level(LEVEL_KABIRO)) {
    $filter = "WHERE exists (select 1 from m_dispos where m_dispos.id_leader={$user_id} and m_dispos.id_dispos=tb_surat_masuk.disposisi)";
  }
  $sql_u = $koneksi->query("select * from tb_user where id={$user_id}");
  $data_u = $sql_u->fetch_assoc();
  $tujuan = $data_u['level_pimpinan'];
  // surat masuk
  $sql = $koneksi->query("SELECT COUNT(id) as jml from tb_surat_masuk $filter");
  $row = $sql->fetch_object();
  $masuk = $row->jml;
  
  $sql = $koneksi->query("select * from tb_surat_keluar where tujuan='$tujuan'");
  while ($data = $sql->fetch_assoc()) {
    $keluar = $sql->num_rows;
  }
  $sql = $koneksi->query("select * from tb_disposisi where tujuan='$tujuan'");
  while ($data = $sql->fetch_assoc()) {
    $disposisi = $sql->num_rows;
  }
  $sql = $koneksi->query("select * from tb_user where level='user'");
  while ($data = $sql->fetch_assoc()) {
    $user = $sql->num_rows;
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
          <h3 class="counter"><?php echo $masuk ?? 0 ?></h3>
          <p><b>Surat Masuk</p></b>
        </div>
        <div class="icon">
          <i class="ion ion-email-unread"></i>
        </div>
        <a href="?page=masuk" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3 class="counter"><?php echo $keluar ?? 0 ?></h3>
          <p><b>Surat Keluar</p></b>
        </div>
        <div class="icon">
          <i class="ion ion-email"></i>
        </div>
        <a href="?page=keluar" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-purple">
        <div class="inner">
          <h3 class="counter"><?php echo $disposisi ?? 0 ?></h3>
          <p><b>Disposisi</p></b>
        </div>
        <div class="icon">
          <i class="ion ion-paper-airplane"></i>
        </div>
        <a href="?page=disposisi" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3 class="counter"><?php echo $user ?? 0 ?></h3>
          <p><b>Pengguna Sistem</p></b>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-olive">
        <div class="inner">
          <h3 class="counter"><?php echo mysqli_num_rows(mysqli_query($koneksi, "select * from ref_klasifikasi")) ?? 0; ?></h3>
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
          <h3 class="counter"><?php echo mysqli_num_rows(mysqli_query($koneksi, "select * from tb_asal_tujuan")) ?? 0; ?></h3>
          <p><b>Data Asal/Tujuan Surat</p></b>
        </div>
        <div class="icon">
          <i class="ion ion-clipboard"></i>
        </div>
        <a href="" class="small-box-footer">More info<i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-maroon">
        <div class="inner">
          <h3 class="counter"><?php echo mysqli_num_rows(mysqli_query($koneksi, "select * from m_dispos")) ?? 0; ?></h3>
          <p><b>Data Divisi Tujuan Disposisi</p></b>
        </div>
        <div class="icon">
          <i class="ion ion-ios-briefcase"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3 class="counter"><?php echo mysqli_num_rows(mysqli_query($koneksi, "select * from tb_tujuan")) ?? 0; ?></h3>
          <p><b>Jumlah Data Pimpinan</p></b>
        </div>
        <div class="icon">
          <i class="ion ion-person-stalker"></i>
        </div>
        <a href="" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div>
  </div>
</section>
