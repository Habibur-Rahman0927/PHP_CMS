<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>
<?php

if (isset($_POST['submit'])) {
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];

    if (!empty($user_name) && !empty($user_email) && !empty($user_password)) {
        $user_name = mysqli_real_escape_string($conn, $user_name);
        $user_email = mysqli_real_escape_string($conn, $user_email);
        $user_password = mysqli_real_escape_string($conn, $user_password);

        $query = "SELECT randsalt FROM users";
        $select_randsalt_query = mysqli_query($conn, $query);
        if (!$select_randsalt_query) {
            die("QUERY FAILED" . mysqli_error($conn));
        }

        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randsalt'];
        $user_password = crypt($user_password, $salt);
        
        $query = "INSERT INTO users (user_name, user_email, user_password, user_role) VALUES ('{$user_name}', '{$user_email}', '{$user_password}', 'subscriber' )";
        $register_user_query = mysqli_query($conn, $query);
        if (!$register_user_query) {
            die("QUERY FAILED" . mysqli_error($conn) . ' ' .  mysqli_errno($conn));
        }
        $message = "<div class='alert alert-success' role='alert'>You Registration has been submitted</div>";
    }else{
        $message = "<div class='alert alert-danger' role='alert'>Field cannot be empty</div>";

    }
}else {
    $message = "";
}

?>
<!-- $2y$10$aiusesomecrazystring22 -->
<!-- Navigation -->

<?php include "includes/navigation.php"; ?>


<!-- Page Content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                            <div><?php echo $message; ?></div>
                            <div class="form-group">
                                <label for="user_name" class="sr-only">username</label>
                                <input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Desired Username">
                            </div>
                            <div class="form-group">
                                <label for="user_email" class="sr-only">Email</label>
                                <input type="email" name="user_email" id="user_email" class="form-control" placeholder="somebody@example.com">
                            </div>
                            <div class="form-group">
                                <label for="user_password" class="sr-only">Password</label>
                                <input type="password" name="user_password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                        </form>

                    </div>
                </div> <!-- /.col-xs-12 -->
            </div> <!-- /.row -->
        </div> <!-- /.container -->
    </section>


    <hr>



    <?php include "includes/footer.php"; ?>