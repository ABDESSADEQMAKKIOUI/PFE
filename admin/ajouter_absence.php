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
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  // Retrieve form data
  $nom_etudient = $_POST['nom_etudient'];
  $id_etudient = $_POST['id_etudient'];
  $formation = $_POST['formation'];
  $date_a = $_POST['date_a'];
  $heur = $_POST['heur'];
  // Prepare SQL statement
 // Prepare SQL statement
// Prepare SQL statement
$stmt = $conn->prepare("INSERT INTO Absence (etudiant, code, formation, date_a, heure) VALUES (?, ?, ?, ?, ?)");
if (!$stmt) {
  die("Error preparing SQL statement: " . $conn->error);
}

// Bind parameters
$stmt->bind_param("sssss", $nom_etudient, $id_etudient , $formation , $date_a,$heur );


  // Execute SQL statement
  if ($stmt->execute()) {
    echo "Data successfully inserted into database.";
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

            <style>
               /* Changer la couleur de fond du corps de la page */
body {
	background-color: #f2f2f2;
}

/* Centrez le formulaire et ajustez la largeur */
.fr {
	margin-top: 50px;
	max-width: 700px;
	margin-left: auto;
	margin-right: auto;
   background-color: #f2f2f2;
}

/* Styliser le titre du formulaire */
h1 {
	text-align: center;
	margin-bottom: 30px;
   color: crimson;
   font-weight: bold;
   font-size: 30px;
}

/* Styliser les labels du formulaire */
label {
	font-weight: bold;
   margin-left: 25px;
}

/* Styliser les champs de saisie du formulaire */
.form-control {
	border-radius: 0;
}

/* Styliser le bouton d'enregistrement */
.btn-primary {
	border-radius: 0;
	background-color: #007bff;
	border-color: #007bff;
   float: right;
}

/* Styliser le bouton d'enregistrement lorsqu'il est survolé */
.btn-primary:hover {
	background-color: #0069d9;
	border-color: #0062cc;
   float: right;
}
            </style>
   </head>
   <body class="hold-transition sidebar-mini layout-fixed">
      <div class="wrapper">
      <?php
           include_once('includes/sidebar.php');?>
         <div class="fr" style="width: 80%; float: right;margin-right: 15%;">
            <h1>Ajouter/Modifier les absence des étudiants</h1>
            <form method="POST" action="">
               <div class="form-group">
                  <label for="student-name">Nom de l'étudiant</label>
                  <input type="text" class="form-control" id="nom_etudient" placeholder="Entrez le nom de l'étudiant" name="nom_etudient">
               </div>
               <div class="form-group">
                  <label for="student-id">ID de l'étudiant</label>
                  <input type="text" class="form-control" id="id_etudient" placeholder="Entrez l'ID de l'étudiant" name="id_etudient">
               </div>
               <div class="form-group">
                  <label for="student-formation">Nom de la formation</label>
                  <input type="text" class="form-control" id="formation" placeholder="Entrez le nom de la formation" name="formation">
               </div>
               <div class="form-group">
                  <label for="student-grade">Date D'absence</label>
                   <input type="date" class="form-control" id="date_a" placeholder="Entrez la note de l'étudiant" name="date_a">
               </div>
               <div class="form-group">
                  <label for="student-grade">HeurD'absence</label>
                   <input type="time" class="form-control" id="heur" placeholder="Entrez la note de l'étudiant" name="heur">
               </div>
               <button type="submit" class="btn btn-primary">Enregistrer</button>
            </form>
         </div>
            </div>
            <!-- /.card -->
         </div>
      <!-- ./wrapper -->
      <!-- jQuery -->
      <script src="../asset/jquery/jquery.min.js"></script>
      <script src="../asset/js/adminlte.js"></script>
   </body>
</html>
<?php }?>