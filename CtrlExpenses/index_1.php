<?php
require 'connection.php';
session_start();
if (isset($_SESSION['email'])){
    header('location: homepage.php');
} else {
?>
<!DOCTYPE html>
<html>
    <head>
        <title>CTRL EXPENSES</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="index1.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?php
        require 'header.php';
        ?>
        <div class="img-responsive" id="banner_image">
            <div class="container">
                <div class="jumbotron" id="banner_content">
                        <h1>We help you to control your Budget</h1>
                        <?php
                        if(!isset($_SESSION['email'])){
                        ?>
                        <a href="login.php" class="btn btn-info btn-lg-active">Start Today</a>
                        <?php
                        }else{
                            ?>
                            <a href="homepage.php" class="btn btn-info btn-lg-active">Start Today</a>
                            <?php
                        }
                        ?>
                </div>
            </div>
        </div>
    </body>
</html>    
<?php
require 'footer.php';
}?>