<?php
session_start();
// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (empty($_SESSION['name'])) {
   header('location:authentic.php');
   exit; // Stop executing the script
 }
else{
$sql = "SELECT * FROM etudiant ";
 
// Execute the SQL statement
$result = mysqli_query($conn, $sql);
if (isset($_POST['submit'])) {
  // Retrieve form data
  $nom_etudient = $name;
  $formation = $_POST['formation'];
  $formateur = $_SESSION['name'];
  $valeur = $_POST['note'];
  // Prepare SQL statement
 // Prepare SQL statement
// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO note (valeurs, etudiant, formation, formateur) VALUES (?, ?, ?, ?)");
if (!$stmt) {
  die("Error preparing SQL statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("ssss",$valuer, $nom_etudient, $formation , $formateur );


  // Execute SQL statement
  if ($stmt->execute()) {
    echo "Data successfully inserted into database.";
    header('location:note.php');
  } else {
    echo "Error inserting data into database: " . $conn->error;
  }

  // Close statement and connection
  $stmt->close();
  $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>etudient-mod</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">
            <!-- DataTables -->
      <link rel="stylesheet" href="../asset/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">
      <link rel="stylesheet" href="../asset/tables/datatables-responsive/css/responsive.bootstrap4.min.css">
      <link rel="stylesheet" href="../asset/tables/datatables-buttons/css/buttons.bootstrap4.min.css">
      <style>
               h1 {
                  margin-top: 30px;
                  color: crimson;

               }
               table {
  border-collapse: collapse;
  width: 85%;
  margin-bottom: 20px;
  margin-top: 30px;
 
}

th, td {
  text-align:center;
  padding: 8px;
  width: auto;
  font-size: large;
  font-weight: bold;
  font-family: Arial, Helvetica, sans-serif;
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
         <?php
         include_once('includes/sidebar.php');?>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
         <!-- Content Header (Page header) -->
         <div class="content-header">
            <div class="container-fluid">
               <div class="row mb-2">
                  <div class="col-sm-6 animated bounceInRight">
                     <h1 class="m-0" style="color: rgb(241, 9, 9);">Ajouter note</h1>
                  </div>
                  <!-- /.col -->
                  <div class="col-sm-6">
                     <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Notes</li>
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
             <h3 class="card-title">Saisir les notes</h3>
             <div class="col-md-12">
          <div class="form-group">
          <form action="" method="post">
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
				<select class="form-control" name="formation">
                <?php
                // Retrieve students from database
                $sq = "SELECT * FROM formations ";
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
            
           </div></div></div>

           <!-- /.card-header -->
           <!-- form start -->
           
           <table id="example1" class="table table-bordered table-striped">
  <thead>
    <tr>
      
      <th>Nom</th>
      <th>Prenom</th>
      <th>Note</th>
      
    </tr>
  </thead>
  <tbody>
    <?php
 
 // Check if any rows were returned
 if (mysqli_num_rows($result) > 0) {
     // Output data of each row
     while($row = mysqli_fetch_assoc($result)) {
         echo "<tr>";
         
         echo "<td>" . $row['first_name'] . "</td>";
         echo "<td>" . $row['last_name'] . "</td>";
         echo "<td>";
         echo "
         <div class='input-group'>
             <input type='text' style='width:100px' class='form-control' name='note' placeholder='ajouter la note'>
             </div>
           
             ";
         echo "</td>";
         echo "</tr>";
        $name =$row['first_name'] ;
     }
 } else {
     echo "0 results";
 }
 
 // Close the connection
 mysqli_close($conn);
    ?>
    
  </tbody>
</table> 
<button type="submit" style="float: right;width:100px;" name="submit">Enregistrer</button>
</form>
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