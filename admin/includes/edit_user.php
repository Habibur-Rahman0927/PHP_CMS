<?php 
    if(isset($_GET['p_id'])){
        $the_post_id = $_GET['p_id'];
    }
    $query = "SELECT * FROM users WHERE user_id = $the_post_id ";
    // $query = "SELECT * FROM category LIMIT 5";
    $select_all_post_id = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_all_post_id)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        
    }

    if (isset($_POST['update_user'])){
        $user_name = $_POST['user_name'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $user_role = $_POST['user_role'];

        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($user_image_temp, "../images/$user_image" );

        if($username == "" || empty($username)){
            echo "This Field is Empty";
        }else{
            $query = "UPDATE users SET user_id = '{$user_id}', user_name = '{$user_name}', first_name = '{$first_name}', last_name = '{$last_name}', email = '{$email}', user_role = '{$user_role}', user_image = '{$user_image}', WHERE user_id = {$the_post_id} ";
            $create_user_query = mysqli_query($conn, $query);
            confirmQuery($create_user_query);
         }

    }

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="user_name">User Name</label>
        <input type="text" value="<?php echo $user_name ?>" class="form-control" name="user_name" id="">
    </div>

    <div class="form-group">
        <label for="user_firstname">First Name</label>
        <input type="text" value="<?php echo $user_firstname; ?>" class="form-control" name="user_firstname" id="">
    </div>

    <div class="form-group">
        <label for="user_lastname">Last Name</label>
        <input type="text" value="<?php echo $user_lastname; ?>" class="form-control" name="user_lastname" id="">
    </div>

    <div class="form-group">
        <label for="user_email">Email</label>
        <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email" id="">
    </div>

    <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" value="<?php echo $user_image; ?>" class="form-control" name="image" id="">
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $user_image; ?>" alt="image">
    </div>

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
        <input type="submit" class="btn btn-primary" name="update_user" value="Update User" id="">
    </div>

</form>