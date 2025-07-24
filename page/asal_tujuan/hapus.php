<?php
try {
	$id = _get('id');
	$sql = $koneksi->prepare("delete from tb_asal_tujuan where id_asal_tujuan=?");
	$sql->bind_param("i", $id);
	$sql->execute();
	swal("success", "Berhasil!", "Data berhasil dihapus!", "?page=asal_tujuan");
} catch (\Throwable $th) {
	swal("error", "Oops!", "Data gagal dihapus!".$th->getMessage(), "?page=asal_tujuan");
}
