<?php
require 'connection.php';
session_start();
$name = mysqli_real_escape_string($con,$_POST['name']);
$email = mysqli_real_escape_string($con,$_POST['email']);
$password = md5(mysqli_real_escape_string($con,$_POST['password']));
$phone = mysqli_real_escape_string($con,$_POST['phone']);
if(!empty($name) && !empty($email) && !empty($password) && !empty($phone)){
    $signup_query="INSERT into users(name,email,password,phone) values('$name','$email','$password','$phone')";
    $signup_submit= mysqli_query($con,$signup_query) or die(mysqli_error($con));
    $_SESSION['email']= $email;
    $_SESSION['id']= mysqli_insert_id($con);
    echo " <script> alert('Sign Up successfull !!'); window.location.href='homepage.php';</script> ";
}
else{
    echo "<script> alert('fill the form'); window.location.href='signup.php';</script>";
}
?>