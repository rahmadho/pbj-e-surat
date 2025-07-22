<!-- Sidebar user panel -->
<?php

   
    $sql = $koneksi->query("select * from tb_profile");
    $data = $sql->fetch_assoc();

?>
<div class="user-panel">
  <div>
    <a style="color: white; margin-left: 20px; font-size: 16px;"><?php echo $data['lembaga'] ?></a> <br><br>
  <img style="margin-left:20px" src="images/<?php echo $data['foto'] ?>" width="175" height="175" >
  <h5 style="color:white; font-size: 14px; text-align: center; "><?php echo $data['kota']; ?></h5>
      
  </div>
  <div class="pull-left info">


  </div>
</div>
<!-- search form -->
<!-- /.search form -->
<!-- sidebar menu: : style can be found in sidebar.less -->
<ul class="sidebar-menu" data-widget="tree">
  <li class="header">Menu Utama</li>

<li><a href="index.php"><i class="fa fa-dashboard"></i> <span>Home</span></a></li>

   <?php if ($_SESSION['admin']) {?>

  <li><a href="?page=klasifikasi"><i class="fa fa-bars"></i> <span>Data Klasifikasi Surat </span></a></li>

  <li><a href="?page=pimpinan"><i class="fa fa-bars"></i> <span>Data Pimpinan </span></a></li>
  
 <li><a href="?page=m_dispos"><i class="fa fa-th"></i> <span>Data Tujuan Disposisi </span></a></li>

 <li><a href="?page=asal_tujuan"><i class="fa fa-th"></i> <span>Data Asal/Tujuan Surat </span></a></li>

 <?php } ?>

  <li><a href="?page=masuk"><i class="fa fa-envelope"></i> <span>Surat Masuk </span></a></li>

  <li><a href="?page=keluar"><i class="fa fa-envelope-o"></i> <span>Surat Keluar </span></a></li>

  <li><a href="?page=disposisi"><i class="fa fa-envelope-square"></i> <span>Disposisi</span></a></li>
  <?php if ($_SESSION['admin']) {?>

  <li><a href="?page=profile&aksi=seting"><i class="fa fa-gear"></i> <span>Setting</span></a></li>
  
  <li><a href="?page=user"><i class="fa fa-user"></i> <span>Pengguna</span></a></li>

  <?php } ?>




</ul>
