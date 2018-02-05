<?php
session_start();
//----------
//username needs to come from session
//----------
    if(isset($_POST["email"])) {
        $useremail = $_POST["email"];
    } 
    else
    if(isset($_POST["password"])) {

        $userpassword = $_POST["password"];
 
    }
   
    

    include "database.php";

    // $sql = "SELECT * FROM user WHERE username=:myUser";
    // $stmt = $pdo->prepare($sql);
    // $stmt->execute(["myUser" => $username]); //order of arrays corresponds order of ?
    // $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

    $sql = "SELECT * FROM students WHERE Email=:myEmail";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["myEmail" => $useremail]); //order of arrays corresponds order of ?
    $user = $stmt->fetch(PDO::FETCH_OBJ);

    $rowCount = $stmt->rowCount();
    //welcome to the hack
    if ($rowCount != 1) { 

        echo "invalid username or password";

    } else{ //if only 1 user returned
        //grab info from db
        $dbEmail = $user->Email;
        $dbpassHash =$user->PasswordHash;
        $studentID = $user->StudentID;        

        if($useremail === $dbEmail && password_verify($userpassword, $dbpassHash)) { 
            $_SESSION["StudentID"] = $studentID;
            header('Location: index.php'); 
        } else{
             echo "invalid username or password";
        }
    }
     ?>