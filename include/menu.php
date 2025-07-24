<!-- Sidebar user panel -->
<div class="user-panel">
  <div style="display: flex; gap: 14px; align-items: center; overflow-x: hidden; text-overflow: ellipsis; white-space: nowrap; justify-content: flex-start;">
    <img src="images/<?php echo auth()?->foto ?? profile()?->foto ?>" width="36" height="36" class="img-circle" style="background-color: #fff;">
    <div style="color:white; ">
      <a style="font-size: 14px;"><?php echo auth()?->nama_user ?></a>
      <h5 class="text-muted" style="font-size: 12px;"><?php echo profile()?->kota ?></h5>
    </div>
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
  <?php if (is_admin()) { ?>
    <li><a href="?page=klasifikasi"><i class="fa fa-bars"></i> <span>Data Klasifikasi Surat </span></a></li>
    <li><a href="?page=pimpinan"><i class="fa fa-bars"></i> <span>Data Pimpinan </span></a></li>

    <li><a href="?page=m_dispos"><i class="fa fa-th"></i> <span>Data Tujuan Disposisi </span></a></li>
    <li><a href="?page=asal_tujuan"><i class="fa fa-th"></i> <span>Data Asal/Tujuan Surat </span></a></li>
  <?php } ?>
  <li><a href="?page=masuk"><i class="fa fa-envelope"></i> <span>Surat Masuk </span></a></li>
  <li><a href="?page=keluar"><i class="fa fa-envelope-o"></i> <span>Surat Keluar </span></a></li>
  <li><a href="?page=disposisi"><i class="fa fa-envelope-square"></i> <span>Disposisi</span></a></li>
  <li><a href="?page=agenda"><i class="fa fa-calendar"></i> <span>Agenda</span></a></li>
  <?php if (is_admin()) { ?>
    <li><a href="?page=profile&aksi=seting"><i class="fa fa-gear"></i> <span>Setting</span></a></li>
    <li><a href="?page=user"><i class="fa fa-user"></i> <span>Pengguna</span></a></li>
  <?php } ?>
</ul>