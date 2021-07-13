<?php include "includes/header_admin.php"; ?>

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
                            <small>author</small>
                        </h1>

                     <table class="table table-bordered table-hover">
                         <thead>
                             <tr>
                                 <th>Id</th>
                                 <th>Author</th>
                                 <th>Comment Content</th>
                                 <th>Status</th>
                                 <th>Email</th>
                                 <th>Date</th>
                                 <th>In Response to</th>
                                 <th>Approved</th>
                                 <th>Unapproved</th>

                                 <th>Action1</th>
                             </tr>
                         </thead>
                         <tbody>
                             
                             <?php

                            $query ="SELECT * FROM comments WHERE comment_post_id =" .mysqli_real_escape_string($connection,$_GET['id']) . " ";
                            $select_comments = mysqli_query($connection,$query);
                            while($row = mysqli_fetch_assoc($select_comments)){

                                $comment_id = $row['comment_id'];
                                $comment_author = $row['comment_author'];
                                $comment_status = $row['comment_status'];
                                $comment_content = $row['comment_content'];
                                $comment_email = $row['comment_email'];
                                $comment_post_id = $row['comment_post_id'];
                                $comment_date = $row['comment_date'];
                                


                                
                                echo "<tr>";
                                echo "<td>$comment_id</td>";
                                echo "<td>$comment_author</td>";
                                echo "<td>$comment_content</td>";
                                echo "<td>$comment_status</td>";
                                


                                


                                echo "<td>$comment_email</td>";
                                echo "<td>$comment_date</td>";


                                $query = "SELECT * FROM posts WHERE post_id = $comment_post_id ";
                                $selecting_post = mysqli_query($connection,$query);
                                while($row = mysqli_fetch_assoc($selecting_post)){
                                $post_id = $row['post_id'];
                                $post_title = $row['post_title']; 


                                echo "<td><a href = '../post.php?p_id=$post_id'>$post_title</a></td>";

                                }  




            
                                echo "<td><a href='comment.php?approved={$comment_id}&id=" . $_GET['id'] . " '>Approved</a></td>";
                                echo "<td><a href='comment.php?unapproved={$comment_id}&id=" . $_GET['id'] . " '>Unapproved</a></td>";
                                echo "<td><a href='post_comments.php?delete={$comment_id}&id=" . $_GET['id'] . " '>Delete</a></td>";
                                
                                echo "</tr>";



                            }


                            ?>

                            <?php
                            
                            if(isset($_GET['approved'])){

                                $approved_comment_id = $_GET['approved'];

                                $query = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $approved_comment_id ";
                                $approved_query = mysqli_query($connection,$query);
                                header("Location: comment.php");

                            }
                            
                            if(isset($_GET['unapproved'])){

                                $unapproved_comment_id = $_GET['unapproved'];

                                $query = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $unapproved_comment_id ";
                                $unpproved_query = mysqli_query($connection,$query);
                                header("Location: comment.php");

                            }

                            if(isset($_GET['delete'])){

                                $the_comment_id = $_GET['delete'];

                                $query = "DELETE FROM comments WHERE comment_id = $the_comment_id ";
                                $delete_query = mysqli_query($connection,$query);
                                header("Location: post_comments.php?id=" . $_GET['id'] . " ");

                            }

                            



                            ?>
                                 
                                  
                                
                            
                         </tbody>
                     </table>


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/footer_admin.php"; ?>