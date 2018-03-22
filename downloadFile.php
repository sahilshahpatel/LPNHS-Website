<?php
    if(isset($_GET['filename'])){
        $filename=$_GET['filename'];
        header("Content-type: application/octet-stream");
        header("Content-disposition: attachment;filename=$filename");
    }
?>