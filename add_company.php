<?php session_start(); ?>
<?php

    if(isset($_SESSION['Adminrollnum'])){
        $rollnum = $_SESSION['Adminrollnum'];
    }
    else {
        header("Location:index.php");
        exit;
    }
?>
<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>

<?php 
    
    $name = check_input($_POST['name']);
    $description = check_input($_POST['description']);
    $lastdate = check_input($_POST['lastdate']);
    $mincgpa = check_input($_POST['mincgpa']);
    $jobprofile = check_input($_POST['jobprofile']);
    $link = check_input($_POST['link']);


    $value = add_company($name,$description,$lastdate,$mincgpa,$jobprofile,$link,$rollnum);
    
    if($value == 1 ){
        
        if(ALLOW_MAIL == true){
            notify_user(MAIL_TO1,$name,$description,$lastdate,$mincgpa,$jobprofile,$link);
            notify_user(MAIL_TO2,$name,$description,$lastdate,$mincgpa,$jobprofile,$link);
        }
        
        $id = mysql_insert_id($dbh1);
        $value = admin_action_logger($rollnum,'add','company',$id);
        if ($value == 0) {
            echo mysql_error($dbh1);
        }

        header("Location:admin_dashboard.php?done");
        exit;
    }
    else {
        header("Location:admin_dashboard.php?error");
        exit;
    }
        


?>