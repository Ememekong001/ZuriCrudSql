<?php
include("action.php");
if(!isset($_SESSION["reset"]) && !isset($_SESSION["changepass"])){
    header("location:./reset.php");
}
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
                    <p align="left">New password </p>
                    <input type="password" name="newpass" class="input-control" placeholder="Enter New password"/>
                    <br/>
                    <p align="left">Confirm password </p>
                    <input type="password" name="confirmnewpass" class="input-control" placeholder="Re-Enter New password"/>
                    <br/>
                    <?php
                    if($success){
                        echo '<div class="success">Password changed</div>';
                    }
                    else{
                        echo '<div class="error">'.$error.'</div>';
                    }
                    ?>
                    <br/>
                    <center>
                        <button class="login-btn" name="resetpass">Change Password</button>
                    </center>
                </form>
                <small>Remember password? <a href="login.php"><i>Login</i></a></small><br/>
            </div>
        </center>
    </body>
</html>