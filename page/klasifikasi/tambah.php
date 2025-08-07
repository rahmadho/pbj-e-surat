<div class="box box-success box-solid">
    <div class="box-header with-border">
        Tambah Klasifikasi Surat
    </div>
    <div class="panel-body">
        <?php 
        render("page/klasifikasi/form.php", $_POST);
        ?>
    </div>
    <div class="panel-footer">
        <button form="form" type="submit" name="simpan" class="btn btn-success">Simpan</button>
    </div>
</div>


<?php
if (is_post()) {
    $nama = _post('nama');
    $kode = _post('kode');
    $uraian = _post('uraian');
    try {
        $sql = $koneksi->prepare("INSERT INTO ref_klasifikasi (kode, nama, uraian) VALUES (?, ?, ?)");
        $sql->bind_param("sss", $kode, $nama, $uraian);
        $sql->execute();
        swal("success", "Selamat!", "Data Berhasil Disimpan!", "?page=klasifikasi");
    } catch (\Throwable $th) {
        swal("error", "Oops!", "Gagal Menyimpan Data", "?page=klasifikasi");
    }
}