<?php
    require 'database.php';

    //Mark shift cover as accepted

    $sql = "SELECT * FROM shiftcovers WHERE CovererID = :covererID AND Agreed=0";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['covererID'=>$_POST['covererID']]);
    $count = $stmt->rowCount();
    $data = $stmt->fetch(PDO::FETCH_OBJ);

    for($i = 0; $i<$count; $i++){
        if(isset($_POST['shiftID'][$i]) && isset($_POST['requesterID'][$i])){
            $sql = "UPDATE shiftcovers SET Agreed=1 WHERE RequesterID = :requesterID AND CovererID = :covererID AND ShiftID = :shiftID LIMIT 1";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['covererID'=>$_POST['covererID'], 'shiftID'=>$_POST['shiftID'][$i], 'requesterID'=>$_POST['requesterID'][$i]]);
        } 
    }

    header("Location: my-profile.php");
?>