<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "loginCheck.php";
    
?>
<html>
    <head>

        <title>LPNHS - My Profile</title>
        
        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">
        <style>
            #ProfileDataDiv p{
                text-align: left;
                display: inline-block;
            }
            #ProfileDataDiv input{text-align: center;}
            #ProfileDataDiv button{margin: 10px;}
            div.dashboardButton{
                text-align: center;
                margin: 30px 10%;
                border: 3px solid white;
                border-radius: 10px;
                cursor: pointer;
                /* Adjust Text */
                font-size: 28px;
                align-items: center;
                justify-content: center;
                
                /* Color */
                background-color: white;
                color: #005da3;
            }
            div.dashboardButton:hover {
                background-color: transparent;
                border-color: white;
                color: white;
            }
            div.dashboardButton p{margin: 5px;}
            #eventsPanel{padding: 0;}
            table tr:nth-child(even){background-color: #e8cfa4;}
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
            table{width: 100%;}
            th, td{
                font-family: Bookman, sans-serif;
                font-size: 18px;
                text-align: center;
            }
            #informationContainer div table th, td{width: 33.33%;}
        </style>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <script>
            $(document).ready(function(){
                $("#myProfileLink").addClass("active");

                $("#adminDashboardButton").click(function(){
                    window.location.href = "admin-dashboard.php";
                });
            });
        </script>
    </head>

    <header id = "header"><?php include "header.php"; ?></header>
        
    <body> 
        <div id = "footerPusher">

        <img id = "fixedBGImg" src = "img/NHS_logo.png"><!--Fixed Image in Background-->

            <!--Include Admin Dashboard link-->
            <?php 

                // Pulling data from "students" for current user

                    $sql = "SELECT * FROM students WHERE StudentID=:studentID";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(["studentID" => $_SESSION["StudentID"]]);
                    $data = $stmt->fetch(PDO::FETCH_OBJ);


                // If users "Position" : admin -> admin dashboard
                
                    if($data->Position!=="Student"):
                        echo '<div id = "adminDashboardButton" class = "dashboardButton">
                            <p>Admin Dashboard</p>
                            </div>';
                    endif;
            ?>

            <div class = "classic panel">
                <p>My Information</p>
                <!--View only data-->
                <table id = "profileDataTable">
                    <tr>
                        <th>Name</th>
                        <th>Hours Volunteered</th>
                        <th>Vice President</th>
                    </tr>
                    <tr>
                        <td><?php echo $data->FirstName, ' ', $data->LastName;?></td>
                        <?php if($data->HoursCompleted>25){echo '<td style="background-color: #90EE90;"><a style="color: #137B13">',$data->HoursCompleted,'</a></td>';}
                        else{echo '<td>',$data->HoursCompleted,'</td>';}?>
                        <td>
                            <?php 
                                $sql = "SELECT * FROM students WHERE StudentID=:studentID";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(['studentID'=>($data->VicePresident)]);
                                $vpData = $stmt->fetch(PDO::FETCH_OBJ);
                                echo $vpData->FirstName, ' ', $vpData->LastName;
                            ?>
                        </td>
                    </tr>
                </table>
            </div>
            
            <!--Shift Cover requests-->
            <div class = "classic panel">
                <div id = "shiftCoverRequests">
                    <form method = "post" action = "acceptCoverShifts.php">
                        <p style = "margin-bottom: 0;">Accept/Deny Shift Covers</p>
                        <p style = "font-size: 12px; font-style: italic; margin-top: 0;">Shift covers must be accepted by the president before going into effect</p>
                        <table id = "shiftCoverRequestsTable">
                            <?php
                                $sql = "SELECT * FROM shiftcovers WHERE CovererID = :covererID AND Agreed=0";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(['covererID'=>$_SESSION['StudentID']]);
                                $count = $stmt->rowCount();
                                $data = $stmt->fetch(PDO::FETCH_OBJ);
                                
                                echo '<tr>
                                    <th>From</th>
                                    <th>Event Name</th>
                                    <th>Shift Date</th>
                                    <th>Shift Time</th>
                                    <th>Accept</th>
                                    </tr>';

                                if($count===0){
                                    echo '<tr><td colspan = "5"><p>No shift cover requests found</p></td></tr>';
                                }
                                
                                for($i=0; $i<$count; $i++){
                                    //Find Event Name
                                    $sql = "SELECT * FROM eventshift WHERE ShiftID=:shiftID";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(['shiftID'=>$data->ShiftID]);
                                    $event = $stmt->fetch(PDO::FETCH_OBJ);

                                    $sql = "SELECT * FROM events WHERE EventID=:eventID";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(['eventID'=>$event->EventID]);
                                    $eventData = $stmt->fetch(PDO::FETCH_OBJ);

                                    //Find Requester Name
                                    $sql = "SELECT * FROM students WHERE StudentID=:studentID";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(['studentID'=>$data->RequesterID]);
                                    $requesterData = $stmt->fetch(PDO::FETCH_OBJ);

                                    //Find Shift Data
                                    $sql = "SELECT * FROM shifts WHERE ShiftID=:shiftID";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(['shiftID'=>$data->ShiftID]);
                                    $shiftData = $stmt->fetch(PDO::FETCH_OBJ);

                                    echo '<tr>';

                                    //Send hidden data to be used in coverShift.php
                                    echo '<input type = "hidden" name = "requesterID[',$i,']" value = "', $data->RequesterID, '">';
                                    echo '<input type = "hidden" name = "covererID" value = "', $data->CovererID, '">';
                                    echo '<input type = "hidden" name = "shiftID[',$i,']" value = "', $data->ShiftID, '">';

                                    echo '<td>', $requesterData->FirstName, ' ', $requesterData->LastName, '</td>';
                                    echo '<td>', $eventData->Name, '</td>';
                                    echo '<td>', date('m/d/Y', strtotime($shiftData->Date)), '</td>';
                                    echo '<td>', $shiftData->StartTime, ' to ', $shiftData->EndTime, '</td>';
                                    echo '<td><input name = "submit[', $i,']" type = "image" src = "img/greenCheckMark.png" height = "30px" width = "30px" style = "margin-top: 5px;"></td>';
                                    echo '</tr>';
                                }
                            ?>
                        </table>
                    </form>
                </div>
            </div>

            <div id = "eventsPanel" class = "classic panel">
                <div id = "informationContainer">
                    <p>My Event History</p>
                    <div id = "eventHistory">
                        <table id = "eventHistoryTable">
                            <tr>
                                <th>Event Name</th>
                                <th>Date</th>
                                <th>Location</th>
                            </tr>
                            <!--Load data-->                    
                            <script>
                                $(document).ready(function(){
                                    $("#eventHistoryTable").load("myEventsGetter.php?history=true");
                                });
                            </script>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </body>
        
    <footer id = "footer"><?php include 'footer.php';?></footer>

</html>