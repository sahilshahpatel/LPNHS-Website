<?php
    session_start();
    require 'database.php';
    require 'adminCheck.php';
    
    if(isset($_POST["submit"])){
        $errors= array();
        $file_name = $_FILES['studentInfoCSV']['name'];
        $file_size =$_FILES['studentInfoCSV']['size'];
        $file_tmp =$_FILES['studentInfoCSV']['tmp_name'];
        $file_type=$_FILES['studentInfoCSV']['type'];
        $split = explode('.', $_FILES['studentInfoCSV']['name']);
        $file_ext=strtolower(end($split));
        
        $extensions= array("csv");
        
        if(in_array($file_ext,$extensions)=== false){
            $errors[]="Extension not allowed, please ensure the file is a .csv.";
        }
        
        if($file_size > 2097152){
            $errors[]='File size must be less than 2 MB';
        }
        
        if(empty($errors)==true){
            move_uploaded_file($file_tmp, "data/studentInfoCSV.csv");
            echo "Success";
        }else{
            print_r($errors);
        }

        //Reset Chapter
        $sql = "INSERT INTO students (FirstName, LastName, Email) VALUES ";
        if (($handle = fopen("data/studentInfoCSV.csv", "r")) !== FALSE) {
            $iteration = 0;
            while (($data = fgetcsv($handle, ",")) !== FALSE) {
                if($iteration!==0){ //Doesn't read the first line (which contains the column headings)
                    $num = count($data);
                    $sql.="(";
                    for ($i=0; $i < $num; $i++) {
                        $sql.=$data[$i];
                        if($i!=$num-1){
                            $sql.=", ";
                        }
                    }
                    $sql.="), ";
                }
                $iteration++;
            }
            $sql = substr($sql, 0, -2); //Gets rid of last ', ' from $sql
            fclose($handle);
        }
        echo $sql;
    }
?>