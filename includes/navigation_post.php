<?php include "includes/db.php"; ?>
<?php include "includes/header_post.php"; ?>





<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/blog/index.php">Blog</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

                <?php

                $query = "SELECT * FROM category";
                $select_all_category = mysqli_query($connection,$query);
                while($row = mysqli_fetch_array($select_all_category)){
                    
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                    $category_class = '';
                    $registration_class = '';
                    
                    $pageName = basename($_SERVER['PHP_SELF']);

                    $registration = 'registration.php';
                   

                    if(isset($_GET['category']) && $_GET['category']== $cat_id){

                        $category_class = 'active';

                    } elseif($pageName == $registration){

                        $registration_class = 'active';


                    }   


                    echo "<li class='$category_class'><a href='/blog/category/$cat_id'>$cat_title</a></li>";
                }

                ?>

                   <?php if (session_status() == PHP_SESSION_NONE) session_start(); ?>
                    <?php if(isLoggedIn()): ?> 

                        <li><a href="/blog/admin/index_admin.php">Admin</a></li>
                        <li><a href="/blog/includes/logout.php">Logout</a></li>


                    <?php else: ?>

                    <li><a href="/blog/login.php">Login</a></li>

                    <?php endif; ?>    

                        <li class='<?php echo $registration_class; ?>'><a href="/blog/registration">Register</a></li>

                <?php


                    if (session_status() == PHP_SESSION_NONE) session_start();
                    if(isset($_SESSION['username'])){

                        if(isset($_GET['p_id'])){

                            $the_post_id = $_GET['p_id'];


                            echo "<li><a href='admin/posts.php?source=edit_posts&p_id=$the_post_id'>Edit Post</a></li>";


                        }

                        
                    }




                ?>


                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>