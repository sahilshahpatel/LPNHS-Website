<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "loginCheck.php";
?>
<html>
<head>
    <title>NHS Test - Events</title>
    
    <!--TODO: Icon-->
    
    
    <!--Style Sheets-->
    <link rel="stylesheet" href="baseCSS.css">
    <style>
        #eventsPanel{
            padding: 0;
        }
        table tr:nth-child(even){
            background-color: #e8cfa4;
        }
        #eventsPanel div{
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        #tabs{
            background-color: #e8cfa4; /*darkened moccasin*/
        }
        #tabs div{
            display: inline-block;
            margin: 0;
            width: calc(50% - 2px);
            background-color: #ffebcd; /*blanched almond*/
        }
        #tabs div.inactive{
            background-color: #e8cfa4; /*darkened moccasin*/
        }
        #informationContainer{
            padding: 10px;
        }
        #informationContainer div table{
            width: 100%;
        }
        #informationContainer div table th, td{
            width: 33.33%;
            font-family: Bookman, sans-serif;
            font-size: 18px;
            text-align: center;
        }
    </style>
    <header id = "header"><?php include "header.php"; ?></header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>

    <!--Scripts-->
    <!--jQuery-->
    <script>
        var myEventsTabActive = true;
        $(document).ready(function(){
           //specify nav-bar active link
           $("#eventsLink").addClass("active");
            
           //control tab color
           $("#chapterEventsTab").click(function(){
               $(this).removeClass("inactive");
               $("#myEventsTab").addClass("inactive");
           });
           $("#myEventsTab").click(function(){
               $(this).removeClass("inactive");
               $("#chapterEventsTab").addClass("inactive");
           });
        });
    </script>
</head>
    
<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
    <div id = "footerPusher">
        <div id = "eventsPanel" class = "classic panel">
            <div id = "tabs">
                <div id = "chapterEventsTab" class = "inactive"><p>Chapter Events</p></div>
                <div id = "myEventsTab"><p>My Events</p></div>
            </div>
            <div id = "informationContainer">
                <!--Information loaded via JavaScript-->
                <p>Upcoming Events</p>
                <div id = "upcomingEvents">
                    <table id = "upcomingEventsTable">
                        <tr>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Location</th>
                        </tr>
                        <!--Load data-->                    
                        <script>
                            $(document).ready(function(){
                                $("#upcomingEventsTable").load("myEventsGetter.php?history=false");
                                $("#chapterEventsTab").click(function(){
                                $("#upcomingEventsTable").load("chapterEventsGetter.php?history=false");
                                });
                                $("#myEventsTab").click(function(){
                                $("#upcomingEventsTable").load("myEventsGetter.php?history=false");
                                });
                            });
                        </script>
                    </table>
                </div>
                
                <hr>

                <p>Event History</p>
                <div id = "eventHistory">
                    <table id = "eventHistoryTable">
                        <tr>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Location</th>
                        </tr>
                        <!--Load data-->                    
                        <script>
                            $(document).ready(function(){
                                $("#eventHistoryTable").load("myEventsGetter.php?history=true");
                                $("#chapterEventsTab").click(function(){
                                $("#eventHistoryTable").load("chapterEventsGetter.php?history=true");
                                });
                                $("#myEventsTab").click(function(){
                                $("#eventHistoryTable").load("myEventsGetter.php?history=true");
                                });
                            });
                        </script>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
<footer id = "footer"><?php include "footer.php"; ?></footer>
</html>