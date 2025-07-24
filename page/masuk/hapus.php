<?php
	$ambil = $koneksi->query("select * from tb_surat_masuk where no_agenda='$_GET[id]'");
	$data = $ambil->fetch_assoc();
	$pdf=$data['foto'];
	if (file_exists("file/$pdf")) {
		unlink("file/$pdf");
	}
	$koneksi->query("delete from tb_surat_masuk where no_agenda='$_GET[id]'");
  $koneksi->query("delete from tb_disposisi where no_agenda='$_GET[id]'");
?>
  <script>
      setTimeout(function() {
          sweetAlert({
              title: 'OKE!',
              text: 'Data Berhasil Dihapus!',
              type: 'error'
          }, function() {
              window.location = '?page=masuk';
          });
      }, 300);
  </script>
<?php
?>
