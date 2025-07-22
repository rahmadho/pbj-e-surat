

<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                             Data Asal/Tujuan Surat
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                 <a href="?page=asal_tujuan&aksi=tambah" class="btn btn-success" style="margin-bottom: 8px;"><i class="fa fa-plus"></i> Tambah </a>

                                <table class="table table-striped table-bordered table-hover" id="example1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                           
                                            <th>Nama Asal/Tujuan Surat</th>
                                            <th>Aksi</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi->query("select * from tb_asal_tujuan ");

                                            while ($data= $sql->fetch_assoc()) {





                                        ?>

                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data['asal_tujuan'];?></td>
                                           

                                             <td>
                                                <a href="?page=asal_tujuan&aksi=ubah&id=<?php echo $data['id_asal_tujuan']; ?>" class="btn btn-info" ><i class="fa fa-edit"></i> Ubah</a>
                                                <a onclick="return confirm('Anda Yakin Akan Mengahapus Data Ini ... ???')" href="?page=asal_tujuan&aksi=hapus&id=<?php echo $data['id_asal_tujuan']; ?>" class="btn btn-danger" ><i class="fa fa-trash"></i> Hapus</a>

                                            </td>
                                        </tr>


                                        <?php  } ?>
                                    </tbody>

                                    </table>
                                  </div>

                                 


                        </div>
                     </div>
                   </div>
     </div>
