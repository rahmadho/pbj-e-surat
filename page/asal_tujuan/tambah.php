<div class="box box-success box-solid">
    <div class="box-header with-border">
        Tambah Asal/Tujuan Surat
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" enctype="multipart/form-data">

                    <div class="form-group">
                        <label>Nama Asal/Tujuan Surat</label>
                        <input class="form-control" name="nama" id="nama" />
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
            $sql = $koneksi->query("insert into tb_asal_tujuan (asal_tujuan) values ('$nama')");
            swal("success", "Berhasil!", "Data berhasil disimpan!", "?page=asal_tujuan");
        } catch (\Throwable $th) {
            swal("error", "Oops!", "Data gagal disimpan!".$th->getMessage(), "?page=asal_tujuan");
        }
    }
}
?>