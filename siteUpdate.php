<?php

    session_start();
    include "database.php";
    include "adminCheck.php";

    // Checks input from previous fields, and then updates the corresponding data

        if(isset($_POST['alert']))
        {
            $sql = "UPDATE sitecontent SET attention=:alert WHERE ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["alert" => $_POST['alert'],"id" => 1]);
        }
        if(!empty($_POST['aboutUsText']))
        {
            $sql = "UPDATE sitecontent SET aboutUs=:aboutUs WHERE ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["aboutUs" => $_POST['aboutUsText'],"id" => 1]);
        }
        if(!empty($_POST['whatItTakes']))
        {
            $sql = "UPDATE sitecontent SET whatItTakes=:whatItTakes WHERE ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["whatItTakes" => $_POST['whatItTakes'],"id" => 1]);
        }
        if(!empty($_POST['whatItTakesUnder']))
        {
            $sql = "UPDATE sitecontent SET whatItTakes2=:whatItTakesUnder WHERE ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["whatItTakesUnder" => $_POST['whatItTakesUnder'],"id" => 1]);
        }
        if(!empty($_POST['frontImgCaption']))
        {
            $sql = "UPDATE sitecontent SET frontImgCaption=:frontImgCaption WHERE ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["frontImgCaption" => $_POST['frontImgCaption'],"id" => 1]);
        }
        if(!empty($_POST["largo"])){
            $appreqs = "";
            for($i = 1; $i<=$_POST["largo"];$i++){
                if(!empty($_POST["appreqT"][$i]) || !empty($_POST["appreqTA"][$i])){$appreqs.= $_POST["appreqT"][$i]."&".$_POST["appreqTA"][$i]."^";}
            }
            $sql = "UPDATE sitecontent SET appReqs=:AR WHERE ID=:id";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(["AR" => $appreqs,"id" => 1]);
        }
        if(!file_exists($_FILES['frontImg']['tmp_name']) || !is_uploaded_file($_FILES['frontImg']['tmp_name'])){
            $errors= array();
            $file_name = $_FILES['frontImg']['name'];
            $file_size =$_FILES['frontImg']['size'];
            $file_tmp =$_FILES['frontImg']['tmp_name'];
            $file_type=$_FILES['frontImg']['type'];
            $split = explode('.', $_FILES['frontImg']['name']);
            $file_ext=strtolower(end($split));
            
            $extensions= array("jpg");
            
            if(in_array($file_ext,$extensions)=== false){
               $errors[]="Extension not allowed, please ensure the file is a .jpg (.jpeg is not allowed).";
            }
            
            if($file_size > 2097152){
               $errors[]='File size must be less than 2 MB';
            }
            
            if(empty($errors)==true){
               move_uploaded_file($file_tmp, "img/frontImg.jpg");
               echo "Success";
            }else{
                print_r($errors);
            }
        }
        if(!file_exists($_FILES['frontImg']['tmp_name']) || !is_uploaded_file($_FILES['frontImg']['tmp_name'])){
            $errors= array();
            $file_name = $_FILES['what_it_takes']['name'];
            $file_size =$_FILES['what_it_takes']['size'];
            $file_tmp =$_FILES['what_it_takes']['tmp_name'];
            $file_type=$_FILES['what_it_takes']['type'];
            $split = explode('.', $_FILES['what_it_takes']['name']);
            $file_ext=strtolower(end($split));

            $extensions= array("jpg");
            
            if(in_array($file_ext,$extensions)=== false){
               $errors[]="Extension not allowed, please ensure the file is a .jpg (.jpeg is not allowed).";
            }
            
            if($file_size > 2097152){
               $errors[]='File size must be less than 2 MB';
            }
            
            if(empty($errors)==true){
               move_uploaded_file($file_tmp, "img/what_it_takes.jpg");
               echo "Success";
            }else{
               print_r($errors);
            }
        }
        

    // Sets cookie for "formSubmitConfirm" and reroutes user to "manage-site-content.php"

        header("Location: manage-site-content.php?formSubmitConfirm=true");
    
?>