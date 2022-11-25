<?php
    require "../header.php";
    require '../includes/dbh.inc.php';
?>

    <main style="margin-bottom: 90px;">
        <div class="text-center">
        <h1>Welcome to Scool!</h1>
        <p class="paragraph">Scool is a platform where you can ask students in the same grade as you, pursuing the same courses as you, questions about an homework, upcoming exams, or just about a subject where you have difficulty.</p>
        </div>
        <!-- searchbox -->
        <?php
        if (isset($_POST['search-submit'])) {
            $courseSearch = $_POST['course-input'];
            echo "
            <div class='text-center' style='margin-top: 40px;'>
            <form action='index.php' method='POST'>
                <label for='course-input'>Search a question here...</label><br>
                <input name='course-input' type='text' id='course-input' placeholder='\"Calcul Différentiel\"' value='".$courseSearch."'>
                <button class='btn btn-primary index-search-btn' type='submit' name='search-submit'>Search</button>
            </form>
            </div>
            ";
        }
        else {
            echo "
                <div class='text-center' style='margin-top: 40px;'>
                <form action='index.php' method='POST'>
                    <label for='course-input'>Search a question here...</label><br>
                    <input name='course-input' type='text' id='course-input' placeholder='\"Calcul Différentiel\"'>
                    <button class='btn btn-primary index-search-btn' type='submit' name='search-submit'>Search</button>
                </form>
                </div>
                ";
        }

        ?>
        <?php
            if (isset($_POST['search-submit'])) {
                $rawSearch = $_POST['course-input'];
                if ($rawSearch != "") {
                    $search = "%{$rawSearch}%";
                    
                    $sql = "SELECT ask_messages.id, ask_messages.message, subjects.name FROM ask_messages INNER JOIN subjects ON ask_messages.id_subject=subjects.id WHERE ask_messages.message LIKE ? OR subjects.name LIKE ?;";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        header("Location: ../error.php");
                        exit();
                    }
                    else {
                        mysqli_stmt_bind_param($stmt, "ss", $search, $search);
                        mysqli_stmt_execute($stmt);
                        $result = mysqli_stmt_get_result($stmt);
                        $resultCheck = mysqli_num_rows($result);
                        if ($resultCheck > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo '
                                    <a href="../answers.php?msgid='.$row["id"].'" class="course-links">
                                    <div class="course-container">
                                    <h6>'.$row["message"].'</h6>
                                    </div>
                                    </a>
                                    ';
                            }
                        } 
                        else {
                            echo '<p class="text-center" style="color: red;">question not found</p>';
                        }
                    }
                }
            }
        ?>
<!-- https://stackoverflow.com/questions/12235595/find-most-frequent-value-in-sql-column -->
        
    </main>
<?php 
    require '../footer.php';
?>
