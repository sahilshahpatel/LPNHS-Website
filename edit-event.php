<!DOCTYPE HTML>
<?php
    session_start();
    include "database.php";
    include "adminCheck.php";
?>
<html>
<head>
    <title>NHS Test - Edit Event</title>
    
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
        #mainPanel table th, td{
            width: 33.33%;
            font-family: Bookman, sans-serif;
            font-size: 18px;
            text-align: center;
        }
        #tableheader{
            font-size: 20px;
        
        }
    </style>
    
    <!--Scripts-->
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
    
	<!--Included via PHP-->
<header id = "header"><?php include "header.php"; ?></header>

<body>
    <div id = "footerPusher">
        <!--Included via JQuery-->
        <header id = "header"></header>

        <!--Fixed Img in Background-->
        <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
        
        <div id = "mainPanel" class = "classic panel">
            <p style = "text-align: center;">Edit Event</p>
            <form method = "post" action = "edit-eventpg1.php">
                 <table id = "upcomingEventsTable" style="width:100%;">
                 
                        <?php 
                        $sql = "SELECT * FROM events";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute();
                    
                        $eventCount = $stmt->rowCount();
                        $eventIDs = array();
                        array_push($eventIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));
                        echo '<p colspan="3" id = "tableheader">Upcoming Events</p>';
                        echo '<tr>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Edit</th>
				            <th>Remove</th>
                            </tr>';
                        for($i = 0; $i<$eventCount; $i++){
                            $sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate >= NOW()";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(["eventID" => $eventIDs[0][$i]]);
                            $data = array();
                            $data = $stmt->fetchAll();
                
                            if(count($data)>0){
                                echo '<tr>';
                                echo '<input name = "eventID[', $i,']" type = "hidden" value = "', $data[0][0],'">';
                                echo '<td title ="', $data[0][2] ,'">', $data[0][1], '</td>';
                                echo '<td>', $data[0][3], ' to ', $data[0][4], '</td>';
                                echo '<td><a href="https://www.maps.google.com/maps/search/?api=1&query=', str_replace(" ", "+", $data[0][5]),'+IL" target = "_blank">', $data[0][5], '</a></td>';
                                echo '<td><input name = "edit[', $i,']" value = "Edit" class = "classicColor" type = "submit"></td>';
					            echo '<td><input name = "remove[', $i,']" value = "Remove" class = "classicColor" type = "submit" onclick="return confirm(\'Are you sure?\')" style = "margin-right: 0px; background-color:red"></td>';
                                echo '</tr>';
                            }
                        } 
                        
                        echo '</table>
                            <hr style="font-size:20px;">
                            <p colspan="3" id = "tableheader">Event History</p>
                            <table  id = "upcomingEventsTable" style="width:100%;">';
                        echo '<tr>
                            <th>Event Name</th>
                            <th>Date</th>
                            <th>Location</th>
                            <th>Edit</th>
				            <th>Remove</th>
                            </tr>';
                        for($i = 0; $i<$eventCount; $i++){
                            $sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate < NOW()";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(["eventID" => $eventIDs[0][$i]]);
                            $data = array();
                            $data = $stmt->fetchAll();
                
                            if(count($data)>0){
                                echo '<tr>';
                                echo '<input name = "eventID[', $i,']" type = "hidden" value = "', $data[0][0],'">';
                                echo '<td title ="', $data[0][2] ,'">', $data[0][1], '</td>';
                                echo '<td>', $data[0][3], ' to ', $data[0][4], '</td>';
                                echo '<td><a href="https://www.maps.google.com/maps/search/?api=1&query=', str_replace(" ", "+", $data[0][5]),'+IL" target = "_blank">', $data[0][5], '</a></td>';
                                echo '<td><input name = "edit[', $i,']" value = "Edit" class = "classicColor" type = "submit"></td>';
					            echo '<td><input name = "remove[', $i,']" value = "Remove" class = "classicColor" type = "submit" onclick="return confirm(\'Are you sure?\')" style = "margin-right: 0px; background-color:red"></td>';
                                echo '</tr>';
                            }
                        }?>
                    </table>
                </form>
        </div>
    </div>
    <!--Included via JQuery-->
    <footer id = "footer"><?php include 'footer.php';?></footer>
</body>
</html>