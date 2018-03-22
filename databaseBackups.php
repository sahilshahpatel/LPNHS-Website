<!DOCTYPE HTML>
<?php
    require 'database.php';
    //require 'adminCheck.php';
?>
<html>
    <head>

        <title>LPNHS - Data Backups</title>
        
        <link rel="stylesheet" href="baseCSS.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="headerJQuery.js"></script>
        <style>
            table tr:nth-child(even){
                background-color: #e8cfa4;
            }
        </style>
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
                            //scan backups directory to see how many backups there are (two extra files are always returned "." and "..". Array_slice removes these)
                            //the . in front of \dbBackup specifies that it is a relative path
                            $backups = array_slice(scandir('.\dbBackup'), 2);

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