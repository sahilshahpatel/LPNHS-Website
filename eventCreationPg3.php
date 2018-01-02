<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";
    for($i = 0;$i<(int)$_GET["shifts"];$i++){
        if (empty($_POST['date'.$i])
        || empty($_POST['starttime'.$i])
        || empty($_POST['endtime'.$i])
        || empty($_POST['positionsavailable'.$i])){ header("Location: eventCreationPg2.php");
        }
    }
    
    foreach ($_POST as $key => $value) {
        $_SESSION['post'][$key] = $value;
    } 
    extract($_SESSION['post']); 

    $sql = "INSERT INTO `events`(`Name`, `Description`, `StartDate`,`EndDate`,`Location`,`Shifts`) VALUES (:name, :cost, :duedate,:rp)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["Name" => $billname, "Description" => $billcost, "Startdate" => $billduedate, "EndDate" => $billusers, "Location" => $billusers, "Shifts" => $billusers]);

    $sql = "SELECT * FROM user WHERE username=:myUser";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["myUser" => $_SESSION["Username"]]); //order of arrays corresponds order of ?
    $user = $stmt->fetch(PDO::FETCH_OBJ);
    $dbuserhouseid = $user->homeid;

    $sql = "SELECT * FROM bill WHERE name=:myBill";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["myBill" => $billname]); //order of arrays corresponds order of ?
    $bill = $stmt->fetch(PDO::FETCH_OBJ);
    $dbbillid = $bill->id;

    $sql = "INSERT INTO `homebill`(`homeid`, `billid`) VALUES (:homeid, :billid)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["homeid"=> $dbuserhouseid, "billid"=> $dbbillid]);
?>
<html>
<head>
    <title>NHS Test - Create Event</title>
    <!--jQuery-->
    <link rel = "stylesheet" href="baseCSS.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>
</head>

<!--Included via PHP-->
<header id = "header"><?php include "header.php"; ?></header>

<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">

    <div id = "mainPanel" class = "classic panel">
        <p style = "text-align: center;">Create Event</p>
        <div class="container">
        <div class="main">
            GOOD JOB
        </div>
    </div>        </div>

</body>

<footer id = "footer"><?php include "footer.php"; ?></footer>
</html>