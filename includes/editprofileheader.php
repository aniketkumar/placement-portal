<?php
    if(isset($_SESSION["name"])){
        $message = "<font color='#447fc8'>Update Profile</font>";
        $pc = 1;
        $name = $_SESSION["name"];
        $rollnum = $_SESSION["rollnum"];
        
        $details = getuserProfileDetails($rollnum);
        
        $name = check_input($details['name']);
        $birthDate = check_input($details['birthdate']);
        $sex = check_input($details['sex']);
        $alternateEmail = check_input($details['alternateEmail']);
        $currentsem = check_input($details['currentSemester']);
        $institute = check_input($details['institute']);
        $cgpa = check_input($details['cgpa']);
        $education = check_input($details['education']); 
        $technicalExp = check_input($details['technicalExperience']);
        $projects = check_input($details['projects']);
        $areaofint = check_input($details['areaOfIntrest']);
        
        if(isset($_POST['updateprofile'])){
            $name = check_input($_POST['name']);
            $birthDate = check_input($_POST['birthdate']);
            $sex = check_input($_POST['sex']); 
            $alternateEmail = check_input($_POST['alternateEmail']);
            $currentsem = check_input($_POST['currentsem']);
            $institute = check_input($_POST['institute']);
            $cgpa = check_input($_POST['cgpa']);
            $education = check_input($_POST['education']);
            $technicalExp = check_input($_POST['technicalExp']);
            $projects = check_input($_POST['projects']);
            $areaofint = check_input($_POST['areaofint']);
           
           updateUserProfile($rollnum,$name,$birthDate,$sex,$alternateEmail,$currentsem,$institute,$cgpa,$education,$technicalExp,$projects, $areaofint); 
       }    
    }
    else if(isset($_SESSION["rollnum"])){
        $message = "Complete your Profile to proceed";
        $pc = 0;
        $rollnum = $_SESSION["rollnum"];
        $name = "";
        $birthDate = "";
        $sex = ""; 
        $alternateEmail = "";
        $currentsem = "";
        $institute = "";
        $cgpa = "";
        $education = ""; 
        $technicalExp = "";
        $projects = "";
        $areaofint = "";
        
        if(isset($_POST['updateprofile'])){
            $name = check_input($_POST['name']);
            $birthDate = check_input($_POST['birthdate']);
            $sex = check_input($_POST['sex']); 
            $alternateEmail = check_input($_POST['alternateEmail']);
            $currentsem = check_input($_POST['currentsem']);
            $institute = check_input($_POST['institute']);
            $cgpa = check_input($_POST['cgpa']);
            $education = check_input($_POST['education']);
            $technicalExp = check_input($_POST['technicalExp']);
            $projects = check_input($_POST['projects']);
            $areaofint = check_input($_POST['areaofint']);
           
           saveUserProfile($rollnum,$name,$birthDate,$sex,$alternateEmail,$currentsem,$institute,$cgpa,$education,$technicalExp,$projects, $areaofint);
       }
    }
    else {
        header("Location:index.php");
        exit;
    }
    if(isset($_GET['message'])){
               $message = $_GET['message'];
                $message = "<font color='#447fc8'>".$message."</font>";
           }
?>