<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "loginCheck.php";
?>
<html>
    <head>

        <title>NHS Test - Events</title>
        
        <link rel="stylesheet" href="baseCSS.css">
        <style>
            #eventsPanel{padding: 0;}
            table tr:nth-child(even){
                background-color: #e8cfa4;
            }
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

            // Manages tab color to indicate which tab you are on

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

    <header id = "header"><?php include "header.php"; ?></header>
        
    <body>

        <img id = "fixedBGImg" src = "img/NHS_logo.png"> <!--Fixed image in background-->

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
                        <form method = "post" action = "volunteer.php">
                            <table id = "upcomingEventsTable">
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
                        </form>
                    </div>
                    
                    <hr>

                    <p>Event History</p>
                    <div id = "eventHistory">
                        <table id = "eventHistoryTable">
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