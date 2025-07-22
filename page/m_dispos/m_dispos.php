

<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="box box-success box-solid">
                        <div class="box-header with-border">
                             Data Bagian
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">

                                 <a href="?page=m_dispos&aksi=tambah" class="btn btn-success" style="margin-bottom: 8px;"><i class="fa fa-plus"></i> Tambah </a>

                                <table class="table table-striped table-bordered table-hover" id="example1">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                           
                                            <th>Nama Bagian</th>
                                            <th>Aksi</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php

                                            $no = 1;

                                            $sql = $koneksi->query("select * from m_dispos ");

                                            while ($data= $sql->fetch_assoc()) {





                                        ?>

                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $data['nama_bagian'];?></td>
                                           

                                             <td>
                                                <a href="?page=m_dispos&aksi=ubah&id=<?php echo $data['id_dispos']; ?>" class="btn btn-info" ><i class="fa fa-edit"></i> Ubah</a>
                                                <a onclick="return confirm('Anda Yakin Akan Mengahapus Data Ini ... ???')" href="?page=m_dispos&aksi=hapus&id=<?php echo $data['id_dispos']; ?>" class="btn btn-danger" ><i class="fa fa-trash"></i> Hapus</a>

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
