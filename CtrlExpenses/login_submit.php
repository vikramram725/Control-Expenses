<?php
require 'connection.php';
session_start();
$email = mysqli_real_escape_string($con,$_POST['email']);
$regex_email = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
if(!empty($email)){
    if (!preg_match($regex_email, $email)){
        echo "<script> alert('Incorrect email!!'); window.location.href='login.php';</script>";
    }
}
$password = md5(mysqli_real_escape_string($con,$_POST['password']));
if(!empty($password)){    
    if (strlen($password)<6){
        echo "<script> alert('Incorrect password!!'); window.location.href='login.php';</script>";
    }
    else{
    $user_login_query=" select id, email from users where email = '$email' and password = '$password'";
    $user_login_results= mysqli_query($con,$user_login_query) or die(mysqli_error($con));
    $rows_fetched = mysqli_num_rows($user_login_results);
    if($rows_fetched == 0){
        echo "<script> alert('wrong email or password'); window.location.href='login.php';</script>";
    }
    else{
        $row = mysqli_fetch_array($user_login_results);
        $_SESSION['email']=$email;
        $_SESSION['id']=$row['id'];
        echo "<script> alert('Login Successfull'); window.location.href='homepage.php';</script>";
    }
    }
} else{
    echo "<script> alert('fill the password'); window.location.href='login.php';</script>";
}
?>