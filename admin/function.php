<?php

function ImagePlaceholder($image=''){

    if(!$image){

        return 'image_2.jpg';

    } else {

        return $image;
    }
}



function users_online(){

    if(isset($_GET['onlineuser'])){

        global $connection;

            if(!$connection){

            session_start();

            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 10;
            $time_out = $time - $time_out_in_seconds;
            
            $query = "SELECT * FROM users_online WHERE session = '$session' ";
            $online_query = mysqli_query($connection,$query);
            $count = mysqli_num_rows($online_query);
            
            if($count == null){
            
                mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");

            
            }else {
            
                mysqli_query($connection,"UPDATE users_online SET time = '$time' WHERE session = '$session'");
            } 
            
            $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time > '$time_out'");
            echo $count_user = mysqli_num_rows($users_online_query);


        }
        
    

    } //get request


}   
users_online();


//REDIRECT

function redirect($location){


header("Location:" . $location);


}

function query($query){

global $connection;
return mysqli_query($connection,$query);

}


function isLoggedIn(){


if(isset($_SESSION['user_role'])){


    return true;

}

    return false;

}

function LoggedInUser(){

    if(isLoggedIn()){

        $result = query("SELECT * FROM users WHERE username='". $_SESSION['username']."'");
        $user = mysqli_fetch_array($result);

        if(mysqli_num_rows($result)){
        return $user['user_id'];

        }
        
    }

    return false;


}

function UserLikedThisPost($post_id){

    $result = query("SELECT * FROM likes WHERE user_id=" .LoggedInUser(). " AND post_id={$post_id}");
    return mysqli_num_rows($result)>=1 ? true : false;
}

function getAllLikes($post_id){

    $result = query("SELECT * FROM likes WHERE post_id = $post_id");
    echo mysqli_num_rows($result);
}


function ifItIsMethodf($method=null){

    if($_SERVER['REQUEST_METHOD'] == strtoupper($method)){

        return true;
    }

        return false;

}

function checkIfUserIsLoggedInAndRedirect($redirectLocation){

    if(isLoggedIn()){

        redirect($redirectLocation);


    }

}

function insert_categories(){

    global $connection;

   if(isset($_POST['submit'])){

    $cat_title = $_POST['cat_title'];
   

    if(empty($cat_title)){

        echo "<h4 style='color:red;'>*Fields Cannot Be Empty*</h4>";

    } else {

        $query = query("INSERT INTO category(cat_title) VALUES('{$cat_title}')");
        if(!$query){

            die("Database Error". mysqli_error($connection));
        }

    //   $stmt  =  mysqli_prepare($connection,"INSERT INTO category(cat_title) VALUE(?)");
    //   mysqli_stmt_bind_param($stmt, 's', $cat_title);
    //   mysqli_stmt_execute($stmt);

//    $query = "INSERT INTO category(cat_title) ";
//    $query .= "VALUE('$cat_title') ";
//    $insert_category = mysqli_query($connection,$query); 

    }
 }

}

function add_categories(){

global $connection;
$query = "SELECT * FROM category";
$select_categories = mysqli_query($connection,$query);

while($row = mysqli_fetch_assoc($select_categories)){
$cat_id = $row['cat_id'];
$cat_title = $row['cat_title'];

echo "<tr>";
echo "<td>$cat_id</td>";
echo "<td>$cat_title</td>";
echo "<td><a class= 'btn btn-danger' href='category.php?delete=$cat_id'>Delete</td>";
echo "<td><a class= 'btn btn-warning' href='category.php?edit=$cat_id'>Edit</td>";
echo "</tr>";

     }  

}

function delete_categories(){

    global $connection;
    if(isset($_GET['delete'])){

        $the_cat_id = $_GET['delete'];
        $query = "DELETE FROM category WHERE cat_id = $the_cat_id ";
        $delete_category = mysqli_query($connection,$query);
        header("Location: category.php");

        }
    
    }

function recordCount(){

    global $connection;
    $query = "SELECT * FROM posts WHERE user_id='".LoggedInUser()."'";
    $result = mysqli_query($connection,$query);
    return mysqli_num_rows($result);


}  


function recordCountposts(){

    global $connection;
    $query = "SELECT * FROM posts";
    $result = mysqli_query($connection,$query);
    return mysqli_num_rows($result);

}

