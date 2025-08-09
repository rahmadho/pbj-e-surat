<?php
$id = (int) _get('id');
try {
	$sql = $koneksi->query("delete from tb_tujuan where id_tujuan='$id'");
	swal('success', 'Selamat!', 'Data berhasil dihapus!', '?page=pimpinan');
} catch (\Throwable $th) {
	swal('error', 'Oops!', 'Data gagal dihapus!', '?page=pimpinan');
}
