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
        for($i = 0;$i<(int)$_GET["shifts"];$i++){

            // Putting in inputed data for the shift

                $sql = "UPDATE `shifts` SET date=:date starttime=:starttime endtime=:endtime WHERE eventID=:eventID";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(["date" => $_POST['date'][$i], "starttime" => $_POST['starttime'][$i], "endtime" => $_POST['endtime'][$i], "eventID" => $eventID]); //order of arrays corresponds order of ?
        }
        
    // Setting cookie for Submit confirmation and rerouting user plus resetting session variables
            
        $temp = $_SESSION['StudentID'];
        session_unset();
        $_SESSION['StudentID'] = $temp;
        header("Location: edit-event.php?formSubmitConfirm=true");
    
?>

