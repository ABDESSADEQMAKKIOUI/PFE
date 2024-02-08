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
 $sql = "SELECT * FROM certificat ";
 
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
      <title>certificat</title>
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
  text-align: center;
}

thead th {
  background-color: #343a40;
  color: #fff;
  text-align: center;
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
        <!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>paiement</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">

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
                     <h1 class="m-0" style="color: rgb(241, 9, 9);">Liste des certificats</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Certificat</li>
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
           <div class="card-header" style="background-color: crimson;text-align: center;">
             <h3 class="card-title">Liste des certificats</h3>
             <div class="col-md-12">
          <div class="form-group">
          <div class="row">
          <div class="col-md-3">
				<label for="heure_fin">Groupe :</label>
			</div>
            <div class="col-md-3">
				<select class="form-control" name="class">
                <?php
                // Retrieve students from database
                $sq = "SELECT * FROM class ";
                $resul = mysqli_query($conn, $sq);
                if ($resul && mysqli_num_rows($resul) > 0) {
                  while ($row = mysqli_fetch_assoc($resul)) {
                    echo "<option value='" . $row['nom'] . "'>" . $row['nom'] . "</option>";
                  }
                }
                ?>
              </select>
			</div>
      <div class="col-md-3">
			<div class="col-md-6">
             <a href="gérer_certificat.php?groupe=$groupe"><button class="text-center btn btn-info btn-block" type="submit">Chercher</button></a> 
         </div>
         </div>
			</div>
      <div class="col-md-3">
          </div>
             <a href="ajouter_certificat.php" style="float: right;margin-top: -40px;"><button class="text-center btn btn-info btn-block" type="submit">Ajouter</button></a> 
           </div></div></div>

           <!-- /.card-header -->
           <!-- form start -->
           <?php
$result = mysqli_query($conn, $sql);

// Check if the query executed successfully
if (!$result) {
  die("Error retrieving data from the database: " . mysqli_error($conn));
}

// Display the results
if (mysqli_num_rows($result) > 0) {
  echo "<table class='table'>
        <thead class='thead-dark'>
          <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Formation</th>
            <th>Etudiant</th>
            <th>Action</th>
          </tr></thead>
          ";

  while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>".$row['id']."</td>
            <td>".$row['date_c']."</td>
            <td>".$row['formation']."</td>
            <td>".$row['nom']."</td>
           <td>
           <a href='edit_certificat.php?id=" . $row["id"] . "'><button type='button' class='btn btn-primary btn-sm' style='marrgin-left:20%'>Modifier</button></a>
            <a href='delete_certificat.php?delete_id=" . $row['id'] . "' class='btn btn-danger btn-sm'>Supprimer</a>
            </td>
          </tr>";
  }

  echo "</table>";
} else {
  echo "No data found.";
}

    ?>
  
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
<?php } ?>      
