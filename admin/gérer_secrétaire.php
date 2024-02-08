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
$sql = "SELECT * FROM secretaires ";
 
// Execute the SQL statement
$result = mysqli_query($conn, $sql);
if ($_SERVER["REQUEST_METHOD"] == "POST") {

$search_query = $_POST['search_query'];


 
 // Check if the connection was successful
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
 
 // Prepare the SQL statement
 $sql = "SELECT * FROM secretaires WHERE nom LIKE '%$search_query%' OR prenom LIKE '%$search_query%'";
 
 // Execute the SQL statement
 $result = mysqli_query($conn, $sql);
 
 // Check if the query was successful
 if (!$result) {
     die("Query failed: " . mysqli_error($conn));
 }
}

?>

<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>certifications-Manag</title>
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
                  <div class="col-sm-6 animated bounceInRight">
                     <h1 class="m-0" style="color: rgb(241, 9, 9);">Liste des secrétaire</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Secrétaires</li>
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
               <div class="card card-info">
           <div class="card-header" style="background-color:dodgerblue;text-align: center;">
             <h3 class="card-title">Secrétaires Informations</h3>
             <a href="ajouter_secrétaire.php" style="float: right;"><button class="text-center btn btn-info btn-block" type="submit">Ajouter</button></a> 
           </div>
           <!-- /.card-header -->
           <!-- form start -->
           <form method="POST" action="">
                  <div class="input-group">
                      <input type="text" class="form-control" name="search_query" placeholder="Search...">
                      <div class="input-group-append">
                     <button class="btn btn-secondary" type="submit">
                        <i class="fa fa-search"></i>
                       </button>
            </div>
        </div>
</form>
         <table class="table">
            <thead class="thead-dark">
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nom de la sécrétaire</th>
                  <th scope="col">prenom</th>
                  <th scope="col">numéro de telephone</th>
                  <th scope="col">adress</th>
                  <th scope="col">action</th>
               </tr>
            </thead>
            <tbody>
    <?php
 
 // Check if any rows were returned
 if (mysqli_num_rows($result) > 0) {
     // Output data of each row
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr>";
         echo "<th scope='row'>" . $row["id"] . "</th>";
         echo "<td>" . $row['nom'] . "</td>";
         echo "<td>" . $row['prenom'] . "</td>";
         echo "<td>" . $row['telephone'] . "</td>";
         echo "<td>" . $row['adresse'] . "</td>";
         echo "<td>";
         echo "<button type='button' class='btn btn-primary btn-sm'>Modifier</button>";
         echo "<button type='button' class='btn btn-danger btn-sm'>Supprimer</button>";
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