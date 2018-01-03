<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";
?>
<html>
<head>
    <title>NHS Test - Create Event</title>
    <!--jQuery-->
    <link rel = "stylesheet" href="baseCSS.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>
</head>

<!--Included via PHP-->
<header id = "header"><?php include "header.php"; ?></header>

<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">

    <div id = "mainPanel" class = "classic panel">
        <p style = "text-align: center;">Create Event</p>
            <?php include "eventCreationPg1.php"; ?>
        </div>
        <?php 
    if(isset($_COOKIE['ERROR'])) {
        $Error = $_COOKIE['ERROR'];
        echo '<script>
        $(document).ready(function(){
            alert("', $Error,'");
        });
        </script>';
    }

    ?>
</body>

<footer id = "footer"><?php include "footer.php"; ?></footer>
</html>