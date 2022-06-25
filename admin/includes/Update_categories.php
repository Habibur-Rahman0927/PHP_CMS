                                                    <form action="" method="post">
                                                        <div class="form-group">
                                                            <label for="cat_title">Update Category Title</label>
                                                            <?php 
                                                                if(isset($_GET['edit'])){
                                                                    $cat_id = $_GET['edit'];
                                                                    $query = "SELECT * FROM category WHERE cat_id = $cat_id ";
                                                                    $select_categoris_id = mysqli_query($conn, $query);

                                                                    while($row = mysqli_fetch_assoc($select_categoris_id)){
                                                                        $cat_id = $row['cat_id'];
                                                                        $cat_title = $row['cat_title'];
                                                                        ?>

                                                                        <input type="text" value="<?php if(isset($cat_title)){echo $cat_title;}?>" class="form-control" name="cat_title" id="">

                                                                    <?php }}?>

                                                                <?php
                                                                    if(isset($_POST['edit_categories'])){
                                                                        $cat_title = $_POST['cat_title'];
                                                                        $query = "UPDATE category SET cat_title = '{$cat_title}' WHERE cat_id = {$cat_id} ";
                                                                        $update_query = mysqli_query($conn, $query);
                                                                        header("Location: categories.php");
                                                                    }
                                                                ?>                                        
                                                        </div>
                                                        
                                                        <div class="form-group">
                                                            <input type="submit" class="btn btn-primary" name="edit_categories" value="Update Category" id="">
                                                        </div>

                                                    </form>