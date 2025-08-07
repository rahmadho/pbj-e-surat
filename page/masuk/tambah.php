<script type="text/javascript">
  function validasi(form) {
    if (form.no.value == "") {
      alert("Nomor Surat Tidak Boleh Kosong");
      form.no.focus();
      return (false);
    } if (form.tgl_surat.value == "") {
      alert("Tanggal Surat Tidak Boleh Kosong");
      form.tgl_surat.focus();
      return (false);
    } if (form.tgl_terima.value == "") {
      alert("Tanggal Terima Tidak Boleh Kosong");
      form.tgl_terima.focus();
      return (false);
    } if (form.asal.value == "") {
      alert("Asal Surat Tidak Boleh Kosong");
      form.asal.focus();
      return (false);
    } if (form.agenda.value == "") {
      alert("No Agenda Tidak Boleh Kosong");
      form.agenda.focus();
      return (false);
    } if (form.sifat.value == "") {
      alert("Sifat Surat Tidak Boleh Kosong");
      form.sifat.focus();
      return (false);
    } if (form.perihal.value == "") {
      alert("Perihal Surat Tidak Boleh Kosong");
      form.perihal.focus();
      return (false);
    } if (form.foto.value == "") {
      alert("File Surat Tidak Boleh Kosong");
      form.foto.focus();
      return (false);
    }
    var is_undangan = document.querySelector('input[name="is_undangan"]').checked;
    if (is_undangan) {
      var tglAgenda = document.getElementById('tgl_agenda').value;
      var waktuAgenda = document.getElementById('waktu_agenda').value;
      var tempatAgenda = document.getElementById('tempat_agenda').value;
      if (!tglAgenda) {
        alert("Tanggal Agenda Tidak Boleh Kosong");
        document.getElementById('tgl_agenda').focus();
        return false;
      }
      if (!waktuAgenda) {
        alert("Waktu Agenda Tidak Boleh Kosong");
        document.getElementById('waktu_agenda').focus();
        return false;
      }
      if (!tempatAgenda) {
        alert("Tempat Agenda Tidak Boleh Kosong");
        document.getElementById('tempat_agenda').focus();
        return false;
      }
    }
    return (true);
  }
