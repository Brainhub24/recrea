<?php       // handles the publishing of questions from ask.php
session_start();
require 'dbh.inc.php';


if (isset($_SESSION['userId'])) {
    if (isset($_POST['publish'])) {
        if (!empty($_POST['msg'])) {
            $id_messenger = $_SESSION['userId'];
            $message = nl2br(htmlspecialchars($_POST['msg']));
            $subject_name = $_POST['subject'];

            $sql = "INSERT INTO ask_messages (id_messenger, message, id_subject) SELECT ?, ?, subjects.id FROM subjects WHERE subjects.name = ? LIMIT 1;";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../ask_view/ask.php?puberror=sqlerror");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "iss", $id_messenger, $message, $subject_name);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../ask_view/ask.php?publish=success");
                    exit();
                }
        }
        else {
            header("Location: ../ask_view/ask.php?puberror=emptyfields");
            exit();
        }
    }
    else {
        header("Location: ../ask_view/ask.php");
        exit();
    }
}
else {
    header("Location: ../ask_view/ask.php?puberror=notloggedin");
    exit();
}