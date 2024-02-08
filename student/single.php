<?php
session_start();
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);

if(strlen($_SESSION['cid'])==0)
  { 
header('location:authentic.php');
}
else{
 
 // Check if the connection was successful
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
 
 // Prepare the SQL statement
 $sql = "SELECT * FROM formations where formation like $_SESSION['name_f'] ";
 
 // Execute the SQL statement
 $result = mysqli_query($conn, $sql);
 $row = mysqli_fetch_assoc($result);
 // Check if the query was successful
 if (!$result) {
     die("Query failed: " . mysqli_error($conn));
 }
 

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Pharmacy-Stocks-Management-System</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <link rel="stylesheet" href="css/bootstrap.min.css">
            <link rel="stylesheet" href="css/jquery-ui.css">
            <link rel="stylesheet" href="css/owl.carousel.min.css">
            <link rel="stylesheet" href="css/owl.theme.default.min.css">
            <link rel="stylesheet" href="css/owl.theme.default.min.css">
            <link rel="stylesheet" href="style1.css">
          
            <link rel="stylesheet" href="css/jquery.fancybox.min.css">
          
            <link rel="stylesheet" href="css/bootstrap-datepicker.css">
          
            <link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">
          
            <link rel="stylesheet" href="css/aos.css">
            <link href="css/jquery.mb.YTPlayer.min.css" media="all" rel="stylesheet" type="text/css">
          
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <?php
           include_once('includes/sidebar.php');?>
      <div style="width: 80%;margin-left:20%;">
  <div class="content">
    <div class="custom-breadcrumns border-bottom">
      <div class="container">
        <a href="index.html">Home</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <a href="courses.html">Courses</a>
        <span class="mx-3 icon-keyboard_arrow_right"></span>
        <span class="current"><?php echo $row['formation'] ; ?></span>
      </div>
    </div>

    <div class="site-section">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4">
                    <p>
                        <img src="images/course_5.jpg" alt="Image" class="img-fluid">
                    </p>
                </div>
                <div class="col-lg-5 ml-auto align-self-center">
                        <h2 class="section-title-underline mb-5">
                            <span>Course Details</span>
                        </h2>
                        
                        <p><strong class="text-black d-block"><?php echo $row['formateur'] ; ?>:</strong> Craig Daniel</p>
                        <p class="mb-5"><strong class="text-black d-block">Hours:</strong> 8:00 am &mdash; 9:30am</p>
                        <p><?php echo $row['description '] ; ?></p>
                        <p><?php echo $row['description '] ; ?></p>
    
                        <ul class="ul-check primary list-unstyled mb-5">
                            <li> domaine de formation :<?php echo $row['domain'] ; ?></li>
                            <li> le prix de formation : <?php echo $row['prix'] ; ?>  </li>
                            <li>formateur de formation : <?php echo $row['formateur'] ; ?></li>
                            <li>date de début formation :<?php echo $row['formateur'] ; ?></li>
                            <li>durée de formation : <?php echo $row['formateur'] ; ?></li>
                        </ul>

                        <p>
                            <a href="#" class="btn btn-primary rounded-0 btn-lg px-5">Enroll</a>
                        </p>
    
                    </div>
            </div>
        </div>
    </div>

  
    

      
      </div>
    </div>
    

  </div>
  <!-- .site-wrap -->

  <!-- loader -->
</div>
</div>
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/jquery-ui.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/jquery.countdown.min.js"></script>
  <script src="js/bootstrap-datepicker.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.fancybox.min.js"></script>
  <script src="js/jquery.sticky.js"></script>
  <script src="js/jquery.mb.YTPlayer.min.js"></script>




  <script src="js/main.js"></script>

</body>

</html>
<?php } ?>