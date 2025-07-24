
<div class="box box-success box-solid">
    <div class="box-header with-border">
		Tambah Data Bagian
 </div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <form method="POST" enctype="multipart/form-data" >
                                        
                                        <div class="form-group">
                                            <label>Nama Bagian</label>
                                            <input class="form-control" name="nama" id="nama" />
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
        
 		$sql = $koneksi->query("insert into m_dispos (nama_bagian)values('$nama')");
    if ($sql) {
      echo "
          <script>
              setTimeout(function() {
                  swal({
                      title: 'Selamat!',
                      text: 'Data Berhasil Disimpan!',
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
