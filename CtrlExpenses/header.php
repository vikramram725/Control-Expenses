<nav class="navbar navbar-inverse navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">CT₹L EXPENSES</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
                <ul class="nav navbar-nav navbar-right">
                    <?php
                    if (isset($_SESSION['email'])){
                    ?>
                    <li><a href = "about_us.php"><span class="glyphicon glyphicon-info-sign"></span> About Us</a></li>
                    <li><a href = "change_password.php"><span class="glyphicon glyphicon-user"></span> Change Password</a></li>
                    <li><a href = "logout.php"><span class="glyphicon glyphicon-log-in"></span> Logout</a></li>
                    <?php
                    }
                    else{
                    ?>
                    <li><a href = "about_us.php"><span class="glyphicon glyphicon-info-sign"></span>About Us</a></li>
                    <li><a href="signup.php"><span class="glyphicon glyphicon-user" ></span>Sign Up</a></li>
                    <li><a href="login.php"><span class="glyphicon glyphicon-log-in" ></span>Login</a></li>
                    <?php
                    }
                    ?>
                </ul>
            </div>
        </div>
</nav>