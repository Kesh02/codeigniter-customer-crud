<div class="card">
    <div class="card-body">
        <h5 class="card-title text-center">Edit User</h5>
        <form method="post" action="<?php echo base_url('user/update/'.$user->ID); ?>">
        <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <input type="text" class="form-control" name="username" value="<?php echo $user->Name; ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" value="<?php echo $user->Email; ?>" required>
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" class="form-control" name="mobile" value="<?php echo $user->Mobile; ?>" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" value="<?php echo $user->Address; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>
