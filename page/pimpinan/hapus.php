<?php

	$id = $_GET['id'];

	$sql = $koneksi->query("delete from tb_tujuan where id_tujuan='$id'");

	?>
		<script>
		    setTimeout(function() {
		        sweetAlert({
		            title: 'OKE!',
		            text: 'Data Berhasil Dihapus!',
		            type: 'error'
		        }, function() {
		            window.location = '?page=pimpinan';
		        });
		    }, 300);
		</script>


	<?php

 ?>
