
<div class="row">
                <div class="col-md-12">
                    <!-- Advanced Tables -->
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                             Data Transaksi
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" data-datatable="true">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tanggal Transaksi </th>
                  <th>Jenis</th>
                  <th>Catatan</th>
                  <th>Kasir</th>
                  <th>Masuk</th>
                  <th>Keluar</th>
                </tr>
                </thead>
                <tbody>
                  <?php
                      $no = 1;
                      $sql = $koneksi->query("select * from tb_transaksi, tb_user
                                              where  tb_transaksi.kode_user= tb_user.id");
                      while ($data=$sql->fetch_assoc()) {
                   ?>
                  <tr>
                   <td><?php echo $no++; ?></td>
                   <td><?php echo tgl_indo($data['tanggal_transaksi']) ?></td>
                   <td><?php echo $data['keterangan'] ?></td>
                   <td><?php echo $data['catatan'] ?></td>
                   <td><?php echo $data['nama_user'] ?></td>
                   <td align="right"><?php echo number_format ($data['nominal']).',-' ?></td>
                   <td align="right"><?php echo number_format ($data['keluar']).',-' ?></td>
                 </tr>
                 <?php
                  	$total_masuk=$total_masuk+$data['nominal'];
                  	$total_keluar=$total_keluar+$data['keluar'];
                  	$total_saldo=$total_masuk-$total_keluar;
              		}
                  ?>
                  </tbody>
                  	<tr>
                    <th style="text-align: right; font-size: 14px;" colspan="5">Total  Masuk</th>
                    <td  align="right"  style="font-size: 14px;"><b>Rp.<?php echo number_format($total_masuk) ; ?>,-</b></td>
                  	</tr>
                  	<tr>
                    <th style="text-align: right; font-size: 14px;" colspan="5">Total  Keluar</th>
                    <td  align="right" style="font-size: 14px;"><b>Rp.&nbsp&nbsp&nbsp<?php echo number_format($total_keluar) ; ?>,-</b></td>
                  	</tr>
                  	<tr>
                    <th style="text-align: right; font-size: 14px;" colspan="5">Saldo Akhir</th>
                    <td colspan="6" style="font-size: 14px;"><b>Rp.<?php echo number_format($total_saldo) ; ?>,-</b></td>
                  	</tr>
                </tbody>
              </table>
            </div>
        <a href="?page=transaksi&aksi=tambah" class="btn btn-primary"> <i class="fa fa-plus"></i> Tambah</a>
        <a href="page/transaksi/cetak_pdf.php" class="btn btn-default" target="blank" style="margin-top: 8px; margin-left: 5px;"><i class="fa fa-print"></i> Cetak PDF</a>
