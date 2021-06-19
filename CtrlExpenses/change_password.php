<?php
require 'connection.php';
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Change Password | CTRL EXPENSES</title>
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
                    <form action="change_pass_script.php" method="post">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <center>
                                    <h4>Change Password</h4>
                                </center>
                            </div>
                        <div class="panel-body">
                        <div class="form-group">
                            <label for="oldpass">Old Password</label>
                            <input class="form-control" name="oldpass" placeholder="old password" type="password" id="typepass2"><br>
                            <input type="checkbox" name="show password" onclick="Togg()" value="ON"><i>show password</i>
                            <script>
                            function Togg() {
                                    var temp = document.getElementById("typepass2");
                                    if (temp.type === "password") { 
                                        temp.type = "text"; 
                                    } 
                                    else { 
                                    temp.type = "password"; 
                                    }
                                }
                            </script>
                        </div>
                        <div class="form-group">
                            <label for="newpass">New Password</label>
                            <input class="form-control" name="newpass" placeholder="new password" type="password" id="typepass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 6 or more characters">
                        </div>
                        <div class="form-group">
                            <label for="re_pass">Re-Enter Password</label>
                            <input class="form-control" name="re_pass" placeholder="re-enter password" type="password" id="typepass1" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}" title="Match new password"><br>
                            <input type="checkbox" name="show password" onclick="Toggle()" value="ON"><i>show password</i>
                        </div>
                        <button class="btn btn-success btn-block">change</button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script>
        function Toggle() {
                var temp = document.getElementById("typepass1");
                if (temp.type === "password") { 
                    temp.type = "text"; 
                } 
                else { 
                temp.type = "password"; 
                }
            }
        </script>
    </body>
<?php
require 'footer.php';
?>
</html>