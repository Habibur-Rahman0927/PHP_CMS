

<?php

function insert_categories() {
    global $conn;
    if(isset($_POST['submit'])){
        $cat_title = $_POST['cat_title'];
        if($cat_title == "" || empty($cat_title)){
            echo "This Field is Empty";
        }else{
            $query = "INSERT INTO category(cat_title) VALUE('{$cat_title}') ";
            $create_category_query = mysqli_query($conn, $query);
            if(!$create_category_query){
                die("QUERY FAILD" . mysqli_error($conn));
            }
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
        echo "<td>{$post_category_id}</td>";
        echo "<td>{$post_status}</td>";
        echo "<td><img width='100' src='../images/$post_image' alt='image'></td>";
        echo "<td>{$post_tags}</td>";
        echo "<td>{$post_comment_count}</td>";
        echo "<td>{$post_date}</td>";
        // echo "<td><a href='categories.php?edit={$cat_id}'>Edit</a></td>";
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
        $post_comment_count = 4;
        move_uploaded_file($post_image_temp, "../images/$post_image" );

        if($post_title == "" || empty($post_title)){
            echo "This Field is Empty";
        }else{
            $query = "INSERT INTO post(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_comment_count, post_status) VALUE({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_comment_count}', '{$post_status}') ";
            $create_post_query = mysqli_query($conn, $query);
            if(!$create_post_query){
                die("QUERY FAILD" . mysqli_error($conn));
            }
         }
    }
}

?>