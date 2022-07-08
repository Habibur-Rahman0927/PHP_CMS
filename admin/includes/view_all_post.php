<?php
if (isset($_POST['checkBoxArray'])) {
    foreach ($_POST['checkBoxArray'] as $checkBoxValue) {
        $bluk_options = $_POST['bluk_options'];
        switch ($bluk_options) {
            case 'publishe':
                $query = "UPDATE post SET  post_status = '{$bluk_options}' WHERE post_id = {$checkBoxValue} ";
                $update_post_query = mysqli_query($conn, $query);
                confirmQuery($update_post_query);
                break;
            case 'draft':
                $query = "UPDATE post SET  post_status = '{$bluk_options}' WHERE post_id = {$checkBoxValue} ";
                $update_post_query = mysqli_query($conn, $query);
                confirmQuery($update_post_query);
                break;
            case 'delete':
                $query = "DELETE FROM post WHERE post_id = {$checkBoxValue} ";
                $delete_query = mysqli_query($conn, $query);
                header("Location: posts.php");
                break;
            case 'clone':
                $query = "SELECT * FROM post WHERE post_id = {$checkBoxValue} ";
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
                    $post_date = $row['post_date'];
                }

                $query = "INSERT INTO post(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags,  post_status) VALUE({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";
                $create_post_query = mysqli_query($conn, $query);
                confirmQuery($create_post_query);
                break;

            default:
                # code...
                break;
        }
    }
    // var_dump($_POST['checkBoxArray']);
}

?>



<form action="" method="post">
    <table class="table table-bordered table-hover">

        <div id="bulkOptionContainer" style="padding: 0px; padding-bottom: 10px;" class="col-xs-4">
            <select class="form-control" name="bluk_options" id="">
                <option value="">Select Options</option>
                <option value="publishe">Publish</option>
                <option value="draft">Draft</option>
                <option value="clone">Clone</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-xs-4">
            <input type="submit" value="Apply" name="submit" class="btn btn-success">
            <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
        </div>


        <thead>
            <tr>
                <th><input type="checkbox" id="selectAllcheckBoxes"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Title</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Date</th>
                <th>Views</th>
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php findAllPost();
            deletePost(); resetPost(); ?>

        </tbody>
    </table>

</form>