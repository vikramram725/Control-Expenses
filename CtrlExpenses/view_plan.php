<?php
require 'connection.php';
session_start();
if (!isset($_SESSION['email'])){
    header('location: login.php');
}
$user_id = $_SESSION['id'];
$plan = $_SESSION['planid'];
$plan_query = "select title,budget,fromd,tod,people from plan where (userid = '$user_id' AND id = '$plan')";
$plan_result = mysqli_query($con,$plan_query) or die(mysqli_error($con));
$row = mysqli_fetch_array($plan_result);
$people = $row['people'];
$budget = $row['budget'];
$plan_id = $plan;
$user_expense = "select expense from users_expense where planid = '$plan_id' ";
$expense_query = mysqli_query($con,$user_expense) or die(mysqli_error($con));
$num = mysqli_num_rows($expense_query);
$total_spent = 0;
while($r = mysqli_fetch_array($expense_query)){
    $id = $r['expense'];
    $expense = "select spent from expense where id = '$id' ";
    $result = mysqli_query($con,$expense) or die(mysqli_error($con));
    $wor = mysqli_fetch_array($result);
    $total_spent = $total_spent + $wor['spent'];
}
$remaining_amount = $budget - $total_spent;
$_SESSION['spent'] = $total_spent;
$text = '';
if($remaining_amount > 0){
    $color = "green";
} elseif ($remaining_amount < 0) {
    $remaining_amount = abs($remaining_amount);
    $color = "red";
    $text = "Oversent by";
}
else{
    $color = "black";
}
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>VIEW PLAN | CTRL EXPENSES</title>
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
                <div class="col-xs-12 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <center>
                                <div class="row" style="text-align: right">
                                    <div class="col-xs-7">
                                        <h3><?php echo $row['title'];?></h3>
                                    </div>
                                    <div class="col-xs-5">
                                        <h3><span class="glyphicon glyphicon-user"></span><?php echo $row['people'];?></h3>
                                    </div>
                                </div>
                            </center>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <p>Budget</p>
                                    <p>Remaining Amount</p>
                                    <p>Date</p>
                                </div>
                                <div class="col-xs-6" style="text-align: right">
                                    <p><?php echo '₹ '.$budget;?></p>
                                    <p style="color: <?php echo $color;?>"><?php echo $text.' ₹ '.$remaining_amount;?></p>
                                    <p><?php echo $row['fromd'];?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-8 col-xs-offset-2 col-md-6 col-md-offset-0">
                    <center>
                        <br>
                        <br>
                        <button class="btn btn-success"><a href="distribution.php">Expense Distribution</a></button>
                        <br>
                        <br>
                        <br>
                        <br>
                    </center>
                </div>
            </div>
            <div class="row">
                <?php
                $select_query = " select expense,photo from users_expense where (user = '$user_id' and planid = '$plan_id')";
                $select_result = mysqli_query($con,$select_query) or die(mysqli_error($con));
                while($sel = mysqli_fetch_array($select_result)){
                    $sid = $sel['expense'];
                    $select_ex_det = "select extitle,spent,date,chooseper from expense where id = '$sid' ";
                    $select_ex_det_result = mysqli_query($con,$select_ex_det) or die(mysqli_error($con));
                    $details = mysqli_fetch_array($select_ex_det_result);
                ?>
                <div class="col-xs-8 col-xs-offset-2 col-md-3 col-md-offset-0">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <center><h3><?php echo $details['extitle'];?></h3></center>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-6">
                                    <p>Amount</p>
                                    <p>Paid by</p>
                                    <p>Paid on</p>
                                </div>
                                <div class="col-xs-6" style="text-align: right">
                                    <p><?php echo  '₹ '.$details['spent'];?></p>
                                    <p><?php echo $details['chooseper'];?></p>
                                    <p><?php echo $details['date'];?></p>
                                </div>
                                <center>
                                    <?php
                                    $pid = $sel['photo'];
                                    $bill_query = "select images from photos where id = '$pid'";
                                    $bill_result = mysqli_query($con, $bill_query) or die(mysqli_error($con));
                                    $num_rows = mysqli_num_rows($bill_result);
                                    $bill = mysqli_fetch_array($bill_result);
                                    if($num_rows == 0){
                                        ?><p>You Don't have bill</p>
                                    <?php
                                    }
                                    else{
                                        ?><a href="upload/<?php echo $bill['images'];?>" target="_blank">Show bill</a>
                                    <?php
                                    }
                                    ?>
                                </center>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <div class="col-xs-12 col-md-4" style="float: right">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <center>
                                <h3>Add New Expense</h3>
                            </center>
                        </div>
                        <div class="panel-body">
                            <form action="new_expense.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                        <label for="title">Title</label>
                                        <input class="form-control" name="title" placeholder="Expense Name">
                                </div>
                                    <div class="form-group">
                                        <label for="date">Date</label>
                                        <input class="form-control" name="date" type="date" min="<?php echo $row['fromd'];?>" max="<?php echo $row['tod'];?>" >
                                    </div>
                                    <div class="form-group">
                                        <label for="spent">Amount Spent</label>
                                        <input class="form-control" name="spent" placeholder="Amount Spent">
                                        <select class="form-control" name="chooseper">
                                            <option selected >choose</option>
                                            <?php
                                            $person_query = "select person from person where planid = '$plan_id' ";
                                            $person_result = mysqli_query($con, $person_query) or die(mysqli_error($con));
                                            while($per = mysqli_fetch_array($person_result)){
                                                ?>
                                            <option value="<?php echo $per['person'];?>" ><?php echo $per['person'];?></option>
                                            <?php
                                            }?>
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <label for="bill">Upload Bill</label>
                                    <input type="file" class="form-control" name="file">
                                </div>
                                <div class="form-group">
                                    <button type="submit" value="Save name" name="but_upload" class="btn btn-success">Add</button>
                                </div>
                            </form>
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