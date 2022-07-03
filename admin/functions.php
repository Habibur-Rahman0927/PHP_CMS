

<?php
function confirmQuery($result){
    global $conn;
    if(!$result){
        die("QUERY FAILD" . mysqli_error($conn));
    }
}




function insert_categories() {
    global $conn;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "This Field is Empty";
        }else{
            $query = "INSERT INTO category(cat_title) VALUE('{$cat_title}') ";
            $create_category_query = mysqli_query($conn, $query);
            confirmQuery($create_category_query);
         }
    }
}

function findAllCategories(){
    global $conn;
    $query = "SELECT * FROM category";
    // $query = "SELECT * FROM category LIMIT 5";
    $select_all_categories_sidebar = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_all_categories_sidebar)){
        $cat_id = $row['cat_id'];
        $cat_title = $row['cat_title'];
        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<td><a href='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function deleteCategories(){
    global $conn;
    if(isset($_GET['delete'])){
        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM category WHERE cat_id = {$the_cat_id} ";
        $delete_query = mysqli_query($conn, $query);
        header("Location: categories.php");
    }
}
// post
function findAllPost(){
    global $conn;
    $query = "SELECT * FROM post";
    // $query = "SELECT * FROM category LIMIT 5";
    $select_all_post_sidebar = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_all_post_sidebar)){
        $post_id = $row['post_id'];
        $post_author = $row['post_author'];
        $post_title = $row['post_title'];
        $post_category_id = $row['post_category_id'];
        $post_status = $row['post_status'];
        $post_image = $row['post_image'];
        $post_tags = $row['post_tags'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];
        echo "<tr>";
        echo "<td>{$post_id}</td>";
        echo "<td>{$post_author}</td>";
        echo "<td>{$post_title}</td>";

        $query = "SELECT * FROM category WHERE cat_id = {$post_category_id} ";
        $select_category_id = mysqli_query($conn, $query);
        while ($row =  mysqli_fetch_assoc($select_category_id)) {
            $cat_id = $row['cat_id'];
            $cat_title = $row['cat_title'];
            echo "<td>{$cat_title}</td>";
        }
        echo "<td>{$post_status}</td>";
        echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$post_date}</td>";
        echo "<td><a href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>";
        echo "</tr>";
    }
}

function deletePost(){
    global $conn;
    if(isset($_GET['delete'])){
        $the_post_id = $_GET['delete'];
        $query = "DELETE FROM post WHERE post_id = {$the_post_id} ";
        $delete_query = mysqli_query($conn, $query);
        header("Location: posts.php");
    }
}
function insert_posts() {
    global $conn;
    if(isset($_POST['create_post'])){
        $post_title = $_POST['post_title'];
        $post_author = $_POST['post_author'];
        $post_category_id = $_POST['post_category_id'];
        $post_status = $_POST['post_status'];

        $post_image = $_FILES['image']['name'];
        $post_image_temp = $_FILES['image']['tmp_name'];

        $post_tags = $_POST['post_tags'];
        $post_content = $_POST['post_content'];
        $post_date = date('d-m-y');
        move_uploaded_file($post_image_temp, "../images/$post_image" );

        if($post_title == "" || empty($post_title)){
            echo "This Field is Empty";
        }else{
            $query = "INSERT INTO post(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags,  post_status) VALUE({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
            $create_post_query = mysqli_query($conn, $query);
            confirmQuery($create_post_query);
         }
    }
}
// comment

function findAllComments(){
    global $conn;
    $query = "SELECT * FROM comments";
    // $query = "SELECT * FROM category LIMIT 5";
    $select_all_post_sidebar = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_all_post_sidebar)){
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $comment_author = $row['comment_author'];
        $comment_content = $row['comment_content'];
        $comment_email = $row['comment_email'];
        $comment_status = $row['comment_status'];
        $comment_Date = $row['comment_Date'];
        echo "<tr>";
        echo "<td>{$comment_id}</td>";
        echo "<td>{$comment_post_id}</td>";
        echo "<td>{$comment_author}</td>";
        echo "<td>{$comment_email}</td>";

        // $query = "SELECT * FROM category WHERE cat_id = {$post_category_id} ";
        // $select_category_id = mysqli_query($conn, $query);
        // while ($row =  mysqli_fetch_assoc($select_category_id)) {
        //     $cat_id = $row['cat_id'];
        //     $cat_title = $row['cat_title'];
        //     echo "<td>{$cat_title}</td>";
        // }
        
        echo "<td>{$comment_status}</td>";


        $query = "SELECT * FROM post WHERE post_id = $comment_post_id ";
        $select_post_id_query = mysqli_query($conn, $query);
        while($row = mysqli_fetch_assoc($select_post_id_query)){
            $post_id = $row['post_id'];
            $post_title = $row['post_title'];
            echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
        }
        
        echo "<td>{$comment_Date}</td>";
        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
        echo "<td><a href='posts.php?source=edit_post&p_id='>Edit</a></td>";
        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";
        echo "</tr>";
    }
}

