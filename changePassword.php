<!Doctype HTML>
<?php
    session_start();
    require "database.php";
    $msgGood = false;
    $msg = "";
    if(isset($_GET['email'])){
        if($_GET['email']==="not_sent"){
            $msg = "An error occurred. Reset email was not sent.";
        }
        else if($_GET['email']==="sent"){
            $msgGood = true;
            $msg = "Password reset email sent!";
        }
        else if($_GET['email']==="unknown"){
            $msg = "A user with that email does not exist.";
        }
    }

?>
<html>
    <head>

        <title>LPNHS - Change My Password</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">


    </head>

    <header id = "header"><?php include "header.php"; ?></header>

    <body>
		<div id = "footerPusher">

            <form id="login" class="form" action="sendRecoveryEmail.php" method="post" style = "display: block; margin: 30px auto; max-width: 350px; max-height: 225px;">
                <div>
                    <p>Change My Password</p>
                    <hr class="loghr">
                    <br/>
                    <?php 
                        if(!empty($msg)){
                            if($msgGood){
                                echo '<p style = "color: green; text-align: center; font-size: 16px; font-weight: bold;">', $msg, '</p>';
                            }
                            else{
                                echo '<p style = "color: red; text-align: center; font-size: 16px; font-weight: bold;">', $msg, '</p>';
                            }
                        }
                    ?>
                    <input class="input2" placeholder = "Email" type = "email" name = "email" autofocus required>
                    <br/><br/>
                    <input class = "classicColor" type = "submit" name = 'submit' value="Send Recovery Email">
                </div>           
            </form>
            
        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html> 