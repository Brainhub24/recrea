<?php
    require 'header.php';
    require 'includes/dbh.inc.php';
?>
<?php
    $getCourseId = $_GET['courseid'];

    $sql = "SELECT * FROM courses WHERE id=?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("Location: error.php");
        exit();
    }
    else {
        mysqli_stmt_bind_param($stmt, "i", $getCourseId);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        if ($row = mysqli_fetch_assoc($result)) {
            $courseId = $row['id'];
            $courseName = $row['name'];
            $courseNatId = $row['nat_id'];
            $courseSubject = $row['subject'];
            $courseDesc = $row['description'];

        }
        else {
            header("Location: error.php");
            exit();
        }
    }

    echo '<p class="text-center"><span class="course-header">'.$courseName.'</span>   <span style="font-size: 25px;">('.$courseNatId.')</span></p>';
?>

<!-- whole chat frame -->
<div class="msgsys-container">

    <!-- display messages -->
    <div class="display-messages-container" id="display-messages-container-course">
    <div class="display-messages">
    
        <?php
        // query all messages from a specific course
        $sqlmsg = "SELECT * FROM courses_messages WHERE id_course=$courseId ORDER BY time_posted;";
        $resultmsg = mysqli_query($conn, $sqlmsg);
        $resultmsgCheck = mysqli_num_rows($resultmsg);
        if ($resultmsgCheck > 0) {
            while ($rowmsg = mysqli_fetch_assoc($resultmsg)) {
                // query the name of the messenger for each post
                $idQues = $rowmsg['id'];
                $idMsgr = $rowmsg['id_messenger'];
                $sqlmsg2 = "SELECT username FROM users WHERE id=$idMsgr;";
                $resultmsg2 = mysqli_query($conn, $sqlmsg2);
                if ($rowmsg2 = mysqli_fetch_assoc($resultmsg2)) {
                    // check if message is from current user for different css 
                    if (isset($_SESSION['userId']) && $idMsgr == $_SESSION['userId']) {
                      $cleanedMessage = str_replace('<br />', '', $rowmsg["message"]);
                      echo '
                        <div class="displayed-messages msgself">
                        <p>'.$rowmsg["message"].'</p>
                        <div class="container">
                        <div class="row">
                        <div class="col-8"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-fill" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg> <span style="color: white;">'.$rowmsg2["username"].'</span></div>
                        <div class="col-1" title="see answers"><a href="answers.php?msgid='.$idQues.'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-back" viewBox="0 0 16 16"><path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/></svg></a></div>
                        <div class="col-1" title="answer your comment"><button class="btn-reseter" type="button" data-bs-toggle="modal" data-bs-target="#ansmsg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-chat" viewBox="0 0 16 16"><path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/></svg></button></div>
                        <div class="col-1" title="edit your comment"><button class="btn-reseter modmsgbtn" data-comment-content="'.$cleanedMessage.'" data-comment-id="'.$idQues.'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16"><path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/></svg></button></div>
                        <div class="col-1" title="delete your comment"><button class="btn-reseter delmsgbtn" data-comment-id="'.$idQues.'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16"><path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/></svg></button></div>
                        </div>
                        </div>
                        </div>
                        ';
                    }
                    // if not from current user
                    else {
                        echo '
                        <div class="displayed-messages">
                        <p>'.$rowmsg["message"].'</p>
                        <div class="container">
                        <div class="row">
                        <div class="col-9"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#156efd" class="bi bi-person-fill" viewBox="0 0 16 16"><path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6z"/></svg> <span style="color: #156efd;">'.$rowmsg2["username"].'</span></div>
                        <div class="col-1" title="see answers"><a href="answers.php?msgid='.$idQues.'"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#156efd" class="bi bi-back" viewBox="0 0 16 16"><path d="M0 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v2h2a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-2H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v8a1 1 0 0 0 1 1h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2z"/></svg></a></div>
                        <div class="col-1" title="respond to the comment"><button class="btn-reseter" type="button" data-bs-toggle="modal" data-bs-target="#ansmsg"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#156efd" class="bi bi-chat" viewBox="0 0 16 16"><path d="M2.678 11.894a1 1 0 0 1 .287.801 10.97 10.97 0 0 1-.398 2c1.395-.323 2.247-.697 2.634-.893a1 1 0 0 1 .71-.074A8.06 8.06 0 0 0 8 14c3.996 0 7-2.807 7-6 0-3.192-3.004-6-7-6S1 4.808 1 8c0 1.468.617 2.83 1.678 3.894zm-.493 3.905a21.682 21.682 0 0 1-.713.129c-.2.032-.352-.176-.273-.362a9.68 9.68 0 0 0 .244-.637l.003-.01c.248-.72.45-1.548.524-2.319C.743 11.37 0 9.76 0 8c0-3.866 3.582-7 8-7s8 3.134 8 7-3.582 7-8 7a9.06 9.06 0 0 1-2.347-.306c-.52.263-1.639.742-3.468 1.105z"/></svg></button></div>
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
            echo 'no message yet';
        }
        ?>

    </div>
    </div> 

    <!-- write message -->
    
    <form action="includes/pubques.inc.php?courseid=<?php echo $getCourseId;?>" id="comment" class="text-center" method="POST">
        <div class="write-msg-cont">
            <textarea form="comment" name="msg" id="msg-input-text" cols="70" rows="4" maxlength="1000" class="textareacom" placeholder="write your question here..."></textarea>
        </div>
        <button type="submit" name="publish" value="submit" class="btn btn-primary text-center hvr" style="width: 30%; margin-top: 5px;"><span>submit</span></button>
    </form>

</div> 
<!-- end of whole chat frame -->


<!-- popups -->

<!-- del msg popup -->

<div class="modal fade" id="delmsg" tabindex="-1" aria-labelledby="delmsgLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="delmsgLabel">Are you sure you want to delete this message?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
        <form method="POST" action="includes/delmsg.inc.php?courseid=<?= $getCourseId ?>">
          <input type="hidden" name="ques_id" id="ques_id_input"/>
          <button name="delmsgbtnc" type="submit" class="btn btn-danger">delete</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- end of del msg popup -->


<!-- mod msg popup -->

<div class="modal fade" id="modmsg" tabindex="-1" aria-labelledby="modmsgLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
    <form id="modmsgform" method="POST" action="includes/modmsg.inc.php?courseid=<?= $getCourseId ?>">
      <div class="modal-header">
        <h5 class="modal-title" id="modmsgLabel">You can modify your question</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <textarea form="modmsgform" name="ques_content" id="ques-cont-input" cols="70" rows="4" maxlength="1000" class="textareacom"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
        <input type="hidden" name="ques_id" id="modques-id-input"/>
        <button name="modmsgbtnc" type="submit" class="btn btn-warning">modify</button>
      </div>
    </form>
    </div>
  </div>
</div>

<!-- end of mod msg popup -->


<!-- answer msg popup -->

<div class="modal fade" id="ansmsg" tabindex="-1" aria-labelledby="ansmsgLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ansmsgLabel">Are you sure you want to delete this message?</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancel</button>
        <button type="button" class="btn btn-success">answer</button>
      </div>
    </div>
  </div>
</div>

<!-- end of answer msg popup -->


<!-- end of popups -->


<script src="javascript/course.php.js" defer></script>
<?php
    require 'footer.php';
?>

