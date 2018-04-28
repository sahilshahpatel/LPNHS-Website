<!DOCTYPE HTML>
<?php
    session_start();
    require "database.php";

    function encode_URL_safe($string){
        $search = array('$', '&', '+', ',', '/', ':', ';', '=', '?', '@');
        $replace = array('%24', '%26', '2B', '2C', '2F', '3A', '3B', '3D', '3F', '40');
        return str_replace($search, $replace, $string);
    }
    function decode_URL_safe($string){
        $search = array('%24', '%26', '2B', '2C', '2F', '3A', '3B', '3D', '3F', '40');
        $replace = array('$', '&', '+', ',', '/', ':', ';', '=', '?', '@');
        return str_replace($search, $replace, $string);
    }

    if(isset($_POST["submit"])){
        $sql = "SELECT * FROM students WHERE studentID = :studentID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['studentID' => $_GET['userID']]);
        $userData = $stmt->fetchAll();

        if($userData[0][4]===decode_URL_safe($_GET['hash'])){ // Converts passHash back to appropriate format
            $sql = "UPDATE users SET passwordHash = :passHash";
            $stmt = $pdo->prepare($sql);
            $success = $stmt->execute(['passHash' => password_hash($_POST['password'], PASSWORD_DEFAULT)]);
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

            <form id="login" class="form" action="passwordReset.php?hash=<?php echo encode_URL_safe($_GET['hash']);?>&userID=<?php echo $_GET['userID'];?>" method="post"> <!--Converts passHash into URL-viable format-->
                <div>
                    <h id="logTitle">Password Reset</h>
                    <hr class="loghr">
                    <br/>
                    <?php 
                        if($success){
                            echo '<p style = "text-align: center; font-size: 16px; font-weight: bold;">Password Updated</p>';
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