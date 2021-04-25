<?php
include("action.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Login | CRUD</title>
        <link rel="shortcut icon" href="./img/app3.jpg"/>
        <link rel="stylesheet" href="./css/style.css"/>
    </head>
    <body id="login-body">
        <center>
            <div class="card login-card">
                <h3 class="txt-b">Account Login</h3>
                <br/>
                <center>
                    <img class="login-img" src="./img/app3.jpg"/>
                </center>
                <br/>
                <?php
                if (isset($_GET["register_success"])) {
                    echo '<div class="success">You have been registered successfully. Login now</div>';
                }
                ?>
                
                <form method="POST" action="">
                    <p align="left">Email </p>
                    <input class="input-control" name="email" type="email" placeholder="Enter Email"/>
                    <br/>
                    <p align="left">Password </p>
                    <input type="password" name="password" class="input-control" placeholder="Enter Password"/>
                    <br/>
                    <?php echo '<div class="error">'.$error.'</div>';?>
                    <br/>
                    <center>
                        <button class="login-btn" name="login">Login</button>
                    </center>
                </form>
                <small>Don't have an account? <a href="register.php"><i>Register</i></a></small><br/>
                <small>Forgot Password <a href="reset.php"><i>Reset Now</i></a></small>
            </div>
        </center>
    </body>
</html>