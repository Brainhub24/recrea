<?php

if (isset($_POST['delmsgbtnc'])) {

    require 'dbh.inc.php';
    $courseIdFromGet = $_GET['courseid'];
    $quesId = $_POST['ques_id'];

    $sql = "DELETE FROM courses_messages WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: ../error.php");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $quesId);
        mysqli_stmt_execute($stmt);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: ../course.php?courseid=".$courseIdFromGet);
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