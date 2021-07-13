<?php  include "includes/db.php"; ?>
 <?php  include "includes/header_post.php"; ?>
 
<?php

if(isset($_GET['lang']) && !empty($_GET['lang'])){

    $_SESSION['lang'] = $_GET['lang'];

    if(isset($_SESSION['lang']) &&  $_SESSION['lang'] != $_GET['lang']){

        echo "<script type='text/javascript'>location.reload();</script>";
    }

}

    if(isset($_SESSION['lang'])){

        include "includes/languages/".$_SESSION['lang'].".php";
    
    } else {

        include "includes/languages/english.php";
    }


// $message = '';

if(isset($_POST['submit'])){

    $username       = trim($_POST['username']);
    $password       = trim($_POST['password']);
    $user_firstname = $_POST['user_firstname'];
    $user_lastname  = trim($_POST['user_lastname']);
    $email          = trim($_POST['email']);

    $error = ['username' => '',
               'email' =>'',
               'user_firstname' => '',
               'user_lastname' => '',
               'password' => ''
    
];

if(strlen($username) < 4){

    $error['username'] = 'Username Needs To Be Longer';
}

if($username == ''){

    $error['username'] = 'Username Cannot Be Empty!';
}
if(sameUsername($username)){

    $error['username'] = 'Username Already Exists';
}

if(sameEmail($email)){

    $error['email'] = '*Email already exists, <a href="index.php">Please Login</a>*';
}

if($password == ''){

    $error['password'] = 'password Cannot Be Empty!';
}

 foreach($error as $key => $value){

    if(empty($value)){

        // 
        // login_user($username,$password);
        unset($error[$key]);


    }




 }//foreach


 if(empty($error)){

    register_users($username,$password,$user_firstname,$user_lastname,$email);
    login_user($username,$password);

 }


}



?>

    <!-- Navigation -->
    
    <?php  include "includes/navigation_post.php"; ?>
    
 
    <!-- Page Content -->

    <!-- LANGUAGE FORM -->

    <div class="container">

    <form method="get" class="navbar-form navbar-right" action="" id="language_form">
    <div class="form-group">
    

    <label for="">Select Your Language:</label>
    <select name="lang" onchange="changeLanguage()">
    
    
    <option value="english">English</option>
    <option value="hindi">Hindi</option>
    
    
    </select>
    </div>
    
    </form>

    <!-- end language form -->
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1><?php echo _REGISTER; ?></h1>
                
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="on">
                    
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="<?php echo _USERNAME; ?>" 
                            value = "<?php echo isset($username) ? $username : '' ?>" >
                        
                            <p><?php echo isset($error['username']) ? $error['username']  : '' ?> </p>
                        </div>
                        <div class="form-group">
                            <label for="Firstname" class="sr-only">Firstname</label>
                            <input type="text" name="user_firstname" id="username" class="form-control" placeholder="<?php echo _FNAME; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="Lastname" class="sr-only">Lastname</label>
                            <input type="text" name="user_lastname" id="username" class="form-control" placeholder="<?php echo _LNAME; ?>" required>
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="<?php echo _EMAIL; ?>" 
                            
                            value = "<?php echo isset($email) ? $email : '' ?>" 
                            >
                            <p><?php echo isset($error['email']) ? $error['email']  : '' ?> </p>
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="<?php echo _PASSWORD; ?>" >
                            <p><?php echo isset($error['password']) ? $error['password']  : '' ?> </p>
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>

<script>

function changeLanguage(){

    document.getElementById('language_form').submit();
}



</script>

<?php include "includes/footer_post.php";?>
