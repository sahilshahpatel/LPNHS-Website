<?php
	include "database.php";

	$sql = "SELECT * FROM students WHERE Position='Student'";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$adminCount = $stmt->rowCount();
	$adminData = array();
	$adminData = $stmt->fetchAll();
	for($i = 0; $i<$adminCount; $i++){
		if(isset($_POST["submit"][$i])){
			$sql = "UPDATE students SET HoursCompleted=:hrs, Position=:pos WHERE StudentID=:sID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["hrs"=>$_POST["hoursCompleted"][$i], "pos"=>$_POST["position"][$i], "sID" => $adminData[$i][0]]);
			header('Location:members.php?manage=true');
		}
		elseif(isset($_POST["remove"][$i])){
			$sql = "DELETE FROM students WHERE StudentID=:sID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["sID" => $adminData[$i][0]]);
			header('Location:members.php?manage=true');
		}
	}
?>