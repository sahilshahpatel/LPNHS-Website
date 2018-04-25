<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "loginCheck.php";

?>
<html>
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no" />
    <head>
    
        <title>LPNHS - Volunteer</title>
        
        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">
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

        <img id = "fixedBGImg" src = "img/NHS_logo.png"><!--Fixed Image in Background-->

            <div id = "shiftsPanel" class = "classic panel">
                <div id = "informationContainer">
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