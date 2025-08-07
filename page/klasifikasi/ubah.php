<?php
$id = $_GET['id'];
$sql = $koneksi->query("select * from ref_klasifikasi where id='$id'");
$data = $sql->fetch_assoc();
?>
<div class="box box-success box-solid">
    <div class="box-header with-border">
        Ubah Klasifikasi Surat
    </div>
    <div class="panel-body">
        <?php 
        render("page/klasifikasi/form.php", $data);
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
        $sql = $koneksi->query("UPDATE ref_klasifikasi set kode='$kode', nama='$nama', uraian='$uraian' where id='$id'");
        swal("success", "Selamat!", "Data Berhasil Diubah!", "?page=klasifikasi");
    } catch (\Throwable $th) {
        swal("error", "Oops!", "Gagal Menyimpan Data", "?page=klasifikasi");
    }
}
?>