<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
?>
<html>
<head>
    <title>NHS Test - Create Event</title>
    
    <!--TODO: Icon-->
    
    
    <!--Style Sheets-->
    <link rel="stylesheet" href="baseCSS.css">
    <style>
        p{
            text-align: left;
            margin: 0, 10px;
        }
        input, textarea{
            margin: 10px;
            width: 169px;
        }
        #shiftsTable{
            width: 100%;
        }
        button{
            margin: 10px;
        }
    </style>
    
    
    <!--Scripts-->
    <!--jQuery-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>
</head>

<!--Included via PHP-->
<header id = "header"><?php include "header.php"; ?></header>

<!--Included via JQuery-->
<header id = "header"></header>
    
<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">

    <div id = "mainPanel" class = "classic panel">
        <p style = "text-align: center;">Create Event</p>
        <br/>
        <p>Event Name</p>
        <input id = "eventName">
        <p>Description</p>
        <textarea id = "description"></textarea>
        <p>Location</p>
        <input id = "location">
        <p>Date Range</p>
        <input id = "startDate" type = "date"> <p style ="display:inline;">To</p> <input id = "endDate" type = "date">
        <br/>
        
        <hr>
        <table id = "shiftsTable">
            <thead>
                <tr>
                    <td><p style = "display:inline;">Shifts</p><input id = "numShifts" type = "number" value = "0" style = "width: 30px;"></td>
                    <td><p>Start Time</p></td>
                    <td><p>End Time</p></td>
                    <td><p>Positions Available</p></td>
                </tr>
            </thead>
            <tbody id = "shiftsTableBody"><!--TODO: make scrollable (had issue with table organization...)-->
                <!--Filled via JavaScript-->
            </tbody>
        </table>
        
        <button id = "submitButton" class = "classicColor" type = "button">Submit</button>
    </div>
    
    <!--Firebase.js-->
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
    
    <script src = "createEventScript.js"></script>
</body>

<!--Included via JQuery-->
<footer id = "footer"><?php include "footer.php"; ?></footer>
</html>