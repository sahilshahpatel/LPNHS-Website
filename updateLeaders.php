<?php
	include "database.php";

	// Pulling data from "students" of all users except those of "Position" : Student

		$sql = "SELECT * FROM students WHERE NOT Position='Student' ORDER BY Position, LastName, FirstName";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$adminCount = $stmt->rowCount();
		$adminData = array();
		$adminData = $stmt->fetchAll();

	// Loops for every admin

		for($i = 0; $i<$adminCount; $i++){

			// Checking if that admin was picked -> $i -> admin number if submit, then update info, if remove, then remove

				if(isset($_POST["submit"][$i])){

					// Updates the information of user chosen based on previous fields entered

						$sql = "UPDATE students SET HoursCompleted=:hrs, Position=:pos, VicePresident=:vp WHERE StudentID=:sID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["hrs"=>$_POST["hoursCompleted"][$i], "pos"=>$_POST["position"][$i], "vp"=>$_POST['vicePresident'][$i], "sID" => $adminData[$i][0]]);
						setcookie("formSubmitConfirm", "Leader information updated", time()+3600);
						header('Location:members.php?manage=true');
				}
				elseif(isset($_POST["remove"][$i])){

					// Removes the user chosen

						$sql = "DELETE FROM students WHERE StudentID=:sID";
						$stmt = $pdo->prepare($sql);
						$stmt->execute(["sID" => $adminData[$i][0]]);
						setcookie("formSubmitConfirm", "Leader account removed", time()+3600);
						header('Location:members.php?manage=true');
				}
		}
?>