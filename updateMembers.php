<?php
	include "database.php";

	// Pulling data from "students" where "Position" : student

		$sql = "SELECT * FROM students WHERE Position='Student' ORDER BY LastName, FirstName";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$studentCount = $stmt->rowCount();
		$studentData = array();
		$studentData = $stmt->fetchAll();

	// Looping for every student

		for($i = 0; $i<$studentCount; $i++){
			
			// Checking if that student was picked -> $i -> student number if submit, then update info, if remove, then remove

				if(isset($_POST["submit"][$i])){

					// Updates the information of user chosen based on previous fields entered

						$sql = "UPDATE students SET HoursCompleted=:hrs, Position=:pos, VicePresident=:vp WHERE StudentID=:sID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["hrs"=>$_POST["hoursCompleted"][$i], "pos"=>$_POST["position"][$i], "vp"=>$_POST['vicePresident'][$i], "sID" => $studentData[$i][0]]);
						header('Location:members.php?manage=true&formSubmitConfirm=true');
				}
				else if(isset($_POST["remove"][$i])){
					
					// Removes the user chosen

						$sql = "DELETE FROM students WHERE StudentID=:sID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["sID" => $studentData[$i][0]]);

						$sql = "DELETE FROM studentevent WHERE StudentID=:sID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["sID" => $studentData[$i][0]]);
						
						$sql = "DELETE FROM studentshiftrequests WHERE StudentID=:sID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["sID" => $studentData[$i][0]]);
						
						$sql = "SELECT FROM positions WHERE StudentID=:sID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["sID" => $studentData[$i][0]]);
						$studPos = array();
						$studPos = $stmt->fetchAll();

						$sql = "DELETE FROM positions WHERE StudentID=:sID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["sID" => $studentData[$i][0]]);

						for($i = 0; $i<count($studPos); $i++{
							$sql = "UPDATE shifts SET PositionsAvailable = PositionsAvailable + 1 WHERE ShiftID =:shiftID AND PositionsAvailable > 0";
							$stmt = $pdo->prepare($sql);
							$stmt->execute(['shiftID' => $studPos[$i][1]]);
						}

						$sql = "DELETE FROM shiftcovers WHERE StudentID=:sID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["sID" => $studentData[$i][0]]);
						//header('Location:members.php?manage=true&formSubmitConfirm=true');
				}
		}
?>