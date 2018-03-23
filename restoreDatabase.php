<?php
    if(isset($_GET['filename'])){
        
        $path = '.\dbBackup\nhsDataRestoreFromBackup.bat';
        //open file to write
        $file = fopen($path, "w");

        $contents = 'cd C:\xampp\mysql\bin\n
        mysql -u root nhs_data < C:/xampp/htdocs/lpnhs/dbBackup/'.$_GET['filename'];

        fwrite($file, $contents);

        //double slash "\\" used to escape the \
        //NOT SURE THIS WORKS YET!!!!!
        system('cmd /c '.$path);
    }
    header("Location: databaseBackups.php?formSubmitConfirmation=true");
?>