<?php  
    include "db.php";
    session_start();
    if(isset($_POST['login'])){
        $user_name = $_POST['user_name'];
        $password = $_POST['password'];

        $username = mysqli_real_escape_string($conn, $username);
        $password = mysqli_real_escape_string($conn, $password);

        $query = "SELECT randsalt FROM users";
        $select_randsalt_query = mysqli_query($conn, $query);
        if (!$select_randsalt_query) {
            die("QUERY FAILED" . mysqli_error($conn));
        }

        $row = mysqli_fetch_array($select_randsalt_query);
        $salt = $row['randsalt'];
        $password = crypt($password, $salt);

        $query = "SELECT * FROM users WHERE user_name = '{$user_name}' ";
        $select_user_query = mysqli_query($conn, $query);

        if(!$select_user_query){
            die("QUERY FAILD" . mysqli_error($conn));
        }
    
        while($row = mysqli_fetch_array($select_user_query)){
            $db_user_id = $row['user_id'];
            $db_user_name = $row['user_name'];
            $db_user_password = $row['user_password'];
            $db_user_firstname = $row['user_firstname'];
            $db_user_lastname = $row['user_lastname'];
            $db_user_email = $row['user_email'];
            $db_user_role = $row['user_role'];

        }
        
        // $password = crypt($password, $db_user_password);
        
        if($user_name === $db_user_name && $password === $db_user_password){
            $_SESSION['username'] = $db_user_name;
            $_SESSION['firstname'] = $db_user_firstname;
            $_SESSION['lastname'] = $db_user_lastname;
            $_SESSION['user_role'] = $db_user_role;
            header("Location: ../admin ");
        }else{
            header("Location: ../index.php ");
        }

    }
?>