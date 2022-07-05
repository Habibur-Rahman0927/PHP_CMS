<?php
if (isset($_GET['p_id'])) {
    $the_post_id = $_GET['p_id'];
}
$query = "SELECT * FROM post WHERE post_id = $the_post_id ";
// $query = "SELECT * FROM category LIMIT 5";
$select_all_post_id = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($select_all_post_id)) {
    $post_id = $row['post_id'];
    $post_author = $row['post_author'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}

if (isset($_POST['update_post'])) {
    $post_title = $_POST['post_title'];
    $post_author = $_POST['post_author'];
    $post_category_id = $_POST['post_category_id'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    move_uploaded_file($post_image_temp, "../images/$post_image");
    if (empty($post_image)) {
        $query = "SELECT * FROM post WHERE post_id = $the_post_id ";
        $select_image = mysqli_query($conn, $query);
        confirmQuery($select_image);
        while ($row = mysqli_fetch_assoc($select_image)) {
            $post_image = $row['post_image'];
        }
    }
    if ($post_title == "" || empty($post_title)) {
        echo "This Field is Empty";
    } else {
        $query = "UPDATE post SET post_category_id = '{$post_category_id}', post_title = '{$post_title}', post_author = '{$post_author}', post_image = '{$post_image}', post_content = '{$post_content}', post_tags = '{$post_tags}', post_status = '{$post_status}', post_date = now() WHERE post_id = {$the_post_id} ";
        $update_post_query = mysqli_query($conn, $query);
        confirmQuery($update_post_query);
    }
}

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" value="<?php echo $post_title ?>" class="form-control" name="post_title" id="">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category ID</label>
        <select name="post_category_id" class="form-control" id="post_category_id">
            <?php
            $query = "SELECT * FROM category";
            $select_all_categories_sidebar = mysqli_query($conn, $query);

            confirmQuery($select_all_categories_sidebar);
            while ($row = mysqli_fetch_assoc($select_all_categories_sidebar)) {
                $cat_id = $row['cat_id'];
                $cat_title = $row['cat_title'];
                echo "<option value='{$cat_id}'>{$cat_title}</option>";
            }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="post_author" id="">
    </div>
    <div class="form-group">
    <select name="post_status" class="form-control" id="post_status">
        <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
        <?php 
            if($post_status == 'publishe'){
                echo "<option value='draft'>Draft</option>";
            }else{
                echo "<option value='publishe'>Publishe</option>";
            }
        ?>
    </select>
    </div>

    <!-- <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" value="<?php echo $post_status; ?>" class="form-control" name="post_status" id="">
    </div> -->

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" value="<?php echo $image; ?>" class="form-control" name="image" id="">
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image; ?>" alt="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags" id="">
    </div>


    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="10" rows="5"><?php echo $post_content; ?></textarea>
    </div>




    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="update_post" value="Update Post" id="">
    </div>

</form>