<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
?>
<html>
<head>
    <title>NHS Test - Edit Event</title>
    
    <!--TODO: Icon-->
    
    
    <!--Style Sheets-->
    <link rel="stylesheet" href="baseCSS.css">
    <style>
        table{
            width: 100%;
            text-align: center;
        }
        #mainPanel{
            padding: 10px;
        }
        table.positionTable{
            border: solid 3px black;
            width: auto; /*Override above 100% */
            margin: 0 auto;
        }
    </style>
    
    <!--Scripts-->
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
</head>
    
	<!--Included via PHP-->
<header id = "header"><?php include "header.php"; ?></header>

<body>
    <div id = "footerPusher">
        <!--Included via JQuery-->
        <header id = "header"></header>

        <!--Fixed Img in Background-->
        <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
        
        <div id = "mainPanel" class = "classic panel">
            <p style = "text-align: center;">Edit Event</p>
            <table>
                <thead>
                    <td><p>Event Name</p></td>
                    <td><p>Description</p></td>
                    <td><p>Location</p></td>
                    <td><p>Date Range</p></td>
                </thead>
                <tr>
                    <td>
                        <input id = "eventName" list = "eventNameList" placeholder = "Search for events here!">
                        <datalist id = "eventNameList"><!--Options added in JavaScript--></datalist>
                    </td>
                    <td><input id = "description"></td>
                    <td><input id = "location"></td>
                    <td><input id = "startDate" type = "date"> <p style ="display:inline;">To</p> <input id = "endDate" type = "date"></td>
                </tr>
            </table>

            <hr>
            <table id = "shiftsTable">
                <thead>
                    <tr>
                        <td><p style = "display:inline;" id = "shiftsTitle">Shifts</p></td>
                        <td><p>Date</p></td>
                        <td><p>Start Time</p></td>
                        <td><p>End Time</p></td>
                        <td><p>Positions</p></td>
                    </tr>
                </thead>
                <tbody id = "shiftsTableBody"><!--TODO: make scrollable (had issue with table layout...)-->
                    <!--Filled via JavaScript-->
                </tbody>
            </table>
            
            <!--Filled and Used in editEvent.js-->
            <datalist id = "studentList"></datalist>

            <button id = "submitButton" class = "classicColor" type = "button">Submit</button>
            <button id = "deleteButton" class = "classicColor vanish" style = "background-color: red;" type = "button">Delete Event</button>
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
    <script src = "editEvent.js"></script>
    <script src = requireAdminPermissions.js></script>
	-->
</body>
</html>