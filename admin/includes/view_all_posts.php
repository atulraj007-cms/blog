<?php
 
if (isset($_POST['CheckBoxArray'])) {
 
 
    $CheckBoxArray = $_POST['CheckBoxArray'];
 
 
    foreach ($CheckBoxArray as $checkBoxValue) {
 
 
        $bulk_options = $_POST['bulk_options'];
 
        switch ($bulk_options) {
 
            case 'published':
 
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE post_id = $checkBoxValue ";
                $bulk_update_query = mysqli_query($connection, $query);
 
                break;
 
            case 'draft':
 
                $query = "UPDATE posts SET post_status = '$bulk_options' WHERE  post_id = $checkBoxValue ";
                $bulk_draft_query = mysqli_query($connection, $query);
                break;
 
            case 'delete':
 
                $query = "DELETE FROM posts WHERE post_id = $checkBoxValue ";
                $bulk_delete_query = mysqli_query($connection, $query);
                break;
 
            case 'clone':
 
                $query = "SELECT * FROM posts WHERE post_id = $checkBoxValue ";
                $select_clone_query = mysqli_query($connection, $query);
 
                while ($row = mysqli_fetch_assoc($select_clone_query)) {
 
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_author = $row['post_author'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }
 
                $query = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status ) ";
 
                $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}' ) ";
 
 
 
                $clone_post = mysqli_query($connection, $query);
        }
    }
}
 
 
 
 
 
 
 
?>
 
<form action="" method="post" style="overflow-x:scroll">
 
    <div id="bulkOptionsContainer" class="col-xs-4">
 
 
        <select class="form-control" id="" name="bulk_options">
 
 
            <option value="">Select Options</option>
            <option value="published">Publish</option>
            <option value="draft">Draft</option>
            <option value="delete">Delete</option>
            <option value="clone">Clone</option>
 
        </select>
 
    </div>
 
    <div class="col-xs-4">
 
        <input type="submit" class="btn btn-success" value="Apply" name="submit">
        <a href="posts.php?source=add_posts" class="btn btn-primary">Add Posts</a>
 
 
 
    </div>
 
 
 
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th> <input type="checkbox" id="SelectAllBoxes"></th>
                <th>Id</th>
                <th>Title</th>
                <th>Author</th>
                <th>User</th>
                <th>Category</th>
                <th>Status</th>
                <th>Image</th>
                <th>Tags</th>
                <th>Comments</th>
                <th>Content</th>
                <th>Date</th>
                <th>View Post</th>
             
                <th>Action1</th>
                <th>Action2</th>
            </tr>
        </thead>
        <tbody>
 
            <?php
 
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $select_posts = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($select_posts)) {
 
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];
                $post_author = $row['post_author'];
                $post_user = $row['post_user'];
 
                $post_category_id = $row['post_category_id'];
 
                $post_status = $row['post_status'];
                $post_image = $row['post_image'];
                $post_tags = $row['post_tags'];
                $post_comment = $row['post_comment_count'];
                $post_content = $row['post_content'];
                $post_date = $row['post_date'];
                $post_view_count = $row['post_views_count'];
 
                echo "<tr>";
            ?>
 
                <td><input type="checkbox" class="checboxes" name="CheckBoxArray[]" value="<?php echo $post_id; ?>"></td>
 
                <?php
                echo "<td>$post_id</td>";
                echo "<td>$post_title</td>";
                echo "<td>$post_author</td>";
                echo "<td>$post_user</td>";
 
 
                $query = "SELECT * FROM category WHERE cat_id = $post_category_id ";
                $selecting_categories = mysqli_query($connection, $query);
                while ($row = mysqli_fetch_assoc($selecting_categories)) {
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];
 
 
                    echo "<td>$cat_title</td>";
                }
 
 
                echo "<td>$post_status</td>";
                echo "<td><img width='100' src='../image/$post_image'</td>";
                echo "<td>$post_tags</td>";
 
 
 
                $post_count_query = "SELECT * FROM comments WHERE comment_post_id = $post_id ";
                $count_query = mysqli_query($connection, $post_count_query);
                $count_comment = mysqli_num_rows($count_query);
 
 
 
                echo "<td><a href='post_comments.php?id=$post_id'>$count_comment</a></td>";
 
 
 
 
 
                echo "<td>$post_content</td>";
                echo "<td>$post_date</td>";
                echo "<td><a class='btn btn-info' href='../post.php?p_id={$post_id}'>View Posts</a></td>";
                // echo "<td><a href='posts.php?reset={$post_id}'>$post_view_count</a></td>";
                echo "<td><a class='btn btn-primary' href='posts.php?source=edit_posts&p_id={$post_id}'>Edit</a></td>";
 
                ?>
                <td>
                    <form action="" method="post">
 
                        <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
 
 
                        <input class='btn btn-danger' type='submit' value='delete' name='delete'>
                    </form>
                </td>
 
 
 
 
            <?php
 
 
 
                // echo "<td><a onclick=\"return confirm('Are you sure you want to delete?');\" href='posts.php?delete={$post_id}'>Delete</a></td>";
 
                echo "</tr>";
            }
 
 
            ?>
 
            <?php
 
 
            if (isset($_POST['delete'])) {
 
                // if(isset($_SESSION['user_role'])){
 
                //     if($_SESSION['user_role']== 'admin'){
 
                $the_post_id = $_POST['post_id'];
 
                $query = "DELETE FROM posts WHERE post_id = $the_post_id ";
                $delete_query = mysqli_query($connection, $query);
                header("Location: posts.php");
            }
            //     }
            // }
 
            if (isset($_GET['reset'])) {
 
                $the_reset_id = $_GET['reset'];
 
                $query = "UPDATE posts SET post_views_count = 0 WHERE post_id = $the_reset_id ";
                $reset_query = mysqli_query($connection, $query);
                header("Location: posts.php");
            }
 
 
 
 
 
            ?>
 
 
 
 
        </tbody>
    </table>
 
</form>