<?php include "includes/admin_header.php" ?>

<?php
if (isset($_SESSION['username'])) {
    $username =  $_SESSION['username'];
}

$query = "SELECT * FROM users WHERE user_name = '{$username}' ";
$select_user_profile_query = mysqli_query($conn, $query);

if (!$select_user_profile_query) {
    die("QUERY FAILD" . mysqli_error($conn));
}

while ($row = mysqli_fetch_array($select_user_profile_query)) {
    $user_id = $row['user_id'];
    $user_name = $row['user_name'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_role = $row['user_role'];
    $user_password = $row['user_password'];
}
?>
<?php 

if (isset($_POST['update_profile'])) {
    $user_name = $_POST['user_name'];
    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_email = $_POST['user_email'];
    $user_role = $_POST['user_role'];

    $user_image = $_FILES['image']['name'];
    $user_image_temp = $_FILES['image']['tmp_name'];
    move_uploaded_file($user_image_temp, "../images/$user_image");

    if (empty($user_image)) {
        $query = "SELECT * FROM users WHERE user_name = '{$username}' ";
        $select_image = mysqli_query($conn, $query);
        confirmQuery($select_image);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $user_image = $row['user_image'];
        }
    }

    if ($user_name == "" || empty($user_name)) {
        echo "This Field is Empty";
    } else {
        $query = "UPDATE users SET user_name = '{$user_name}', user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', user_email = '{$user_email}', user_role = '{$user_role}', user_image = '{$user_image}' WHERE user_name = '{$username}' ";
        $create_user_query = mysqli_query($conn, $query);
        confirmQuery($create_user_query);
    }
}

?>
<div id="wrapper">

    <!-- Navigation -->
    <?php include "includes/admin_navigation.php" ?>

    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        WelCome to Admin
                        <small>Author Name</small>
                    </h1>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="user_name">User Name</label>
                            <input type="text" value="<?php echo $user_name ?>" class="form-control" name="user_name" id="">
                        </div>
                        <div class="form-group">
                            <label for="user_role">User Role</label>
                            <select name="user_role" class="form-control" id="user_role">
                                <!-- <?php
                                        $query = "SELECT * FROM users";
                                        $select_user_role = mysqli_query($conn, $query);

                                        confirmQuery($select_user_role);
                                        while ($row = mysqli_fetch_assoc($select_user_role)) {
                                            $user_id = $row['user_id'];
                                            $user_role = $row['user_role'];
                                            echo "<option value='{$user_id}'>{$user_role}</option>";
                                        }
                                        ?> -->
                                <option value="subscriber"><?php echo $user_role; ?></option>
                                <?php
                                if ($user_role == 'admin') {
                                    echo "<option value='subscriber'>Subscriber</option>";
                                } else {
                                    echo "<option value='admin'>Admin</option>";
                                }

                                ?>

                            </select>
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
                            <label for="image">User Image</label>
                            <input type="file" value="<?php echo $user_image; ?>" class="form-control" name="image" id="">
                        </div>

                        <div class="form-group">
                            <img width="100" src="../images/<?php echo $user_image; ?>" alt="image">
                        </div>
                        <div class="form-group">
                            <label for="user_email">Email</label>
                            <input type="text" value="<?php echo $user_email; ?>" class="form-control" name="user_email" id="">
                        </div>

                        <div class="form-group">
                            <label for="user_password">Password</label>
                            <input type="password" value="<?php echo $user_password; ?>" class="form-control" name="user_password" id="">
                        </div>

                        <div class="form-group">
                            <input type="submit" class="btn btn-primary" name="update_profile" value="Update Profile" id="">
                        </div>

                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include "includes/admin_footer.php" ?>