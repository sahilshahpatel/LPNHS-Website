<?php
    session_start();
    require "database.php";
    //redirect if no shift is specified
    if(!isset($_GET['eventID']) || !isset($_GET['shiftID'])){
        header("location: events.php");
    }
?>
<!DOCTYPE HTML>
<html>
    <head>

        <title>LPNHS - Rosters</title>
        
        <link rel="stylesheet" href="baseCSS.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
    </head>

    <header id = "header"><?php include "header.php"; ?></header>

    <body>
        
        <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png"><!--Fixed Image in Background-->
        
        <div id = "footerPusher">
            <div class = "classic panel">
                <!--Event and Shift Data-->
                <?php
                    $sql = "SELECT * FROM events WHERE EventID= :eventID";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['eventID'=>$_GET['eventID']]);
                    $eventData = array();
                    $eventData = $stmt->fetchAll();

                    echo '<p>', $eventData[0][1], '</p>'; //event name
                    
                    //shift data
                    $sql = "SELECT * FROM shifts WHERE ShiftID=:shiftID";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute(['shiftID' => $_GET['shiftID']]);
                    $shiftData = array();
                    $shiftData = $stmt->fetchAll();
                    $formatted_startTime = date('g:i A', strtotime($shiftData[0][2]));
                    $formatted_endTime = date('g:i A', strtotime($shiftData[0][3]));
                    $formatted_date = date('m/d/Y', strtotime($shiftData[0][1]));

                    // Displaying the data for each shift
                    echo '<tr>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Request Shift</th>
                        </tr>';
                    
                    if(count($shiftData)>0){
                        echo '<tr>';

                        // Hidden form info to be passed
                            echo '<input type = "hidden" name = "eventID" value = "', $eventIDs[0][$i], '">';
                            echo '<input type = "hidden" name = "shiftID" value = "', $shiftData[0][0], '">';

                        echo '<td>', $formatted_date, '</td>';
                        echo '<td>', $formatted_startTime, ' to ', $formatted_endTime, '</td>';
                        echo '<td><input type = "submit" name = "submit" value = "Volunteer!" class = "classicColor"></td>';
                        echo '</tr>';
                    }
                ?>

                <form method = "post" action = "requestShift.php">
                    <table id = "rosterTable">
                        <!--Fill in table with roster data-->
                        <?php
                            $sql = "SELECT * FROM positions WHERE ShiftID = :shiftID";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute(['shiftID'=>$_GET['shiftID']]);

                            $positionData = array();
                            $positionData = $stmt->fetchAll();

                            for($i = 0; $i<count($positionData); $i++){
                                echo '<tr>';
                                if($positionData[$i][2]!==null){
                                    $sql = "SELECT * FROM students WHERE StudentID= :studentID";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(['studentID'=>$positionData[$i][2]]);
                                    $studentData = array();
                                    $studentData = $stmt->fetchAll();
                                    echo '<td>', $studentData[0][1], ' ', $studentData[0][2],'</td>';
                                }
                                else{
                                    echo '<td><input type = "submit" name = "submit" value = "Volunteer!" class = "classicColor"></td>';
                                }
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </form>
            </div>
        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>