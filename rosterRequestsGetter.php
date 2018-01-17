<?php
    session_start();
    include "database.php";

	echo '<tr>
		<th>Event Name</th>
		<th>Student Name</th>
		<th>Total Confirmed Hours</th>
        <th>Shift Date</th>
		<th>Shift Time</th>
		<th>Event Repetitions</th>
		<th>Register</th>
     </tr>';

	$sql = "SELECT * FROM events";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();

	$eventData = array();
	$eventData = $stmt->fetchAll();
	$eventCount = $stmt->rowCount();

	for($i = 0; $i<$eventCount; $i++){
		$sql = "SELECT * FROM studentshiftrequests WHERE EventID=:eventID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(["eventID" => $eventData[$i][0]]);

		if($stmt->rowCount() > 0){
			$requestData = array();
			$requestData = $stmt->fetchAll();

			$sql = "SELECT * FROM students WHERE StudentID=:studentID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["studentID" => $requestData[0][1]]);

			$studentData = array();
			$studentData = $stmt->fetchAll();

			$sql = "SELECT * FROM shifts WHERE ShiftID=:shiftID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["shiftID" => $requestData[0][2]]);

			$shiftData = array();
			$shiftData = $stmt->fetchAll();

			$sql = "SELECT * FROM events WHERE Name=:eventName";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["eventName" => $eventData[$i][1]]);

			$sameEventsData = array();
			$sameEventsData = $stmt->fetchAll();
			
			$repetitionCounter;

			for($l = 0; $l<count($sameEventsData); $l++){
				$sql = "SELECT * FROM studentevent WHERE EventID=:eventID AND StudentID=:studentID";
				$stmt->execute(["eventID" => $sameEventsData[$l][0], "studentID" => $studentData[$i][0]]);
				$repetitionCounter = $stmt->rowCount();
			}

			echo '<tr>';
			
			//Hidden form info to be passed
			echo '<input name = "studentID[', $i,']" type = "hidden" value = "', $studentData[$i][0],'">';
			echo '<input name = "eventID[', $i,']" type = "hidden" value = "', $eventData[$i][0],'">';
			echo '<input name = "shiftID[', $i,']" type = "hidden" value = "', $shiftData[$i][0],'">';

			echo '<td>', $eventData[$i][1], '</td>';
			echo '<td>', $studentData[$i][1],' ', $studentData[$i][2], '</td>';
			echo '<td>', $studentData[$i][5], '</td>';
			echo '<td>', $shiftData[$i][1], '</td>';
			echo '<td>', $shiftData[$i][2], ' to ', $shiftData[$i][3], '</td>';
			echo '<td>', $repetitionCounter, '</td>';
			echo '<td><input name = "submit[', $i,']" type = "image" src = "greenCheckMark.png" height = "30px" width = "30px" style = "margin-top: 5px;"></td>';
			echo '</tr>';
		}
	}
?>