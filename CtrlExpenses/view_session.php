<?php
require 'connection.php';
session_start();
$_SESSION['planid'] = 0;
unset($_SESSION['planid']);
$_SESSION['planid'] = $_POST['plan'];
header("location: view_plan.php");
?>