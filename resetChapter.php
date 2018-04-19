<!DOCTYPE HTML>
<?php
    require 'database.php';
    session_start();
    require 'adminCheck.php';

    //Deny presidential access
    $sql = "SELECT Position FROM students WHERE StudentID=:studentID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["studentID" => $_SESSION["StudentID"]]);
    $data = $stmt->fetch();
    if($data[0]==="President")
    {
        header("location: admin-dashboard.php");
    }
?>
<html>
    <head>
        <title>LPNHS - RESET</title>
        
        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
    </head>
    <header><?php include 'header.php';?><header>
    <body>
        <div class = "classic panel">
            <input type = "file" name = "what_it_takes" style = "border: 0; width: 180px; margin: 0 auto;">
        </div>
    </body>
    <footer><?php include 'footer.php';?></footer>
</html>