<?php
	session_start();
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
		for($s = 0; $s<count($shiftData); $s++){
			$sql = "SELECT * FROM positions WHERE ShiftID = :shiftID AND HoursConfirmed = 0 AND StudentID = :studentID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['shiftID' => $shiftData[$s][0], 'studentID' => $_POST['studentID'][$e][$p]]);
			$positionData = $stmt->fetchAll();
			for($p = 0; $p<count($positionData); $p++){
				if(isset($_POST['submit'][$e][$p])){
					$sql = "UPDATE positions SET HoursConfirmed = 1 WHERE PositionID = :positionID";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(['positionID' => $positionData[$p][0]]);

					$sql = "UPDATE students SET HoursCompleted = HoursCompleted + :hourTotal WHERE StudentID = :studentID";
					$stmt = $pdo->prepare($sql);
					$stmt->execute(['hourTotal' => $_POST['hourTotal'][$e][$p], 'studentID' => $_POST['studentID'][$e][$p]]);

					header('location: hour-logs.php');
				}
			}
		}
	}
?>