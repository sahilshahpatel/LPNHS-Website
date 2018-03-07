<?php
	//session_start();
    include 'database.php';

	// Pulling event data from "events"

		$sql = "SELECT * FROM events";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$eventCount = $stmt->rowCount();
		$eventIDs = array();
		array_push($eventIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));

	// Displaying data into HTML elements

		echo '<tr>
			  <th>Date</th>
			  <th>Time</th>
			  <th>Positions Available</th>
			  <th>Request Shift</th>
			  </tr>';

	// Looping for every event

	for($i = 0; $i<$eventCount; $i++){

		// If the event was clicked on for "View Shifts"

			if(isset($_POST['viewShifts'][$i])){

				// Pulling from "eventshift" the data on shifts for that event

					$sql = 'SELECT * FROM eventshift WHERE EventID=:eventID';
					$stmt = $pdo->prepare($sql);
					$stmt->execute(['eventID' => $eventIDs[0][$i]]);
					$shiftsList = array();
					$shiftsList = $stmt->fetchAll();

				// Looping the data pulling and display for each of those shifts

					for($l = 0; $l<count($shiftsList); $l++){

						// Pulling from "shifts" database the data for each shift

							$sql = "SELECT * FROM shifts WHERE ShiftID=:shiftID";
							$stmt = $pdo->prepare($sql);
							$stmt->execute(['shiftID' => $shiftsList[$l][1]]);
							$shiftData = array();
							$shiftData = $stmt->fetchAll();

						// Displaying the data for each shift

							if(count($shiftData)>0){
								echo '<tr>';

								// Hidden form info to be passed
									echo '<input type = "hidden" name = "eventID" value = "', $eventIDs[0][$i], '">';
									echo '<input type = "hidden" name = "shiftID[', $l,']" value = "', $shiftData[0][0], '">';


								echo '<td>', $shiftData[0][1], '</td>';
								echo '<td>', $shiftData[0][2], ' to ', $shiftData[0][3], '</td>';
								echo '<td>', $shiftData[0][4], '</td>';
								echo '<td><input type = "submit" name = "submit[', $l, ']" value = "Volunteer!" class = "classicColor"></td>';
								echo '</tr>';
							}
					}
			}
	}
?>