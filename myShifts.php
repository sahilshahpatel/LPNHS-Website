<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "loginCheck.php";
?>
<html>
    <head>
    
        <title>LPNHS - My Shifts</title>
        
        <link rel="stylesheet" href="baseCSS.css">
        <style>
            #shiftsPanel{padding: 0;}
            table tr:nth-child(even){background-color: #e8cfa4;}
            #shiftsPanel div{
                border-top-left-radius: 15px;
                border-top-right-radius: 15px;
            }
            #informationContainer{padding: 10px;}
            #informationContainer form table{width: 100%;}
            #informationContainer form table th, td{
                padding: 5px;
                font-family: Bookman, sans-serif;
                font-size: 18px;
                text-align: center;
            }
        </style>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
    </head>
        
    <header id = "header"><?php include "header.php"; ?></header>

    <body>
        <div id = "footerPusher">

        <img id = "fixedBGImg" src = "img/NHS_logo.png"><!--Fixed Image in Background-->

            <div id = "shiftsPanel" class = "classic panel">
                <div id = "informationContainer">
                    <!--Content loaded throuhg PHP-->
                    <form id = "requestShiftCoverForm" method = "post" action = "requestShiftCover.php">
                        <table id = "shiftsTable">
                            <?php
                                $i=0;
                                while(!isset($_POST['myShifts'][$i])){
                                    $i++;
                                }

                                $sql = "SELECT * FROM eventshift WHERE EventID=:eventID";
                                $stmt = $pdo->prepare($sql);
                                $stmt->execute(['eventID'=>$_POST['eventID'][$i]]);
                                $shiftsList = array();
                                $shiftsList = $stmt->fetchAll();

                                echo '<tr>
                                    <th>Date</th>
                                    <th>Time</th>
                                    <th>Select Coverer</th>
                                    <th><th>
                                    </tr>';

                                echo '<p>', $_POST['eventName'][$i], '</p>';
                                for($s = 0; $s<count($shiftsList); $s++){
                                    // Pulling from "shifts" database the data for each shift

                                    $sql = "SELECT * FROM shifts WHERE ShiftID=:shiftID";
                                    $stmt = $pdo->prepare($sql);
                                    $stmt->execute(['shiftID' => $shiftsList[$s][1]]);
                                    $shiftData = array();
                                    $shiftData = $stmt->fetchAll();

                                    // Displaying the data for each shift

                                    if(count($shiftData)>0){
                                        $formatted_startTime = date('g:i A', strtotime($shiftData[0][2]));
                                        $formatted_endTime = date('g:i A', strtotime($shiftData[0][3]));
                                        $formatted_date = date('m/d/Y', strtotime($shiftData[0][1]));
                                        
                                        $sql = "SELECT * FROM positions WHERE ShiftID=:shiftID AND StudentID=:studentID";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute(['shiftID' => $shiftsList[$s][1], 'studentID'=>$_SESSION['StudentID']]);
                                        $count = $stmt->rowCount();

                                        for($p = 0; $p<$count; $p++){
                                            echo '<tr>';

                                            // Hidden form info to be passed
                                            echo '<input type = "hidden" name = "shiftID[', $s,'][', $p, ']" value = "', $shiftData[0][0], '">';
    
                                            echo '<td>', $formatted_date, '</td>';
                                            echo '<td>', $formatted_startTime, ' to ', $formatted_endTime, '</td>';

                                            //List of all students (pick who to cover for you)
                                            $sql = "SELECT * FROM students WHERE NOT Position = :position";
                                            $stmt = $pdo->prepare($sql);
                                            $stmt->execute(['position'=>'Advisor']);
                                            $studentList = array();
                                            $studentList = $stmt->fetchAll();


                                            //Select tag used instead of datalist b/c datalists cannot be prevented from showing the "value" attribute bigger than the inside text, which is important here
                                            //If datalist ever supports this, it would be much nicer b/c of it's searchability.
                                            echo '<td><select name = "covererID[', $s, '][', $p, ']" form = "requestShiftCoverForm" required = "true">';
                                            echo '<option value = "">---</option>';
                                            for($studentCounter = 0; $studentCounter<count($studentList); $studentCounter++){
                                                if($studentList[$studentCounter][0]!==$_SESSION['StudentID']){
                                                    echo '<option value = "', $studentList[$studentCounter][0], '">', $studentList[$studentCounter][1], ' ', $studentList[$studentCounter][2], '</option>';
                                                }
                                            }
                                            echo '</select></td>';
                                            echo '<td><input type = "submit" name = "submit[', $s, '][', $p, ']" value = "Request Shift Cover" class = "classicColor"></td>';
                                            echo '</tr>';
                                        }
                                    }
                                }
                            ?>
                        </table>
                    </form>
                </div>
            </div>
            
        </div>
    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>