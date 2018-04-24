<?php
    include 'loading.html'; // Display loading screen

    if(isset($_GET['filename'])){
        //double slash "\\" used to escape the \
        $path = '.\dbBackup\\'.$_GET['filename'];
        unlink($path);
    }
    header("Location: databaseBackups.php?formSubmitConfirm=true");
?>