<?php
	include "database.php";

	$sql = "SELECT * FROM events";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();

	$eventData = array();
	$eventData = $stmt->fetchAll();
	$eventCount = $stmt->rowCount();
	for($i = 0; $i<$eventCount; $i++){
		if(isset($_POST["submit"][$i])){
			//Delete data from "requests" table
			

			//Add data to events/shifts/positions tables
		}
	}
?>