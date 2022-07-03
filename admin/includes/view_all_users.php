<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>ID</th>
            <th>User Name</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Image</th>
            <th>Role</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php findAllUsers();deleteUser(); upApproveComment(); approveComment(); ?>

    </tbody>
</table>