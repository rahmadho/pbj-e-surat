<?php
	$id = $_GET['id'];
	$sql = $koneksi->query("delete from tb_surat_keluar where no_agenda='$id'");
	?>
		<script>
		    setTimeout(function() {
		        sweetAlert({
		            title: 'OKE!',
		            text: 'Data Berhasil Dihapus!',
		            type: 'error'
		        }, function() {
		            window.location = '?page=keluar';
		        });
		    }, 300);
		</script>
	<?php
 ?>
