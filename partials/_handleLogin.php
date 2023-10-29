<?php
$show_error = "false";
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include '_dbconnect.php';
    $email = $_POST['login_email'];
    $user_pass = $_POST['login_pass'];

    $sql = "SELECT * FROM `users` where user_email = '$email'";
    $result = mysqli_query($conn, $sql);
    $numrows = mysqli_num_rows($result);
    if($numrows == 1){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($user_pass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['user_email'] = $email;
            echo "Logged in " . $email;
        }
        header("Location: /forum_web/index.php");
    }
    header("Location: /forum_web/index.php");
}

?>