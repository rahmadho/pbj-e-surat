<?php 
$id_user = auth()->id;
if (is_level(LEVEL_KABAG) | is_level(LEVEL_KASUBAG)) {
    $query = "SELECT * FROM tb_agenda as ta WHERE exists (
        SELECT 1 
        FROM tb_surat_masuk as sm 
        JOIN tb_disposisi as td on td.id_surat_masuk=sm.id
        JOIN m_dispos as d on d.id_dispos=td.disposisi_ke
        WHERE ta.id_surat=sm.id 
        AND d.id_leader=$id_user
    )";
    // print_r($query);
} else {
    $query = "SELECT * FROM tb_agenda as ta WHERE exists (
        SELECT 1 
        FROM tb_surat_masuk as sm 
        WHERE ta.id_surat=sm.id 
    )";
}
$query_agenda = $koneksi->query($query);
?>
<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="box box-success box-solid">
            <div class="box-header with-border">
                Data Agenda
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" data-datatable="true">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Agenda</th>
                                <th>Waktu Agenda</th>
                                <th>Tempat Agenda</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            while ($data = $query_agenda->fetch_object()) {
                                ?>
                                <tr>
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo date('d F Y', strtotime($data->tgl_agenda)); ?></td>
                                    <td><?php echo $data->waktu_agenda; ?></td>
                                    <td><?php echo $data->tempat_agenda; ?></td>
                                    <td>
                                        <a href="?page=agenda&aksi=dokumentasi&id=<?php echo $data->id; ?>" class="btn btn-info btn-xs"><i class="fa fa-file"></i> Dokumentasi</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
