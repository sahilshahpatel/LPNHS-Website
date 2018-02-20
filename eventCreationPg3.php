<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";

    // Checking if previous fields were all filled and then storing information into SESSION

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

    // Extracting all information from SESSION

        extract($_SESSION['post']); 

    // Pulling Data from "events" to check if there is a duplicate event

        $sql = "SELECT * FROM events WHERE Name=:eventName";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["eventName" => $name]); 
        $eventNameSame = $stmt->rowCount();

        $sql = "SELECT * FROM events WHERE StartDate=:eventName";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["eventName" => $startdate]); 
        $eventStartDateSame = $stmt->rowCount();

        $sql = "SELECT * FROM events WHERE EndDate=:eventName";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["eventName" => $enddate]); 
        $eventEndDateSame = $stmt->rowCount();

    // Checking if duplicate event

        if($eventNameSame===0 || $eventStartDateSame ===0 ||$eventEndDateSame ===0){

            // Inserting event into "events" with inputed data

                $sql = "INSERT INTO `events`(`Name`, `Description`, `StartDate`,`EndDate`,`Location`,`Shifts`, `ReleaseDate`) VALUES (:name, :description, :startdate, :enddate, :location, :shifts, :releasedate)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(["name" => $name, "description" => $description, "startdate" => $startdate, "enddate" => $enddate, "location" => $location, "shifts" => $shifts, "releasedate" => $releasedate]);

            // Getting event id from new event

                $sql = "SELECT * FROM events WHERE Name=:eventName";
                $stmt = $pdo->prepare($sql);
                $stmt->execute(["eventName" => $name]);
                $event = $stmt->fetch(PDO::FETCH_OBJ);
                $eventID = $event->EventID;

            // Looping the creation of shifts and their positions

                for($i = 0;$i<(int)$_GET["shifts"];$i++){

                    // Putting in inputed data for the shift

                        $sql = "INSERT INTO `shifts`(`Date`, `StartTime`, `EndTime`, `PositionsAvailable`, `EventID`) VALUES (:date, :starttime, :endtime, :positionsavailable, :eventid)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(["date" => $date[$i], "starttime" => $starttime[$i], "endtime" => $endtime[$i], "positionsavailable" => $positionsavailable[$i], "eventid" => $eventID]); //order of arrays corresponds order of ?
                
                    // Getting shift id from new shift

                        $sql = "SELECT * FROM `shifts` WHERE EventID=:eventID AND Date=:date AND StartTime=:starttime AND EndTime=:endtime";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(["eventID" => $eventID, "date" => $date[$i], "starttime" => $starttime[$i], "endtime" => $endtime[$i]]);
                        $shift = $stmt->fetch(PDO::FETCH_OBJ);
                        $shiftID = $shift->ShiftID;

                    // Putting shift id into "eventshift" for each shift to correlate each shift with the event

                        $sql = "INSERT INTO `eventshift`(`EventID`, `ShiftID`) VALUES (:eventid, :shiftid)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(["eventid" => $eventID, "shiftid" => $shiftID]);

                    // Looping the creation of positions for each shift and correlating the two

                        for($j = 0;$j<$positionsavailable[$i];$j++){
                            $sql = "INSERT INTO `positions`(`ShiftID`, `HoursConfirmed`) VALUES (:shiftid, 0)";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(["shiftid" => $shiftID]);
                        }
                }

            // Setting cookie for forSubmitConfirm

                setcookie("formSubmitConfirm", "Event Created", time()+3600);

        }
        else{
            
            // Setting cookie for duplicate event
                setcookie("ERROR","Duplicate event detected.", time() + (86400 * 30), "/");

        }

    // Rerouting user to "create-event" page

        header("Location: create-event.php");

?>
