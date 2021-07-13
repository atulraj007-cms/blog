<form action="" method="post">
                       <div class="form-group">
                       
                        <label for="cat-title">Update Category</label>

                        <?php

                        if(isset($_GET['edit'])){

                            $edit = $_GET['edit'];

                            $query = "SELECT * FROM category WHERE cat_id = $edit ";
                            $edit_category = mysqli_query($connection,$query);

                            while($row = mysqli_fetch_assoc($edit_category)){
                                $cat_id = $row['cat_id'];
                                $cat_title = $row['cat_title'];

                                ?>

`<input type="text" value="<?php echo $cat_title; ?>" name="title" class="form-control" placeholder="Enter Category Title">
                          
                          <?php  }
                          
                        } ?>

                        <?php

                        if(isset($_POST['update_category'])){

                            $old_cat_title = $_POST['title'];

                            $stmt1 = mysqli_prepare($connection, "UPDATE category SET cat_title = ? WHERE cat_id = ? ");
                            mysqli_stmt_bind_param($stmt1, 'si', $old_cat_title, $cat_id);
                            mysqli_stmt_execute($stmt1);

                            header("Location: category.php");

                            mysqli_stmt_close($stmt);


                            // $query = "UPDATE category SET cat_title = '$old_cat_title' WHERE cat_id = '$cat_id' ";
                            // $update_query = mysqli_query($connection,$query);






                        }


                        ?>
                      
                       </div>

                       <div class="form-group">
                       
                        <input type="submit" name="update_category" value="Update Category" class="btn btn-primary">
                      
                       </div>
                       
                       </form>