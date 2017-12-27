<?php
session_start();
//----------
//username needs to come from session
//----------
    if(isset($_POST["email"])) {
        $useremail = $_POST["email"];
       
    } 
    else
    echo 'operation banana failed';
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

    } else if($rowCount==1){ //if only 1 user returned
        //grab info from db
        $dbEmail = $user->Email;
        $dbpass = $user->Password;
        $studentID = $user->StudentID;        

        if($useremail == $dbEmail && $userpassword == $dbpass) { 
            $_SESSION["StudentID"] = $studentID;
            header('Location: index.php'); 
            echo ("You've reached the point you should move to a different website");
        } else{
             echo "invalid username or password";
        }
    }
     ?>