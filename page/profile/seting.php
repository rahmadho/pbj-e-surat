<?php
$data = profile();
?>
<div class="panel panel-primary">
  <div class="panel-heading">
    Ubah Profile
  </div>
  <div class="panel-body">
    <div class="row">
      <div class="col-md-12">
        <form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)">
          <div class="form-group">
            <label>Kota</label>
            <input class="form-control" name="kota" value="<?php echo $data->kota; ?>" />
          </div>
          <div class="form-group">
            <label>Nama Lembaga</label>
            <textarea class="form-control" rows="3" name="lembaga"><?php echo $data->lembaga ?></textarea>
          </div>
          <div class="form-group">
            <label>Alamat</label>
            <textarea class="form-control" rows="3" name="alamat"><?php echo $data->alamat ?></textarea>
          </div>
          <div class="form-group">
            <label>Telpon</label>
            <input class="form-control" name="telp" id="pass" value="<?php echo $data->telpon; ?>" />
          </div>
          <div class="form-group">
            <label>Foto</label>
            <label><img src='images/<?php echo $data->foto; ?>' height="75"></label>
          </div>
          <div class="form-group">
            <label>Ganti Foto</label>
            <input type="file" name="foto" id="foto" />
          </div>
          <div>
            <input type="submit" name="simpan" value="Ubah" class="btn btn-primary">
          </div>
      </div>
      </form>
    </div>
  </div>
</div>
<?php
if (is_post()) {
  $kota = _post('kota');
  $lembaga = _post('lembaga');
  $alamat = _post('alamat');
  $telp = _post('telp');
  $foto = $_FILES['foto']['name'];
  $lokasi = $_FILES['foto']['tmp_name'];

  if (_post('simpan')) {
    try {
      if (!empty($lokasi)) {
        $upload = move_uploaded_file($lokasi, "images/" . $foto);
        $koneksi->query("update tb_profile set kota='$kota', lembaga='$lembaga', alamat='$alamat', telpon='$telp', foto='$foto'");
      } else {
        $koneksi->query("update tb_profile set kota='$kota', lembaga='$lembaga', alamat='$alamat', telpon='$telp'");
      }
      
      $updateProfile = $koneksi->query("SELECT * FROM tb_profile");
      $data = $updateProfile->fetch_object();
      $_SESSION['profile'] = $data;

      swal("success", "Berhasil!", "Data Berhasil Diubah!", "?page=profile&aksi=seting");
    } catch (\Throwable $th) {
      swal("error", "Gagal!", "Gagal Mengubah Data!");
    }
  }
}
?>