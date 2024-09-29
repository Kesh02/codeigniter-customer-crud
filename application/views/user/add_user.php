<!-- <!-- <div class="card">
    <div class="card-body">
        <h5 class="card-title text-center">Add User</h5>
        <form method="post" action="<?php echo base_url('user/store'); ?>">
            <div class="mb-3">
                <label for="username" class="form-label">Name</label>
                <input type="text" class="form-control" name="username" placeholder="Enter name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" placeholder="Enter email">
            </div>
            <div class="mb-3">
                <label for="mobile" class="form-label">Mobile</label>
                <input type="text" class="form-control" name="mobile" placeholder="Enter mobile">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" name="address" placeholder="Enter address">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
$(document).ready(function() {
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'), // Use form's action URL
            data: $(this).serialize(), // Serialize form data
            success: function(response) {
                // Parse the JSON response
                const res = JSON.parse(response);
                if (res.status === 'success') {
                    alert(res.message); // Show success message
                    // Optionally, redirect or update UI
                    // window.location.href = 'url_to_redirect';
                } else {
                    alert(res.message); // Show error message
                }
            },
            error: function(xhr, status, error) {
                console.error(error);
                alert('An error occurred while adding the user.');
            }
        });
    });
});
</script> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
</head>
<body>

<h2 class="text-center">Users List</h2>

<!-- checks if there's a flash message in the session and displays it -->
<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<!-- Button to Open the Modal -->
<button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
    Add New User
</button>

<!-- The Modal -->
<div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="addUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm">
                    <div class="mb-3">
                        <label for="username" class="form-label">Name</label>
                        <input type="text" class="form-control" name="username" placeholder="Enter name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" name="mobile" placeholder="Enter mobile" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="address" placeholder="Enter address" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

<table id="userTable" class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Mobile</th>
            <th>Address</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $user): ?>
        <tr>
            <td><?php echo $user->Name; ?></td>
            <td><?php echo $user->Email; ?></td>
            <td><?php echo $user->Mobile; ?></td>
            <td><?php echo $user->Address; ?></td>
            <td>
                <a href="<?php echo base_url('user/edit/'.$user->ID) ?>" class="btn btn-warning">Update</a>
                <a href="<?php echo base_url('user/delete/'.$user->ID); ?>" class="btn btn-danger">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Include jQuery and DataTables -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#userTable').DataTable();

    // Handle the form submission with AJAX
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        //server connection
        $.ajax({
            type: 'POST',
            url: '<?php echo base_url('user/store'); ?>',
            data: $(this).serialize(),
            success: function(response) {
                const res = JSON.parse(response); // Parse the JSON response
                if (res.status === 'success') {
                    // Append new user to the table
                    table.row.add([
                        res.data.name,
                        res.data.email,
                        res.data.mobile,
                        res.data.address,
                        '<a href="<?php echo base_url('user/edit/'); ?>' + res.data.id + '" class="btn btn-warning">Update</a>' +
                        '<a href="<?php echo base_url('user/delete/'); ?>' + res.data.id + '" class="btn btn-danger">Delete</a>'
                    ]).draw(); // Add the new row and redraw the table

                    $('#addUserModal').modal('hide'); // Hide the modal
                    $('#addUserForm')[0].reset(); // Reset the form fields
                } else {
                    alert(res.message); // Show error message
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText); // Log the error response
                alert('Error adding user. Please try again.');
            }
        });
    });
});
</script>

</body>
</html>

