<?php 
    require 'header.php';
    require 'includes/dbh.inc.php';

    $getMessageId = $_GET['msgid'];

    $sql = "SELECT * FROM courses_messages WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: error.php");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $getMessageId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $courseMessagesId = $row['id'];
            $courseMessagesCourseId = $row['id_course'];
            $courseMessagesMessengerId = $row['id_messenger'];
            $courseMessagesMessage = $row['message'];
        }
        else {
            header("Location: error.php");
            exit();
        }
    }
    $sql3 = "SELECT * FROM courses WHERE id=?;";
    $stmt3 = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt3, $sql3)) {
        header("Location: error.php");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt3, "i", $courseMessagesCourseId);
        mysqli_stmt_execute($stmt3);
        $result3 = mysqli_stmt_get_result($stmt3);
        if ($row3 = mysqli_fetch_assoc($result3)) {
            $courseId = $row3['id'];
            $courseName = $row3['name'];
            $courseNatId = $row3['nat_id'];
            $courseSubject = $row3['subject'];
            $courseDesc = $row3['description'];

        }
        else {
            header("Location: error.php");
            exit();
        }
    }

    echo '<p class="text-center"><span class="course-header">'.$courseMessagesMessage.'</span>   <span style="font-size: 25px;">('.$courseNatId.')</span></p>';
?>


<!-- whole chat frame -->
<div class="msgsys-container">

    <!-- display messages -->
    <div class="display-messages-container" id="display-messages-container-course">
    <div class="display-messages">
    
        <?php
        // query all answers from a specific question
        $sqlmsg = "SELECT * FROM messages_answers WHERE id_message=$courseMessagesId ORDER BY time_posted;";
        $resultmsg = mysqli_query($conn, $sqlmsg);
        $resultmsgCheck = mysqli_num_rows($resultmsg);
        if ($resultmsgCheck > 0) {
            while ($rowmsg = mysqli_fetch_assoc($resultmsg)) {
                // query the name of the messenger for each answers
                $idQues = $rowmsg['id'];
                $idMsgr = $rowmsg['id_messenger'];
                $sqlmsg2 = "SELECT username FROM users WHERE id=$idMsgr;";
                $resultmsg2 = mysqli_query($conn, $sqlmsg2);
                if ($rowmsg2 = mysqli_fetch_assoc($resultmsg2)) {
                    // check if message is from current user for different css 
                    if (isset($_SESSION['userId']) && $idMsgr == $_SESSION['userId']) {
                      $cleanedMessage = str_replace('<br />', '', $rowmsg["answer"]);
                      echo '
                        <div class="displayed-messages msgself">
                        <p>'.$rowmsg["answer"].'</p>
                        <div class="container">
                        <div class="row">
                        <div class="col-10"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-fill" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg> <span style="color: white;">'.$rowmsg2["username"].'</span></div>
                        <div class="col-1" title="edit your answer"><button class="btn-reseter modmsgbtn" data-comment-content="'.$cleanedMessage.'" data-comment-id="'.$idQues.'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg></button></div>
                        <div class="col-1" title="delete your answer"><button class="btn-reseter delmsgbtn" data-comment-id="'.$idQues.'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></div>
                        </div>
                        </div>
                        </div>
                        ';
                    }
                    // if not from current user
                    else {
                        echo '
                        <div class="displayed-messages">
                        <p>'.$rowmsg["answer"].'</p>
                        <div class="container">
                        <div class="row">
                        <div class="col-9"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#156efd" class="bi bi-person-fill" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg> <span style="color: #156efd;">'.$rowmsg2["username"].'</span></div>
                        </div>
                        </div>
                        </div>
                        ';
                    } 
                }
                else {
                    header("Location: error.php");
                    exit();
                }
            }
        }
        else {
            echo 'no answers yet';
        }
        ?>

    </div>
    </div> 

    <!-- write answer -->
    
    <form action="includes/pubans.inc.php?msgid=<?php echo $courseMessagesId;?>" id="comment" class="text-center" method="POST">
        <div class="write-msg-cont">
            <textarea form="comment" name="msg" id="msg-input-text" cols="70" rows="4" maxlength="1000" class="textareacom" placeholder="write your question here..."></textarea>
        </div>
        <button type="submit" name="publish" value="submit" class="btn btn-primary text-center hvr" style="width: 30%; margin-top: 5px;"><span>submit</span></button>
    </form>

</div> 
<!-- end of whole chat frame -->




<?php
    require 'footer.php';
?>