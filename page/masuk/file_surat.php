<?php
include "../../koneksi/koneksi.php";
$id = $_GET['id'];
$sql = $koneksi->query("select * from  tb_surat_masuk WHERE id='$id'");
$data = $sql->fetch_assoc();
$fl = $data['file_surat'];
?>
<iframe style="float:right;" src="../../file/<?php echo $fl; ?>" width='1350' height='1200' allowfullscreen
    webkitallowfullscreen></iframe>