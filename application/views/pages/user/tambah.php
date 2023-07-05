<?php echo validation_errors(); ?>
<?php echo form_open('user/store'); ?>

<div class="p2">
    <div class="form-group">
        <label>Username </label>
        <input type="text" class="form-control" placeholder="username " name="username" required>
    </div>
    <div class="form-group">
        <label>fullname </label>
        <input type="text" class="form-control" placeholder="fullname " name="fullname" required>
    </div>
    <div class="form-group">
        <label>password </label>
        <input type="password" class="form-control" placeholder="password " name="password" required>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
</form>