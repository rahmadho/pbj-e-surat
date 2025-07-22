
<div class="box box-success box-solid">
    <div class="box-header with-border">
		Tambah Klasifikasi Surat
 </div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <form method="POST" enctype="multipart/form-data" >

                                       <div class="form-group">
                                            <label>Kode </label>
                                            <input class="form-control" name="kode"  />

                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Nama </label>
                                            <input class="form-control" name="nama" id="nama" />

                                        </div>


                                        <div class="form-group">
                                              <label>Uraian :</label>
                                              <textarea class="form-control" rows="3" name="uraian"></textarea>
                                        </div>

                                       

                                        	<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                                        </div>
                                 </div>

                                 </form>
                              </div>
 </div>
 
 


 <?php

 	$nama = $_POST['nama'];
  $kode = $_POST['kode'];
  $uraian = $_POST['uraian'];
 	

 	$simpan = $_POST['simpan'];


 	if ($simpan) {
        



 		$sql = $koneksi->query("insert into ref_klasifikasi (kode, nama, uraian)values('$kode', '$nama', '$uraian')");


    if ($sql) {
      echo "

          <script>
              setTimeout(function() {
                  swal({
                      title: 'Selamat!',
                      text: 'Data Berhasil Disimpan!',
                      type: 'success'
                  }, function() {
                      window.location = '?page=klasifikasi';
                  });
              }, 300);
          </script>

      ";
    

 	}

     }

 ?>
