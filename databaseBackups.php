<!DOCTYPE HTML>
<?php
    session_start();
    require 'database.php';
    $vpAllowed = false;
    require "adminCheck.php";
?>
<html>
<meta name="HandheldFriendly" content="true" />
<meta name="MobileOptimized" content="320" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width, user-scalable=no" />
    <head>

        <title>LPNHS - Data Backups</title>
        
        <link rel="stylesheet" href="baseCSS.css">
        <link rel="icon" type="image/png" href="img/nhs_logo.png">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <style>
            table tr:nth-child(even){
                background-color: #e8cfa4;
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
    </head>
    
    <header id = "header"><?php include "header.php"; ?></header>

    <body>
        <div id = "footerPusher">

            <img id = "fixedBGImg" src = "img/NHS_logo.png"><!--Fixed image in background-->
            <div id = "backupsPanel" class = "classic panel">
                <p>Database Backups</p>
                <hr>
                <form method = "post" action = "">
                    <table id = "backupsTable" style = "width: 100%;">
                        <?php 
                            //scan backups directory to see how many backups there are (array_diff removes the batch files and dot directories, array_values resets indexes to 0)
                            //the . in front of \dbBackup specifies that it is a relative path
                            $backups = array_values(array_diff(scandir('.\dbBackup'), array('nhsDataBackup.bat', '.', '..')));

                            echo '<tr>
                                <th><p>Backup Name (format: nhs_data_yyyyddmm.sql)</p></th>
                                <th colspan = "3"><p>Available Functions</p></th>
                                </tr>';

                            if(count($backups)===0){
                                echo '<tr><td colspan = "4"><p>No backups found</p></td></tr>';
                            }

                            for($i = 0; $i<count($backups); $i++){
                                echo '<tr>';
                                echo '<td style = "width: 70%;"><p>', $backups[$i], '</p></td>';
                                //3 Options: download backup sql file, restore database from that backup, delete that backup
                                echo '<td style = "width: 10%; text-align: center;"><input type = "submit" name="download[', $i, ']" value = "Download" formaction="downloadFile.php?filename=', $backups[$i], '" class = "classicColor"></td>';
                                echo '<td style = "width: 10%; text-align: center;"><input type = "submit" name="download[', $i, ']" value = "Restore From" formaction="restoreDatabase.php?filename=', $backups[$i], '" onclick="return confirm(\'Are you sure you want to restore from this backup? This will delete any new data since the backup was created! This is a permanent procedure.\')" class = "classicColor"></td>';
                                echo '<td style = "width: 10%; text-align: center;"><input type = "submit" name="download[', $i, ']" value = "Delete" formaction="deleteBackup.php?filename=', $backups[$i], '" onclick="return confirm(\'Are you sure you want to delete this backup? This is a permanent procedure.\')" class = "classicColor" style = "background-color: red;"></td>';
                                echo '</tr>';
                            }
                        ?>
                    </table>
                </form>
            </div>

        </div>
    </body>

    <footer id = "footer"><?php include 'footer.php';?></footer>

</html>