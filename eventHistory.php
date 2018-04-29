<!DOCTYPE HTML>
<?php
    session_start();
    require 'database.php';
    $vpAllowed = true;
    require 'adminCheck.php';

    // Pulling data from "events" to get event count

		$sql = "SELECT * FROM events";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$eventCount = $stmt->rowCount();
		$eventIDs = array();
        array_push($eventIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));

    if(!isset($_GET['StudentID'])){
        header("location: members.php");
    }
    
    // Pulling user's data
        $sql = "SELECT * FROM students WHERE StudentID = :studentID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['studentID'=>$_SESSION['StudentID']]);
        $user = $stmt->fetch(PDO::FETCH_OBJ);

    // Pulling target student's data
        $sql = "SELECT * FROM students WHERE StudentID = :studentID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['studentID'=>$_GET['StudentID']]);
        $target = $stmt->fetch(PDO::FETCH_OBJ);

    // Only let VPs check their own students
    if($user->Position==="Vice President" && $target->VicePresident!==$user->StudentID){
        header("location: members.php");
    }
?>
<html>
    <meta name="HandheldFriendly" content="true" />
    <meta name="MobileOptimized" content="320" />
    <meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no" />
    <head>
        <title>LPNHS - Event History</title>

        <link rel="icon" type="image/png" href="img/nhs_logo.png">
        <link rel="stylesheet" type="text/css" href="baseCSS.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <style>
            #eventsPanel{padding: 0;}
            table tr:nth-child(even){
                background-color: #e8cfa4;
            }
            #eventsPanel div{
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
            }
            #informationContainer{padding: 10px;}
            #informationContainer div table{width: 100%;}
            #informationContainer div table th, td{
                width: 33.33%;
                font-family: Bookman, sans-serif;
                font-size: 18px;
                text-align: center;
            }
            
        </style>
    </head>
    <header><?php include 'header.php'; ?></header>
    <body>
    <div id = "footerPusher">
        <div id = "eventsPanel" class = "classic panel">
            <div id = "informationContainer">
                <p><?php echo $target->FirstName, ' ', $target->LastName;?>'s Event History</p>
                <div id = "eventHistory">
                    <table id = "eventHistoryTable">
                    <?php

                        // Starting to display a table row element as a header
                        echo '<tr>
                        <th>Event Name</th>
                        <th>Date</th>
                        <th>Location</th>
                        </tr>';

                        // Looping for every event

                        for($i = 0; $i<$eventCount; $i++){
                            // Pulling data from "studentevent" to get the students attending those events

                                $sql = "SELECT * FROM studentevent WHERE EventID=:eventID AND StudentID=:stID";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(["eventID" => $eventIDs[0][$i], 'stID'=> $_GET['StudentID']]);
                                $IDdata = array();
                                $IDdata = $stmt->fetchAll();

                            for($q = 0; $q<count($IDdata); $q++){
                                // Pulling data from "events" that have passed

                                    $sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate < CURDATE()";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(["eventID" => $IDdata[$q][1]]);
                                    $data = array();
                                    $data = $stmt->fetchAll();

                                // Checking if event IS in the past
                                if(!empty($data)){

                                    // display the data in HTML elements

                                        $formatted_startDate = date('m/d/Y', strtotime($data[0][3]));
                                        $formatted_endDate = date('m/d/Y', strtotime($data[0][4]));

                                        echo '<tr>';
                                        echo '<td title ="', $data[0][2] ,'">', $data[0][1], '</td>';
                                        if($data[0][3]===$data[0][4]){echo '<td>',$formatted_startDate, '</td>';}
                                        else{echo '<td>', $formatted_startDate, ' to ', $formatted_endDate, '</td>';}
                                        echo '<td><a href="https://www.maps.google.com/maps/search/?api=1&query=', str_replace(" ", "+", $data[0][5]),'+IL" target = "_blank">', $data[0][5], '</a></td>';
                                        echo '</tr>';
                                }
                            }
                        }
                    ?>                 
                    </table>
                </div>
            </div>
        </div>
    </div>
    </body>
    <footer><?php include 'footer.php'; ?></footer>
</html>