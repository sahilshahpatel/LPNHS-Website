<?php
    include "database.php";

    $sql = "SELECT * FROM events";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $eventCount = $stmt->rowCount();
    $eventIDs = array();
    array_push($eventIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));


    for($i = 0; $i<$eventCount; $i++){
        $sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate >= CURDATE() ORDER BY StartDate";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["eventID" => $eventIDs[0][$i]]);
        $data = array();
        $data = $stmt->fetchAll();
		if(count($data)>0){
			echo '<tr>';
			echo '<td>', $data[0][1], '</td>';
			echo '<td>', $data[0][2], '</td>';
			echo '</tr>';
		}
    } 
?>