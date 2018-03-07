<?php
	include "database.php";
	session_start();

	//Get current users info
	$sql = "SELECT * FROM students WHERE StudentID=:studentID";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(["studentID" => $_SESSION["StudentID"]]);
	$data = $stmt->fetch(PDO::FETCH_OBJ);

	if($data->Position!=="Vice President"){
		//Match President/Advisor/Admin query
		$sql = "SELECT * FROM students WHERE NOT Position='Student' ORDER BY Position, LastName, FirstName";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		$adminCount = $stmt->rowCount();
		$adminData = array();
		$adminData = $stmt->fetchAll();
	}
	else{
		//Match VP query
		$sql = "SELECT * FROM students WHERE VicePresident=:vpID AND NOT Position='Student' ORDER BY LastName, FirstName";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(['vpID' => $_SESSION['StudentID']]);
		$adminCount = $stmt->rowCount();
		$adminData = array();
		$adminData = $stmt->fetchAll();
	}
	for($i = 0; $i<$adminCount; $i++){
		if(isset($_POST["submit"][$i])){
			$sql = "UPDATE students SET HoursCompleted=:hrs, Position=:pos, VicePresident=:vp WHERE StudentID=:sID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["hrs"=>$_POST["hoursCompleted"][$i], "pos"=>$_POST["position"][$i], "vp"=>$_POST['vicePresident'][$i], "sID" => $adminData[$i][0]]);
			setcookie("formSubmitConfirm", "Leader information updated", time()+3600);
			header('Location:members.php?manage=true');
		}
		elseif(isset($_POST["remove"][$i])){
			$sql = "DELETE FROM students WHERE StudentID=:sID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["sID" => $adminData[$i][0]]);
			setcookie("formSubmitConfirm", "Leader account removed", time()+3600);
			header('Location:members.php?manage=true');
		}
?>