<script type="text/javascript">
    function validasi(form){
        if (form.catatan.value=="") {
            alert("Catatan Surat Tidak Boleh Kosong");
            form.catatan.focus();
            return(false);
        }
        return(true);
    }
</script>

<?php

    $id=$_GET['id'];
    $sql = $koneksi->query("select * from tb_surat_masuk where no_agenda='$id'");
    $data = $sql->fetch_assoc();

    $tgl_surat = $data['tgl_surat'];
    $tgl_terima= $data['tanggal_terima'];
    $asal = $data['asal_surat'];
    $sifat = $data['sifat_surat'];
    $perihal = $data['perihal'];
    $agenda = $data['no_agenda'];
    $kode_surat = $data['kode_surat'];
    $indeks = $data['indeks'];
    $tujuan = $data['tujuan'];

?>

<div class="box box-success box-solid">
  <div class="box-header with-border">
	Disposisi Surat Masuk
 </div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)" >
                                        
                                        <div class="form-group">
                                            <label>Nomor Surat</label>
                                            <input class="form-control" name="no" value="<?php echo $data['no_surat'] ?>" readonly=""  />

                                        </div>

                                        <div class="form-group">
                                            <label>Perihal Surat</label>
                                            <input class="form-control" name="perihal" value="<?php echo $data['perihal'] ?>" readonly=""  />

                                        </div>

                                        <div class="form-group">

                                            <label>Diteruskan :</label>
                                            <select class="form-control" name="terus">

                                                   <?php
                                                      $sql = $koneksi->query("select * from m_dispos");
                                                      while ($data=$sql->fetch_assoc()) {
                                                        echo "

                                                          <option value='$data[id_dispos]'>$data[nama_bagian]</option>

                                                        ";
                                                      }
                                                     ?>
                                                   
                                                       

                                            </select>
                                        </div>

                                        

                                        <div class="form-group">
                                              <label>Catatan :</label>
                                              <textarea class="form-control" rows="3" name="ket" id="catatan"></textarea>
                                        </div>

                                        <div class="form-group">

                                            <label>Sifat :</label>
                                            <select class="form-control" id="sifat" name="sifat_dispos">

                                                   
                                                    <option value="Biasa">Biasa</option>
                                                   <option value="Penting">Penting</option>
                                                   <option value="Sangat Penting">Sangat Penting</option>
                                                   <option value="Segera">Segera</option>
                                                       

                                            </select>
                                        </div>

                                         <div class="form-group">
                                            <label>Batas Waktu</label>
                                            <input type="date" class="form-control" name="batas"  />

                                        </div>

                                      

                                        <div>

                                        	<input type="submit" name="simpan" value="Simpan" class="btn btn-success">
                                          <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
                                        </div>
                                 </div>

                                 </form>
                              </div>
 


 <?php

 	$no = $_POST ['no'];
 	$terus = $_POST ['terus'];
 	$ket = $_POST ['ket'];
  $sifat_dispos = $_POST ['sifat_dispos'];
  $batas = $_POST ['batas'];

    


 	$simpan = $_POST ['simpan'];


 	if ($simpan) {
        

 		$sql = $koneksi->query("insert into tb_disposisi (no_surat, tgl_surat, tanggal_terima, asal_surat, sifat_surat, perihal, no_agenda, teruskan, ket, sifat_dispos, batas, indeks, kode_surat, tujuan)values('$no', '$tgl_surat', '$tgl_terima', '$asal', '$sifat', '$perihal', '$agenda', '$terus', '$ket', '$sifat_dispos', '$batas', '$indeks', '$kode_surat', '$tujuan')");

    $sql = $koneksi->query("update tb_surat_masuk set status=1, disposisi='$terus' where no_agenda = '$agenda'");


 			if ($sql) {
      echo "

          <script>
              setTimeout(function() {
                  swal({
                      title: 'Selamat!',
                      text: 'Disposisi Berhasil !',
                      type: 'success'
                  }, function() {
                      window.location = '?page=disposisi';
                  });
              }, 300);
          </script>

      ";
    }

     }

 ?>
