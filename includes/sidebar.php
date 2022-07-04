<div class="col-md-4">
    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>
        <form action="search.php" method="post">
            <div class="input-group">
                <input type="text" name="search" class="form-control">
                <span class="input-group-btn">
                    <button class="btn btn-default" name="submit" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form>

        <!-- /.input-group -->
    </div>

    <!-- Login -->
    <div class="well">
        <h4>LogIn</h4>
        <form action="includes/login.php" method="post">
            <div class="form-group">
                <input type="text" name="user_name" class="form-control" placeholder="Enter User Name">
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Enter Password">
            </div>
            <button class="btn btn-primary" name="login">Submit</button>
        </form>

        <!-- /.input-group -->
    </div>

    <!-- Blog Categories Well -->
    <div class="well">
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php
                    $query = "SELECT * FROM category";
                    // $query = "SELECT * FROM category LIMIT 5";
                    $select_all_categories_sidebar = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_assoc($select_all_categories_sidebar)) {
                        $cat_id = $row['cat_id'];
                        $cat_title = $row['cat_title'];
                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}</a>
                                    </li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php" ?>


</div>