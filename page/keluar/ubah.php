<?php
$id = (int) _get('id');
try {
    $sql = $koneksi->query("SELECT * FROM tb_surat_keluar WHERE id=$id");
    $data = $sql->fetch_object();
    $kode_surat = $data->kode_surat;
    $asal_tujuan = $data->kepada;
    $dispos_id = $data->dispos_id;
} catch (\Throwable $th) {
    swal("error", "Oops!", "Gagal Mengambil Data! ".$th->getMessage(), "?page=keluar");
}

if (empty($data)) {
  swal("error", "Oops!", "Data surat keluar tidak ditemukan", "?page=keluar");
  exit;
};

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
                    value="<?php echo $data->no_agenda ?>" />
                </div>
                <div class="form-group">
                  <label>Sifat Surat :</label>
                  <select class="form-control" name="sifat">
                    <option value="">-- PILIH --</option>
                    <?php 
                        foreach (SIFAT_SURAT as $key => $sifat) {
                            $select = ($data->sifat_surat == $sifat ? "selected" : "");
                            echo "<option value='$sifat' $select>$sifat</option>";
                        }
                    ?>
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
                  <input type="text" class="form-control" name="no" value="<?php echo $data->no_surat ?>" />
                </div>
                <div class="form-group">
                  <label>Isi Ringkas :</label>
                  <textarea class="form-control" rows="3" name="perihal"><?php echo $data->perihal ?></textarea>
                </div>
                <?php if (is_admin()): ?>
                  <div class="form-group">
                      <label>Dari Bagian :</label>
                      <select class="form-control select2" name="dispos" disabled>
                          <?php
                          $sql_dispos = $koneksi->query("SELECT * FROM m_dispos");
                          while ($data_dispos = $sql_dispos->fetch_object()) {
                              $select = ($data_dispos->id_dispos == $dispos_id ? "selected" : "");
                              echo "<option value='$data_dispos->id_dispos' $select>$data_dispos->nama_bagian</option>";
                          }
                          ?>
                      </select>
                  </div>
                <?php endif; ?>
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
                  <input type="date" data-datepicker class="form-control" name="tgl" value="<?php echo $data->tgl_surat ?>" />
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
  $no = _post('no');
  $tgl = _post('tgl');
  $sifat = _post('sifat');
  $kepada = _post('kepada');
  $perihal = _post('perihal');
  $agenda = _post('agenda');
  $kode_surat = _post('kode_surat');
  $dispos_id = (int) _post('dispos');
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