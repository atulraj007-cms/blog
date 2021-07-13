<?php use PHPMailer\PHPMailer\PHPMailer; ?>
<?php include "includes/db.php"; ?>
<?php  include "includes/header_post.php"; ?>

<?php include "includes/navigation_post.php"; ?>

<?php 

require './vendor/autoload.php';
// require './classes/config.php';





if(!isset($_GET['forgot'])){

    redirect('index.php');
}

if(isset($_POST['email'])){

    $email = $_POST['email'];
    $length = 50;
    $token = bin2hex(openssl_random_pseudo_bytes($length));

    if(sameEmail($email)){

        if($stmt = mysqli_prepare($connection,"UPDATE users SET token = '$token' WHERE user_email = ? ")); {
        mysqli_stmt_bind_param($stmt, "s", $email);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        /**
         * 
         * 
         * configure PHPMailer
         * 
         * 
         * 
         */

        $mail = new PHPMailer();

        // echo get_class($mail);
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = Config::SMTP_HOST;                     //Set the SMTP server to send through
                                        //Enable SMTP authentication
        $mail->Username   = Config::SMTP_USER;                     //SMTP username
        $mail->Password   = Config::SMPT_PASSWORD;                               //SMTP password
        $mail->Port       = Config::SMTP_PORT;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->SMTPAuth   = true;  
        $mail -> isHTML(true);
        $mail -> CharSet = 'utf-8'; //for different languages that have symbols in them like vietnamese, chinese etc.


        $mail -> setFrom('atul.beis.14@acharya.ac.in', 'Atul Raj Tewary');
        $mail -> addAddress($email);
        $mail -> Subject = 'This is a test email';
        $mail -> Body = '<p>Please Click To Reset Your Password
        
        <a href = "http://localhost/cms/reset.php?email='.$email.'&token='.$token.' ">http://localhost/cms/reset.php?email='.$email.'&token='.$token.'</a>
        
        ';

        if($mail -> send()){

            $emailSent = true;

        }else{

            echo "Not Sent";
        }
        




        }
    
    }
    

}
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

                        <?php if(!isset($emailSent)): ?>


                                <h3><i class="fa fa-lock fa-4x"></i></h3>
                                <h2 class="text-center">Forgot Password?</h2>
                                <p>You can reset your password here.</p>
                                <div class="panel-body">




                                    <form id="register-form" role="form" autocomplete="on" class="form" method="post">

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                                <input id="email" name="email" placeholder="Email Address" class="form-control"  type="email">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input name="recover-submit" class="btn btn-lg btn-primary btn-block" value="Reset Password" type="submit">
                                        </div>

                                        <input type="hidden" class="hide" name="token" id="token" value="">
                                    </form>

                                </div><!-- Body-->

                                <?php else: ?>

                                <h2>Please Check Your Email</h2>

                                <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <hr>

    <?php include "includes/footer_post.php";?>

</div> <!-- /.container -->

