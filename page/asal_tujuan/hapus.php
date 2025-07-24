<?php
	$id = $_GET['id'];
	$sql = $koneksi->query("delete from tb_asal_tujuan where id_asal_tujuan='$id'");
	?>
		<script>
		    setTimeout(function() {
		        sweetAlert({
		            title: 'OKE!',
		            text: 'Data Berhasil Dihapus!',
		            type: 'error'
		        }, function() {
		            window.location = '?page=asal_tujuan';
		        });
		    }, 300);
		</script>
	<?php
 ?>
