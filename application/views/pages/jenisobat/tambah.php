<?php echo validation_errors(); ?>
<?php echo form_open('jenisobat/store'); ?>

<div class="p2">
    <div class="form-group">
        <label>Nama Jenis Obat</label>
        <input type="text" class="form-control" placeholder="Nama Jenis Obat" name="nama_jenis_obat" required>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
</form>