<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";
    $sql = "SELECT * FROM sitecontent WHERE ID=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(["id" => 1]);
    $sc = $stmt->fetch(PDO::FETCH_OBJ);
    $whatittakes = $sc->whatItTakes;
    $whatittakesunder = $sc->whatItTakes2;
    $aboutus = $sc->aboutUs;
    $attention = $sc->attention;
?>
<html>
<head>
    <title>NHS Test - Manage Site Content</title>
    
    <!--TODO: Icon-->
    
    
    <!--Style Sheets-->
    <link rel="stylesheet" href="baseCSS.css">
    <style>
        #footerPusher p{
            text-align: left;
        }
        form{
            display: inline-block;
            font-family: Bookman, sans-serif;
            font-size: 20px;
            align-items: center;
            justify-content: center;
            text-align: left;
            }
        .expander{
            display: inline-block;
        }
        input{
            display: block;
            width: 75%;
            margin: 10px;
        }
        button.submit{
            margin: 10px;
        }
        #eventsPanel{
            padding: 0;
        }
        #eventsPanel div{
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
            width: 33.33%;
            font-family: Bookman, sans-serif;
            font-size: 18px;
            text-align: center;
        }
        textarea {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            resize: vertical;
            width: 80%;
            -moz-transition: none 0s ease 0s
        }
    </style>
    
    <!--Scripts-->
    <!--jQuery-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="headerJQuery.js"></script>
</head>
    
	<!--Included via PHP-->
<header id = "header"><?php include "header.php"; ?></header>

<body>
    <div id = "footerPusher">
        <div id = "informationContainer">
            <!--Included via JQuery-->
            <header id = "header"></header>
            <!--Fixed Img in Background-->
            <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
            <form id="siteUpdater" action="siteUpdate.php" method="post">
                <div id = "homePage" style="text-align: center;" class = "classic panel">
                    <table>
                        <tr><td><p class = "expander">Manage Home Page</p></td></tr>
                        <tr><td><hr style="font-size:18px;"></td></tr>
                        <tr><td><p style="text-align: center;">Alert</p></td></tr>
                        <tr><td><textarea id="alert" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="6" cols="144" width="50%" maxlength="512" style="overflow:hidden" width="250" name="alert" placeholder="<?php $attention?>" form="eventCreator"></textarea></tr>
                        <tr><td><p style="text-align: center;">About Us</p></td></tr>
                        <tr><td><textarea id="aboutUsText" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="10" cols="144" maxlength="512" style="overflow:hidden" width="250" name="aboutUsText" placeholder="<?php $aboutus?>" form="eventCreator"></textarea></td></tr>
                        <tr><td><button id = "indexSubmit"  type="submit" value = "Submit" class = "classicColor submit">Submit</button></td></tr>
                    </table>
                </div>
                <div id = "whatItTakes" style="text-align: center;" class = "classic panel">
                    <table>
                        <tr><td><p class = "expander">Manage What It Takes Page</p></td></tr>
                        <tr><td><hr style="font-size:18px;"></td></tr>
                        <tr><td><p style="text-align: center;">What It Takes</p></td></tr>
                        <tr><td><textarea id="whatItTakes" rows="20" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" cols="144" maxlength="512" style="overflow:hidden" width="250" name="whatItTakes" placeholder="<?php $whatittakes?>" form="eventCreator"></textarea></td></tr>
                        <tr><td><textarea id="whatItTakesUnder" rows="12" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" cols="144" maxlength="512" style="overflow:hidden" width="250" name="whatItTakes" placeholder="<?php $whatittakesunder?>" form="eventCreator"></textarea></td></tr>
                        <tr><td><button id = "whatItTakesSubmit"  type="submit" value = "Submit" class = "classicColor submit">Submit</button></td></tr>
                    </table>
                </div>
            </form>
        </div>
    </div>
    <!--Included via JQuery-->
    <footer id = "footer"><?php include 'footer.php';?></footer>
</body>
</html>