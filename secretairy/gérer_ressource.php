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
   $search_query = isset($_GET['search_query']) ? $_GET['search_query'] : '';

 // Create a connection to the database
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 
 // Check if the connection was successful
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
 
 // Prepare the SQL statement
 $sql = "SELECT * FROM ressource WHERE nom LIKE '%$search_query%' OR type_r LIKE '%$search_query%'";
 
 // Execute the SQL statement
 $result = mysqli_query($conn, $sql);
 
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
      <title>ressource-manag</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <style>
   /* Style pour le tableau des certifications */
table {
  width: 80%;
  float: right;
  margin-top: 30px;
}

th, td {
  text-align: center;
  vertical-align: middle;
}

th {
  font-weight: bold;
}

thead th {
  background-color: #343a40;
  color: #fff;
}

tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

tbody tr:hover {
  background-color: #e2e2e2;
}

.btn {
  margin-right: 5px;
}
</style>
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <?php
           include_once('includes/sidebar.php');?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6">
                        <h1 class="m-0" style="color: crimson;">Liste des ressources</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">ressource</li>
                        </ol>
                     </div>
                     <!-- /.col -->
                  </div>
                  <!-- /.row -->
               </div>
               <!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->
            <!-- Main content -->
            <section class="content">
               <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                     <form method="get" style="width: 20%; margin-left: 65%;">
                  <div class="input-group">
                      <input type="text" class="form-control" name="search_query" placeholder="Search...">
                      <div class="input-group-append">
                     <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                       </button>
            </div>
        </div>
</form>
                      <table class="table" style="margin-top: 20px;">
                        <thead class='thead-dark'>
                          <tr>
                            <th>Nom</th>
                            <th>Type</th>
                            <th>Prix</th>
                            <th>Date d'ajoute</th>
                            <th>Remarque</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
    <?php
 // Check if any rows were returned
 if (mysqli_num_rows($result) > 0) {
     // Output data of each row
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr>";
         echo "<td>" . $row['nom'] . "</td>";
         echo "<td>" . $row['type_r'] . "</td>";
         echo "<td>" . $row['prix'] . "</td>";
         echo "<td>" . $row['date_ajoute'] . "</td>";
         echo "<td>" . $row['remarque'] . "</td>";
         echo "<td>
         <a href='edit_rssource.php?id=" . $row["id"] . "'><button type='button' class='btn btn-primary btn-sm' style='marrgin-left:20%'>Modifier</button></a>
         <a href='delete_ressource.php?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Supprimer</a>";
         echo "</td>";
         echo "</tr>";
     }
 } else {
     echo "0 results";
 }
 
 // Close the connection
 mysqli_close($conn);
    ?>
  </tbody>
                      </table>
                    </div>
                  </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
              
            </section>
            <!-- /.content -->
         </div>
         <!-- /.content-wrapper -->
      </div>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
   </body>
</html>
<?php }?>