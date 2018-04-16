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
			  
	// Checking if User History or Future events

		if($_GET['history'] === "false"){

			// Starting to display a table row element as a header

			echo '<tr>
			<th>Event Name</th>
			<th>Date</th>
			<th>Location</th>
			<th></th>
			</tr>';

			// Looping for every event

			for($i = 0; $i<$eventCount; $i++){
				// Pulling data from "studentevent" to get the students attending those events

					$sql = "SELECT * FROM studentevent WHERE EventID=:eventID AND StudentID=:stID";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(["eventID" => $eventIDs[0][$i], 'stID'=> $_SESSION['StudentID']]);
					$IDdata = array();
					$IDdata = $stmt->fetchAll();

				for($q = 0; $q<count($IDdata); $q++){
					// Pulling data from "events" that have passed

						$sql = "SELECT * FROM events WHERE EventID=:eventID AND EndDate >= CURDATE()";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["eventID" => $IDdata[$q][1]]);
						$data = array();
						$data = $stmt->fetchAll();
					
					// Checking if event IS in the future
					if(!empty($data)){
						
						// display the data in HTML elements

							$formatted_startDate = date('m/d/Y', strtotime($data[0][3]));
							$formatted_endDate = date('m/d/Y', strtotime($data[0][4]));

							echo '<tr>';
							echo '<td title ="', $data[0][2] ,'">', $data[0][1], '</td>';
							if($data[0][3]===$data[0][4]){echo '<td>',$formatted_startDate, '</td>';}
							else{echo '<td>', $formatted_startDate, ' to ', $formatted_endDate, '</td>';}
							echo '<td><a href="https://www.maps.google.com/maps/search/?api=1&query=', str_replace(" ", "+", $data[0][5]),'+IL" target = "_blank">', $data[0][5], '</a></td>';
							echo '<input type = "hidden" name = "eventID[', $i, ']" value = "', $eventIDs[0][$i], '">';
							echo '<input type = "hidden" name = "eventName[', $i, ']" value = "', $data[0][1], '">';
							echo '<td><input type = "submit" name = "myShifts[', $i, ']" value = "View My Shifts" formaction = "myShifts.php" class = "classicColor"></td>';
							echo '</tr>';
					}
				}
			}
		}

	// If it is not on

		else{

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
					$stmt->execute(["eventID" => $eventIDs[0][$i], 'stID'=> $_SESSION['StudentID']]);
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


// 							<a href="http://www.google.com/calendar/event?
						// action=TEMPLATE
						// &text=[event-title]
						// &dates=[start-custom format='Ymd\\THi00\\Z']/[end-custom format='Ymd\\THi00\\Z']
						// &details=[description]
						// &location=[location]
						// &trp=false
						// &sprop=
						// &sprop=name:"
						// target="_blank" rel="nofollow">Add to my calendar</a>
					}
				}
			}
		}
?>