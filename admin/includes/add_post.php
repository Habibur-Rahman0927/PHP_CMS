<?php insert_posts(); ?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" class="form-control" name="post_title" id="">
    </div>

    <!-- <div class="form-group">
        <label for="post_category_id">Post Category ID</label>
        <input type="text" class="form-control" name="post_category_id" id="">
    </div> -->
    <div class="form-group">
        <label for="post_category_id">Post Category ID</label>
        <select name="post_category_id" class="form-control" id="post_category_id">
            <?php
                $query = "SELECT * FROM category";
                $select_all_categories_sidebar = mysqli_query($conn, $query);
            
                confirmQuery($select_all_categories_sidebar);
                while($row = mysqli_fetch_assoc($select_all_categories_sidebar)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
                    echo "<option value='{$cat_id}'>{$cat_title}</option>";
                }
            ?>
        </select>
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" class="form-control" name="post_author" id="">
    </div>

    <select name="post_status" class="form-control" id="post_status">
        <option value="draft">Select Options</option>
        <option value="publishe">Published</option>
        <option value="draft">Draft</option>
    </select>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" class="form-control" name="image" id="">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" class="form-control" name="post_tags" id="">
    </div>


    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="body" cols="10" rows="5"></textarea>
        
    </div>

    


    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Create Post" id="">
    </div>

</form>
<?php
// if (isset($_GET['edit'])){
//     $cat_id = $_GET['edit'];
//     include "includes/Update_categories.php";
// }

?>