</script>
<?php
$tahun = date('Y');
$sql = $koneksi->query("select no_agenda from tb_surat_masuk where tahun='$tahun' order by no_agenda desc");
$data = $sql->fetch_object();
$id = $data->no_agenda;
$urut = $id ? substr($id, 0, 4) : 0;
$tambah = (int) $urut + 1;
if (strlen($tambah) == 1) {
  $format = "000" . $tambah;
} else if (strlen($tambah) == 2) {
  $format = "00" . $tambah;
} else if (strlen($tambah) == 3) {
  $format = "0" . $tambah;
} else {
  $format = $tambah;
}
?>
<div class="row">
  <div class="col-md-12">
    <!-- Form Elements -->
    <form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)">
      <div class="box box-success box-solid">
        <div class="box-header with-border">
          Tambah Surat Masuk
        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>NO Agenda</label>
                <input class="form-control" name="agenda" id="agenda" readonly="" value="<?php echo $format ?>" />
              </div>
              <div class="form-group">
                <label>Sifat Surat :</label>
                <select class="form-control" id="sifat" name="sifat">
                  <option value="">-- PILIH --</option>
                  <?php 
                  foreach (SIFAT_SURAT as $key => $sifat) {
                      $selected = (_post('sifat') == $key) ? "selected" : "";
                      echo "<option value='$key' $selected>$sifat</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Asal Surat :</label>
                <select class="form-control select2" name="asal">
                  <option value="">-- PILIH --</option>
                  <?php
                  $sql = $koneksi->query("select * from tb_asal_tujuan");
                  while ($data = $sql->fetch_object()) {
                    echo "<option value='$data->id_asal_tujuan'>$data->asal_tujuan</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Nomor Surat</label>
                <input class="form-control" name="no" id="no" />
              </div>
              <div class="form-group">
                <label>Perihal :</label>
                <textarea class="form-control" rows="3" name="perihal" id="perihal"></textarea>
              </div>
              <div class="form-group">
                <label>Tujuan Surat :</label>
                <select class="form-control select2" name="tujuan">
                  <option value="">-- PILIH --</option>
                  <?php
                  $sql = $koneksi->query("select * from tb_tujuan");
                  $data = $sql->fetch_object();
                  echo "<option value='$data->id_tujuan'>$data->nama_tujuan</option>";
                  ?>
                </select>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Kode Surat :</label>
                <select class="form-control select2" name="kode_surat">
                  <option value="">-- PILIH --</option>
                  <?php
                  $sql = $koneksi->query("select * from ref_klasifikasi");
                  while ($data = $sql->fetch_object()) {
                    echo "<option value='$data->id'>$data->kode - $data->nama</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Indeks Berkas </label>
                <input class="form-control" name="indek" required="" />
              </div>
              <div class="form-group">
                <label>Tanggal Surat</label>
                <input type="text" readonly data-datepicker class="form-control" name="tgl_surat" id="tgl_surat" />
              </div>
              <div class="form-group">
                <label>Tanggal Terima</label>
                <input type="text" readonly data-datepicker class="form-control" name="tgl_terima" id="tgl_terima" value="<?php echo date('Y-m-d'); ?>" />
              </div>
              <div class="form-group">
                <label>File Surat (Format pdf)</label>
                <input type="file" name="foto" id="foto" accept=".pdf" />
              </div>
              <hr>
              <div class="form-group">
                <div style="display: flex; align-items: center; gap: 8px;">
                  <input type="checkbox" name="is_undangan" class="minimal" value="1" id="is_undangan" style="margin: 0;">
                  <label for="is_undangan" style="margin: 0;">
                    Ceklis jika surat Undangan
                  </label>
                </div>
              </div>
              <div id="detail-undangan" class="p-2" style="display: none; border: 1px solid #ccc; border-radius: 1px; padding: 12px">
                <h4 style="font-weight: 600;">Detail Undangan</h4>
                <div style="margin: 12px 0; border-bottom: 1px solid #ccc"></div>
                <div class="row" id="if-undangan">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Tanggal Agenda</label>
                      <input type="text" readonly data-datepicker class="form-control" name="tgl_agenda" id="tgl_agenda" />
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Waktu Agenda</label>
                      <input type="time" class="form-control" name="waktu_agenda" id="waktu_agenda" />
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Tempat Agenda</label>
                      <input type="text" class="form-control" name="tempat_agenda" id="tempat_agenda" />
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <script>
            $(document).ready(function () {
              $('#is_undangan').change(function () {
                console.log($(this).is(':checked'));
                if ($(this).is(':checked')) {
                  $('#detail-undangan').show();
                } else {
                  $('#detail-undangan').hide();
                }
              });
            });
          </script>
        </div>
        <div class="box-footer">
          <div style="display: flex; align-items: center; gap: 8px; justify-content: flex-end;">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
            <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
          </div>
        </div>
      </div>
    </form>
  </div>
</div>
<?php
if (is_post()) {
  $tahun = date('Y');
  $no = $_POST['no'];
  $tgl_surat = $_POST['tgl_surat'];
  $tgl_terima = $_POST['tgl_terima'];
  $asal = $_POST['asal'];
  $sifat = $_POST['sifat'];
  $perihal = $_POST['perihal'];
  $agenda = $_POST['agenda'];
  $tujuan = $_POST['tujuan'];
  $kode_surat = $_POST['kode_surat'];
  $indek = $_POST['indek'];
  $foto = $_FILES['foto']['name'];
  $lokasi = $_FILES['foto']['tmp_name'];
  $upload = move_uploaded_file($lokasi, "file/" . $foto);
  $simpan = $_POST['simpan'];
  $status = 0;
  if ($simpan) {
    if ($upload) {
      $koneksi->begin_transaction();
      try {
        $query_surat = $koneksi->prepare("INSERT INTO tb_surat_masuk (no_surat, tgl_surat, tanggal_terima, asal_surat, sifat_surat, perihal, no_agenda, file_surat, status, tujuan, kode_surat, indeks, tahun) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query_surat->bind_param("sssissssiiiss", $no, $tgl_surat, $tgl_terima, $asal, $sifat, $perihal, $agenda, $foto, $status, $tujuan, $kode_surat, $indek, $tahun); // "ss" artinya dua parameter string
        $query_surat->execute();
    
        $id_surat = $koneksi->insert_id;

        if ($_POST['is_undangan'] == 1) {
          $tgl_agenda = $_POST['tgl_agenda'];
          $waktu_agenda = $_POST['waktu_agenda'];
          $tempat_agenda = $_POST['tempat_agenda'];
          $keterangan = null;
          $query_agenda = $koneksi->prepare("INSERT INTO tb_agenda (id_surat, tgl_agenda, waktu_agenda, tempat_agenda, keterangan) VALUES (?, ?, ?, ?, ?)");
          $query_agenda->bind_param("issss", $id_surat, $tgl_agenda, $waktu_agenda, $tempat_agenda, $keterangan);
          $query_agenda->execute();
        }

        log_history($koneksi, $id_surat, "Surat masuk dengan no agenda " . $agenda . " dientri oleh " . auth()->nama_user);

        $koneksi->commit();

        $query_surat->close();
        if ($query_agenda) $query_agenda->close();
        swal("success", "Berhasil!", "Surat Masuk Berhasil Disimpan!", "?page=masuk");
      } catch (\Throwable $th) {
        $koneksi->rollback();
        swal("error", "Gagal!", "Surat Masuk Gagal Disimpan! " . $th->getMessage());
      }
    }
  }
}
?>