<?php
    session_start();
    session_destroy();
    session_start();
    error_reporting(E_ALL ^ E_NOTICE);
    include "database.php";


    // Checking previous input fields and assigning to variables

        if(isset($_POST["email"])) {
            $useremail = $_POST["email"];
        } 
        if(isset($_POST['password'])) {

            $userpassword = $_POST['password'];
        }
   
    // Pulling data from "students" where "Email" is the user inputed email

        $sql = "SELECT * FROM students WHERE Email=:myEmail";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(["myEmail" => $useremail]); 
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        $rowCount = $stmt->rowCount();

    // Checking if there is a user with same email, if not, invalid

        if ($rowCount != 1) { 

            header("location: login.php?login=invalid");

        } else{
            // If the user asswordHash;
            $studentID = $user->StudentID;        

            $dbEmail = $user->Email;
            $dbpassHash =$user->PasswordHash;

            // Check if the password matches, if not, invalid

                if($useremail === $dbEmail && password_verify($userpassword, $dbpassHash)) { 

                    // If successfull, start SESSION with "StudentID"

                        $_SESSION["StudentID"] = $studentID;
                        header('Location: index.php'); 
                } else{
                    header("location: login.php?login=invalid");
                }
        }
?>