
<?php
session_start();
	// Connexion à la base de données
  $conn = mysqli_connect("localhost", "root", "", "test");
	
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
         <div style="width:80%;float: right;margin-right: 40px;margin-top: 3%; text-align: center;">
         <h1 style="color: red;"> Calendier </h1>
         <table class="table">
            <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Enseignant</th>
                <th>Salle</th>
                <th>Jour</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Goupes</th>
                <th>Nom de formation</th>
            </tr>
            </thead>
            <tbody>
    <?php
 $query = "SELECT emploidutemp.id, emploidutemp.enseignant, emploidutemp.salle, emploidutemp.jour, emploidutemp.heure_debut, emploidutemp.heure_fin, class.nom AS classe, formations.nom AS formation
 FROM emploidutemp
 JOIN class ON emploidutemp.class_id = class.id
 JOIN formations ON emploidutemp.formation_id = formations.id";
$result = mysqli_query($conn, $query);

// Check if the query executed successfully
if (!$result) {
die("Error retrieving data from the database: " . mysqli_error($conn));
}
 // Check if any rows were returned
     // Output data of each row

     while ($row = mysqli_fetch_assoc($result)) {
      $id = $row['id'];
      $enseignant = $row['enseignant'];
      $salle = $row['salle'];
      $jour = $row['jour'];
      $heure_debut = $row['heure_debut'];
      $heure_fin = $row['heure_fin'];
      $classe = $row['classe'];
      $formation = $row['formation'];
    
      // Perform any operations with the retrieved data
      // For example, you can echo the values or store them in variables for further use
      echo '<tr>';
	    echo '<td>' . $id . '</td>';
	    echo '<td>' . $enseignant . '</td>';
	    echo '<td>' . $salle . '</td>';
	    echo '<td>' . $jour. '</td>';
	    echo '<td>' .$heure_debut. '</td>';
	    echo '<td>' . $heure_fin. '</td>';
      echo '<td>' .$classe. '</td>';
      echo '<td>' .$formation. '</td>';
	    echo '</tr>';
    }
    
    // Free the result set
    mysqli_free_result($result);
    
    // Close the database connection
    mysqli_close($conn);

	?>

  </tbody>
         </table>
      </div>

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