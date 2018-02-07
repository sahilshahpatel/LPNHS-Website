<?php
	include "database.php";

	$sql = "SELECT * FROM students WHERE Position='Student' ORDER BY LastName, FirstName";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$studentCount = $stmt->rowCount();
	$studentData = array();
	$studentData = $stmt->fetchAll();

	for($i = 0; $i<$studentCount; $i++){
		if(isset($_POST["submit"][$i])){
			$sql = "UPDATE students SET HoursCompleted=:hrs, Position=:pos, VicePresident=:vp WHERE StudentID=:sID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["hrs"=>$_POST["hoursCompleted"][$i], "pos"=>$_POST["position"][$i], "vp"=>$_POST['vicePresident'][$i], "sID" => $studentData[$i][0]]);
			header('Location:members.php?manage=true');
		}
		else if(isset($_POST["remove"][$i])){
			$sql = "DELETE FROM students WHERE StudentID=:sID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["sID" => $studentData[$i][0]]);
			header('Location:members.php?manage=true');
		}
	}
?>