<?php
$id = _get('id');
$sql = $koneksi->query("select * from tb_tujuan where id_tujuan='$id'");
$data = $sql->fetch_assoc();
?>
<div class="box box-success box-solid">
    <div class="box-header with-border">Ubah Data Pimpinan</div>
    <div class="panel-body">
    <?php 
    render("page/pimpinan/form.php", $data);
    ?>
    </div>
</div>

<?php
if (is_post()) {
    $nama = _post('nama_tujuan');
    $no_hp = _post('no_hp');
    try {
        $sql = $koneksi->query("update tb_tujuan set nama_tujuan='$nama', no_hp='$no_hp' where id_tujuan='$id'");
        swal("success", "Selamat!", "Data Berhasil Disimpan!", "?page=pimpinan");
    } catch (\Throwable $th) {
        swal("error", "Oops!", "Data Gagal Disimpan! ".$th->getMessage(), "?page=pimpinan");
    }
}
?>