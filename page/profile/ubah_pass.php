
<div class="row">
    <div class="col-md-6">
        <!-- Form Elements -->
       <div class="box box-success box-solid">
              <div class="box-header with-border">
                Ubah Password
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <form role="form" method="POST">

                        	
                            <div class="form-group">
                                <label>Password Lama :</label>
                                <input type="password" class="form-control" name="plama" placeholder="Password Lama" />
                            </div>

                             <div class="form-group">
                                <label>Password Baru :</label>
                                <input type="password" class="form-control" name="pbaru" placeholder="Password Baru"  />
                            </div>

                             <input type="submit" name="simpan" value="Update" class="btn btn-success">
			                <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
                        </form>
                        </div>
                         </div>
                          </div>
                           </div>

<?php 

	if (isset($_POST['simpan'])) {

		$id= $_GET['id'];
		
		$plama = $_POST['plama'];
		$pbaru = $_POST['pbaru'];
		

		$cek = $koneksi->query("select * from tb_user where id='$id' and password='$plama'");
			$ketemu = $cek->num_rows;
			if ($ketemu==0) {
				echo "<script>
						    setTimeout(function() {
						        sweetAlert({
						            title: 'Perhatian!',
						            text: 'Password Lama Salah',
						            type: 'error'
						        }, function() {
						            window.location = '?page=profile&aksi=ubahpass&id=$id';
						        });
						    }, 300);
						</script>";
					}else{
		


		$simpan = $koneksi->query("update tb_user set password='$pbaru' where id='$id'");


		if ($simpan) {
			echo "

					<script>
					    setTimeout(function() {
					        swal({
					            title: 'Selamat!',
					            text: 'Ubah Password berhasil!',
					            type: 'success'
					        }, function() {
					            window.location = '?page=profile';
					        });
					    }, 300);
					</script>

			";
		}

	}
	}

 ?>
                            