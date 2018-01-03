<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
?>
<html>
<head>
    <title>LPNHS - Members</title>
    
    <!--TODO: Icon-->
    
    
    <!--Style Sheets-->
    <link rel="stylesheet" href="baseCSS.css">
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
        table tr:nth-child(even){
            background-color: #e8cfa4;
        }
        #addUserTable th, td{
            width: 12.5%;
        }
        input{
            max-width: 130px;
        }
    </style>
    
    <!--Scripts-->
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>
	<script>
       $(document).ready(function() {                 
			//specify nav-bar active link
			$("#membersLink").addClass("active");         
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
        
        <div id = "addUserDiv" class = "classic panel vanish">
            <p>Add User</p>
            <div class = "scrollable">
            <table id = "addUserTable"></table>
            </div>
        </div>
        
        <div class = "classic panel">
            <p>Leadership</p>
            <div class = "scrollable">
			<?php 
				if(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true"):
				echo '<form method = "post" action = "updateLeaders.php">';
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
        <div class = "classic panel">
            <p>Students</p>
            <div class = "scrollable">
			<?php 
				if(isset($_GET["manage"]) && htmlspecialchars($_GET["manage"])==="true"):
				echo '<form method = "post" action = "updateMembers.php">';
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
    <script src = "loadMembers.js"></script>
	-->
</body>
</html>