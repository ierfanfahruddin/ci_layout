<?php echo validation_errors(); ?>
<?php echo form_open('obat/update'); ?>
<input type="hidden" name="id" value="<?= $obat['id']; ?>">
<div class="p2">
    <div class="form-group">
        <label>Nama Obat</label>
        <input type="text" class="form-control" value="<?= $obat['nama_obat']; ?>" placeholder="Nama Obat" name="nama_obat" required>
    </div>
    <div class="form-group">
        <label>Jenis Obat</label>
        <select class="form-control" required name="id_jenis_obat" id="">
            <option value="">--pilih--</option>
            <?php foreach ($jenisobat as $row) : ?>
                <option <?= ($row['id'] == $obat['id_jenis_obat']) ? 'selected' : ''; ?> value="<?= $row['id'] ?>">
                    <?= $row['nama_jenis_obat'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label>Satuan</label>
        <input type="text" class="form-control" value="<?= $obat['satuan']; ?>" placeholder="Satuan " name="satuan" required>
    </div>
    <div class="form-group">
        <label>Harga</label>
        <input type="number" class="form-control" value="<?= $obat['harga']; ?>" placeholder="harga " name="harga" required>
    </div>
    <div class="form-group">
        <label>Stok</label>
        <input type="number" class="form-control" placeholder="stok " value="<?= $obat['stok']; ?>" name="stok" required>
    </div>
    <div class="form-group">
        <label>Tgl Exp</label>
        <input type="date" class="form-control" placeholder="tgl_exp " value="<?= $obat['tgl_exp']; ?>" name="tgl_exp" required>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
</form>