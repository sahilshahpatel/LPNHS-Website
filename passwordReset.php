<!DOCTYPE HTML>
<?php
    session_start();
    require "database.php";

    $success = false; //Initially false until the database is updated!
    $errorMsg = "";
    $firstTime = true;

    if(isset($_POST["submit"])){
        if($_POST['password']===$_POST['confirmPassword']){
            $firstTime = false;
            $sql = "SELECT * FROM passrecovertokens WHERE Token = :token AND Expiration >= Now()";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['token' => $_GET['token']]);
            $tokenData = array();
            $tokenData = $stmt->fetchAll();
            if(!empty($tokenData) && $tokenData[0][1]===$_GET['userID']){
                $sql = "UPDATE students SET PasswordHash=:passHash WHERE StudentID=:studentID";
                $stmt = $pdo->prepare($sql);
                $success = $stmt->execute(['passHash' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'studentID' => $tokenData[0][1]]);
                if($success){ //Delete token if it has been used
                    $sql = "DELETE FROM passrecovertokens WHERE Token = :token";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['token' => $_GET['token']]);
                }
                else{
                    $errorMsg = "An error occurred. Please try again later.";
                }
            }
        }
        else{
            $errorMsg = "Passwords did not match.";
        }
    }
?>
<html>
    <head>

        <title>LPNHS - Password Reset</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">

    </head>

    <header id = "header"><?php include "header.php"; ?></header>

    <body>
		<div id = "footerPusher">

            <form id = "login" class="form" action="passwordReset.php?token=<?php echo $_GET['token'];?>&userID=<?php echo $_GET['userID'];?>" method="post" style = "display: block; margin: 30px auto; max-width: 350px; max-height: 275px;">
                <div>
                    <p>Password Reset</p>
                    <hr class="loghr">
                    <br/>
                    <?php 
                        if($success){
                            echo '<p style = "color: green; text-align: center; font-size: 16px; font-weight: bold;">Password updated</p>';
                        }
                        else if(!$firstTime){
                            echo '<p style = "color: red; text-align: center; font-size: 16px; font-weight: bold;">', $errorMsg, '</p>';
                        }
                    ?>
                    <input placeholder = "New password" type = "password" name = "password" autofocus required style = "margin-bottom: 10px;">
                    <input placeholder = "Confirm new password" type = "password" name = "confirmPassword" required>
                    <br/><br/>
                    <button id = "loginbutton" type = "submit" name = 'submit' value="changePassword">Change Password</button>
                </div>              
            </form>
            
        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html> 