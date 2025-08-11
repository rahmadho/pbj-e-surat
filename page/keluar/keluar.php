<div class="row">
  <div class="col-md-12">
    <!-- Advanced Tables -->
    <div class="box box-success box-solid">
      <div class="box-header with-border">
        Data Surat Keluar
      </div>
      <div class="panel-body">
        <div class="table-responsive">
          <a href="?page=keluar&aksi=tambah" style="margin-bottom: 8px; margin-left: 5px;" class="btn btn-success"> <i
              class="fa fa-plus"></i> Tambah</a>
          <!-- <a id="lap_masuk" data-toggle="modal" data-target="#lap" style="margin-bottom: 8px; margin-left: 5px;"
            class="btn btn-default"><i class="fa fa-print"></i> Cetak PDF</a>
          <input type=button value=Kembali onclick=self.history.back() style="margin-bottom: 8px; margin-left: 5px;"
            class="btn btn-info" /> -->
          <table class="table table-striped table-bordered table-hover" data-datatable="true">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode Surat</th>
                <th>No Surat</th>
                <th>No Agenda</th>
                <th>Tanggal Surat </th>
                <th>Tujuan Surat</th>
                <th>Sifat Surat</th>
                <th>Perihal</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;

              $base_sql = "SELECT t1.*, t2.kode, t2.nama, t3.asal_tujuan 
                  from tb_surat_keluar as t1
                  left join ref_klasifikasi as t2 on t1.kode_surat=t2.id
                  left join tb_asal_tujuan as t3 on t1.kepada=t3.id_asal_tujuan";
              if (is_admin() || is_level(LEVEL_KABIRO)) {
                $sql = $koneksi->query($base_sql);
              } else {
                $tujuan = auth()->id;
                $dispos_user = $koneksi->query("SELECT id_dispos FROM m_dispos WHERE id_leader = $tujuan");
                $dispos_id = $dispos_user->fetch_object()?->id_dispos;
                $sql = $koneksi->query("$base_sql WHERE t1.created_by='$tujuan' OR dispos_id = $dispos_id");
              }
              while ($data = $sql->fetch_assoc()) {
                ?>
                <tr>
                  <td><?php echo $no++; ?></td>
                  <td><?php echo $data['kode'] ?></td>
                  <td><?php echo $data['no_surat'] ?></td>
                  <td><?php echo $data['no_agenda'] ?></td>
                  <td><?php echo date('d-m-Y', strtotime($data['tgl_surat'])) ?></td>
                  <td><?php echo $data['asal_tujuan'] ?></td>
                  <td><?php echo $data['sifat_surat'] ?></td>
                  <td><?php echo $data['perihal'] ?> <br> <a
                      href="page/keluar/file_surat.php?id=<?php echo $data['id']; ?>" target="blank">
                      <div style="color: green;"> [file: <?php echo $data['foto']; ?>]
                    </a>
                    <div>
                  </td>
                  <td>
                    <a href="?page=keluar&aksi=ubah&id=<?php echo $data['id']; ?>" class="btn btn-sm btn-info"> <i
                        class="fa fa-edit"></i> Ubah</a>
                    <a onclick="return confirm('Apakah Anda Yakin Akan Menghapus Data ini...???')"
                      href="?page=keluar&aksi=hapus&id=<?php echo $data['id']; ?>"" class=" btn btn-sm btn-danger"> <i
                        class="fa fa-trash"></i> Hapus</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if (is_admin()) { ?>
  <div class="modal fade" id="lap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Laporan Surat Keluar</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="POST" action="page/keluar/cetak.php" target="blank">

            <div class="form-group">
              <label>Dari Tanggal</label>
              <input class="form-control" type="date" data-datepicker name="tgl1" />
            </div>
            <div class="form-group">
              <label> Sampai Tanggal</label>
              <input class="form-control" type="date" data-datepicker name="tgl2" />
            </div>

            <div class="modal-footer">
              <button type="submit" name="cetak" class="btn btn-default" style="margin-top: 8px;"><i
                  class="fa fa-print"></i> Cetak per Periode</button>


            </div>
        </div>
        </form>

      </div>
    </div>

  </div>
<?php } else { ?>
  <div class="modal fade" id="lap" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title" id="myModalLabel">Laporan Surat Keluar</h4>
        </div>
        <div class="modal-body">
          <form role="form" method="POST" action="page/keluar/cetak_user.php" target="blank">

            <div class="form-group">
              <label>Dari Tanggal</label>
              <input class="form-control" type="date" data-datepicker name="tgl1" />
            </div>
            <div class="form-group">
              <label> Sampai Tanggal</label>
              <input class="form-control" type="date" data-datepicker name="tgl2" />
            </div>
            <input class="form-control" type="hidden" name="tujuan" value="<?php echo $tujuan ?>" />

            <div class="modal-footer">
              <button type="submit" name="cetak" class="btn btn-default" style="margin-top: 8px;"><i
                  class="fa fa-print"></i> Cetak per Periode</button>


            </div>
        </div>
        </form>

      </div>
    </div>

  </div>
<?php } ?>