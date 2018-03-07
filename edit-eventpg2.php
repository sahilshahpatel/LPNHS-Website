<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";

    // Checking all previous entries for content and then updating the event

		if(!empty($_POST['name']))
        {
            $sql = "UPDATE events SET Name=:name WHERE EventID=:eventID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["name" => $_POST['name'], "eventID" => $_POST['eventID']]); 
        }
		if(!empty($_POST['releasedate']))
        {
            $sql = "UPDATE events SET ReleaseDate=:releasedate WHERE EventID=:eventID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["releasedate" => $_POST['releasedate'], "eventID" => $_POST['eventID']]);
        }
        if(!empty($_POST['startdate']))
        {
            $sql = "UPDATE events SET StartDate=:startdate WHERE EventID=:eventID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["startdate" => $_POST['startdate'], "eventID" => $_POST['eventID']]);
        }
        if(!empty($_POST['location']))
        {
            $sql = "UPDATE events SET Location=:location WHERE EventID=:eventID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["location" => $_POST['location'], "eventID" => $_POST['eventID']]); 
        }
        if(!empty($_POST['enddate']))
        {
            $sql = "UPDATE events SET EndDate=:enddate WHERE EventID=:eventID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["enddate" => $_POST['enddate'], "eventID" => $_POST['eventID']]);
        }
        if(!empty($_POST['description']))
        {
            $sql = "UPDATE events SET Description=:description WHERE EventID=:eventID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["description" => $_POST['description'], "eventID" => $_POST['eventID']]);
        }

    // Setting cookie for Submit confirmation and rerouting user
    
        setcookie("formSubmitConfirm", "Event edited", time()+3600);
        header("Location: edit-event.php");
    
?>

