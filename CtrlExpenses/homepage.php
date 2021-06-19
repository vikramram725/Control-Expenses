<?php
require 'connection.php';
session_start();
if (!isset($_SESSION['email'])){
    header('location: login.php');
}
$user_id = $_SESSION['id'];
$plan_query = "select plan from users_plan where users = '$user_id' ";
$plan_result = mysqli_query($con,$plan_query) or die(mysqli_error($con));
$num_rows = mysqli_num_rows($plan_result);
?>
<!DOCTYPE html>
<html>
    <head>
        <title>PLAN | CTRL EXPENSES</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="index1.css" rel="stylesheet" type="text/css"/>
        
    </head>
    <body>
        <?php
        require 'header.php';
        ?>
                <div>
                    <?php
                    if($num_rows == 0){
                        ?>
                    <div class="container">
                    <div class="row-style">
                    <h3>You don't have any active plan</h3><br><br>
                    </div>
                    <div class="row">
                        <div class="col-xs-3 col-xs-offset-4">
                            <center>
                            <div class="panel panel-body" style="background-color: rgba(152,251,152,0.1); color:green; margin: 4% 4% 4% 4%">
                                <h3><a href="new_plan.php"><span class="glyphicon glyphicon-plus-sign"></span> create plan</a></h3>
                            </div>
                            </center>
                        </div>
                    </div>
                    </div>
                    <?php
                    }
                    else{
                    ?>
                    <div>
                        <div class="container">
                            <div class="row row-style">
                                <?php
                            while($row = mysqli_fetch_array($plan_result)){
                                $planid = $row['plan'];
                                $plan_det_query = "select title,budget,people,fromd,tod from plan where id = '$planid' ";
                                $plan_det_result = mysqli_query($con,$plan_det_query) or die(mysqli_error($con));
                                $ro = mysqli_fetch_array($plan_det_result);
                                ?>
                                <div class="col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-0">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <center>
                                                <h3><?php echo $ro['title'] ;?><span class="glyphicon glyphicon-user"></span><?php echo  $ro['people'];?></h3>
                                            </center>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <p>Budget</p>
                                                    <p>Date</p>
                                                </div>
                                                <div class="col-xs-6" style="text-align: right">
                                                    <p><?php echo $ro['budget'];?></p>
                                                    <p><?php echo $ro['fromd']."<=>".$ro['tod'];?></p>
                                                </div>
                                            </div>
                                            <form action="view_session.php" method="post">
                                                <button value="<?php echo $row['plan']; ?>" name="plan" class="btn btn-block btn-success">View plan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="fixed-action-btn">  
                        <h1 style="margin-left: 85%;margin-bottom: 2%"><a href="new_plan.php"><span class="glyphicon glyphicon-plus-sign"></span></a></h1>
                    </div>
                </div>
                <?php
                }
                ?>
    </body>
<?php
require 'footer.php';
?>
</html>