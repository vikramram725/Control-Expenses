<?php
require 'connection.php';
session_start();
$user_id = $_SESSION['id'];
$plan_id = $_SESSION['planid'];
if(isset($_POST['but_upload'])){
    $extitle = $_POST['title'];
    $date = $_POST['date'];
    $spent = $_POST['spent'];
    $chooseper = $_POST['chooseper'];
    $name = $_FILES['file']['name'];
    if(!empty($extitle) && !empty($date) && !empty($spent) && !empty($chooseper)){
        $new_expense_query = "insert into expense(extitle,date,spent,chooseper,userid) values('$extitle','$date','$spent','$chooseper','$user_id')";
        $new_expense_result = mysqli_query($con, $new_expense_query);
        $expense_id = mysqli_insert_id($con);
        if(!empty($name)){
        $target_dir = "upload/";
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        // Select file type
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        // Valid file extensions
        $extensions_arr = array("jpg","jpeg","png","gif");
        // Check extension
        if( in_array($imageFileType,$extensions_arr) ){ 
            // Insert record
            $file_insert = "insert into photos(images,expenseid) values('".$name."','$expense_id')";
            $file_query = mysqli_query($con, $file_insert) or die(mysqli_error($con));
            $photo_id = mysqli_insert_id($con);
            // Upload file
            move_uploaded_file($_FILES['file']['tmp_name'],$target_dir.$name);
            }
        }
        else{
            $photo_id = 0;
        }
        $user = "insert into users_expense(user,expense,photo,planid) values('$user_id','$expense_id','$photo_id','$plan_id')";
        $user_result = mysqli_query($con,$user) or die(mysqli_error($con));
        $spent_check = "select spent from person where (person = '$chooseper' and planid = '$plan_id')";
        $spent_check_query = mysqli_query($con, $spent_check) or die(mysqli_error($con));
        $pe = mysqli_fetch_array($spent_check_query);
        $spent1 = $spent + $pe['spent'];
        $spent_insert = "update person set spent = '$spent1' where (person = '$chooseper' and planid = '$plan_id')";
        $spent_query = mysqli_query($con, $spent_insert) or die(mysqli_error($con));
        $_SESSION['planid'] = $plan_id;
        echo " <script>window.alert('expense added successfully !!'); window.location.href = 'view_plan.php'</script> ";
    }
    else{
        echo " <script>window.alert('fill the form!!'); window.location.href='view_plan.php';</script> ";
    }
}
?>