<?php


 
if (isset($_GET['p_id'])) {
 
    $the_post_id = $_GET['p_id'];
 
}
 
$query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
$select_edit_posts = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_edit_posts)) {
 
    $post_id = $row['post_id'];
    $post_title = $row['post_title'];
    $post_author = $row['post_author'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_comment = $row['post_comment_count'];
    $post_content = $row['post_content'];
    $post_date = $row['post_date'];
}
 
if (isset($_POST['update_post'])) {
 
    $post_title = mysqli_escape_string($connection, $_POST['post_title']);
    $post_category_id = mysqli_escape_string($connection, $_POST['post_category']);
    $post_author = mysqli_escape_string($connection, $_POST['post_author']);
    // $post_user = mysqli_escape_string($connection, $_POST['post_user']);
    $post_status = mysqli_escape_string($connection, $_POST['post_status']);
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_tags = mysqli_escape_string($connection, $_POST['post_tags']);
    $post_content = mysqli_escape_string($connection, $_POST['post_content']);
 
    move_uploaded_file($post_image_temp, "../image/$post_image");
 
    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = {$post_category_id}, ";
    $query .= "post_author = '{$post_author}', ";
    // $query .= "post_user = '{$post_user}', ";
    $query .= "post_date = now(), ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_image = '{$post_image}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}' ";
    $query .= "WHERE post_id = {$the_post_id}";
 
// $query = "UPDATE posts SET ";
    // $query .= "post_title = '{$post_title}', ";
    // $query .= "post_author = '{$post_author}', ";
    // $query .= "post_category_id = {$post_category_id}, ";
    // $query .= "post_date = now(), ";
    // $query .= "post_status = '{$post_status}', ";
    // $query .= "post_tags = '{$post_tags}', ";
    // $query .= "post_content = '{$post_content}', ";
    // $query .= "post_image = '{$post_image}' ";
    // $query .= "WHERE post_id = {$the_post_id}";
 
    $update_posts = mysqli_query($connection, $query);
 
    if ($update_posts) {
 
      echo "<h4 style='color:green'>Post Updated: " . " " . "<a class= 'btn btn-success' href= 'posts.php'>View Posts</a></h4>";
    }
 
}
 
?>
 
<form action="" method="post" enctype="multipart/form-data">
 
  <div class="form-group">
 
    <label for="Post Title">Post Title</label>
    <input type="text" value="<?php echo $post_title; ?>" class="form-control" name="post_title"
      placeholder="Enter The Post Title">
 
  </div>
 
  <div class="form-group">
 
    <select name="post_category" id="">
 
 
      <?php
 
$query = "SELECT * FROM category";
$select_categories = mysqli_query($connection, $query);
while ($row = mysqli_fetch_assoc($select_categories)) {
 
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
 
    echo "<option value='$cat_id'>$cat_title</option>";
 
}
 
?>
    </select>
 
  </div>
 
  <div class="form-group">
 
    <label for="Post Author">Post Author</label>
    <input type="text" value="<?php echo $post_author; ?>" class="form-control" name="post_author"
      placeholder="Enter The Post Author">
 
  </div>

  <div class="form-group">

<label for="Select User">Select User</label>

<select class="form-control" name="po_user" id="">

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

</div> 
 
  <div class="form-group">
 
    <select name="post_status" id="">

    <option value="<?php echo $post_status; ?>"><?php echo $post_status; ?></option>

    <?php

    if($post_status == 'published'){

      echo "<option value ='draft'>Draft</option>";
    
    }else {

      echo "<option value ='published'>Publish</option>";


    }



   ?>


    </select>
 
  </div>
 
  <div class="form-group">
 
    <label for="Post Image">Post Image</label>
    <img width="100" src="../image/<?php echo $post_image; ?>" alt="">
    <input type="file" name="image">
 
  </div>
 
  <div class="form-group">
 
    <label for="Post Tags">Post Tags</label>
    <input type="text" value="<?php echo $post_tags; ?>" class="form-control" name="post_tags"
      placeholder="Enter The Post Tags">
 
  </div>
 
  <div class="form-group">
 
    <label for="Post Content">Post Content</label>
    <textarea id="body" cols="30" rows="10" class="form-control" name="post_content" placeholder="Enter The Post Content">
<?php echo $post_content; ?>
</textarea>
 
  </div>
 
  <input type="submit" class="btn btn-lg btn-primary" value="Update Post" name="update_post">
 
 
 
</form>