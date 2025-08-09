<form method="POST" enctype="multipart/form-data" id="form">
    <div class="form-group">
        <label>Nama Pimpinan</label>
        <input class="form-control" name="nama_tujuan" required="" value="<?=$input['nama_tujuan'] ?? ''?>" />
    </div>
    <div class="form-group">
        <label>Nama HP (62 Pengganti 0 Contoh 6285609876543)</label>
        <input class="form-control" name="no_hp" required="" placeholder="Contoh 6285781480396" value="<?=$input['no_hp'] ?? ''?>" />
    </div>
    <input type="submit" name="simpan" value="Simpan" class="btn btn-success">
</form>