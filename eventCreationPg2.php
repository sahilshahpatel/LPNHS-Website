<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";

    if (empty($_POST['name'])
    || empty($_POST['startdate'])
    || empty($_POST['location'])
    || empty($_POST['enddate'])
    || empty($_POST['shifts'])){ header("Location: create-event.php");}
    foreach ($_POST as $key => $value) {
        $_SESSION['post'][$key] = $value;
    } 
    $shifts = $_POST['shifts'];
?>
<html>

<head>
    <!--jQuery-->
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
        table{
            width: 100%;
            font-family: Bookman, sans-serif;
            text-align: center;
        }
        table td{
            padding: 5px 0;
            margin: 0;
        }
        table tr:nth-child(even){
            background-color: #e8cfa4;
        }
        textarea, input {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
            resize: vertical;
            width: 50%;
            -moz-transition: none 0s ease 0s;
            line-height: 2em;
        }
    </style>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="headerJQuery.js"></script>
</head>

<!--Included via PHP-->
<header id = "header"><?php include "header.php"; ?></header>

<body>
    <!--Fixed Img in Background-->
    <img id = "fixedBGImg" src = "https://www.nhs.us/assets/images/nhs/NHS_header_logo.png">
    <div id = "footerPusher">
    <div id = "mainPanel" class = "classic panel">
        <p style = "text-align: center;">Create Event - Shifts</p>
        <div class="container">
        <div class="main">
            <span id="error">
    
            </span><?php
            echo '<form style="width:100%;" id="eventCreator" action="eventCreationPg3.php?shifts=',$shifts,'" method="post"><table style="width=100%;" class = "listing">';
                 for($i = 0; $i<$shifts;$i++){
                echo    
                
                        '<tr><td colspan=2><hr style="font-size:20px;"></td></tr>
                        <tr>
                            <td><label>Shift Date :<span>*</span></label></td>
                            <td><input name="date[',$i,']" type="date" placeholder="eg: 01/01/2018" required></td>
                        </tr>
                        <tr>
                            <td><label>Start Time :<span>*</span></label></td>
                            <td><input name="starttime[',$i,']" type="text" placeholder="eg: 8:00 AM" required></td>
                        </tr>
                        <tr>
                            <td><label>End Time :<span>*</span></label></td>
                            <td><input name="endtime[',$i,']" type="text" placeholder="eg: 5:00 PM" required></td>
                        </tr>
                        <tr>
                            <td><label>Positions Available :<span>*</span></label></td>
                            <td><input name="positionsavailable[',$i,']" maxlength="2" type="text" placeholder="eg: 5 postions" required></td>
                        </tr>';

                }?>
                <tr>
                <td></td>
                <td style="text-align:center;"><input type="submit" style="text-align=right;" value="Submit" class = "classicColor" /></td>
                </tr>
                </table>
            </form>
        </div>
    </div>        </div>
    </div>

</body>

<footer id = "footer"><?php include "footer.php"; ?></footer>
</html>