<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";

    if (empty($_POST['name'])
    || empty($_POST['startdate'])
    || empty($_POST['location'])
    || empty($_POST['enddate'])
    || empty($_POST['shifts'])){ header("Location: create-event.php");}
    foreach ($_POST as $key => $value) {
        $_SESSION['post'][$key] = $value;
    } 
    $shifts = $_POST['shifts'];
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
            <h2>PHP Multi Page Form</h2>
            <span id="error">
    
            </span><?php
            echo '<form id="eventCreator" action="eventCreationPg3.php?shifts=',$shifts,'" method="post">';
                 for($i = 0; $i<$shifts;$i++){
                echo '<label>Shift Date :<span>*</span></label>
                <input name="date[',$i,']" type="date" placeholder="eg: 01/01/2018" required>
                <label>Start Time :<span>*</span></label>
                <input name="starttime[',$i,']" type="text" placeholder="eg: 8:00 AM" required>
                <label>End Time :<span>*</span></label>
                <input name="endtime[',$i,']" type="text" placeholder="eg: 5:00 PM" required>
                <label>Positions Available :<span>*</span></label>
                <input name="positionsavailable[',$i,']" type="text" placeholder="eg: 5 postions" required>';
                }?>
                <input type="submit" value="Submit" />
            </form>
        </div>
    </div>        </div>

</body>

<footer id = "footer"><?php include "footer.php"; ?></footer>
</html>