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
                            <small><?php echo $_SESSION['username']; ?></small>
                        </h1>


                       <div class="col-xs-6">

                       <?php

                            insert_categories();


                        ?>
                       
                       <form action="" method="post">
                       <div class="form-group">
                       
                        <label for="cat-title">Add Category</label>
                        <input type="text" name="cat_title" class="form-control" placeholder="Enter Category Title">
                      
                       </div>

                       <div class="form-group">
                       
                        <input type="submit" name="submit" value="Add Category" class="btn btn-primary">
                      
                       </div>
                       
                       </form>

                      <?php

                        if(isset($_GET['edit'])){

                            $cat_id = $_GET['edit'];
                            include "includes/update_Categories.php";

                        }




                        ?>
                       </div> 

                       <div class="col-xs-6">
                       
                       <table class="table table-bordered table-hover">
                           <thead>
                               <tr>
                                   <th>Id</th>
                                   <th>Description</th>
                                   <th>Action 1</th>
                                   <th>Action 2</th>
                               </tr>
                           </thead>
                           <tbody>


                        <?php //adding categories

                        add_categories();
                        
                        ?>

                        <?php //deleteing categories

                        delete_categories();

                        
                        ?>
                               
                           </tbody>
                       </table>
                       
                       
                       
                       
                       
                       
                       </div>
                      
                    


                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

   <?php include "includes/footer_admin.php"; ?>