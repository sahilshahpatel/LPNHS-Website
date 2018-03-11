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
    
    // A loop check for every data listing on the last page to find the event selected

        for($i = 0; $i<$adminCount; $i++){

            // Checking if edit was pressed for $i -> number event -> then setting page to edit that event

                if(isset($_POST["edit"][$i])){
                    $sql = "SELECT * FROM events WHERE EventID=:eventID";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['eventID' => $_POST['eventID'][$i]]);
                    $thisEventID = $_POST['eventID'][$i];
                    $data = array();
                    $data = $stmt->fetchAll();
                }

            // Checking if remove was pressed for $i -> number event -> then removing that event

                else if(isset($_POST["remove"][$i])){

                    // Deleting from database table "events" and "shifts"

                        $sql = "DELETE FROM events WHERE EventID=:eventID";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['eventID' => $_POST['eventID'][$i]]);
                        
                        $sql = "DELETE FROM shifts WHERE EventID=:eventID";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['eventID' => $_POST['eventID'][$i]]);

                        $sql = "DELETE FROM studentevent WHERE EventID=:eventID";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['eventID' => $_POST['eventID'][$i]]);
                        
                        $sql = "DELETE FROM studentshiftrequests WHERE EventID=:eventID";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['eventID' => $_POST['eventID'][$i]]);
                    
                    // Finding all the Shifts of the event being deleted -> putting them into an array and then
                    // deleting those shifts from the table "eventshift"

                        $sql = "SELECT shiftID FROM eventshift WHERE EventID=:eventID";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['eventID' => $_POST['eventID'][$i]]);
                        $shiftIDS = array();
                        $shiftIDS = $stmt->fetchAll();         

                        $sql = "DELETE FROM eventshift WHERE EventID=:eventID";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['eventID' => $_POST['eventID'][$i]]);
                    
                    // Going through the table "positions" and deleting all of the positions through data from array of shifts

                        for($i=0;$i<sizeof($shiftIDS);$i++){
                            $sql = "DELETE FROM positions WHERE ShiftID=:shiftID";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(['shiftID' => $shiftIDS[$i][0]]);
                        } 

                    // Rerouting back to first page

                        header('Location:edit-event.php');
                }
            
        }
?>
<html>
    <head>

        <title>LPNHS - Edit Event</title>

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
                color: #a9a9a9;
                margin-right: 0.5em;
            }
            input[type="date"]:focus:before,
            input[type="date"]:valid:before {content: "";}
            table{
                width: 100%;
                font-family: Bookman, sans-serif;
                text-align: center;
            }
            table td{
                padding: 5px 0;
                margin: 0;
            }
            table tr:nth-child(even){background-color: #e8cfa4;}
            #addUserTable th, td{width: 12.5%;}
            textarea, input {
                -webkit-box-sizing: border-box;
                -moz-box-sizing: border-box;
                box-sizing: border-box;
                resize: none;
                width: 50%;
                -moz-transition: none 0s ease 0s;
                line-height: 2em;
            }
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>

    </head>

    <header id = "header"><?php include "header.php"; ?></header>

    <body>

        <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png"> <!--Fixed image in background-->

        <div id = "footerPusher">
            <div id = "mainPanel" class = "classic panel">
                <p style = "text-align: center;">Edit Event - <?php echo $data[0][1];?></p>
                <p style = "text-align: center;">Only edit the fields you want to change</p>
                <div class="container">
                    <div class="main">
                        
                        <!--Data loaded through PHP-->

                        <form id="eventCreator" action="edit-eventPg2.php" method="post">
                            <?php
                                echo'
                                    <table style="width=100%;" class = "listing">
                                        <tr>
                                        <input name = "eventID" type = "hidden" value = "',$thisEventID ,'">
                                            <td><label>Event Name :</label></td>
                                            <td><input name="name" maxlength="32" type="text" value="',$data[0][1],'" ></td>
                                        </tr>
                                        <tr>
                                            <td><label>Release Date :</label></td>
                                            <td><input name="releasedate" type="date" value="',$data[0][7],'"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Description :</label></td><td>
                                            <textarea rows="4" autocomplete="off" autocorrect="off" autocapitalize="off" spellcheck="false" cols="36" maxlength="128" style="overflow:hidden" width="250" name="description" form="eventCreator">', $data[0][2], '</textarea></td>
                                        </tr>
                                        <tr>
                                            <td><label>Start Date :</label></td>
                                            <td><input name="startdate" type="date" value="',$data[0][3],'"></td>
                                        </tr>
                                        <tr>
                                            <td><label>End Date :</label></td>
                                            <td><input name="enddate" type="date" value="',$data[0][4],'"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Location :</label></td>
                                            <td><input name="location" maxlength="32" type="text" value="',$data[0][5],'"></td>
                                        </tr>
                                        <tr>
                                            <td><label>Shifts :</label></td>
                                            <td><p style="font-size:18px;">',$data[0][6],' </p></td>
                                        </tr>
                                        <tr>
                                        <td></td>
                                        <td style = "text-align:center;"><input type="submit" value="Submit Changes" class = "classicColor"/></td>
                                        </tr>
                                    </table>';
                                ?>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>