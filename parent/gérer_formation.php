<?php
// Connect to the database
session_start();
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
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Prepare SQL query
if (isset($_GET['q'])) {
   // Sanitize the search query
   $q = mysqli_real_escape_string($conn, $_GET['q']);

   // Build the SQL query with a WHERE clause that matches the search query
   $sql = "SELECT * FROM formations WHERE nom LIKE '%$q%' OR domain LIKE '%$q%'";

   // Execute the query
   $result = mysqli_query($conn, $sql);
} else {
   // Build the SQL query without a WHERE clause to fetch all the results
   $sql = "SELECT * FROM formations";

   // Execute the query
   $result = mysqli_query($conn, $sql);
}

// Execute the query
$result = mysqli_query($conn, $sql);

// Check if there are any results


// Close the database connection

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>gérer formation</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <style>
               h1 {
                  margin-top: 30px;
                  text-align: center;
                  color: crimson;

               }
               table {
  border-collapse: collapse;
  width: 85%;
  margin-bottom: 20px;
  margin-top: 30px;
  margin-left: 15%;
}

th, td {
  text-align:center;
  padding: 8px;
  width: auto;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
}

tr:nth-child(even) {
  background-color: #f2f2f2;
}

.btn-edit, .btn-delete {
  padding: 5px 10px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  width: 90px;
  float: right;
}

.btn-edit {
  background-color: #4CAF50;
  color: white;
  
}

.btn-delete {
  background-color: #f44336;
  color: white;
}

            </style>
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- Navbar -->
         <?php
           include_once('includes/sidebar.php');?>
         <!-- Content Wrapper. Contains page content -->
    <h1 style="margin-left: -40%;">List des formations</h1>

    <!-- Search form -->
    <form method="POST" style="width: 20%; margin-left: 73%; margin-top: -3%;">
                  <div class="input-group">
                      <input type="text" class="form-control" name="search_query" placeholder="Search...">
                      <div class="input-group-append">
                     <button class="btn btn-secondary"  type="submit">
                        <i class="fa fa-search"></i>
                       </button>
            </div>
        </div>
</form>
    <table sty>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Date de début</th>
                <th>Domaine</th>
                <th>Prix</th>
                <th>Durée</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                // Output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['nom'] . "</td>";
                    echo "<td>" . $row['date_f'] . "</td>";
                    echo "<td>" . $row['domain'] . "</td>";
                    echo "<td>" . $row['prix'] . "</td>";
                    echo "<td>" . $row['duree'] . "</td>";
                    echo "<td style='width:250px;text-align: justify;'>" . $row['description'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='10'>Aucun résultat trouvé.</td></tr>";
               }
               ?>
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
   </body>
</html>
<?php } ?>   