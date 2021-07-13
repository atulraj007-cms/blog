
                     <table class="table table-bordered table-hover">
                         <thead>
                             <tr>
                                 <th>Id</th>
                                 <th>Username</th>
                                 <th>First Name</th>
                                 <th>Last Name</th>
                                 <th>Email</th>
                                 <th>Date</th>
                                 <th>Role</th>
                                 <th>Subscriber</th>
                                 <th>Admin</th>
                                 <th>Action2</th>
                                 <th>Action1</th>
                             </tr>
                         </thead>
                         <tbody>
                             
                             <?php

                            $query ="SELECT * FROM users";
                            $select_users = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select_users)){

                                $user_id = $row['user_id'];
                                $username = $row['username'];
                                $user_fname = $row['user_firstname'];
                                $user_lname = $row['user_lastname'];
                                $user_email = $row['user_email'];
                                $user_image = $row['user_image'];
                                $user_date = $row['user_date'];
                                $user_role = $row['user_role'];
                                
                                
                                echo "<tr>";
                                echo "<td>$user_id</td>";
                                echo "<td>$username</td>";
                                echo "<td>$user_fname</td>";
                                echo "<td>$user_lname</td>";

                                echo "<td>$user_email</td>";
                                echo "<td>$user_date</td>";
                                echo "<td>$user_role</td>";


                                // $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                                // $selecting_post = mysqli_query($connection,$query);
                                // while($row = mysqli_fetch_assoc($selecting_post)){
                                // $post_id = $row['post_id'];
                                // $post_title = $row['post_title']; 


                                // echo "<td><a href = '../post.php?p_id=$post_id'>$post_title</a></td>";

                                // }  




            
                                echo "<td><a class='btn btn-info' href='users.php?subscriber={$user_id}'>Subscriber</a></td>";
                                echo "<td><a class='btn btn-primary' href='users.php?admin={$user_id}'>Admin</a></td>";
                                echo "<td><a class='btn btn-warning' href='users.php?source=edit_users&edit_user=$user_id'>Edit</a></td>";
                                echo "<td><a class='btn btn-danger' href='./users.php?delete={$user_id}'>Delete</a></td>";
                                
                                echo "</tr>";



                            }


                            ?>

                            <?php
                            
                            if(isset($_GET['subscriber'])){

                                $subscriber_id = $_GET['subscriber'];

                                $query = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $subscriber_id ";
                                $subscriber_query = mysqli_query($connection,$query);
                                header("Location: users.php");

                            }
                            
                            if(isset($_GET['admin'])){

                                $admin_id = $_GET['admin'];

                                $query = "UPDATE users SET user_role = 'admin' WHERE user_id = $admin_id ";
                                $admin_query = mysqli_query($connection,$query);
                                header("Location: users.php");

                            }


                            if(isset($_GET['delete'])){

                                if(isset($_SESSION['user_role'])){

                                    if($_SESSION['user_role']== 'admin'){

                                $the_user_id = mysqli_escape_string($connection,$_GET['delete']);

                                $query = "DELETE FROM users WHERE user_id = $the_user_id ";
                                $delete_query = mysqli_query($connection,$query);
                                header("Location: users.php");

                            }

                        } 
                    }       



                            ?>
                                 
                                  
                                
                            
                         </tbody>
                     </table>