function recordCountComments(){

    global $connection;
    $query = "SELECT * FROM comments";
    $result = mysqli_query($connection,$query);
    return mysqli_num_rows($result);

}

function recordCountCategories(){

    global $connection;
    $query = "SELECT * FROM category";
    $result = mysqli_query($connection,$query);
    return mysqli_num_rows($result);

}

function CommentCountPosts(){

    $result = query("SELECT * FROM posts INNER JOIN comments ON posts.post_id = comments.comment_post_id WHERE user_id='" . LoggedInUser() . "'");
    return mysqli_num_rows($result);

}

function CategoryCountUsers(){

    $result = query("SELECT * FROM category WHERE user_id ='".LoggedInUser()."'");
    return mysqli_num_rows($result);
}

function dashboardCount($table,$column,$status){

    global $connection;

    $query = "SELECT * FROM $table WHERE $column = '$status' ";
    $result = mysqli_query($connection,$query);
    return mysqli_num_rows($result);

}

function dashboardCountDraftMyData(){

global $connection;

$query = "SELECT * FROM posts WHERE post_status = 'draft' AND user_id ='".LoggedInUser()."'";
$draft_query = mysqli_query($connection,$query);
return mysqli_num_rows($draft_query);

}

function dashboardCountCommentApprovedtMyData(){

    global $connection;
    
    $query = "SELECT * FROM comments WHERE comment_status = 'approved' AND user_id ='".LoggedInUser()."'";
    $comment_query = mysqli_query($connection,$query);
    // return mysqli_num_rows($comment_query);
    
}

function dashboardCountAdminMyData(){


    global $connection;
    $query = "SELECT * FROM users WHERE user_role= 'admin' AND user_id ='".LoggedInUser()."'";
    $admin_query = mysqli_query($connection,$query);
    return mysqli_num_rows($admin_query);
}

function dashboardCountSubscriberMyData(){


    global $connection;
    $query = "SELECT * FROM users WHERE user_role= 'subscriber' AND user_id ='".LoggedInUser()."'";
    $subscriber_query = mysqli_query($connection,$query);
    return mysqli_num_rows($subscriber_query);
}


function fetchRecord($result){

    return mysqli_fetch_array($result);
}

function isAdmin(){

    global $connection;

    if(isLoggedIn()) {

        $result = query("SELECT user_role FROM users WHERE username = '". $_SESSION['username']. "'");

    $row = fetchRecord($result);

    if($row['user_role'] == 'admin'){

        return true;

    } else {

        return false;

    }

}
return false;

}



function sameUsername($username) {

    global $connection;

    $query = "SELECT username FROM users WHERE username = '$username' ";
    $result = mysqli_query($connection,$query);

    if(mysqli_num_rows($result) > 0){

        return true;
      
    } else {

        return false;


    }   


    }

    function sameEmail($email){

        global $connection;
        $query = "SELECT user_email FROM users WHERE user_email = '$email' ";
        $result = mysqli_query($connection,$query);

        if(mysqli_num_rows($result)>0){

            return true;

        } else {

            return false;
        }

    }


    function register_users($username,$password,$user_firstname,$user_lastname,$email){

        global $connection;

       

        // if(sameUsername($username)){
      
        //     $message = 'User Exists';

        //     // echo "<h4 class='text-center' style='color:red'>Username Already Exists!</h4>";


        // }

        $username = mysqli_real_escape_string($connection,$username);
        $email    = mysqli_real_escape_string($connection,$email);
        $password = mysqli_real_escape_string($connection,$password);

        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        // $query = "SELECT randSalt FROM users ";
        // $select_randsalt_query = mysqli_query($connection,$query);

        // $row = mysqli_fetch_array($select_randsalt_query);
        // $salt = $row['randSalt'];
        // $password = crypt($password,$salt);

        $query = "INSERT INTO users(username, user_firstname, user_lastname, user_date, user_email, user_password, user_role) ";
        $query .= "VALUES('{$username}','{$user_firstname}', '{$user_lastname}', now(), '{$email}','{$password}','subscriber') ";
        $regisration_query = mysqli_query($connection,$query);
        if($regisration_query){

        $message = 'Registration Done Successfully!';

        }
    }


    function login_user($username,$password){

        global $connection;

        $username = trim($username);
        $password = trim($password);

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

        // $password = crypt($password,$db_user_password);



       




    


?>