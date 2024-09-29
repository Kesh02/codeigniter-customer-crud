<h2 class="text-center">Users List</h2>

<?php if ($this->session->flashdata('message')): ?>
    <div class="alert alert-success">
        <?php echo $this->session->flashdata('message'); ?>
    </div>
<?php endif; ?>

<!-- Button to Open the Modal -->
<button type="button" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
    Add New Customer
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

<?php if ($this->session->flashdata('data_to_log')): ?>
<script>
    var data = <?php echo $this->session->flashdata('data_to_log'); ?>;
    console.log('Data to Update:', data);
</script>
<?php endif; ?>

<!-- Include jQuery and DataTables -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->

<!-- <script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#userTable').DataTable();

        // Handle the form submission with AJAX
        $('#addUserForm').on('submit', function(e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('user/store'); ?>',
                data: $(this).serialize(),
                success: function(response) {
                    $('#addUserModal').modal('hide'); // Hide the modal
                    $('#userTable').DataTable().ajax.reload(); // Reload the DataTable
                    location.reload(); // Alternatively reload the page to see changes
                },
                error: function() {
                    alert('Error adding user. Please try again.');
                }
            });
        });
    });
</script> -->
<!-- 
<script>
$(document).ready(function() {
    // Initialize DataTable
    var table = $('#userTable').DataTable();

    // Handle the form submission with AJAX
    $('#addUserForm').on('submit', function(e) {
        e.preventDefault();
        
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

 -->
