<?php
if (isset($_POST['signup-submit'])) {

    require 'dbh.inc.php';

    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordcheck = $_POST['password-check'];

    if (empty($email) || empty($username) || empty($password) || empty($passwordcheck)) {
        header("Location: ../signup.php?signuperror=emptyfields&email=".$email."&username=".$username);
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?signuperror=invalidemailusername");
        exit();
    }
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../signup.php?signuperror=invalidemail");
        exit();
    }
    elseif (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("Location: ../signup.php?signuperror=invalidusername&email=".$email);
        exit(); 
    }
    elseif ($password !== $passwordcheck) {
        header("Location: ../signup.php?signuperror=passwordnotmatching&email=".$email);
        exit();
    }
    else {
        $sql = "SELECT email FROM users WHERE email=?;"; 
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../signup.php?signuperror=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0) {
                header("Location: ../signup.php?signuperror=emailalreadytaken");
                exit();
            }
            else {
                $sql = "INSERT INTO users (email, username, hpassword) VALUES (?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../signup.php?signuperror=sqlerror");
                    exit();
                }
                else {

                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    mysqli_stmt_bind_param($stmt, "sss", $email, $username, $hashed_password);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../signup.php?signup=success");
                    exit();
                }    
            }
        }
    }  
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}

else {
    header("Location: ../signup.php");
    exit();
}