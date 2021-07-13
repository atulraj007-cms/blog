<?php include "includes/header_post.php"; ?>
<?php include "includes/db.php"; ?>


    <!-- Navigation -->
        <?php include "includes/navigation_post.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php
            
            if(isset($_GET['category'])){

            $the_category_id = $_GET['category'];

            if(isset($_SESSION['user_role']) && $_SESSION['user_role']== 'admin' ){

                $stmt1 = mysqli_prepare($connection, "SELECT post_id,post_title,post_author,post_date,post_image,post_content FROM posts WHERE post_category_id = ?");

             } else {

                $stmt2 = mysqli_prepare($connection, "SELECT post_id,post_title,post_author,post_date,post_image,post_content FROM posts WHERE post_category_id = ? AND post_status = ?");
                $published = 'published';
             }

             if(isset($stmt1)){

                mysqli_stmt_bind_param($stmt1, "i", $the_category_id);
                mysqli_stmt_execute($stmt1);
                mysqli_stmt_bind_result($stmt1, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

                $stmt = $stmt1;
             
            } else {


                mysqli_stmt_bind_param($stmt2, "is", $the_category_id, $published);
                mysqli_stmt_execute($stmt2);
                mysqli_stmt_bind_result($stmt2, $post_id, $post_title, $post_author, $post_date, $post_image, $post_content);

                $stmt = $stmt2;




            } 


    
            // $select_all_post = mysqli_query($connection,$query);
            // if(mysqli_stmt_num_rows($stmt) == 0){

            //     echo "<h3 class='text-center'>No Posts available for the Category Selected!</h3>";

            // } 

                while(mysqli_stmt_fetch($stmt)):

            // while($row = mysqli_fetch_assoc($select_all_post)){
            //     $post_id = $row['post_id'];
            //     $post_title = $row['post_title'];
            //     $post_author = $row['post_author'];
            //     $post_date = $row['post_date'];
            //     $post_image = $row['post_image'];
            //     $post_content = substr($row['post_content'],0,50);

                ?>

                <!-- <h1 class="page-header">
                   Welcome to
                    <small>IT courses</small>
                </h1> -->

                <!-- First Blog Post -->
                <h2>
                    <a href="post.php?p_id=<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="/blog/image/<?php echo $post_image; ?>" alt="">
                </a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <!-- Second Blog Post -->
            

                <!-- Third Blog Post -->
            

                <!-- Pager -->
             <?php endwhile; }  
             
             
             else {
                 
                 header("Location: index.php");
                 
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