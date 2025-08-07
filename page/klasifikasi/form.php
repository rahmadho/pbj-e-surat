<form method="POST" enctype="multipart/form-data" id="form">
    <div class="form-group">
        <label>Kode </label>
        <input class="form-control" name="kode" value="<?=$input['kode'] ?? ''?>" />
    </div>

    <div class="form-group">
        <label>Nama </label>
        <input class="form-control" name="nama" id="nama" value="<?=$input['nama'] ?? ''?>" />
    </div>
    <div class="form-group">
        <label>Uraian :</label>
        <textarea class="form-control" rows="3" name="uraian"><?=$input['uraian'] ?? ''?></textarea>
    </div>
</form>