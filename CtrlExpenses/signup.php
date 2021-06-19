<?php
require 'connection.php';
session_start();
if (isset($_SESSION['email'])){
    header('location: homepage.php');
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Sign Up | CTRL EXPENSES</title>
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
                    <div class="panel panel-default">
                    <div class="panel-heading">
                    <center>
                        <h3>Sign Up</h3>
                    </center>
                    </div>
                    <div class="panel-body">
                    <form action="signup_script.php" method="post">
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input class="form-control" name="name" placeholder="Name" title="cannot be empty">
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input class="form-control" name="email" placeholder="Enter a vaild email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$">
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input class="form-control" name="password" placeholder="Password {Min 6 character}" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" type="password" id="typepass" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters" ><br>
                            <input type="checkbox" name="show password" onclick="Toggle()" value="ON"><i>show password</i>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone Number:</label>
                            <input class="form-control" name="phone" placeholder="Phone number Eg.8982293923" title="cannot be empty">
                        </div>
                        <div class="form-group">    
                            <button class="btn btn-success btn-block">Sign Up</button>
                        </div>
                    </form>
                    </div>
                    </div>
                </div>
            </div>
        </div>
        <script>
        function Toggle() { 
            var temp = document.getElementById("typepass"); 
            if (temp.type === "password") { 
                temp.type = "text"; 
            } 
            else { 
                temp.type = "password"; 
            } 
        } 
        </script>
    </body>
</html>
<?php
require 'footer.php';
?>