<?php include "includes/header_admin.php"; ?>



    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation_admin.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h2 class="page-header">
                           Welcome To The Admin Dashboard,
                            <small> <?php echo strtoupper($_SESSION['user_firstname']); ?> </small>
                        </h2>

                      
                      
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

                   
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



        <!-- COUNTING NUMBER OF POSTS ROWS -->                

<?php

// $query = "SELECT * FROM posts WHERE post_status= 'published' ";
// $select_all_post_query = mysqli_query($connection,$query);
// $count_post_rows = mysqli_num_rows($select_all_post_query);




?>
            
            
            <div class='huge'><?php echo $count_post_rows = recordCountposts(); ?></div>
                        <div>Posts</div>
                    </div>
                </div>
            </div>
            <a href="./posts.php">
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

       <!-- COUNTING NUMBER OF COMMENT ROWS -->                

<?php

// $query = "SELECT * FROM comments";
// $select_all_comments_query = mysqli_query($connection,$query);
// $count_comment_rows = mysqli_num_rows($select_all_comments_query);



?>


                     <div class='huge'><?php echo $count_comment_rows = recordCountComments(); ?></div>
                      <div>Comments</div>
                    </div>
                </div>
            </div>
            <a href="./comment.php">
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

      <!-- COUNTING NUMBER OF USERS ROWS -->                

      <?php

// $query = "SELECT * FROM users";
// $select_all_users_query = mysqli_query($connection,$query);
// $count_users_rows = mysqli_num_rows($select_all_users_query);



?>

                    <div class="col-xs-9 text-right">
                    <div class='huge'><?php echo $count_users_rows = recordCount(); ?></div>
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


       <!-- COUNTING NUMBER OF CATEGORY ROWS -->                

<?php

// $query = "SELECT * FROM category";
// $select_all_category_query = mysqli_query($connection,$query);
// $count_category_rows = mysqli_num_rows($select_all_category_query);


?>                   
                        <div class='huge'><?php echo $count_category_rows = recordCountCategories(); ?></div>
                         <div>Categories</div>
                    </div>
                </div>
            </div>
            <a href="category.php">
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

 

      
        <!-- /#page-wrapper -->


<?php

// $query = "SELECT * FROM posts WHERE post_status = 'draft' ";
// $draft_query = mysqli_query($connection,$query);
// $count_draft_rows = mysqli_num_rows($draft_query);
 $count_draft_rows = dashboardCount('posts', 'post_status', 'draft');

// $query = "SELECT * FROM comments WHERE comment_status = 'approved' ";
// $comment_query = mysqli_query($connection,$query);
 $count_approved_rows = dashboardCount('comments', 'comment_status', 'approved');

// $query = "SELECT * FROM users WHERE user_role = 'admin' ";
// $admin_query = mysqli_query($connection,$query);
 $count_admin_rows = dashboardCount('users', 'user_role', 'admin');

// $query = "SELECT * FROM users WHERE user_role = 'subscriber' ";
// $subscriber_query = mysqli_query($connection,$query);
$count_subscriber_rows = dashboardCount('users', 'user_role', 'subscriber');


?>


        <div class="row">

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Data', 'Count'],

            <?php

            $element_text = ['Active Posts', 'Draft Posts','Comments','Approved Comments', 'Category','Users','Admin Users','Subscribers'];
            $element_count = [$count_post_rows, $count_draft_rows, $count_comment_rows, $count_approved_rows, $count_category_rows, $count_users_rows, $count_admin_rows, $count_subscriber_rows];


            for($i=0; $i<8; $i++) { 

            echo "['$element_text[$i]'" . "," . "$element_count[$i]],";




            }




            ?>


        //   ['Posts', 1000],
         
        ]);

        var options = {
          chart: {
            title: 'Atuls CMS Data',
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