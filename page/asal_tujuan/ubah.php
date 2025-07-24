<?php
$id = $_GET['id'];
$sql = $koneksi->query("select * from tb_asal_tujuan where id_asal_tujuan='$id'");
$data = $sql->fetch_assoc();
?>
<div class="box box-success box-solid">
    <div class="box-header with-border">
        Ubah Asal/Tujuan Surat
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Nama Asal/Tujuan Surat</label>
                        <input class="form-control" name="nama" value="<?php echo $data['asal_tujuan'] ?>" />
                    </div>

                    <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
            </div>
        </div>
        </form>
    </div>
</div>


<?php
if (is_post()) {
    $nama = $_POST['nama'];
    $simpan = $_POST['simpan'];
    if ($simpan) {
        try {
            $sql = $koneksi->query("update tb_asal_tujuan set asal_tujuan ='$nama' where id_asal_tujuan='$id'");
            swal("success", "Berhasil!", "Data berhasil diubah!", "?page=asal_tujuan");
        } catch (\Throwable $th) {
            swal("error", "Oops!", "Data gagal diubah!".$th->getMessage(), "?page=asal_tujuan");
        }
    }
}
?>