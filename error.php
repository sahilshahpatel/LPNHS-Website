<!DOCTYPE html>
<?php 
    session_start();
    if(isset($_COOKIE['LOGINERROR'])) {
        $Error = $_COOKIE['LOGINERROR'];
    
    }
    else{$Error="Unidentified error!";}
?>
<html>

<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no" />
<link rel="icon" type="image/png" href="img/nhs_logo.png">
	<style>
		body{
			margin: 0px;
			background-color: #005da3;
			text-align: center;
		}
		#login{
			display: inline-block;
			margin: 10% auto;
			padding: 30px;
			background-color: #FFF;
			border-radius: 15px;
			text-align: left;
		}
		#login div{
			display: inline-block;
			padding: 30px;
		}
		#login button{
			border: none;
			padding: 10px;
			border-radius: 15px;
			font-size: 12px;
			margin-top: 10px;
			margin-bottom: 0px;
			background-color: #005da3;
			color: white;
			
			font-family: Bookman, sans-serif;
			font-size: 24px;
		}

		#login p{
			margin: 5px 0px;
			color: white;
			text-align: left;
			font-family: Bookman, sans-serif;
			font-size: 24px;
		}
		#login input{
			font-family: Bookman, sans-serif;
			font-size: 24px;
		}
	</style>

	<head>

		<link rel="stylesheet" href="baseCSS.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>

		<title>LP NHS - Error</title>

	</head>

    <header id = "header"><?php include "header.php"; ?></header>

	<body>
        <div id = "footerPusher">

            <img id = "fixedBGImg" src = "img/NHS_logo.png"> <!--Fixed image in background-->

			<div id="login" class="form" action="session.php" method="post" style="height:150px;width:400px;">
				<h2 class="logTitle" style="text-align:center;">ERROR</h2>
					<hr class="loghr">

				<label class="field" style="text-align:center;">
					Error: <?php echo $Error;?>
				</label>
			</div>	

        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>