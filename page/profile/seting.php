<?php

   
    $sql = $koneksi->query("select * from tb_profile");
    $data = $sql->fetch_assoc();

?>

<div class="panel panel-primary">
<div class="panel-heading">
		Ubah Profile
 </div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)" >
                                        <div class="form-group">
                                            <label>Kota</label>
                                            <input class="form-control" name="kota" value="<?php echo $data['kota'];?>" />

                                        </div>

                                       <div class="form-group">
	                                            <label>Nama Lembaga</label>
	                                            <textarea class="form-control" rows="3" name="lembaga" ><?php echo $data['lembaga'] ?></textarea>
	                                        </div>

                                       <div class="form-group">
	                                            <label>Alamat</label>
	                                            <textarea class="form-control" rows="3" name="alamat" ><?php echo $data['alamat'] ?></textarea>
	                                        </div>

                                        <div class="form-group">
                                            <label>Telpon</label>
                                            <input class="form-control" name="telp"  id="pass" value="<?php echo $data['telpon'];?>" />

                                        </div>

                                        <div class="form-group">
                                            <label>Foto</label>
                                            <label><img src='images/<?php echo $data['foto'];?>' width="100" height="75"></label>

                                        </div>

                                        <div class="form-group">
                                            <label>Ganti Foto</label>
                                            <input type="file" name="foto" id="foto" />
                                        </div>


                                        <div>

                                        	<input type="submit" name="simpan" value="Ubah" class="btn btn-primary">
                                        </div>
                                 </div>

                                 </form>
                              </div>
 


 <?php

 	$kota = $_POST ['kota'];
 	$lembaga = $_POST ['lembaga'];
 	$alamat = $_POST ['alamat'];
 	$telp = $_POST ['telp'];

    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];


 	$simpan = $_POST ['simpan'];


 	if ($simpan) {
        if (!empty($lokasi)) {

        $upload = move_uploaded_file($lokasi, "images/".$foto);

 		$sql = $koneksi->query("update  tb_profile set kota='$kota', lembaga='$lembaga', alamat='$alamat', telpon='$telp', foto='$foto'");


    if ($sql) {
      ?>
        <script type="text/javascript">

          alert ("Data Berhasil Diubah");
          window.location.href="?page=profile&aksi=seting";

        </script>
      <?php
    }

 	}else{
      $sql = $koneksi->query("update  tb_profile set kota='$kota', lembaga='$lembaga', alamat='$alamat', telpon='$telp'");

        if ($sql) {
          ?>
            <script type="text/javascript">

              alert ("Data Berhasil Diubah");
              window.location.href="?page=profile&aksi=seting";

            </script>
          <?php
        }
    }

     }

 ?>
