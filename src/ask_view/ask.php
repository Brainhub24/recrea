<?php
    require '../header.php';
    require '../includes/dbh.inc.php';
?>
<?php
if (!isset($_SESSION['userId'])) {
    echo '<div style="width: 300px; margin: auto;" class="text-center alert alert-warning alert-dismissible fade show" role="alert">you must be logged in</div>';
}
else {
    // echo the main
}
?>


<main>
    <p>
        <h3 class="text-center">Ask your question</h3>
    </p>
    <div class="msgsys-container" style="border: none;">
    <form action="../includes/pubques.inc.php" id="comment" class="text-center" method="POST">
        <div class="write-msg-cont">
            <textarea form="comment" name="msg" id="msg-input-text" cols="70" rows="4" maxlength="1000" class="textareacom" placeholder="write your question here..." required></textarea>
        </div>
        
        <!-- subject selector search -->
        <div class="subject-input">
        <input name="subject" type="text" placeholder="Subject" required><br>
            <div class="autocom-box">
                <?php 
                    $sqlSub = "SELECT name FROM subjects ORDER BY name ASC;";
                    $resultSub = mysqli_query($conn, $sqlSub);
                    while ($rowSub = mysqli_fetch_assoc($resultSub)) {
                        // query the name of all subjects
                        $subName = $rowSub['name'];
                        echo "<li class=\"subject-li\">".$subName."</li>";
                    }
                ?>
            </div>
        <div class="icon"><i class="fas fa-search"></i></div>
        </div>
        <!-- end subject selector search -->
        <br>
        <button type="submit" name="publish" value="submit" class="btn btn-primary text-center hvr" style="width: 30%; margin-top: 5px;"><span>submit</span></button>
    </form>
    </div>

</main>

<!-- script for handling search bar -->
<script src="ask.php.js" defer></script> 
<?php
    require '../footer.php';
?>