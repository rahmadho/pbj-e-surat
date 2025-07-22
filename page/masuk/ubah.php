<?php

    $id=$_GET['id'];
    $sql = $koneksi->query("select * from tb_surat_masuk where no_agenda='$id'");
    $data = $sql->fetch_assoc();

    $indeks = $data['indeks'];
    $tgl_surat = $data['tgl_surat'];
    $tanggal_terima = $data['tanggal_terima'];
    $kode_surat = $data['kode_surat'];
    $tujuan = $data['tujuan'];
    $asal_tujuan = $data['asal_surat'];

?>

<div class="box box-success box-solid">
  <div class="box-header with-border">
		Ubah Surat Masuk
 </div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <form method="POST" enctype="multipart/form-data" onsubmit="return validasi(this)" >


                                       <div class="form-group">
                                            <label>NO Agenda</label>
                                            <input class="form-control" name="agenda" value="<?php echo $data['no_agenda'] ?>"  readonly=""  />

                                        </div>

                                        <div class="form-group">

                                            <label>Sifat Surat :</label>
                                            <select class="form-control" name="sifat">

                                                   <option >--Pilih Sifat Surat--</option>
                                                   <option value="b" <?php if ($data['sifat_surat']=='b'){ echo "selected";} ?> >Biasa</option>
                                                    <option value="p" <?php if ($data['sifat_surat']=='p'){ echo "selected";} ?> >Penting</option>
                                                    <option value="sp" <?php if ($data['sifat_surat']=='sp'){ echo "selected";} ?> >Sangat Penting</option>
                                                   <option value="s" <?php if ($data['sifat_surat']=='s'){ echo "selected";} ?> >Segera </option>
                                                 
                                                       

                                            </select>
                                        </div>

                                        <div class="form-group">

                                            <label>Asal Surat :</label>
                                            <select class="form-control select2" name="asal">

                                           <?php
                                              $sql = $koneksi->query("select * from tb_asal_tujuan");
                                              while ($tampil_t=$sql->fetch_assoc()) {
                                                $pilih_t=($tampil_t['id_asal_tujuan']==$asal_tujuan?"selected":"");
                                                echo "

                                                  <option value='$tampil_t[id_asal_tujuan]'  $pilih_t>$tampil_t[asal_tujuan]</option>

                                                ";
                                              }
                                                     ?>
                                                   
                                                       

                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Nomor Surat</label>
                                            <input class="form-control" name="no" value="<?php echo $data['no_surat'] ?>"  />

                                        </div>

                                         <div class="form-group">
                                              <label>Perihal :</label>
                                              <textarea class="form-control" rows="3" name="perihal"><?php echo $data['perihal'] ?></textarea>
                                        </div>


                                        <div class="form-group">

                                            <label>Tujuan Surat :</label>
                                            <select class="form-control select2" name="tujuan">

                                           <?php
                                              $sql = $koneksi->query("select * from tb_tujuan");
                                              while ($tampil_t=$sql->fetch_assoc()) {
                                                $pilih_t=($tampil_t['id_tujuan']==$tujuan?"selected":"");
                                                echo "

                                                  <option value='$tampil_t[id_tujuan]'  $pilih_t>$tampil_t[nama_tujuan]</option>

                                                ";
                                              }
                                                     ?>
                                                   
                                                       

                                            </select>
                                        </div>


                                       

                                        


                                      </div>
                                      
                                       <div class="col-md-6">  

                                        

                                       <div class="form-group">




                                            <label>Kode Surat :</label>
                                            <select class="form-control select2" name="kode_surat">

                                           <?php
                                              $sql = $koneksi->query("select * from ref_klasifikasi");
                                              while ($tampil_t=$sql->fetch_assoc()) {

                                                $pilih_t=($tampil_t['id']==$kode_surat?"selected":"");

                                                echo "

                                                  <option value='$tampil_t[id]' $pilih_t>$tampil_t[kode] - $tampil_t[nama]</option>

                                                ";
                                              }
                                             ?>
                                                   
                                                       

                                            </select>
                                        </div>

                                         <div class="form-group">
                                            <label>Indeks Berkas </label>
                                            <input class="form-control" name="indek" required="" value="<?php echo $indeks ?>" />

                                        </div>

                                         <div class="form-group">
                                            <label>Tanggal Surat</label>
                                            <input type="date" class="form-control" name="tgl_surat" value="<?php echo $tgl_surat ?>"  />

                                        </div>

                                        <div class="form-group">
                                            <label>Tanggal Terima</label>
                                            <input type="date" class="form-control" name="tgl_terima" value="<?php echo $tanggal_terima?>" />

                                        </div>


                                        <div class="form-group">
                                            <label>File Surat (Format pdf)</label>
                                            <input type="file" name="foto" id="foto" />
                                        </div>


                                        <div>

                                        	<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                        </div>
                                 </div>

                                 </form>
                              </div>
 


 <?php

 	$no = $_POST ['no'];
  $tgl_surat = $_POST ['tgl_surat'];
  $tgl_terima = $_POST ['tgl_terima'];
  $asal = $_POST ['asal'];
  $sifat = $_POST ['sifat'];
  $perihal = $_POST ['perihal'];
  $agenda = $_POST ['agenda'];

   $tujuan = $_POST ['tujuan'];
  $kode_surat = $_POST ['kode_surat'];
  $indek = $_POST ['indek'];

    $foto = $_FILES['foto']['name'];
    $lokasi = $_FILES['foto']['tmp_name'];


 	$simpan = $_POST ['simpan'];


 	if ($simpan) {
        if (!empty($lokasi)) {

        $upload = move_uploaded_file($lokasi, "file/".$foto);

 		$sql = $koneksi->query("update  tb_surat_masuk set no_surat='$no', tgl_surat='$tgl_surat', tanggal_terima='$tgl_terima', asal_surat='$asal', sifat_surat='$sifat', perihal='$perihal', no_agenda='$agenda', file_surat='$foto', tujuan='$tujuan', kode_surat='$kode_surat', indeks='$indek' where no_agenda='$id'");


 			if ($sql) {
          echo "

              <script>
                  setTimeout(function() {
                      swal({
                          title: 'Selamat!',
                          text: 'Data Berhasil Diubah!',
                          type: 'success'
                      }, function() {
                          window.location = '?page=masuk';
                      });
                  }, 300);
              </script>

          ";
        }

 	}else{
        $sql = $koneksi->query("update  tb_surat_masuk set no_surat='$no', tgl_surat='$tgl_surat', tanggal_terima='$tgl_terima', asal_surat='$asal', sifat_surat='$sifat', perihal='$perihal', tujuan='$tujuan', kode_surat='$kode_surat', indeks='$indek' where no_agenda='$id'");


        if ($sql) {
          echo "

              <script>
                  setTimeout(function() {
                      swal({
                          title: 'Selamat!',
                          text: 'Data Berhasil Diubah!',
                          type: 'success'
                      }, function() {
                          window.location = '?page=masuk';
                      });
                  }, 300);
              </script>

          ";
        }
    }

     }

 ?>
