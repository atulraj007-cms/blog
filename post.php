<?php include "includes/header_post.php"; ?>
<?php ob_start(); ?>
<?php include "includes/db.php"; ?>


    <!-- Navigation -->
        <?php include "includes/navigation_post.php"; ?>



   <?php
   
   if(isset($_POST['liked'])){

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

  //1= Select The Post

  $query = "SELECT * FROM posts WHERE post_id= {$post_id} ";
  $postResult = mysqli_query($connection,$query); 
  $post = mysqli_fetch_array($postResult);
  $likes = $post['post_likes'];

 //2= Then Update Post With Likes
 
 mysqli_query($connection,"UPDATE posts SET post_likes = $likes+1 WHERE post_id= {$post_id} ");

//3= Create Likes For Posts

mysqli_query($connection,"INSERT INTO likes(user_id,post_id) VALUES({$user_id},{$post_id})");


}

 
if(isset($_POST['unliked'])) { 

    $post_id = $_POST['post_id'];
    $user_id = $_POST['user_id'];

  //1= Select The Post

  $query = "SELECT * FROM posts WHERE post_id=$post_id";
  $postResult = mysqli_query($connection,$query); 
  $post = mysqli_fetch_array($postResult);
  $likes = $post['post_likes'];

  //2=Delete the like

 mysqli_query($connection,"DELETE FROM likes WHERE post_id=$post_id AND user_id=$user_id");

 //2= Then Update Post With Likes
 
 mysqli_query($connection,"UPDATE posts SET post_likes = $likes-1 WHERE post_id=$post_id");


 }


   ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

            <?php

            if(isset($_GET['p_id'])){

            $the_post_id = $_GET['p_id'];

             $query = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $the_post_id ";
             $post_count_query = mysqli_query($connection,$query); 
             
             
             if(isset($_SESSION['user_role']) && $_SESSION['user_role']== 'admin' ){

                $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";

             } else {

                $query = "SELECT * FROM posts WHERE post_id = $the_post_id AND post_status = 'published'";
             }


           
            $select_all_post = mysqli_query($connection,$query);

            $count = mysqli_num_rows($select_all_post);
            if($count < 1){

                echo "<h3 class='text-center'>No Posts, Sorry!</h3>";

            } else {



            while($row = mysqli_fetch_assoc($select_all_post)){
                $post_id = $row['post_id'];
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
                <img class="img-responsive" src="/blog/image/<?php echo ImagePlaceholder($post_image); ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>

                <hr>

                <?php if(isLoggedIn()){ ?>


                <div class="row">
                
                <p class="pull-right"><a 
                class="<?php echo UserLikedThisPost($the_post_id) ?'unlike' : 'like'; ?>" 
                href=""><span class="glyphicon glyphicon-thumbs-up" 
                
                data-toggle="tooltip";
                data-placement="top";
                title="<?php echo UserLikedThisPost($the_post_id) ?'You Have Liked This Before' : 'Want To Like It?Click On Like'; ?>"
                >
                
                </span> 
                <?php echo UserLikedThisPost($the_post_id) ? 'Unlike' : 'Like'; ?></a></p>

                </div>


                <?php } else { ?>
                
                
                
                <div class="row">
                
                <p class="likes"> You need to <a href="/blog/login.php"> Login</a> to Like</p>

                </div>
                
                
                
               <?php  } ?>

               

               

                <div class="row">
                
                <p style="color:green" class="likes pull-right">Total Like: <?php getAllLikes($the_post_id); ?></a></p>

                </div>
                

                <hr>

                <!-- Second Blog Post -->
            

                <!-- Third Blog Post -->
            

                <!-- Pager -->
             <?php }  ?> 


             <?php

                if(isset($_POST['create_comment'])){

                    $the_post_id = $_GET['p_id'];
                
                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    $query = "INSERT INTO comments(comment_post_id, comment_date, comment_author,comment_email,comment_content,comment_status) ";
                    $query .= "VALUES($the_post_id,now(),'$comment_author','$comment_email','$comment_content','unapproved') ";
                    $create_comment_query = mysqli_query($connection,$query);
                    
                    if($create_comment_query){

                        echo "<h4 style='color:green'>Your Comment Has Been Submitted</h4>";
                    }

                    

                    // $query = "UPDATE posts SET post_comment_count = post_comment_count + 1 ";
                    // $query .= "WHERE post_id = $the_post_id ";
                    // $update_comment_query = mysqli_query($connection,$query);



                }


            ?>


                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form role="form" action="" method="post">

                        <div class="form-group">
                        <label for="">Author</label>
                            <input type="text" class="form-control" name="comment_author" required>
                        </div>

                        <div class="form-group">
                        <label for="">Email</label>
                            <input type="email" class="form-control" name="comment_email" required>
                        </div>

                        <div class="form-group">
                        <label for="">Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3" required></textarea>
                        </div>

                        <input type="submit" value="Submit" name="create_comment" class="btn btn-primary">
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->

                <?php

                    $query = "SELECT* FROM comments WHERE comment_post_id = $the_post_id AND comment_status = 'approved' ";
                    $query .= "ORDER BY comment_id DESC ";
                    $comment_fetch_query = mysqli_query($connection,$query);
                    while($row = mysqli_fetch_assoc($comment_fetch_query)){

                        $comment_author = $row['comment_author'];
                        $comment_content = $row['comment_content'];
                        $comment_date = $row['comment_date'];
            

                    ?>


                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 style="font-family:cursive" class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div>

                <?php } } } else{
                    
                    header("Location:index.php");
                    
                }
                    ?>

                <!-- Comment -->
                <!-- <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading">Start Bootstrap
                            <small>August 25, 2014 at 9:30 PM</small>
                        </h4>
                        Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                        <Nested Comment -->
                        <!-- <div class="media">
                            <a class="pull-left" href="#">
                                <img class="media-object" src="http://placehold.it/64x64" alt="">
                            </a>
                            <div class="media-body">
                                <h4 class="media-heading">Nested Start Bootstrap
                                    <small>August 25, 2014 at 9:30 PM</small>
                                </h4>
                                Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo. Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia congue felis in faucibus.
                            </div>
                        </div>
                    End Nested Comment -->
                    <!-- </div>
                </div>  -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
          <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <!-- Footer -->
        <?php include "includes/footer_post.php"; ?>

        <script>
    $(document).ready(function(){

            $("[data-toggle='tooltip']").tooltip();
            var post_id = <?php echo $the_post_id;?>;
            var user_id=<?php echo LoggedInUser(); ?>
 
        //LIKE
        $('.like').click(function(){
            $.ajax({
                url:"/blog/post.php?p_id=<?php echo $the_post_id; ?>",
                type: 'post', 
                data: {
                    'liked': 1,
                    'post_id': post_id,
                    'user_id': user_id
                }               
            });
        });
 
        //UNLIKE
        $('.unlike').click(function(){
            $.ajax({
                url:"/blog/post.php?p_id=<?php echo $the_post_id; ?>",
                type: 'post', 
                data: {
                    'unliked': 1,
                    'post_id': post_id,
                    'user_id': user_id
                }               
            });
        });
    });
 
 
 
</script>