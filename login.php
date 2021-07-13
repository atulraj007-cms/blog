<?php  include "includes/db.php"; ?>
 <?php  include "includes/header_post.php"; ?>
<?php require_once "admin/function.php"; ?>



<!-- Navigation -->

<?php  include "includes/navigation_post.php"; ?>

<?php 

if(isset($_POST['login'])){


$username = $_POST['username'];
$password = $_POST['password'];

$username = mysqli_real_escape_string($connection,$username);
$password = mysqli_real_escape_string($connection,$password);


$query = "SELECT * FROM users WHERE username = '$username' ";
$user_query = mysqli_query($connection,$query);


while($row = mysqli_fetch_assoc($user_query)){

$db_user_id = $row['user_id'];
$db_username = $row['username'];
$db_user_fname = $row['user_firstname'];
$db_user_role = $row['user_role'];
$db_user_lname = $row['user_lastname'];
$db_user_password = $row['user_password'];



if(password_verify($password,$db_user_password)){

	if (session_status() === PHP_SESSION_NONE) session_start();

	$_SESSION['user_id']  = $db_user_id;
	$_SESSION['username'] = $db_username;
	$_SESSION['user_firstname'] = $db_user_fname;
	$_SESSION['user_lastname'] = $db_user_lname;
	$_SESSION['user_role'] = $db_user_role;

	Header("Location: /blog/admin/index_admin.php");


} else {

	

	Header("Location: /blog/index.php");

}

}


}

	// if(isset($_SESSION['username'])){

	// checkIfUserIsLoggedInAndRedirect('/blog/admin');
	
	// if(ifItIsMethodf('post')){

	// 	if(isset($_POST['login'])){
	
	// 	if(isset($_POST['username']) && isset($_POST['password'])){
	
	// 	login_user($_POST['username'],$_POST['password']);
	
	// } 
	
	
	// }
	
	// }
	// }


?>
 

<!-- Page Content -->
<div class="container">

	<div class="form-gap"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-4 col-md-offset-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="text-center">


							<h3><i class="fa fa-user fa-4x"></i></h3>
							<h2 class="text-center">Login</h2>
							<div class="panel-body">


								<form id="login-form" role="form" autocomplete="off" class="form" method="post">

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-user color-blue"></i></span>

											<input name="username" type="text" class="form-control" placeholder="Enter Username">
										</div>
									</div>

									<div class="form-group">
										<div class="input-group">
											<span class="input-group-addon"><i class="glyphicon glyphicon-lock color-blue"></i></span>
											<input name="password" type="password" class="form-control" placeholder="Enter Password">
										</div>
									</div>

									<div class="form-group">

										<input name="login" class="btn btn-lg btn-primary btn-block" value="Login" type="submit">
									</div>


								</form>

							</div><!-- Body-->

						</div>
					</div>
				</div>
			</div>
		</div>

		<div style="background: #f6f6f6; padding:20px; margin:0 0 20px 0; border:1px solid #ccc">
            <h4>Demo User: atulraj</h4>
            <h4>Demo Password: 123</h4>
        </div>
	
	
	</div>

	<hr>

	<?php include "includes/footer_post.php";?>

</div> <!-- /.container -->
