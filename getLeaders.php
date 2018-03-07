<?php
    session_start();
    include "database.php";

   	//Get current users info
	$sql = "SELECT * FROM students WHERE StudentID=:studentID";
	$stmt = $pdo->prepare($sql);
	$stmt->execute(["studentID" => $_SESSION["StudentID"]]);
	$data = $stmt->fetch(PDO::FETCH_OBJ);

	if(!(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true" && $data->Position==="Vice President")){
		//In most cases, load all student's info
		$sql = "SELECT * FROM students WHERE NOT Position='Student' ORDER BY LastName, FirstName";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();

		$studentCount = $stmt->rowCount();
		$studentIDs = array();
		array_push($studentIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));
	}
	else{
		//If a VP is trying to manage members, only load their specific students
		$sql = "SELECT * FROM students WHERE VicePresident=:vpID AND NOT Position='Student' ORDER BY LastName, FirstName";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(['vpID' => $_SESSION['StudentID']]);

		$studentCount = $stmt->rowCount();
		$studentIDs = array();
		array_push($studentIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));
	}

	//Check permissions
	if(isset($_SESSION["StudentID"])){
		if(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true" && ($data->Position==="President" || $data->Position==="Advisor" || $data->Position==="Admin" || $data->Position==="Vice President")):
			//admin view
			echo '<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Position</th>
				<th>VP</th>
				<th>Hours Completed</th>
				<th>Submit Changes</th>
				<th>Remove</th>
				</tr>';

			for($i = 0; $i<$studentCount; $i++){
				$sql = "SELECT * FROM students WHERE StudentID=:studentID";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(["studentID" => $studentIDs[0][$i]]);
				$data = array();
				$data = $stmt->fetchAll();

				echo '<tr>';
				echo '<td>', $data[0][1],' ',$data[0][2] ,'</td>';
				echo '<td>', $data[0][3], '</td>';

				//Display list of positions
				$positions = array("Admin", "Advisor", "President", "Vice President", "Student");
				echo '<td><select name="position[', $i,']">';
				foreach($positions as $p){
					echo '<option ';
					//set default value
					if($data[0][7] === $p){
						echo 'selected = "selected" ';
					}
					echo 'value = "', $p, '">', $p, '</option>';
				}
				unset($p);
				echo '</select></td>';

				//Get list of all VPs
				$sql = "SELECT * FROM students WHERE Position=:vp";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(['vp'=>"Vice President"]);
				$vpData = array();
				$vpData = $stmt->fetchAll();
				echo '<td><select name = "vicePresident[', $i, ']" form = "manageLeadersForm">';
				for($vp = 0; $vp<count($vpData); $vp++){
					echo '<option ';
					//set default value
					if($vpData[$vp][0] === $data[0][6]){
						echo 'selected = "selected" ';
					}
					echo 'value = "', $vpData[$vp][0], '">', $vpData[$vp][1], '</option>';
				}
				echo '</select></td>';

				echo '<td><input name = "hoursCompleted[', $i,']" type = "number" style = "max-width: 40px;" value=', $data[0][5], '></td>';
				echo '<td><input name = "submit[', $i,']" value = "Submit" class = "classicColor" type = "submit"></td>';
				echo '<td><input name = "remove[', $i,']" value = "Remove" class = "classicColor" type = "submit" onclick="return confirm(\'Are you sure?\')" style = "margin-right: 0px; background-color:red"></td>';
				echo '</tr>';
			} 
			
		else:
			//student view
			echo '<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Position</th>
				</tr>';
			for($i = 0; $i<$studentCount; $i++){
				$sql = "SELECT * FROM students WHERE StudentID=:studentID";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(["studentID" => $studentIDs[0][$i]]);
				$data = array();
				$data = $stmt->fetchAll();
				if($data[0][7]!=='Student'){
					echo '<tr>';
					echo '<td>', $data[0][1],' ',$data[0][2] ,'</td>';
					echo '<td>', $data[0][3], '</td>';
					echo '<td>', $data[0][7], '</td>';
					echo '</tr>';
				}
			} 
		endif;
	}
	else{
		echo '<tr>
		<th>Name</th>
		<th>Email</th>
		</tr>';
		for($i = 0; $i<$studentCount; $i++){
			$sql = "SELECT * FROM students WHERE StudentID=:studentID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["studentID" => $studentIDs[0][$i]]);
			$data = array();
			$data = $stmt->fetchAll();
			if($data[0][7]!=='Student'){
				echo '<tr>';
				echo '<td>', $data[0][1],' ',$data[0][2] ,'</td>';
				echo '<td>', $data[0][3], '</td>';
				echo '</tr>';
			}
		} 
	}

?>