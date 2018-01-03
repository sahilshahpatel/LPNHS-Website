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
        $stmt->execute(["date" => $date[$i], "starttime" => $starttime[$i], "endtime" => $endtime[$i], "positionsavailable" => $positionsavailable[$i], "eventid" => $eventID[$i]]); //order of arrays corresponds order of ?
    
        $sql = "SELECT * FROM `shifts` WHERE EventID=:eventID AND Date=:date AND StartTime=:starttime AND EndTime=:endtime";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["eventID" => $eventID, "date" => $date[$i], "starttime" => $starttime[$i], "endtime" => $endtime[$i]]);
        $shift = $stmt->fetch(PDO::FETCH_OBJ);
        $shiftID = $shift->ShiftID;

        $sql = "INSERT INTO `eventshift`(`EventID`, `ShiftID`) VALUES (:eventid, :shiftid)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["eventid" => $eventID[$i], "shiftid" => $shiftID]); //order of arrays corresponds order of ?

        $sql = "INSERT INTO `positions`(`ShiftID`) VALUES (:shiftid)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["shiftid" => $shiftID]); //order of arrays corresponds order of ?
    }
    header("Location: create-event.php");
?>
