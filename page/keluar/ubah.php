<?php
$id = $_GET['id'];
$sql = $koneksi->query("select * from tb_surat_keluar where id='$id'");
$data = $sql->fetch_assoc();
$kode_surat = $data['kode_surat'];
$asal_tujuan = $data['kepada'];
?>
<div class="row">
  <div class="col-md-12">
    <!-- Form Elements -->
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        Ubah Surat Keluar
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-12">
            <form role="form" method="POST" enctype="multipart/form-data">
              <div class="col-md-6">
                <div class="form-group">
                  <label>NO Agenda</label>
                  <input class="form-control" name="agenda" id="agenda" readonly=""
                    value="<?php echo $data['no_agenda'] ?>" />
                </div>
                <div class="form-group">
                  <label>Sifat Surat :</label>
                  <select class="form-control" name="sifat">
                    <option>--Pilih Sifat Surat--</option>
                    <option value="Biasa" <?php if ($data['sifat_surat'] == 'Biasa') {
                      echo "selected";
                    } ?>>Biasa</option>
                    <option value="Penting" <?php if ($data['sifat_surat'] == 'Penting') {
                      echo "selected";
                    } ?>>Penting
                    </option>
                    <option value="Sangat Penting" <?php if ($data['sifat_surat'] == 'Sangat Penting') {
                      echo "selected";
                    } ?>>Sangat Penting</option>
                    <option value="Segera" <?php if ($data['sifat_surat'] == 'Segera') {
                      echo "selected";
                    } ?>>Segera
                    </option>

                  </select>
                </div>
                <div class="form-group">
                  <label>Tujuan Surat :</label>
                  <select class="form-control select2" name="kepada">
                    <?php
                    $sql = $koneksi->query("select * from tb_asal_tujuan");
                    while ($tampil_t = $sql->fetch_assoc()) {
                      $pilih_t = ($tampil_t['id_asal_tujuan'] == $asal_tujuan ? "selected" : "");
                      echo "<option value='$tampil_t[id_asal_tujuan]'  $pilih_t>$tampil_t[asal_tujuan]</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>No Surat :</label>
                  <input type="text" class="form-control" name="no" value="<?php echo $data['no_surat'] ?>" />
                </div>
                <div class="form-group">
                  <label>Isi Ringkas :</label>
                  <textarea class="form-control" rows="3" name="perihal"><?php echo $data['perihal'] ?></textarea>
                </div>
              </div>
              <div class="col-md-6">

                <div class="form-group">
                  <label>Kode Surat :</label>
                  <select class="form-control select2" name="kode_surat">
                    <?php
                    $sql = $koneksi->query("select * from ref_klasifikasi");
                    while ($tampil_t = $sql->fetch_assoc()) {
                      $pilih_t = ($tampil_t['id'] == $kode_surat ? "selected" : "");
                      echo "<option value='$tampil_t[id]' $pilih_t>$tampil_t[kode] - $tampil_t[nama]</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Tanggal Surat </label>
                  <input type="date" class="form-control" name="tgl" value="<?php echo $data['tgl_surat'] ?>" />
                </div>
                <div class="form-group">
                  <label>File Surat (Format pdf)</label>
                  <input type="file" name="foto" id="foto" />
                </div>
                <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
if (is_post()) {
  $no = $_POST['no'];
  $tgl = $_POST['tgl'];
  $sifat = $_POST['sifat'];
  $kepada = $_POST['kepada'];
  $perihal = $_POST['perihal'];
  $agenda = $_POST['agenda'];
  $kode_surat = $_POST['kode_surat'];
  $foto = $_FILES['foto']['name'];
  $lokasi = $_FILES['foto']['tmp_name'];
  try {
    if (!empty($lokasi)) {
      $upload = move_uploaded_file($lokasi, "file/" . $foto);
      $simpan = $koneksi->query("update tb_surat_keluar set no_surat='$no', tgl_surat='$tgl',  kepada='$kepada', sifat_surat='$sifat', perihal='$perihal',  kode_surat='$kode_surat', foto='$foto' where id='$id'");
      if ($simpan) {
        swal("success", "Berhasil!", "Data Berhasil Disimpan!", "?page=keluar");
      }
    } else {
      $simpan = $koneksi->query("update tb_surat_keluar set no_surat='$no', tgl_surat='$tgl',  kepada='$kepada', sifat_surat='$sifat', perihal='$perihal',  kode_surat='$kode_surat' where id='$id'");
      if ($simpan) {
        swal("success", "Berhasil!", "Data Berhasil Disimpan!", "?page=keluar");
      }
    }
  } catch (\Throwable $th) {
    swal("error", "Oops!", "Gagal Simpan Data! ".$th->getMessage());
  }
}
?>