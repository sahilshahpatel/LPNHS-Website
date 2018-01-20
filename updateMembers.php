<?php
	include "database.php";

	$sql = "SELECT * FROM students WHERE Position='Student'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$studentCount = $stmt->rowCount();
	$studentData = array();
	$studentData = $stmt->fetchAll();

	for($i = 0; $i<$studentCount; $i++){
		var_dump($_POST['submit']);
		if(isset($_POST["submit"][$i])){
		echo 'here';
			$sql = "UPDATE students SET HoursCompleted=:hrs, Position=:pos WHERE StudentID=:sID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["hrs"=>$_POST["hoursCompleted"][$i], "pos"=>$_POST["position"][$i], "sID" => $studentData[$i][0]]);
			header('Location:members.php?manage=true');
		}
		elseif(isset($_POST["remove"][$i])){
			$sql = "DELETE FROM students WHERE StudentID=:sID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["sID" => $studentData[$i][0]]);
			header('Location:members.php?manage=true');
		}
	}
?>