<script type="text/javascript">
    function validasi(form) {
        if (form.catatan.value == "") {
            alert("Catatan Surat Tidak Boleh Kosong");
            form.catatan.focus();
            return (false);
        }
        return (true);
    }
</script>
<?php
$id = (int) _get('id');
$sql = $koneksi->query("select * from tb_surat_masuk where id='$id'");
$data = $sql->fetch_assoc();
$tgl_surat = $data['tgl_surat'];
$tgl_terima = $data['tanggal_terima'];
$asal = $data['asal_surat'];
$sifat = $data['sifat_surat'];
$perihal = $data['perihal'];
$agenda = $data['no_agenda'];
$kode_surat = $data['kode_surat'];
$indeks = $data['indeks'];
$tujuan = $data['tujuan'];
?>
<div class="box box-success box-solid">
    <div class="box-header with-border">
        Disposisi Surat Masuk
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Nomor Surat</label>
                                <input class="form-control" name="no" value="<?php echo _post('no', $data['no_surat']) ?>" readonly="" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Tanggal Surat</label>
                                <input class="form-control" value="<?php echo tanggal_indo($data['tgl_surat'], true) ?>" readonly="" />
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sifat :</label>
                                <select class="form-control" id="sifat" name="sifat_dispos" disabled>
                                    <?php 
                                    foreach (sifat_surat() as $key => $value) {
                                        echo "<option " . (_post('sifat_dispos', $sifat) == $key ? 'selected' : '') . " value='$key'>$value</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Perihal Surat</label>
                        <input class="form-control" name="perihal" value="<?php echo _post('perihal', $data['perihal']) ?>" readonly="" />
                    </div>
                    <div class="form-group">
                        <label>Diteruskan :</label>
                        <select class="form-control" name="terus">
                            <option value="">-- PILIH --</option>
                            <?php
                            $m_dispos = $koneksi->query("select * from m_dispos");
                            while ($disposisi = $m_dispos->fetch_assoc()) {
                                $selected = _post('terus') == $disposisi['id_dispos'] ? 'selected' : '';
                                echo "<option value='$disposisi[id_dispos]' $selected>$disposisi[nama_bagian]</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Catatan :</label>
                        <textarea class="form-control" rows="3" name="ket" id="catatan"><?php echo _post('ket') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Batas Waktu</label>
                        <input type="text" readonly data-datepicker class="form-control bg-white" name="batas" value="<?php echo _post('batas') ?>" />
                    </div>
                    <div>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                        <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
if (is_post()) {
    $disposisi_ke = (int) _post('terus');
    $disposisi_dari = (int) auth()->id;
    $keterangan = _post('ket');
    $batas_waktu = _post('batas');
    $simpan = _post('simpan');
    if ($simpan) {
        $koneksi->begin_transaction();
        try {
            $query_disposisi = $koneksi->prepare("INSERT INTO tb_disposisi (id_surat_masuk, disposisi_ke, disposisi_dari, keterangan, batas_waktu) VALUES (?, ?, ?, ?, ?)");
            $query_disposisi->bind_param("iiiss", $id, $disposisi_ke, $disposisi_dari, $keterangan, $batas_waktu);
            $query_disposisi->execute();
            $disposisi_id = $koneksi->insert_id;

            $query_surat = $koneksi->prepare("UPDATE tb_surat_masuk set status=1, disposisi=? where id = ?");
            $query_surat->bind_param("ii", $disposisi_id, $id);
            $query_surat->execute();
            
            $m_dispos = $koneksi->query("SELECT nama_bagian FROM m_dispos WHERE id_dispos=$disposisi_ke");
            $bagian = $m_dispos->fetch_object();

            if (!$bagian) throw new Exception("Tujuan disposisi tidak ditemukan");

            log_history($koneksi, $id, "Disposisi surat ke $bagian->nama_bagian oleh " . auth()->nama_user);

            $koneksi->commit();
            
            $query_disposisi->close();
            $query_surat->close();

            swal("success", "Berhasil!", "Disposisi Berhasil!", "?page=disposisi");
        } catch (\Throwable $th) {
            $koneksi->rollback();
            swal("error", "Gagal!", "Disposisi Gagal! ".$th->getMessage());
        }
        $koneksi->close();
    }
}
?>