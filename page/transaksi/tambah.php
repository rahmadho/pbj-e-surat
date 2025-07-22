<?php

    $tanggal_transaksi =date("d F Y");

 ?>

 <?php
         if($_SESSION['admin']){
              $user_l=$_SESSION['admin'];

         }elseif ($_SESSION['user']) {
              $user_l=$_SESSION['user'];
         }

         $sql_u = $koneksi->query("select* from tb_user where id='$user_l'");
         $data_u = $sql_u->fetch_assoc();

         $user = $data_u['id'];
?>

<div class="panel panel-primary">
<div class="panel-heading">
		Tambah Data transaksi
 </div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <form method="POST" >


                                       <div class="form-group">
                                          <label>Tanggal Transaksi </label>
                                          <input type="text" class="form-control" value="<?php echo $tanggal_transaksi;?>" name="tgl" readonly />
                                      </div>

                                        <div class="form-group">
                                            <label>Nominal</label>
                                            <input type="number" class="form-control" name="nominal"  />

                                        </div>

                                        <div class="form-group">
                                              <label>Catatan :</label>
                                              <textarea class="form-control" rows="3" name="catatan"></textarea>
                                        </div>

                                        <div>

                                        	<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                        </div>
                                 </div>

                                 </form>
                              </div>
 </div>
 </div>
 </div>


 <?php

 	$tgl = getTanggalSql($_POST ['tgl']);
 	$nominal = $_POST ['nominal'];
 	$catatan = $_POST ['catatan'];
  $user_l = $user;



 	$simpan = $_POST ['simpan'];


 	if ($simpan) {




 		$sql = $koneksi->query("insert into tb_transaksi (keterangan, kode_user, tanggal_transaksi, nominal, keluar, catatan)
                      values('Pengeluaran', '$user_l', '$tgl', 0, '$nominal', '$catatan')");


    if ($sql) {
      echo "

          <script>
              setTimeout(function() {
                  swal({
                      title: 'Selamat!',
                      text: 'Data Berhasil Disimpan!',
                      type: 'success'
                  }, function() {
                      window.location = '?page=transaksi';
                  });
              }, 300);
          </script>

      ";
    }



     }

 ?>
