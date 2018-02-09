<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";
?>
<html>
<head>
    <title>LPNHS - Create Event</title>
    <!--jQuery-->
    <link rel = "stylesheet" href="baseCSS.css">
    <style>
        form{
            display: inline-block;
            font-family: Bookman, sans-serif;
            font-size: 20px;
            align-items: center;
            justify-content: center;
            text-align: left;
            }
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
        textarea, input {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            resize: vertical;
            width: 50%;
            -moz-transition: none 0s ease 0s;
            line-height: 2em;
        }
    </style>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>

	<script src="http://code.jquery.com/color/jquery.color.plus-names-2.1.2.min.js"	integrity="sha256-Wp3wC/dKYQ/dCOUD7VUXXp4neLI5t0uUEF1pg0dFnAE="	crossorigin="anonymous"></script>
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
</head>

<!--Included via PHP-->
<header id = "header"><?php include "header.php"; ?></header>

<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
    <div id = "footerPusher">
        <div id = "mainPanel" class = "classic panel">
            <p style = "text-align: center;">Create Event</p>
            <?php include "eventCreationPg1.php"; ?>
        </div>
    </div>
        <?php 
    if(isset($_COOKIE['ERROR'])) {
        $Error = $_COOKIE['ERROR'];
        echo '<script>
        $(document).ready(function(){
            alert("', $Error,'");
        });
        </script>';
        setcookie("ERROR","", time() - (86400 * 30), "/");
        }

    ?>
</body>

<footer id = "footer"><?php include "footer.php"; ?></footer>
</html>