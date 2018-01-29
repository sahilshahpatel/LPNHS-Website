<?php
	include 'database.php';

	$sql = "SELECT * FROM events WHERE StartDate < CURDATE()";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$eventData = $stmt->fetchAll();

	for($e = 0; $e<count($eventData); $e++){
		$sql = "SELECT * FROM shifts WHERE EventID = :eventID AND `Date` < CURDATE()";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(['eventID' => $eventData[$e][0]]);
		$shiftData = $stmt->fetchAll();
		//$positionData;
		for($s = 0; $s<count($shiftData); $s++){
			$sql = "SELECT * FROM positions WHERE ShiftID = :shiftID AND HoursConfirmed = 0 AND StudentID IS NOT NULL";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['shiftID' => $shiftData[$s][0]]);
			$positionData = $stmt->fetchAll();
		}
		if(count($positionData)>0){
			echo '<p>', $eventData[$e][1], '</p>';
			echo '<table class = "listing">';
			echo '<tr></tr>'; //to reset the row shading
			echo '<tr>
				 <th>Name</th>
				 <th>Date</th>
				 <th>Time</th>
				 <th></th>
				 </tr>';

			for($p = 0; $p<count($positionData); $p++){
				$sql = "SELECT * FROM shifts WHERE ShiftID = :shiftID";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(['shiftID' => $positionData[$p][1]]);
				$specificShiftData = $stmt->fetchAll();

				$sql = "SELECT * FROM students WHERE StudentID = :studentID";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(['studentID' => $positionData[$p][2]]);
				$studentData = $stmt->fetchAll();

				echo '<tr>';
				echo '<td>', $studentData[0][1], ' ', $studentData[0][2], '</td>';
				echo '<td>', $specificShiftData[0][1], '</td>';
				echo '<td>', $specificShiftData[0][2], ' to ', $specificShiftData[0][3], '</td>';
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
		else{
			echo '<p>No hours to confirm</p>';
		}
	}
?>