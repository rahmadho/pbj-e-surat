<?php
$id = (int) $_GET['id'];
$sql = $koneksi->query("select * from tb_agenda where id='$id'");
$agenda = $sql->fetch_object();
if (empty($agenda)) {
    swal("error", "Oops!", "Data agenda tidak ditemukan", "?page=agenda");
    exit;
};
?>
<div class="box box-success box-solid">
    <div class="box-header with-border">
        Dokumentasi Agenda
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th class="bg-light" width="200">Tanggal Agenda</th>
                        <td><?php echo $agenda->tgl_agenda; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">Waktu Agenda</th>
                        <td><?php echo $agenda->waktu_agenda; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">Tempat Agenda</th>
                        <td><?php echo $agenda->tempat_agenda; ?></td>
                    </tr>
                    <?php if (is_level(LEVEL_KABIRO) || is_admin()) { ?>
                    <tr>
                        <th class="bg-light" width="200">Keterangan</th>
                        <td><?php echo $agenda->keterangan; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">Laporan</th>
                        <td>
                            <?php if (!empty($agenda->file_laporan)) { ?>
                            <a href="file/<?php echo $agenda->file_laporan; ?>" target="blank">Lihat</a>
                            <?php } else { ?>
                            <span class="text-danger">Belum ada laporan</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">Foto Dokumentasi</th>
                        <td>
                            <?php if (!empty($agenda->file_foto)) { ?>
                            <a href="file/<?php echo $agenda->file_foto; ?>" target="blank">Lihat</a>
                            <?php } else { ?>
                            <span class="text-danger">Belum ada foto dokumentasi</span>
                            <?php } ?>
                        </td>
                    </tr>   
                    <?php } ?>
                </table>
            </div>
            <?php if (is_level(LEVEL_KABAG) || is_level(LEVEL_KASUBAG)) { ?>
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)">
                    <div class="form-group">
                        <label>Keterangan</label>
                        <textarea class="form-control" name="keterangan" rows="3"><?= $agenda->keterangan ?></textarea>
                    </div>
                    <div class="form-group">
                        <label>Laporan</label>
                        <input type="file" class="form-controlx" name="laporan" />
                    </div>
                    <div class="form-group">
                        <label>Foto Dokumentasi</label>
                        <input type="file" class="form-controlx" name="photo" />
                    </div>
                    <div>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                        <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
                    </div>
                </form>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    function validasi(form) {
        if (form.keterangan.value == "") {
            alert("Keterangan Dokumentasi Tidak Boleh Kosong");
            form.keterangan.focus();
            return (false);
        }
        if (form.laporan.value == "") {
            alert("File Laporan Tidak Boleh Kosong");
            form.laporan.focus();
            return (false);
        }
        if (form.photo.value == "") {
            alert("Foto Dokumentasi Tidak Boleh Kosong");
            form.photo.focus();
            return (false);
        }
        return (true);
    }
</script>
<?php
if (is_post()) {
    try {
        $keterangan = $_POST['keterangan'];
        $file_laporan = $_FILES['laporan']['name'];
        $file_foto = $_FILES['photo']['name'];
        $upload = move_uploaded_file($_FILES['laporan']['tmp_name'], "file/" . $file_laporan);
        $upload = move_uploaded_file($_FILES['photo']['tmp_name'], "file/" . $file_foto);
        $sql = $koneksi->prepare("UPDATE tb_agenda SET keterangan=?, file_laporan=?, file_foto=? where id = $id");
        $sql->bind_param("sssi", $keterangan, $file_laporan, $file_foto, $id);
        $sql->execute();
        $sql->close();
        swal("success", "Berhasil!", "Dokumentasi Berhasil di Upload!", "?page=agenda");
    } catch (\Throwable $th) {
        swal("error", "Oops!", "Gagal Simpan Dokumentasi! ".$th->getMessage());
    }
}
?>