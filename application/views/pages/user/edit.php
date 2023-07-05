<?php echo validation_errors(); ?>
<?php echo form_open('user/update'); ?>
<input type="hidden" name="id" value="<?= $user['id'] ?>">
<div class="p2">
    <div class="form-group">
        <label>Username </label>
        <input type="text" class="form-control" value="<?= $user['username'] ?>" placeholder="username " name="username" required>
    </div>
    <div class="form-group">
        <label>fullname </label>
        <input type="text" value="<?= $user['fullname'] ?>" class="form-control" placeholder="fullname " name="fullname" required>
    </div>
    <div class="form-group">
        <label>password </label>
        <input type="password" value="<?= $user['password'] ?>" class="form-control" placeholder="password " name="password" required>
    </div>
    <div class="form-group">
        <label>Is Active</label>
        <select class="form-control" required name="is_active" id="">
            <option <?= ($user['is_active'] == 1) ? 'selected' : ''; ?> value="1">Active</option>
            <option <?= ($user['is_active'] == 0) ? 'selected' : ''; ?> value="0">Non active</option>

        </select>
    </div>
    <div class="form-group">
        <label>Role</label>
        <select class="form-control" required name="role" id="">
            <option <?= ($user['role'] == 'user') ? 'selected' : ''; ?> value="user">user</option>
            <option <?= ($user['role'] == 'admin') ? 'selected' : ''; ?> value="admin">admin</option>

        </select>
    </div>
    <button class="btn btn-primary" type="submit">Submit</button>
</div>
</form>