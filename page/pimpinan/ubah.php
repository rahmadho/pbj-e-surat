<?php

    $id=$_GET['id'];
    $sql = $koneksi->query("select * from tb_tujuan where id_tujuan='$id'");
    $data = $sql->fetch_assoc();

?>
<div class="box box-success box-solid">
    <div class="box-header with-border">
		Ubah Data Pimpinan
 </div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <form method="POST" enctype="multipart/form-data" >
                                        
                                        <div class="form-group">
                                            <label>Nama Pimpinan</label>
                                            <input class="form-control" name="nama" value="<?php echo $data['nama_tujuan'] ?>" />

                                        </div>

                                        <div class="form-group">
                                            <label>Nama HP (62 Pengganti 0 Contoh 6285609876543)</label>
                                            <input class="form-control" name="no_hp" required="" value="<?php echo $data['no_hp'] ?>" />

                                        </div>

                                       

                                        	<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                                        </div>
                                 </div>

                                 </form>
                              </div>
 </div>
 
 


 <?php

 $nama = $_POST['nama'];
  $no_hp = $_POST['no_hp'];
 	

 	$simpan = $_POST['simpan'];


 	if ($simpan) {
        



 		$sql = $koneksi->query("update tb_tujuan set nama_tujuan='$nama', no_hp='$no_hp' where id_tujuan='$id'");


    if ($sql) {
      echo "

          <script>
              setTimeout(function() {
                  swal({
                      title: 'Selamat!',
                      text: 'Data Berhasil Diubah!',
                      type: 'success'
                  }, function() {
                      window.location = '?page=pimpinan';
                  });
              }, 300);
          </script>

      ";
    

 	}

     }

 ?>
