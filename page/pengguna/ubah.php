<?php
$id = _get('id');
$sql = $koneksi->query("select * from tb_user where id='$id'");
$data = $sql->fetch_assoc();
?>
<div class="box box-success box-solid">
    <div class="box-header with-border">
        Ubah Data Pengguna
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" name="username" value="<?php echo $data['username']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Nama Lengkap</label>
                        <input class="form-control" name="nama" id="nama" value="<?php echo $data['nama_user']; ?>" />
                    </div>
                    <div class="form-group">
                        <label>Level</label>
                        <input class="form-control" name="level" id="pass" value="<?php echo $data['level']; ?>"
                            readonly />
                    </div>
                    <div class="form-group">
                        <label>Level Pimpinan :</label>
                        <select class="form-control select2" name="level_pimpinan">
                        <?php
                        $sql = $koneksi->query("select * from tb_tujuan");
                        while ($level_pimpinan = $sql->fetch_assoc()) {
                            $selected = ($data['level_pimpinan'] == $level_pimpinan['id_tujuan']) ? 'selected' : '';
                            echo "<option value='$level_pimpinan[id_tujuan]' $selected>$level_pimpinan[nama_tujuan]</option>";
                        }
                        ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Foto</label>
                        <label><img src='images/<?php echo $data['foto']; ?>' width="100" height="75"></label>
                    </div>
                    <div class="form-group">
                        <label>Ganti Foto</label>
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
    $nama = _post('nama');
    $level_pimpinan = _post('level_pimpinan');
    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];
    $simpan = _post('simpan');
    if ($simpan) {
        if (!empty($lokasi)) {
            $upload = move_uploaded_file($lokasi, "images/" . $foto);
            $sql = $koneksi->query("update  tb_user set username='$username',  nama_user='$nama', foto='$foto', level_pimpinan='$level_pimpinan' where id='$id'");
            if ($sql) {
                swal("success", "Selamat!", "Data Berhasil Diubah!", "?page=user");
            }
        } else {
            $sql = $koneksi->query("update  tb_user set username='$username', nama_user='$nama', level_pimpinan='$level_pimpinan' where id='$id'");
            if ($sql) {
                swal("success", "Selamat!", "Data Berhasil Diubah!", "?page=user");
            }
        }
    }
}
?>