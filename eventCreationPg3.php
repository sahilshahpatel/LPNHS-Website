<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";
    for($i = 0;$i<(int)$_GET["shifts"];$i++){
        if (empty($_POST['date'][$i])
        || empty($_POST['starttime'][$i])
        || empty($_POST['endtime'][$i])
        || empty($_POST['positionsavailable'][$i])){ header("Location: eventCreationPg2.php");
        }
    }
    
    foreach ($_POST as $key => $value) {
        $_SESSION['post'][$key] = $value;
    } 
    extract($_SESSION['post']); 
    $sql = "SELECT * FROM events WHERE Name=:eventName";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["eventName" => $name]); //order of arrays corresponds order of ?
    $eventNameSame = $stmt->rowCount();

    $sql = "SELECT * FROM events WHERE StartDate=:eventName";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["eventName" => $startdate]); //order of arrays corresponds order of ?
    $eventStartDateSame = $stmt->rowCount();

    $sql = "SELECT * FROM events WHERE EndDate=:eventName";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["eventName" => $enddate]); //order of arrays corresponds order of ?
    $eventEndDateSame = $stmt->rowCount();
    if($eventNameSame===0 || $eventStartDateSame ===0 ||$eventEndDateSame ===0){
        $sql = "INSERT INTO `events`(`Name`, `Description`, `StartDate`,`EndDate`,`Location`,`Shifts`) VALUES (:name, :description, :startdate, :enddate, :location, :shifts)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["name" => $name, "description" => $description, "startdate" => $startdate, "enddate" => $enddate, "location" => $location, "shifts" => $shifts]);

        $sql = "SELECT * FROM events WHERE Name=:eventName";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["eventName" => $name]); //order of arrays corresponds order of ?
        $event = $stmt->fetch(PDO::FETCH_OBJ);
        $eventID = $event->EventID;

        for($i = 0;$i<(int)$_GET["shifts"];$i++){
            $sql = "INSERT INTO `shifts`(`Date`, `StartTime`, `EndTime`, `PositionsAvailable`, `EventID`) VALUES (:date, :starttime, :endtime, :positionsavailable, :eventid)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["date" => $date[$i], "starttime" => $starttime[$i], "endtime" => $endtime[$i], "positionsavailable" => $positionsavailable[$i], "eventid" => $eventID]); //order of arrays corresponds order of ?
        
            $sql = "SELECT * FROM `shifts` WHERE EventID=:eventID AND Date=:date AND StartTime=:starttime AND EndTime=:endtime";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["eventID" => $eventID, "date" => $date[$i], "starttime" => $starttime[$i], "endtime" => $endtime[$i]]);
            $shift = $stmt->fetch(PDO::FETCH_OBJ);
            $shiftID = $shift->ShiftID;

            $sql = "INSERT INTO `eventshift`(`EventID`, `ShiftID`) VALUES (:eventid, :shiftid)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["eventid" => $eventID, "shiftid" => $shiftID]); //order of arrays corresponds order of ?
            for($j = 0;$j<$positionsavailable[$i];$j++){
                $sql = "INSERT INTO `positions`(`ShiftID`) VALUES (:shiftid)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(["shiftid" => $shiftID]); //order of arrays corresponds order of ?
            }
        }
    }
    else{
        setcookie("ERROR","Duplicate event detected.", time() + (86400 * 30), "/");
    }
    header("Location: create-event.php");
?>
