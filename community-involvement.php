<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
?>
<html>
    <head>

        <title>LPNHS - Community Involvement</title>
        
        <link rel="stylesheet" href="baseCSS.css">
        <style>
            #eventsPanel{padding: 0;}
            #eventsPanel div{
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
            table tr:nth-child(even){background-color: #e8cfa4;}
            #tabs div.inactive{background-color: #e8cfa4; /*darkened moccasin*/}
            #informationContainer{padding: 10px;}
            #informationContainer div table{width: 100%;}
            #informationContainer div table th, td{
                width: 33.33%;
                font-family: Bookman, sans-serif;
                font-size: 18px;
                text-align: center;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>

        <script>
            var myEventsTabActive = true;
            $(document).ready(function(){
            //specify nav-bar active link
            $("#communityInvolvementLink").addClass("active");
            });
        </script>

    </head>

    <header id = "header"><?php include "header.php"; ?></header>
        
    <body>
        <div id = "footerPusher">

            <img id = "fixedBGImg" src = "img/NHS_logo.png"> <!--Fixed image in background-->

            <div id = "eventsPanel" class = "classic panel">
                <div id = "informationContainer">
                    <!--Information loaded via JavaScript-->
                    <p>Community Events</p>
                    <div id = "communityEvents">
                        <table id = "communityEventsTable">
                            <tr>
                                <th>Event Name</th>
                                <th>Description</th>
                            </tr>
                            <!--Load data-->                    
                            <?php include 'communityEventsGetter.php';?>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>