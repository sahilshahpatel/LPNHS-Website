<?php

    // Code to be implemented into pages that require a login

        if(!(isset($_SESSION["StudentID"]))){
            header("Location: index.php");
        }
        else{
            $sql = "SELECT * WHERE StudentID = :studentID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['studentID'=>$_SESSION['StudentID']]);
            $userData = $stmt->fetch(PDO::FETCH_OBJ);
            if($userData->Activated==0){
                header("Location: activateAccount.php");
            }
        }
?>