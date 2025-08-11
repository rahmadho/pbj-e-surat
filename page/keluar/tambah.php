<script type="text/javascript">
    function validasi(form) {
        if (form.no.value == "") {
            alert("Nomor Surat Tidak Boleh Kosong");
            form.no.focus();
            return (false);
        } if (form.tgl.value == "") {
            alert("Tanggal Surat Tidak Boleh Kosng");
            form.tgl.focus();
            return (false);
        } if (form.sifat.value == "") {
            alert("Sifat Surat Tidak Boleh Kosong");
            form.sifat.focus();
            return (false);
        } if (form.kepada.value == "") {
            alert("Kepada Surat Tidak Boleh Kosong");
            form.kepada.focus();
            return (false);
        } if (form.perihal.value == "") {
            alert("Perihal Surat Tidak Boleh Kosong");
            form.perihal.focus();
            return (false);
        }
        return (true);
    }
</script>
<?php
$tahun = date('Y');
$sql = $koneksi->query("select no_agenda from tb_surat_keluar where tahun='$tahun' order by no_agenda desc");
$data = $sql->fetch_assoc();
$id = $data['no_agenda'] ?? 0;
$urut = substr($id, 0, 4);
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
        <form role="form" method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)">
            <div class="box box-success box-solid">
                <div class="box-header with-border">
                    Tambah Surat Keluar
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>NO Agenda</label>
                                    <input class="form-control" name="agenda" id="agenda" readonly=""
                                        value="<?php echo $format ?>" />
                                </div>
                                <div class="form-group">
                                    <label>Sifat Surat :</label>
                                    <select class="form-control" name="sifat" id="sifat">

                                        <option value="Biasa">Biasa</option>
                                        <option value="Penting">Penting</option>
                                        <option value="Sangat Penting">Sangat Penting</option>
                                        <option value="Segera">Segera</option>

                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tujuan Surat :</label>
                                    <select class="form-control select2" name="kepada">
                                        <?php
                                        $sql = $koneksi->query("select * from tb_asal_tujuan");
                                        while ($data = $sql->fetch_assoc()) {
                                            echo "<option value='$data[id_asal_tujuan]'>$data[asal_tujuan]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>No Surat :</label>
                                    <input type="text" class="form-control" name="no" id="no" />
                                </div>
                                <div class="form-group">
                                    <label>Isi Ringkas :</label>
                                    <textarea class="form-control" rows="3" id="perihal" name="perihal"></textarea>
                                </div>
                                <?php if (is_admin()): ?>
                                <div class="form-group">
                                    <label>Dari Bagian :</label>
                                    <select class="form-control select2" name="dispos">
                                        <?php
                                        $sql_dispos = $koneksi->query("select * from m_dispos");
                                        while ($data_dispos = $sql_dispos->fetch_object()) {
                                            echo "<option value='$data_dispos->id_dispos'>$data_dispos->nama_bagian</option>";
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
                                        while ($data = $sql->fetch_assoc()) {
                                            echo "<option value='$data[id]'>$data[kode] - $data[nama]</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Tanggal Surat </label>
                                    <input type="date" data-datepicker class="form-control" name="tgl" id="tgl" />
                                </div>
                                <div class="form-group">
                                    <label>File Surat (Format pdf)</label>
                                    <input type="file" name="foto" id="foto" accept=".pdf" />
                                </div>

                                <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                                <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<?php
if (is_post() && _post('simpan')) {
    $created_by = auth()->id;

    if (is_admin()) {
        $dispos_id = (int) _post('dispos');
    } else {
        $dispos_id = $koneksi->query("SELECT id_dispos FROM m_dispos WHERE id_leader = $created_by")
            ->fetch_object()
            ->id_dispos;
    }
    $tahun = date('Y');
    $no = _post('no');
    $tgl = _post('tgl');
    $sifat = _post('sifat');
    $kepada = (int) _post('kepada');
    $perihal = _post('perihal');
    $agenda = _post('agenda');
    $kode_surat = (int) _post('kode_surat');
    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    $upload = move_uploaded_file($lokasi, "file/" . $foto);
    if ($upload) {
        try {
            $simpan = $koneksi->prepare("INSERT INTO tb_surat_keluar (no_surat, tgl_surat, kepada, sifat_surat, perihal, no_agenda, kode_surat, foto, tahun, created_by, dispos_id)
                values (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $simpan->bind_param("ssisssisssi", $no, $tgl, $kepada, $sifat, $perihal, $agenda, $kode_surat, $foto, $tahun, $created_by, $dispos_id);
            $simpan->execute();
            swal("success", "Selamat!", "Data Berhasil Disimpan!", "?page=keluar");
        } catch (\Throwable $th) {
            swal("error", "Oops!", "Gagal Menyimpan Data! ".$th->getMessage(), "?page=keluar");
        }
    }
}
?>