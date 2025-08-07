<?php
  try {
    $koneksi = new mysqli ("103.22.250.217","pbj_user","pbj_user_password","pbj_e_surat", "7004");
  } catch (\Throwable $th) {
    // throw new Exception("Koneksi database gagal! ".$th->getMessage());
    die("Koneksi database gagal! ".$th->getMessage());
  }
?>
