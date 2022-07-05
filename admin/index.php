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
                        <small><?php echo $_SESSION['username'] ?></small>
                    </h1>
                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM post";
                                    $select_all_post = mysqli_query($conn, $query);
                                    $post_counts = mysqli_num_rows($select_all_post);
                                    echo "<div class='huge'>{$post_counts}</div>"
                                    ?>
                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="posts.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM comments";
                                    $select_all_comments = mysqli_query($conn, $query);
                                    $comments_counts = mysqli_num_rows($select_all_comments);
                                    echo "<div class='huge'>{$comments_counts}</div>"
                                    ?>
                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM users";
                                    $select_all_users = mysqli_query($conn, $query);
                                    $users_counts = mysqli_num_rows($select_all_users);
                                    echo "<div class='huge'>{$users_counts}</div>"
                                    ?>
                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $query = "SELECT * FROM category";
                                    $select_all_category = mysqli_query($conn, $query);
                                    $category_counts = mysqli_num_rows($select_all_category);
                                    echo "<div class='huge'>{$category_counts}</div>"
                                    ?>
                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->

            <?php
            $query = "SELECT * FROM post WHERE post_status = 'draft' ";
            $select_draft_post = mysqli_query($conn, $query);
            $post_draft_counts = mysqli_num_rows($select_draft_post);

            $query = "SELECT * FROM comments WHERE comment_status = 'unapprove' ";
            $select_unapproved_comments = mysqli_query($conn, $query);
            $comments_unapproved_counts = mysqli_num_rows($select_unapproved_comments);

            $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
            $select_users_subscribers = mysqli_query($conn, $query);
            $users_subscribers_counts = mysqli_num_rows($select_users_subscribers);

            ?>
            <div class="row">
                <script type="text/javascript">
                    google.charts.load('current', {
                        'packages': ['bar']
                    });
                    google.charts.setOnLoadCallback(drawChart);

                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],
                            <?php
                            $element_text = ['Active_Posts','Draft Post', 'Categories', 'Users', 'User Subcribers', 'Comments', 'Unapproved Comments'];
                            $element_count = [$post_counts, $post_draft_counts, $category_counts, $users_counts, $users_subscribers_counts, $comments_counts, $comments_unapproved_counts,];
                            for ($i = 0; $i < 7; $i++) {
                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";
                            }
                            ?>
                            // ['posts', 1000],
                            //                     ['Year', 'Sales',],
                            //   ['2014', 1000,],
                            //   ['2015', 1170,],
                            //   ['2016', 660, ],
                            //   ['2017', 1030,]
                        ]);

                        var options = {
                            chart: {
                                title: '',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, google.charts.Bar.convertOptions(options));
                    }
                </script>
                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>
            </div>


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php include "includes/admin_footer.php" ?>