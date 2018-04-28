<!DOCTYPE HTML>
<?php
    session_start();
    require "database.php";

    $success = false; //Initially false until the database is ubdated!

    if(isset($_POST["submit"])){
        $sql = "SELECT * FROM passrecovertokens WHERE Token = :token";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['token' => $_GET['token']]);
        $tokenData = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($tokenData->StudentID===$_GET['userID'] && $tokenData->Expiration < date('Y-m-d')){ //Checks if studentID matches, and if token hasn't expired
            $sql = "UPDATE students SET PasswordHash=:passHash WHERE StudentID=:studentID";
            $stmt = $pdo->prepare($sql);
            $success = $stmt->execute(['passHash' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'studentID' => $tokenData->StudentID]);
            if($success){ //Delete token if it has been used
                $sql = "DELETE FROM passrecovertokens WHERE Token = :token";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['token' => $_GET['token']]);
            }
        }
        else if($tokenData->Expiration !< date('Y-m-d')){ //Delete token if it is too old
            $sql = "DELETE FROM passrecovertokens WHERE Token = :token";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['token' => $_GET['token']]);
        }
    }
?>
<html>
    <head>

        <title>LPNHS - Password Reset</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="baseCSS.css">


    </head>

    <header id = "header"><?php include "header.php"; ?></header>

    <body>
		<div id = "footerPusher">

            <form id="login" class="form" action="passwordReset.php?token=<?php echo $_GET['token']);?>&userID=<?php echo $_GET['userID'];?>" method="post">
                <div>
                    <h id="logTitle">Password Reset</h>
                    <hr class="loghr">
                    <br/>
                    <?php 
                        if($success){
                            echo '<p style = "text-align: center; font-size: 16px; font-weight: bold;">Password Updated</p>';
                        }
                        else if(!isset($_GET['emailLink']) || !$_GET['emailLink']==='true'){
                            echo '<p style = "text-align: center; font-size: 16px; font-weight: bold;">An error occured</p>';
                        }
                    ?>
                    <input class="input2" placeholder = "Password*" type = "password" name = "password" autofocus required>
                    <br/><br/>
                    <button id = "loginButton" type = "submit" name = 'submit' value="changePassword" style = "min-height: 75px;">Change Password</button>
                </div>              
            </form>
            
        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html> 