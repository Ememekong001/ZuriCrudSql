<?php
include("action.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reset Password | CRUD</title>
        <link rel="shortcut icon" href="./img/app3.jpg"/>
        <link rel="stylesheet" href="./css/style.css"/>
    </head>
    <body id="login-body">
        <center>
            <div class="card login-card">
                <h3 class="txt-b">Reset Password</h3>
                <br/>
                <center>
                    <img class="login-img" src="./img/app3.jpg"/>
                </center>
                <br/>
                 <form method="POST" action="">
                    <p align="left">Email</p>
                    <input type="email" name="email" class="input-control" placeholder="Enter email"/>
                    <br/>
                    <?php echo '<div class="error">'.$error.'</div>';?>
                    <br/>
                    <center>
                        <button class="login-btn" name="getemail">Get code</button>
                    </center>
                </form>
                <small>Remember password? <a href="login.php"><i>Login</i></a></small><br/>
            </div>
        </center>
    </body>
</html>