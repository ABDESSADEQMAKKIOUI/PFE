<?php
session_start();
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(strlen($_SESSION['name'])==0)
  { 
header('location:authentic.php');
}
else{
// Calculate the additional amount
$sql = "SELECT SUM(prix) AS total FROM paiement";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$additional = $row['total'];


//select the nuber of student
$sq = "SELECT COUNT(*) FROM etudiant";
$resul = mysqli_query($conn, $sq);
if (!$resul) {
    die("Query failed: " . mysqli_error($conn));
}

$count = mysqli_fetch_array($resul)[0];


//select the number of groups
$sq1 = "SELECT COUNT(*) FROM class ";
$resu = mysqli_query($conn, $sq1);
if (!$resu) {
    die("Query failed: " . mysqli_error($conn));
}

$count1 = mysqli_fetch_array($resu)[0];


//select the number of teachers
$sq2 = "SELECT COUNT(*) FROM formateur";
$res = mysqli_query($conn, $sq2);
if (!$res) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch the result
$count2 = mysqli_fetch_array($res)[0];
//formations
$sq3 = "SELECT COUNT(*) FROM formations";
$res = mysqli_query($conn, $sq3);
if (!$res) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch the result
$count3 = mysqli_fetch_array($res)[0];
//reclamation
$sq4 = "SELECT COUNT(*) FROM reclamation";
$res = mysqli_query($conn, $sq4);
if (!$res) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch the result
$count4 = mysqli_fetch_array($res)[0];
//absences
$sq5 = "SELECT COUNT(*) FROM absence";
$res = mysqli_query($conn, $sq5);
if (!$res) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch the result
$count5 = mysqli_fetch_array($res)[0];
// prix ressource
$sq6 = "SELECT SUM(prix) FROM ressource";
$res = mysqli_query($conn, $sq6);
if (!$res) {
    die("Query failed: " . mysqli_error($conn));
}

// Fetch the result
$count6 = mysqli_fetch_array($res)[0];

//**************************** */
$s = "SELECT date_p, SUM(prix) AS total FROM paiement GROUP BY date_p";
$r = mysqli_query($conn, $s);

// Format payment data for use in the chart
$data = array();
while ($row = mysqli_fetch_assoc($r)) {
    $date = $row['date_p'];
    $total = floatval($row['total']);
    $data[] = array('date' => $date, 'total' => $total);
}

// Convert payment data to JSON format
$jsonData = json_encode($data);

$ql = "SELECT formation_id, COUNT(*) AS total FROM paiement GROUP BY formation_id ORDER BY total DESC LIMIT 3";
$esult = mysqli_query($conn, $ql);

// Create an array to store the data for the chart
$dat = array();
$dat[] = array('Formation_id', 'Total');

// Loop through the results and add them to the data array
while ($row = mysqli_fetch_assoc($esult)) {
    $dat[] = array($row['formation_id'], (int) $row['total']);
}
$dat_json = json_encode($dat);
// Close the database connection
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>dashbord</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <link href="css/sb-admin-2.min.css" rel="stylesheet">
                <!-- Include Google Charts library -->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
        // Load the Visualization API and the corechart package
        google.charts.load('current', {'packages':['corechart']});

        // Set a callback to run when the Google Visualization API is loaded
        google.charts.setOnLoadCallback(drawChart);

        // Draw the chart using the payment data
        function drawChart() {
            // Parse the payment data from the PHP script
            var jsonData = <?php echo $jsonData; ?>;

            // Create a new DataTable object
            var data = new google.visualization.DataTable();

            // Add columns to the DataTable object
            data.addColumn('string', 'Date');
            data.addColumn('number', 'Total');

            // Add rows to the DataTable object
            for (var i = 0; i < jsonData.length; i++) {
                var date = jsonData[i].date;
                var total = jsonData[i].total;
                data.addRow([date, total]);
            }

            // Set chart options
            var options = {
                title: 'Payment Chart',
                curveType: 'function',
                legend: { position: 'bottom' }
            };

            // Instantiate and draw the chart
            var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
            chart.draw(data, options);
        }
    </script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  google.charts.load('current', {'packages':['corechart']});
  google.charts.setOnLoadCallback(drawChart);

  function drawChart() {
    var dat = google.visualization.arrayToDataTable(<?php echo $dat_json; ?>);

    var options = {
      title: 'Top 3 Course Payments',
      is3D: true,
    };

    var chart = new google.visualization.PieChart(document.getElementById('char_div'));
    chart.draw(dat, options);
  }
</script>
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <?php
           include_once('includes/sidebar.php');?>
             </aside>
         <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column" style="width: 80%;margin-left:15%;">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow" >

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $_SESSION['name'];?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg" style="height: 40px;">
                            </a>
                            <!-- Dropdown - User Information -->
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1" style="text-align: center;">
                                                 <h6 style="color: crimson;font-weight: bold;"> étudiants</h6></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1" style="text-align: center;">
                                            <h6 style="color: crimson;font-weight: bold;"> Paiements </h6></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $additional; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1" style="text-align: center;">
                                            <h6 style="color: crimson;font-weight: bold;"> groupes </h6>
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php echo $count1; ?></div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="text-align: center;">
                                            <h6 style="color: crimson;font-weight: bold;"> formateurs </h6></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count2; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-user fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                       
           
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="text-align: center;">
                                            <h6 style="color: crimson;font-weight: bold;"> formations</h6></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count3; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-book fa-2x"></i>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
         
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="text-align: center;">
                                            <h6 style="color: crimson;font-weight: bold;"> Absences </h6></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count5; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-check-square fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="text-align: center;">
                                            <h6 style="color: crimson;font-weight: bold;"> Reclamations</h6></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count4; ?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-xl-3 col-md-6 mb-4" >
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1" style="text-align: center;">
                                            <h6 style="color: crimson;font-weight: bold;">montant dépensé </h6></div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $count6; ?></div>
                                        </div>
                                        <div class="col-auto">
                                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    

                    <!-- Content Row -->

                    <div class="row">
                    <div id="chart_div" style="width: 70%; height: 1000px;margin-left: -120px;" ></div>
                    <div style="margin-top: 400px;"><h4>le chert présente l'état <br> paiement dans la dernière année</h4> </div>
                    <div id="char_div" style="width: 100%; height: 500px;float: right; "></div>
                        <!-- Area Chart -->
                    </div>
                  
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

				
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
       <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

   </body>
</html>
<?php } ?>      
