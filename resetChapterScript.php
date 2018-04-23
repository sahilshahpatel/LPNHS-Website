<?php
    session_start();
    require 'database.php';
    require 'adminCheck.php';
    
    // Random string generator for passwords
    function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
    {
        $keyspace = str_shuffle($keyspace);
        $pieces = [];
        $max = mb_strlen($keyspace, '8bit') - 1;
        for ($i = 0; $i < $length; ++$i) {
            $pieces []= $keyspace[random_int(0, $max)];
        }
        return implode('', $pieces);
    }

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
        $sql = "";
        if (($handle = fopen("data/studentInfoCSV.csv", "r")) !== FALSE) {
            $iteration = 0;
            $columnTitles = array();
            // Creates Query
            while (($data = fgetcsv($handle, ",")) !== FALSE) {
                if($iteration!==0){ //Doesn't read the first line (which contains the column headings)
                    //append student data to query
                    $num = count($data);
                    $sql.="(";
                    for ($i=0; $i < $num; $i++) {
                        $sql.=$data[$i];
                        $sql.=", ";
                    }
                    $sql.=random_str(10)."), ";
                }
                else{
                    $columnTitles = $data;
                }
                $iteration++;
            }
            //Identifies order of information in the CSV file
            $sqlColumns = "";
            //List of acceptable names for each field (in lower case)
            $studentIDColumnNames = array("student id", "id", "studentid");
            $firstNameColumnNames = array("first name", "firstname", "first");
            $lastNameColumnNames = array("last name", "lastname", "last");
            $emailColumnNames = array("email", "email address", "emailaddress");
            for($i = 0; $i<count($columnTitles); $i++){
                if(in_array(trim(strtolower($columnTitles[$i])), $studentIDColumnNames)){
                    $sqlColumns.="StudentID, ";
                }
                else if(in_array(trim(strtolower($columnTitles[$i])), $firstNameColumnNames)){
                    $sqlColumns.="FirstName, ";
                }
                else if(in_array(trim(strtolower($columnTitles[$i])), $lastNameColumnNames)){
                    $sqlColumns.="LastName, ";
                }
                else if(in_array(trim(strtolower($columnTitles[$i])), $emailColumnNames)){
                    $sqlColumns.="Email, ";
                }
            }
            $sqlColumns.="PasswordHash"; 
            $sql = "INSERT INTO students (".$sqlColumns.") VALUES ".$sql;
            $sql = substr($sql, 0, -2); //Gets rid of last ', ' from $sql
            fclose($handle);
        }
        echo $sql;
    }
?>