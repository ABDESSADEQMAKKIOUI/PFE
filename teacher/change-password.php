<?php
session_start();
//error_reporting(0);
include('../includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['name']==0)) {
  header('location:logout.php');
  } else{
if(isset($_POST['submit']))
{
$tid=$_SESSION['cid'];
$cpassword=md5($_POST['currentpassword']);
$newpassword=md5($_POST['newpassword']);
$sql ="SELECT id FROM formateur WHERE id=:tid and password=:cpassword";
$query= $dbh -> prepare($sql);
$query-> bindParam(':tid', $tid, PDO::PARAM_STR);
$query-> bindParam(':cpassword', $cpassword, PDO::PARAM_STR);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);

if($query -> rowCount() > 0)
{
$con="update formateur set password=:newpassword where id=:tid";
$chngpwd1 = $dbh->prepare($con);
$chngpwd1-> bindParam(':tid', $tid, PDO::PARAM_STR);
$chngpwd1-> bindParam(':newpassword', $newpassword, PDO::PARAM_STR);
$chngpwd1->execute();

echo '<script>alert("Your password successully changed")</script>';
echo "<script>window.location.href='change-password.php'</script>";
} else {
echo '<script>alert("Your current password is wrong")</script>';
echo "<script>window.location.href='change-password.php'</script>";

}



}

  
  ?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    
    <title>CCMS Change Password</title>
    
    <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <!-- DataTables -->
      <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="../asset/tables/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="../asset/tables/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="apple-touch-icon" href="apple-icon.png">
  

    <link rel="stylesheet" href="../assets/css/style.css">

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>

<script type="text/javascript">
function checkpass()
{
if(document.changepassword.newpassword.value!=document.changepassword.confirmpassword.value)
{
alert('New Password and Confirm Password field does not match');
document.changepassword.confirmpassword.focus();
return false;
}
return true;
}   

</script>

</head>

<body>
    <!-- Left Panel -->

    <?php include_once('includes/sidebar.php');?>

    <div  style="margin-left: 20%; width: 80%;">

        <!-- Header-->
        <?php include_once('includes/header.php');?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title" >
                        <h1 style="color: red;">Change mot de pass</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8" style="float: right;">
                <div class="page-header float-right">
                    <div class="page-title">
                        <ol class="breadcrumb text-right">
                            <li><a href="dashboard.php">Dashboard</a></li>
                            <li><a href="change-password.php">Change mot de pass</a></li>
                            <li class="active">Change</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row" style=" width:100%;">
                    <div class="col-lg-6">
                       <!-- .card -->

                    </div>
                    <!--/.col-->

                    <div class="col-lg-12" style="margin-top: 5%; width:100%;">
                        <div class="card"style=" width:100%;">
                            <div class="card-header"><strong>Change</strong><small> Password</small></div>
                 
                            <form name="changepassword" method="post" onsubmit="return checkpass();" action=""class="col-lg-12">
                                
                            <div class="card-body card-block">
 
                                <div class="form-group"><label for="company" class=" form-control-label">Current Password</label><input type="password" name="currentpassword" id="currentpassword" class="form-control" required=""></div>
                                    <div class="form-group"><label for="vat" class=" form-control-label">New Password</label><input type="password" name="newpassword"  class="form-control" required=""></div>
                                        <div class="form-group"><label for="street" class=" form-control-label">Confirm Password</label><input type="password" name="confirmpassword" id="confirmpassword" value=""  class="form-control"></div>
                                                                                                
                                                    </div>
                                                   
                                                    <p style="text-align: center;"><button type="submit" class="btn btn-primary btn-sm" name="submit" id="submit">
                                                            <i class="fa fa-dot-circle-o"></i> Change
                                                        </button></p>
                                                     
                                                </div>
                                                </form>
                                            </div>



                                           
                                            </div>
                                        </div><!-- .animated -->
                                    </div><!-- .content -->
                                </div><!-- /#right-panel -->
                                <!-- Right Panel -->


                                <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
</body>
</html>
<?php }  ?>