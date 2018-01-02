<?php
    include "loginCheck.php";

    $sql = "SELECT * FROM students WHERE StudentID=:studentID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["studentID" => $_SESSION["StudentID"]]);
    $data = $stmt->fetch(PDO::FETCH_OBJ);

    if($data->Position==="Student"){
        header("Location: index.php");
    }
?>