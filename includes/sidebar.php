<?php include "includes/header_post.php"; ?>
<?php include "includes/db.php"; ?>

<?php



if(ifItIsMethodf('post')){

    if(isset($_POST['submit_access'])){

if(isset($_POST['username']) && isset($_POST['password'])){

    login_user($_POST['username'],$_POST['password']);

} else {


    redirect('/blog/registration');
    
}


}

}

?>



<div class="col-md-4">

<!-- Blog Search Well -->
<div class="well">
    <h4>Course Search</h4>
    <form action="search.php" method="post">
    <div class="input-group">
        <input name="search" type="text" class="form-control">
        <span class="input-group-btn">
            <button class="btn btn-default" name="submit" type="submit">
                <span class="glyphicon glyphicon-search"></span>
        </button>
        </span>
    </div>
    </form>
    <!-- /.input-group -->
</div>


<!-- Login Form -->
<div class="well">


<?php if(isset($_SESSION['user_role'])): ?>
    
    <h4>Logged in as: <?php echo $_SESSION['username']; ?></h4>
    <a href="/blog/includes/logout.php" class="btn btn-primary">Log Out</a>



<?php else: ?>
    
   
    <h4>Login Here!</h4>
    <form method="post">
    <div class="form-group">
        <input name="username" placeholder="Enter Username" type="text" class="form-control">
    </div>

    <div class="input-group">

    <input name="password" placeholder="Enter Password" type="password" class="form-control">

        <span class="input-group-btn">
            <button class="btn btn-success" name="submit_access" type="submit">
                Submit
        </button>
        </span>
    </div>

    <div class="form-group">
    
    <a href="forgot.php?forgot=<?php echo uniqid(); ?>">Forgot your Password?Click Here!</a>
    
    
    </div>  
    </form>
    <!-- /.input-group -->
 
    
    
    
    


<?php endif; ?>

</div> 






<!-- Blog Categories Well -->
<div class="well">
    <h4>Blog Categories</h4>
    <div class="row">
        <div class="col-lg-12">
        <ul class="list-unstyled">
        <?php

        $query = "SELECT * FROM category";
        $select_all_categories = mysqli_query($connection,$query);

        while($row = mysqli_fetch_assoc($select_all_categories)){

            $cat_title = $row['cat_title'];
            $cat_id = $row['cat_id'];

            echo "<li><a href='category.php?category=$cat_id'>$cat_title</a>
            </li>";
        }


        ?>

</ul>  
            
        </div>
        
        
    </div>
    <!-- /.row -->
</div>

<!-- Side Widget Well -->


</div>