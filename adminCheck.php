<?php
    require "loginCheck.php";

    $sql = "SELECT * FROM students WHERE StudentID=:studentID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["studentID" => $_SESSION["StudentID"]]);
    $data = $stmt->fetch(PDO::FETCH_OBJ);

    if(!$data->Position==="President" && !$data->Position==="Admin" && !$data->Position==="Advisor")
    {
        if(!(isset($_GET['vpAllowed']) && $_GET['vpAllowed']==="true" && $data->Position==="Vice President"){
            header("Location: index.php");
        }
    }
?>