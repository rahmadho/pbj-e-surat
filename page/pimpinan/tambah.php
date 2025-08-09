<div class="box box-success box-solid">
    <div class="box-header with-border">Tambah Data Pimpinan</div>
    <div class="panel-body">
    <?php 
    render("page/pimpinan/form.php", $_POST);
    ?>
    </div>
</div>


<?php
if (is_post()) {
    $nama = _post('nama_tujuan');
    $no_hp = _post('no_hp');
    try {
        $sql = $koneksi->query("INSERT INTO tb_tujuan (nama_tujuan, no_hp)values('$nama', '$no_hp')");
        swal("success", "Selamat!", "Data Berhasil Disimpan!", "?page=pimpinan");
    } catch (\Throwable $th) {
        swal("error", "Oops!", "Data Gagal Disimpan! ".$th->getMessage(), "?page=pimpinan");
    }
}
?>