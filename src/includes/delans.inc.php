<?php
session_start();
if (isset($_POST['delmsgbtnc'])) {

    require 'dbh.inc.php';
    $messageIdFromGet = $_GET['msgid']; // id of the message the user answered
    $quesId = $_POST['ques_id']; // id of the answer of the user

    $sql = "DELETE FROM messages_answers WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../error.php");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $quesId);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../answers.php?msgid=".$messageIdFromGet); // returns the user to where he was
            exit();
        }
        else {
            header("Location: ../error.php");
            exit();
        }
    }
    

}
else {
    header("Location: ../error.php");
    exit();    
}