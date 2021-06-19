<?php
require 'connection.php';
session_start();
$title = mysqli_real_escape_string($con,$_POST['title']);
$fromd = mysqli_real_escape_string($con,$_POST['from']);
$tod = mysqli_real_escape_string($con,$_POST['to']);
$budget = mysqli_real_escape_string($con,$_POST['budget']);
$people = mysqli_real_escape_string($con,$_POST['people']);
$user_id =$_SESSION['id'];
if(!empty($title) && !empty($fromd) && !empty($tod) && !empty($budget) && !empty($people) ){
    $plan_insert_query="INSERT into plan(title,fromd,tod,budget,people,userid) values('$title','$fromd','$tod','$budget','$people','$user_id')";
    $plan_insert_result = mysqli_query($con,$plan_insert_query) or die(mysqli_error($con));
    $plan_id = mysqli_insert_id($con);
    for($x=1;$x<=$people;$x++){
        $temp = $_POST['person-'.$x];
        $person_insert = "insert into person(person,planid) values('$temp','$plan_id')";
        $person_insert_query = mysqli_query($con,$person_insert) or die(mysqli_error($con));
    }
    $plan_insert_up_query = "INSERT into users_plan(users,plan) values('$user_id','$plan_id')";
    $plan_insert_up_result = mysqli_query($con,$plan_insert_up_query) or die(mysqli_error($con));
    echo " <script> alert('Added successfull !!'); window.location.href='homepage.php';</script> ";
}
else{
    echo "<script>windows.alert('fill the form'); window.location.href='plan.php';</script>";
}
?>