<?php ob_start(); ?>


    <!-- Navigation -->
        <?php include "includes/navigation_post.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php

if(isset($_POST['submit'])){

 $search = $_POST['search'];

 $query = "SELECT * FROM posts WHERE post_tags LIKE '%$search%' ";
 $search_query = mysqli_query($connection,$query);

 $count = mysqli_num_rows($search_query);
 if($count == 0){

    echo "No results";
 } else {
            while($row = mysqli_fetch_assoc($search_query)){

                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];

                ?>

                <!-- <h1 class="page-header">
                   Welcome to
                    <small>IT courses</small>
                </h1> -->

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="image/<?php echo $post_image; ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <!-- Second Blog Post -->
            

                <!-- Third Blog Post -->
            

                <!-- Pager -->
             <?php } 

 }
 
}



?>

            
            </div>

            <!-- Blog Sidebar Widgets Column -->
          <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer_post.php"; ?>