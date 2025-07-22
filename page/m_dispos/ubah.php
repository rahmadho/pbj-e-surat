<?php

    $id=$_GET['id'];
    $sql = $koneksi->query("select * from m_dispos where id_dispos='$id'");
    $data = $sql->fetch_assoc();

?>
<div class="box box-success box-solid">
    <div class="box-header with-border">
		Ubah Data Bagian
 </div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <form method="POST" enctype="multipart/form-data" >
                                        
                                        <div class="form-group">
                                            <label>Nama Bagian</label>
                                            <input class="form-control" name="nama" value="<?php echo $data['nama_bagian'] ?>" />

                                        </div>

                                       

                                        	<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                                        </div>
                                 </div>

                                 </form>
                              </div>
 </div>
 
 


 <?php

 	$nama = $_POST['nama'];
 	

 	$simpan = $_POST['simpan'];


 	if ($simpan) {
        



 		$sql = $koneksi->query("update m_dispos set nama_bagian='$nama' where id_dispos='$id'");


    if ($sql) {
      echo "

          <script>
              setTimeout(function() {
                  swal({
                      title: 'Selamat!',
                      text: 'Data Berhasil Diubah!',
                      type: 'success'
                  }, function() {
                      window.location = '?page=m_dispos';
                  });
              }, 300);
          </script>

      ";
    

 	}

     }

 ?>
