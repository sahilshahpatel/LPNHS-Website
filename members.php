<!DOCTYPE HTML>
<?php 
    session_start();
	require "database.php";
	require "loginCheck.php";
	
	// Checking if manage is currently in effect

		if(isset($_GET["manage"]) && $_GET["manage"]==="true"){
			require "adminCheck.php";
		}
?>
<html>
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no" />
	<head>

		<title>LPNHS - Members</title>
		
		<link rel="stylesheet" href="baseCSS.css">
		<link rel="icon" type="image/png" href="img/nhs_logo.png">
		<style>
			table{
				width: 100%;
				font-family: Bookman, sans-serif;
				text-align: center;
			}
			table td{
				padding: 5px 0;
				margin: 0;
			}
			table tr:nth-child(even){background-color: #e8cfa4;}
			input {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                resize: none;
                -moz-transition: none 0s ease 0s;
                line-height: 2em;
            }
			@media only screen and (min-width: 629px){
                #informationContainer form table  th, td{
                    padding: 5px;
                    font-family: Bookman, sans-serif;
                    font-size: 18px;
                    text-align: center;
                }
				#leaderPanel{padding: 0;overflow-y: auto;}
				#studentPanel{padding: 0;overflow-y: auto;}
				input {max-width: 130px;}
            }
            @media only screen and (max-width: 630px) {
                #informationContainer form table  th, td{
                    font-family: Bookman, sans-serif;
                    font-size: 3.5vmin;
                    text-align: center;
                }
				#leaderPanel{padding: 0;margin: 4.5vmin;overflow-y: auto;}
				#studentPanel{padding: 0;margin: 4.5vmin;overflow-y: auto;}
				select{
                    font-size:3vmin;
				}
				input {max-width: 120px;}
            }
		</style>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="headerJQuery.js"></script>
		<script>
		$(document).ready(function() {                 
				//specify nav-bar active link
				$("#membersLink").addClass("active");         
		}); 
		</script>

		<script src="http://code.jquery.com/color/jquery.color.plus-names-2.1.2.min.js"	integrity="sha256-Wp3wC/dKYQ/dCOUD7VUXXp4neLI5t0uUEF1pg0dFnAE="	crossorigin="anonymous"></script>
		<?php

            // Form Submission Confirmation

                if(isset($_GET['formSubmitConfirm'])):
                ?>
                    <script>
                    $(document).ready(function(){
                        $("#banner").animate({backgroundColor: '#00CC00'});
                        $("#banner").animate({backgroundColor: '#fff'});
                    });
                    </script>
                <?php
                    endif;
        ?>
	</head>
		
	<header id = "header"><?php include "header.php"; ?></header>

	<body>
		<div id = "footerPusher">

			<img id = "fixedBGImg" src = "img/NHS_logo.png"><!--Fixed Image in Background-->
			
			<div class = "classic panel" id="leaderPanel">
				<p>Leadership</p>
				<div class = "scrollable">
						<?php 
							if(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true"):
							echo '<form id = "manageLeadersForm" method = "post" action = "updateLeaders.php">';
							endif;
						?>
					<table id = "leadership" class = "listing">
						<?php 
							if(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true"):
								echo '<script>
									$(document).ready(function(){
										$("#leadership").load("getLeaders.php?manage=true");
									});
									</script>';
							else:
								echo '<script>
									$(document).ready(function(){
										$("#leadership").load("getLeaders.php");
									});
									</script>';
							endif;
						?>
					</table>
						<?php 
							if(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true"):
							echo '</form>';
							endif;
						?>
				</div>
			</div>
			<div class = "classic panel" id="studentPanel">
				<p>Students</p>
				<div class = "scrollable">
						<?php 
							if(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true"):
							echo '<form id = "manageMembersForm" method = "post" action = "updateMembers.php">';
							endif;
						?>
					<table id = "students" class = "listing">
						<?php 
							if(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true"):
								echo '<script>
									$(document).ready(function(){
										$("#students").load("getMembers.php?manage=true");
									});
									</script>';
							else:
								echo '<script>
									$(document).ready(function(){
										$("#students").load("getMembers.php");
									});
									</script>';
							endif;
						?>
					</table>
						<?php 
							if(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true"):
							echo '</form>';
							endif;
						?>
				</div>
			</div>
		</div>		
	</body>

	<footer id = "footer"><?php include 'footer.php';?></footer>

</html>