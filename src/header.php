<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php
        if (str_contains($_SERVER["PHP_SELF"], "ask_view/ask.php")) {
            $src = "../";
            echo '<link rel="stylesheet" href="'.$src.'ask_view/style.css">';
        } elseif (str_contains($_SERVER["PHP_SELF"], "home_view/index.php")) {
            $src = "../";
            echo '<link rel="stylesheet" href="'.$src.'home_view/style.css">';
            
        } elseif (str_contains($_SERVER["PHP_SELF"], "answers.php")) {
            $src = "./";
        } elseif (str_contains($_SERVER["PHP_SELF"], "error.php")) {
            $src = "./";
        } elseif (str_contains($_SERVER["PHP_SELF"], "account_views/myaccount.php")) {
            $src = "../";
        } elseif (str_contains($_SERVER["PHP_SELF"], "account_views/accounts.php")) {
            $src = "../";
        } else {
            $src = "./"; //unsecure to use an else like this
        }
    ?>
    <!-- CSS only -->
    <link rel="stylesheet" href="<?=$src?>css/main.css">
    <link rel="stylesheet" href="<?=$src?>css/cooleffects.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/> <!-- for search logo in ask_view/ask.php subject field -->
    <title>SCOOL</title>
</head>
<body>
    
    <div class="container">
        <header class="index-header">
        <ul class="div-0-m" style="list-style-type: none;">
            <li><a href="<?=$src?>home_view/index.php" class="hvr-fill nice-text">Home</a></li>
            <li><a href="<?=$src?>account_views/myaccount.php" class="hvr-fill nice-text">My&nbsp;Account</a></li>
            <li><a href="<?=$src?>ask_view/ask.php" class="hvr-fill nice-text">Ask&nbsp;a&nbsp;Question</a></li>
        </ul>
        <?php
        
            if (isset($_SESSION['userId'])) {
                echo '<div class="">
                    <form action="'.$src.'includes/logout.inc.php" method="post">
                        <button type="submit" class="logout-index btn btn-outline-primary" name="logout-submit">Logout</button>  
                    </form>
                    </div>';
            }
            else {
                if (isset($_GET['loginerror'])) {
                    if ($_GET['loginerror'] == "emptyfields") {
                        $typedEmail = $_GET['email'];
                        echo    '<div class="col-md-3 align-items-center">
                               <form action="'.$src.'includes/login.inc.php" method="post">
                                    <input class="col-md-9" type="text" name="email" placeholder="email" value="'.$typedEmail,'">
                                    <input class="col-md-9" type="password" name="password" placeholder="password">
                                    <button type="submit" name="login-submit" class="btn btn-outline-primary me-2 col-md-9">Login</button>
                                </form>
                                <p style="color: red;">Fill in all fields!</p>
                            </div>
                            <div class="row-md-1 text-end">

                                <p class="row">Don\'t have an account?</p>
                                <form action="'.$src.'signup.php">
                                <button type="submit" class="btn btn-primary row">Sign-up</button>
                                </form>
                            </div>';

                    }
                    elseif ($_GET['loginerror'] == "wrongpassword") {
                        echo    '<div class="col-md-3 align-items-center">
                               <form action="'.$src.'includes/login.inc.php" method="post">
                                    <input class="col-md-9" type="text" name="email" placeholder="email">
                                    <input class="col-md-9" type="password" name="password" placeholder="password">
                                    <button type="submit" name="login-submit" class="btn btn-outline-primary me-2 col-md-9">Login</button>
                                </form>
                                <p style="color: red;">Incorrect password</p>
                            </div>
                            <div class="row-md-1 text-end">

                                <p class="row">Don\'t have an account?</p>
                                <form action="'.$src.'signup.php">
                                <button type="submit" class="btn btn-primary row">Sign-up</button>
                                </form>
                            </div>';
                    }
                    elseif ($_GET['loginerror'] == "emailnotfound") {
                        echo    '<div class="col-md-3 align-items-center">
                               <form action="'.$src.'includes/login.inc.php" method="post">
                                    <input class="col-md-9" type="text" name="email" placeholder="email">
                                    <input class="col-md-9" type="password" name="password" placeholder="password">
                                    <button type="submit" name="login-submit" class="btn btn-outline-primary me-2 col-md-9">Login</button>
                                </form>
                                <p style="color: red;">Account not found</p>
                            </div>
                            <div class="row-md-1 text-end">

                                <p class="row">Don\'t have an account?</p>
                                <form action="'.$src.'signup.php">
                                <button type="submit" class="btn btn-primary row">Sign-up</button>
                                </form>
                            </div>';
                    }
                    else {
                        echo    '<div class="col-md-3 align-items-center">
                               <form action="'.$src.'includes/login.inc.php" method="post">
                                    <input class="col-md-9" type="text" name="email" placeholder="email">
                                    <input class="col-md-9" type="password" name="password" placeholder="password">
                                    <button type="submit" name="login-submit" class="btn btn-outline-primary me-2 col-md-9">Login</button>
                                </form>
                                <p style="color: red;">An error occured</p>
                            </div>
                            <div class="row-md-1 text-end">

                                <p class="row">Don\'t have an account?</p>
                                <form action="'.$src.'signup.php">
                                <button type="submit" class="btn btn-primary row">Sign-up</button>
                                </form>
                            </div>';
                    }

                }
                else {
                    echo    '<div class="div-1-m">
                               <form action="'.$src.'includes/login.inc.php" method="post">
                                    <input class="inp-1-m" type="text" name="email" placeholder="email">
                                    <input class="inp-2-m" type="password" name="password" placeholder="password">
                                    <button type="submit" name="login-submit" class="inp-3-m btn btn-outline-primary">Login</button>
                                </form>
                            </div>
                            <div class="div-2-m">
                                <a href="'.$src.'signup.php" class="inp-4-m">Don\'t have an account?</a>
                            </div>';
                }
            }
        ?>
        </header>
    </div>
    


 