<?php

if(isset($_POST['create_post'])){

    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_author = $_POST['post_author'];
    $post_user = $_POST['post_user'];
    $post_status = $_POST['post_status'];

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_tags = $_POST['post_tags'];
    $post_content = $_POST['post_content'];
    $post_date = date('d-m-y');
    // $post_comment_count = 4;

    move_uploaded_file($post_image_temp,"../image/$post_image");


    $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_user, post_date, post_image, post_content, post_tags, post_status) ";
 
    $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', '{$post_user}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}') ";

    

    $create_post = mysqli_query($connection,$query);
    if($create_post){

        
        echo "<h4 style='color:green'>Post Published: " . " " . "<a class= 'btn btn-success' href= 'posts.php'>View Posts</a></h4>";
    }

}




?>








<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">

<label for="Post Title">Post Title</label>
<input type="text" class="form-control" name="post_title" placeholder="Enter The Post Title">

</div>

<div class="form-group">

<label for="Select Category">Select Category</label>

<select class="form-control" name="post_category" id="">

<option value=''>Select Category</option>

<?php

$query = "SELECT * FROM category";
$select_categories = mysqli_query($connection,$query);
while($row= mysqli_fetch_assoc($select_categories)){

$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];

echo "<option value='$cat_id'>$cat_title</option>";

}

?>
</select>

</div>

<!-- //functionality for users -->

<div class="form-group">

<label for="Select User">Select User</label>

<select class="form-control" name="post_user" id="">

<option value=''>Select User</option>

<?php

$query = "SELECT * FROM users";
$select_users = mysqli_query($connection,$query);
while($row= mysqli_fetch_assoc($select_users)){

$user_id = $row['user_id'];
$username = $row['username'];

echo "<option value='$username'>$username</option>";

}

?>
</select>

</div> <!-- end of users functionality -->


<div class="form-group">

<label for="Post Author">Post Author</label>
<input type="text" class="form-control" name="post_author" placeholder="Enter The Post Author">

</div>

<div class="form-group">

<label for="Post Status">Post Status: </label>

<select class="form-control" name="post_status" id="">
    
<option value="draft">Select Options</option>
<option value="draft">Draft</option>
<option value="published">Publish</option>


</select>

</div>

<div class="form-group">

<label for="Post Image">Post Image</label>
<input type="file" name="image">

</div>

<div class="form-group">

<label for="Post Tags">Post Tags</label>
<input type="text" class="form-control" name="post_tags" placeholder="Enter The Post Tags">

</div>

<div class="form-group">

<label for="Post Content">Post Content</label>
<textarea id="body" cols="30" rows="40" class="form-control" name="post_content" placeholder="Enter The Post Content">
</textarea>

</div>

<input type="submit" class="btn btn-lg btn-primary" value="Publish Post" name="create_post">



</form>