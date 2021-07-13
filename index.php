<?php include "includes/header_post.php"; ?>
<?php include "includes/db.php"; ?>
<?php ob_start(); ?>


    <!-- Navigation -->
        <?php include "includes/navigation_post.php"; ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

          

            <?php

            $page = '0';

            if(isset($_GET['page'])){
               $page = $_GET['page'];  
            } 

            if ($page == 0 || $page == 1) {
 
                $page_1 = 0;

            } else {

               
                $page_1 = (($page) * 5) - 5;
                
            }

            if(isset($_SESSION['user_role']) && $_SESSION['user_role']== 'admin' ){

                $pagination_query = "SELECT * FROM posts";

             } else {

                $pagination_query = "SELECT * FROM posts WHERE post_status = 'published' ";
             }
           
            $post_count_query = mysqli_query($connection, $pagination_query);
            $count = mysqli_num_rows($post_count_query);
            if($count < 1){

                echo "<h3 class='text-center'>No Posts, Sorry!</h3>";
            }

            else { 

            $count = ceil($count/5);


            $query = "SELECT * FROM posts LIMIT $page_1,5 ";
            $select_all_post = mysqli_query($connection,$query);
            while($row = mysqli_fetch_assoc($select_all_post)){

                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = substr($row['post_content'],0,450);
                $post_status = $row['post_status'];



                ?>

                <!-- <h1 class="page-header">
                   Welcome to
                    <small>IT courses</small>
                </h1> -->

                <!-- First Blog Post -->
                
                <h2>
                    <a href="post/<?php echo $post_id; ?>"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="author_post.php?author=<?php echo $post_author; ?>"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
              
                <a href="post.php?p_id=<?php echo $post_id; ?>">
                <img class="img-responsive" src="/blog/image/<?php echo ImagePlaceholder($post_image); ?>" alt="">
                </a>
            
                <p><?php echo $post_content; ?>...</p>
                <a class="btn btn-primary" href="post.php?p_id=<?php echo $post_id; ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

                <hr>

                <!-- Second Blog Post -->
            

                <!-- Third Blog Post -->
            

                <!-- Pager -->
             <?php }  } ?> 

            </div>

            <!-- Blog Sidebar Widgets Column -->
          <?php include "includes/sidebar.php"; ?>

        

        </div>
        <!-- /.row -->

        <hr>

        <ul class="pager">
        
        
        <?php

        for($i=1; $i<=$count; $i++){


            if($i == $page){

                echo "<li class='active'><a href='index.php?page={$i}'>$i</a></li>";

            }else {

            echo "<li><a href='index.php?page={$i}'>$i</a></li>";

            }

        }


        ?>

     
       

        </ul>

        <!-- Footer -->
        <?php include "includes/footer_post.php"; ?>