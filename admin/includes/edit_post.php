<?php 
    if(isset($_GET['p_id'])){
        $the_post_id = isset($_GET['p_id']);
    }
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
        $post_content = $row['post_content'];
        $post_comment_count = $row['post_comment_count'];
        $post_date = $row['post_date'];}

?>
<form action="" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="post_title">Post Title</label>
        <input type="text" value="<?php echo $post_title ?>" class="form-control" name="post_title" id="">
    </div>

    <div class="form-group">
        <label for="post_category_id">Post Category ID</label>
        <input type="text" value="<?php echo $post_category_id ?>" class="form-control" name="post_category_id" id="">
    </div>

    <div class="form-group">
        <label for="post_author">Post Author</label>
        <input type="text" value="<?php echo $post_author ?>" class="form-control" name="post_author" id="">
    </div>

    <div class="form-group">
        <label for="post_status">Post Status</label>
        <input type="text" value="<?php echo $post_status ?>" class="form-control" name="post_status" id="">
    </div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" value="<?php echo $image ?>" class="form-control" name="image" id="">
    </div>

    <div class="form-group">
        <img width="100" src="../images/<?php echo $post_image ?>" alt="image">
    </div>

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input type="text" value="<?php echo $post_tags ?>" class="form-control" name="post_tags" id="">
    </div>


    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea type="text" class="form-control" name="post_content" id="" cols="10" rows="5"><?php echo $post_content; ?></textarea>
    </div>

    


    <div class="form-group">
        <input type="submit" class="btn btn-primary" name="create_post" value="Create Post" id="">
    </div>

</form>