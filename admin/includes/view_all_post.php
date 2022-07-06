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

            <div id="bulkOptionContainer"style="padding: 0px; padding-bottom: 10px;" class="col-xs-4">
                <select class="form-control" name="bluk_options" id="">
                    <option value="">Select Options</option>
                    <option value="publishe">Publish</option>
                    <option value="draft">Draft</option>
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
                <th>View Post</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php findAllPost();
            deletePost(); ?>

        </tbody>
    </table>

</form>

