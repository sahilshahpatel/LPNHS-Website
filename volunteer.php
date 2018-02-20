<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "loginCheck.php";
?>
<html>
    <head>
    
        <title>LPNHS - Volunteer</title>
        
        <link rel="stylesheet" href="baseCSS.css">
        <style>
            #shiftsPanel{padding: 0;}
            table tr:nth-child(even){background-color: #e8cfa4;}
            #shiftsPanel div{
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
            }
            #informationContainer{padding: 10px;}
            #informationContainer form table{width: 100%;}
            #informationContainer form table th, td{
                padding: 5px;
                font-family: Bookman, sans-serif;
                font-size: 18px;
                text-align: center;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <?php

        // Form Submission Confirmation

            if(isset($_COOKIE['formSubmitConfirm'])):
            ?>
                <script>
                $(document).ready(function(){
                    $("#banner").animate({backgroundColor: '#00CC00'});
                    $("#banner").animate({backgroundColor: '#fff'});
                });
                </script>
            <?php
                $message = $_COOKIE['formSubmitConfirm'];
                setcookie("formSubmitConfirm", "", time() - 3600); // delete cookie
                endif;
        ?>

    </head>
        
    <header id = "header"><?php include "header.php"; ?></header>

    <body>
        <div id = "footerPusher">

        <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png"><!--Fixed Image in Background-->

            <div id = "shiftsPanel" class = "classic panel">
                <div id = "informationContainer">
                    <p>Available Shifts</p>
                    <!--Content loaded throuhg PHP-->
                    <form method = "post" action = "requestShift.php">
                        <table id = "shiftsTable">
                            <?php include "loadShifts.php"; ?>
                        </table>
                    </form>
                </div>
            </div>
            
        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>