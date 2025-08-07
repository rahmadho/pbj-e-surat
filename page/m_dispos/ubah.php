<?php
$id = _get('id');
$sql = $koneksi->query("SELECT * from m_dispos where id_dispos='$id'");
$data = $sql->fetch_object();
?>
<div class="box box-success box-solid">
    <div class="box-header with-border">
        Tambah Data Bagian
    </div>
    <div class="panel-body">
        <form method="POST" enctype="multipart/form-data" id="form">
            <div class="form-group">
                <label>Nama Bagian</label>
                <input class="form-control" name="nama" id="nama" value="<?= _post('nama', $data->nama_bagian) ?>" />
            </div>
            <div class="form-group">
                <label>Pimpinan</label>
                <select name="pimpinan" id="pimpinan" class="form-control">
                    <option value="">-- PILIH --</option>
                    <?php
                    $sql = $koneksi->query("SELECT id, nama_user FROM tb_user WHERE level='user' and level_pimpinan > 1");
                    while ($user = $sql->fetch_object()) { 
                        $selected = (_post('pimpinan', $data->id_leader) == $user->id) ? 'selected' : '';
                        echo '<option value="'.$user->id.'" '.$selected.'>'.$user->nama_user.'</option>';
                    }
                    ?>
                </select>
            </div>
        </form>
    </div>
    <div class="panel-footer">
        <button form="form" type="submit" name="simpan" value="1" class="btn btn-primary">Simpan</button>
    </div>
</div>

<?php
if (is_post()) {
    $nama = _post('nama');
    $leader = (int) _post('pimpinan');
    $simpan = _post('simpan');
    if ($simpan) {
        $sql = $koneksi->prepare("UPDATE m_dispos set nama_bagian=?, id_leader=? where id_dispos=?");
        $sql->bind_param("sii", $nama, $leader, $id);
        $sql->execute();
        $sql->close();
        if ($sql) {
            swal("success", "Selamat!", "Data Berhasil Diubah!", "?page=m_dispos");
        }
    }
}
?>