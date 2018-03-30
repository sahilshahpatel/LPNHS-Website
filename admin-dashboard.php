<!DOCTYPE HTML>
<?php 
    session_start();
    require "database.php";
    $vpAllowed = true;
    require "adminCheck.php";

    //Get current user info
    $sql = "SELECT * FROM students WHERE StudentID=:studentID";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["studentID"=>$_SESSION["StudentID"]]);
    $userData = $stmt->fetch(PDO::FETCH_OBJ);
?>
<html>
    <head>

        <title>LPNHS - Admin Dashboard</title>
        
        <link rel="stylesheet" href="baseCSS.css">
        <style>
            div.dashboard{
                width: 80%;
                margin: 30px auto;
                padding: 0;
                
                display: flex;
                align-self: center;
            }
            #dashboard{height: 250px;}
            #presidentialOptions{height: 100px;}
            div.dashboardButton
            {
                cursor: pointer;
                display: inline-flex;
                margin: 5px;
                padding: 0 15px;
                width: 50%;
                height: 100%;
                border: 5px solid white;
                border-radius: 10px;
                font-size: 28px;
                align-items: center;
                justify-content: center;
                background-color: white;
                color: #005da3;
            }
            div.dashboardButton:hover 
            {
                background-color: transparent;
                border-color: white;
                color: white;
            }
        </style>
        <link rel="icon" type="image/png" href="img/nhs_logo.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <script>
        $(document).ready(function() {
                $("#setRosters").click(function(){
                    window.location.href = "roster-requests.php";
                });
                $("#shiftSwitches").click(function(){
                    window.location.href = "shiftCovers.php";
                });
                $("#confirmHours").click(function(){
                    window.location.href = "hour-logs.php";
                });
                $("#createEventDiv").click(function(){
                    window.location.href = "create-event.php";
                });
                $("#editEventDiv").click(function(){
                    window.location.href = "edit-event.php";
                });
                $("#manageMembers").click(function(){
                    window.location.href = "members.php?manage=true";
                });
                $("#manageSiteContent").click(function(){
                    window.location.href = "manage-site-content.php";
                });
                $("#backups").click(function(){
                    window.location.href = "databaseBackups.php";
                });
        });
        </script>

    </head>
    
    <header id = "header"><?php include "header.php"; ?></header>

    <body>
        <div id = "footerPusher">

            <img id = "fixedBGImg" src = "img/NHS_logo.png"><!--Fixed image in background-->

            <!--Only display manage members if user is a VP-->
            <?php if($userData->Position!== "Vice President"): ?>
                <div id = "presidentialOptions" class = "dashboard">
                    <div id = "setRosters" class = "dashboardButton">
                        <p>Accept/Deny Roster Requests</p>
                    </div>
                    <div id = "shiftSwitches" class = "dashboardButton">
                        <p>Accept/Deny Shift Cover Requests</p>
                    </div>
                    <div id = "confirmHours" class = "dashboardButton">
                        <p>Confirm Volunteer Hours</p>
                    </div>
                </div>
            <?php endif;?>

            <div id = "dashboard" class = "dashboard">
                <?php if($userData->Position!== "Vice President"): ?>
                    <div id = "createEventDiv" class = "dashboardButton">
                        <p>Create an Event</p>
                    </div>
                    <div id = "editEventDiv" class = "dashboardButton">
                        <p>Edit or Remove an Event</p>
                    </div>
                <?php endif;?>

                <div id = "manageMembers" class = "dashboardButton" <?php if($userData->Position === "Vice President"){echo 'style = "margin: 0 auto;"';}?>>
                    <p>Manage Members</p>
                </div>

                <?php if($userData->Position!== "Vice President"): ?>
                    <div id = "manageSiteContent" class = "dashboardButton">
                        <p>Manage Site Content</p>
                    </div>
                <?php endif;?>
            </div>
            <?php if($userData->Position!== "Vice President"): ?>
                <div id = "databaseOptions" class = "dashboard">
                    <div id = "backups" class = "dashboardButton">
                        <p>Restore From/Delete Database Backups</p>
                    </div>
                    <div id = "resetChapter" class = "dashboardButton">
                        <p>Reset Chapter for New Year</p>
                    </div>
                </div>
            <?php endif;?>
        </div>
    </body>

    <footer id = "footer"><?php include 'footer.php';?></footer>

</html>