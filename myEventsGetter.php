<?php
    session_start();
    include "database.php";

	// Pulling data from "events" to get event count

		$sql = "SELECT * FROM events";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$eventCount = $stmt->rowCount();
		$eventIDs = array();
		array_push($eventIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));

	// Starting to display a table row element as a header

		echo '<tr>
			  <th>Event Name</th>
			  <th>Date</th>
			  <th>Location</th>
			  </tr>';
			  
	// Checking if User History or Future events

		if($_GET['history'] === "false"){

			// Looping for every event

			for($i = 0; $i<$eventCount; $i++){

				// Pulling data from "events" that have passed

					$sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate >= CURDATE()";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(["eventID" => $eventIDs[0][$i]]);
					$data = array();
					$data = $stmt->fetchAll();

				if(count($data)>0){

					// Pulling data from "studentevent" to get the students attending those events

						$sql = "SELECT * FROM studentevent WHERE EventID=:eventID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["eventID" => $eventIDs[0][$i]]);
						$IDdata = array();
						$IDdata = $stmt->fetchAll();
			
					// Checking if current user is in the event

						if($IDdata[0][0]===$_SESSION["StudentID"]){

							// If the user is then display the data in HTML elements

								echo '<tr>';
								echo '<td title ="', $data[0][2] ,'">', $data[0][1], '</td>';
								if($data[0][3]===$data[0][4]){echo '<td>', $data[0][3], '</td>';}
								else{echo '<td>', $data[0][3], ' to ', $data[0][4], '</td>';}
								echo '<td><a href="https://www.maps.google.com/maps/search/?api=1&query=', str_replace(" ", "+", $data[0][5]),'+IL" target = "_blank">', $data[0][5], '</a></td>';
								echo '</tr>';
						}
				}
			}
		}

	// If it is not on

		else{

			// Looping for every event

			for($i = 0; $i<$eventCount; $i++){

				// Pulling data from "events" that have not passed

					$sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate < CURDATE()";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(["eventID" => $eventIDs[0][$i]]);
					$data = array();
					$data = $stmt->fetchAll();

				if(count($data)>0){

					// Pulling data from "studentevent" to get the students attending those events

						$sql = "SELECT * FROM studentevent WHERE EventID=:eventID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["eventID" => $eventIDs[0][$i]]);
						$IDdata = array();
						$IDdata = $stmt->fetchAll();
			
					// Checking if the user is in the event

						if($IDdata[0][0]===$_SESSION["StudentID"]){

							// If the user is then display the data in HTML elements

								echo '<tr>';
								echo '<td title ="', $data[0][2] ,'">', $data[0][1], '</td>';
								if($data[0][3]===$data[0][4]){echo '<td>', $data[0][3], '</td>';}
								else{echo '<td>', $data[0][3], ' to ', $data[0][4], '</td>';}
								echo '<td><a href="https://www.maps.google.com/maps/search/?api=1&query=', str_replace(" ", "+", $data[0][5]),'+IL" target = "_blank">', $data[0][5], '</a></td>';
								echo '</tr>';
						}
				}
			}
		}
?>