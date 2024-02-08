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
//$search_query = $_POST['search_query'];

 // Create a connection to the database
 $conn = mysqli_connect($servername, $username, $password, $dbname);
 
 // Check if the connection was successful
 if (!$conn) {
     die("Connection failed: " . mysqli_connect_error());
 }
 
 // Prepare the SQL statement
 $sql = "SELECT * FROM paiement ";
 
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
      <title>Paiement</title>
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
                     <h1 class="m-0"><span class="fa fa-money-bill"></span>Liste des paiements</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Paiements</li>
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
               <div class="card-body animated pulse">
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
                  
    <?php
 
// Retrieve information from the tables
$query = "SELECT paiement.id, paiement.prix, paiement.date_p, paiement.remark, formations.nom AS formation, etudiant.first_name AS student, secretaires.nom AS secretaire
          FROM paiement
          JOIN formations ON paiement.formation_id = formations.id
          JOIN etudiant ON paiement.etudiant_id = etudiant.id
          JOIN secretaires ON paiement.secretaire_id = secretaires.id";
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if (!$result) {
  die("Error retrieving data from the database: " . mysqli_error($conn));
}

// Display the results
if (mysqli_num_rows($result) > 0) {
  echo "<table class='table'>
        <thead class='thead-dark'>
          <tr>
            <th>#</th>
            <th>Prix payé</th>
            <th>Date</th>
            <th>Remarque</th>
            <th>Formation</th>
            <th>Etudient</th>
            <th>Secrétaire</th>
            <th>Action</th>
          </tr></thead>
          ";

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['prix']."</td>
            <td>".$row['date_p']."</td>
            <td>".$row['remark']."</td>
            <td>".$row['formation']."</td>
            <td>".$row['student']."</td>
            <td>".$row['secretaire']."</td>
           <td>
           <a href='edit_paiement.php?id=" . $row["id"] . "'><button type='button' class='btn btn-primary btn-sm' style='marrgin-left:20%'>Modifier</button></a>
            <a href='delete_paiement.php?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Supprimer</a>
            </td>
          </tr>";
  }

  echo "</table>";
} else {
  echo "No data found.";
}

    ?>

               </div>
            </div>
            <!-- /.container-fluid -->
         </section>
         <!-- /.content -->
      </div>
      <!-- /.content-wrapper -->
   </div>
   <!-- ./wrapper -->
         <div id="delete" class="modal animated rubberBand delete-modal" role="dialog">
             <div class="modal-dialog modal-dialog-centered">
                 <div class="modal-content">
                     <div class="modal-body text-center">
                         <img src="../asset/img/sent.png" alt="" width="50" height="46">
                         <h3>Are you sure want to delete this Payment?</h3>
                         <div class="m-t-20"> <a href="#" class="btn btn-white" data-dismiss="modal">Close</a>
                             <button type="submit" class="btn btn-danger">Delete</button>
                         </div>
                     </div>
                 </div>
             </div>
         </div>

      <script src="../asset/tables/datatables/jquery.dataTables.min.js"></script>
      <script src="../asset/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
      <script src="../asset/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>s
      <script src="../asset/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
      <script>
         $(function () {
           $("#example1").DataTable();
         });
      </script>
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/bootstrap.bundle.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
   </body>
</html>
<?php } ?>      
