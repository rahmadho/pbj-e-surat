<?php

	$id = $_GET['id'];

	$sql = $koneksi->query("delete from ref_klasifikasi where id='$id'");

	?>
		<script>
		    setTimeout(function() {
		        sweetAlert({
		            title: 'OKE!',
		            text: 'Data Berhasil Dihapus!',
		            type: 'error'
		        }, function() {
		            window.location = '?page=klasifikasi';
		        });
		    }, 300);
		</script>


	<?php

 ?>
