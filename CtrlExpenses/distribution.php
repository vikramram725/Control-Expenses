<?php
require 'connection.php';
session_start();
$user_id = $_SESSION['id'];
$plan_id = $_SESSION['planid'];
$total_spent = $_SESSION['spent'];
$plan_query = "select title,budget,people from plan where (userid = '$user_id' and id = '$plan_id')";
$plan_result = mysqli_query($con, $plan_query) or die(mysqli_error($con));
$ro = mysqli_fetch_array($plan_result);
$counter = $ro['people'];
$budget = $ro['budget'];
$remaining_amount = $budget - $total_spent;
$shares = round($total_spent/$counter);
$array = array();
$spent = array();
$person_query = "select person,spent from person where planid = '$plan_id'";
$person_result = mysqli_query($con, $person_query) or die(mysqli_error($con));
while($per = mysqli_fetch_array($person_result)){
    $array[] = $per['person'];
    $spent[] = $per['spent'];
}
$text = '';
if($remaining_amount > 0){
    $color = "green";
} elseif ($remaining_amount < 0) {
    $remaining_amount = abs($remaining_amount);
    $color = "red";
    $text = "Overspent by";
}
else{
    $color = "black";
}
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
        <div class="container row-style">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <center>
                                <h4><?php echo $ro['title'];?></h4>
                            </center>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <p>Initial Budget</p>
                                    <?php
                                    foreach ($array as $key => $value){?>
                                        <p><?php echo $value;?></p>
                                    <?php
                                    }
                                    ?>
                                    <p>Total Amount Spent</p>
                                    <p>Remaining Amount</p>
                                    <p>Individual Shares</p>
                                    <?php
                                    foreach ($array as $key => $value){?>
                                        <p><?php echo $value;?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-xs-6" style="text-align: right">
                                    <p><?php echo '₹ '.$budget;?></p>
                                    <?php
                                    foreach ($spent as $key => $value){?>
                                        <p><?php echo '₹ '.$value;?></p>
                                    <?php
                                    }
                                    ?>
                                    <p><?php echo '₹ '.$total_spent;?></p>
                                    <p style="color: <?php echo $color;?>"><?php echo $text." ₹ ".$remaining_amount;?></p>
                                    <p><?php echo '₹ '.$shares;?></p>
                                    <?php
                                    $text1 = '';
                                    $color1 = 'black';
                                    foreach ($spent as $key => $value){
                                        $val = $value - $shares;
                                        if($val == $total_spent){
                                            $text1 = '₹ '.$val;
                                        }
                                        else{
                                            if($val > 0){
                                                $color1 = "green";
                                                $text1 = 'Gets back'.' ₹ '.$val;
                                            } elseif ($val < 0) {
                                                $val = abs($val);
                                                $color1 = "red";
                                                $text1 = 'Owes'.' ₹ '.$val;
                                            }
                                            else{
                                                $text1 = 'All Settled up';
                                            }
                                        }
                                        ?>
                                    <p style="color: <?php echo $color1;?>"><?php echo $text1;?></p>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <center>
                                <form action="view_plan.php" method="post">
                                    <button value="<?php echo $plan_id; ?>" name="plan" class="btn btn-primary">Go Back</button>
                                </form>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
<?php
require 'footer.php';
?>