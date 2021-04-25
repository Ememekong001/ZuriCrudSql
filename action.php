<?php
include("config.php");
session_start();  
$error = "";
$time = time();
$success = false;

/* Signup */
if (isset($_POST["signup"])) {

    if (empty($_POST["email"]) || empty($_POST["password"]) || empty($_POST["confirmpass"]) || empty($_POST["firstname"]) || empty($_POST["lastname"])) {
        $error = "Please fill in all fields!";
    } 
    elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format!";
    }
    elseif ($_POST["password"] !== $_POST["confirmpass"]) {
        $error = "The two passwords do not match!";
    }
    elseif (strlen($_POST["password"]) < 8) {
        $error = "Password must be 8 characters or more!";
    }
    else {
        $email = mysqli_real_escape_string($db, filter_var($_POST["email"], FILTER_SANITIZE_EMAIL));
        $firstname = mysqli_real_escape_string($db, filter_var($_POST["firstname"], FILTER_SANITIZE_STRING));
        $lastname = mysqli_real_escape_string($db, filter_var($_POST["lastname"], FILTER_SANITIZE_STRING));
        $password = mysqli_real_escape_string($db, password_hash($_POST["password"], PASSWORD_DEFAULT));

        $q = mysqli_query($db, "SELECT email FROM users WHERE email = '$email'");
        if (mysqli_num_rows($q) > 0) {
            $error = "Email already exists!";
        }
        else {
            mysqli_query($db, "INSERT INTO users(firstname,lastname,email,password,datecreated)VALUES('$firstname','$lastname','$email','$password','$time')");
            $success = true;
        }
    }
}
elseif (isset($_POST["login"])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        $error = "Please fill in all fields!";
    } 
    else {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $q = mysqli_query($db, "SELECT * FROM users WHERE email = '$email' ");
        if (mysqli_num_rows($q) == 0) {
            $error = "Wrong email or password";
        } 
        else {
            while ($r = mysqli_fetch_array($q)) {
                $hash = $r["password"];
                if (password_verify($password, $hash)) {
                    $_SESSION["email"] = $email;
                    header("location: ./index.php");
                    die;
                } 
                else {
                    $error = "Wrong email or password";
                }
                
            }
        }
        
    }
}
elseif (isset($_POST["getemail"])) {
    if (empty($_POST["email"])) {
        $error = "Please fill in email field!";
    } 
    elseif (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
       $email = "Invalid email format!";
    }
    else {
        $email = $_POST["email"];
        $q = mysqli_query($db, "SELECT * FROM users WHERE email = '$email' ");
        if (mysqli_num_rows($q) == 0) {
            $error = "This email does not exist in our system!";
        } 
        else {
            $token = rand(10000000, 99999999);
            $_SESSION["reset"] = true;
            $_SESSION["email"] = $email;
            $_SESSION["code"] = $token;
            mysqli_query($db, "INSERT INTO reset_pass(email, token, time)VALUES('$email', '$token', '$time')");
            header("location:verifycode.php");
        }
        
    }
}
elseif (isset($_POST["verifycode"])) {
    if (empty($_POST["token"])) {
        $error = "Please input 8-digit code!";
    } 
    else {
        $token = $_POST["token"];
        $email = $_SESSION["email"];
        $q = mysqli_query($db, "SELECT * FROM reset_pass WHERE email = '$email' AND token = '$token'");
        if (mysqli_num_rows($q) == 0) {
            $error = "Invalid or expired token!";
        } else {
            $_SESSION["changepass"] = true;
            header("location:changepass.php");
        }
        
    }
}
elseif (isset($_POST["resetpass"])) {
    if (empty($_POST["confirmnewpass"]) || empty($_POST["newpass"])) {
        $error = "Please fill in all fields!";
    }
    elseif ($_POST["confirmnewpass"] !== $_POST["newpass"]) {
        $error = "The two passwords do not match";
    } 
    elseif (strlen($_POST["newpass"]) < 8) {
       $error = "Password must be 8 characters or more!";
    }
    else {
        $email = $_SESSION["email"];
        $newpass = mysqli_real_escape_string($db, password_hash($_POST["newpass"], PASSWORD_DEFAULT));
        mysqli_query($db, "UPDATE users SET password = '$newpass' WHERE email = '$email' ");
        $success = true;
    }
}
elseif (isset($_POST["add_course"])) {
    $course_code = mysqli_real_escape_string($db, filter_var($_POST["course_code"], FILTER_SANITIZE_STRING));
    $title = mysqli_real_escape_string($db, filter_var($_POST["title"], FILTER_SANITIZE_STRING));
    $credit_unit = htmlspecialchars($_POST["credit_units"]);
    mysqli_query($db, "INSERT INTO courses(course_code, title, credit_unit)VALUES('$course_code','$title','$credit_unit')");
    $success = true;
}
elseif (isset($_POST["update_course"])) {
    $id = htmlspecialchars($_POST["id"]);
    $course_code = mysqli_real_escape_string($db, filter_var($_POST["course_code"], FILTER_SANITIZE_STRING));
    $title = mysqli_real_escape_string($db, filter_var($_POST["title"], FILTER_SANITIZE_STRING));
    $credit_unit = htmlspecialchars($_POST["credit_units"]);
    mysqli_query($db, "UPDATE courses SET course_code = '$course_code', title = '$title', credit_unit = '$credit_unit' WHERE id = '$id'");
    header("location: ./");
}
elseif (isset($_GET["delete_course"])) {
    $id = htmlspecialchars($_GET["delete_course"]);
    mysqli_query($db, "DELETE FROM courses WHERE id = '$id' ");
    header("location:./");
}
else {
    //header("location: ./");
}