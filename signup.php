<?php
    require "header.php"
?>

    <main>
        <div class="text-center">
        <h1>Sign Up</h1>
        <?php
        if (isset($_GET['signuperror'])) {
            if ($_GET['signuperror'] == "emptyfields") {
                echo '<p>Fill in all fields!</p>';
            }
            elseif ($_GET['signuperror'] == "invalidemailusername") {
                echo '<p>Invalid email and username</p>';
            }
            elseif ($_GET['signuperror'] == "invalidemail") {
                echo '<p>Invalid email</p>';
            }
            elseif ($_GET['signuperror'] == "invalidusername") {
                echo '<p>Username must only contains letters and numbers</p>';
            }
            elseif ($_GET['signuperror'] == "passwordnotmatching") {
                echo '<p>Passwords are not matching</p>';
            }
            elseif ($_GET['signuperror'] == "emailalreadytaken") {
                echo '<p>This email as already an account</p>';
            }
            else {
                echo '<p>An error happened</p>';
            }
        }
        elseif (isset($_GET['signup'])) {
            if ($_GET['signup'] == "success") {
                echo '<p>Sign up successful!</p>';
            }
        }
        ?>
        <form class="form-inline" action="includes/signup.inc.php" method="POST">
            <input type="text" name="email" placeholder="email">
            <input type="text" name="username" placeholder="username">
            <input type="password" name="password" placeholder="password">
            <input type="password" name="password-check" placeholder="retype password">
            <button type="submit" class="btn btn-primary" name="signup-submit">Create account</button>
        </form>
        </div>
        
    </main>

<?php
    require 'footer.php';
?>
