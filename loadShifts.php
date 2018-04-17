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

		$sql = "SELECT * FROM students WHERE StudentID=:studentID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(["studentID" => $_SESSION["StudentID"]]);
		$Sdata = $stmt->fetch(PDO::FETCH_OBJ);
		$level = $Sdata->Position;

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

					// Displaying data into HTML elements

					$sql = "SELECT * FROM events WHERE EventID=:eventID";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(['eventID' => $eventIDs[0][$i]]);
					$data = array();
					$data = $stmt->fetchAll();

					echo '<p>Available Shifts for ',$data[0][1],'</p>
							<tr>
						<th>Date</th>
						<th>Time</th>
						<th title = "Click to view current rosters">Positions Available</th>
						<th>Request Shift</th>
						</tr>';

				// Looping the data pulling and display for each of those shifts

					for($l = 0; $l<count($shiftsList); $l++){

						// Pulling from "shifts" database the data for each shift

							$sql = "SELECT * FROM shifts WHERE ShiftID=:shiftID";
							$stmt = $pdo->prepare($sql);
							$stmt->execute(['shiftID' => $shiftsList[$l][1]]);
							$shiftData = array();
							$shiftData = $stmt->fetchAll();

						// Pulling data from "studentshiftrequest" to check for a repeat

							$sql = "SELECT * FROM studentshiftrequests WHERE EventID = :eventID AND StudentID = :studentID AND ShiftID = :shiftID";
							$stmt = $pdo->prepare($sql);
							$stmt->execute(['eventID' => $eventIDs[0][$i], 'studentID' => $_SESSION['StudentID'], 'shiftID' => $shiftData[0][0]]);
							$StudentRowCount = $stmt->rowCount();
							$formatted_startTime = date('g:i A', strtotime($shiftData[0][2]));
							$formatted_endTime = date('g:i A', strtotime($shiftData[0][3]));
							$formatted_date = date('m/d/Y', strtotime($shiftData[0][1]));
						// Displaying the data for each shift

							if(count($shiftData)>0){
								echo '<tr>';

								// Hidden form info to be passed
									echo '<input type = "hidden" name = "eventID" value = "', $eventIDs[0][$i], '">';
									echo '<input type = "hidden" name = "shiftID[', $l,']" value = "', $shiftData[0][0], '">';


								echo '<td>', $formatted_date, '</td>';
								echo '<td>', $formatted_startTime, ' to ', $formatted_endTime, '</td>';
								echo '<td><a title = "Click to view current roster" href = "roster.php?eventID=', $eventIDs[0][$i],'&shiftID=', $shiftData[0][0], '">', $shiftData[0][4], '</a></td>';
								
								// Check if the volunteer button should appear
									$otherEntry = "none";
										
									if($shiftData[0][4]==0){
										$otherEntry = "Full";
									}

									if($StudentRowCount!==0){
										$otherEntry = "Request Sent";
									}

									$sql = "SELECT * FROM positions WHERE ShiftID=:shiftID AND StudentID=:studentID";
									$stmt = $pdo->prepare($sql);
									$stmt->execute(['shiftID'=>$shiftData[0][0], 'studentID'=>$_SESSION['StudentID']]);
									$shiftRepetitions = $stmt->rowCount();
									if($level==="Advisor"){$otherEntry="N/A for Advisors";}
									if($shiftRepetitions>0){
										$otherEntry = "Already Registered";
									}

									if($otherEntry==="none"){
										echo '<td><input type = "submit" name = "submit[', $l, ']" value = "Volunteer!" class = "classicColor"></td>';
									}
									else{echo '<td><p>', $otherEntry, '</p></td>';}
								echo '</tr>';
							}
					}
			}
	}
?>