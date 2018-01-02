<?php
    session_start();
    include "database.php";

    $sql = "SELECT * FROM events";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $eventCount = $stmt->rowCount();
    $eventIDs = array();
    array_push($eventIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));

    echo '<tr>
        <th>Event Name</th>
        <th>Date</th>
        <th>Location</th>
    </tr>';

    for($i = 0; $i<$eventCount; $i++){
        $sql = "SELECT * FROM events WHERE EventID=:eventID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["eventID" => $eventIDs[0][$i]]);
        $data = array();
        $data = $stmt->fetchAll();

        $sql = "SELECT * FROM studentevent WHERE EventID=:eventID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["eventID" => $eventIDs[0][$i]]);
        $IDdata = array();
        $IDdata = $stmt->fetchAll();
        
        if($IDdata[0][0]===$_SESSION["StudentID"]){

            echo '<tr>';
            echo '<td title =', $data[0][2] ,'>', $data[0][1], '</td>';
            echo '<td>', $data[0][3], ' to ', $data[0][4], '</td>';
            echo '<td>', $data[0][5], '</td>';
            echo '</tr>';
        }
    } 
?>