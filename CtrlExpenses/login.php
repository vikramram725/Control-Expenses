<?php
  require 'connection.php';
  session_start();
  if(isset($_SESSION['email'])){
    header('location: homepage.php');
  }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login | CTRL EXPENSES</title>
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
                            <h3>Login</h3>
                        </center>
                    </div>
                    <div class="panel-body">
                        <p class="text-warning">Login to make purchases.</p>
                        <form action="login_submit.php" method="post">
                            <div class="form-group">
                                <label for="name">Name:</label>
                                <input class="form-control" name="email" placeholder="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" > 
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input class="form-control" name="password" placeholder="password" pattern=".{8,}" type="password" id="typepass" title="Cannaot be empty"><br>
                                <input type="checkbox" name="show password" onclick="Toggle()" value="ON"><i>show password</i>
                            </div>
                            <button class="btn btn-success btn-block">Login</button>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <p>Don't have an account?<a href="signup.php">Click here to Sign up</a></p>
                    </div>    
                </div>        
            </div>            
        </div>            
    </div>
    <br><br>
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