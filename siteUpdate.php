<?php

    session_start();
    include "database.php";
    include "adminCheck.php";

    // Checks input from previous fields, and then updates the corresponding data

        if(isset($_POST['alert']))
        {
            $sql = "UPDATE sitecontent SET attention=:alert WHERE ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["alert" => $_POST['alert'],"id" => 1]);
        }
        if(!empty($_POST['aboutUsText']))
        {
            $sql = "UPDATE sitecontent SET aboutUs=:aboutUs WHERE ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["aboutUs" => $_POST['aboutUsText'],"id" => 1]);
        }
        if(!empty($_POST['whatItTakes']))
        {
            $sql = "UPDATE sitecontent SET whatitTakes=:whatItTakes WHERE ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["whatItTakes" => $_POST['whatItTakes'],"id" => 1]);
        }
        if(!empty($_POST['whatItTakesUnder']))
        {
            $sql = "UPDATE sitecontent SET whatitTakes2=:whatItTakesUnder WHERE ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["whatItTakesUnder" => $_POST['whatItTakesUnder'],"id" => 1]);
        }

    // Sets cookie for "formSubmitConfirm" and reroutes user to "manage-site-content.php"

        header("Location: manage-site-content.php?formSubmitConfirm=true");
    
?>