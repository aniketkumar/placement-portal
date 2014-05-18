<?php session_start(); ?>
<?php

    if(isset($_SESSION['Adminrollnum'])){
        $rollnum = $_SESSION['Adminrollnum'];
        
            if( !(isset($_GET['name'])) ){
                header("Location:admin-login.php");
                exit;
            }
            else {
                $compname = $_GET['name'];
                $id = $_GET['id'];
            }
    }
    else
    {
        header("Location:admin-login.php");
        exit;
    }
?>

<?php require_once("includes/functions.php"); ?>
<?php require_once("includes/connection.php"); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Students-list</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.css" rel="stylesheet">
      <link href="css/style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
      
      
      
      <style>
        body {
            background-color:#eeeeee;
            background:#333 url(images/campus818901.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
            
        }

      </style>
      
  </head>
  <body>
    
    
        
        
      
      
        <header class="navbar navbar-fixed-top mydashboardpageheader">
            <div class="container">
                <p class="navbar-brand mdb-p-header">Hi <font color="#447fc8">Admin <?php echo $rollnum; ?></font></p>

                <button class="navbar-toggle" data-toggle="collapse" data-target=".mybuttonid" style="background-color:black;">
                    <span class="icon-bar" style="background-color:white;"></span>
                    <span class="icon-bar" style="background-color:white;"></span>
                    <span class="icon-bar" style="background-color:white;"></span>
                </button>

                 <div class="collapse navbar-collapse mybuttonid"> 
                    <ui class="nav navbar-nav navbar-right">
                        <li><a href="admin-dashboard.php" class="mdb-menutext">My Dashboard</a></li>
                         <li><a href="logout.php" class="mdb-menutext">Logout</a></li>
                    </ui>
                </div>
            </div>
        </header> 
      
      <!-- middle content -->
      <div class="container mdb-contentdiv">
          <div class="row">
              
              <div class="col-sm-8 " > <!-- start of companies div -->
                  <div class="mdb-company thumbnail">
                    <div class="mdb-heading">Students applied to <font color="#447fc8"><?php echo $compname; ?></font></div>
                      
                          <div class="row ST-mdb-select">
                                  <a href="admin-dashboard.php" class="btn btn-primary ST-a-add-btn">
                                      Back to Companies
                                  </a>
                            </div>
                          
                      
        <div class="row">

            <table id= "myTable" class="table table-striped tablesorter">
                <thead>
                    <tr>
                        <th><span class="glyphicon glyphicon-list gly-sort"></span></th>
                        <th>Name <span class="glyphicon glyphicon-sort gly-sort"></span></th>
                        <th>Roll num <span class="glyphicon glyphicon-sort gly-sort"></span></th>
                        <th>CGPA <span class="glyphicon glyphicon-sort gly-sort"></span></th>
                        <th>Institute <span class="glyphicon glyphicon-sort gly-sort"></span></th>
                    </tr>
                </thead>
                <tbody>
                    
                    <?php
                    $content = "Students Applied to ".$compname."\r\n\r\n";

                    $result = get_students_list($id);
                    
                    if(mysql_num_rows($result) > 0 ){
                        $i = 1;
                            while($array = mysql_fetch_array($result)) {
                                $rollnum = $array['rollnum'];
                                $name = $array['name'];
                                $institute = $array['institute'];
                                $cgpa = $array['cgpa'];
                                $list = '
                                <tr>
                                    <td>'.$i.'</td>
                                    <td><a href="studentprofile.php?rollnum='.$rollnum.'">'.$name.'</a></td>
                                    <td>'.$rollnum.'</td>
                                    <td>'.$cgpa.'</td>
                                    <td>'.$institute.'</td>
                                </tr> ';
                                echo $list;
                                $i++;
                                
                                $content .= "name : ".$name;
                                $content .= "\r\nRollnum : ".$rollnum;
                                $content .= "\r\nCGPA : ".$cgpa;
                                $content .= "\r\nInstitute : ".$institute;
                                $content .= "\r\n---------------------------\r\n\r\n";
                            }
                    }else {
                        echo '
                            <div class="ST-noStudentsdiv">No students</div>
                        ';
                        $content .= "No Students";
                        
                    }

                    ?>
                </tbody>

            </table>
            

        </div>
                      
                      
                      
                          
                            
                          
                          
                          
                          
                      
                          
                  </div>
              </div><!-- end of col-sm-8 means end of companies div -->
              
              
              <div class="col-sm-4 " > <!-- start of announcmnts div -->
                  <div class="mdb-students-list thumbnail">
                      <div class="mdb-heading"><font color="#447fc8">Download</font></div>
                      
                        <form action="downloadfile.php" method="post">
                            <input type="hidden" value="<?php echo $content; ?>" name="content">
                            <input type="hidden" value="<?php echo $compname; ?>" name="compname">
                          <button type="input"  class="btn btn-block btn-md btn-danger sl-custom-btn">
                              Download whole List <span class="glyphicon glyphicon-cloud-download gly-sort"> </span>
                          </button>
                      </form>
                      
                      
                          <a href="#" class="btn btn-block btn-md btn-success sl-custom-btn">
                              Download all CVs as RAR <span class="glyphicon glyphicon-cloud-download gly-sort"></span>
                          </a>
                  </div>
              </div> <!-- end of announcmnts div -->
                  
          </div><!-- end of middle content of whole page -->
      </div><!-- end of container -->

      
      
         
    
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>  
      <script type="text/javascript" src="js/jquery.tablesorter.min.js"></script>
      <script>
          
          $(document).ready(function(){
                $("#myTable").tablesorter();
            //  $("#myTable").tablesorter( {sortList: [[0,0], [1,0]]} ); 
          });
          
      </script>
    
    
  </body>
</html>