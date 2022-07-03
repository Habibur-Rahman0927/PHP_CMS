<?php insert_user(); ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_name">User Name</label>
        <input type="text" class="form-control" name="user_name" id="">
    </div>

    <!-- <div class="form-group">
        <label for="post_category_id">Post Category ID</label>
        <input type="text" class="form-control" name="post_category_id" id="">
    </div> -->
    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" class="form-control" id="user_role">
            <!-- <?php
                $query = "SELECT * FROM users";
                $select_user_role = mysqli_query($conn, $query);
            
                confirmQuery($select_user_role);
                while($row = mysqli_fetch_assoc($select_user_role)){
                    $user_id = $row['user_id'];
                    $user_role = $row['user_role'];
                    echo "<option value='{$user_id}'>{$user_role}</option>";
                }
            ?> -->
            <option value="subscriber">Select Option</option>
            <option value="admin">Admin</option>
            <option value="subscriber">Subscriber</option>
        </select>
    </div>

    <div class="form-group">
        <label for="first_name">First Name</label>
        <input type="text" class="form-control" name="first_name" id="">
    </div>

    <div class="form-group">
        <label for="last_name">Last Name</label>
        <input type="text" class="form-control" name="last_name" id="">
    </div>

    <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" class="form-control" name="image" id="">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="">
    </div>


    <div class="form-group">
        <label for="password">User Password</label>
        <input type="password" class="form-control" name="password" id="">
    </div>

    


    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_user" value="Add User" id="">
    </div>

</form>
<?php
// if (isset($_GET['edit'])){
//     $cat_id = $_GET['edit'];
//     include "includes/Update_categories.php";
// }

?>