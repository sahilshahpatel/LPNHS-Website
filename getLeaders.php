<?php
    session_start();
    include "database.php";

    $sql = "SELECT * FROM students";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $studentCount = $stmt->rowCount();
    $studentIDs = array();
    array_push($studentIDs, $stmt->fetchAll(PDO::FETCH_COLUMN, 0));

    echo '<tr>
        <th>Name</th>
        <th>Email</th>
        <th>Position</th>
    </tr>';
    for($i = 0; $i<$studentCount; $i++){
        $sql = "SELECT * FROM students WHERE StudentID=:studentID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["studentID" => $studentIDs[0][$i]]);
        $data = array();
        $data = $stmt->fetchAll();
        if($data[0][7]!=='Student'){
            echo '<tr>';
            echo '<td title>', $data[0][1],' ',$data[0][2] ,'</td>';
            echo '<td>', $data[0][3], '</td>';
            echo '<td>', $data[0][7], '</td>';
            echo '</tr>';
        }
    } 
?>