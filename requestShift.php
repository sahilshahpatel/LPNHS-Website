<?php
	session_start();
    include "database.php";

	// Pulling data from "eventshift" 

		$sql = "SELECT * FROM eventshift WHERE EventID=:eventID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(["eventID" => $_POST['eventID']]);
		$shiftsList = array();
		$shiftsList = $stmt->fetchAll();

	// Looping for every shift

		for($l = 0; $l<count($shiftsList); $l++){

			// Checks if that shift is picked -> $l -> shift number
				echo 'l = ', $l;
				if(isset($_POST['submit'][$l])){
					// Pulling data from "studentshiftrequest" to check for a repeat

						$sql = "SELECT * FROM studentshiftrequests WHERE EventID = :eventID AND StudentID = :studentID AND ShiftID = :shiftID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(['eventID' => $_POST['eventID'], 'studentID' => $_SESSION['StudentID'], 'shiftID' => $_POST['shiftID'][$l]]);

					// Check for repeat

						if($stmt->rowCount()===0){
							// Inserting data into "studentshiftrequests"

								$sql = "INSERT INTO studentshiftrequests (EventID, StudentID, ShiftID) VALUES ( :eventID, :studentID, :shiftID)";
								$stmt = $pdo->prepare($sql);
								$stmt->execute(['eventID' => $_POST['eventID'], 'studentID' => $_SESSION['StudentID'], 'shiftID' => $_POST['shiftID'][$l]]);

							setcookie("formSubmitConfirm", "Shift requested", time()+3600);
						}
				}
		}

	// Rerouting user to "events.php"

	header('location: events.php');
?>