<!Doctype HTML>
<?php 
    session_start();
    require "database.php";

    // Checking if they are already logged in
        if(isset($_SESSION['StudentID'])){
            header("Location: index.php");
        }

    $loginError = false;

    // Checking for error cookie

        if(isset($_GET['login'])){$loginError = true;}

?>
<html>
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no" />
    <head>

        <title>LPNHS - Login</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">
        <style>
            body{
                margin: 0px;
                background-color: #005da3;
                text-align: center;
            }
            @media only screen and (max-width: 780px) {
                #loginImage{
                    display:none;
                }
            }
        </style>

    </head>

    <header id = "header"><?php include "header.php"; ?></header>

    <body>
		<div id = "footerPusher">

            <img id = "fixedBGImg" src = "img/NHS_logo.png"> <!--Fixed image in background-->

            <form id="login" class="form" action="session.php" method="post">
                <div>
                    <p style = "font-size: 30px; text-decoration: underline;">Sign in</p>
                    <br/>
                    <?php 
                        if($loginError){
                            echo '<p style = "color: red; font-weight: bold;font-size: 22px;">Incorrect email or password</p>';
                        }
                    ?>
                    <p>Email</p>
                    <input id = "loginEmail" placeholder = "Email" type = "email" name = "email" autofocus required>
                    <br/><br/>
                    <p>Password </p>
                    <input id = "loginPassword" placeholder = "Password" type = "password" name = "password" required>
                    <p><a style = "font-size: 12px; color: #fff;" href = "changePassword.php">Forgot your password?</a></p>
                    <button id = "loginButton" type = "submit" value="Log In">Sign In</button>
                </div>
                <div>
                    <img id="loginImage" style = "margin: auto;" src = "img/NHS_logo.png">
                </div>                
            </form>
            
        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>