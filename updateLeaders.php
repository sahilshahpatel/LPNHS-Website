<?php
	require "database.php";
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
		if(isset($_POST["submit"][$i]) && ($data->Position==="President" || $data->Position==="Advisor" || $data->Position==="Admin")){
			$sql = "UPDATE students SET FirstName=:FN, LastName=:LN, Email=:email, HoursCompleted=:hrs, Position=:pos, VicePresident=:vp WHERE StudentID=:sID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["FN"=>$_POST['studFirstName'][$i], "LN"=>$_POST['studLastName'][$i], "email"=>$_POST['studEmail'][$i], "hrs"=>$_POST["hoursCompleted"][$i], "pos"=>$_POST["position"][$i], "vp"=>$_POST['vicePresident'][$i], "sID" => $adminData[$i][0]]);
			header('Location:members.php?manage=true&formSubmitConfirm=true');
		}
		if(isset($_POST["submit"][$i])){
			$sql = "UPDATE students SET HoursCompleted=:hrs, Position=:pos, VicePresident=:vp WHERE StudentID=:sID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["hrs"=>$_POST["hoursCompleted"][$i], "pos"=>$_POST["position"][$i], "vp"=>$_POST['vicePresident'][$i], "sID" => $adminData[$i][0]]);
			header('Location:members.php?manage=true&formSubmitConfirm=true');
		}
		elseif(isset($_POST["remove"][$i])){
			include 'loading.html'; // Display loading screen and fixing long load for some reason
			// Removes the user chosen

			$sql = "DELETE FROM students WHERE StudentID=:stID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["stID" => $adminData[$i][0]]);

			$sql = "DELETE FROM studentevent WHERE StudentID=:stID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["stID" => $adminData[$i][0]]);
			
			$sql = "DELETE FROM studentshiftrequests WHERE StudentID=:stID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["stID" => $adminData[$i][0]]);
			
			$sql = "SELECT FROM positions WHERE StudentID=:stID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["stID" => $adminData[$i][0]]);
			$studPos = array();
			$studPos = $stmt->fetchAll();

			$sql = "DELETE FROM positions WHERE StudentID=:stID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["stID" => $adminData[$i][0]]);

			for($i = 0; $i<count($studPos); $i++){
				$sql = "UPDATE shifts SET PositionsAvailable = PositionsAvailable + 1 WHERE ShiftID =:shiftID";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(['shiftID' => $studPos[$i][1]]);
			}

			$sql = "DELETE FROM shiftcovers WHERE RequesterID=:stID OR CovererID=:stID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["stID" => $adminData[$i][0]]);
			header('Location:members.php?manage=true&formSubmitConfirm=true');
		}}
		header('Location:members.php?manage=true&formSubmitConfirm=true');
		?>