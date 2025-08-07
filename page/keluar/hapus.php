<?php
$id = (int) _get('id');
try {
    $sql = $koneksi->prepare("DELETE FROM tb_surat_keluar WHERE no_agenda=?");
    $sql->bind_param("i", $id);
    $sql->execute();
    swal("success", "Selamat!", "Data Berhasil Dihapus!", "?page=keluar");
} catch (\Throwable $th) {
    swal("error", "Oops!", "Gagal Menghapus Data! ".$th->getMessage(), "?page=keluar");
}