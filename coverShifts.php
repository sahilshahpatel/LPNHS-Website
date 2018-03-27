<?php
    require 'database.php';

    //Implements the shift cover, transferring the position from requester to coverer

    $sql = "SELECT * FROM shiftcovers WHERE Agreed=1";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $count = $stmt->rowCount();
    $data = $stmt->fetch(PDO::FETCH_OBJ);

    for($i = 0; $i<$count; $i++){
        if(isset($_POST['submit'][$i])){
            //Update studentevent table (limit 1: if one student is registered for multiple shifts of an event, this will only change one instance of the student event connection)
            $sql = "UPDATE studentevent SET StudentID = :covererID WHERE EventID=:eventID AND StudentID = :requesterID LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['covererID'=>$_POST['covererID'][$i], 'eventID'=>$_POST['eventID'][$i], 'requesterID'=>$_POST['requesterID'][$i]]);

            //Update positions table
            $sql = "UPDATE positions SET StudentID = :covererID WHERE ShiftID=:shiftID AND StudentID = :requesterID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['covererID'=>$_POST['covererID'][$i], 'shiftID'=>$_POST['shiftID'][$i], 'requesterID'=>$_POST['requesterID'][$i]]);

            //Remove entry from shiftcovers
            $sql = "DELETE FROM shiftcovers WHERE CovererID = :covererID AND ShiftID=:shiftID AND RequesterID = :requesterID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['covererID'=>$_POST['covererID'][$i], 'shiftID'=>$_POST['shiftID'][$i], 'requesterID'=>$_POST['requesterID'][$i]]);
        }
    }

    header("Location: shiftCovers.php");
?>