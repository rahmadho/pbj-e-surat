<script type="text/javascript">
  function validasi(form) {
    if (form.username.value == "") {
      alert("Username  Tidak Boleh Kosong");
      form.username.focus();
      return (false);
    } if (form.pass.value == "") {
      alert("Password Tidak Boleh Kosng");
      form.pass.focus();
      return (false);
    } if (form.nama.value == "") {
      alert("Nama Tidak Boleh Kosong");
      form.nama.focus();
      return (false);
    } if (form.foto.value == "") {
      alert("Foto Tidak Boleh Kosong");
      form.foto.focus();
      return (false);
    }
    return (true);
  }
</script>
<div class="box box-success box-solid">
  <div class="box-header with-border">
    Tambah Data Pengguna
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)">
          <div class="form-group">
            <label>Username</label>
            <input class="form-control" name="username" id="username" />
          </div>
          <div class="form-group">
            <label>Password</label>
            <input class="form-control" name="pass" type="Password" id="pass" />
          </div>
          <div class="form-group">
            <label>Nama Lengkap</label>
            <input class="form-control" name="nama" id="nama" />
          </div>
          <div class="form-group">
            <label>Level Pimpinan :</label>
            <select class="form-control select2" name="level_pimpinan">
              <?php
              $sql = $koneksi->query("select * from tb_tujuan");
              while ($data = $sql->fetch_assoc()) {
                echo "<option value='$data[id_tujuan]'>$data[nama_tujuan]</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>File input</label>
            <input type="file" name="foto" id="foto" />
          </div>
          <div>
            <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
          </div>
      </div>
      </form>
    </div>
  </div>
</div>

<?php
if (is_post()) {
  $username = _post('username');
  $pass = _post('pass');
  $nama = _post('nama');
  $level_pimpinan = _post('level_pimpinan');
  $foto = $_FILES['foto']['name'];
  $lokasi = $_FILES['foto']['tmp_name'];
  $upload = move_uploaded_file($lokasi, "images/" . $foto);
  $simpan = $_POST['simpan'];
  if ($simpan) {
    if ($upload) {
      $sql = $koneksi->query("insert into tb_user (username, password, nama_user, level, foto, level_pimpinan)values('$username', '$pass', '$nama', 'user', '$foto', '$level_pimpinan')");
      if ($sql) {
        swal("success", "Selamat!", "Data Berhasil Disimpan!", "?page=user");
      }
    }
  }
}
?>