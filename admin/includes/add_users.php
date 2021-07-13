<?php

if(isset($_POST['create_user'])){

    $username = $_POST['username'];
    $user_fname = $_POST['user_fname'];
    $user_lname = $_POST['user_lname'];
    $user_role = $_POST['user_role'];
    $user_password = $_POST['user_password'];

    // $user_image = $_FILES['image']['name'];
    // $user_image_temp = $_FILES['image']['tmp_name'];

    $user_email = $_POST['user_email'];
 
    $user_date = date('d-m-y');
    // $post_comment_count = 4;

    // move_uploaded_file($user_image_temp,"../image/$user_image");

// $query = "SELECT randSalt FROM users ";
// $select_randsalt_query = mysqli_query($connection,$query);

// $row = mysqli_fetch_array($select_randsalt_query);
// $salt = $row['randSalt'];

$user_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 10));


    $query = "INSERT INTO users(username, user_firstname, user_lastname, user_role, user_email, user_password, user_date ) ";
 
    $query .= "VALUES('{$username}', '{$user_fname}', '{$user_lname}', '{$user_role}', '{$user_email}', '{$user_password}', now() ) ";

    $add_post_query = mysqli_query($connection,$query);

    if($add_post_query){

        echo "<h4 style='color:green'>Users Created: " . " " . "<a class= 'btn btn-success' href= 'users.php'>View Users</a></h4>";
    }

}




?>








<form action="" method="post" enctype="multipart/form-data">


<div class="form-group">

<label for="">Username</label>
<input type="text" class="form-control" name="username" placeholder="Enter Username" required>

</div>


<div class="form-group">

<label for="">First Name</label>
<input type="text" class="form-control" name="user_fname" placeholder="Enter Firstname" required>

</div>

<div class="form-group">

<label for="">Lastname</label>
<input type="text" class="form-control" name="user_lname" placeholder="Enter Lastname" required>

</div>

<div class="form-group">

<label for="">User Role</label>
<select name="user_role" class="form-control" id="">

<option value=''>Select Role</option>
<option value='admin'>Admin</option>
<option value='subscriber'>Subscriber</option>

</select>

</div>


<div class="form-group">

<label for="">Email</label>
<input type="text" class="form-control" name="user_email" placeholder="Enter Email" required>

</div>


<div class="form-group">

<label for="">Password</label>
<input type="password" class="form-control" name="user_password" placeholder="Enter Password" required>

</div>



<!-- <div class="form-group">

<label for="User Image">User Image</label>
<input type="file" name="image">

</div> -->




<input type="submit" class="btn btn-lg btn-primary" value="Add User" name="create_user">



</form>