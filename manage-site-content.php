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
                font-family: Bookman, sans-serif;
                border: 1px solid black;
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
                font-family: Bookman, sans-serif;
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                resize: none;
                width: 100%;
                margin-top: 10px;
                -moz-transition: none 0s ease 0s;
                border: 1px solid black;
            }
            #article{
                margin: 10px auto;
                padding-top: 10px;
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
        <script>
            $( document ).ready(function() {
                $('textarea').each(function() {
                    $(this).height($(this).prop('scrollHeight'));
                });
            });
        </script>
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

                <form id="siteUpdater" action="siteUpdate.php" method="post" enctype="multipart/form-data">
                    <div id = "homePage" style="text-align: center;" class = "classic panel">
                            <p class = "expander">Manage Home Page</p>
                            <hr style="font-size:18px;">
                        <table>
                            <tr><td><p style = "text-align: center;">Home Image (Changes are irreversible!)</p></td></tr>
                            <tr><td><input type = "file" name = "frontImg" style = "border: 0; width: 180px; margin: 0 auto;"></td></tr>
                            <tr><td><p style="text-align: center;">Alert</p></td></tr>
                            <tr><td><textarea id="alert" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="6" cols="144" maxlength="512" style="overflow:hidden; width: 100%;" name="alert" placeholder="<?php echo $attention;?>" form="siteUpdater"><?php echo $attention;?></textarea></tr>
                            <tr><td><p style="text-align: center;">About Us</p></td></tr>
                            <tr><td><textarea id="aboutUsText" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" rows="10" cols="144" maxlength="512" style="overflow:hidden; width: 100%;" name="aboutUsText" placeholder="<?php echo $aboutus;?>" form="siteUpdater"><?php echo $aboutus;?></textarea></td></tr>
                            <tr><td><button id = "indexSubmit"  type="submit" value = "Submit" class = "classicColor submit">Submit</button></td></tr>
                        </table>
                    </div>
                    <div id = "whatItTakes" style="text-align: center;" class = "classic panel">
                        <p class = "expander">Manage What It Takes Page</p>
                        <hr style="font-size:18px;">
                        <!---->
                        <div style="padding: 10px;
                                    width: 90%;margin: 30px auto;
                                    background-color: #fff;font-size: 20px;
                                    border-radius: 15px;
                                    border-color: #daa520; background-color: #ffebcd;">
                            <article>
                                <h1 style = "color: #005da3;text-align: center;">What It Takes to Be a Member</h1>
                                <hr style = "width: 95%;">
                                <p style = "text-align: center">Article Image (Changes are irreversible!)</p>
                                <input type = "file" name = "what_it_takes" style = "border: 0; width: 180px; margin: 0 auto;">
                                <div style= "padding-top:10px;"><a style="font-size:14px;">*Note, if you want to create a new paragraph, type in <\br> TBD!</a><textarea id="whatItTakes" rows="16" autocomplete="off" autocorrect="off" style="font-size: 17px;height:100%;" autocapitalize="off" spellcheck="false" cols="144" maxlength="1024" style="overflow:hidden;" name="whatItTakes" placeholder="<?php echo $whatittakes;?>" form="siteUpdater"><?php echo $whatittakes;?></textarea></div>
                                <hr style = "width: 95%;">
                                <div id = "applicationRequirements" class = "classic" style="margin: 0 px; padding-top:0px; background-color: #ffebcd;">
                                    <h2 style = "color: #005da3">Application Requirements</h2>
                                    <ul id="appreqs" style="list-style-type:square;color: #005da3"> <!-- Inserting reqs by loop of php -->

                                        
                                    </ul>
                                    <script>
                                            function addItem(){
                                                var liList = document.getElementById("appreqs").getElementsByTagName("li");
                                                var largo = liList.length;
                                                var li = document.createElement("LI");li.id="li["+largo+"]";
                                                var input1 = document.createElement("input"); 
                                                input1.id="appReqTitle["+largo+"]";
                                                input1.name="appreqT["+largo+"]"; 
                                                input1.placeholder="Bullet Heading";
                                                var textareainput1 = document.createElement("textarea");  
                                                textareainput1.id="appReqText["+largo+"]";
                                                textareainput1.name="appreqTA["+largo+"]"; 
                                                textareainput1.placeholder="Bullet Details";
                                                textareainput1.style="width: 100%;";
                                                document.getElementById("appreqs").appendChild(li);
                                                document.getElementById("li["+largo+"]").appendChild(input1);
                                                document.getElementById("li["+largo+"]").appendChild(textareainput1);
                                            }
                                        </script>
                                        <input type="button" id="btnAdd" value="Add" onclick="addItem()">
                                </div>
                                <hr style = "width: 95%;">
                                <div  style= "padding-left:30px;padding-right:30px; margin-bottom: 30px;"><textarea id="whatItTakesUnder" style="width:100%;font-size: 17px;" rows="12" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" cols="144" maxlength="1024" style="overflow:hidden;" name="whatItTakesUnder" placeholder="<?php echo $whatittakesunder;?>" form="siteUpdater"><?php echo $whatittakesunder;?></textarea></div>
                            </article>
                            <button id = "whatItTakesSubmit"  type="submit" value = "Submit" class = "classicColor submit">Submit</button>
                        </div>
                    </div>
                </form>

        </div>
    </body>

    <?php // Setting up for future mail alert thing
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