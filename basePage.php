<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
?>
<html>
    <head>

        <title>NHS Test - Base Page</title>

        <link rel="stylesheet" href="baseCSS.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>

    </head>

    <header id = "header"><?php include "header.php"; ?></header>
        
    <body>
        <div id = "footerPusher">

            <img id = "fixedBGImg" src = "img/NHS_logo.png"> <!--Fixed image in background-->

        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>