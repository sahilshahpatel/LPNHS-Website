<?php
	session_start();
    include "database.php";

	$sql = "SELECT * FROM eventshift WHERE EventID=:eventID";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(["eventID" => $_POST['eventID']]);
	$shiftsList = array();
	$shiftsList = $stmt->fetchAll();

	for($l = 0; $l<count($shiftsList); $l++){
		if(isset($_POST['submit'][$l])){
			//prevent repeats
			$sql = "SELECT * FROM studentshiftrequests WHERE EventID = :eventID AND StudentID = :studentID AND ShiftID = :shiftID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['eventID' => $_POST['eventID'], 'studentID' => $_SESSION['StudentID'], 'shiftID' => $_POST['shiftID'][$l]]);
			if($stmt->rowCount()===0){
				$sql = "INSERT INTO studentshiftrequests (EventID, StudentID, ShiftID) VALUES ( :eventID, :studentID, :shiftID)";
				$stmt = $pdo->prepare($sql);

				$stmt->execute(['eventID' => $_POST['eventID'], 'studentID' => $_SESSION['StudentID'], 'shiftID' => $_POST['shiftID'][$l]]);

				setcookie("formSubmitConfirm", "Shift requested", time()+3600);
			}
		}
	}

	header('location: events.php');
?>