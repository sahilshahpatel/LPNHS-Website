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
        </style>

    </head>

    <header id = "header"><?php include "header.php"; ?></header>
        
    <body>
        <div id = "footerPusher">

            <img id = "fixedBGImg" src = "img/NHS_logo.png"> <!--Fixed image in background-->

            <div class = "classic panel" style = "padding: 10px;">
                <form id = "activationForm" action = "#" method = "post">
                    <p>Enter a new password</p>
                    <input name = "newPassword" placeholder = "New password">
                    <input name = "confirmNewPassword" placeholder = "Confirm password">
                    <p>Choose a security question</p>
                    <select name = "recoveryQuestion" form = "activationForm">
                        <option value = "What is your mother's maiden name?">What is your mother's maiden name?</option>
                    </select>
                    <p>Enter an answer</p>
                    <input name = "recoveryAnswer">
                    <br/>
                    <input type = "submit" value = "Activate my account" class = "classicColor" style = "background-color: #00CC00; margin-top: 30px;">
                </form>
            </div>
        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>