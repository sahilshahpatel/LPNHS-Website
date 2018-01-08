<?php
    session_start();
    include "database.php";

    $sql = "SELECT * FROM students";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $studentCount = $stmt->rowCount();
    $studentIDs = array();
    array_push($studentIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));

	//Check permissions
	if(isset($_SESSION["StudentID"])){
		$sql = "SELECT * FROM students WHERE StudentID=:studentID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(["studentID" => $_SESSION["StudentID"]]);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		if(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true" && ($data->Position==="Teacher" || $data->Position==="Admin")):
			//admin view
			echo '<tr>
				<th>Name</th>
				<th>Email</th>
				<th>Position</th>
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
				if($data[0][7]!=='Student'){
					echo '<tr>';
					echo '<td>', $data[0][1],' ',$data[0][2] ,'</td>';
					echo '<td>', $data[0][3], '</td>';
					echo '<td><input name = "position[', $i,']" type = "text" style = "margin-left: 0px; max-width: 90px;" value=', $data[0][7], '></td>';
					echo '<td><input name = "hoursCompleted[', $i,']" type = "number" style = "max-width: 40px;" value=', $data[0][5], '></td>';
					echo '<td><input name = "submit[', $i,']" value = "Submit" class = "classicColor" type = "submit"></td>';
					echo '<td><input name = "remove[', $i,']" value = "Remove" class = "classicColor" type = "submit" onclick="return confirm(\'Are you sure?\')" style = "margin-right: 0px; background-color:red"></td>';
					echo '</tr>';
				}
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
	}

?>