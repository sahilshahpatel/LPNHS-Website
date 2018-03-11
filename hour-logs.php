<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
	include 'adminCheck.php';
?>
<html>
    <head>

        <title>LPNHS - Confirm Hours</title>

        <link rel="stylesheet" href="baseCSS.css">
        <style>
            table{
                width: 100%;
                font-family: Bookman, sans-serif;
                text-align: center;
            }
            table td{
                padding: 5px 0;
                margin: 0;
            }
            table tr:nth-child(even){background-color: #e8cfa4;}
            #addUserTable th, td{width: 12.5%;}
            input{max-width: 130px;}
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <script src="http://code.jquery.com/color/jquery.color.plus-names-2.1.2.min.js"	integrity="sha256-Wp3wC/dKYQ/dCOUD7VUXXp4neLI5t0uUEF1pg0dFnAE="	crossorigin="anonymous"></script>
        
        <?php

            // Form Submission Confirmation

                if(isset($_GET['formSubmitConfirm'])):
                ?>
                    <script>
                    $(document).ready(function(){
                        $("#banner").animate({backgroundColor: '#00CC00'});
                        $("#banner").animate({backgroundColor: '#fff'});
                    });
                    </script>
                <?php
                    endif;
        ?>

    </head>
        
    <header id = "header"><?php include "header.php"; ?></header>

    <body>
        <div id = "footerPusher">

            <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png"> <!--Fixed Image in Background-->
            
            <div class = "classic panel">
                <div class = "scrollable">
                <!--Content to be loaded in PHP-->
                <form method = "post" action = "confirmHours.php">
                    <?php include 'getHoursForConfirmation.php';?>
                </form>
                </div>
            </div>

        </div>
    </body>

    <footer id = "footer"><?php include 'footer.php';?></footer>

</html>