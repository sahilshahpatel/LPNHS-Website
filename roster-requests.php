<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "loginCheck.php";
	include "adminCheck.php";
?>
<html>
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no" />
    <head>

        <title>LP NHS - Roster Requests</title>

        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">
        <style>
            #eventRequestsPanel{padding: 0;}
            table tr:nth-child(even){background-color: #e8cfa4;}
            #eventRequestsPanel div{
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
            }
            #tabs{background-color: #e8cfa4; /*darkened moccasin*/}
            #tabs div{
                display: inline-block;
                margin: 0;
                width: calc(50% - 2px);
                background-color: #ffebcd; /*blanched almond*/
            }
            #tabs div.inactive{background-color: #e8cfa4; /*darkened moccasin*/}
            #informationContainer{padding: 10px;}
            #informationContainer div table{width: 100%;}
            #informationContainer div table th, td{
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

    <header id = "header"><?php include 'header.php'; ?></header>
        
    <body>
        <div id = "footerPusher">

        <img id = "fixedBGImg" src = "img/NHS_logo.png"><!--Fixed Image in Background-->

            <div id = "eventRequestsPanel" class = "classic panel">
                <div id = "informationContainer">
                    <!--Content loaded through PHP-->
                    <p>Roster Requests</p>
                    <div id = "eventRequests">
                        <form method = "post" action = "registerStudent.php">
                            <table id = "eventRequestsTable">
                                <?php include "rosterRequestsGetter.php";?>
                            </table>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>