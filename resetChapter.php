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
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no" />
    <head>
        <title>LPNHS - RESET</title>
        
        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
    </head>
    <header><?php include 'header.php';?><header>
    <body>
        <div id = "footerPusher">
            <div class = "classic panel">
                <form action = "resetChapterScript.php" method = "post" enctype = "multipart/form-data">
                    <p style = "text-align: left;">To reset the chapter, upload a CSV file with student information</p>
                    <p style = "font-size: 10px; font-style: italic; text-align: left;">Google spreadsheets can be downloaded as CSV files. Got to "File"->"Download As"->"CSV"</p>
                    <input type = "file" name = "studentInfoCSV" id = "studentInfoCSV" style = "padding-left: 8px; width: 180px; margin: 0 auto;">
                    <input type = "submit" name = "submit" class = "classicColor" style = "margin: 5px;">
                </form>
            </div>
        </div>
    </body>
    <footer><?php include 'footer.php';?></footer>
</html>