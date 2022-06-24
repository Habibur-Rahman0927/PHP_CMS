<?php include "includes/admin_header.php" ?>
    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?> 

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            WelCome to Admin
                            <small>Author Name</small>
                        </h1>
                        <div class="col-xs-6">
                            <?php
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



                            ?>



                            <form action="" method="post">
                                <div class="form-group">
                                    <label for="cat_title">Category Title</label>
                                    <input type="text" class="form-control" name="cat_title" id="">
                                </div>
                                
                                <div class="form-group">
                                    <input type="submit" class="btn btn-primary" name="submit" value="Add Category" id="">
                                </div>

                            </form>
                        </div>
                        <div class="col-xs-6">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category Title</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $query = "SELECT * FROM category";
                                        // $query = "SELECT * FROM category LIMIT 5";
                                        $select_all_categories_sidebar = mysqli_query($conn, $query);

                                        while($row = mysqli_fetch_assoc($select_all_categories_sidebar)){
                                            $cat_id = $row['cat_id'];
                                            $cat_title = $row['cat_title'];
                                            echo "<tr>";
                                            echo "<td>{$cat_id}</td>";
                                            echo "<td>{$cat_title}</td>";
                                            echo "</tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
<?php include "includes/admin_footer.php" ?>
