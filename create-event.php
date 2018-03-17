<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";
?>
<html>
    <head>

        <title>LPNHS - Create Event</title>

        <link rel = "stylesheet" href="baseCSS.css">
        <style>
            form{
                display: inline-block;
                font-family: Bookman, sans-serif;
                font-size: 20px;
                align-items: center;
                justify-content: center;
                text-align: left;
                }
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
            textarea, input {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                resize: none;
                width: 50%;
                -moz-transition: none 0s ease 0s;
                line-height: 2em;
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <script>
            // Autocomplete End date 

                function autoCompleteDate(){document.getElementById("endDate").value = document.getElementById("startDate").value;}


        </script>
        <script src="http://code.jquery.com/color/jquery.color.plus-names-2.1.2.min.js"	integrity="sha256-Wp3wC/dKYQ/dCOUD7VUXXp4neLI5t0uUEF1pg0dFnAE="	crossorigin="anonymous"></script>
        <?php

            // Form Submission Confirmation and date validation

                $invaliddate=false;
                if(isset($_GET['date'])){$invaliddate = true;}
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
        <?php 
                
            // Checking for duplicate event

                if(isset($_GET['duplicate'])) 
                {
                    echo '<script>
                        $(document).ready(function(){alert("Duplicate Event Detected - Listing removed");});
                        </script>';
                }
        ?>
    </head>

    <header id = "header"><?php include "header.php"; ?></header>

    <body>
        <div id = "footerPusher">

            <img id = "fixedBGImg" src = "img/NHS_logo.png"> <!--Fixed image in background-->

            <div id = "mainPanel" class = "classic panel">

                <!--Content loaded through PHP script-->
                <?php if($invaliddate):?><p style = "text-align: center;">Create Event<span style="color: red;margin-left: 20px;">*End Date must be after Start Date</span></p>
                <?php else:?><p style = "text-align: center;">Create Event</p>
                <?php endif;?>
                <?php include "eventCreationPg1.php"; ?> 

            </div>

        </div>  
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>