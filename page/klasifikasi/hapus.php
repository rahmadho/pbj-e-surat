<?php
try {
	$id = _get('id');
	$sql = $koneksi->prepare("DELETE FROM ref_klasifikasi WHERE id=?");
	$sql->bind_param("i", $id);
	$sql->execute();
	swal("success", "Selamat!", "Data Berhasil Dihapus!", "?page=klasifikasi");
} catch (\Throwable $th) {
	swal("error", "Oops!", "Gagal Menghapus Data", "?page=klasifikasi");
}