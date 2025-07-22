<?php

    $page = $_GET['page'];
    $aksi = $_GET['aksi'];

    if ($page == "masuk") {
      if ($aksi == "") {
        include "page/masuk/masuk.php";
      }
      if ($aksi == "tambah") {
        include "page/masuk/tambah.php";
      }
      if ($aksi == "ubah") {
        include "page/masuk/ubah.php";
      }
      if ($aksi == "detail") {
        include "page/masuk/detail.php";
      }if ($aksi == "disposisi") {
        include "page/masuk/disposisi.php";
      }
      if ($aksi == "hapus") {
        include "page/masuk/hapus.php";
      }
    }


    if ($page == "m_dispos") {
      if ($aksi == "") {
        include "page/m_dispos/m_dispos.php";
      }
      if ($aksi == "tambah") {
        include "page/m_dispos/tambah.php";
      }
      if ($aksi == "ubah") {
        include "page/m_dispos/ubah.php";
      }
      
      if ($aksi == "hapus") {
        include "page/m_dispos/hapus.php";
      }
    }

    if ($page == "asal_tujuan") {
      if ($aksi == "") {
        include "page/asal_tujuan/asal_tujuan.php";
      }
      if ($aksi == "tambah") {
        include "page/asal_tujuan/tambah.php";
      }
      if ($aksi == "ubah") {
        include "page/asal_tujuan/ubah.php";
      }
      
      if ($aksi == "hapus") {
        include "page/asal_tujuan/hapus.php";
      }
    }

    if ($page == "pimpinan") {
      if ($aksi == "") {
        include "page/pimpinan/pimpinan.php";
      }
      if ($aksi == "tambah") {
        include "page/pimpinan/tambah.php";
      }
      if ($aksi == "ubah") {
        include "page/pimpinan/ubah.php";
      }
      
      if ($aksi == "hapus") {
        include "page/pimpinan/hapus.php";
      }
    }

     if ($page == "klasifikasi") {
      if ($aksi == "") {
        include "page/klasifikasi/klasifikasi.php";
      }
      if ($aksi == "tambah") {
        include "page/klasifikasi/tambah.php";
      }
      if ($aksi == "ubah") {
        include "page/klasifikasi/ubah.php";
      }
      
      if ($aksi == "hapus") {
        include "page/klasifikasi/hapus.php";
      }
    }

    if ($page == "keluar") {
      if ($aksi == "") {
        include "page/keluar/keluar.php";
      }
      if ($aksi == "tambah") {
        include "page/keluar/tambah.php";
      }
      if ($aksi == "ubah") {
        include "page/keluar/ubah.php";
      }
      if ($aksi == "hapus") {
        include "page/keluar/hapus.php";
      }
    }

    if ($page == "user") {
      if ($aksi == "") {
        include "page/pengguna/pengguna.php";
      }
      if ($aksi == "tambah") {
        include "page/pengguna/tambah.php";
      }
      if ($aksi == "ubah") {
        include "page/pengguna/ubah.php";
      }
      if ($aksi == "hapus") {
        include "page/pengguna/hapus.php";
      }
    }

    if ($page == "profile") {
      if ($aksi == "") {
        include "page/profile/profile.php";
      }
      if ($aksi == "ubahpass") {
        include "page/profile/ubah_pass.php";
      }
      if ($aksi == "ubah") {
        include "page/profile/ubah.php";
      }
      if ($aksi == "seting") {
        include "page/profile/seting.php";
      }
      if ($aksi == "hapus") {
        include "page/pengguna/hapus.php";
      }
    }

    

    if ($page == "disposisi") {
      if ($aksi == "") {
        include "page/disposisi/disposisi.php";
      }
      if ($aksi == "tambah") {
        include "page/laundry/tambah.php";
      }
      if ($aksi == "ubah") {
        include "page/laundry/ubah.php";
      }
      if ($aksi == "lunas") {
        include "page/laundry/lunas.php";
      }

    }

    if ($page == "visi") {
      if ($aksi == "") {
        include "page/visi/visi.php";
      }
    }

    if ($page == "struktur") {
      if ($aksi == "") {
        include "page/struktur/struktur.php";
      }
    }

     if ($page == "") {
      include "home.php";
    }


 ?>
