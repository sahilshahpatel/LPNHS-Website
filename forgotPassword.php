<!Doctype HTML>
<?php
    session_start();
    require "database.php";
    $invalid = false;
    if(isset($_GET['email'])){$invalid = true;}

?>
<html>
    <head>

        <title>LPNHS - Forgot My Password</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="baseCSS.css">


    </head>

    <header id = "header"><?php include "header.php"; ?></header>

    <body>
		<div id = "footerPusher">

            <form id="login" class="form" action="sendRecoveryEmail.php" method="post">
                <div>
                    <h id="logTitle">Forgot My Password</h>
                    <hr class="loghr">
                    <br/>
                    <?php 
                        if($invalid){
                            echo '<p style = "color: red; text-align: center; font-size: 16px; font-weight: bold;">A user with that email does not exist</p>';
                        }
                    ?>
                    <input class="input2" placeholder = "Email*" type = "email" name = "email" autofocus required>
                    <br/><br/>
                    <button id = "loginButton" type = "submit" name = 'submit' value="forgotPassword" style = "min-height: 75px;">Send Recovery Email</button>
                </div>              
            </form>
            
        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html> 