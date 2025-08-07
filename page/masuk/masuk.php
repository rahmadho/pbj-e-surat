<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                Data Surat Masuk
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <?php if (is_admin()) { ?>
                        <a href="?page=masuk&aksi=tambah" class="btn btn-success" style="margin-bottom: 10px;"><i
                                class="fa fa-plus"></i> Tambah </a>
                    <?php } ?>
                    <!-- <a id="lap_masuk" data-toggle="modal" data-target="#lap" style="margin-bottom: 10px;; margin-left: 5px;" class="btn btn-default"><i class="fa fa-print"></i> Cetak PDF</a> -->
                    <!-- <input style="margin-bottom: 10px;; margin-left: 5px;" type=button value=Kembali onclick=self.history.back() class="btn btn-info" /> -->
                    <table class="table table-striped table-bordered table-hover" data-datatable="true">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No.Reg/Kode</th>
                                <th>Asal Surat</th>
                                <th>Perihal, File</th>
                                <th>Nomor, Tanggal Surat</th>
                                <th>Disposisi</th>
                                <th>Sifat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $filter = "";

                            $base_sql = "SELECT t1.id, t1.no_agenda, t1.no_surat, t1.tgl_surat, t1.tanggal_terima, t1.sifat_surat, t1.perihal, t1.indeks, t1.status, t1.disposisi, t1.file_surat,
                                t2.no_hp, t2.nama_tujuan, t3.kode, t4.asal_tujuan
                                FROM tb_surat_masuk as t1 
                                LEFT JOIN tb_tujuan as t2 ON t1.tujuan=t2.id_tujuan
                                LEFT JOIN ref_klasifikasi as t3 ON t1.kode_surat=t3.id
                                LEFT JOIN tb_asal_tujuan as t4 ON t1.asal_surat=t4.id_asal_tujuan 
                                LEFT JOIN tb_disposisi as t5 ON t5.id=t1.disposisi";

                            if (!is_admin() && !is_level(LEVEL_KABIRO)) {
                                $id_user = auth()->id;
                                $filter = "WHERE exists (SELECT 1 FROM tb_disposisi JOIN m_dispos ON tb_disposisi.disposisi_ke=m_dispos.id_dispos WHERE m_dispos.id_leader=$id_user AND tb_disposisi.id_surat_masuk=t1.id)";
                            }
                            $sql = $koneksi->query("$base_sql $filter ORDER BY t1.id DESC");
                            while ($data = $sql->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo $data['no_agenda']; ?> / <?php echo $data['kode']; ?></td>
                                    <td><?php echo $data['asal_tujuan']; ?> <br>
                                        <div style="color: red;"> [index: <?php echo $data['indeks']; ?>]<div>
                                    </td>
                                    <td><?php echo $data['perihal']; ?> <br> <a
                                            href="page/masuk/file_surat.php?id=<?php echo $data['id']; ?>"
                                            target="blank">
                                            <div style="color: green;"> [file: <?php echo $data['file_surat']; ?>]
                                        </a>
                                        <div>
                                    </td>
                                    <td><?php echo $data['no_surat']; ?><br><?php echo date('d-m-Y', strtotime($data['tgl_surat'])); ?>
                                    </td>
                                    <td>
                                        <?php if ($data['status'] == 0) {
                                            echo "Belum";
                                        } else {
                                            echo "Sudah";
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo sifat_surat($data['sifat_surat']); ?></td>
                                    <td>
                                        <a href="?page=masuk&aksi=info&id=<?php echo $data['id']; ?>"
                                            class="d-block btn btn-outline-info btn-xs"><i class="fa fa-eye "></i> Lihat</a>
                                        <?php if (is_admin()) { ?>
                                            <a href="https://api.whatsapp.com/send?phone=<?php echo $data['no_hp'] ?>&text=Ada Surat Masuk Tanggal: <?php echo tanggal_indo($data['tanggal_terima'], true) ?>, Dengan No Surat: <?php echo $data['no_surat'] ?>,  Tanggal Surat: <?php echo tanggal_indo($data['tgl_surat'], true) ?>,  Asal Surat Dari: <?php echo $data['asal_tujuan'] ?>, Dengan Tujuan Surat: <?php echo $data['nama_tujuan'] ?>, Perihal: <?php echo $data['perihal'] ?>"
                                                target="blank" class="d-block btn btn-success btn-xs"> <i class="fa  fa-whatsapp"></i>
                                                Kirim WA</a>
                                            <a href="?page=masuk&aksi=ubah&id=<?php echo $data['id']; ?>"
                                                class="d-block btn btn-info btn-xs"><i class="fa fa-edit "></i> Ubah</a>
                                        <?php } ?>
                                        <?php if ($data['status'] == 0) {
                                            ?>
                                            <a href="?page=masuk&aksi=disposisi&id=<?php echo $data['id']; ?>"
                                                class="d-block btn btn-success btn-xs"><i class="fa fa-mail-forward "></i> Disposisi</a>
                                        <?php } else { ?>
                                            <a disabled="" class="d-block btn btn-success btn-xs"><i class="fa fa-mail-forward "></i>
                                                Disposisi</a>
                                            <a target="blank" href="page/disposisi/cetak.php?id=<?php echo $data['disposisi']; ?>"
                                                class="d-block btn btn-warning btn-xs"><i class="fa fa-print "></i> Cetak Disposisi</a>
                                        <?php } ?>
                                        <?php if (is_admin()) { ?>
                                            <a onclick="return confirm('Anda Yakin Akan Mengahapus Data Ini ... ???')"
                                                href="?page=masuk&aksi=hapus&id=<?php echo $data['id']; ?>"
                                                class="d-block btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</a>
                                        <?php } ?>
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
                    <h4 class="modal-title" id="myModalLabel">Laporan Surat Masuk</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="page/masuk/cetak.php" target="blank">
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
                    <h4 class="modal-title" id="myModalLabel">Laporan Surat Masuk</h4>
                </div>
                <div class="modal-body">
                    <form role="form" method="POST" action="page/masuk/cetak_user.php" target="blank">
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