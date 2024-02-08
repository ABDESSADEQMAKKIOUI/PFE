<?php
session_start();
// Connect to database
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'test';

$conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
if(strlen($_SESSION['name'])==0)
  { 
header('location:authentic.php');
}
else{
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Query the database to get course information
// Check if search term is set
// Get the search query from the form
if (isset($_GET['q'])) {
    // Sanitize the search query
    $q = mysqli_real_escape_string($conn, $_GET['q']);
 
    // Build the SQL query with a WHERE clause that matches the search query
    $sql = "SELECT * FROM formations WHERE nom LIKE '%$q%'  OR domain LIKE '%$q%'  ";
  // Execute the query
    $result = mysqli_query($conn, $sql);
 } else {
    // Build the SQL query without a WHERE clause to fetch all the results
    $sql = "SELECT * FROM formations ";
 
    // Execute the query
    $result = mysqli_query($conn, $sql);
    if ($result === false) {
     die(mysqli_error($conn)); // print the error message
 }
 $num_rows = mysqli_num_rows($result);
 }


?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>formations</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <link rel="stylesheet" href="css/font-awesome.min.css"/>
	         <link rel="stylesheet" href="css/owl.carousel.css"/>
            <link rel="stylesheet" href="css/style.css"/>
            <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />

   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <?php include_once('includes/sidebar.php');?>

            <div style="width:81%; float: right; position: relative;margin-right: 2%;">
            <div class="content">
         <!-- Page info -->
	
	<!-- Page info end -->
   
                    <form method="post" action="search-result.php" style="margin-top: -30px;">
                      <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
                        <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                            <div class="mb-4 mb-xl-0">
                                <div class="fs-3 fw-bold text-white">cherche formation</div>
                            </div>
                            <div class="ms-xl-4">
                                <div class="input-group mb-2">
                                    <input class="form-control" type="text" placeholder="Search Teacher by Name or Subject" aria-label="Email address..." aria-describedby="button-newsletter" name="searchinput" required style="width:350px;" />
                                    <button class="btn btn-outline-light" id="button-newsletter" type="submit">Search</button>
                                </div>
                            </div>
                        </div>
                    </aside>
                </form>
                <div class="row gx-5 justify-content-center">
                        <div class="col-lg-8 col-xl-6">
                            <div class="text-center">
                                <h2 class="fw-bolder">List formations</h2>
<hr color="red" />
                            </div>
                        </div>
                    </div>
				
<!-- course section -->
<section class="course-section spad pb-0" style="margin-top: -5%;">
	<div class="course-warp">                                    
		<div class="row course-items-area">

		<?php 
    // Display courses retrieved from the database
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
          
           
            
?>
            <div class="mix col-lg-3 col-md-4 col-sm-6 <?php echo $row['duree']; ?>">
                <div class="course-item">
                    <div class="course-thumb set-bg" data-setbg="../images/<?php  echo $row['nom'];?>.png" >
                    <a class="text-decoration-none link-dark stretched-link" href="formation detail.php?tid=<?php echo $row['id'] ;?>"></a>
                        <div class="price">Price: $<?php echo $row['prix']; ?></div>
                    </div>
                    <div class="course-info">
                        <div class="course-text">
                            <h5><?php echo $row['nom']; ?></h5>
                            <p><?php echo $row['description']; ?></p>
                            <div class="students">120 Students</div>
                        </div>
                        <div class="course-author">
                            <div class="ca-pic set-bg" data-setbg="img/authors/logo1.jpeg"></div>
                            <p><?php echo $row['nom']; ?>, <span><?php echo $row['date_f']; ?></span></p>
                        </div>
                    </div>
                </div>
            </div>
<?php 
        }
    } else {
        echo "No courses found.";
    }
?>

        </div>
        </div>
    </section>
</div>
</div>
</div>

      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
      <script src="js/jquery-3.2.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/mixitup.min.js"></script>
	<script src="js/circle-progress.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/main.js"></script>
   </body>
</html>
<?php } ?>