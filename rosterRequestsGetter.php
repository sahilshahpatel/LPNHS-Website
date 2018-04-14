<?php
    include "database.php";

	// Displaying table header row in HTML elements

		echo '<tr>
			  <th>Event Name</th>
			  <th>Student Name</th>
			  <th>Total Confirmed Hours</th>
			  <th>Shift Date</th>
			  <th>Shift Time</th>
			  <th>Event Repetitions</th>
			  <th>Register</th>
		      </tr>';

	// Pulling data from "events"

		$sql = "SELECT * FROM events";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$eventData = array();
		$eventData = $stmt->fetchAll();
		$eventCount = $stmt->rowCount();

	$requestsFound = false; // initializing variable for use

	// Looping for every event

		for($i = 0; $i<$eventCount; $i++){

			// Pulling from "studentshiftrequests"

				$sql = "SELECT * FROM studentshiftrequests WHERE EventID=:eventID";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(['eventID' => $eventData[$i][0]]);

			if($stmt->rowCount() > 0){

				// If there is a request, set "requestsfound" to true and pull data

					$requestsFound = true;
					$requestData = array();
					$requestData = $stmt->fetchAll();

				// Looping for the data in "requestData"

					for($q = 0; $q<count($requestData); $q++){

						// Pulling data from "students" that are in "requestData"

							$sql = "SELECT * FROM students WHERE StudentID=:studentID";
							$stmt = $pdo->prepare($sql);
							$stmt->execute(['studentID' => $requestData[$q][1]]);
							$studentData = array();
							$studentData = $stmt->fetchAll();

						// Pulling data from "shifts" that are in "requestData"

							$sql = "SELECT * FROM shifts WHERE ShiftID=:shiftID";
							$stmt = $pdo->prepare($sql);
							$stmt->execute(['shiftID' => $requestData[$q][2]]);
							$shiftData = array();
							$shiftData = $stmt->fetchAll();

						// Pulling data from "events" from which the request is from

							$sql = "SELECT * FROM events WHERE Name=:eventName";
							$stmt = $pdo->prepare($sql);
							$stmt->execute(['eventName' => $eventData[$i][1]]);
							$sameEventsData = array();
							$sameEventsData = $stmt->fetchAll();
					
						$repetitionCounter = 0;// Initializing a variable for future use

						// Looping for every event that that is the same that the user has done

							for($l = 0; $l<count($sameEventsData); $l++){
								// Pulling data from "studentevent" to see how many times the student has signed up for the same event (events with same name)
									$sql = "SELECT * FROM studentevent WHERE EventID=:eventID AND StudentID=:studentID";
									$stmt = $pdo->prepare($sql);
									$stmt->execute(['eventID' => $sameEventsData[$l][0], 'studentID' => $studentData[0][0]]);
									$repetitionCounter += $stmt->rowCount();
							}

							$formatted_date = date('m/d/Y', strtotime($shiftData[0][1]));// Formatting time
							$formatted_startTime = date('g:i A', strtotime($shiftData[0][2]));
							$formatted_endTime = date('g:i A', strtotime($shiftData[0][3]));

						// Display the data in HTML elements

							echo '<tr>';
						
							// Hidden form info to be passed

								echo '<input name = "studentID[', $i,']" type = "hidden" value = "', $studentData[0][0],'">';
								echo '<input name = "eventID[', $i,']" type = "hidden" value = "', $eventData[$i][0],'">';
								echo '<input name = "shiftID[', $i,']" type = "hidden" value = "', $shiftData[0][0],'">';
							
							echo '<td>', $eventData[$i][1], '</td>';
							echo '<td>', $studentData[0][1],' ', $studentData[0][2], '</td>';
							echo '<td>', $studentData[0][5], '</td>';
							echo '<td>', $formatted_date, '</td>';
							echo '<td>', $formatted_startTime, ' to ', $formatted_endTime, '</td>';
							echo '<td>', $repetitionCounter, '</td>';
							echo '<td><input name = "submit[', $i,'][', $q,']" type = "image" src = "img/greenCheckMark.png" height = "30px" width = "30px" style = "margin-top: 5px;"></td>';
							echo '</tr>';
					}
			}
		}

		// If no requests are found

			if(!$requestsFound){
				echo '<tr><td colspan = 7 style = "padding: 5px;">No student requests found</td></tr>';
			}
?>