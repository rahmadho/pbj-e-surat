<?php
// id surat
$id = (int) _get('id');

// ambil data surat
$sql = $koneksi->query("SELECT t1.*, t2.asal_tujuan as nama_asal_tujuan 
    FROM tb_surat_masuk as t1
    LEFT JOIN tb_asal_tujuan as t2 ON t1.asal_surat = t2.id_asal_tujuan
    WHERE t1.id='$id'");
$surat = $sql->fetch_object();

if (empty($surat)) {
    swal("error", "Oops!", "Data surat masuk tidak ditemukan", "?page=masuk");
    exit;
};

// jika ada tanggapan surat
if (is_post()) {
    $tanggapan = _post("tanggapan");
    $koneksi->begin_transaction();
    try {
        $query = $koneksi->prepare("UPDATE tb_disposisi SET tanggapan = ? WHERE id_surat_masuk = ? AND disposisi_ke = ?");
        $query->bind_param("isi", $tanggapan, $id, $surat->disposisi);
        $query->execute();

        log_history($koneksi, $id, "Tanggapan surat masuk oleh " . auth()->nama_user);

        $koneksi->commit();
        swal("success", "Berhasil!", "Tanggapan berhasil disimpan", "?page=masuk&aksi=info&id=$id");
    } catch (\Throwable $th) {
        $koneksi->rollback();
        swal("error", "Oops!", "Gagal menyimpan tanggapan", "?page=masuk&aksi=info&id=$id");
    }
}

// disposisi terakhir
$sql_current_disposisi = $koneksi->query("SELECT t1.id, t2.id_dispos,t2.id_leader
    FROM tb_disposisi as t1 
    JOIN m_dispos as t2 ON t2.id_dispos=t1.disposisi_ke 
    WHERE t1.id_surat_masuk='$id' AND t1.id = $surat->disposisi");
$current_disposisi = $sql_current_disposisi->fetch_object();

// all disposisi
$sql_disposisi = $koneksi->query("SELECT t1.keterangan, t1.batas_waktu, t1.created_at, t2.nama_bagian as nama_bagian 
    FROM tb_disposisi as t1 
    JOIN m_dispos as t2 ON t2.id_dispos=t1.disposisi_ke 
    WHERE t1.id_surat_masuk='$id'
    ORDER BY created_at ASC");
?>
<div class="box box-success box-solid">
    <div class="box-header with-border">
        <div style="display: flex; justify-content: space-between;">
            <span>Informasi Surat Masuk</span>
            <?php if($current_disposisi->id_leader == auth()->id) { ?>
            <a id="lap_masuk" data-toggle="modal" data-target="#modal-tanggapan" class="btn btn-default"><i class="fa fa-fire"></i> Tanggapi</a>
            <?php } ?>
        </div>
    </div>
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <tr>
                        <th class="bg-light" width="200">No. Agenda</th>
                        <td colspan="3"><?php echo $surat->no_agenda; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">Nomor Surat</th>
                        <td><?php echo $surat->no_surat; ?></td>
                        <th class="bg-light" width="200">Sifat Surat</th>
                        <td class="text-danger" style="font-weight: bold;"><?php echo sifat_surat($surat->sifat_surat); ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">Asal Surat</th>
                        <td colspan="3"><?php echo $surat->nama_asal_tujuan; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">Tanggal Surat</th>
                        <td colspan="3"><?php echo tanggal_indo($surat->tgl_surat, true); ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">Tanggal Terima</th>
                        <td colspan="3"><?php echo tanggal_indo($surat->tanggal_terima, true); ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">Perihal</th>
                        <td colspan="3"><?php echo $surat->perihal; ?></td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">Disposisi</th>
                        <td colspan="3">
                            <?php 
                            if ($sql_disposisi->num_rows > 0) {
                            ?>
                            <table class="table">
                                <thead>
                                    <th>Kepada</th>
                                    <th>Keterangan</th>
                                    <th width="180">Tanggal</th>
                                </thead>
                                <tbody>
                                <?php while ($disposisi = $sql_disposisi->fetch_object()) { ?>
                                    <tr>
                                        <td>
                                            <div style=""><?php echo $disposisi->nama_bagian; ?></div>                                            
                                        </td>
                                        <td><?php echo $disposisi->keterangan; ?></td>
                                        <td>
                                            <div><?php echo tanggal_indo($disposisi->created_at, true); ?></div>
                                            <div class="text-sm text-muted" style="display: inline-block; color: #000; background-color: #f5f5f5; padding: 4px; border-radius: 4px;">Batas Waktu: <br> <?php echo tanggal_indo($disposisi->batas_waktu, true); ?></div>
                                        </td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                            <?php } else { ?>
                            <span class="text-danger">Tidak ada disposisi!</span>
                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <th class="bg-light" width="200">File Surat</th>
                        <td colspan="3">
                            <?php if (!empty($surat->file_surat)) { ?>
                            <a href="page/masuk/file_surat.php?id=<?php echo $surat->id; ?>" target="blank">Lihat</a>
                            <?php } else { ?>
                            <span class="text-danger">Tidak ada file surat yang diupload!</span>
                            <?php } ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="box-header with-border">
        Riwayat Surat 
    </div>
    <div class="panel-body">
            <?php
            $query_history = $koneksi->query("SELECT keterangan, created_at FROM tb_history_surat_masuk WHERE id_surat_masuk='$id'");
            if ($query_history->num_rows > 0) {
                while ($data_history = $query_history->fetch_assoc()) {
            ?>
            <div class="timeline">
                <div class="time-label"><span class="bg-green pl-2"><?php echo tanggal_indo($data_history['created_at'], true); ?></span></div>
                <div class="mt-2">
                    <div class="timeline-item">
                        <span class="time"><i class="fa fa-clock-o"></i> <?php echo date('H:i', strtotime($data_history['created_at'])); ?></span>
                        <div class="timeline-body"><?php echo $data_history['keterangan']; ?></div>
                    </div>
                </div>
            </div>
            <?php }
            } else { ?>
            <div class="timeline">
                <div class="mt-2">
                    <div class="timeline-item">
                        <div class="timeline-body">Tidak ada riwayat surat!</div>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</div>
<div class="modal fade" id="modal-tanggapan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel">Tanggapi Surat</h4>
            </div>
            <div class="modal-body">
                <form role="form" method="POST" action="">
                    <div class="form-group">
                        <label>Tanggapan</label>
                        <textarea rows="5" class="form-control" name="tanggapan"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" name="cetak" class="btn btn-default" style="margin-top: 8px;"><i class="fa fa-send"></i> Kirim</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
</div>