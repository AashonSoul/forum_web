<?php
$show_error = "false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $user_email = $_POST['sign_up_email'];
    $user_pass = $_POST['sign_up_password'];
    $user_cpass = $_POST['sign_up_cpassword'];

    // Check whether this email already exists in the db
    $exist_sql = "SELECT * FROM `users` where user_email = '$user_email'";
    $result = mysqli_query($conn, $exist_sql);
    $numrows = mysqli_num_rows($result);
    if($numrows > 0){
        $show_error = "Email already in use";
    }
    else{
        if($user_pass == $user_cpass){
            $hash = password_hash($user_pass, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`user_email`, `user_pass`, `timestamp`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $show_alert = true;
                header("Location: /forum_web/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $show_error = "Passwords do not match";
        }
    }
    header("Location: /forum_web/index.php?signupsuccess=false&error=$show_error");
}

?>