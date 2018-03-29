<!DOCTYPE HTML>
<?php 
    session_start();
    include "database.php";
    include "adminCheck.php";

    // Checking if previous fields were all filled and then storing information into SESSION

        $invalidshiftdate=false;
        if(isset($_GET['date'])){$invalidshiftdate = true;}
        else if (empty($_POST['name'])
        || empty($_POST['startdate'])
        || empty($_POST['location'])
        || empty($_POST['enddate'])
        || empty($_POST['shifts'])){ header("Location: create-event.php");}
        foreach ($_POST as $key => $value) {
            $_SESSION['post'][$key] = $value;
        } 
        
    if($invalidshiftdate){extract($_SESSION['post']);}
    else if($_POST['startdate']>$_POST['enddate']){header("Location: create-event.php?date=invalid");}
    else{$shifts = $_POST['shifts'];}


    
?>
<html>

    <head>

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

        <img id = "fixedBGImg" src = "img/NHS_logo.png"> <!--Fixed image in background-->

        <div id = "footerPusher">
            <div id = "mainPanel" class = "classic panel">
                <?php if($invalidshiftdate):?><p style = "text-align: center;">Create Event - Shifts<span style="color:red;margin-left:10px;"> *A date you entered in was not within the date of the event</span></p>
                <?php else: ?><p style = "text-align: center;">Create Event - Shifts</p>
                <?php endif; ?>
                <div class="container">
                    <div class="main">
                        <!--Data to be put in through PHP-->
                        <?php
                            echo '           <form style="width:100%;" autocomplete="off" id="eventCreator" action="eventCreationPg3.php?shifts=',$shifts,'" method="post"><table style="width=100%;" class = "listing">';
                                
                            // Looping input fields for every shift in the event to add for both error and non error session

                                if($invalidshiftdate):
                                    for($i = 0; $i<$shifts;$i++){
                                        echo    
                                        
                                                '<tr><td colspan=2><hr style="font-size:20px;"></td></tr>
                                                <tr>
                                                    <td><label>Shift Date :<span>*</span></label></td>';
                                                    if($_SESSION['dateErrors'][$i]): echo'<td><input name="date[',$i,']" type="date"  style="border: 1px solid;border-color: red;background: rgba(255,92,92,.3);"  value="',$date[$i],'" placeholder="eg: 01/01/2018" required></td>';
                                                    else: echo'<td><input name="date[',$i,']" type="date" value="',$date[$i],'" placeholder="eg: 01/01/2018" required></td>';
                                                    endif;
                                                    echo'</tr>
                                                
                                                <tr>
                                                    <td><label>Start Time :<span>*</span></label></td>
                                                    <td><input name="starttime[',$i,']" value="',$starttime[$i],'"type="time" placeholder="eg: 8:00 AM" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label>End Time :<span>*</span></label></td>
                                                    <td><input name="endtime[',$i,']" value="',$endtime[$i],'" type="time" placeholder="eg: 5:00 PM" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Positions Available :<span>*</span></label></td>
                                                    <td><input name="positionsavailable[',$i,']" value="',$positionsavailable[$i],'" maxlength="2" type="number" placeholder="eg: 5 postions" required></td>
                                                </tr>';
                                    }
                                else:
                                    for($i = 0; $i<$shifts;$i++){
                                        echo    
                                        
                                                '<tr><td colspan=2><hr style="font-size:20px;"></td></tr>
                                                <tr>
                                                    <td><label>Shift Date :<span>*</span></label></td>
                                                    <td><input name="date[',$i,']" type="date" value="',$_POST['startdate'],'" placeholder="eg: 01/01/2018" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Start Time :<span>*</span></label></td>
                                                    <td><input name="starttime[',$i,']" type="time" placeholder="eg: 8:00 AM" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label>End Time :<span>*</span></label></td>
                                                    <td><input name="endtime[',$i,']" type="time" placeholder="eg: 5:00 PM" required></td>
                                                </tr>
                                                <tr>
                                                    <td><label>Positions Available :<span>*</span></label></td>
                                                    <td><input name="positionsavailable[',$i,']" maxlength="2" type="number" placeholder="eg: 5 postions" required></td>
                                                </tr>';
                                    }
                                endif;
                            echo'
                                            <tr>
                                            <td>';
                                            if($invalidshiftdate):echo'
                                                <input name="Sdate" type="hidden" value="',$startdate,'">
                                                <input name="Edate" type="hidden" value="',$enddate,'">';
                                            else:echo'
                                                <input name="Sdate" type="hidden" value="',$_POST['startdate'],'">
                                                <input name="Edate" type="hidden" value="',$_POST['enddate'],'">';
                                            endif;

                                            echo'</td>
                                            <td style="text-align:center;"><input type="submit" style="text-align=right;" value="Submit" class = "classicColor" /></td>
                                            </tr>
                                            </table>
                                            </form>';
                        ?>
                    </div>
                </div>        
            </div>
        </div>

    </body>

    <footer id = "footer"><?php include "footer.php"; ?></footer>

</html>