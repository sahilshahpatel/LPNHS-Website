<?php
    if(isset($_GET['filename'])){
        
        $path = 'dbBackup\nhsDataRestoreFromBackup.bat';
        //open file to write ('.' specifies path is relative, \\ escapes the slash)
        $file = fopen('.\\'.$path, "w");

        $contents = 'cd C:\xampp\mysql\bin\n
        mysql -u root nhs_data < C:/xampp/htdocs/lpnhs/dbBackup/'.$_GET['filename'];

        fwrite($file, $contents);

        shell_exec('cd dbBackup');
        shell_exec('/c nhsDataRestoreFromBackup.bat')
    }
    header("Location: databaseBackups.php?formSubmitConfirmation=true");
?>