<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";

    // Pulling data from "sitecontent" to display

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
    
        <title>LPNHS - Manage Site Content</title>

        <link rel="stylesheet" href="baseCSS.css">
        <style>
            #footerPusher p{text-align: left;}
            form{
                display: inline-block;
                font-family: Bookman, sans-serif;
                font-size: 20px;
                align-items: center;
                justify-content: center;
                text-align: left;
                }
            .expander{display: inline-block;}
            input{
                display: block;
                width: 75%;
                margin: 10px;
            }
            button.submit{margin: 10px;}
            #eventsPanel{padding: 0;}
            #eventsPanel div{
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
            }
            #tabs{background-color: #e8cfa4; /*darkened moccasin*/}
            #tabs div{
                display: inline-block;
                margin: 0;
                width: calc(50% - 2px);
                background-color: #ffebcd; /*blanched almond*/
            }
            #tabs div.inactive{background-color: #e8cfa4; /*darkened moccasin*/}
            #informationContainer{padding: 10px;}
            #informationContainer div table{width: 100%;}
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <script src="http://code.jquery.com/color/jquery.color.plus-names-2.1.2.min.js"	integrity="sha256-Wp3wC/dKYQ/dCOUD7VUXXp4neLI5t0uUEF1pg0dFnAE="	crossorigin="anonymous"></script>
        <?php

            // Form Submission Confirmation

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
                    setcookie("formSubmitConfirm", "", time() - 3600); // delete cookie
                    endif;
        ?>
    </head>
        
    <header id = "header"><?php include "header.php"; ?></header>

    <body>
        <div id = "footerPusher">

                <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png"><!--Fixed Image in Background-->

                <form id="siteUpdater" action="siteUpdate.php" method="post">
                    <div id = "homePage" style="text-align: center;" class = "classic panel">
                            <p class = "expander">Manage Home Page</p>
                            <hr style="font-size:18px;">
                        <table>
                        
                            <tr><td><p style="text-align: center;">Alert</p></td></tr>
                            <tr><td><textarea id="alert" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="6" cols="144" maxlength="512" style="overflow:hidden" name="alert" placeholder="<?php echo $attention;?>" form="siteUpdater"><?php echo $attention;?></textarea></tr>
                            <tr><td><p style="text-align: center;">About Us</p></td></tr>
                            <tr><td><textarea id="aboutUsText" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="10" cols="144" maxlength="512" style="overflow:hidden" name="aboutUsText" placeholder="<?php echo $aboutus;?>" form="siteUpdater"><?php echo $aboutus;?></textarea></td></tr>
                            <tr><td><button id = "indexSubmit"  type="submit" value = "Submit" class = "classicColor submit">Submit</button></td></tr>
                        </table>
                    </div>
                    <div id = "whatItTakes" style="text-align: center;" class = "classic panel">
                        <p class = "expander">Manage What It Takes Page</p>
                        <hr style="font-size:18px;">
                        <table>
                            <tr><td><p style="text-align: center;">What It Takes</p></td></tr>
                            <tr><td><textarea id="whatItTakes" rows="20" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" cols="144" maxlength="512" style="overflow:hidden" name="whatItTakes" placeholder="<?php echo $whatittakes;?>" form="siteUpdater"><?php echo $whatittakes;?></textarea></td></tr>
                            <tr><td><p style="text-align: center;">What It Takes Part Two</p></td></tr>
                            <tr><td><textarea id="whatItTakesUnder" rows="12" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" cols="144" maxlength="512" style="overflow:hidden" name="whatItTakes" placeholder="<?php echo $whatittakesunder;?>" form="siteUpdater"><?php echo $whatittakesunder;?></textarea></td></tr>
                            <tr><td><button id = "whatItTakesSubmit"  type="submit" value = "Submit" class = "classicColor submit">Submit</button></td></tr>
                        </table>
                    </div>
                </form>
            </div>

        </div>
    </body>

    <footer id = "footer"><?php include 'footer.php';?></footer>

</html>