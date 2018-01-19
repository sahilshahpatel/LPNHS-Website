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
        <th>Location</th>';
	if($_GET['history'] === "false"){
		echo '<th></th>';
	}
	echo '</tr>';

	if($_GET['history'] === "false"){
		for($i = 0; $i<$eventCount; $i++){
			$sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate >= NOW()";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["eventID" => $eventIDs[0][$i]]);
			$data = array();
			$data = $stmt->fetchAll();

			if(count($data)>0){
				echo '<tr>';
				echo '<td title =', $data[0][2] ,'>', $data[0][1], '</td>';
				echo '<td>', $data[0][3], ' to ', $data[0][4], '</td>';
				echo '<td><a href="https://www.maps.google.com/maps/search/?api=1&query=', str_replace(" ", "+", $data[0][5]),'+IL" target = "_blank">', $data[0][5], '</a></td>';
				echo '<td><input type = "submit" name = "submit[', $i, ']" value = "View Shifts" class = "classicColor"></td>';
				echo '</tr>';
				echo '<input type = "hidden" name = "eventID" value = "', $eventIDs[0][$i],'">';
			}
		} 
	}
	else{
		for($i = 0; $i<$eventCount; $i++){
			$sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate < NOW()";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["eventID" => $eventIDs[0][$i]]);
			$data = array();
			$data = $stmt->fetchAll();

			if(count($data)>0){
				echo '<tr>';
				echo '<td title =', $data[0][2] ,'>', $data[0][1], '</td>';
				echo '<td>', $data[0][3], ' to ', $data[0][4], '</td>';
				echo '<td><a href="https://www.maps.google.com/maps/search/?api=1&query=', str_replace(" ", "+", $data[0][5]),'+IL" target = "_blank">', $data[0][5], '</a></td>';
				echo '</tr>';
			}
		} 
	}
?>