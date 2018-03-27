<?php
    session_start();
    require 'database.php';
    
    $s=0;
    while(!isset($_POST['submit'][$s])){
        $s++;
    }
    $p=0;
    while(!isset($_POST['submit'][$s][$p])){
        $p++;
    }
    $sql = "INSERT INTO shiftcovers (RequesterID, ShiftID, CovererID, Agreed) VALUES (:rID, :shiftID, :cID, 0)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['rID'=>$_SESSION['StudentID'], 'shiftID'=> $_POST['shiftID'][$s][$p], 'cID'=> $_POST['covererID'][$s][$p]]);

    header("Location: events.php");
?>