<?php echo validation_errors(); ?>
<?php echo form_open('jenisobat/update'); ?>
<input type="hidden" name="id" value="<?= $jenisobat['id']; ?>">

<div class="p2">
    <div class="form-group">
        <label>Nama Jenis Obat</label>
        <input type="text" class="form-control" value="<?= $jenisobat['nama_jenis_obat']; ?>" placeholder="Nama Jenis Obat" name="nama_jenis_obat" required>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
</form>