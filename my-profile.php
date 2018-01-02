<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
?>
<html>
<head>
    <title>NHS Test - My Profile</title>
    
    <!--TODO: Icon-->
    
    
    <!--Style Sheets-->
    <link rel="stylesheet" href="baseCSS.css">
    <style>
        #ProfileDataDiv p{
            text-align: left;
            display: inline-block;
        }
        
        #ProfileDataDiv input{
            text-align: center;
        }
        
        #ProfileDataDiv button{
            margin: 10px;
        }
        div.dashboardButton{
			text-align: center;
            margin: 30px 10%;
            border: 3px solid white;
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
		div.dashboardButton p{
			margin: 5px;
		}
    </style>
    
    <!--Scripts-->
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>
    <script>
        $(document).ready(function(){
            $("#myProfileLink").addClass("active");

			$("#adminDashboardButton").click(function(){
				window.location.href = "admin-dashboard.php";
			});
        });
    </script>
    <header id = "header"><?php include "header.php"; ?></header>
</head>

<!--Included via JQuery-->
<header id = "header"></header>
    
<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
    
	<!--Include Admin Dashboard link-->
	<?php 
		$sql = "SELECT * FROM students WHERE StudentID=:studentID";
		$stmt = $pdo->prepare($sql);
		$stmt->execute(["studentID" => $_SESSION["StudentID"]]);
		$data = $stmt->fetch(PDO::FETCH_OBJ);
		if($data->Position!=="Student"):
			echo '<div id = "adminDashboardButton" class = "dashboardButton">
                <p>Admin Dashboard</p>
            </div>';
		endif;
	?>

    <div class = "classic panel">
        <p>My Information</p>
        <div id = "ProfileDataDiv">
            <!--View only data-->
			<?php 
				$sql = "SELECT * FROM students WHERE StudentID=:studentID";
				$stmt = $pdo->prepare($sql);
				$stmt->execute(["studentID" => $_SESSION["StudentID"]]);
				$data = $stmt->fetch(PDO::FETCH_OBJ);
			?>
            <p>Name: </p><p id = "fullName"><?php echo $data->FirstName, ' ', $data->LastName;?></p>
            <br/>
            <p>Hours Worked: </p><p id = "hoursWorked"><?php echo $data->HoursCompleted;?></p>
            <br/>
            <p>Vice President: </p><p id = "vicePresident"><?php echo $data->VicePresident;?></p>
            
            <hr>
            
            <!--Editable Data-->
            <p>Displayed Name:</p>
            <input id = "displayName" placeholder = "e.g. John">
            <br/>
            <button id = "submitChanges" class = "classicColor" type = "button">Submit Changes</button>
            <p id = "status" class = "hidden">-</p>
        </div>
    </div>
    
    <!--Firebase
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
    <script src = "updateProfileDataScript.js"></script>
	-->
</body>
    
<!--Included via JQuery-->
<footer id = "footer"><?php include 'footer.php';?></footer>
</html>