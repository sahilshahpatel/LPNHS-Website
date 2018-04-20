<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";

    $invalidshiftdate=false;
    if(isset($_GET['date'])){$invalidshiftdate = true;}

    $sql = "SELECT * FROM events";
	$stmt = $pdo->prepare($sql);
	$stmt->execute();
	$adminCount = $stmt->rowCount();
	$adminData = array();
    $adminData = $stmt->fetchAll();
    
    // If returning from edit-eventpg2
    if(isset($_GET["eventID"])){
        $sql = "SELECT * FROM events WHERE EventID=:eventID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['eventID' => (int)$_GET["eventID"]]);
        $thisEventID = $_GET["eventID"];
        $data = array();
        $data = $stmt->fetchAll();
        $sql = "SELECT shiftID FROM eventshift WHERE EventID=:eventID";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['eventID' => (int)$_GET["eventID"]]);
        $shiftIDS = array();
        $shiftIDS = $stmt->fetchAll(); 
    }
    else{
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

                        $sql = "SELECT shiftID FROM eventshift WHERE EventID=:eventID";
                        $stmt = $pdo->prepare($sql);
                        $stmt->execute(['eventID' => $_POST['eventID'][$i]]);
                        $shiftIDS = array();
                        $shiftIDS = $stmt->fetchAll(); 
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

                                $sql = "DELETE FROM shiftcovers WHERE ShiftID=:shiftID";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(['shiftID' => $shiftIDS[$i][0]]);
                            } 

                        // Rerouting back to first page

                            header('Location:edit-event.php?formSubmitConfirm=true');
                    }
                
            }
        }
