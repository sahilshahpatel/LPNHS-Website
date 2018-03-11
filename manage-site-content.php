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
                resize: none;
                width: 38%;
                margin-top: 10px;
                margin-left:4%;
                -moz-transition: none 0s ease 0s
            }
            #article{
                margin: 10px auto;
                padding: 10px;
                width: 100%;
            }
            #article p{text-align: left;}
            #frontImg{
                width: 50%;
                margin: 10px;
                float: right;
            }
            #frontImg p{text-align: center;}
            #frontImg img{width: 100%;}
            #applicationRequirements{
                padding: 10px;
                border-left: solid 10px #005da3;
                background-color: white;
                margin: 5px auto;
                width: 90%;
            }
            ul{
                font-family: Bookman, sans-serif;
                font-size: 20px;
            }
            ul li{margin: 10px;}
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
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
                        <div id = "article" class = "classic card">
                            <h1 style = "color: #005da3">What It Takes to Be a Member</h1>
                            <hr style = "width: 90%;">
                            <div>
                                <div id = "frontImg" class = "card" style="margin-right: 5%;">
                                    <img src = "http://www.ispi.org/images/volunteer.png">
                                    <p>Image Caption</p>
                                </div>
                                <textarea id="whatItTakes" rows="16" autocomplete="off" autocorrect="off" style="font-size: 17px;" autocapitalize="off" spellcheck="false" cols="144" maxlength="752" style="overflow:hidden" name="whatItTakes" placeholder="<?php echo $whatittakes;?>" form="siteUpdater"><?php echo $whatittakes;?></textarea>
                            </div>
                            <div id = "applicationRequirements" class = "classic">
                                <h2 style = "color: #005da3">Application Requirements</h2>
                                <ul>
                                    <li>Req 1</li>
                                    <li>Req 2</li>
                                </ul>
                            </div>
                            <p><textarea id="whatItTakesUnder" rows="12" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" cols="144" maxlength="512" style="overflow:hidden" name="whatItTakes" placeholder="<?php echo $whatittakesunder;?>" form="siteUpdater"><?php echo $whatittakesunder;?></textarea></p>
                        </div>
                        <button id = "whatItTakesSubmit"  type="submit" value = "Submit" class = "classicColor submit">Submit</button>
                    </div>
                </form>
            </div>

        </div>
    </body>

    <?php
        $to = 'maryjane@email.com';
        $subject = 'Marriage Proposal';
        $from = 'peterparker@email.com';
        
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        
        // Compose a simple HTML email message
        $message = '<html><body>';
        $message .= '<h1 style="color:#f40;">Hi Jane!</h1>';
        $message .= '<p style="color:#080;font-size:18px;">Will you marry me?</p>';
        $message .= '</body></html>';
        
        // Sending email
        // if(mail($to, $subject, $message, $headers)){
        //     echo 'Your mail has been sent successfully.';
        // } else{
        //     echo 'Unable to send email. Please try again.';
        // }
    ?>
    <footer id = "footer"><?php include 'footer.php';?></footer>

</html>