<?php
	include 'database.php';

		$dataFound = false;

	// Getting events that are past

		$sql = "SELECT * FROM events WHERE StartDate < CURDATE()";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$eventData = $stmt->fetchAll();

	// Looping for every event that has past

		for($e = 0; $e<count($eventData); $e++){

			// Collecting shift data from the event where the shifts have passed

				$sql = "SELECT * FROM shifts WHERE EventID = :eventID AND `Date` < CURDATE()";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(['eventID' => $eventData[$e][0]]);
				$shiftData = $stmt->fetchAll();

			// Looping  for each shift that has past

				for($s = 0; $s<count($shiftData); $s++){

					// Collecting position data for each shift that has past

						$sql = "SELECT * FROM positions WHERE ShiftID = :shiftID AND HoursConfirmed = 0 AND StudentID IS NOT NULL";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['shiftID' => $shiftData[$s][0]]);
						$positionData = $stmt->fetchAll();
				}

			// If there was data in positions display it

				if(count($positionData)>0){
					$dataFound = true;
					echo '<p>', $eventData[$e][1], '</p>';
					echo '<table class = "listing">';
					echo '<tr></tr>'; //to reset the row shading
					echo '<tr>
					      <th>Name</th>
						  <th>Date</th>
						  <th>Time</th>
						  <th></th>
						  </tr>';

					// Looping data to display in PHP based on amount of positions

						for($p = 0; $p<count($positionData); $p++){

							// Pulling data from "shifts" and "students"

								$sql = "SELECT * FROM shifts WHERE ShiftID = :shiftID";
								$stmt = $pdo->prepare($sql);
								$stmt->execute(['shiftID' => $positionData[$p][1]]);
								$specificShiftData = $stmt->fetchAll();

								$sql = "SELECT * FROM students WHERE StudentID = :studentID";
								$stmt = $pdo->prepare($sql);
								$stmt->execute(['studentID' => $positionData[$p][2]]);
								$studentData = $stmt->fetchAll();
								$formatted_date = date('m/d/Y', strtotime( $specificShiftData[0][1]));// Formatting time
								$formatted_startTime = date('g:i A', strtotime($specificShiftData[0][2]));
								$formatted_endTime = date('g:i A', strtotime($specificShiftData[0][3]));

							// Displaying data for each student, their position and hours

								echo '<tr>';
								echo '<td>', $studentData[0][1], ' ', $studentData[0][2], '</td>';
								echo '<td>',$formatted_date, '</td>';
								echo '<td>', $formatted_startTime, ' to ', $formatted_endTime, '</td>';
								echo '<td><input type = "submit" name = "submit[', $e, '][', $p, ']" class = "classicColor" value = "Confirm"></td>';
								echo '<input type = "hidden" name = "studentID[', $e, '][', $p, ']" value = "', $positionData[$p][2], '">';
								$startTime = new DateTime($specificShiftData[0][2]);
								$endTime = new DateTime($specificShiftData[0][3]);
								$timeDiff = $endTime->diff($startTime);
								$hourTotal = doubleval($timeDiff->format('%h')) + (doubleval($timeDiff->format('%i')))/60;
								echo '<input type = "hidden" name = "hourTotal[', $e, '][', $p, ']" value = "', $hourTotal, '">';
								echo '</tr>';
						}
					echo '</table>';
					echo '<hr>';
				}
		}

	// If no data to display then display this
	if(!$dataFound){
		echo '<p>No hours to confirm</p>';
	}
?>