?>
<html>
    <head>

        <title>LPNHS - Edit Event</title>

        <link rel = "stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">
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
            span.clicker { cursor: pointer; }
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <script>
        $(document).ready(function() {
            $('div.toggleInner').toggle(false); //hide all the tables on load.

            $('.shiftButton').click(function() {
                $(this).parents('div.toggleWrapper').find('div.toggleInner').slideToggle('fast');
                });
            });
        </script>

    </head>

    <header id = "header"><?php include "header.php"; ?></header>

    <body>

        <img id = "fixedBGImg" src = "img/NHS_logo.png"> <!--Fixed image in background-->

        <div id = "footerPusher">
            <div id = "mainPanel" class = "classic panel">
                <p style = "text-align: center;">Edit Event - <?php echo $data[0][1];?></p>
                <p style = "text-align: center;">Only edit the fields you want to change</p>
                <div class="container">
                    <div class="main">
                        
                        <!--Data loaded through PHP-->
                        
                        <?php
                            $sql = "SELECT * FROM eventshift WHERE EventID=:eventID";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(['eventID'=>$thisEventID]);
                            $shiftsList = array();
                            $shiftsList = $stmt->fetchAll();
                            
                                echo'<form id="eventCreator" action="edit-eventPg2.php?shifts=',count($shiftsList),'" method="post">
                                    <table style="width=100%;" class = "listing">
                                        <tr>
                                        <input name = "eventID" type = "hidden" value = "',$thisEventID,'">
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
                                    ';
                                    
                                    for($i = 0; $i<count($shiftsList);$i++){

                                        $sql = "SELECT * FROM shifts WHERE ShiftID=:shiftID";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute(['shiftID' => $shiftsList[$i][1]]);
                                        $shiftData = array();
                                        $shiftData = $stmt->fetchAll();
                                        // Displaying the data for each shift

                                        if(count($shiftData)>0){

                                        echo    
                                        
                                                '<tr><td colspan=2><hr style="font-size:20px;"><hr style="font-size:20px;"></td></tr>
                                                <tr><td colspan=2><div class="toggleWrapper">
                                                <input type="button" style="width: 100%; height: 30px; background-color: #005da3; color: white;cursor:pointer;" value="Open/Close Shift #',($i+1),'" class="shiftButton"></input>
                                                <div class="toggleInner"><table>
                                                <tr><td>Shift ',($i+1),'</td><td><input name = "removeShift[',$i,']" value = "Delete" class = "classicColor" type = "submit" onclick="return confirm(\'Are you sure?\')" style = "cursor:pointer;margin-right: 0px; background-color:red"></td></tr>
                                                <tr><td colspan=2><hr style="font-size:20px;"></td></tr>
                                                <tr>
                                                    <td><label>Shift Date :<span>*</span></label></td>
                                                    <td><input name="date[',$i,']" type="date" value="',$shiftData[0][1],'" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Start Time :<span>*</span></label></td>
                                                    <td><input name="starttime[',$i,']" value="',$shiftData[0][2],'" type="time" placeholder="eg: 8:00 AM" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label>End Time :<span>*</span></label></td>
                                                    <td><input name="endtime[',$i,']" value="',$shiftData[0][3],'" type="time" placeholder="eg: 5:00 PM" required></td>
                                                </tr>
                                                <tr><td colspan=2>Positions<input type="hidden" value="',$shiftData[0][0],'" name="shiftID[',$i,']"></td></tr>
                                                ';

                                                $sql = "SELECT * FROM positions WHERE ShiftID=:shiftID";
                                                $stmt = $pdo->prepare($sql);
                                                $stmt->execute(['shiftID' => $shiftsList[$i][1]]);
                                                $positionList = array();
                                                $positionList = $stmt->fetchAll();
                                                for($g = 0; $g<count($positionList);$g++){

                                                    $sql = "SELECT * FROM positions WHERE PositionID=:positionID";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute(['positionID' => $positionList[$g][0]]);
                                                    $positionData = array();
                                                    $positionData = $stmt->fetchAll();

                                                    // Getting a list of all Vice Presidents
                                                                            
                                                    $sql = "SELECT * FROM students WHERE NOT Position=:Av ORDER BY LastName Asc";
                                                    $stmt = $pdo->prepare($sql);
                                                    $stmt->execute(['Av'=>"Advisor"]);
                                                    $AvData = array();
                                                    $AvData = $stmt->fetchAll();

                                                    // Displaying the data for each shift
            
                                                    if(count($positionData)>0){
                                                        echo'<tr> <td><input type="hidden" name="positionID[',$i,'][',$g,']" value="',$positionData[0][0],'">
                                                        <input type="hidden" name="PA[',$i,']" value="',$shiftData[0][4],'">';
                                                    if($positionData[0][2]!=null){
                                                        $sql = "SELECT * FROM students WHERE StudentID=:studentID";
                                                        $stmt = $pdo->prepare($sql);
                                                        $stmt->execute(['studentID' => $positionData[0][2]]);
                                                        $sct = $stmt->fetch(PDO::FETCH_OBJ);
                                                        $studentemail = $sct->Email;
                        
                                                        // Displaying Position data
                        
                                                            echo 'Position ',($g+1),':  <select name = "PosStudents[', $i, '][',$g,']" form = "eventCreator">';
                                                            echo'<option value="NULL"> -- select an option -- </option>';
                                                            for($Av = 0; $Av<count($AvData); $Av++){
                                                                echo '<option ';
                                                                //set default value
                                                                if($AvData[$Av][3] === $studentemail){
                                                                    echo 'selected = "selected" ';
                                                                }
                                                                echo 'value = "', $AvData[$Av][0], '">', $AvData[$Av][1], ' ', $AvData[$Av][2], '</option>';
                                                            }
                                                            echo '</select>';

                                                        echo    
                                                    
                                                        '</td>
                                                            <td><input name = "remove[',$i,'][',$g,']" value = "Delete" class = "classicColor" type = "submit" style = "margin-right: 0px; background-color:red;cursor:pointer;"></td>
                                                        </tr>';}
                                                    else{
                                                    
                                                        
                                                        echo 'Position ',($g+1),':  <select name = "PosStudents[', $i, '][',$g,']" form = "eventCreator">';
                                                        echo'<option value="NULL" selected value> -- select an option -- </option>';
                                                        for($Av = 0; $Av<count($AvData); $Av++){
                                                            echo '<option ';                                                            
                                                            echo 'value = "', $AvData[$Av][0], '">', $AvData[$Av][1], ' ', $AvData[$Av][2], '</option>';
                                                        }
                                                        echo '</select>';
                                                      echo'      <td><input name = "remove[',$i,'][',$g,']" value = "Delete" class = "classicColor" type = "submit" onclick="return confirm(\'Are you sure?\')" style = "margin-right: 0px; background-color:red;cursor:pointer;"></td>
                                                        </tr>';}
                                                    
                                                }
                                            }
                                    }

                                    echo '<tr><td></td><td style = "text-align:center;"><input name="submit[',$i,']" type="submit" value="Add Position" style="cursor:pointer;" class = "classicColor"/></td></tr></table></div></div></td></tr>';
                                }

                                // Add shift

                                echo'<tr><td colspan=2><hr style="font-size:20px;"><hr style="font-size:20px;"></td></tr>
                                <tr><td colspan=2><div class="toggleWrapper">';
                
                                if($invalidshiftdate):
                                    echo'<input type="button" style="width: 100%; height: 30px; background-color: red; color: white;cursor:pointer;" value="Add New Shift" class="shiftButton"></input>
                                    <div class="toggleInner"><table>
                                    <tr><td colspan=2 style="color:red">Invalid Date</td></tr>
                                    <tr>
                                        <td><label>Shift Date :<span>*</span></label></td>';
                                        echo'<td><input name="newdate" type="date"  style="border: 1px solid;border-color: red;background: rgba(255,92,92,.3);" required> </td>';
                                        echo'</tr>
                                    
                                    <tr>
                                        <td><label>Start Time :<span>*</span></label></td>
                                        <td><input name="newstarttime" value="',$starttime[$i],'"type="time" placeholder="eg: 8:00 AM" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>End Time :<span>*</span></label></td>
                                        <td><input name="newendtime" value="',$endtime[$i],'" type="time" placeholder="eg: 5:00 PM" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Positions Available :<span>*</span></label></td>
                                        <td><input name="newpositionsavailable" value="',$positionsavailable[$i],'" maxlength="2" type="number" placeholder="eg: 5 postions" required></td>
                                    </tr>';
                                else:
                                    echo    
                                        
                                    '<input type="button" style="width: 100%; height: 30px; background-color: #005da3; color: white;cursor:pointer;" value="Add New Shift" class="shiftButton"></input>
                                    <div class="toggleInner"><table>
                                    <tr><td colspan=2><hr style="font-size:20px;"></td></tr>
                                    <tr>
                                        <td><label>Shift Date :<span>*</span></label></td>
                                        <td><input name="newdate" type="date" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Start Time :<span>*</span></label></td>
                                        <td><input name="newstarttime" type="time" placeholder="eg: 8:00 AM" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>End Time :<span>*</span></label></td>
                                        <td><input name="newendtime" type="time" placeholder="eg: 5:00 PM" required></td>
                                    </tr>
                                    <tr>
                                        <td><label>Positions Available :<span>*</span></label></td>
                                        <td><input name="newpositionsavailable" maxlength="2" type="number" placeholder="eg: 5 postions" required></td>
                                    </tr>';
                                endif;
                                echo'</table></div></div></td></tr>';

                                // Ending table and php inputed data

                                echo'<tr>
                                <td></td>
                                <td style = "text-align:center;"><input name="submit" style="cursor:pointer;" type="submit" value="Submit Changes" class = "classicColor"/></td>
                                </tr></table>';
                                ?>
                                </form>
                    </div>
                </div>
            </div>

        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>