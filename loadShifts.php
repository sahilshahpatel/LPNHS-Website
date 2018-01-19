<?php
	//session_start();
    include 'database.php';

	$sql = "SELECT * FROM events";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $eventCount = $stmt->rowCount();
	$eventIDs = array();
    array_push($eventIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));

	echo '<tr>
		  <th>Date</th>
		  <th>Time</th>
		  <th>Positions Available</th>
		  <th>Request Shift</th>
		  </tr>';

	for($i = 0; $i<$eventCount; $i++){
		if(isset($_POST['submit'][$i])){
			$sql = 'SELECT * FROM eventshift WHERE EventID=:eventID';
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['eventID' => $eventIDs[0][$i]]);
			$shiftsList = array();
			$shiftsList = $stmt->fetchAll();

			for($l = 0; $l<count($shiftsList); $l++){
				$sql = "SELECT * FROM shifts WHERE ShiftID=:shiftID";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(['shiftID' => $shiftsList[$l][1]]);
				$shiftData = array();
				$shiftData = $stmt->fetchAll();

				if(count($shiftData)>0){
					echo '<tr>';

					//Hidden form info to be passed
					echo '<input type = "hidden" name = "eventID" value = "', $eventIDs[0][$i], '">';
					echo '<input type = "hidden" name = "shiftID[', $l,']" value = "', $shiftData[0][0], '">';


					echo '<td>', $shiftData[0][1], '</td>';
					echo '<td>', $shiftData[0][2], ' to ', $shiftData[0][3], '</td>';
					echo '<td>', $shiftData[0][4], '</td>';
					echo '<td><input type = "submit" name = "submit[', $l, ']" value = "Volunteer!" class = "classicColor"></td>';
					echo '</tr>';
				}
			}
		}
	}
?>