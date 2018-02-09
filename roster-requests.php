<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "loginCheck.php";
	include "adminCheck.php";
?>
<html>
<head>
    <title>LP NHS - Roster Requests</title>
    
    <!--TODO: Icon-->
    
    
    <!--Style Sheets-->
    <link rel="stylesheet" href="baseCSS.css">
    <style>
        #eventRequestsPanel{
            padding: 0;
        }
        table tr:nth-child(even){
            background-color: #e8cfa4;
        }
        #eventRequestsPanel div{
            border-top-left-radius: 15px;
            border-top-right-radius: 15px;
        }
        #tabs{
            background-color: #e8cfa4; /*darkened moccasin*/
        }
        #tabs div{
            display: inline-block;
            margin: 0;
            width: calc(50% - 2px);
            background-color: #ffebcd; /*blanched almond*/
        }
        #tabs div.inactive{
            background-color: #e8cfa4; /*darkened moccasin*/
        }
        #informationContainer{
            padding: 10px;
        }
        #informationContainer div table{
            width: 100%;
        }
        #informationContainer div table th, td{
            font-family: Bookman, sans-serif;
            font-size: 18px;
            text-align: center;
        }
    </style>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>

	<?php
	//Form Submission Confirmation
	if(isset($_COOKIE['formSubmitConfirm'])):
	?>
		<script>
		$(document).ready(function(){
			$("#banner").animate({backgroundColor: '#00CC00'});
			$("#banner").animate({backgroundColor: '#fff'});
		});
		</script>
	<?php
		$message = $_COOKIE['formSubmitConfirm'];
		setcookie("formSubmitConfirm", "", time() - 3600); //delete cookie
		endif;
	?>

	<header id = "header"><?php include 'header.php'; ?></header>
</head>
    
<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
    <div id = "footerPusher">
        <div id = "eventRequestsPanel" class = "classic panel">
            <div id = "informationContainer">
                <!--Information loaded via JavaScript-->
                <p>Roster Requests</p>
                <div id = "eventRequests">
					<form method = "post" action = "registerStudent.php">
						<table id = "eventRequestsTable">
							<!--<tr>
								<th>Event Name</th>
								<th>Student Name</th>
								<th>Total Confirmed Hours</th>
								<th>Shift Date</th>
								<th>Shift Time</th>
								<th>Event Repetitions</th>
								<th>Register</th>
							</tr>-->
							<!--Load data-->                    
							<?php include "rosterRequestsGetter.php";?>
						</table>
					</form>
                </div>
            </div>
        </div>
    </div>
    <footer id = "footer"><?php include "footer.php"; ?></footer>
</body>

</html>