<?php
session_start();
require 'dbh.inc.php';

$id_message = $_GET['msgid'];

if (isset($_SESSION['userId'])) {
    if (isset($_POST['publish'])) {
        if (!empty($_POST['msg'])) {
            $id_messenger = $_SESSION['userId'];
            $message = nl2br(htmlspecialchars($_POST['msg']));

            $sql = "INSERT INTO messages_answers (id_message, id_messenger, answer) VALUES (?, ?, ?);";
                $stmt = mysqli_stmt_init($conn);
                if (!mysqli_stmt_prepare($stmt, $sql)) {
                    header("Location: ../answers.php?msgid=".$id_message."&puberror=sqlerror");
                    exit();
                }
                else {
                    mysqli_stmt_bind_param($stmt, "iis", $id_message, $id_messenger, $message);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../answers.php?msgid=".$id_message."&publish=success");
                    exit();
                }
        }
        else {
            header("Location: ../answers.php?msgid=".$id_message."&puberror=emptyfields");
            exit();
        }
    }
    else {
        header("Location: ../answers.php?msgid=".$id_message);
        exit();
    }
}
else {
    header("Location: ../answers.php?msgid=".$id_message."&puberror=notloggedin");
    exit();
}