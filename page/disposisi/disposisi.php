
<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                             Data Disposisi
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="example1">
                <thead>
                <tr>

                   <tr>
                      <th>No</th>
                      <th>No Surat</th>
                      <th>Tanggal Surat</th>
                      <th>Tanggal Terima</th>
                      <th>Asal</th>
                      <th>Sifat</th>
                      <th>Perihal</th>
                      <th>Diteruskan</th>   
                      <th>Catatan</th>      
                      <th>Aksi</th>
                  </tr>
                </tr>
                </thead>


                <tbody>

                  <?php
                       $no = 1;

                              $sql = $koneksi->query("select * from tb_disposisi, m_dispos where tb_disposisi.teruskan=m_dispos.id_dispos ");

                              while ($data= $sql->fetch_assoc()) {



                   ?>

                  <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $data['no_surat'];?></td>
                          <td><?php echo date('d F Y', strtotime( $data['tgl_surat']));?></td>
                          <td><?php echo date('d F Y', strtotime( $data['tanggal_terima']));?></td>
                          <td><?php echo $data['asal_surat'];?></td>
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
                          <td><?php echo $data['perihal'];?></td>
                          <td><?php echo $data['nama_bagian'];?></td>
                          <td><?php echo $data['ket'];?></td>
                         
                           <td>
                              <a href="page/disposisi/cetak.php?id=<?php echo $data['id']; ?>" target="blank" class="btn btn-info btn-xs" ><i class="fa fa-print "></i> Cetak Disposisi</a>
                              
                          </td>
                      </tr>

                 <?php } ?>
                </tbody>

              </table>
            </div>


       <a id="lap_masuk" data-toggle="modal" data-target="#lap" style="margin-bottom:  px; margin-left: 5px;" class="btn btn-default"><i class="fa fa-print"></i> Cetak PDF</a>
        <input type=button value=Kembali onclick=self.history.back() class="btn btn-info" />

        <div class="modal fade" id="lap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Laporan Disposisi</h4>
                                        </div>

                                        <div class="modal-body">
                                          <form role="form" method="POST" action="page/disposisi/laporan_disposisi.php" target="blank" >

                                            
                                            <div class="form-group">
                                                <label>Dari Tanggal</label>
                                                <input class="form-control" type="date" name="tgl1" /> 
                                            </div>

                                             <div class="form-group">
                                                <label> Sampai Tanggal</label>
                                                <input class="form-control" type="date" name="tgl2" /> 
                                            </div>

                                           

                                            <div class="modal-footer">

                                           <button type="submit" name="cetak" class="btn btn-default" style="margin-top: 8px;"><i class="fa fa-print"></i> Cetak per Periode</button>
                                            
                                            <a href="page/disposisi/laporan_disposisi.php" class="btn btn-default" target="blank" style="margin-top: 8px; margin-left: 5px;"><i class="fa fa-print"></i> Cetak Semua</a>//

                                            

                                            
                                            </div>
                                            </div>  
                                      
                                        
                                        </form> 


    
                                    </div>
                                </div>
                           
                    </div>

        
