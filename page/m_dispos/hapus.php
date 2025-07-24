<?php
	$id = $_GET['id'];
	$sql = $koneksi->query("delete from m_dispos where id_dispos='$id'");
	?>
		<script>
		    setTimeout(function() {
		        sweetAlert({
		            title: 'OKE!',
		            text: 'Data Berhasil Dihapus!',
		            type: 'error'
		        }, function() {
		            window.location = '?page=m_dispos';
		        });
		    }, 300);
		</script>
	<?php
 ?>
