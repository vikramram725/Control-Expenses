<?php
require 'connection.php';
session_start();
if (!isset($_SESSION['email'])){
    header('location: login.php');
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
        <div class="container">
            <div class="row row-style">
                    <div class="col-xs-7 col-xs-offset-3 col-sm-4 col-sm-offset-4">
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <center>
                                <h3>Create New Plan</h3>
                            </center>
                        </div>
                    <div class="panel-body">
                        <form action="plan.php" method="post">
                        <div class="form-group">
                            <label for="budget">Initial budget</label>
                            <input class="form-control" name="budget" type="number" min="50" placeholder="Initial budget(Ex.40000)" title="value must be greater than or equal to 50">
                        </div>
                        <div class="form-group">    
                            <label for="people">How many peoples you want to add in your group?</label>
                            <input class="form-control" name="people" type="number" placeholder="No of people" min="1" title="value must be greater than or equal to 1">
                        </div>
                        <div class="form-group">    
                            <button class="btn btn-success btn-block">Next</button>
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