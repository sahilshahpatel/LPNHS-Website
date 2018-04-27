<!DOCTYPE HTML>
<?php
	session_start();
    include "database.php";

    // Pulling data from "sitecontent" into variables to display

    $sql = "SELECT * FROM sitecontent WHERE ID=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id" => 1]);
    $sc = $stmt->fetch(PDO::FETCH_OBJ);
    $whatittakes = $sc->whatItTakes;
    $whatittakesunder = $sc->whatItTakes2;
    $appreqs = $sc->appReqs;

    $appreqsbpositions = array();
    $appreqsbpositions = explode("^",$appreqs);
    $appreqsnum = count($appreqsbpositions)-1;
?>
<html>
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no" />
    <head>

        <title>NHS Test - What It Takes</title>

        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <script>
        $(document).ready(function() {
                //specify nav-bar active link
                $("#whatItTakesLink").addClass("active");            
        }); 
        </script>
    </head>
        
    <header id = "header"><?php include "header.php"; ?></header>

    <body>
        <div id = "footerPusher">

            <img id = "fixedBGImg" src = "img/NHS_logo.png"><!--Fixed Image in Background-->
            <div class="what-it-takes">
                <article>
                    <h1 style = "color: #005da3;text-align: center;">What It Takes to Be a Member</h1>
                    <hr style = "width: 95%;">
                    <div id = "frontImg" style="margin-right:30px;width:50%">
                        <img src = "img/what_it_takes.jpg">
                    </div>
                    <div style= "padding-left:3vmin;padding-top:10px;" style="white-space: pre-wrap;"><a style="white-space: pre-wrap;"><?php echo $whatittakes; ?></a></div>
                    <hr style = "width: 95%;">
                    <div id = "applicationRequirements" class = "classic" style="margin: 0 px; padding-top:0px;background-color: #ffebcd;">
                        <h2 style = "color: #005da3">Application Requirements</h2>
                        <ul id="appreqs">
                            <?php $arraysplitter = array();
                                            for($k = 1; $k<=$appreqsnum; $k++)
                                            {
                                                $arraysplitter = explode("&",$appreqsbpositions[$k-1]);
                                                $arraysplitter = explode("&",$appreqsbpositions[$k-1]);
                                                echo '<li style="white-space: pre-wrap;color: black;"><b style="color: #005da3">',$arraysplitter[0],'</b><br>';
                                                echo $arraysplitter[1], '</li>';
                                                }?> <!-- Inserting reqs by loop of php -->
                        </ul>
                    </div>
                    <hr style = "width: 95%;">
                    <div  style= "padding-left:3vmin;padding-right:30px; margin-bottom: 30px;" ><a style="white-space: pre-wrap;"><?php echo $whatittakesunder; ?></a></div>
                </article>
            </div>

        </div>
    </body>

    <footer id = "footer"><?php include 'footer.php';?></footer>

</html>