<?php
require 'dbh.inc.php';
if (isset($_POST['modmsgbtnc'])) {
    if ($_POST['ques_content'] != 'hahaha') {

        $courseIdFromGet = $_GET['courseid'];
        $newQues = nl2br(htmlspecialchars($_POST['ques_content']));
        $quesId = $_POST['ques_id'];

        $sql = "UPDATE courses_messages SET message=? WHERE id=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../error.php");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "si", $newQues, $quesId);
            mysqli_stmt_execute($stmt);
            header("Location: ../course.php?courseid=".$courseIdFromGet."&change=success".$quesId);
            exit();
        }
    }
    else {
        header("Location: ../course.php?courseid=".$courseIdFromGet);
        exit();
    }
}
else {
    header("Location: ../error.php");
    exit();    
}