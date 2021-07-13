<?php include "includes/header_admin.php"; ?>

<?php

if(isset($_SESSION['username'])){

    $username_session = $_SESSION['username'];

    $query = "SELECT * FROM users WHERE username = '$username_session' ";
    $username_query = mysqli_query($connection,$query);

    while($row = mysqli_fetch_assoc($username_query)){

        $user_id = $row['user_id'];
        $username_session = $row['username'];
        $user_fname_session = $row['user_firstname'];
        $user_lname_session = $row['user_lastname'];
        $user_email_session = $row['user_email'];
        $user_image_session = $row['user_image'];
        $user_password_session = $row['user_password'];
        $user_role_session = $row['user_role'];
    
        }
}



?>

<?php

if(isset($_POST['update_profile'])){

    $username = mysqli_escape_string($connection, $_POST['username']);
    $user_fname = mysqli_escape_string($connection, $_POST['user_fname']);
    $user_lname = mysqli_escape_string($connection, $_POST['user_lname']);
    $user_role = mysqli_escape_string($connection, $_POST['user_role']);
    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];
    $user_email = mysqli_escape_string($connection, $_POST['user_email']);
    $user_password = mysqli_escape_string($connection, $_POST['user_password']);
 
    // move_uploaded_file($post_image_temp, "../image/$post_image");
 
    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_firstname = '{$user_fname}', ";
    $query .= "user_lastname = '{$user_lname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$user_password}' ";
    $query .= "WHERE username = '{$username_session}' ";

    $update_profile_query = mysqli_query($connection,$query);
    if(!$update_profile_query){

        die("database error".mysqli_error($connection));
    }




}

?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/navigation_admin.php"; ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                           Welcome To Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>

                        <form action="" method="post" enctype="multipart/form-data">


<div class="form-group">

<label for="">Username</label>
<input type="text" class="form-control" value="<?php echo $username_session;?>"  name="username">

</div>


<div class="form-group">

<label for="">First Name</label>
<input type="text" class="form-control" value="<?php echo $user_fname_session;?>" name="user_fname" >

</div>

<div class="form-group">

<label for="">Lastname</label>
<input type="text" class="form-control"  value="<?php echo $user_lname_session;?>" name="user_lname" >

</div>

<div class="form-group">

<select name="user_role" id="">

<option value='subscriber'><?php echo $user_role_session;?></option>

</select>

</div>


<div class="form-group">

<label for="">Email</label>
<input type="text" class="form-control" value="<?php echo $user_email_session;?>" name="user_email" >

</div>


<div class="form-group">

<label for="">Password</label>
<input type="password" class="form-control" autocomplete="off" name="user_password">

</div>



<!-- <div class="form-group">

<label for="User Image">User Image</label>
<input type="file" name="image">

</div> -->




<input type="submit" class="btn btn-lg btn-primary" value="Update Profile" name="update_profile">



</form>





                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/footer_admin.php"; ?>