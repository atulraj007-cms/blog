<?php

if(isset($_GET['edit_user'])){

    $get_user_id = $_GET['edit_user'];

    $query ="SELECT * FROM users WHERE user_id = $get_user_id ";
    $select_users_id = mysqli_query($connection,$query);
    while($row = mysqli_fetch_assoc($select_users_id)){

    $user_id = $row['user_id'];
    $username = $row['username'];
    $user_fname = $row['user_firstname'];
    $user_lname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_image = $row['user_image'];
    $user_password = $row['user_password'];
    $user_role = $row['user_role'];

    }
    


}

if(isset($_POST['update_user'])){
 
    $username = mysqli_escape_string($connection, $_POST['username']);
    $user_fname = mysqli_escape_string($connection, $_POST['user_fname']);
    $user_lname = mysqli_escape_string($connection, $_POST['user_lname']);
    $user_role = mysqli_escape_string($connection, $_POST['user_role']);
    // $post_image = $_FILES['image']['name'];
    // $post_image_temp = $_FILES['image']['tmp_name'];
    $user_email = mysqli_escape_string($connection, $_POST['user_email']);
    $user_password = mysqli_escape_string($connection, $_POST['user_password']);
 
    // move_uploaded_file($post_image_temp, "../image/$post_image");
    $hashed_password = password_hash($user_password,PASSWORD_BCRYPT,array('cost' => 10));
   
 
    $query = "UPDATE users SET ";
    $query .= "username = '{$username}', ";
    $query .= "user_firstname = '{$user_fname}', ";
    $query .= "user_lastname = '{$user_lname}', ";
    $query .= "user_role = '{$user_role}', ";
    $query .= "user_email = '{$user_email}', ";
    $query .= "user_password = '{$hashed_password}' ";
    $query .= "WHERE user_id = {$get_user_id} ";

    $update_user_query = mysqli_query($connection,$query);

    if($update_user_query){

        echo "<h5>Post Updated.<a href='users.php'>See Users Here</a></h5>";
    }

}



?>








<form action="" method="post" enctype="multipart/form-data">


<div class="form-group">

<label for="">Username</label>
<input type="text" class="form-control" value="<?php echo $username; ?>" name="username">

</div>


<div class="form-group">

<label for="">First Name</label>
<input type="text" class="form-control" value="<?php echo $user_fname; ?>" name="user_fname" >

</div>

<div class="form-group">

<label for="">Lastname</label>
<input type="text" class="form-control"  value="<?php echo $user_lname; ?>" name="user_lname" >

</div>

<div class="form-group">

<label for="">User Role</label>
<select name="user_role" class="form-control" id="">

<option value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>

<?php

if($user_role == 'subscriber'){

    echo "<option value='admin'>admin</option>";

} else{

    echo "<option value='subscriber'>subscriber</option>";
}



?>




</select>

</div>


<div class="form-group">

<label for="">Email</label>
<input type="text" class="form-control" value="<?php echo $user_email; ?>" name="user_email" >

</div>


<div class="form-group">

<label for="">Password</label>
<input type="password" class="form-control" autocomplete="off" name="user_password">

</div>



<!-- <div class="form-group">

<label for="User Image">User Image</label>
<input type="file" name="image">

</div> -->




<input type="submit" class="btn btn-lg btn-primary" value="Update Details" name="update_user">



</form>

