<?php
	include "database.php";

	$sql = "SELECT * FROM events";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();

	$eventData = array();
	$eventData = $stmt->fetchAll();
	$eventCount = $stmt->rowCount();
	for($i = 0; $i<$eventCount; $i++){
		if(isset($_POST["submit"][$i])){
			//Delete data from "requests" table
			$sql = "DELETE FROM studentshiftrequests WHERE StudentID=:studentID AND EventID=:eventID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['studentID' => $_POST['studentID'][$i], 'eventID' => $_POST['eventID'][$i]]);

			//Add data to studentevent/shifts/positions tables
			$sql = "INSERT INTO studentevents (StudentID, EventID) VALUES (:studentID, :eventID)";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['studentID' => $_POST['studentID'][$i], 'eventID' => $_POST['eventID'][$i]]);

			$sql = "UPDATE shifts SET PositionsAvailable = PositionsAvailable - 1 WHERE ShiftID =:shiftID AND PositionsAvailable > 0";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['shiftID' => $_POST['shiftID'][$i]]);

			$sql = "UPDATE positions SET StudentID =:studentID WHERE ShiftID =:shiftID AND StudentID IS NULL LIMIT 1";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['shiftID' => $_POST['shiftID'][$i], 'studentID' => $_POST['studentID'][$i]]);
		}
	}

	header('Location: roster-requests.php');
?>