<?php
	session_start();
	include 'database.php';

	include 'loading.html'; // Display loading screen

	// Pulling data from database

		$sql = "SELECT * FROM events WHERE StartDate < CURDATE()";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$eventData = $stmt->fetchAll();

	// Initializing data into HTML elements

		for($e = 0; $e<count($eventData); $e++){
			$sql = "SELECT * FROM shifts WHERE EventID = :eventID AND `Date` < CURDATE()";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['eventID' => $eventData[$e][0]]);
			$shiftData = $stmt->fetchAll();
			for($s = 0; $s<count($shiftData); $s++){
				$sql = "SELECT * FROM positions WHERE ShiftID = :shiftID AND HoursConfirmed = 0 AND StudentID IS NOT NULL";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(['shiftID' => $shiftData[$s][0]]);
				$positionData = $stmt->fetchAll();
				for($p = 0; $p<count($positionData); $p++){
					if(isset($_POST['submit'][$e][$p])){
						$sql = "UPDATE positions SET HoursConfirmed = 1 WHERE PositionID = :positionID AND StudentID = :studentID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['positionID' => $positionData[$p][0], 'studentID' => $_POST['studentID'][$e][$p]]);

						$sql = "UPDATE students SET HoursCompleted = HoursCompleted + :hourTotal WHERE StudentID = :studentID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['hourTotal' => $_POST['hourTotal'][$e][$p], 'studentID' => $_POST['studentID'][$e][$p]]);
						
						header('location: hour-logs.php?formSubmitConfirm=true');
					}
				}
			}
		}
?>