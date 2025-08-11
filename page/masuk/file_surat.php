<?php
include "../../includes.php";
$id = $_GET['id'];
$sql = $koneksi->query("select * from  tb_surat_masuk WHERE id='$id'");
$data = $sql->fetch_object();
?>
<iframe style="float:right;" src="../../file/<?php echo $data->file_surat; ?>" width='100%' height='100%' allowfullscreen
    webkitallowfullscreen></iframe>