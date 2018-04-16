<?php
    session_start();
    include "database.php";

	// Pulling data from database
	
		$sql = "SELECT * FROM events";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$eventCount = $stmt->rowCount();
		$eventIDs = array();
		array_push($eventIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));
		
	// Initializing data into HTML elements
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
				$sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate >= CURDATE() AND ReleaseDate <= CURDATE()";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(["eventID" => $eventIDs[0][$i]]);
				$data = array();
				$data = $stmt->fetchAll();
				$formatted_startDate = date('m/d/Y', strtotime($data[0][3]));
				$formatted_endDate = date('m/d/Y', strtotime($data[0][4]));
				if(count($data)>0){
					echo '<tr>';
					echo '<td title ="', $data[0][2] ,'">', $data[0][1], '</td>';
					if($data[0][3]===$data[0][4]){echo '<td>', $formatted_startDate, '</td>';}
					else{echo '<td>', $formatted_startDate, ' to ', $formatted_endDate, '</td>';}
					echo '<td><a href="https://www.maps.google.com/maps/search/?api=1&query=', str_replace(" ", "+", $data[0][5]),'+IL" target = "_blank">', $data[0][5], '</a></td>';
					echo '<td><input type = "submit" name = "viewShifts[', $i, ']" value = "View Shifts" formaction = "volunteer.php" class = "classicColor"></td>';
					echo '</tr>';
				}
			} 
		}
		else{
			for($i = 0; $i<$eventCount; $i++){
				$sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate < CURDATE()";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(["eventID" => $eventIDs[0][$i]]);
				$data = array();
				$data = $stmt->fetchAll();
				$formatted_startDate = date('m/d/Y', strtotime($data[0][3]));
				$formatted_endDate = date('m/d/Y', strtotime($data[0][4]));
				if(count($data)>0){
					echo '<tr>';
					echo '<td title ="', $data[0][2] ,'">', $data[0][1], '</td>';
					if($data[0][3]===$data[0][4]){echo '<td>', $formatted_startDate, '</td>';}
					else{echo '<td>', $formatted_startDate, ' to ', $formatted_endDate, '</td>';}
					echo '<td><a href="https://www.maps.google.com/maps/search/?api=1&query=', str_replace(" ", "+", $data[0][5]),'+IL" target = "_blank">', $data[0][5], '</a></td>';
					echo '</tr>';
				}
			} 
		}
?>