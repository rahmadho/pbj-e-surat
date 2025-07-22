<?php 

	$id = $_GET['id'];

	$sql = $koneksi->query("select * from tb_surat_masuk where id='$id'");
	$data = $sql->fetch_assoc();


 ?>
    <!-- Content Header (Page header) -->

    <section class="content-header">
      <h1>
        Detail
        <small>Surat Masuk</small>
      </h1>
      
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
        </div>
        <table style="margin-left: 12px;" width="600" >
          <tr>
            <td>Nomor Surat</td>
            <td width="22">:</td>
            <td><?php echo $data['no_surat']; ?></td>

            <td>Tanggal Surat</td>
            <td width="22">:</td>
            <td><?php echo date('d F Y', strtotime( $data['tgl_surat'])); ?></td>
          </tr>

          <tr>
            <td>Perihal</td>
            <td>:</td>
            <td><?php echo $data['perihal']; ?></td>

            <td>Tanggal Terima</td>
            <td>:</td>
            <td><?php echo date('d F Y', strtotime( $data['tanggal_terima'])); ?></td>
          </tr>

          <tr>
            <td>Asal Surat</td>
            <td>:</td>
            <td><?php echo $data['asal_surat']; ?></td>

            <td>Sifat Surat</td>
            <td>:</td>
            <td><?php 

                if($data['sifat_surat']=="p"){
                   echo "Penting";
                  }else if($data['sifat_surat']=="sp"){
                   echo "Sangat Penting";
                  }else if($data['sifat_surat']=="b"){
                   echo "Biasa";
                  }else{
                   echo "Segera";
                  }﻿
             ?></td>
          </tr>

           <tr>
            <td>No Agenda</td>
            <td>:</td>
            <td><?php echo $data['no_agenda']; ?></td>
          </tr>
          <tr>
            <td>File Surat</td>
            <td>:</td>
            <td><a href="page/masuk/file_surat.php?id=<?php echo $id; ?>" target="blank"> <img src="images/pdf.png" width="100" height="100" title="Lihat Surat" alt=""></a></td>

            <td>Disposisi</td>
            <td>:</td>
            <td>
              <?php if ($data['status']==0) {
              echo "Belum";
              }else{
                echo "Sudah";
              } 

            ?>
              
            </td>
          </tr>
        </table>

         <div class="box-body">
          



            echo "<a href='?page=masuk&aksi=disposisi&id=$id' class=' btn btn-success'>  <i class='fa fa-table'></i> Disposisi</a>";

         


          ?>

          <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />
          
        </div>


   



