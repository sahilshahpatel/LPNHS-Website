<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";
?>
<html>
<head>
    <title>LPNHS - Admin Dashboard</title>
    
    <!--TODO: Icon-->
    
    
    <!--Style Sheets-->
    <link rel="stylesheet" href="baseCSS.css">
    <style>
        div.dashboard{
            width: 80%;
            margin: 30px auto;
            padding: 0;
            
            display: flex;
            align-self: center;
        }
		#dashboard{
			height: 250px;
		}
		#presidentialOptions{
			height: 75px;
		}
        div.dashboardButton{
            display: inline-flex;
            margin: 5px;
            padding: 0 15px;
            width: 50%;
            height: 100%;
            border: 5px solid white;
            border-radius: 10px;
            
            /* Adjust Text */
            font-size: 28px;
            align-items: center;
            justify-content: center;
            
            /* Color */
            background-color: white;
            color: #005da3;
        }
        div.dashboardButton:hover {
            background-color: transparent;
            border-color: white;
            color: white;
        }
    </style>
    
    <!--Scripts-->
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="headerJQuery.js"></script>
	<script>
       $(document).ready(function() {
			$("#setRosters").click(function(){
				window.location.href = "roster-requests.php";
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
       });
    </script>
</head>
    
<!--Included via PHP-->
<header id = "header"><?php include "header.php"; ?></header>

<body>
    <div id = "footerPusher">
        <!--Included via JQuery-->
        <header id = "header"></header>

        <!--Fixed Img in Background-->
        <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
        
		<div id = "presidentialOptions" class = "dashboard">
			<div id = "setRosters" class = "dashboardButton">
                <p>Accept/Deny Roster Requests</p>
            </div>
			<div id = "confirmHours" class = "dashboardButton">
                <p>Confirm Student Volunteer Hours</p>
            </div>
		</div>

        <div id = "dashboard" class = "dashboard">
            <div id = "createEventDiv" class = "dashboardButton">
                <p>Create an Event</p>
            </div>
            <div id = "editEventDiv" class = "dashboardButton">
                <p>Edit or Remove an Event</p>
            </div>
            <div id = "manageMembers" class = "dashboardButton">
                <p>Manage Members</p>
            </div>
            <div id = "manageSiteContent" class = "dashboardButton">
                <p>Manage Site Content</p>
            </div>
        </div>
    </div>
    <!--Included via JQuery-->
    <footer id = "footer"><?php include 'footer.php';?></footer>
    
    <!--Firebase.js
    <script src="https://www.gstatic.com/firebasejs/4.1.3/firebase.js"></script>
    <script>
        // Initialize Firebase
        var config = {
            apiKey: "AIzaSyByQW8Cyp9yAIMm5xCrNZqF-5kqJ-w6g-4",
            authDomain: "nhs-project-test.firebaseapp.com",
            databaseURL: "https://nhs-project-test.firebaseio.com",
            projectId: "nhs-project-test",
            storageBucket: "nhs-project-test.appspot.com",
            messagingSenderId: "239221174231"
        };
        firebase.initializeApp(config);
    </script>
    <script src = "requireAdminPermissions.js"></script>
	-->
</body>
</html>