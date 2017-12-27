<!DOCTYPE HTML>
<?php include "database.php"; ?>
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
    
    <!--Scripts-->
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>
       $(document).ready(function() {
            //load all common elements: header, footer
            $("#header").load("https://nhs-project-test.firebaseapp.com/header.html", function(){
               $("#footer").load("https://nhs-project-test.firebaseapp.com/footer.html", function(){
                   //Get all scripts that refer to loaded elements
                   $.getScript("firebaseScript.js");
                   $.getScript("headerJQuery.js");
                   
                   //specify nav-bar active link
                   $("#eventsLink").addClass("active");
                   
                   //control tab color
                   $("#chapterEventsTab").click(function(){
                       $(this).removeClass("inactive");
                       $("#myEventsTab").addClass("inactive");
                       
                       loadData();
                   });
                   $("#myEventsTab").click(function(){
                       $(this).removeClass("inactive");
                       $("#chapterEventsTab").addClass("inactive");
                       
                       loadData();
                   });
               });
            });          
       }); 
    </script>
</head>

<!--Included via JQuery-->
<header id = "header"></header>
    
<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
    
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
                    <?php
                        $sql = "SELECT * FROM events";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                        
                        $eventCount = $stmt->rowCount();
                        $eventIDs = array();
                        array_push($eventIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));
                    
                        for($i = 0; $i<$eventCount; $i++){
                            $sql = "SELECT * FROM events WHERE EventID=:eventID";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(["eventID" => $eventIDs[0][$i]]);
                            $data = array();
                            $data = $stmt->fetchAll();
                            
                            echo '<tr>';
                            echo '<td title =', $data[0][2] ,'>', $data[0][1], '</td>';
                            echo '<td>', $data[0][3], ' to ', $data[0][4], '</td>';
                            echo '<td>', $data[0][5], '</td>';
                            echo '</tr>';
                        }
                    ?>
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
                </table>
            </div>
        </div>
    </div>
</body>

<!--Included via JQuery-->
<footer id = "footer"></footer>
</html>