<?php

    // Code to be implemented into pages that require a login

        if(!(isset($_SESSION["StudentID"]))){
            header("Location: index.php");
        }
        else{
            $sql = "SELECT * FROM students WHERE StudentID=:studentID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["studentID" => $_SESSION["StudentID"]]);
            $data = $stmt->fetch(PDO::FETCH_OBJ);
            if($data->Activated==0){
                header("Location: activateAccount.php");
            }
        }
?>