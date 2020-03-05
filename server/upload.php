<?php 
require_once "../connect.php";

$file = "";

if(!empty($_FILES["file"]["name"])){
    foreach($_FILES["file"]["name"] as $key => $value){
        if(move_uploaded_file($_FILES["file"]["tmp_name"][$key], "../assets/upload/".$value)){
            $file .= "assets/upload/".$value.",";
        }
    }
    if(!empty($file)){
        
        if(mysqli_query($con, "UPDATE tb_work 
        SET w_path = '{$file}', w_datestatus=NOW(), w_datesubmit=NOW(), w_status='success' 
        WHERE w_id = '{$_POST['id']}' ")) echo "upload complete..";
        
        else echo "mysql insert data fail!";
        
    }else echo "upload fail"; 
    
}

