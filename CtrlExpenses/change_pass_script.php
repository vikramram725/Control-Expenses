<?php
require 'connection.php';
session_start();
$oldpass = md5(mysqli_real_escape_string($con,$_POST['oldpass']));
$newpass = md5(mysqli_real_escape_string($con,$_POST['newpass']));
$re_pass = md5(mysqli_real_escape_string($con,$_POST['re_pass']));
$email=$_SESSION['email'];
$user_pass_query=" select password from users where email ='$email' ";
$user_pass_results= mysqli_query($con, $user_pass_query) or die(mysqli_error($con));
$rows_fetched = mysqli_fetch_array($user_pass_results);
if($rows_fetched['password']== $oldpass){
    if (strlen($newpass)>6){
        if ($newpass == $re_pass){
        $pass_update_query= "UPDATE users SET password='$re_pass' where email='$email'";
        $pass_update_result= mysqli_query($con,$pass_update_query) or die(mysqli_error($con));
        echo "<script>alert('password successfully changed'); window.location.href='homepage.php';</script>";
        }
        else{
            echo "<script> alert('enter same password as new password'); window.location.href='change_password.php';</script>";
        }
    }else {
        echo "<script> alert('enter strong password'); window.location.href='change_password.php';</script>";
    }
}    
else{
    echo "<script> alert('wrong password!!enter correct password'); window.location.href='change_password.php';</script>";
}
?>