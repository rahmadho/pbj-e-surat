<?php
$id = $_GET['id'];
$sql = $koneksi->query("select * from tb_surat_masuk where id='$id'");
$data = $sql->fetch_assoc();

if (empty($data)) {
    swal("error", "Oops!", "Data surat masuk tidak ditemukan", "?page=masuk");
    exit;
};

$agenda = $koneksi->query("select * from tb_agenda where id_surat='$id'");
$agenda = $agenda->fetch_object();
$indeks = $data['indeks'];
$tgl_surat = $data['tgl_surat'];
$tanggal_terima = $data['tanggal_terima'];
$kode_surat = $data['kode_surat'];
$tujuan = $data['tujuan'];
$asal_tujuan = $data['asal_surat'];
?>
<form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)">
    <div class="box box-success box-solid">
        <div class="box-header with-border">
            Ubah Surat Masuk
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>NO Agenda</label>
                        <input class="form-control" name="agenda" value="<?php echo $data['no_agenda'] ?>"
                            readonly="" />
                    </div>
                    <div class="form-group">
                        <label>Sifat Surat :</label>
                        <select class="form-control" name="sifat">
                            <option value="">-- PILIH --</option>
                            <?php 
                                foreach (SIFAT_SURAT as $key => $sifat) {
                                    $select = ($data['sifat_surat'] == $key ? "selected" : "");
                                    echo "<option value='$key' $select>$sifat</option>";
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
                            while ($tampil_t = $sql->fetch_assoc()) {
                                $pilih_t = ($tampil_t['id_asal_tujuan'] == $asal_tujuan ? "selected" : "");
                                echo "<option value='$tampil_t[id_asal_tujuan]'  $pilih_t>$tampil_t[asal_tujuan]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nomor Surat</label>
                        <input class="form-control" name="no" value="<?php echo $data['no_surat'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Perihal :</label>
                        <textarea class="form-control" rows="3" name="perihal"><?php echo $data['perihal'] ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Tujuan Surat :</label>
                        <select class="form-control select2" name="tujuan">
                            <option value="">-- PILIH --</option>
                            <?php
                            $sql = $koneksi->query("select * from tb_tujuan");
                            $tampil_t = $sql->fetch_assoc();
                            $pilih_t = ($tampil_t['id_tujuan'] == $tujuan ? "selected" : "");
                            echo "<option value='$tampil_t[id_tujuan]' $pilih_t>$tampil_t[nama_tujuan]</option>";
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
                            while ($tampil_t = $sql->fetch_assoc()) {
                                $pilih_t = ($tampil_t['id'] == $kode_surat ? "selected" : "");
                                echo "<option value='$tampil_t[id]' $pilih_t>$tampil_t[kode] - $tampil_t[nama]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Indeks Berkas </label>
                        <input class="form-control" name="indek" required="" value="<?php echo $indeks ?>" />
                    </div>
                    <div class="form-group">
                        <label>Tanggal Surat</label>
                        <input type="text" readonly data-datepicker class="form-control bg-white" name="tgl_surat" value="<?php echo $tgl_surat ?>" />
                    </div>
                    <div class="form-group">
                        <label>Tanggal Terima</label>
                        <input type="text" readonly data-datepicker class="form-control bg-white" name="tgl_terima"
                            value="<?php echo $tanggal_terima ?>" />
                    </div>
                    <div class="form-group">
                        <label>File Surat (Format pdf)</label>
                        <input type="file" name="foto" id="foto" />
                    </div>
                    <hr>
                    <div class="form-group">
                        <div style="display: flex; align-items: center; gap: 8px;">
                        <input type="checkbox" name="is_undangan" value="1" id="is_undangan" style="margin: 0;" <?php if ($agenda) { echo "checked"; } ?>>
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
                            <input type="text" readonly data-datepicker class="form-control bg-white" name="tgl_agenda" id="tgl_agenda" value="<?php echo $agenda?->tgl_agenda ?>" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label>Waktu Agenda</label>
                            <input type="time" class="form-control" name="waktu_agenda" id="waktu_agenda" value="<?php echo $agenda?->waktu_agenda ?>" />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                            <label>Tempat Agenda</label>
                            <input type="text" class="form-control" name="tempat_agenda" id="tempat_agenda" value="<?php echo $agenda?->tempat_agenda ?>" />
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="box-footer">
          <div style="display: flex; align-items: center; gap: 8px; justify-content: flex-end;">
            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
            <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
          </div>
        </div>
    </div>
</form>
<script>
$(document).ready(function () {
    function showDetail() {
        if ($('#is_undangan').is(':checked')) {
            $('#detail-undangan').show();
        } else {
            $('#detail-undangan').hide();
        }
    }
    showDetail();

    $('#is_undangan').change(function () {
        showDetail();
    });
});
</script>
<?php
if (is_post()) {
    $no = $_POST['no'];
    $tgl_surat = $_POST['tgl_surat'];
    $tgl_terima = $_POST['tgl_terima'];
    $asal = (int) $_POST['asal'];
    $sifat = $_POST['sifat'];
    $perihal = $_POST['perihal'];
    $no_agenda = $_POST['agenda'];
    $tujuan = (int) $_POST['tujuan'];
    $kode_surat = (int) $_POST['kode_surat'];
    $indek = $_POST['indek'];
    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    $simpan = $_POST['simpan'];
    if ($simpan) {
        $koneksi->begin_transaction();
        try {
            if (!empty($lokasi)) {
                $upload = move_uploaded_file($lokasi, "file/" . $foto);
                $query = "update tb_surat_masuk set no_surat=?, tgl_surat=?, tanggal_terima=?, asal_surat=?, sifat_surat=?, perihal=?, file_surat=?, tujuan=?, kode_surat=?, indeks=? where id=?";
                $query_surat = $koneksi->prepare($query);
                $query_surat->bind_param("sssisssiisi", $no, $tgl_surat, $tgl_terima, $asal, $sifat, $perihal, $foto, $tujuan, $kode_surat, $indek, $id);    
            } else {
                $query = "update tb_surat_masuk set no_surat=?, tgl_surat=?, tanggal_terima=?, asal_surat=?, sifat_surat=?, perihal=?, tujuan=?, kode_surat=?, indeks=? where id=?";
                $query_surat = $koneksi->prepare($query);
                $query_surat->bind_param("sssissiisi", $no, $tgl_surat, $tgl_terima, $asal, $sifat, $perihal, $tujuan, $kode_surat, $indek, $id);    
            }
            $query_surat->execute();

            if ($_POST['is_undangan'] == 1 && !$agenda) {
                $id_surat = (int) $id;
                $tgl_agenda = $_POST['tgl_agenda'];
                $waktu_agenda = $_POST['waktu_agenda'];
                $tempat_agenda = $_POST['tempat_agenda'];
                $keterangan = null;
                $query_agenda = $koneksi->prepare("INSERT INTO tb_agenda (id_surat, tgl_agenda, waktu_agenda, tempat_agenda, keterangan) VALUES (?, ?, ?, ?, ?)");
                $query_agenda->bind_param("issss", $id_surat, $tgl_agenda, $waktu_agenda, $tempat_agenda, $keterangan);
                $query_agenda->execute();
            } else if ($_POST['is_undangan'] == 1 && $agenda) {
                $tgl_agenda = $_POST['tgl_agenda'];
                $waktu_agenda = $_POST['waktu_agenda'];
                $tempat_agenda = $_POST['tempat_agenda'];
                $keterangan = null;
                $query_agenda = $koneksi->prepare("UPDATE tb_agenda SET tgl_agenda=?, waktu_agenda=?, tempat_agenda=?, keterangan=? WHERE id=?");
                $query_agenda->bind_param("ssssi", $tgl_agenda, $waktu_agenda, $tempat_agenda, $keterangan, $agenda->id);
                $query_agenda->execute();
            }
            $koneksi->commit();
            $query_surat->close();
            if ($query_agenda) $query_agenda->close();
            swal("success", "Berhasil!", "Data Berhasil Diubah!", "?page=masuk");
        } catch (\Throwable $th) {
            $koneksi->rollback();
            print_r($th->getMessage());
            swal("error", "Gagal!", "Data Gagal Diubah! ".$th->getMessage());
        }
    }
}
?>