function deleteComment(){
    global $conn;
    if(isset($_GET['delete'])){
        $the_comment_id = $_GET['delete'];
        $query = "DELETE FROM comments WHERE comment_id = {$the_comment_id} ";
        $delete_query = mysqli_query($conn, $query);
        header("Location: comments.php");
    }
}
function upApproveComment(){
    global $conn;
    if(isset($_GET['unapprove'])){
        $the_comment_id = $_GET['unapprove'];
        $query = "UPDATE comments SET comment_status = 'unapprove' WHERE comment_id = {$the_comment_id} ";
        $unapprove_query = mysqli_query($conn, $query);
        header("Location: comments.php");
    }
}

function approveComment(){
    global $conn;
    if(isset($_GET['approve'])){
        $the_comment_id = $_GET['approve'];
        $query = "UPDATE comments SET comment_status = 'approve' WHERE comment_id = {$the_comment_id} ";
        $approve_query = mysqli_query($conn, $query);
        header("Location: comments.php");
    }
}

// user

function findAllUsers(){
    global $conn;
    $query = "SELECT * FROM users";
    // $query = "SELECT * FROM category LIMIT 5";
    $select_all_post_sidebar = mysqli_query($conn, $query);

    while($row = mysqli_fetch_assoc($select_all_post_sidebar)){
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];
        
        echo "<tr>";
        echo "<td>{$user_id}</td>";
        echo "<td>{$user_name}</td>";
        echo "<td>{$user_firstname}</td>";
        echo "<td>{$user_lastname}</td>";
        echo "<td>{$user_email}</td>";
        echo "<td>{$user_image}</td>";
        echo "<td>{$user_role}</td>";

        // $query = "SELECT * FROM category WHERE cat_id = {$post_category_id} ";
        // $select_category_id = mysqli_query($conn, $query);
        // while ($row =  mysqli_fetch_assoc($select_category_id)) {
        //     $cat_id = $row['cat_id'];
        //     $cat_title = $row['cat_title'];
        //     echo "<td>{$cat_title}</td>";
        // }
        
        // echo "<td>{$comment_status}</td>";


        // $query = "SELECT * FROM post WHERE post_id = $comment_post_id ";
        // $select_post_id_query = mysqli_query($conn, $query);
        // while($row = mysqli_fetch_assoc($select_post_id_query)){
        //     $post_id = $row['post_id'];
        //     $post_title = $row['post_title'];
        //     echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
        // }
        
        // echo "<td>{$comment_Date}</td>";
        // echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        // echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
        echo "<td><a href='users.php?source=edit_user&p_id=$user_id'>Edit</a></td>";
        echo "<td><a href='users.php?delete=$user_id'>Delete</a></td>";
        echo "</tr>";
    }
}

function insert_user() {
    global $conn;
    if(isset($_POST['create_user'])){
        $user_name = $_POST['user_name'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email = $_POST['email'];
        $user_role = $_POST['user_role'];
        $password = $_POST['password'];

        $user_image = $_FILES['image']['name'];
        $user_image_temp = $_FILES['image']['tmp_name'];
        move_uploaded_file($user_image_temp, "../images/$user_image" );

        if($user_name == "" || empty($user_name)){
            echo "This Field is Empty";
        }else{
            $query = "INSERT INTO users(user_name, user_password, user_firstname, user_lastname, user_email, user_image, user_role) VALUE('{$user_name}','{$password}', '{$first_name}', '{$last_name}', '{$email}','{$user_image}', '{$user_role}') ";
            $create_user_query = mysqli_query($conn, $query);
            confirmQuery($create_user_query);
         }
        

    }
}

function deleteUser(){
    global $conn;
    if(isset($_GET['delete'])){
        $the_user_id = $_GET['delete'];
        $query = "DELETE FROM users WHERE user_id = {$the_user_id} ";
        $delete_query = mysqli_query($conn, $query);
        header("Location: users.php");
    }
}
?>