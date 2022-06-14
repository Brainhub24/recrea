<?php

if (isset($_POST['login-submit'])) {
    
    require 'dbh.inc.php';

    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: ../index.php?loginerror=emptyfields&email=".$email);
        exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE email=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../index.php?loginerror=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if ($row = mysqli_fetch_assoc($result)) {
                $passwordChecking = password_verify($password, $row['hpassword']);
                if ($passwordChecking == false) {
                    header("Location: ../index.php?loginerror=wrongpassword");
                    exit();
                }
                elseif ($passwordChecking == true) {
                    session_start();
                    $_SESSION['userId'] = $row['id'];
                    $_SESSION['useremail'] = $row['email'];
                    $_SESSION['username'] = $row['username'];

                    header("Location: ../index.php?login=success");
                    exit();
                }
                else {
                    header("Location: ../index.php?loginerror=wrongpassword");
                    exit();
                }
            }
            else {
                header("Location: ../index.php?loginerror=emailnotfound");
                exit();
            }
        }
    }

}

else {
    header("Location: ../error.php");
    exit();
}