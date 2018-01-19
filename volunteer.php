<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "loginCheck.php";
?>
<html>
<head>
    <title>LPNHS - Volunteer</title>
    
    <!--TODO: Icon-->
    
    
    <!--Style Sheets-->
    <link rel="stylesheet" href="baseCSS.css">
    <style>
        #shiftsPanel{
            padding: 0;
        }
        table tr:nth-child(even){
            background-color: #e8cfa4;
        }
		#shiftsPanel div{
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        #informationContainer{
            padding: 10px;
        }
        #informationContainer form table{
            width: 100%;
        }
        #informationContainer form table th, td{
			padding: 5px;
            font-family: Bookman, sans-serif;
            font-size: 18px;
            text-align: center;
        }
    </style>
    <header id = "header"><?php include "header.php"; ?></header>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>
</head>
    
<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
    <div id = "footerPusher">
        <div id = "shiftsPanel" class = "classic panel">
            <div id = "informationContainer">
				<p>Available Shifts</p>
				<form method = "post" action = "requestShift.php">
					<table id = "shiftsTable">
						<!--Load data-->
						<?php include "loadShifts.php"; ?>
					</table>
				</form>
            </div>
        </div>
    </div>
</body>
<footer id = "footer"><?php include "footer.php"; ?></footer>
</html>