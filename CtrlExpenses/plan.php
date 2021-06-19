<?php
require 'connection.php';
session_start();
if (!isset($_SESSION['email'])){
    header('location: login.php');
}
$user_id=$_SESSION['id'];
$budget = mysqli_real_escape_string($con,$_POST['budget']);
$people = mysqli_real_escape_string($con,$_POST['people']);
$counter = 1;
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
        <div class="container">
            <div class="row row-style">
                    <div class="col-xs-5 col-xs-offset-4">
                    <div class="panel panel-default">
                    <div class="panel-body">
                        <form action="plan_script.php" method="post">
                        <div class="form-group">
                            <label for="title">Title:</label>
                            <input class="form-control" name="title" placeholder="Enter title(Ex.trip to Goa)" title="cannot be empty">
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="from">From:</label>
                                    <input class="form-control" name="from" placeholder="dd/mm/yyyy" type="date" min="1980-01-20">
                                </div>
                                <div class="col-xs-6">
                                    <label for="to">To:</label>
                                    <input class="form-control" name="to" placeholder="dd/mm/yyyy" type="date" min="1980-01-20">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col-xs-6">
                                    <label for="budget">Initial budget:</label>
                                    <input class="form-control" name="budget" value="<?php echo $budget; ?>" readonly>
                                </div>
                                <div class="col-xs-6">
                                    <label for="people">No.of people:</label>
                                    <input class="form-control" name="people" value="<?php echo $people; ?>" readonly>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i=$people;
                        while($i) {
                        ?>
                        <div class="form-group">
                            <label for="person">Person<?php echo $counter;?>:</label>
                            <input class="form-control" name="person-<?php echo $counter;?>" placeholder="Person <?php echo $counter;?> Name" title="cannot be empty">
                        </div>
                        <?php
                        $counter= $counter+1;
                        $i-=1;
                        }
                        ?>
                        <div class="form-group">    
                            <button class="btn btn-success btn-block">Submit</button>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
<?php
require 'footer.php';
?>
</html>