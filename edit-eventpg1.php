<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";

    $sql = "SELECT * FROM events";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$adminCount = $stmt->rowCount();
	$adminData = array();
    $adminData = $stmt->fetchAll();
    
	for($i = 0; $i<$adminCount; $i++){
		if(isset($_POST["edit"][$i])){
			$sql = "SELECT * FROM events WHERE EventID=:eventID";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["eventID" => $_POST["eventID"][$i]]);
            $data = array();
            $data = $stmt->fetchAll();
            echo 'Im here',$i,"bah";
		}
		elseif(isset($_POST["remove"][$i])){
			$sql = "DELETE FROM events WHERE EventID=:eventID";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(["eventID" => $_POST["eventID"][$i]]);
			header('Location:edit-event.php');
        }
        
	}
?>
<html>
<head>
    <title>NHS Test - Create Event</title>
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
        input[type="date"]:before {
            content: attr(placeholder) !important;
            color: #aaa;
            margin-right: 0.5em;
        }
        input[type="date"]:focus:before,
        input[type="date"]:valid:before {
            content: "";
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
        input{
            width: 275px;
            line-height: 2em;
        }
    </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>
</head>

<!--Included via PHP-->
<header id = "header"><?php include "header.php"; ?></header>

<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
    <div id = "footerPusher">
        <div id = "mainPanel" class = "classic panel">
            <p style = "text-align: center;">Edit Event - <?php echo $data[0][1];?></p>
            <div class="container">
                <div class="main">
                    <span id="error">
                    </span>
                    <form id="eventCreator" action="edit-eventPg2.php" method="post"><?php
                    echo'
                        <table style="width=100%;" class = "listing">
                            <tr>
                                <td><label>Event Name :</label></td>
                                <td><input name="name" type="text" placeholder=',$data[0][1],' required></td>
                            </tr>
                            <tr>
                            <td><label>Description :</label></td><td>
                            <textarea rows="4" cols="36" style="overflow:hidden" width="250" name="description" placeholder=',$data[0][2],' form="eventCreator"></textarea></td>
                            </tr>
                            <tr>
                            <td><label>Start Date :</label></td>
                            <td><input name="startdate" type="date" placeholder="From ',$data[0][3],' To" required></td>
                            </tr>
                            <tr>
                            <td><label>End Date :</label></td>
                            <td><input name="enddate" type="date" placeholder="From ',$data[0][4],' To" required></td>
                            </tr>
                            <tr>
                            <td><label>Location :</label></td>
                            <td><input name="location" type="text" placeholder=',$data[0][5],' required></td>
                            </tr>
                            <tr>
                            <td><label>Shifts :</label></td>
                            <td><input name="shifts" type="text" placeholder=',$data[0][6],' required></td>
                            </tr>
                            <tr>
                            <td></td>
                            <td style = "text-align:center;"><input type="submit" value="Submit Changes" class = "classicColor"/></td>
                            </tr>
                        </table>'?>
                    </form>
                </div>
            </div>
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