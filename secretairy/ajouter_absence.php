<?php
session_start();
// Create connection
$conn = mysqli_connect("localhost", "root", "", "test");

// Check connection
if(strlen($_SESSION['name'])==0)
  { 
header('location:authentic.php');
}
else{
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Process form data and insert into database
if (isset($_POST['submit'])) {
  // Retrieve form data
  $nom_etudient = $_POST['nom_etudient'];
  $type ='etudiant';
  $formation = $_POST['formation'];
  $date_a = $_POST['date_a'];
  $heur = $_POST['heur'];
  // Prepare SQL statement
 // Prepare SQL statement
// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO Absence (type_a, nom, formation, date_a, heure) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
  die("Error preparing SQL statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sssss",$type, $nom_etudient, $formation , $date_a,$heur );


  // Execute SQL statement
  if ($stmt->execute()) {
    echo "Data successfully inserted into database.";
    header('location:ajouter_absence.php');
  } else {
    echo "Error inserting data into database: " . $conn->error;
  }

  // Close statement and connection
  $stmt->close();
  $conn->close();
}
if (isset($_POST['add'])) {
   // Retrieve form data
   $nom_etudient = $_POST['formateur'];
   $type ='formateur';
   $formation = $_POST['formation'];
   $date_a = $_POST['date_a'];
   $heur = $_POST['heur'];
   // Prepare SQL statement
  // Prepare SQL statement
 // Prepare SQL statement
 $stmt = $conn->prepare("INSERT INTO Absence (type_a, nom, formation, date_a, heure) VALUES (?, ?, ?, ?, ?)");
 if (!$stmt) {
   die("Error preparing SQL statement: " . $conn->error);
 }
 
 // Bind parameters
 $stmt->bind_param("sssss",$type, $nom_etudient, $formation , $date_a,$heur );
 
 
   // Execute SQL statement
   if ($stmt->execute()) {
     echo "Data successfully inserted into database.";
     header('location:ajouter_absence.php');
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
      <title>Etudient</title>
      <!-- Font Awesome -->
      <link rel="stylesheet" href="../asset/fontawesome/css/all.min.css">
      <link rel="stylesheet" href="../asset/css/adminlte.min.css">
            <link rel="stylesheet" href="../asset/css/style.css">

            
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
         <!-- Navbar -->
         <?php
           include_once('includes/sidebar.php');?>
         <!-- Content Wrapper. Contains page content -->
         <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
               <div class="container-fluid">
                  <div class="row mb-2">
                     <div class="col-sm-6 animated bounceInRight">
                        <h1 class="m-0" style="color: crimson;font-weight: bold;"><span class="fa fa-plus"></span> Ajouter absence</h1>
                     </div>
                     <!-- /.col -->
                     <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                           <li class="breadcrumb-item"><a href="#">Home</a></li>
                           <li class="breadcrumb-item active">Ajouter absence</li>
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
              <div class="card-header" style="text-align: center;font-size: larger;">
                <h3 class="card-title" style="text-align: center;font-size: larger;">Absence d'etudiant</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="">
                        <div class="card-body">
                           <div class="row">
                           <div class="col-md-6">
                           <div class="form-group">
                  <label for="student-name">Nom de l'étudiant</label>
                  <input type="text" class="form-control" id="nom_etudient" placeholder="Entrez le nom de l'étudiant" name="nom_etudient">
               </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="student-id">Groupe</label>
                  <select class="form-control" id="student" name="groupe">
            <?php

              // Query the database for student names
              $sq = "SELECT * FROM class";
              $resul = mysqli_query($conn, $sq);

              // Loop through the results and add options to the dropdown
              if (mysqli_num_rows($resul) > 0) {
                while($row = mysqli_fetch_assoc($resul)) {
                  echo "<option>" . $row["nom"] . "</option>";
                }
              }

              // Close the database connection
             
            ?>
          </select>
               </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="student-formation">Nom de la formation</label>
                  <select class="form-control" id="formation_p" name="formation">
            <?php

              // Query the database for student names
              $s = "SELECT nom FROM formations";
              $resu = mysqli_query($conn, $s);

              // Loop through the results and add options to the dropdown
              if (mysqli_num_rows($resu) > 0) {
                while($row = mysqli_fetch_assoc($resu)) {
                  echo "<option>" . $row["nom"] . "</option>";
                }
              }

              // Close the database connection
             
            ?>
          </select>
               </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="student-grade">Date D'absence</label>
                   <input type="date" class="form-control" id="date_a" placeholder="Entrez la note de l'étudiant" name="date_a">
               </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="student-grade">HeurD'absence</label>
                   <input type="time" class="form-control" id="heur" placeholder="Entrez la note de l'étudiant" name="heur">
               </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
               <label for="student-grade"> </label>
                        <button class="text-center btn btn-info btn-block" type="submit" name="submit">Ajouter</button> 
                     </div>
                   </div>
               
                                 </div>
                              </div>
                     </form>
            </div>
               </div>
               <!-- /.container-fluid -->
            </section>
            <section class="content">
               <div class="container-fluid">
                  <div class="card card-info">
              <div class="card-header" style="background-color: crimson;text-align: center;font-size: larger;">
                <h3 class="card-title"style="text-align: center;font-size: larger;" >Absence formateur</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form method="POST" action="">
                        <div class="card-body">
                           <div class="row">
                           <div class="col-md-6">
                           <div class="form-group">
                  <label for="student-name">Nom du formateur</label>
                  <select class="form-control" name="formateur">
                <?php
                // Retrieve students from database
                $sql = "SELECT * FROM formateur ";
                $result = mysqli_query($conn, $sql);
                if ($result && mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                    echo "<option value='" . $row['nom'] . "'>" . $row['nom'] . "</option>";
                  }
                }
                ?>
              </select>
               </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="student-formation">Nom de la formation</label>
                  <select class="form-control" id="formation_p" name="formation">
            <?php

              // Query the database for student names
              $s = "SELECT nom FROM formations";
              $resu = mysqli_query($conn, $s);

              // Loop through the results and add options to the dropdown
              if (mysqli_num_rows($resu) > 0) {
                while($row = mysqli_fetch_assoc($resu)) {
                  echo "<option>" . $row["nom"] . "</option>";
                }
              }

              // Close the database connection
             
            ?>
          </select>
               </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="student-grade">Date D'absence</label>
                   <input type="date" class="form-control" id="date_a" placeholder="Entrez la note de l'étudiant" name="date_a">
               </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
                  <label for="student-grade">HeurD'absence</label>
                   <input type="time" class="form-control" id="heur" placeholder="Entrez la note de l'étudiant" name="heur">
               </div>
               </div>
               <div class="col-md-6">
               <div class="form-group">
               <label for="student-grade"> </label>
                        <button class="text-center btn btn-info btn-block" type="submit" name="add" style="background-color: crimson;">Ajouter</button> 
                     </div>
                   </div>
               
                                 </div>
                              </div>
                     </form>
            </div>
               </div>
               <!-- /.container-fluid -->
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