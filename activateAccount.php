<!DOCTYPE HTML>
<?php 
    session_start();
    require "database.php";
    
    // If not logged in, reroute
    if(!(isset($_SESSION["StudentID"]))){
        header("Location: index.php");
    }
    // If already activated, reroute
    else{
        $sql = "SELECT * FROM students WHERE StudentID=:studentID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["studentID" => $_SESSION["StudentID"]]);
        $userData = $stmt->fetch(PDO::FETCH_OBJ);
        if($userData->Activated==1){
            header("Location: index.php");
        }
    }
    if(isset($_POST['newPassword'])
    && isset($_POST['confirmNewPassword'])
    && isset($_POST['recoveryAnswer'])){
        if($_POST['newPassword']==$_POST['confirmNewPassword']){
            $sql = "UPDATE students SET Activated=1, RecoveryQuestion=:RQ, RecoveryAnswer=:RA, PasswordHash=:passHash WHERE StudentID=:studentID ";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["studentID" => $_SESSION["StudentID"], "RQ" => $_POST['recoveryQuestion'], "RA" => $_POST['recoveryAnswer'], 'passHash' => password_hash($_POST['newPassword'], PASSWORD_DEFAULT)]);
            header("Location: index.php?formSubmitConfirm=true");
        }
        else{header("Location: activateAccount.php?confirmPassword=false");}
    }
?>
<html>
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no" />
    <head>

        <title>NHS Test - Activate Account</title>

        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>

        <style>
            p{
                text-align: left;
            }
            p, input, select{
                margin: 5px 10px;
            }
            body{
                margin: 0px;
                background-color: #005da3;
                text-align: center;
            }
        </style>

    </head>

    <header id = "header"><?php include "header.php"; ?></header>
        
    <body>
        <div id = "footerPusher">

            <img id = "fixedBGImg" src = "img/NHS_logo.png"> <!--Fixed image in background-->

                <form id = "activationForm" action = "#" method = "post">
                    <h1  style = "font-size: 30px; text-decoration: underline;color:white;">Activate your account</h1>
                    <p>Enter a new password <?php if(isset($_GET["confirmPassword"]))echo'<b style="color:red;font-size: 2.25vmin;">* Passwords do not match</b>';?></p>
                    <input name = "newPassword" type="password" placeholder = "New password" required>
                    <input <?php if(isset($_GET["confirmPassword"]))echo'style="border: 1px solid;border-color: red;background: rgba(255,92,92,.3);"';?> name = "confirmNewPassword" type="password" placeholder = "Confirm password" required>
                    <p>Choose a security question</p>
                    <select name = "recoveryQuestion" form = "activationForm">
                        <option value = "What is your mother's maiden name?">What is your mother's maiden name?</option>
                        <option value = "What was the name of your first pet?">What was the name of your first pet?</option>
                        <option value = "What was your favorite place to visit as a child?">What was your favorite place to visit as a child?</option>
                        <option value = "What is the name of your first school?">What is the name of your first school?</option>
                        <option value = "What street did you grow up on?">What street did you grow up on?</option>
                    </select>
                    <p>Enter an answer</p>
                    <input name = "recoveryAnswer" required>
                    <br/>
                    <input type = "submit" value = "Activate my account" class = "classicColor" style = "background-color: #00CC00; margin-top: 30px;">
                </form>
        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>