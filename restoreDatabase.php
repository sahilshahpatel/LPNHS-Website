<?php
    if(isset($_GET['filename'])){
        
        $commands = 'cd C:\xampp\mysql\bin && mysql -u root nhs_data < C:/xampp/htdocs/lpnhs/dbBackup/'.$_GET['filename'];

        shell_exec($commands);
    }
    header("Location: databaseBackups.php?formSubmitConfirm=true");
?>