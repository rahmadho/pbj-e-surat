<div class="box box-success box-solid">
    <div class="box-header with-border">
        Tambah Data Bagian
    </div>
    <div class="panel-body">
        <form method="POST" enctype="multipart/form-data" id="form">
            <div class="form-group">
                <label>Nama Bagian</label>
                <input class="form-control" name="nama" id="nama" />
            </div>
            <div class="form-group">
                <label>Pimpinan</label>
                <select name="pimpinan" id="pimpinan" class="form-control">
                    <option value="">-- PILIH --</option>
                    <?php
                    $sql = $koneksi->query("SELECT id, nama_user FROM tb_user WHERE level='user' and level_pimpinan = 2");
                    while ($data = $sql->fetch_object()) { 
                        echo '<option value="'.$data->id.'">'.$data->nama_user.'</option>';
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
        $sql = $koneksi->prepare("INSERT INTO m_dispos (nama_bagian, id_leader) values (?, ?)");
        $sql->bind_param("si", $nama, $leader);
        $sql->execute();
        $sql->close();
        if ($sql) {
            swal("success", "Selamat!", "Data Berhasil Disimpan!", "?page=m_dispos");
        }
    }
}
?>