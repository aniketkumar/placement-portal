<?php session_start(); ?>
<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<?php

    if(isset($_SESSION["Adminrollnum"])){
        $rollnum = $_SESSION['Adminrollnum'];
    }
    else {
        header("Location:index.php");
        exit;
    }
?>

<?php 
    $comid = $_POST['id'];

    $query = "UPDATE companies SET isDeleted = 1 WHERE id = '{$comid}'";
    $result = mysql_query($query);
    if($result){
        echo 'done';
    }
?>