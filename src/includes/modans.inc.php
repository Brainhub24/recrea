<?php
session_start();
require 'dbh.inc.php';
if (isset($_POST['modmsgbtnc'])) {
    $messageIdFromGet = $_GET['msgid']; // id of the message (question) the user answered
    if ($_POST['ques_content'] != '') {

        $newQues = nl2br(htmlspecialchars($_POST['ques_content']));
        $quesId = $_POST['ques_id']; // id of the answer of the user

        $sql = "UPDATE messages_answers SET answer=? WHERE id=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../error.php");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "si", $newQues, $quesId);
            mysqli_stmt_execute($stmt);
            header("Location: ../answers.php?msgid=".$messageIdFromGet."&change=success");
            exit();
        }
    }
    else {
        header("Location: ../answers.php?msgid=".$messageIdFromGet);
        exit();
    }
}
else {
    header("Location: ../error.php");
    exit();    
}